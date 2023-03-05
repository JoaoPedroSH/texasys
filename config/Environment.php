<?php

namespace config;

class Environment
{

    public static function load()
    {
        
        $parsed = parse_ini_file('environment.ini', true);

        $_ENV['ENVIRONMENT'] = $parsed['ENVIRONMENT'];

        foreach ($parsed[$parsed['ENVIRONMENT']] as $key => $value) {
            $_ENV[$key] = $value;
        }
    }
}
