<?php
namespace LADR\SecurityBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Interface AccessSubjectInterface
 * @package LADR\SecurityBundle\Model
 */
interface AccessSubjectInterface extends \Serializable
{

    /**
     * Get first_name
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName();

    /**
     * Set Access
     *
     * @return \LADR\SecurityBundle\Entity\Access
     */
    public function getAccess();

    /**
     * set Access
     *
     * @param  \LADR\SecurityBundle\Entity\Access $access
     * @return self
     */
    public function setAccess($access);
}