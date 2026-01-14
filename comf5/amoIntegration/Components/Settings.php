<?php
namespace comf5\amoIntegration\Components;

abstract class Settings
{
    private static
        $_settings = [];

    private static function load($category)
    {
        logger($category);
        if (!file_exists(CONFIG.'/'.$category . '.php')) {
            throw new \Exception('Error load settings: ' . $category);
        }
        include CONFIG.'/' . $category . '.php';
        self::$_settings[$category] = $config;
    }

    public static function val($key = null, $default = null)
    {
        if (is_null($key)) {
            return self::$_settings;
        }
        if (!strpos($key, '.')) {
            $key = 'app.'.$key;
        }
        $keys = explode('.', $key);
        if (!isset(self::$_settings[$keys[0]])) {
            self::load($keys[0]);
        }
        if (empty($keys[1])) {
            return self::$_settings[$keys[0]];
        }
        if (!isset(self::$_settings[$keys[0]][$keys[1]])) {
            return $default;
        }
        return self::$_settings[$keys[0]][$keys[1]];
    }
}