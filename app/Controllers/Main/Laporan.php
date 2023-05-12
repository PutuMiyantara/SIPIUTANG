<?php

namespace App\Controllers\Main;


use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        parent::masterView('laporan/laporan',[]);
    }

    public function invoice()
    {
        parent::masterView('laporan/laporan_invoice',[]);
    }
}
