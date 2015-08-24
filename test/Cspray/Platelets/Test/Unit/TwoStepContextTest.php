<?php

declare(strict_types = 1);

/**
 * @license See LICENSE file in project root
 */

namespace Cspray\Platelets\Test\Unit;

use Cspray\Platelets\AdhocContext;
use Cspray\Platelets\TwoStepContext;
use PHPUnit_Framework_TestCase as UnitTestCase;

class TwoStepContextTest extends UnitTestCase {

    public function testProxyingMethodsToAdhocContext() {
        $adhocContext = new AdhocContext();
        $test = null;
        $adhocContext->adhocMethod('foo', function($val) use(&$test) {
            $test = $val;
        });

        $context = new TwoStepContext($adhocContext, 'whatever');

        $context->foo('something');

        $this->assertSame('something', $test);
    }

}