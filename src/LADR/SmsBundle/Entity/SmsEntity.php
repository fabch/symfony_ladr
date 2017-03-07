<?php
namespace LADR\SmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     */
    public function __construct()
    {
        
    }
}