<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInvoice extends Model
{
    public function getPiutang($where)
    {
        if ($where == null) {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_user');
            $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
            $builder->join('tb_invoice_ekspedisi', 'tb_invoice_ekspedisi.id = tb_invoice.id_invoice_ekspedisi', 'left');
            $builder->join('tb_ekspedisi', 'tb_ekspedisi.id = tb_invoice_ekspedisi.id_ekspedisi', 'left');
            $builder->select('tb_invoice.id, no_invoice, tgl_invoice, termin, jth_tmpo, nilai_invoice, sisa_hutang, id_customer, id_user
            ,nama_cstmr, id_bank, rekening, atas_nama, nama_usaha, id_customer, id_invoice_ekspedisi, no_invoice_ekspedisi, tgl_pengiriman, nilai_invoice_ekspedisi, nama_ekspedisi, no_telepon_ekspedisi');
            $query = $builder->get();
            
            return $query->getResult();
        } else {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_invoice');
            $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
            $builder->join('tb_invoice_ekspedisi', 'tb_invoice_ekspedisi.id = tb_invoice.id_invoice_ekspedisi', 'left');
            $builder->join('tb_ekspedisi', 'tb_ekspedisi.id = tb_invoice_ekspedisi.id_ekspedisi', 'left');
            $builder->select('tb_invoice.id, no_invoice, tgl_invoice, termin, jth_tmpo, nilai_invoice, sisa_hutang, id_customer, id_user
            ,nama_cstmr, id_bank, rekening, atas_nama, nama_usaha, id_customer, id_invoice_ekspedisi, no_invoice_ekspedisi, tgl_pengiriman, nilai_invoice_ekspedisi, nama_ekspedisi, no_telepon_ekspedisi');
            $query = $builder->getWhere($where);

            return $query->getResult();
        }
    }
    
    public function testData ($where) 
    {
        return 'testDAta';
    }

    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->insert($data);
        return true;
    }

    public function deleteData($data){
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->delete($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

}
