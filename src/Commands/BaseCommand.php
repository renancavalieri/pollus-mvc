<?php declare(strict_types=1);

/**
 * Pollus MVC
 * @copyright (c) Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Pollus\Mvc\Commands;

use Symfony\Component\Console\Command\Command;
use Psr\Container\ContainerInterface;

abstract class BaseCommand extends Command
{
    /**
     * @var ContainerInterface 
     */
    protected $container;
    
    public function __construct(ContainerInterface $container) 
    {
        parent::__construct();
        $this->container = $container;
    }
}