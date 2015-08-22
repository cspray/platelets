<?php

declare(strict_types = 1);

/**
 * If you use the Cspray\Platelets\AdhocContext you can provide your own
 * helper methods at runtime by taking advantage of the API provided by
 * the Cspray\Adhoc lib.
 *
 * @license See LICENSE file in project root
 */

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cspray\Platelets\FileRenderer;
use Cspray\Platelets\AdhocContext;
use function Cspray\Platelets\Examples\stdout;

// You can add properties and methods both at object construction and
// also later after the object has been created.

$properties = [
    'myVar' => function() {             // You can pass zero-arity functions as computed properties
        return 'computed property';     // This callback will be invoked everytime you access the property
    }
];
$methods = [
    'customHelper' => function($val) {
        return '<blink>' . $val . '</blink>';
    }
];

$context = new AdhocContext($properties, $methods);

$context->adhocGetter('customHelperData', 'be data for my custom helper');      // Could also have a setter but not relevant for templates

$context->adhocMethod('oneAfterConstruct', function($var) {
    return '<em>' . $var . '</em>';
});

$renderer = new FileRenderer(__DIR__ . '/templates');
$output = $renderer->render('content_with_custom_helper', $context);

stdout($output);