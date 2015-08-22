<?php

declare(strict_types=1);

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets;

use Cspray\Platelets\Event\AfterRenderEvent;
use Cspray\Platelets\Event\BeforeRenderEvent;
use League\Event\EmitterInterface;

class EventTriggeringRenderer implements Renderer {

    const BEFORE_RENDER_EVENT = 'platelets.before_render';
    const AFTER_RENDER_EVENT = 'platelets.after_render';

    private $renderer;
    private $emitter;

    public function __construct(Renderer $renderer, EmitterInterface $emitter) {
        $this->renderer = $renderer;
        $this->emitter = $emitter;;
    }

    public function render(string $source, Context $context = null) : string {
        $context = $context ?? new AdhocContext();
        $beforeRenderEvent = new BeforeRenderEvent($this, $context);
        $this->emitter->emit($beforeRenderEvent);

        $output = $this->renderer->render($source, $context);

        $afterRenderEvent = new AfterRenderEvent($this, $context, $output);
        $this->emitter->emit($afterRenderEvent);

        return $afterRenderEvent->getOutput();
    }

} 
