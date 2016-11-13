<?php

namespace Wanimo\Mowlkky\BackBundle\Controller\Tournament;

use RulerZ\Spec\AndX;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Wanimo\Mowlkky\CoreBundle\Specification\RulerZAdaptor;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentRepository;
use Wanimo\Mowlkky\CoreDomain\Tournament\Specification as TournSpec;

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
     * @var TournamentRepository
     */
    private $tournamentRepository;

    /**
     * IndexController constructor.
     * @param EngineInterface $templating
     * @param TournamentRepository $tournamentRepository
     */
    public function __construct(EngineInterface $templating, TournamentRepository $tournamentRepository)
    {
        $this->templating = $templating;
        $this->tournamentRepository = $tournamentRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $specification = new AndX();

        $specification->addSpecification(
            new TournSpec\NamedLike('%U%')
        );

        $tournaments = $this->tournamentRepository->match(new RulerZAdaptor($specification));

        return $this->templating->renderResponse(
            'BackBundle:Tournament:index.html.twig',
            [
                'tournaments' => $tournaments
            ]
        );
    }
}