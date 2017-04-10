<?php
namespace LADR\SmsBundle\Model;

use LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SmsAbstract
 * @package LADR\SmsBundle\Model
 * @see http://www.spot-hit.fr/documentation-api
 */
abstract class SmsAbstract implements SmsInterface
{
    /**
     * Votre clé API d'identification
     *
     * @var string $key
     *
     * @Assert\NotBlank(groups={"Default","Premium","Full"})
     */
    protected $key;

    /**
     * Type de SMS : "premium" ou "lowcost"
     *
     * Premium : Accusé de réception, Personnalisation de l'expéditeur, Envoi rapide
     * Low Cost : Pas d'accusé de réception, Expéditeur aléatoire (ex : 0600000000), Délai d'envoi variable
     * (une minute à plusieurs heures)
     *
     * @var string $type
     *
     * @Assert\Choice(callback="getAvailableTypes")
     * @Assert\NotNull(groups={"Default","Premium","Full"})
     */
    protected $type;

    /**
     * Limité à 160 caractères (ou voir paramètre smslong).
     * Attention : Les caractères "|", "^", "€", "}", "{", "[", "~", "]", "\" comptent doubles.
     * SMS Personnalisé : {Nom de la colonne}, exemple : {Nom}
     *
     * @var string $message
     *
     * @Assert\NotBlank(groups={"Default","Premium","Full"})
     */
    protected $message;

    /**
     * Liste de numéros de vos destinataires (tableau ou séparé par un retour à la ligne ou une virgule)
     * ex : +33600000000,003360-00-00-00 , 6 00 00 00 00
     *
     * @var SmsRecipientInterface[] $destinataires
     *
     * @Assert\NotBlank(groups={"Default","Premium","Full"})
     */
    protected $destinataires;

    /**
     * Optionnel (uniquement SMS Premium) 11 caractères maximum (espaces inclus)
     * Si vide, l'expéditeur de votre SMS sera un numéro court à 5 chiffres auxquels vos destinataires peuvent répondre.
     *
     * @var string $expediteur
     *
     * @Assert\NotBlank(groups={"Premium","Full"})
     * @Assert\Length(max="11", groups={"Premium","Full"})
     */
    protected $expediteur;

    /**
     * Optionnel
     * Date d'envoi du message (format timestamp) Si aucune date n'est entrée ou si celle-ci précède la date
     * actuelle, le message sera envoyé immédiatement
     *
     * @var \Datetime $date
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $date;

    /**
     * Optionnel
     * Si égal à "1", autorise l'envoi de SMS supérieur à 160 caractères (SMS Premium uniquement).
     * Un SMS vous sera facturé tous les 153 caractères.
     * Exemple : pour un message de 300 caractères à 1000 destinataires, 2000 SMS vous seront débités.
     * Maximum 5 SMS concaténés (soit 765 caractères).
     *
     * @var boolean $smslong
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $smslong;

    /**
     * Optionnel
     * Permet de vérifier la taille du SMS long envoyé. Vous devez envoyer le nombre de SMS concaténés comme valeur. Si
     * notre compteur nous indique un nombre différent, votre message sera rejeté.
     *
     * @var int $smslongnbr
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $smslongnbr;

    /**
     * Optionnel
     * Si égal à "1", tronque automatiquement le message à 160 caractères.
     *
     * @var boolean $tronque
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $tronque;

    /**
     * Optionnel
     * si égal à "auto", conversion de votre message en UTF-8 (il est conseillé de convertir votre message en UTF-8
     * dans votre application cependant si votre message reste coupé après un caractère accentué, vous pouvez activer
     * ce paramètre).
     *
     * @var string $encodage
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $encodage;

    /**
     * Optionnel
     * Cette information non visible par les destinataires vous permet d’identifier votre campagne
     * (maximum 255 caractères).
     *
     * @var string $nom
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $nom;

    /**
     * Optionnel
     * Permet la sélection de contacts déjà enregistrés sur le compte client :
     * - "all"    => sélection de tous les contacts du compte.
     * - "groupe" => sélection de tous les contacts du groupe id fournit dans le champs $destinataires
     * - "datas"  => permet d'ajouter des données personnalisées aux $destinatires pour les utiliser dans votre
     * message (exemple : "Bonjour {nom} {prenom}"), pour ce faire il faut que le champs $destinataires soit un tableau
     * de cette forme :
     * array(
     *      "+33600000001" => array(
     *          "nom" => "Nom 1",
     *          "prenom" => "Prénom 1"
     *      ), "+33600000002" => array(
     *          "nom" => "Nom 2",
     *          "prenom" => "Prénom 2"
     *      ),
     *      ...
     * )
     *
     * @var string $destinatairesType
     *
     * @Assert\Choice(callback="getAvailableDestinatairesTypes")
     * @Assert\NotNull(groups={"Full"})
     */
    protected $destinatairesType;

    /**
     * Optionnel
     * Adresse URL de votre serveur pour la réception en "push" des statuts après l'envoi.
     * Vous devez déjà avoir une adresse paramétrée sur votre compte pour activer les retours "push".
     * Si ce paramètre est renseigné, cette URL sera appelée pour cet envoi sinon l'adresse du compte est utilisée.
     *
     * @var string $url
     *
     * @Assert\NotBlank(groups={"Full"})
     */
    protected $url;

    /**
     * get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * set key
     *
     * @param string $key
     *
     * @return self
     */
    protected function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getAvailableTypes()
    {
        return SmsTypeEnum::getAvailableValues();
    }

    /**
     * set type
     *
     * @param string $type
     *
     * @return self
     */
    protected function setType($type)
    {
        if (!SmsTypeEnum::isValid($type)) {
            throw new \LADR\SmsBundle\Exception\InvalidArgumentException(sprintf("Le type de SMS \"%s\" ne fait parti de la liste des valeurs autorisées : [%s]", $type, implode(', ', SmsTypeEnum::getAvailableValues())));
        }

        $this->type = $type;

        return $this;
    }

    /**
     * get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * set message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * get destinataires
     *
     * @return SmsRecipientInterface[]
     */
    public function getDestinataires()
    {
        return $this->destinataires;
    }

    /**
     * set destinataires
     *
     * @param SmsRecipientInterface[] $destinataires
     *
     * @return self
     */
    public function setDestinataires($destinataires)
    {
        $this->destinataires = $destinataires;

        return $this;
    }

    /**
     * get expediteur
     *
     * @return string
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }

    /**
     * set expediteur
     *
     * @param string $expediteur
     *
     * @return self
     */
    public function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * get date
     *
     * @return \Datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * set date
     *
     * @param \Datetime $date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * is smslong
     *
     * @return boolean
     */
    public function isSmslong()
    {
        return $this->smslong;
    }

    /**
     * set smslong
     *
     * @param boolean $smslong
     *
     * @return self
     */
    public function setSmslong($smslong)
    {
        $this->smslong = $smslong;

        return $this;
    }

    /**
     * get smslongnbr
     *
     * @return int
     */
    public function getSmslongnbr()
    {
        return $this->smslongnbr;
    }

    /**
     * set smslongnbr
     *
     * @param int $smslongnbr
     *
     * @return self
     */
    public function setSmslongnbr($smslongnbr)
    {
        $this->smslongnbr = $smslongnbr;

        return $this;
    }

    /**
     * is tronque
     *
     * @return boolean
     */
    public function isTronque()
    {
        return $this->tronque;
    }

    /**
     * set tronque
     *
     * @param boolean $tronque
     *
     * @return self
     */
    public function setTronque($tronque)
    {
        $this->tronque = $tronque;

        return $this;
    }

    /**
     * get encodage
     *
     * @return string
     */
    public function getEncodage()
    {
        return $this->encodage;
    }

    /**
     * set encodage
     *
     * @param string $encodage
     *
     * @return self
     */
    public function setEncodage($encodage)
    {
        $this->encodage = $encodage;

        return $this;
    }

    /**
     * get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * set nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * get destinatairesType
     *
     * @return string
     */
    public function getDestinatairesType()
    {
        return $this->destinatairesType;
    }

    /**
     * @return array
     */
    public function getAvailableDestinatairesTypes()
    {
        return DestinatairesTypeEnum::getAvailableValues();
    }

    /**
     * set destinatairesType
     *
     * @param string $destinatairesType
     *
     * @return self
     */
    public function setDestinatairesType($destinatairesType)
    {

        if (!DestinatairesTypeEnum::isValid($destinatairesType)) {
            throw new \LADR\SmsBundle\Exception\InvalidArgumentException(sprintf("Le type de destinataire \"%s\" ne fait parti de la liste des valeurs autorisées : [%s]", $destinatairesType, implode(', ', DestinatairesTypeEnum::getAvailableValues())));
        }

        $this->destinatairesType = $destinatairesType;

        return $this;
    }

    /**
     * get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }


}