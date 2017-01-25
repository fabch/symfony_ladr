<?php
namespace LADR\SecurityBundle\Model;

use AppBundle\Entity\Access;
use Doctrine\Common\Collections\Collection;

/**
 * Interface HasMultipleAccessInterface
 * @package LADR\SecurityBundle\Model
 */
interface HasMultipleAccessInterface extends \Serializable
{
    /**
     * Set Accesses
     *
     * @return Collection|Access[]
     */
    public function getAccesses();

    /**
     * set Accessess
     *
     * @param Collection|Access[] $accesses
     * @return self
     */
    public function setAccesses($accesses);

    /**
     * add Access
     *
     * @param Access $access
     * @return self
     */
    public function addAccess(Access $access);

    /**
     * remove Access
     *
     * @param Access $access
     * @return self
     */
    public function removeAccess(Access $access);
}