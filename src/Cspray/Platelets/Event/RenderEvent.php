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
use Symfony\Component\EventDispatcher\Event as SymfonyEvent;

class RenderEvent extends SymfonyEvent {

    private $renderer;
    private $context;

    public function __construct(Renderer $renderer, Context $context) {
        $this->renderer = $renderer;
        $this->context = $context;
    }

    public function getRenderer() : Renderer {
        return $this->renderer;
    }

    public function getContext() : Context {
        return $this->context;
    }

} 
