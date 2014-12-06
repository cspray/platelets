<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$fileRenderer = new Platelets\FileRenderer(__DIR__ . '/templates');
$dispatcher = new Symfony\Component\EventDispatcher\EventDispatcher();
$renderer = new Platelets\EventTriggeringRenderer($fileRenderer, $dispatcher);

$dispatcher->addListener($renderer::AFTER_RENDER_EVENT, function($event) {
    $event->setRenderedOutput($event->getRenderedOutput() . ' + called from event');
});

$output = $renderer->render('simple_template');

stdout($output);
