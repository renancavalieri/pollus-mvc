<?php declare(strict_types=1);

/**
 * Pollus MVC
 * @copyright (c) Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Pollus\Mvc\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Pollus\Slim\Controller\Controller;
use Pollus\Slim\Controller\ControllerInterface;
use Pollus\ViewInterface\ViewInterface;

abstract class MvcController extends Controller implements ControllerInterface
{
    /**
     * @var ViewInterface
     */
    protected $view;
    
    function __construct(ServerRequestInterface $request, ResponseInterface $response, ContainerInterface $container)
    {
        parent::__construct($request, $response, $container);
        if ($this->container->has('view'))
        {
            $this->view = $this->container->get('view');
            $this->view->setResponse($this->response);
        }
    }
}