<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 12:20
 */
namespace LADR\SmsBundle\Model;

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
    public function getKey();

    /**
     * set key
     *
     * @param string $key
     *
     * @return self
     */
    public function setKey($key);

    /**
     * get type
     *
     * @return string
     */
    public function getType();

    /**
     * @return array
     */
    public function getAvailableTypes();

    /**
     * set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type);

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
     * get destinataires
     *
     * @return array
     */
    public function getDestinataires();

    /**
     * set destinataires
     *
     * @param array $destinataires
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
     * get date
     *
     * @return \Datetime
     */
    public function getDate();

    /**
     * set date
     *
     * @param \Datetime $date
     *
     * @return self
     */
    public function setDate($date);

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
    public function getAvailableDestinatairesTypes();

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