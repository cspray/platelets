<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$fileRenderer = new Platelets\FileRenderer(__DIR__ . '/templates');
$renderer = new Platelets\TwoStepRenderer($fileRenderer, 'second_step_layout');
$data = ['dynamic' => 'dynamic'];

$output = $renderer->render('first_step_content', $data);

stdout($output);
