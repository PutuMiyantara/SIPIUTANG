<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        parent::masterView('dashboard/dashboard',[]);
    }

    public function add()
    {
        parent::masterView('invoice/add',[]);
    }
}
