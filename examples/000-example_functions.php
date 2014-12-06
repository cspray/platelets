<?php

function stdout($msg, $appendNewLine = true) {
    $msg = ($appendNewLine) ? $msg . PHP_EOL : $msg;
    fwrite(STDOUT, $msg);
}

function unsafeUserContent() {
    return '<script>alert("gotcha");</script>';
}
