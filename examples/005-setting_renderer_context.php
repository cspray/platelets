<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

class BoldableContext {

    public function bold($content) {
        return '<b>' . $content . '</b>';
    }

}

$renderer = new Platelets\FileRenderer(__DIR__ . '/templates');
$renderer->setContext(new BoldableContext());
$output = $renderer->render('content_with_bold_helper');

stdout($output);
