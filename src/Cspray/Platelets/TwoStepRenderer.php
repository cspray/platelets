<?php

declare(strict_types=1);

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets;

class TwoStepRenderer implements Renderer {

    private $renderer;
    private $layoutSource;
    private $firstStepVarName;

    public function __construct(Renderer $renderer, string $layoutSource, string $firstStepVarName = '_content') {
        $this->renderer = $renderer;
        $this->layoutSource = $layoutSource;
        $this->firstStepVarName = $firstStepVarName;
    }

    public function render(string $_source, Context $_context = null) : string {
        $_context = $_context ?? new AdhocContext();
        $content = $this->renderer->render($_source, $_context);
        $twoStepContext = new TwoStepContext($_context, $content, $this->firstStepVarName);
        return $this->renderer->render($this->layoutSource, $twoStepContext);
    }

}
