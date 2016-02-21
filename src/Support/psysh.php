<?php

if (! function_exists('psysh')) {
    function psysh(array $variables = [], $bind = null)
    {
        \Fidry\PsyshBundle\DependencyInjection\Psysh::debug($variables, $bind);
    }
}
