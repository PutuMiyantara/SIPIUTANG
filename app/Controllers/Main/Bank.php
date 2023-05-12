<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Bank extends BaseController
{
    public function index()
    {
        parent::masterView('bank/bank',[]);
    }

    public function add()
    {
        parent::masterView('bank/add',[]);
    }
}
