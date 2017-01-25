<?php
namespace LADR\SecurityBundle\Model;

use AppBundle\Entity\Access;
use Doctrine\Common\Collections\Collection;

/**
 * Interface HasAccessInterface
 * @package LADR\SecurityBundle\Model
 */
interface HasAccessInterface extends \Serializable
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
     * @return Access
     */
    public function getAccess();

    /**
     * set Access
     *
     * @param  Access $access
     * @return self
     */
    public function setAccess(Access $access);
}