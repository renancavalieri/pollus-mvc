<?php declare(strict_types=1);

/**
 * Pollus MVC
 * @copyright (c) Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Pollus\Mvc\ApplicationInterfaces;

use Psr\Container\ContainerInterface;

interface ApplicationInterface 
{
    /**
     * Returns the application config
     * 
     * @return array
     */
    public function getConfigArray() : array;
    
    /**
     * Setup the application dependencies
     * 
     * @param ContainerInterface $container
     */
    public function setupDependencies(ContainerInterface $container);
}