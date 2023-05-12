<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function getUser($where)
    {
        if ($where == null) {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_user');
            $builder->select('*');
            $query = $builder->get();

            return $query->getResult();
        } else {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_user');
            $builder->select('*');
            $query = $builder->getWhere($where);

            return $query->getResult();
        }
    }

    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->insert($data);
        return true;
    }

    public function deleteData($data){
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->delete($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->where($where);
        $builder->update($data);
        return true;
    }
}
