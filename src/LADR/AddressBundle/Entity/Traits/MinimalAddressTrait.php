<?php
namespace LADR\AddressBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\AddressBundle\Validator\Constraints as AddressAssert;

trait MinimalAddressTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string",length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string",length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="addr", type="string", length=255, nullable=true)
     */
    private $addr;

    /**
     * @var string
     *
     * @ORM\Column(name="addr_comp", type="string", length=255, nullable=true)
     */
    private $addrComp;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     * @Assert\Country()
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=255, nullable=true)
     * @AddressAssert\ZipCode(iso_property="country", groups={"Strict"})
     */
    private $postalCode;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Set addr
     *
     * @param string $addr
     * @return self
     */
    public function setAddr($addr)
    {
        $this->addr = mb_strtoupper($addr);

        return $this;
    }

    /**
     * Get addr
     *
     * @return string
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * Set addrComp
     *
     * @param string $addrComp
     * @return self
     */
    public function setAddrComp($addrComp)
    {
        $this->addrComp = mb_strtoupper($addrComp);

        return $this;
    }

    /**
     * Get addrComp
     *
     * @return string
     */
    public function getAddrComp()
    {
        return $this->addrComp;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return self
     */
    public function setCity($city)
    {
        $this->city = mb_strtoupper($city);

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = mb_strtoupper($country);

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode =  mb_strtoupper($postalCode);

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
}