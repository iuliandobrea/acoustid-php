<?php

/**
 * Development helpers
 */

if (!function_exists('dd')) {
    function dd($data)
    {
        var_dump($data);
        exit;
    }
}

if (!function_exists('pd')) {
    function pd($data)
    {
        print_r($data);
        exit;
    }
}

if (!function_exists('get')) {

    function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
}

if (!function_exists('post')) {

    function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
}
