<?php
namespace LADR\CompanyBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use LADR\CompanyBundle\Entity\Traits\CompanyTrait;
use AppBundle\Entity\Company;

/**
 * Class AbstractCompany
 *
 * @package LADR\CompanyBundle\Model
 */
abstract class AbstractCompany implements CompanyInterface
{
    use CompanyTrait;
}