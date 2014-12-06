<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets\Event;

use Platelets\Renderer;
use Platelets\RendererData;
use Symfony\Component\EventDispatcher\Event as SymfonyEvent;

class RenderEvent extends SymfonyEvent {

    private $renderer;
    private $rendererData;
    protected $output;

    public function __construct(Renderer $renderer, array $data, $output) {
        $this->renderer = $renderer;
        $this->rendererData = $data;
        $this->output = $output;
    }

    public function getRenderer() {
        return $this->renderer;
    }

    public function getRendererData() {
        return $this->rendererData;
    }

    public function setRendererData(array $data) {
        $this->rendererData = $data;
    }

    public function getRenderedOutput() {
        return $this->output;
    }

} 
