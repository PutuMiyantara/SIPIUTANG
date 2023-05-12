<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelCustomer;

class Customer extends BaseController
{
    public function index()
    {
        $model = new ModelCustomer();
        $data = $model->getCustomer(null);
        $dataCustomer = array();

        foreach ($data as $key) {
            # code...
            $cstmr = array(
                'id' => $key->id,
                'nama_cstmr' => $key->nama_cstmr,
                'alamat_cstmr' => $key->alamat_cstmr,
                'id_bank' => $key->id_bank,
                'rekening' => $key->rekening,
                'ktp' => $key->ktp,
                'telepon' => $key->telepon,
                'email' => $key->email,
                'atas_nama' => $key->atas_nama,
                'nama_usaha' => $key->nama_usaha,
                'selectarray' => $key->nama_cstmr . "-" . "$key->atas_nama",
            );
            array_push($dataCustomer, $cstmr);
        }
        
        echo json_encode($dataCustomer);
    }

    public function insertData(){
        $model = new ModelCustomer();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';

        if ($this->validator->run($dataJSON, 'customertext')) {
            # code...
            if ($model->insertData($dataJSON)) {
                # code...
                $message = "Berhasil Menyimpan Data";
            } else {
                $errortext[] = "Gagal Menyimpan Data";
            }
        } else {
            # code...
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);

        echo json_encode($output);
    }

    public function deleteData () {
        $model = new ModelCustomer();
        $where = $this->request->getJSON(true);
        $data = $model->deleteData($where);
        return true;
    }

    public function getDetail ($where) {
        $model = new ModelCustomer();
        $where = array('id' => $where);
        $data = $model->getCustomer($where);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelCustomer();
        $where = array('id' => $where);
        $dataJSON = $this->request->getJSON(true);
        
        if ($this->validator->run($dataJSON, 'customertext')) {
            # code...
            if ($model->updateData($where, $dataJSON)) {
                # code...
                $message = "Berhasil Mengubah Data";
            } else {
                # code...
                $errortext[] = "Gagal Menyimpan Data";
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode("", $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }
}
