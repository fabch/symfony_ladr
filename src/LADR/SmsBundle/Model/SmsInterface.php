<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 12:20
 */
namespace LADR\SmsBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Interface SmsInterface
 * @package LADR\SmsBundle\Model
 */
interface SmsInterface
{

    /**
     * get key
     *
     * @return string
     */
    public function getApiKey();

    /**
     * get type
     *
     * @return string
     */
    public function getType();

    /**
     * @return array
     */
    public static function getAvailableTypes();

    /**
     * get spotHitId
     *
     * @return int
     */
    public function getSpotHitId();

    /**
     * set spotHitId
     *
     * @param int $spotHitId
     *
     * @return self
     */
    public function setSpotHitId($spotHitId);

    /**
     * get message
     *
     * @return string
     */
    public function getMessage();

    /**
     * set message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage($message);

    /**
     * get paramKeys
     *
     * @return array|string[]
     */
    public function getParamKeys();

    /**
     * set paramKeys
     *
     * @param array|string[] $paramKeys
     *
     * @return self
     */
    public function setParamKeys($paramKeys);

    /**
     * add paramKey
     *
     * @param string $paramKey
     *
     * @return self
     */
    public function addParamKey($paramKey);

    /**
     * add paramKey
     *
     * @param string $paramKey
     *
     * @return self
     */
    public function removeParamKey($paramKey);

    /**
     * get  destinataires
     *
     * @return Collection|SmsRecipientInterface[]
     */
    public function getDestinataires();

    /**
     * set destinataires
     *
     * @param Collection|SmsRecipientInterface[] $destinataires
     *
     * @return self
     */
    public function setDestinataires($destinataires);

    /**
     * get expediteur
     *
     * @return string
     */
    public function getExpediteur();

    /**
     * set expediteur
     *
     * @param string $expediteur
     *
     * @return self
     */
    public function setExpediteur($expediteur);

    /**
     * get createdAt
     *
     * @return \Datetime
     */
    public function getCreatedAt();

    /**
     * set createdAt
     *
     * @param \Datetime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

    /**
     * get transmittedAt
     *
     * @return \Datetime|null
     */
    public function getTransmittedAt();

    /**
     * set transmittedAt
     *
     * @param \Datetime|null $transmittedAt
     *
     * @return self
     */
    public function setTransmittedAt($transmittedAt);

    /**
     * get scheduledAt
     *
     * @return \Datetime|null
     */
    public function getScheduledAt();

    /**
     * set scheduledAt
     *
     * @param \Datetime|null $scheduledAt
     *
     * @return self
     */
    public function setScheduledAt($scheduledAt);

    /**
     * is smslong
     *
     * @return boolean
     */
    public function isSmslong();

    /**
     * set smslong
     *
     * @param boolean $smslong
     *
     * @return self
     */
    public function setSmslong($smslong);

    /**
     * get smslongnbr
     *
     * @return int
     */
    public function getSmslongnbr();

    /**
     * set smslongnbr
     *
     * @param int $smslongnbr
     *
     * @return self
     */
    public function setSmslongnbr($smslongnbr);

    /**
     * is tronque
     *
     * @return boolean
     */
    public function isTronque();

    /**
     * set tronque
     *
     * @param boolean $tronque
     *
     * @return self
     */
    public function setTronque($tronque);

    /**
     * get encodage
     *
     * @return string
     */
    public function getEncodage();

    /**
     * set encodage
     *
     * @param string $encodage
     *
     * @return self
     */
    public function setEncodage($encodage);

    /**
     * get nom
     *
     * @return string
     */
    public function getNom();

    /**
     * set nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom($nom);

    /**
     * get destinatairesType
     *
     * @return string
     */
    public function getDestinatairesType();

    /**
     * @return array
     */
    public static function getAvailableDestinatairesTypes();

    /**
     * set destinatairesType
     *
     * @param string $destinatairesType
     *
     * @return self
     */
    public function setDestinatairesType($destinatairesType);

    /**
     * get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url);
}