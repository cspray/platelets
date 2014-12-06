<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets\Event;

class AfterRenderEvent extends RenderEvent {

    public function setRenderedOutput($output) {
        $this->output = $output;
    }

}
