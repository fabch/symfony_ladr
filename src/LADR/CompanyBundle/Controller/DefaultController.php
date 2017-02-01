<?php

namespace LADR\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LADRCompanyBundle:Default:index.html.twig');
    }
}
