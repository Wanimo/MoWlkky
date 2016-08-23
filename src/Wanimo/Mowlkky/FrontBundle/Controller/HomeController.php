<?php

namespace Wanimo\Mowlkky\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HomeController
 * @package Wanimo\Mowlkky\FrontBundle\Controller
 */
class HomeController extends Controller
{
    /**
     * Home page of the front office.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('FrontBundle:Home:index.html.twig', []);
    }
}
