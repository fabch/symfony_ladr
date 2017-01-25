<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LADR\SecurityBundle\Model\AccessAbstract;
use LADR\SecurityBundle\Model\AccessInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="app_access")
 * @ORM\Entity(repositoryClass="LADR\SecurityBundle\Repository\AccessRepository")
 * @UniqueEntity("username")
 */
class Access extends AccessAbstract implements AccessInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

}
