<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets;


interface Renderer {

    /**
     * Determines the context, the object used as $this, when rendering a given
     * source; the context passed MUST be an object
     *
     * @param object $context
     * @return void
     * @throws Exception\InvalidTypeException
     */
    public function setContext($context);

    /**
     * Returns the context, the object used as $this, when rendering a given source;
     * if no context has been set the concrete Renderer implementing this interface
     * should be returned and used as the context.
     *
     * @return object
     */
    public function getContext();

    /**
     *
     *
     * @param mixed $source
     * @param array $data
     * @return string
     */
    public function render($source, array $data = []);

} 
