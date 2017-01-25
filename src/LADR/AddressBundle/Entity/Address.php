<?php

namespace LADR\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\AddressBundle\Validator\Constraints as AddressAssert;

/**
 * Address
 *
 * @ORM\Table(name="ladr_address")
 * @ORM\Entity()
 * @Assert\GroupSequence({"Address", "Strict"})
 */
class Address
{
    const MAIN = 1;
    const BILLING = 2;
    const DELIVERY = 3;

    /**
     * @return array
     */
    public static function getRoleList() {
        return array(
            'MAIN'     => self::MAIN,
            'BILLING'  => self::BILLING,
            'DELIVERY' => self::DELIVERY
        );
    }

    /**
     * @return array
     */
    public static function getRoleConfig() {
        return array(
            self::MAIN     => array('min' => 1),
            self::BILLING  => array('min' => 0),
            self::DELIVERY => array('min' => 0)
        );
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer", nullable=true)
     * @Assert\Choice(callback="getRoleList", message="ladr_address.role.invalid")
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string",length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="firstname", type="string",length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string",length=255, nullable=true)
     */
    private $lastname;
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
     * @var boolean
     *
     * @ORM\Column(name="professional", type="boolean", nullable=false)
     */
    private $professional;

    /**
     * @var boolean
     *
     * @ORM\Column(name="def_addr", type="boolean", nullable=false)
     */
    private $defAddr;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    public function __construct(){
        $this->defAddr = false;
        $this->professional = false;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $role
     * @return Address
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set addr
     *
     * @param string $addr
     * @return Address
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
     * @return Address
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
     * @return Address
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
     * @return Address
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
     * @return Address
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

    /**
     * @return boolean
     */
    public function isProfessional()
    {
        return $this->professional;
    }

    /**
     * @param boolean $professional
     */
    public function setProfessional($professional)
    {
        $this->professional = $professional;
    }

    /**
     * @return boolean
     */
    public function isDefAddr()
    {
        return $this->defAddr;
    }

    /**
     * @param boolean $defAddr
     */
    public function setDefAddr($defAddr)
    {
        $this->defAddr = $defAddr;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function __toString(){
        return implode(' ',array(
            $this->getFirstname(),
            $this->getLastname(),
            $this->getAddr(),
            $this->getAddrComp(),
            $this->getPostalCode(),
            $this->getCity(),
            $this->getCountry()
        ));
    }

    /**
     * @Assert\Callback
     */
/*    public function validate(ExecutionContextInterface $context)
    {
        $pattern = $this->patterns[$this->getCountry()];
        if (!preg_match("/^{$pattern}$/", $this->getPostalCode(), $matches)) {
            $context->buildViolation('Le code postal n\'est pas valide')
                ->setTranslationDomain('validators')
                ->atPath('postalCode')
                ->setParameter('%string%', $this->getPostalCode())
                ->addViolation();
        }
    }*/


}
