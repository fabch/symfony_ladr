<?php
namespace LADR\SmsBundle\Services;

use Doctrine\ORM\EntityManager;
use LADR\SmsBundle\Model\SmsInterface;
use LADR\SmsBundle\Utils\PhoneFormater;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 10:36
 */
class SmsService
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var PhoneFormater
     */
    private $phoneFormater;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EntityManager $em
     * @param PhoneFormater $phoneFormater
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EntityManager $em, PhoneFormater $phoneFormater, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $em;
        $this->phoneFormater = $phoneFormater;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function send(SmsInterface $smsInterface){

    }
}