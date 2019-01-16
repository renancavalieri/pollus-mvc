<?php declare(strict_types=1);

/**
 * Pollus MVC
 * @copyright (c) Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Pollus\Mvc\ApplicationInterfaces;

use Psr\Container\ContainerInterface;
use Slim\App;

/**
 * Web Application Interface
 */
interface WebAppInterface 
{
    /**
     * This method should instance all needed middlewares for the web application
     * 
     * @param App $slim
     * @param ContainerInterface $container
     */
    public function setupMiddlewares(App $slim, ContainerInterface $container);
    
    /**
     * This method should instance all needed routes for the web application
     * 
     * @param App $slim
     * @param ContainerInterface $container
     */
    public function setupRoutes(App $slim, ContainerInterface $container);
    
    /**
     * This method may override the error handling of Slim Framework
     * 
     * @param ContainerInterface $container
     */
    public function setupErrorHandler(ContainerInterface $container);
}