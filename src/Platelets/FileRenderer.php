<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets;

use Platelets\Exception\InvalidTypeException;
use Platelets\Exception\NotFoundException;

class FileRenderer implements Renderer {

    private $context;
    private $templateDir;

    public function __construct($templateDir) {
        $this->templateDir = $templateDir;
    }

    public function render($_file, array $_data = []) {
        $_path = $this->templateDir . '/' . $_file . '.php';
        if (!file_exists($_path)) {
            throw new NotFoundException("Could not find a file matching \"$_path\"");
        }

        $cb = $this->getCallbackWithContext($_path, $_data);
        return $cb();
    }

    public function setContext($context) {
        if (!is_object($context)) {
            throw new InvalidTypeException('You MUST pass an object to be the context for a Platelets\\Renderer');
        }
        $this->context = $context;
    }

    public function getContext() {
        return isset($this->context) ? $this->context : $this;
    }

    private function getCallbackWithContext($_path, array $_data) {
        $cb = function() use($_path, $_data) {
            extract($_data, EXTR_SKIP);
            ob_start();
            include $_path;
            return ob_get_clean();
        };
        return $cb->bindTo($this->getContext());
    }

} 
