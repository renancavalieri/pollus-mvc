<?php declare(strict_types=1);

/**
 * Pollus MVC
 * 
 * @copyright (c) 2018, Renan Cavalieri
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://github.com/renancavalieri/pollus-mvc GitHub
 */

namespace Pollus\Mvc\Views;

use \Twig\Extension\AbstractExtension;
use \Twig\TwigFunction;

class TwigExtensions extends AbstractExtension
{
    /**
     * Retorna as extensões
     * 
     * @return array
     */
    public function getFunctions() : array
    {
        return
        [
            new TwigFunction('asset', [$this, 'asset'], ['is_safe' => ['html']]),
            new TwigFunction('url', [$this, 'url'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Insere arquivos CSS, JS e ICO automaticamente.
     * 
     * Utiliza a função "url" internamente para resolver subdiretórios
     * 
     * @param string $asset
     * @param string|null $attributes
     * @return type
     */
    public function asset(string $asset, ?string $attributes = "")
    {
        $ext = pathinfo($asset, PATHINFO_EXTENSION);
        
        if (strpos($asset, "://") !== false) 
        {
            $path = $asset;
        }
        else
        {
            $path = $this->url($asset);
        }

        if ($ext === "css")
        {
            $asset_src = '<link rel="stylesheet" '.$attributes.' href="'.$path.'">';
        }
        else if ($ext === "js")
        {
            $asset_src = '<script '.$attributes.' src="'.$path.'"></script>';
        }
        else if ($ext === "ico")
        {
            $asset_src = '<link rel="icon" '.$attributes.' href="'.$path.'" type="image/x-icon" />';
        }
        else
        {
            $asset_src = $path;
        }

        return $asset_src;
    }
    
    /**
     * @param string $url
     * @param array $query
     * @return string
     */
    public function url(string $url = "", ?array $query = null)
    {
        if (!(strpos($url, "://") !== false)) 
        {
            $url = htmlentities(rtrim(dirname($_SERVER["PHP_SELF"] ?? ""), "/") . "/" . ltrim($url, "/"), ENT_NOQUOTES, 'utf-8');
        }
        
        if ($query !== null)
        {
            $url .= "?" . http_build_query($query);
        }
        
        return $url;
    }        
}
