<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\CompanyBundle\Model\CompanyInterface;
use LADR\CompanyBundle\Model\AbstractCompany;
use LADR\CompanyBundle\Entity\Traits\CompanyTrait;

/**
 * Company
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="app_company")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="LADR\CompanyBundle\Repository\CompanyRepository")
 */
class Company extends AbstractCompany implements CompanyInterface
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}
