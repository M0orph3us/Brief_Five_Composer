<?php

function debug($var, $exit = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';

    if ($exit) {
        exit;
    };
}