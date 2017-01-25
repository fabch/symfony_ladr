<?php
namespace LADR\SecurityBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use LADR\SecurityBundle\Model\SecureContactInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class Access
 * @package LADR\SecurityBundle\Entity
 */
interface AccessInterface extends AdvancedUserInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * @return null
     */
    public function getSalt();

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return array
     */
    public function setRoles($roles);

    /**
     * Add role
     *
     * @param string $role
     * @return $this
     */
    public function addRole($role);

    /**
     * Remove role
     *
     * @param $role
     * @return $this
     */
    public function removeRole($role);

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username);


    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password);

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword();

    /**
     * set plain password
     *
     * @return string
     */
    public function setPlainPassword($plainPassword);

    /**
     * get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description);



    /**
     * Erase credentials
     */
    public function eraseCredentials();

    /**
     * Set enabled
     *
     * @param $enabled
     *
     * @return bool
     */
    public function setEnabled($enabled);

    /**
     * Is enabled
     *
     * @return bool
     */
    public function isEnabled();


    /**
     * get createdAt
     *
     * @return \Datetime
     */
    public function getCreatedAt();

    /**
     * set createdAt
     *
     * @param \Datetime $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt);

    /**
     * get lastLogin
     *
     * @return mixed
     */
    public function getLastLogin();

    /**
     * set lastLogin
     *
     * @param mixed $lastLogin
     * @return self
     */
    public function setLastLogin($lastLogin);

    /*
     * @TODO Implémenter les méthodes isAccountNonExpired, isAccountNonLocked, isCredentialsNonExpired
     */
    public function isAccountNonExpired();

    public function isAccountNonLocked();

    public function isCredentialsNonExpired();

    /** @see \Serializable::serialize() */
    public function serialize();

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized);

}
