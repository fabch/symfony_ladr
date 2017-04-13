<?php
namespace LADR\SmsBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class SmsAbstract
 * @package LADR\SmsBundle\Model
 * @see http://www.spot-hit.fr/documentation-api
 *
 * @UniqueEntity("spotHitId")
 */
abstract class SmsAbstract implements SmsInterface
{
    /**
     * Votre clé API d'identification
     *
     * @var string $apiKey
     * @ORM\Column(type="string", length=32, nullable=false)
     * @Assert\NotBlank(groups={"Premium","Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $apiKey;

    /**
     * Type de SMS : "premium" ou "lowcost"
     *
     * Premium : Accusé de réception, Personnalisation de l'expéditeur, Envoi rapide
     * Low Cost : Pas d'accusé de réception, Expéditeur aléatoire (ex : 0600000000), Délai d'envoi variable
     * (une minute à plusieurs heures)
     *
     * @var string $type
     *
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Choice(callback="getAvailableTypes")
     * @Assert\NotNull(groups={"Premium","Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $type;

    /**
     * Identifiant unique spotHit
     *
     * @var int $spotHitId
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $spotHitId;

    /**
     * Limité à 160 caractères (ou voir paramètre smslong).
     * Attention : Les caractères "|", "^", "€", "}", "{", "[", "~", "]", "\" comptent doubles.
     * SMS Personnalisé : Bonjour {nom} {prenom}, exemple : array("nom","prenom");
     *
     * @var string $message
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(groups={"Premium","Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $message;

    /**
     * Listedes tokens utilisés pour les paramètres des sms personnalisés qui seront récupérés sur les destinataires
     * SMS Personnalisé : {Nom de la colonne}, exemple : {Nom}
     *
     * @var array|string[] $message
     * @ORM\Column(type="simple_array", nullable=true)
     * @Assert\NotBlank(groups={"Premium","Full"})
     */
    protected $paramKeys;

    /**
     * Liste de numéros de vos destinataires (tableau ou séparé par un retour à la ligne ou une virgule)
     * ex : +33600000000,003360-00-00-00 , 6 00 00 00 00
     *
     * @var Collection|SmsRecipientInterface[] $destinataires
     * @Assert\NotBlank(groups={"Premium","Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $destinataires;

    /**
     * Optionnel (uniquement SMS Premium) 11 caractères maximum (espaces inclus)
     * Si vide, l'expéditeur de votre SMS sera un numéro court à 5 chiffres auxquels vos destinataires peuvent répondre.
     *
     * @var string $expediteur
     * @ORM\Column(type="string", length=11, nullable=true)
     * @Assert\NotBlank(groups={"Premium","Full"})
     * @Assert\Length(max="11", groups={"Premium","Full"})
     * @Groups({"premium"})
     */
    protected $expediteur;

    /**
     * Date de création du sms dans la base de donnée
     *
     * @var \Datetime $createdAt
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * Date d'envoi à l'api SpotHit
     *
     * @var \Datetime $transmittedAt
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $transmittedAt;

    /**
     * Optionnel
     * Date d'envoi du message (format timestamp) Si aucune date n'est entrée ou si celle-ci précède la date
     * actuelle, le message sera envoyé immédiatement
     *
     * @var \Datetime $date
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank(groups={"Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $scheduledAt;

    /**
     * Optionnel
     * Si égal à "1", autorise l'envoi de SMS supérieur à 160 caractères (SMS Premium uniquement).
     * Un SMS vous sera facturé tous les 153 caractères.
     * Exemple : pour un message de 300 caractères à 1000 destinataires, 2000 SMS vous seront débités.
     * Maximum 5 SMS concaténés (soit 765 caractères).
     *
     * @var boolean $smslong
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotBlank(groups={"Full"})
     * @Groups({"premium"})
     */
    protected $smslong;

    /**
     * Optionnel
     * Permet de vérifier la taille du SMS long envoyé. Vous devez envoyer le nombre de SMS concaténés comme valeur. Si
     * notre compteur nous indique un nombre différent, votre message sera rejeté.
     *
     * @var int|null $smslongnbr
     */
    protected $smslongnbr;

    /**
     * Optionnel
     * Si égal à "1", tronque automatiquement le message à 160 caractères.
     *
     * @var boolean $tronque
     *
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @Assert\NotBlank(groups={"Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $tronque;

    /**
     * Optionnel
     * si égal à "auto", conversion de votre message en UTF-8 (il est conseillé de convertir votre message en UTF-8
     * dans votre application cependant si votre message reste coupé après un caractère accentué, vous pouvez activer
     * ce paramètre).
     *
     * @var string $encodage
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(groups={"Full"})
     * @Groups({"premium", "lowcost"})
     */
    protected $encodage;

    /**
     * Optionnel
     * Cette information non visible par les destinataires vous permet d’identifier votre campagne
     * (maximum 255 caractères).
     *
     * @var string $nom
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"Full"})
     * @Groups({"premium"})
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
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Choice(callback="getAvailableDestinatairesTypes")
     * @Assert\NotNull(groups={"Full"})
     * @Groups({"premium"})
     */
    protected $destinatairesType;

    /**
     * Optionnel
     * Adresse URL de votre serveur pour la réception en "push" des statuts après l'envoi.
     * Vous devez déjà avoir une adresse paramétrée sur votre compte pour activer les retours "push".
     * Si ce paramètre est renseigné, cette URL sera appelée pour cet envoi sinon l'adresse du compte est utilisée.
     *
     * @var string $url
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"Full"})
     * @Groups({"premium"})
     */
    protected $url;

    /**
     *
     */
    public function __construct()
    {
        $this->destinataires = new ArrayCollection();
    }

    /**
     * get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * set apiKey
     *
     * @param string $apiKey
     *
     * @return self
     */
    protected function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

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
    public static function getAvailableTypes()
    {
        return SmsTypeEnum::getAvailableValues();
    }

    /**
     * get spotHitId
     *
     * @return int
     */
    public function getSpotHitId()
    {
        return $this->spotHitId;
    }

    /**
     * set spotHitId
     *
     * @param int $spotHitId
     *
     * @return self
     */
    public function setSpotHitId($spotHitId)
    {
        $this->spotHitId = $spotHitId;

        return $this;
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
     * get paramKeys
     *
     * @return array|string[]
     */
    public function getParamKeys()
    {
        return $this->paramKeys;
    }

    /**
     * set paramKeys
     *
     * @param array|string[] $paramKeys
     *
     * @return self
     */
    public function setParamKeys($paramKeys)
    {

        $this->paramKeys = array_values(array_unique($paramKeys));
        sort($this->paramKeys);
        return $this;
    }

    /**
     * add paramKey
     *
     * @param string $paramKey
     *
     * @return self
     */
    public function addParamKey($paramKey)
    {
        if(($key = array_search($paramKey, $this->paramKeys)) === false) {
            $this->paramKeys[] = $paramKey;
        }
        sort($this->paramKeys);

        return $this->paramKeys;
    }

    /**
     * add paramKey
     *
     * @param string $paramKey
     *
     * @return self
     */
    public function removeParamKey($paramKey)
    {
        if(($key = array_search($paramKey, $this->paramKeys)) !== false) {
            unset($this->paramKeys[$key]);
        }
        sort($this->paramKeys);

        return $this->paramKeys;
    }

    /**
     * get destinataires
     *
     * @return Collection|SmsRecipientInterface[]
     */
    public function getDestinataires()
    {
        return $this->destinataires;
    }

    /**
     * set destinataires
     *
     * @param SmsRecipientInterface $destinataire
     *
     * @return self
     */
    public function addDestinataire($destinataire)
    {
        $this->destinataires->add($destinataire);

        return $this;
    }

    /**
     * get destinataires
     *
     * @return SmsRecipientInterface
     */
    public function removeDestinataire($destinataire)
    {
        return $this->destinataires->removeElement($destinataire);
    }

    /**
     * set destinataires
     *
     * @param Collection|SmsRecipientInterface[] $destinataires
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
     * get createdAt
     *
     * @return \Datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * set createdAt
     *
     * @param \Datetime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * get transmittedAt
     *
     * @return \Datetime|null
     */
    public function getTransmittedAt()
    {
        return $this->transmittedAt;
    }

    /**
     * set transmittedAt
     *
     * @param \Datetime|null $transmittedAt
     *
     * @return self
     */
    public function setTransmittedAt($transmittedAt)
    {
        $this->transmittedAt = $transmittedAt;

        return $this;
    }

    /**
     * get transmittedAt
     *
     * @return \Datetime|null
     */
    public function isTransmitted()
    {
        return $this->transmittedAt !== null;
    }

    /**
     * get $scheduledAt
     *
     * @return \Datetime|null
     */
    public function getScheduledAt()
    {
        return $this->scheduledAt;
    }

    /**
     * set date
     *
     * @param \Datetime|null $scheduledAt
     *
     * @return self
     */
    public function setScheduledAt($scheduledAt)
    {
        $this->scheduledAt = $scheduledAt;

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
    public static function getAvailableDestinatairesTypes()
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