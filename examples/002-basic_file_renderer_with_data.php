<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$renderer = new Platelets\FileRenderer(__DIR__ . '/templates');
$data = ['complexity' => 'as hard as you want it to be'];
$output = $renderer->render('simple_template_with_dynamic_data', $data);

stdout($output);
