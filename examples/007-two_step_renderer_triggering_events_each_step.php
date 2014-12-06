<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$fileRenderer = new Platelets\FileRenderer(__DIR__ . '/templates');
$dispatcher = new Symfony\Component\EventDispatcher\EventDispatcher();
$eventRenderer = new Platelets\EventTriggeringRenderer($fileRenderer, $dispatcher);
$renderer = new Platelets\TwoStepRenderer($eventRenderer, 'second_step_layout');

$beforeCalled = 0;
$dispatcher->addListener($eventRenderer::BEFORE_RENDER_EVENT, function() use(&$beforeCalled) {
    $beforeCalled++;
    stdout('The before listener has been called ' . $beforeCalled . ' time(s)');
});

$afterCalled = 0;
$dispatcher->addListener($eventRenderer::AFTER_RENDER_EVENT, function() use(&$afterCalled) {
    $afterCalled++;
    stdout('The after listener has been called ' . $afterCalled . ' time(s)');
});

$output = $renderer->render('first_step_content', ['dynamic' => 'dynamic']);

stdout($output);
