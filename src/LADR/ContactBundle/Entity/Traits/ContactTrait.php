<?php
namespace LADR\ContactBundle\Entity\Traits;

use Symfony\Component\Validator\Constraints as Assert;

trait ContactTrait
{

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string",length=255, nullable=true)
     */
    protected $mobile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string",length=255, nullable=true)
     */
    protected $phone;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = mb_strtoupper($firstName);
        return $this;
    }

    /**
     * Set lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = mb_strtoupper($lastName);
        return $this;
    }

    /**
     * Set fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string|null
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set mobile
     *
     * @param string|null $mobile
     * @return self
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param string|null $phone
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Set createdAt
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get createdAt
     *
     * @param \DateTime|null $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}