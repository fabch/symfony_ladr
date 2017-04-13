<?php
namespace LADR\SmsBundle\Services;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use LADR\SmsBundle\Exception\SpotHitException;
use LADR\SmsBundle\Model\SmsInterface;
use LADR\SmsBundle\Model\SmsRecipientInterface;
use LADR\SmsBundle\Serializer\Encoder\SmsRecipientEncoder;
use LADR\SmsBundle\Serializer\NameConverter\SmsNameConverter;
use LADR\SmsBundle\Serializer\NameConverter\SmsRecipientNameConverter;
use LADR\SmsBundle\Serializer\Normalizer\SmsNormalizer;
use LADR\SmsBundle\Serializer\Normalizer\SmsRecipientNormalizer;
use LADR\SmsBundle\Serializer\SmsSerializer;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use LADR\SmsBundle\Utils\Errors\SpotHitErrorCode;
use Misd\PhoneNumberBundle\Serializer\Normalizer\PhoneNumberNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use libphonenumber\PhoneNumberUtil;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 10:36
 */
class SmsService
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var PhoneNumberUtil
     */
    private $phoneNumberUtil;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EntityManager $em
     * @param PhoneNumberUtil $phoneNumberUtil
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EntityManager $em, PhoneNumberUtil $phoneNumberUtil, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $em;
        $this->phoneNumberUtil = $phoneNumberUtil;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Envoi le sms à l'API SpotHit
     *
     * @see https://www.spot-hit.fr/documentation-api
     *
     * @param SmsInterface $smsInterface
     */
    public function send(SmsInterface $smsInterface){

        $normalizedSms = $this->normalizeSms($smsInterface);
        $normalizedSms['destinataires'] = var_export($normalizedSms['destinataires'],true);
        $ch = curl_init('https://www.spot-hit.fr/api/envoyer/sms');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        //curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($normalizedSms, '', '&'));
        $json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode($json, true);
        if(!$response['resultat'])
        {
            throw new SpotHitException(SpotHitErrorCode::getMessage($response['erreurs']), (int)$response['erreurs']);
        }

        $smsInterface->setSpotHitId($response['id']);
        $smsInterface->setTransmittedAt(new \Datetime());

        $this->em->persist($smsInterface);
        $this->em->flush();

        return $smsInterface;
    }

    /**
     * Envoi le sms à l'API SpotHit
     *
     * @see https://www.spot-hit.fr/documentation-api
     *
     * @param SmsInterface $smsInterface
     */
    public function modify(SmsInterface $smsInterface){
        $data = array(
            'key'  => $smsInterface->getApiKey(),
            'date' => (int)$smsInterface->getScheduledAt()->format('U') + 100000,
            'id'   => $smsInterface->getSpotHitId(),
            'message' => 'test de changement demessage'
        );
        $ch = curl_init('https://www.spot-hit.fr/manager/inc/actions/modifier_message.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        //curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        $json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode($json, true);
        if(!$response['resultat'])
        {
            throw new SpotHitException(SpotHitErrorCode::getMessage($response['erreurs']), (int)$response['erreurs']);
        }

        return $smsInterface;
    }

    /**
     * Envoi le sms à l'API SpotHit
     *
     * @see https://www.spot-hit.fr/documentation-api
     *
     * @param SmsInterface $smsInterface
     */
    public function sync(SmsInterface $smsInterface){
        $data = array(
            'key'  => $smsInterface->getApiKey(),
            'id'   => (string)$smsInterface->getSpotHitId()
        );
        $ch = curl_init('https://www.spot-hit.fr/manager/inc/actions/liste_accuses.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        //curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        $json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode($json, true);
        if(isset($response['resultat']) && !$response['resultat'])
        {
            throw new SpotHitException(SpotHitErrorCode::getMessage($response['erreurs']), (int)$response['erreurs']);
        }

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $serializer = new SmsSerializer(array(
            new SmsRecipientNormalizer($classMetadataFactory, new SmsRecipientNameConverter()),
            new PhoneNumberNormalizer($this->phoneNumberUtil),
            new ArrayDenormalizer(),
            new DateTimeNormalizer("U") //timestamp
        ), array(
            new JsonEncoder()
        ));
        $obj = $serializer->deserialize($json,'\LADR\SmsBundle\Entity\SmsRecipientEntity[]', 'json', array('groups' => array('sync')));
        return $smsInterface;
    }

    /**
     * @param SmsInterface $smsInterface
     *
     * @return array
     */
    public function normalizeSms(SmsInterface $smsInterface){

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $serializer = new SmsSerializer(array(
            new SmsNormalizer($classMetadataFactory, new SmsNameConverter()),
            new SmsRecipientNormalizer($classMetadataFactory),
            new PhoneNumberNormalizer($this->phoneNumberUtil),
            new DateTimeNormalizer("U") //timestamp
        ));
        $normalizedSms = $serializer->normalize($smsInterface, null, array('groups' => array($smsInterface->getType())));

        return $normalizedSms;
    }
}