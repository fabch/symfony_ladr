<?php
namespace LADR\SecurityBundle\Util;


use Doctrine\ORM\EntityManager;
use LADR\SecurityBundle\Entity\Contact;
use LADR\SecurityBundle\Entity\User;
use LADR\SecurityBundle\Model\AccessesSubjectInterface;
use LADR\SecurityBundle\Model\SecureContactInterface;

class UsernameGenerator
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Generate a username for a given contact
     *
     * @param AccessesSubjectInterface $contact
     * @return string
     */
    public function generateUsernameFor(AccessesSubjectInterface $contact)
    {
        $maxId = $this->em->getRepository('LADRSecurityBundle:Access')->getMaxId();
        return $contact->getFirstName() . $contact->getLastName() . ($maxId + 1);
    }

}