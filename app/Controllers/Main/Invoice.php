<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Invoice extends BaseController
{
    public function index()
    {
        parent::masterView('invoice/invoice',[]);
    }

    public function add()
    {
        parent::masterView('invoice/add',[]);
    }
}
