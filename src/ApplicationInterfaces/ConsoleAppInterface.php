<?php declare(strict_types=1);

/**
 * Pollus MVC
 * @copyright (c) Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Pollus\Mvc\ApplicationInterfaces;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

/**
 * Console application interface
 */
interface ConsoleAppInterface
{    
    /**
     * Setup the application commands
     * 
     * @param Application $app
     * @param ContainerInterface $container
     */
    public function setupCommands(Application $app, ContainerInterface $container);
}
