<?php
if (!function_exists('env')) {
    require_once 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createMutable(__DIR__);
    $dotenv->load();

    /**
     * This function will convert types of value before return
     *
     * @param $key
     * @param $default
     * @return bool|mixed|string|void|null
     */
    function env($key, $default = null)
    {
        $value = $_ENV[$key] ?? $default;

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (preg_match('/\A([\'"])(.*)\1\z/', $value, $matches)) {
            return $matches[2];
        }

        return $value;
    }
}
