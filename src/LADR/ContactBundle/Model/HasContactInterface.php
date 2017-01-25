<?php
namespace LADR\ContactBundle\Model;

use AppBundle\Entity\Contact;

interface HasContactInterface
{
    /**
     * Get contact
     *
     * @return Contact
     */
    public function getContact();

    /**
     * Set contact
     *
     * @param Contact $contact
     * @return self
     */
    public function setContact(Contact $contact);

}