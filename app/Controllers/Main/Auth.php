<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        echo view('auth/login', []);
    }
}
