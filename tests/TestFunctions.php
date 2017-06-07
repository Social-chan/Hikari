<?php

if (!function_exists('config')) {
    function config($key = null, $default = null)
    {
        return $default;
    }
}

if (!function_exists('app')) {
    function app($key = null, $default = null)
    {
        return \Socialchan\Hikari\Test\TestCase::$functions->app($key, $default);
    }
}
