<?php

/*
 * Original file : https://github.com/tuupola/slim-jwt-auth
 *
 * Retreive jwt and add in request attribute.
 *
 */

namespace Lib\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Middleware\JwtAuthentication;

class JwtError
{

    /**
     * Call the middleware
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param callable $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        return $response->redirect($app->urlFor('frontend.auth.registration'), 303);
    }

}
