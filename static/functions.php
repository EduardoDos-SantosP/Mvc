<?php

function consoleDebug(mixed $value, bool $usePrintR = false): void {
    ($usePrintR ? 'print_r' : 'var_dump')($value);
}
function debug(mixed $value, bool $usePrintR = false): void {
    echo '<pre>';
    consoleDebug($value, $usePrintR);
    echo '</pre>';
}
function dieDump(mixed $value, bool $usePrintR = false): never {
    debug($value, $usePrintR);
    die();
}