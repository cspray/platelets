<?php

declare(strict_types=1);

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets;

interface Renderer {

    /**
     * @param string $source
     * @param Context $context
     * @return string
     */
    public function render(string $source, Context $context = null) : string;

} 
