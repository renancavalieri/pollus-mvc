<?php declare(strict_types=1);

/**
 * Pollus MVC
 * 
 * @copyright (c) 2018, Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://github.com/renancavalieri/pollus-mvc GitHub
 */

namespace Pollus\Mvc\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Container\ContainerInterface;
use Pollus\Mvc\Views\ViewInterface;
use Psr\Http\Message\ResponseInterface;
use Pollus\Slim\Controller\Controller;
use Pollus\Slim\Controller\ControllerInterface;

/**
 * Implementação abstrata da interface {@see ControllerInterface} para servir
 * de base para os controllers
 * 
 * Esta implementação popula as variáveis protegidas do Controller e verifica
 * se o container possui a chave "view", caso positivo ela será atribuída
 * à variável $view e seu objeto de resposta será definido.
 */
abstract class MvcController extends Controller implements ControllerInterface
{
    /**
     * @var ViewInterface
     */
    protected $view;
    
    /**
     * Inicia um novo controller, popula as variáveis protegidas e atribui a 
     * view dentro do container (caso existente na chave "view") à variável $view
     * do objeto.
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param ContainerInterface $container
     */
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
