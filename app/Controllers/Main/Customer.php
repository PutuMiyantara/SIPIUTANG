<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class Customer extends BaseController
{
    public function index()
    {
        parent::masterView('customer/customer',[]);
    }

    public function add()
    {
        parent::masterView('customer/add',[]);
    }
}
