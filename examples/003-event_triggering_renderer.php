<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$fileRenderer = new Platelets\FileRenderer(__DIR__ . '/templates');
$dispatcher = new Symfony\Component\EventDispatcher\EventDispatcher();
$renderer = new Platelets\EventTriggeringRenderer($fileRenderer, $dispatcher);

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
