<?php

declare(strict_types=1);

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets\Event;

use Cspray\Platelets\EventTriggeringRenderer;

class BeforeRenderEvent extends RenderEvent {

    public function getName() {
        return EventTriggeringRenderer::BEFORE_RENDER_EVENT;
    }

}
