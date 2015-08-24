<?php

declare(strict_types = 1);

/**
 * @license See LICENSE file in project root
 */

namespace Cspray\Platelets;


class TwoStepContext implements Context {

    // We are intentionally naming this oddly and storing all values in an array instead of separate properties
    // The more properties we add the more variables pollute each template rendered.
    private $_csprayRendererProperties = [];

    public function __construct(Context $context, string $content, string $contentVar = '_content') {
        $this->_csprayRendererProperties['context'] = $context;
        $this->_csprayRendererProperties['content'] = $content;
        $this->_csprayRendererProperties['contentVar'] = $contentVar;
    }

    public function __call(string $method, array $args) {
        return $this->_csprayRendererProperties['context']->$method(...$args);
    }

    public function __get(string $property) {
        $contentVar = $this->_csprayRendererProperties['contentVar'];
        if ($property === $contentVar) {
            return $this->_csprayRendererProperties['content'];
        }
        return $this->_csprayRendererProperties['context']->$property;
    }

    public function __set(string $property, $val) {
        $this->_csprayRendererProperties['context']->$property = $val;
    }

    public function __isset(string $property) {
        $contentVar = $this->_csprayRendererProperties['contentVar'];
        return $property === $contentVar || isset($this->_csprayRendererProperties['context']->$property);
    }

}