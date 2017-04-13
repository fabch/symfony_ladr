<?php
namespace LADR\SmsBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LADR\SmsBundle\Model\SmsRecipientInterface;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\SmsBundle\Model\SmsAbstract;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum;

/**
 * Class SmsEntity
 * @package LADR\SmsBundle\Entity
 *
 * @ORM\Table(name="ladr_sms")
 * @ORM\Entity()
 */
class SmsEntity extends SmsAbstract
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
     * Constructor
     *
     * @param string $key
     * @param string $type
     */
    public function __construct($key, $type)
    {

        parent::__construct();
        $this->setApiKey($key);
        $this->setType($type);
        $this->setSmslong(true);
        $this->setTronque(false);
        $this->setDestinatairesType('datas');
        $this->setEncodage('auto');
    }

    /**
     * Liste de numéros de vos destinataires (tableau ou séparé par un retour à la ligne ou une virgule)
     * ex : +33600000000,003360-00-00-00 , 6 00 00 00 00
     *
     * @var Collection|SmsRecipientEntity[] $destinataires
     *
     * @ORM\OneToMany(targetEntity="SmsRecipientEntity", mappedBy="sms", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     */
    protected $destinataires;

    /**
     * get destinataires
     *
     * @return Collection|SmsRecipientEntity[]
     */
    public function getDestinataires()
    {
        return $this->destinataires;
    }

    /**
     * set destinataires
     *
     * @param Collection|SmsRecipientEntity[] $destinataires
     *
     * @return self
     */
    public function setDestinataires($destinataires)
    {
        $this->destinataires = $destinataires;

        return $this;
    }
}