<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Platelets\Test\Unit;

use Cspray\Platelets\AdhocContext;
use Cspray\Platelets\Context;
use Cspray\Platelets\FileRenderer;
use Cspray\Platelets\Test\Stub\DefaultContextTestRenderer;
use PHPUnit_Framework_TestCase as UnitTestCase;


class FileRendererTest extends UnitTestCase {

    private $templateDir;

    public function setUp() {
        $this->templateDir = dirname(__DIR__) . '/_templates';
    }

    public function testRenderingFileThatDoesNotExist() {
        $renderer = new FileRenderer($this->templateDir);
        $exception = 'Cspray\\Platelets\\Exception\\NotFoundException';
        $msg = 'Could not find a file matching "' . $this->templateDir . '/not_found.php"';
        $this->setExpectedException($exception, $msg);
        $renderer->render('not_found');
    }

    public function testRenderingFileWithNoData() {
        $renderer = new FileRenderer($this->templateDir);
        $text = $renderer->render('layouts/index');
        $this->assertSame('Just the index', trim($text));
    }

    public function testRenderingFileWithData() {
        $renderer = new FileRenderer($this->templateDir);
        $data = ['data' => 'foo'];
        $text = $renderer->render('echo_data', new AdhocContext($data));
        $this->assertSame('foo', trim($text));
    }

    public function testRenderingFileWithContextMethods() {
        $context = new AdhocContext([], ['foo' => function() { return 'bar'; }]);
        $renderer = new FileRenderer($this->templateDir);
        $text = $renderer->render('default_context_test', $context);
        $this->assertSame('bar', trim($text));
    }

    public function testSettingContext() {
        $renderer = new FileRenderer($this->templateDir);
        $context = new class implements Context { private $foo = 'something else'; };
        $text = $renderer->render('explicit_context_test', $context);
        $this->assertSame('something else', trim($text));
    }

} 
