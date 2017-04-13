<?php
namespace LADR\SmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LADR\SmsBundle\Model\SmsInterface;
use LADR\SmsBundle\Model\SmsRecipientAbstract;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\SmsBundle\Model\SmsAbstract;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum;

/**
 * Class SmsEntity
 * @package LADR\SmsBundle\Entity
 *
 * @ORM\Table(name="ladr_sms_recipient")
 * @ORM\Entity()
 */
class SmsRecipientEntity extends SmsRecipientAbstract
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Identifiant du message.
     *
     * @var SmsEntity $sms
     *
     * @ORM\ManyToOne(targetEntity="SmsEntity", cascade={"all"}, inversedBy="destinataires")
     */
    protected $sms;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setStatus(0);
    }
    /**
     * get sms
     *
     * @return SmsEntity
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * set sms
     *
     * @param SmsEntity $sms
     *
     * @return self
     */
    public function setSms(SmsInterface $sms)
    {
        $this->sms = $sms;

        return $this;
    }
}