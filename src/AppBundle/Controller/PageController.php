<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Florian Weber <florian.weber@fweber.info>
 */
class PageController extends Controller
{
    public function landingAction()
    {
        return $this->render('Page/landing.html.twig');
    }
}
