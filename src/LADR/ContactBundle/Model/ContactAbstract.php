<?php
namespace LADR\ContactBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use LADR\ContactBundle\Entity\Traits\ContactTrait;

/**
 * Class ContactAbstract
 * @package LADR\ContactBundle\Model
 */
abstract class ContactAbstract implements ContactInterface
{
    use ContactTrait;

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->mobile,
            $this->phone
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->mobile,
            $this->phone
            ) = unserialize($serialized);
    }
}