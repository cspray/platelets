<?php

namespace {
    require_once __DIR__ . '/000-example_functions.php';
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}

namespace Cspray\Platelets\Examples {

    use Cspray\Platelets\FileRenderer;
    use Cspray\Platelets\Context;
    use function Cspray\Platelets\Examples\stdout;

    class BoldableContext implements Context {

        public function bold($content) {
            return '<b>' . $content . '</b>';
        }

    }

    $renderer = new FileRenderer(__DIR__ . '/templates');
    $output = $renderer->render('content_with_bold_helper', new BoldableContext());

    stdout($output);

}

