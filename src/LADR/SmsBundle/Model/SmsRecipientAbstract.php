<?php
namespace LADR\SmsBundle\Model;

use LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * Class SmsAbstract
 * @package LADR\SmsBundle\Model
 * @see http://www.spot-hit.fr/documentation-api
 */
abstract class SmsRecipientAbstract implements SmsRecipientInterface
{

    /**
     * Identifiant du message.
     *
     * @var SmsInterface $sms
     */
    protected $sms;

    /**
     * Numéro du destinataire
     *
     * @var string $phoneNumber
     *
     * @AssertPhoneNumber()
     */
    protected $phoneNumber;

    /**
     * Statut du message :
     * 0 = En attente d'envoi
     * 1 = Envoyé et bien reçu
     * 2 = Envoyé et non reçu
     * 3 = En cours
     * 4 = Echec
     * 5 = Expiré
     * (Les statuts 1, 4 et 5 sont définitifs.)
     *
     * @var int $status
     */
    protected $status;

    /**
     * Date d'émission du message
     *
     * @var \Datetime|null $sendAt
     */
    protected $sendAt;

    /**
     * Date du dernier changement de statut du messag
     *
     * @var \Datetime|null $updatedAt
     */
    protected $updatedAt;

    /**
     * Statut détaillé du message (disponible auprès de votre gestionnaire de compte. Non disponible en Low Cost).
     *
     * @var string $detail
     */
    protected $detail;

    /**
     * Code MCCMNC correspondant à l'opérateur du destinataire (non disponible en Low Cost).
     *
     * @var string $operator
     */
    protected $operator;

    /**
     * get sms
     *
     * @return SmsInterface
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * set sms
     *
     * @param SmsInterface $sms
     *
     * @return self
     */
    public function setSms(SmsInterface $sms)
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * set status
     *
     * @param int $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * get sendAt
     *
     * @return \Datetime|null
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * set sendAt
     *
     * @param \Datetime|null $sendAt
     *
     * @return self
     */
    public function setSendAt($sendAt)
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    /**
     * get updatedAt
     *
     * @return \Datetime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * set updatedAt
     *
     * @param \Datetime|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * set detail
     *
     * @param string $detail
     *
     * @return self
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * set operator
     *
     * @param string $operator
     *
     * @return self
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }


}