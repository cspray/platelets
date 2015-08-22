<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cspray\Platelets\FileRenderer;
use Cspray\Platelets\TwoStepRenderer;
use Cspray\Platelets\AdhocContext;
use function Cspray\Platelets\Examples\stdout;

$fileRenderer = new FileRenderer(__DIR__ . '/templates');
$renderer = new TwoStepRenderer($fileRenderer, 'second_step_layout');
$data = ['dynamic' => 'dynamic'];

$output = $renderer->render('first_step_content', new AdhocContext($data));

stdout($output);
