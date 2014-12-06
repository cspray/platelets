<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets;


class TwoStepRenderer implements Renderer {

    private $renderer;
    private $layoutSource;
    private $firstStepVarName;

    public function __construct(Renderer $renderer, $layoutSource, $firstStepVarName = '_content') {
        $this->renderer = $renderer;
        $this->layoutSource = (string) $layoutSource;
        $this->firstStepVarName = (string) $firstStepVarName;
    }

    public function render($_source, array $_data = []) {
        $_data['_content'] = $this->renderer->render($_source, $_data);
        return $this->renderer->render($this->layoutSource, $_data);
    }

    public function setContext($context) {
        $this->renderer->setContext($context);
    }

    public function getContext() {
        return $this->renderer->getContext();
    }

}
