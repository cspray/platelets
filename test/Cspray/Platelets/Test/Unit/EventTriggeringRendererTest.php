<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets\Test\Unit;

use Cspray\Platelets\Renderer;
use Cspray\Platelets\EventTriggeringRenderer;
use League\Event\Emitter;
use PHPUnit_Framework_TestCase as UnitTestCase;

class EventTriggeringRendererTest extends UnitTestCase {

    private function getMockRenderer(string $return = '') {
        $mock = $this->getMock(Renderer::class);
        $mock->expects($this->once())->method('render')->willReturn($return);
        return $mock;
    }

    public function testBeforeRenderEventTriggered() {
        $dispatcher = new Emitter();
        $actual = new \stdClass();
        $actual->eventInstance = null;
        $dispatcher->addListener(EventTriggeringRenderer::BEFORE_RENDER_EVENT, function($event) use($actual) {
            $actual->eventInstance = $event;
        });
        $renderer = new EventTriggeringRenderer($this->getMockRenderer(), $dispatcher);
        $renderer->render('some source');

        $this->assertInstanceOf('Cspray\\Platelets\\Event\\BeforeRenderEvent', $actual->eventInstance);
    }

    public function testAfterRenderEventTriggered() {
        $dispatcher = new Emitter();
        $actual = new \stdClass();
        $actual->eventInstance = null;
        $dispatcher->addListener(EventTriggeringRenderer::AFTER_RENDER_EVENT, function($event) use($actual) {
            $actual->eventInstance = $event;
        });
        $renderer = new EventTriggeringRenderer($this->getMockRenderer(), $dispatcher);
        $renderer->render('some source');

        $this->assertInstanceOf('Cspray\\Platelets\\Event\\AfterRenderEvent', $actual->eventInstance);
    }

    public function testReturningRenderedValue() {
        $dispatcher = new Emitter();
        $renderer = new EventTriggeringRenderer($this->getMockRenderer('foobar'), $dispatcher);

        $this->assertSame('foobar', $renderer->render('some source'));
    }

    public function testDecoratingRenderedOutputInAfterRenderEvent() {
        $mock = $this->getMockRenderer('foobar');
        $dispatcher = new Emitter();
        $dispatcher->addListener(EventTriggeringRenderer::AFTER_RENDER_EVENT, function($event) {
            $event->setOutput($event->getOutput() . ' + called from event');
        });
        $renderer = new EventTriggeringRenderer($mock, $dispatcher);
        $text = $renderer->render('some source');

        $this->assertSame('foobar + called from event', $text);
    }

} 
