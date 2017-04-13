<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date: 17/02/16
 * @time: 00:12
 */

namespace LADR\AddressBundle\Model;

use Doctrine\Common\Collections\Collection;
use LADR\AddressBundle\Entity\Address;

interface HasMultipleAddressInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return Collection|Address[]
     */
    public function getAddresses();

    /**
     * @param Collection|Address[] $addresses
     * @return self
     */
    public function setAddresses(Collection $addresses);

    /**
     * @param Address $address
     * @return self
     */
    public function addAddress(Address $address);

    /**
     * @param Address $address
     * @return self
     */
    public function removeAddress(Address $address);
}