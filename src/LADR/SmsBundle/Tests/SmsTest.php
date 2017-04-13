<?php
namespace LADR\SmsBundle\Tests;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use LADR\SmsBundle\Entity\SmsEntity;
use LADR\SmsBundle\Entity\SmsRecipientEntity;
use LADR\SmsBundle\Services\SmsService;
use LADR\SmsBundle\Sms\SmsFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class SmsTest
 * @package LADR\SmsBundle\Tests
 */
class SmsTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var SmsService
     */
    private $smsService;

    /**
     * @var SmsFactory
     */
    private $smsFactory;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->smsService = static::$kernel->getContainer()->get('ladr_sms.sms_service');
        $this->smsFactory = static::$kernel->getContainer()->get('ladr_sms.sms_factory');
    }

    /**
     *
     */
    public function testAddSms()
    {

        $destinataire = new SmsRecipientEntity();
        $destinataire->setPhoneNumber('06 67 32 20 77');

        $sms = $this->smsFactory->create();
        $sms->setMessage('Test de message non personnalisé');
        $sms->setDestinataires(array($destinataire));

        $this->smsService->normalizeSms($sms);


    }
}