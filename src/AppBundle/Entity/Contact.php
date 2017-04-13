<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Mapping as ORM;
use LADR\ContactBundle\Model\ContactAbstract;
use LADR\ContactBundle\Model\ContactInterface;

/**
 * @ORM\Table(name="app_contact")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity()
 */
class Contact extends ContactAbstract implements ContactInterface
{

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\PrePersist
     */
    public function prePersistHandler(LifecycleEventArgs $eventArgs) {
        $this->setCreatedAt(new \DateTime('now'));
    }
}
