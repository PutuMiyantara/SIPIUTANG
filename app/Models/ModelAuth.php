<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function getUser($username) {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->select('*');
        $query = $builder->getWhere($username);

        return $query->getRowArray();
    }
}
