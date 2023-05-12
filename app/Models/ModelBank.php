<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBank extends Model
{
    public function getBank($where)
    {
        if ($where == null) {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_bank');
            $builder->select('*');
            $query = $builder->get();

            return $query->getResult();
        } else {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_bank');
            $builder->select('*');
            $query = $builder->getWhere($where);

            return $query->getResult();
        }
    }

    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_bank');
        $builder->insert($data);
        return true;
    }

    public function deleteData($data){
        $db = db_connect();
        $builder = $db->table('tb_bank');
        $builder->delete($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_bank');
        $builder->where($where);
        $builder->update($data);
        return true;
    }
}
