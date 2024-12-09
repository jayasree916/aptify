<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Home Page';
        return view('content/home', $data);
    }
    public function about()
    {
        $data['title'] = 'About';
        return view('content/about', $data);
    }

    public function login()
    {
        $data['title'] = 'Login';
        return view('content/login', $data);
    }

    public function contact()
    {
        $data['title'] = 'Contact';
        return view('content/contact', $data);
    }
}
