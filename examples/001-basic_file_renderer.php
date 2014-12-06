<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$renderer = new \Platelets\FileRenderer(__DIR__ . '/templates');
$output = $renderer->render('simple_template');

stdout($output);
