<?php

namespace App\Core;

class Environment
{
    public static function load(string $directory)
    {
        $envFile = $directory . '/.env';

        if(!file_exists($envFile)) {
            return false;
        }

        $vars = file($envFile);
        foreach ($vars as $var) {
            putenv(trim($var));
        }
    }
}