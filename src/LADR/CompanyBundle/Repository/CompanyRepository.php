<?php

namespace LADR\CompanyBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CompanyRepository extends NestedTreeRepository
{

}