<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelRekPenerima;

class RekPenerima extends BaseController
{
    public function index($where)
    {
        $model = new ModelRekPenerima();
        $dataRekPenerima = array();
        if ($where == "null") {$where = null; } else {
            $where = array('tb_rekening_penerima.id' => $where);            
        }
        $data = $model->getRekPenerima($where);
        foreach ($data as $key) {
            # code...
            $rek_penerima = array(
                'id' => $key->id,
                'id_bank' => $key->id_bank_penerima,
                'nama_rekening' => $key->nama_rekening,
                'nomor_rekening' => $key->nomor_rekening,
                'keterangan' => $key->keterangan,
                'nama_bank' => $key->nama_bank,
                'select_show' => $key->nomor_rekening . "(" . $key->alias . ")" . " - " . 
                    $key->nama_rekening,
            );
            array_push($dataRekPenerima, $rek_penerima);            
        }
        
        echo json_encode($dataRekPenerima);
    }

    public function insertData(){
        $model = new ModelRekPenerima();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        
        if ($this->validator->run($dataJSON, 'rekeningpenerimatext')) {
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
        $model = new ModelRekPenerima();
        $where = $this->request->getJSON(true);
        $data = $model->deleteData($where);
        return false;
    }

    public function getDetail ($where) {
        $model = new ModelRekPenerima();
        $where = array('tb_rekening_penerima.id' => $where);
        $data = $model->getRekPenerima($where);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelRekPenerima();
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
