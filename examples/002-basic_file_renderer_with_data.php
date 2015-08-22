<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cspray\Platelets\AdhocContext;
use Cspray\Platelets\FileRenderer;
use function Cspray\Platelets\Examples\stdout;

$renderer = new FileRenderer(__DIR__ . '/templates');
$context = new AdhocContext(['complexity' => 'as hard as you want it to be']);
$output = $renderer->render('simple_template_with_dynamic_data', $context);

stdout($output);
