<?php namespace App\Controller;

class Home
{
    public function index()
    {
        $view = './App/Views/Home/Homepage/Main.php';
        include_once './App/Views/Home/Layout/Layout.php';
    }

    public function loginForm()
    {
        $view = './App/Views/Home/Session/Login.php';
        include_once './App/Views/Home/Layout/Layout.php';
    }

    public function registerForm()
    {
        $view = './App/Views/Home/Session/Register.php';
        include_once './App/Views/Home/Layout/Layout.php';
    }

    public function aboutView()
    {
        $view = './App/Views/Home/Homepage/About.php';
        include_once './App/Views/Home/Layout/Layout.php';
    }

    public function contactForm()
    {
        $view = './App/Views/Home/Homepage/Contact.php';
        include_once './App/Views/Home/Layout/Layout.php';
    }
}