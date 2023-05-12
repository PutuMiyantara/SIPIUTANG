<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class RekPenerima extends BaseController
{
    public function index()
    {
        parent::masterView('rekpenerima/rekpenerima',[]);
    }

    public function add()
    {
        parent::masterView('rekpenerima/add',[]);
    }
}
