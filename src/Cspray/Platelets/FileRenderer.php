<?php

declare(strict_types=1);

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets;

use Cspray\Platelets\Exception\NotFoundException;

class FileRenderer implements Renderer {

    private $templateDir;

    public function __construct(string $templateDir) {
        $this->templateDir = $templateDir;
    }

    public function render(string $_file, Context $context = null) : string {
        $_path = $this->templateDir . '/' . $_file . '.php';
        if (!file_exists($_path)) {
            throw new NotFoundException("Could not find a file matching \"$_path\"");
        }

        $cb = function() use($_path) {
            ob_start();
            include $_path;
            return ob_get_clean();
        };

        $context = $context ?? new AdhocContext();

        return $cb->call($context);
    }

} 
