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
 * A View é responsável por renderizar o template solicitado e retornar o objeto
 * {@see ResponseInterface}. Ela também é responsável por armazenar as variáveis
 * que serão enviadas para o template.
 * 
 * O método Render deve escrever o conteúdo no objeto {@see ResponseInterface}
 * e retorna-lo.
 */
interface ViewInterface 
{
    /**
     * Define o objeto {@see ResponseInterface}
     * 
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response) : ViewInterface;
    
    /**
     * Retorna o objeto {@see ResponseInterface}
     * 
     * @return ResponseInterface
     */
    public function getResponse() : ResponseInterface;
    
    /**
     * Limpa todas as variáveis armazenadas
     */
    public function clear() : ViewInterface;
    
    /**
     * Obtém uma variável armazenada na View
     * 
     * @param string $key
     * @throws ViewVariableException quando a chave não existir
     */
    public function get(string $key);
    
    /**
     * Define uma nova variável na View
     * 
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value) : ViewInterface;
    
    /**
     * Une um vetor com as variáveis da View, priorizando os novos valores
     * 
     * @param array $values
     * @param bool $overwrite
     */
    public function merge(array $values) : ViewInterface;
    
    
    /**
     * Substituí as variáveis da view por novas variáveis
     * 
     * @param array $values
     */
    public function replace(array $values) : ViewInterface;
    
    /**
     * Renderiza uma página e escreve no {@see ResponseInterface}
     * 
     * @param string $page Nome da página que será renderizada
     * @param array $vars Variáveis a serem escritas na View, estas variáveis
     * serão unidas com o vetor de variáveis existentes, priorizando as novas 
     * variáveis sobre as variáveis existentes.
     * 
     * @return ResponseInterface
     */
    public function render(string $template, array $vars = []) : ResponseInterface;
    
    /**
     * Renderiza uma página e não modifica o objeto de resposta da View, ao invés 
     * disso retorna o conteúdo renderizado.
     * 
     * @param string $page Nome da página que será renderizada
     * @param array $vars Variáveis a serem escritas na View, estas variáveis
     * serão unidas com o vetor de variáveis existentes, priorizando as novas 
     * variáveis sobre as variáveis existentes.
     * 
     * @return string;
     */
    public function renderWithoutResponse(string $template, array $vars = []) : string;
    
    /**
     * Renderiza um bloco e não modifica o objeto de resposta da View, ao invés 
     * disso retorna o conteúdo renderizado.
     * 
     * @param string $page Nome da página que será renderizada
     * @param array $vars Variáveis a serem escritas na View, estas variáveis
     * serão unidas com o vetor de variáveis existentes, priorizando as novas 
     * variáveis sobre as variáveis existentes.
     * 
     * @return string;
     */
    public function renderBlockWithoutResponse(string $template, array $vars = []) : string;
    
    /**
     * Renderiza um bloco de uma página e escreve no {@see ResponseInterface}
     * 
     * @param string $template Nome da página que contém o bloco
     * @param string $block Nome do bloco que será renderizado
     * @param array $vars Variáveis a serem escritas na View, estas variáveis
     * serão unidas com o vetor de variáveis existentes, priorizando as novas 
     * variáveis sobre as variáveis existentes.
     * 
     * @return ResponseInterface
     */
    public function renderBlock(string $template, string $block, array $vars = []) : ResponseInterface;
    
    /**
     * Renderiza um JSON e com as variáveis existentes, escreve a resposta
     * no objeto {@see ResponseInterface} e o retorna.
     * 
     * @param array $vars
     * @param bool $preserve_existing
     * @return ResponseInterface
     */
    public function asJson(array $vars = array(), bool $preserve_existing = false): ResponseInterface;
    
}
