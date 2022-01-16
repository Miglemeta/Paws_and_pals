<?php

function dump($value)
{
    echo '<pre>' . print_r($value, true) . "</pre>";
}

function dd($value)
{
    dump($value);
    exit();
}
