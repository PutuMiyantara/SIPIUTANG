<?php

namespace App\Controllers\Main;


use App\Controllers\BaseController;

class Payment extends BaseController
{
    public function index()
    {
        parent::masterView('payment/payment',[]);
    }

    public function buktiPembayaran($nama_file)
    {
        parent::masterView('payment/buktiPembayaran',['nama_file' => $nama_file]);
    }
}
