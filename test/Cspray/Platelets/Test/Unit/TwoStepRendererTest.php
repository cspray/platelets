<?php

declare(strict_types = 1);

/**
 * @license See LICENSE file in project root
 */

namespace Cspray\Platelets\Test\Unit;

use Cspray\Platelets\AdhocContext;
use Cspray\Platelets\Renderer;
use Cspray\Platelets\TwoStepContext;
use Cspray\Platelets\TwoStepRenderer;
use PHPUnit_Framework_TestCase as UnitTestCase;

class TwoStepRendererTest extends UnitTestCase {

    public function testPassedRendererGetsContextObject() {
        $context = new AdhocContext();
        $renderer = $this->getMock(Renderer::class);
        $renderer->expects($this->at(0))
                 ->method('render')
                 ->with('inner_content', $context)
                 ->willReturn('the content');

        $renderer->expects($this->at(1))
                 ->method('render')
                 ->with('layout', $this->isInstanceOf(TwoStepContext::class))
                 ->willReturn('Final content');

        $twoStep = new TwoStepRenderer($renderer, 'layout');

        $this->assertSame('Final content', $twoStep->render('inner_content', $context));
    }

}