<?php

namespace LADR\SmsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/*
 * @Route("/sms")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="sms_homepage")
     */
    public function indexAction()
    {
        $sms = $this->get('ladr_sms.sms_factory')->create();
        return new Response('OK');
    }
}
