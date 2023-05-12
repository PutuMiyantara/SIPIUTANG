<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class ModelLaporan extends Model
{
    public function getLaporanSumPayment ($where, $datefrom, $dateto) {
        $db = db_connect();
        $builder = $db->table('tb_payment');
        
        if (is_null($where) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nominal_payment) AS sum_nominal_payment');
            $query = $builder->get();
        } else if (!is_null($where) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('id_rekening_penerima, SUM(nominal_payment) AS sum_nominal_payment, COUNT(no_payment) AS count_payment');
            $builder->groupBy('tb_payment.id_rekening_penerima');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->getWhere($where);
            
        } else if (!is_null($where) && (is_null($datefrom) && is_null($dateto))) {
            # code...
            $builder->select('id_rekening_penerima, SUM(nominal_payment) AS sum_nominal_payment');
            $query = $builder->getWhere($where);
        } else if (is_null($where) && (!is_null($datefrom) && !is_null($dateto))) {
            # code...
            $builder->select('SUM(nominal_payment) AS sum_nominal_payment');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        }
        return $query->getResult();
    }

    public function getLaporanSumInvoice ($ket_payment, $ket_invoice, $datefrom, $dateto) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        if (is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice');
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice');
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice');
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else if (is_null($ket_payment) && is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice, COUNT(no_invoice) AS count_invoice');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice');
            $builder->where($ket_payment);
            $query = $builder->get();
        } else if (is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice');
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice, SUM(sisa_hutang) AS sum_sisa_hutang, COUNT(sisa_hutang) AS count_sisa_hutang');
            $builder->where($ket_payment);
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else {
            return false;
        }
        return $query->getResult();
    }

    public function getLaporanSumSisaHutang ($ket_payment, $ket_invoice, $datefrom, $dateto) {
        // var_dump($where); die;
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        
        if (is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(sisa_hutang) AS sum_sisa_hutang');
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(sisa_hutang) AS sum_sisa_hutang');
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(sisa_hutang) AS sum_sisa_hutang');
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else if (is_null($ket_payment) && is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(sisa_hutang) AS sum_sisa_hutang');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(sisa_hutang) AS sum_sisa_hutang');
            $builder->where($ket_payment);
            $query = $builder->get();
        } else if (is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(sisa_hutang) AS sum_sisa_hutang');
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else {
            return false;
        }
        return $query->getResult();
    }

    public function getLaporanSumRetur ($datefrom, $dateto) {
        // var_dump($where); die;
        $db = db_connect();
        $builder = $db->table('tb_retur');
        
        if (is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_retur) AS sum_nilai_retur');
            $query = $builder->get();
        } else if (!is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_retur) AS sum_nilai_retur');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        }
        return $query->getResult();
    }

    public function getLaporanSumPotonganRetur ($ket_payment, $ket_invoice, $datefrom, $dateto) {
        // var_dump($where); die;
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        
        if (is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(potongan_retur) AS sum_potongan_retur');
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(potongan_retur) AS sum_potongan_retur');
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(potongan_retur) AS sum_potongan_retur');
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else if (is_null($ket_payment) && is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(potongan_retur) AS sum_potongan_retur');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(potongan_retur) AS sum_potongan_retur');
            $builder->where($ket_payment);
            $query = $builder->get();
        } else if (is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(potongan_retur) AS sum_potongan_retur');
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else {
            return false;
        }
        return $query->getResult();
    }

    public function getLaporanSumReturTerpotong ($datefrom, $dateto) {
        // var_dump($where); die;
        $db = db_connect();
        $builder = $db->table('tb_retur');
        
        if (is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_sisa_retur) AS sum_nilai_sisa_retur');
            $query = $builder->get();
        } else if (!is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->select('SUM(nilai_sisa_retur) AS sum_nilai_sisa_retur');
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        }
        return $query->getResult();
    }

    public function getLapInvoice ($ket_payment, $ket_invoice, $datefrom, $dateto){
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->join('tb_customer', 'tb_customer.id = tb_invoice.id_customer', 'left');
        $builder->join('tb_retur', 'tb_retur.id = tb_invoice.id_retur', 'left');
        $builder->select('no_invoice, nilai_invoice, tgl_invoice, jth_tmpo, sisa_hutang, ket_invoice, 
            nama_cstmr, nama_usaha,id_retur, no_retur, potongan_retur');
        if (is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->where($ket_payment);
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else if (!is_null($ket_payment) && is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->where($ket_payment);
            $query = $builder->get();
        } else if (is_null($ket_payment) && !is_null($ket_invoice) && is_null($datefrom) && is_null($dateto)) {
            # code...
            $builder->where($ket_invoice);
            $query = $builder->get();
        } else if (is_null($ket_payment) && is_null($ket_invoice) && !is_null($datefrom) && !is_null($dateto)) {
            # code...
            $builder->where($datefrom);
            $builder->where($dateto);
            $query = $builder->get();
        } else {
            var_dump("gagal query");
        }
        return $query->getResult();
    }

    public function getDataInvoiceDashboard ($datefrom, $dateto) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->select('SUM(nilai_invoice) AS sum_nilai_invoice, SUM(sisa_hutang) AS sum_sisa_hutang, SUM(potongan_retur) AS sum_potongan_retur');
        $builder->where($datefrom);
        $builder->where($dateto);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getChartTransaksi ($datefrom, $dateto) {
        $db = db_connect();
        $builder = $db->table('tb_invoice');
        $builder->select('nilai_invoice, sisa_hutang, potongan_retur, tgl_invoice');
        $builder->where($datefrom);
        $builder->where($dateto);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getLapCustomer () {
        $db = db_connect();
        $builder = $db->table('tb_customer');
        
        $builder->select('COUNT(nama_cstmr) AS count_cstmr');
        $query = $builder->get();
        return $query->getResult();
    }
}
