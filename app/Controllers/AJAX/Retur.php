<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelRetur;

class Retur extends BaseController
{
    public function index($where)
    {
        $model = new ModelRetur();
        $dataInvoice = array();
        if ($where == "null") {$where = null; } else {
            $where = array('id' => $where);            
        }
        $data = $model->getRetur($where);
        foreach ($data as $key) {
            # code...
            $invoice = array(
                'id' => $key->id,
                'no_retur' => $key->no_retur,
                'nilai_retur' => $key->nilai_retur,
                'tgl_retur' => $key->tgl_retur,
                'nilai_sisa_retur' => $key->nilai_sisa_retur,
            );
            array_push($dataInvoice, $invoice);            
        }
        
        echo json_encode($dataInvoice);
    }

    public function insertData(){
        $model = new ModelRetur();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';

        $data = array(
            'no_retur' => $dataJSON['no_retur'],
            'tgl_retur' => $dataJSON['tgl_retur'],
            'nilai_retur' => $dataJSON['nilai_retur'],
            'nilai_sisa_retur' => $dataJSON['nilai_retur']
        );
        
        if ($this->validator->run($data, 'returtext')) {
            # code...
            if ($model->insertData($data)) {
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
        $model = new ModelRetur();
        $where = $this->request->getJSON(true);
        $data = $model->deleteData($where);
        return false;
    }

    public function getDetail ($where) {
        $model = new ModelRetur();
        $where = array('tb_retur.id' => $where);
        $data = $model->getRetur($where);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelRetur();
        $where = array('tb_retur.id' => $where);
        $dataJSON = $this->request->getJSON(true);
        if ($this->validator->run($dataJSON, 'returtextupdate')) {
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
