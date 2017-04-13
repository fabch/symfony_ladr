<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 12:20
 */
namespace LADR\SmsBundle\Model;

use LADR\SmsBundle\Entity\SmsEntity;

/**
 * Interface SmsInterface
 * @package LADR\SmsBundle\Model
 */
interface SmsRecipientInterface
{

    /**
     * get sms
     *
     * @return SmsInterface
     */
    public function getSms();

    /**
     * set sms
     *
     * @param SmsInterface $sms
     *
     * @return self
     */
    public function setSms(SmsInterface $sms);

    /**
     * get phoneNumber
     *
     * @return \libphonenumber\PhoneNumber
     */
    public function getPhoneNumber();

    /**
     * set phoneNumber
     *
     * @param \libphonenumber\PhoneNumber $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(\libphonenumber\PhoneNumber $phoneNumber);

    /**
     * get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * set status
     *
     * @param int $status
     *
     * @return self
     */
    public function setStatus($status);

    /**
     * get sendAt
     *
     * @return \Datetime|null
     */
    public function getSendAt();

    /**
     * set sendAt
     *
     * @param \Datetime|null $sendAt
     *
     * @return self
     */
    public function setSendAt($sendAt);

    /**
     * get updatedAt
     *
     * @return \Datetime|null
     */
    public function getUpdatedAt();

    /**
     * set updatedAt
     *
     * @param \Datetime|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt);


    /**
     * get detail
     *
     * @return string
     */
    public function getDetail();

    /**
     * set detail
     *
     * @param string $detail
     *
     * @return self
     */
    public function setDetail($detail);

    /**
     * get operator
     *
     * @return SmsInterface
     */
    public function getOperator();

    /**
     * set operator
     *
     * @param string $operator
     *
     * @return self
     */
    public function setOperator($operator);
}