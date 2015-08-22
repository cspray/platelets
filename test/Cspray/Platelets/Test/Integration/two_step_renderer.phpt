--TEST--
Ensure two step rendering works with file renderer
--FILE--
<?php

require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/vendor/autoload.php';

$templateDir = dirname(__DIR__) . '/_templates';

$fileRenderer = new \Cspray\Platelets\FileRenderer($templateDir);
$twoStepRenderer = new \Cspray\Platelets\TwoStepRenderer($fileRenderer, 'layouts/inner_content', 'outlet');

echo $twoStepRenderer->render('two_step_inner_content');
--EXPECTF--
<wrapper>inner content</wrapper>