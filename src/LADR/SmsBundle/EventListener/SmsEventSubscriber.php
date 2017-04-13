<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 12/04/17
 * @time   : 15:25
 */
namespace LADR\SmsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SmsEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'prePersist'
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }
}