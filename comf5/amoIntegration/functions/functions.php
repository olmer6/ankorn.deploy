<?php

function config($key, $default = null)
{
    return \comf5\amoIntegration\Components\Settings::val($key, $default);
}

function logger($text)
{
    file_put_contents(LOG . "/" . date('Y_m') . ".log", "\n" . date('d.m.Y H:i:s') . "\n" . print_r($text, 1) . "\n", FILE_APPEND);
}