<?php

require_once __DIR__ . '/000-example_functions.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$fileRenderer = new \Platelets\FileRenderer(__DIR__ . '/templates');
$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
$renderer = new \Platelets\EventTriggeringRenderer($fileRenderer, $dispatcher);

$dispatcher->addListener($renderer::BEFORE_RENDER_EVENT, function($event) {
    $cleanData = [];
    foreach ($event->getRendererData() as $key => $val) {
        $cleanData[$key] = htmlspecialchars($val);               # a better implementation would escape recursively
    }
    $event->setRendererData($cleanData);
});

$data = ['userContent' => unsafeUserContent()];
$output = $renderer->render('potentially_unsafe_content', $data);

stdout($output);
