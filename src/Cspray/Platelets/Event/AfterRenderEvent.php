<?php

declare(strict_types=1);

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets\Event;

use Cspray\Platelets\Context;
use Cspray\Platelets\Renderer;

class AfterRenderEvent extends RenderEvent {

    private $output;

    public function __construct(Renderer $renderer, Context $context, string $output) {
        parent::__construct($renderer, $context);
        $this->output = $output;
    }

    public function getOutput() : string {
        return $this->output;
    }

    public function setOutput(string $output) {
        $this->output = $output;
    }

}
