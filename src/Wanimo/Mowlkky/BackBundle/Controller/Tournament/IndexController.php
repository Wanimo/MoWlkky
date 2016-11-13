<?php

namespace Wanimo\Mowlkky\BackBundle\Controller\Tournament;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for the tournament management index
 * @package Wanimo\Mowlkky\BackBundle\Controller
 */
class IndexController extends Controller
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * IndexController constructor.
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->templating->renderResponse(
            'BackBundle:Tournament:index.html.twig',
            []
        );
    }
}