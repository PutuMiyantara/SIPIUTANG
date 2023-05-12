<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class ModelPayment extends Model
{
    public function getPayment ($where, $datefrom, $dateto) {
        // var_dump($where); die;
        $db = db_connect();
        $builder = $db->table('tb_payment');
        $builder->join('invoice_payment', 'invoice_payment.id_payment = tb_payment.id');
        $builder->join('tb_invoice', 'invoice_payment.id_invoice = tb_invoice.id');
        $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer');
        $builder->join('tb_bank', 'tb_bank.id = tb_customer.id_bank');
        $builder->join('tb_rekening_penerima', 'tb_rekening_penerima.id = tb_payment.id_rekening_penerima');
        $builder->select('tb_payment.id, no_payment, nominal_payment, tgl_pembayaran, tb_payment.keterangan AS keterangan_payment, verifikasi, 
            id_rekening_penerima, tb_rekening_penerima.id_bank_penerima as id_bank_rek_penerima, nama_rekening, nomor_rekening, tb_rekening_penerima.keterangan AS keterangan_penerima, id_bank_penerima,
            id_customer, nama_cstmr, nama_usaha, atas_nama, rekening, alias, file_bukti_tf');
        $builder->groupBy('tb_payment.id');
        $builder->groupBy('tb_customer.id');
        if (is_null($where) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $query = $builder->get();
        } else if (!is_null($where) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->getWhere($where);
        } else if (!is_null($where) && (is_null($datefrom) && is_null($dateto))) {
            # code...
            $query = $builder->getWhere($where);
        } else if (is_null($where) && (!is_null($datefrom) && !is_null($dateto))) {
            # code...
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        }
        return $query->getResult();
    }

    public function getInvoicePayment ($where) {
        $db = db_connect();
        $builder = $db->table('invoice_payment');
            # code...
        $builder->join('tb_invoice', 'invoice_payment.id_invoice = tb_invoice.id');
        $builder->select('id_invoice, nominal_payment_invoice');
        $query = $builder->getWhere($where);
        // $builder->groupBy('invoice_payment.id_invoice');
        return $query->getResult();
    }
    
    public function getInvoiceDetail ($where) {
        $db = db_connect();
        $builder = $db->table('invoice_payment');
        # code...
        $builder->join('tb_invoice', 'invoice_payment.id_invoice = tb_invoice.id');
        $builder->select('tb_invoice.id, no_invoice, nilai_invoice, tgl_invoice, invoice_payment.nominal_payment_invoice');
        $builder->groupBy('invoice_payment.id_invoice');
        $builder->groupBy('invoice_payment.id_payment');
        $builder->groupBy('invoice_payment.id');
        $query = $builder->getWhere($where);

        return $query->getResult();
    }

    public function getPiutang($where)
    {
        # code...
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->join('tb_invoice', 'tb_invoice.id = tb_payment.id_invoice');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertPayment ($dataInsertPayment) {
        $db = db_connect();
        $builder = $db->table('tb_payment');
        $builder->insert($dataInsertPayment);
        $data = $db->insertID();
        return $data;
    }

    // public function payment($id_invoice, $dataInvoiceUpdate, $dataInvoicePayment){
    //     $db = db_connect();
    //     $db->transBegin();
    //     try{
    //         $builder = $db->table('invoice_payment');
    //         $builder->insert($dataInvoicePayment);

    //         $builderinvoice = $db->table('tb_invoice');
    //         $builderinvoice->where($id_invoice);
    //         $builderinvoice->update($dataInvoiceUpdate);

    //         $db->transCommit();
    //     } catch(\Exception $e){
    //         $db->transRollback();
    //         return $e->getMessage();
    //     }
    // }

    public function payment($dataInvoiceUpdate, $dataInvoicePayment){
        $db = db_connect();
        $db->transBegin();
        try{
            $builder = $db->table('invoice_payment');
            $builder->insertBatch($dataInvoicePayment);
            
            $builderinvoice = $db->table('tb_invoice');
            $builderinvoice->updateBatch($dataInvoiceUpdate, 'id');

            $db->transCommit();
            return true;
        } catch(\Exception $e){
            $db->transRollback();
            // return $e->getMessage();
            return false;
        }
    }

    public function deleteDatWhenErrorInsert($data){
        $db = db_connect();
        $builder = $db->table('tb_payment');
        $builder->delete($data);
        return true;
    }

    public function deleteData($dataInvoice, $id_payment_invoice_del, $id_payment){
        $db = db_connect();

        // update batch done
        $builderinvoice = $db->table('tb_invoice');
        $builderinvoice->updateBatch($dataInvoice, 'id');

        // delete_tb_payment_invoice
        $builder = $db->table('invoice_payment');
        $builder->delete($id_payment_invoice_del);

        // delete tb_payment
        $builder = $db->table('tb_payment');
        $builder->delete($id_payment);

        try{
            // update batch done
            $builderinvoice = $db->table('tb_invoice');
            $builderinvoice->updateBatch($dataInvoice, 'id');

            // delete_tb_payment_invoice
            $builder = $db->table('invoice_payment');
            $builder->delete($id_payment_invoice_del);

            // delete tb_payment
            $builder = $db->table('tb_payment');
            $builder->delete($id_payment);

            $db->transCommit();
            return true;
        } catch(\Exception $e){
            $db->transRollback();
            return $e->getMessage();
        }
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_payment');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

}
