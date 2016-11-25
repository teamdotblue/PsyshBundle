<?php

if (false === function_exists('psysh')) {
    function psysh(array $variables = [], $bind = null)
    {
        \Fidry\PsyshBundle\PsyshFacade::debug($variables, $bind);
    }
}
