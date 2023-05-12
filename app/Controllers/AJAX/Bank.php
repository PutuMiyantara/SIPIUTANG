<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelBank;

class Bank extends BaseController
{
    public function index()
    {
        $muser = new ModelBank();
        $data = $muser->getBank(null);
        
        echo json_encode($data);
    }

    public function insertData(){
        $model = new ModelBank();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';

        if ($this->validator->run($dataJSON, 'banktext')) {
            # code...
            $dataJSON = array(
                'nama_bank' => $dataJSON['nama_bank'],
                'alias' => $dataJSON['alias']
            );
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
        $model = new ModelBank();
        $where = $this->request->getJSON(true);
        $data = $model->deleteData($where);
        return true;
    }

    public function getDetail ($where) {
        $model = new ModelBank();
        $where = array('id' => $where);
        $data = $model->getBank($where);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelBank();
        $where = array('id' => $where);
        $dataJSON = $this->request->getJSON(true);

        // jika tidak update password
        if ($this->validator->run($dataJSON, 'banktext')) {
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
