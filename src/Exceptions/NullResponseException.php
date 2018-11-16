<?php declare(strict_types=1);

/**
 * Pollus MVC
 * 
 * @copyright (c) 2018, Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://github.com/renancavalieri/pollus-mvc GitHub
 */

namespace Pollus\Mvc\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * Esta Exception é lançada sempre que a View tenta executar o método Render() ou
 * RenderBlock() sem ter informado a implementação da {@see ResponseInterface}
 */
class NullResponseException extends \Exception {}
