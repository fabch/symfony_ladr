<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date: 17/02/16
 * @time: 00:43
 */

namespace LADR\AddressBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\AddressBundle\Validator\Constraints as AddressAssert;
use LADR\AddressBundle\Entity\Address;

trait HasAddressTrait {

    /**
     * @var Address
     *
     * @ORM\OneToOne(targetEntity="LADR\AddressBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * @Assert\Valid(traverse="true")
     */
    protected $address;


    /**
     * get addresses
     *
     * @return \LADR\AddressBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * set addresses
     *
     * @param \LADR\AddressBundle\Entity\Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }
}