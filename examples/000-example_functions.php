<?php

namespace Cspray\Platelets\Examples;

function stdout($msg, $appendNewLine = true) {
    $msg = ($appendNewLine) ? $msg . PHP_EOL : $msg;
    fwrite(STDOUT, $msg);
}
