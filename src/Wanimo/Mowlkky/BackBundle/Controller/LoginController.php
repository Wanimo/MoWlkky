<?php

namespace Wanimo\Mowlkky\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Controller for login action
 * @package Wanimo\Mowlkky\BackBundle\Controller
 */
class LoginController extends Controller
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * LoginController constructor.
     * @param EngineInterface $templating
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(EngineInterface $templating, AuthenticationUtils $authenticationUtils)
    {
        $this->templating = $templating;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        // get the login error if there is one
        $error = $this->authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $this->templating->renderResponse(
            'BackBundle:Login:login.html.twig',
            [
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            ]
        );
    }
}