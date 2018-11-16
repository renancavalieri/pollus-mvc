<?php declare(strict_types=1);

/**
 * Pollus MVC
 * 
 * @copyright (c) 2018, Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://github.com/renancavalieri/pollus-mvc GitHub
 */

namespace Pollus\Mvc\Exceptions;

/**
 * Esta Exception é lançada sempre que o sistema tenta acessar uma variável
 * inexistente dentro da View utilizando função Get();
 */
class ViewVariableException extends \Exception {}
