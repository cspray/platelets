<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Platelets\Unit;

use PHPUnit_Framework_TestCase as UnitTestCase;
use Platelets\FileRenderer;
use Platelets\RendererData;
use Platelets\Stub\DefaultContextTestRenderer;

class FileRendererTest extends UnitTestCase {

    private $templateDir;

    public function setUp() {
        $this->templateDir = dirname(__DIR__) . '/_templates';
    }

    public function testRenderingFileThatDoesNotExist() {
        $renderer = new FileRenderer($this->templateDir);
        $exception = 'Platelets\\Exception\\NotFoundException';
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
        $text = $renderer->render('echo_data', $data);
        $this->assertSame('foo', trim($text));
    }

    public function testRenderingFileWithDefaultContext() {
        $renderer = new DefaultContextTestRenderer($this->templateDir);
        $text = $renderer->render('default_context_test');
        $this->assertSame('bar', trim($text));
    }

    public function testSettingContext() {
        $renderer = new FileRenderer($this->templateDir);
        $context = new \stdClass;
        $context->foo = 'something else';
        $renderer->setContext($context);
        $text = $renderer->render('explicit_context_test');
        $this->assertSame('something else', trim($text));
    }

    public function testGettingDefaultContext() {
        $renderer = new FileRenderer($this->templateDir);
        $this->assertSame($renderer, $renderer->getContext());
    }

    public function testSettingNewContext() {
        $renderer = new FileRenderer($this->templateDir);
        $renderer->setContext($obj = new \stdClass);
        $this->assertsame($obj, $renderer->getContext());
    }

    public function testSettingNonObjectContextThrowsException() {
        $renderer = new FileRenderer($this->templateDir);
        $exception = 'Platelets\\Exception\\InvalidTypeException';
        $msg = 'You MUST pass an object to be the context for a Platelets\\Renderer';
        $this->setExpectedException($exception, $msg);
        $renderer->setContext('not an object');
    }

} 
