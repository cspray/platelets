<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cspray\Platelets\FileRenderer;
use Cspray\Platelets\EventTriggeringRenderer;
use Symfony\Component\EventDispatcher\EventDispatcher;
use function Cspray\Platelets\Examples\stdout;

$fileRenderer = new FileRenderer(__DIR__ . '/templates');
$dispatcher = new EventDispatcher();
$renderer = new EventTriggeringRenderer($fileRenderer, $dispatcher);

$dispatcher->addListener($renderer::BEFORE_RENDER_EVENT, function($event) {
    stdout('Called the before render event');
    stdout('You have access to an instance of ' . get_class($event) . ' as the argument passed to the listener');
});

$dispatcher->addListener($renderer::AFTER_RENDER_EVENT, function($event) {
    stdout('Called the after render event');
    stdout('You have access to an instance of ' . get_class($event) . ' as the argument passed to the listener');
});

$output = $renderer->render('simple_template');

stdout('');
stdout($output);
