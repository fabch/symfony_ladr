<?php
namespace LADR\ContactBundle\Model;

use AppBundle\Entity\Contact;
use Doctrine\Common\Collections\Collection;

interface HasMultipleContactInterface
{
    /**
     * Get Contacts
     *
     * @return Collection|Contact[]
     */
    public function getContacts();

    /**
     * Set Contacts
     *
     * @param Collection|Contact[] $contacts
     * @return self
     */
    public function setContacts(Collection $contacts);

    /**
     * Add contact
     *
     * @param Contact $contact
     * @return self
     */
    public function addContact(Contact $contact);

    /**
     * remove contact
     *
     * @param Contact $contact
     * @return self
     */
    public function removeContact(Contact $contact);
}