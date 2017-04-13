<?php

namespace LADR\SmsBundle\Controller;

use LADR\SmsBundle\Entity\SmsEntity;
use LADR\SmsBundle\Exception\SpotHitException;
use LADR\SmsBundle\Serializer\NameConverter\SmsNameConverter;
use LADR\SmsBundle\Serializer\Normalizer\SmsNormalizer;
use LADR\SmsBundle\Serializer\Normalizer\SmsRecipientNormalizer;
use LADR\SmsBundle\Serializer\SmsSerializer;
use LADR\SmsBundle\Utils\Errors\SpotHitErrorCode;
use Misd\PhoneNumberBundle\Serializer\Normalizer\PhoneNumberNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

/*
 * @Route("/sms")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="sms_homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sms = $em->getRepository('LADRSmsBundle:SmsEntity')->find(4);
        $date = new \Datetime();
        $date->add(new \DateInterval('P10D'));
        $sms->setScheduledAt($date);
        $sms = $this->container->get('ladr_sms.sms_service')->modify($sms);

        return new JsonResponse(sprintf('Message envoyé avec succès ! Identifiant unique : %s', $sms->getSpotHitId()));
    }

    /**
     * @Route("/{id}/modifier", name="sms_edit")
     */
    public function modifyAction(Request $request, SmsEntity $sms)
    {
        $sms = $this->container->get('ladr_sms.sms_service')->modify($sms);
        return new JsonResponse(sprintf('Message envoyé avec succès ! Identifiant unique : %s', $sms->getSpotHitId()));
    }

    /**
     * @Route("/{id}/synchroniser", name="sms_sync")
     */
    public function synchronizeAction(Request $request, SmsEntity $sms)
    {
        $sms = $this->container->get('ladr_sms.sms_service')->sync($sms);

        return new JsonResponse(sprintf('Message envoyé avec succès ! Identifiant unique : %s', $sms->getSpotHitId()));
    }
}
