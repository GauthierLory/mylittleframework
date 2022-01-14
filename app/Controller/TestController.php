<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TestController {

    function __construct(private Environment $environment) {}

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    function __invoke(Request $request): Response {
        return new Response(
            $this->environment->render('test.html.twig', ['message' => 'test controller'])
        );
    }
}