<?php
namespace LADR\SecurityBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class AccessRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('a')
            ->where('a.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getMaxId()
    {
        return $this->createQueryBuilder('a')
            ->select('COALESCE(MAX(a.id),0)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}