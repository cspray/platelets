<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cspray\Platelets\FileRenderer;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Cspray\Platelets\EventTriggeringRenderer;
use function Cspray\Platelets\Examples\stdout;

$fileRenderer = new FileRenderer(__DIR__ . '/templates');
$dispatcher = new EventDispatcher();
$renderer = new EventTriggeringRenderer($fileRenderer, $dispatcher);

$dispatcher->addListener($renderer::AFTER_RENDER_EVENT, function($event) {
    $event->setOutput($event->getOutput() . ' + called from event');
});

$output = $renderer->render('simple_template');

stdout($output);
