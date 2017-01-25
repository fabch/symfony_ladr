<?php
namespace LADR\SecurityBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Interface AccessesSubjectInterface
 * @package LADR\SecurityBundle\Model
 */
interface AccessesSubjectInterface extends \Serializable
{
    /**
     * Set Accesses
     *
     * @return Collection|\LADR\SecurityBundle\Entity\Access[]
     */
    public function getAccesses();

    /**
     * set Accessess
     *
     * @param Collection|\LADR\SecurityBundle\Entity\Access[] $accesses
     * @return self
     */
    public function setAccesses($accesses);

    /**
     * add Access
     *
     * @param \LADR\SecurityBundle\Entity\Access $access
     * @return self
     */
    public function addAccess(\LADR\SecurityBundle\Entity\Access $access);

    /**
     * remove Access
     *
     * @param \LADR\SecurityBundle\Entity\Access $access
     * @return self
     */
    public function removeAccess(\LADR\SecurityBundle\Entity\Access $access);
}