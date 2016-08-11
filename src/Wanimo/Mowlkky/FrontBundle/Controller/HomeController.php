<?php

namespace Wanimo\Mowlkky\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package Wanimo\Mowlkky\FrontBundle\Controller
 */
class HomeController extends Controller
{
    /**
     * Home page of the front office.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('FrontBundle:Home:index.html.twig', []);
    }
}
