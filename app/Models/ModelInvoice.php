<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInvoice extends Model
{
    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->insert($data);
        return true;
    }

    public function insertWithRetur($dataInvoice, $dataReturUpdate, $id_retur){
        $db = db_connect();
        $db->transBegin();
        try{
            $builder = $db->table('tb_invoice');
            $builder->insert($dataInvoice);

            $builderinvoice = $db->table('tb_retur');
            $builderinvoice->where($id_retur);
            $builderinvoice->update($dataReturUpdate);

            $db->transCommit();
            return true;
        } catch(\Exception $e){
            $db->transRollback();
            return $e->getMessage();
        }
    }

    public function getInvoice($where)
    {
        if ($where == null) {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_invoice');
            $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
            $builder->join('tb_retur', 'tb_retur.id = tb_invoice.id_retur', 'left');
            $builder->select('tb_invoice.id, no_invoice, tgl_invoice, termin, jth_tmpo, nilai_invoice, sisa_hutang, id_customer, 
            id_user,nama_cstmr, id_bank, rekening, atas_nama, nama_usaha, id_customer, ket_invoice, id_retur, nilai_retur, no_retur, nilai_sisa_retur, potongan_retur');
            $query = $builder->get();
            
            return $query->getResult();
        } else {
            # code...
            $db = db_connect();
            $builder = $db->table('tb_invoice');
            $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
            $builder->join('tb_retur', 'tb_retur.id = tb_invoice.id_retur','left');
            $builder->select('tb_invoice.id, no_invoice, tgl_invoice, termin, jth_tmpo, nilai_invoice, sisa_hutang, id_customer, 
            id_user,nama_cstmr, id_bank, rekening, atas_nama, nama_usaha, id_customer, ket_invoice, id_retur, nilai_retur, no_retur, nilai_sisa_retur, potongan_retur');
            $query = $builder->getWhere($where);

            return $query->getResult();
        }
    }

    public function getDetailPiutangInvoice ($id_customer, $id_invoice_ekspedisi) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
        $builder->select('tb_invoice.id, no_invoice, id_customer');
        if ($id_customer != null && $id_invoice_ekspedisi) {
            # code...
            $query = $builder->getWhere($id_customer);
            $query = $builder->getWhere($id_invoice_ekspedisi);
        }
        return $query->getResult();
    } 

    public function getDetailHutang ($where) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer', 'left');
        $builder->select('tb_invoice.id, no_invoice, nilai_invoice, sisa_hutang, tgl_invoice, jth_tmpo, id_customer, ket_invoice');
        $query = $builder->getWhere($where);
        return $query->getResult();
    }

    public function getHutang ($where) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
        $builder->select('SUM(sisa_hutang) as hutang_invoice, id_customer, 
            nama_usaha, nama_cstmr, telepon, atas_nama');
        $builder->groupBy('tb_invoice.id_customer');

        if ($where != null) {
            # code...
            $query = $builder->getWhere($where);
        } else {
            $query = $builder->get();
        }
        return $query->getResult();
    }

    public function getNotifikasi ($jthTmpo, $sisaHutang) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
        $builder->select('SUM(sisa_hutang) as hutang_invoice, id_customer,  
            nama_usaha, nama_cstmr, telepon, atas_nama');
        $builder->groupBy('tb_invoice.id_customer');

        // if ($jthTmpo != null && $sisaHutang != null) {
            # code...
            $builder->where($jthTmpo);
            $builder->where($sisaHutang);
            $query = $builder->get();
        // }
        return $query->getResult();
    }

    public function deleteData($data){
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->delete($data);
        return true;
    }
    
    public function deleteDataUpdateRetur($where, $id_retur, $dataReturUpdate){
        $db = db_connect();
        try{
            $builderInvoice = $db->table('tb_invoice');
            $builderInvoice->delete($where);

            $builderRetur = $db->table('tb_retur');
            $builderRetur->where($id_retur);
            $builderRetur->update($dataReturUpdate);

            $db->transCommit();
            return true;
        } catch(\Exception $e){
            $db->transRollback();
            return $e->getMessage();
        }
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
