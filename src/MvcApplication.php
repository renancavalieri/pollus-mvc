<?php declare(strict_types=1);

/**
 * Pollus MVC
 * @copyright (c) Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Pollus\Mvc;

use Slim\App;
use Slim\Container;
use Symfony\Component\Console\Application;
use Pollus\Mvc\ApplicationInterfaces\ApplicationInterface;
use Pollus\Mvc\ApplicationInterfaces\ConsoleAppInterface;
use Pollus\Mvc\ApplicationInterfaces\WebAppInterface;

/**
 * Mvc Application Base
 */
abstract class MvcApplication implements ApplicationInterface
{
    /**
     * Executes the application
     */
    public function run()
    {
        if (PHP_SAPI === 'cli' && is_subclass_of($this, ConsoleAppInterface::class))
        {
            $this->execConsoleApp();
        }
        else if (is_subclass_of($this, WebAppInterface::class))
        {
            $this->execWebApp();
        }
        else
        {
            throw new \Exception("No interface was implemented");
        }
    }
    
    /**
     * Executes a web application
     */
    protected function execWebApp()
    {
        $config = $this->getConfigArray();
        $container = new Container(["settings" => $config]);
        $app = new App($container);
        $this->setupDependencies($container);
        $this->setupMiddlewares($app, $container);
        $this->setupErrorHandler($container);
        $this->setupRoutes($app, $container);
        $app->run();
    }
    
    /**
     * Executes a console application
     */
    protected function execConsoleApp()
    {
        $app = new Application();
        $config = $this->getConfigArray();
        $container = new Container(["settings" => $config]);
        $this->setupDependencies($container);
        $this->setupCommands($app, $container);
        $app->run();
    }
}