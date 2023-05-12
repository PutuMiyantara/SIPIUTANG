<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        parent::masterView('user/user',[]);
    }

    public function add()
    {
        parent::masterView('user/add',[]);
    }
}
