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

    public function render(string $source, Context $context = null) : string {
        $context = $context ?? new AdhocContext();
        $beforeRenderEvent = new BeforeRenderEvent($this, $context);
        $this->eventDispatcher->dispatch(self::BEFORE_RENDER_EVENT, $beforeRenderEvent);

        $output = $this->renderer->render($source, $context);

        $afterRenderEvent = new AfterRenderEvent($this, $context, $output);
        $this->eventDispatcher->dispatch(self::AFTER_RENDER_EVENT, $afterRenderEvent);

        return $afterRenderEvent->getOutput();
    }

} 
