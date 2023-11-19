<?php

namespace App\Core\Mvc;

class View
{
    public static function getContentView(string $view)
    {
        $file = __DIR__ . '/../../resources/views/' . $view . '.php';
        return $file;
    }

    public static function render(string $view, array $vars = []): string
    {
        extract($vars);
        ob_start();
        include self::getContentView($view);
        return ob_get_clean();
    }
}