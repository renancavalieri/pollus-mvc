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
use Pollus\Mvc\Exceptions\NullResponseException;

/**
 * {@inheritDoc}
 * 
 * Esta implementação utiliza o {@see \Twig\Environment} para renderizar os templates
 */
class TwigView extends BaseView implements ViewInterface
{
    /**
     * @var \Twig\Environment
     */
    protected $twig;
        
    /**
     * Inicia um novo TwigView
     * 
     * @param \Twig\Environment $twig 
     * @param array $vars Variáveis padrões da View
     */
    public function __construct(\Twig\Environment $twig, array $vars = array()) 
    {
        $this->twig = $twig;
        $this->vars = $vars;
    }
    
    /**
     * {@inheritDoc}
     * @throws NullResponseException;
     */
    public function render(string $template, array $vars = array()): ResponseInterface 
    {
        if ($this->response === null)
        {
            throw new NullResponseException("O objeto de resposta não foi fornecido");
        }
        $data = array_merge($this->vars, $vars);
        $html = $this->getTwig()->render($template, $data);
        $this->response->getBody()->write($html);
        $newResponse = $this->response->withHeader
        (
            'Content-type',
            'text/html; charset=utf-8'
        );
        
        return $newResponse;    
    }
    
    /**
     * {@inheritDoc}
     * @throws NullResponseException
     */
    public function renderBlock(string $template, string $block, array $vars = array()): ResponseInterface
    {
        if ($this->response === null)
        {
            throw new NullResponseException("O objeto de resposta não foi fornecido");
        }
        $data = array_merge($this->vars, $vars);
        $html = $this->getTwig()->loadTemplate($template)->renderBlock($block, $data);
        $this->response->getBody()->write($html);
        $newResponse = $this->response->withHeader
        (
            'Content-type',
            'text/html; charset=utf-8'
        );
        
        return $newResponse;   
    }
    
    /**
     * Retorna o objeto {@see \Twig\Environment}
     * 
     * @return \Twig\Environment
     */
    public function getTwig() : \Twig\Environment
    {
        return $this->twig;
    }
    
    /**
     * Define o objeto {@see \Twig\Environment}
     * 
     * @param \Twig\Environment $twig
     */
    public function setTwig(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritDoc}
     */
    public function renderBlockWithoutResponse($template, array $vars = array()): string
    {
        $data = array_merge($this->vars, $vars);
        return $this->getTwig()->loadTemplate($template)->renderBlock($template, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function renderWithoutResponse($template, array $vars = array()): string
    {
        $data = array_merge($this->vars, $vars);
        return $this->getTwig()->render($template, $data);
    }

}
