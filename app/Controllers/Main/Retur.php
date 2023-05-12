<?php

namespace App\Controllers\Main;


use App\Controllers\BaseController;

class Retur extends BaseController
{
    public function index()
    {
        parent::masterView('retur/retur',[]);
    }
    
    public function add()
    {
        parent::masterView('retur/add',[]);
    }
}
