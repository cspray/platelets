<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets\Unit;

use PHPUnit_Framework_TestCase as UnitTestCase;
use Platelets\EventTriggeringRenderer;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventTriggeringRendererTest extends UnitTestCase {

    public function testBeforeRenderEventTriggered() {
        $mock = $this->getMock('Platelets\\Renderer');
        $dispatcher = new EventDispatcher();
        $actual = new \stdClass();
        $actual->eventInstance = null;
        $dispatcher->addListener(EventTriggeringRenderer::BEFORE_RENDER_EVENT, function($event) use($actual) {
            $actual->eventInstance = $event;
        });
        $renderer = new EventTriggeringRenderer($mock, $dispatcher);
        $renderer->render('some source');

        $this->assertInstanceOf('Platelets\\Event\\BeforeRenderEvent', $actual->eventInstance);
        $this->assertSame('', $actual->eventInstance->getRenderedOutput());
        $this->assertSame($renderer, $actual->eventInstance->getRenderer());
    }

    public function testAfterRenderEventTriggered() {
        $mock = $this->getMock('Platelets\\Renderer');
        $mock->expects($this->once())->method('render')->willReturn('foobar');
        $dispatcher = new EventDispatcher();
        $actual = new \stdClass();
        $actual->eventInstance = null;
        $dispatcher->addListener(EventTriggeringRenderer::AFTER_RENDER_EVENT, function($event) use($actual) {
            $actual->eventInstance = $event;
        });
        $renderer = new EventTriggeringRenderer($mock, $dispatcher);
        $renderer->render('some source');

        $this->assertInstanceOf('Platelets\\Event\\AfterRenderEvent', $actual->eventInstance);
        $this->assertSame('foobar', $actual->eventInstance->getRenderedOutput());
        $this->assertSame($renderer, $actual->eventInstance->getRenderer());
    }

    public function testReturningRenderedValue() {
        $mock = $this->getMock('Platelets\\Renderer');
        $mock->expects($this->once())->method('render')->willReturn('foobar');
        $dispatcher = new EventDispatcher();
        $renderer = new EventTriggeringRenderer($mock, $dispatcher);

        $this->assertSame('foobar', $renderer->render('some source'));
    }

    public function testDecoratingRenderedOutputInAfterRenderEvent() {
        $mock = $this->getMock('Platelets\\Renderer');
        $mock->expects($this->once())->method('render')->willReturn('foobar');
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener(EventTriggeringRenderer::AFTER_RENDER_EVENT, function($event) {
            $event->setRenderedOutput($event->getRenderedOutput() . ' + called from event');
        });
        $renderer = new EventTriggeringRenderer($mock, $dispatcher);
        $text = $renderer->render('some source');

        $this->assertSame('foobar + called from event', $text);
    }

} 
