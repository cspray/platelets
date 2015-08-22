<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cspray\Platelets\FileRenderer;
use Cspray\Platelets\EventTriggeringRenderer;
use Cspray\Platelets\TwoStepRenderer;
use Cspray\Platelets\AdhocContext;
use Symfony\Component\EventDispatcher\EventDispatcher;
use function Cspray\Platelets\Examples\stdout;

$fileRenderer = new FileRenderer(__DIR__ . '/templates');
$dispatcher = new EventDispatcher();
$twoStepRenderer = new TwoStepRenderer($fileRenderer, 'second_step_layout');
$renderer = new EventTriggeringRenderer($twoStepRenderer, $dispatcher);

$beforeCalled = 0;
$dispatcher->addListener($renderer::BEFORE_RENDER_EVENT, function() use(&$beforeCalled) {
    $beforeCalled++;
    stdout('The before listener has been called ' . $beforeCalled . ' time(s)');
});

$afterCalled = 0;
$dispatcher->addListener($renderer::AFTER_RENDER_EVENT, function() use(&$afterCalled) {
    $afterCalled++;
    stdout('The after listener has been called ' . $afterCalled . ' time(s)');
});

$output = $renderer->render('first_step_content', new AdhocContext(['dynamic' => 'dynamic']));

stdout($output);
