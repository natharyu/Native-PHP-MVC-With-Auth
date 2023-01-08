<?php

namespace App\Controller;

class Error
{
    // Return error 404 view
    public function error404(): void
    {
        $view = './App/Views/Error/404/404.php';
        include_once './App/Views/Error/Layout/Layout.php';
    }
}
