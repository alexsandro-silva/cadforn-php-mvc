<?php

namespace App\Core\Mvc;

class Controller
{
    protected function loadView(string $view, array $vars = []): string
    {
        // extract($vars);
        // ob_start();
        // include(View::getContentView($view));
        // return ob_get_clean();
        return View::render($view, $vars);
    }
}