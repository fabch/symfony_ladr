<?php
namespace LADR\SmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LADR\SmsBundle\Model\SmsRecipientAbstract;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\SmsBundle\Model\SmsAbstract;
use LADR\SmsBundle\Utils\Enum\SmsTypeEnum;
use LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum;

/**
 * Class SmsEntity
 * @package LADR\SmsBundle\Entity
 *
 * @ORM\Table(name="europole_client")
 * @ORM\Entity()
 * @Assert\GroupSequence({"Default","Premium","Full"})
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
     * Constructor
     *
     * @param string $key
     * @param string $type
     */
    public function __construct()
    {
    }
}