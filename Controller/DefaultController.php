<?php

namespace CSF\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CSFCartBundle:Default:index.html.twig');
    }
}
