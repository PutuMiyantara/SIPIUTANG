<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRetur extends Model
{
    
    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_retur');
        $builder->insert($data);
        return true;
    }

    public function getRetur ($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_retur');
        if ($where == null) {
            # code...
            $builder->select('tb_retur.id, no_retur, tgl_retur, nilai_retur, nilai_sisa_retur');
            $query = $builder->get();
        } else {
            # code...
            $builder->select('tb_retur.id, no_retur, tgl_retur, nilai_retur, nilai_sisa_retur');
            $query = $builder->getWhere($where);
        }
        return $query->getResult();
    }

    public function deleteData($data){
        $db = db_connect();
        $builder = $db->table('tb_retur');
        $builder->delete($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_retur');
        $builder->where($where);
        $builder->update($data);
        return true;
    }
}
