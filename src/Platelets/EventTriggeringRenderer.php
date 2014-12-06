<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets;

use Platelets\Event\AfterRenderEvent;
use Platelets\Event\BeforeRenderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventTriggeringRenderer implements Renderer {

    const BEFORE_RENDER_EVENT = 'platelets.before_render';
    const AFTER_RENDER_EVENT = 'platelets.after_render';

    private $renderer;
    private $eventDispatcher;

    public function __construct(Renderer $renderer, EventDispatcherInterface $eventDispatcher) {
        $this->renderer = $renderer;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function render($source, array $data = []) {
        $beforeRenderEvent = new BeforeRenderEvent($this, $data, '');
        $this->eventDispatcher->dispatch(self::BEFORE_RENDER_EVENT, $beforeRenderEvent);

        $output = $this->renderer->render($source, $beforeRenderEvent->getRendererData());

        $afterRenderEvent = new AfterRenderEvent($this, $data, $output);
        $this->eventDispatcher->dispatch(self::AFTER_RENDER_EVENT, $afterRenderEvent);

        return $afterRenderEvent->getRenderedOutput();
    }

    public function setContext($context) {
        $this->renderer->setContext($context);
    }

    public function getContext() {
        return $this->renderer->getContext();
    }

} 
