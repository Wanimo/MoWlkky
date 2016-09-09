<?php

namespace Wanimo\Mowlkky\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for backend index
 * @package Wanimo\Mowlkky\BackBundle\Controller
 */
class IndexController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * LoginController constructor.
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
            'BackBundle:Index:index.html.twig',
            []
        );
    }
}