<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRekPenerima extends Model
{
    
    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_rekening_penerima');
        $builder->insert($data);
        return true;
    }

    public function getRekPenerima ($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_rekening_penerima');
        if ($where == null) {
            # code...
            
            $builder->join('tb_bank', 'tb_bank.id = tb_rekening_penerima.id_bank_penerima', 'left');
            $builder->select('tb_rekening_penerima.id, nama_rekening, nomor_rekening, id_bank_penerima, nama_bank, alias, keterangan');
            $query = $builder->get();
        } else {
            # code...
            $builder->join('tb_bank', 'tb_bank.id = tb_rekening_penerima.id_bank_penerima', 'left');
            $builder->select('tb_rekening_penerima.id, nama_rekening, nomor_rekening, id_bank_penerima, nama_bank, alias, keterangan');
            $query = $builder->getWhere($where);
        }
        return $query->getResult();
    }

    public function deleteData($data){
        $db = db_connect();
        $builder = $db->table('tb_rekening_penerima');
        $builder->delete($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_rekening_penerima');
        $builder->where($where);
        $builder->update($data);
        return true;
    }
}
