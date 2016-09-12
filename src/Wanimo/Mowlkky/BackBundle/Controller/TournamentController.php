<?php

namespace Wanimo\Mowlkky\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for tournament management
 * @package Wanimo\Mowlkky\BackBundle\Controller
 */
class TournamentController extends Controller
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * TournamentController constructor.
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