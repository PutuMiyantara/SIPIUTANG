<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Piutang extends BaseController
{
    public function index()
    {
        parent::masterView('piutang/piutang',[]);
    }

    public function add()
    {
        parent::masterView('piutang/add',[]);
    }
}
