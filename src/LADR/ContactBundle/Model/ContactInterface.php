<?php
namespace LADR\ContactBundle\Model;

interface ContactInterface extends \Serializable
{
    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstName($firstName);

    /**
     * Set lastName
     *
     * @return string
     */
    public function getLastName();

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName($lastName);


    /**
     * Set createdAt
     *
     * @return \DateTime|null
     */
    public function getCreatedAt();

    /**
     * Set fullName
     *
     * @return string
     */
    public function getFullName();

    /**
     * Get phone
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set phone
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email);

    /**
     * Get mobile
     *
     * @return string|null
     */
    public function getMobile();

    /**
     * Set mobile
     *
     * @param string|null $mobile
     * @return self
     */
    public function setMobile($mobile);


    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     *
     * @param string|null $phone
     * @return self
     */
    public function setPhone($phone);

    /**
     * Get createdAt
     *
     * @param \DateTime|null $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt);
}