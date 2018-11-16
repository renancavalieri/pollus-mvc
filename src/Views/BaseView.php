<?php declare(strict_types=1);

/**
 * Pollus MVC
 * 
 * @copyright (c) 2018, Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://github.com/renancavalieri/pollus-mvc GitHub
 */

namespace Pollus\Mvc\Views;

use Psr\Http\Message\ResponseInterface;
use Pollus\Mvc\Exceptions\ViewVariableException;

/**
 * {@inheritDoc}
 * 
 * Esta implementação fornece métodos comuns para as Views.
 */
abstract class BaseView implements ViewInterface, \ArrayAccess, \Countable
{
    /**
     * @var array
     */
    protected $vars;
    
    /**
     * @var ResponseInterface
     */
    protected $response;
    
    /**
     * {@inheritDoc}
     */
    public function clear() : ViewInterface
    {
        $this->vars = [];
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(): ResponseInterface 
    {
        return $this->response;
    }

    /**
     * {@inheritDoc}
     */
    public function merge(array $values) : ViewInterface
    {
        $this->vars = array_merge($this->vars, $values);
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setResponse(ResponseInterface $response) : ViewInterface
    {
        $this->response = $response;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key) 
    {
        $result = $this->vars[$key] ?? null;
        
        if ($result === null)
        {
            throw new ViewVariableException("A chave solicitada não existe");
        }
        
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, $value) : ViewInterface
    {
        $this->vars[$key] = $value;
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function replace(array $values) : ViewInterface
    {
        $this->vars = $values;
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function asJson(array $vars = array(), bool $preserve_existing = false): ResponseInterface 
    {
        if ($preserve_existing === true)
        {
            $vars = array_merge($this->vars, $vars);
        }
        
        $newresponse = $this->response->withHeader
        (
            'Content-type',
            'application/json; charset=utf-8'
        )
        ->write(json_encode($vars));
        
        return $newresponse;
    }

    /**
     * Conta a quantidade de variáveis dentro da view
     * 
     * @return int
     */
    public function count(): int
    {
        return count($this->vars);
    }

    /**
     * Verifica se determinada chave existe na view
     * 
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return (isset($this->vars[$offset])) ? true : false;
    }

    /**
     * Retorna uma variável armazenada na view
     * 
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->vars[$offset];
    }

    /**
     * Define uma variável na view
     * 
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        $this->vars[$offset] = $value;
    }

    /**
     * Remove uma variável da view
     * 
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->vars[$offset]);
    }

}
