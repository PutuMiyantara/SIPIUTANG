<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelInvoice;
use App\Models\ModelPayment;
use App\Models\ModelLaporan;

class Laporan extends BaseController
{
    public function getLaporanSumPayment($where, $date_from, $date_to)
    {
        $model = new ModelLaporan();
        $datefrompayment = null;
        $datetopayment = null;

        if ($where == "null" || $where == "undefined") {$where = null; } else {
            $where = array('id_rekening_penerima' => $where);            
        }
        if ($date_from == "null" || $date_from == "undefined") {$date_from = null; } else {
            $datefrompayment = array('tgl_pembayaran >=' => $date_from);            
        }
        if ($date_to == "null" || $date_to == "undefined") {$date_to = null; } else {
            $datetopayment = array('tgl_pembayaran <=' => $date_to);            
        }

        $dataTotalPayment = $model->getLaporanSumPayment($where, $datefrompayment, $datetopayment);

        if ($dataTotalPayment) {
            # code...
            $dataTotal = array(
                'total_payment' => number_format($dataTotalPayment[0]->sum_nominal_payment,0,',','.'),
            );
        } else{
            $dataTotal = array(
                'total_payment' => 0,
            );
        }
        echo json_encode($dataTotal);
    }

    public function CetakLaporan($id_rekening_penerima, $date_from, $date_to){
        $model = new ModelPayment();
        $modelLaporan = new ModelLaporan();
        $date_from_name = null;
        $date_to_name = null;
        $dataRekeningHeader = null;

        if ($id_rekening_penerima == "null" || $id_rekening_penerima == "undefined") {$id_rekening_penerima = null; } else {
            $id_rekening_penerima = array('id_rekening_penerima' => $id_rekening_penerima);            
        }
        if ($date_from == "null" || $date_from == "undefined") {$date_from_array = null; } else {
            $date_from_array = array('tgl_pembayaran >=' => $date_from);            
        }
        if ($date_to == "null" || $date_to == "undefined") {$date_to_array = null; } else {
            $date_to_array = array('tgl_pembayaran <=' => $date_to);            
        }

        if (!is_null($id_rekening_penerima)) {
            # code...
            $dataRekeningHeader = $model->getPayment($id_rekening_penerima, $date_from_array, $date_to_array);
        } else {
            $dataRekeningHeader = "undefined";
        }
        $dataPayment = $model->getPayment($id_rekening_penerima, $date_from_array, $date_to_array);
        $dataSum = $modelLaporan->getLaporanSumPayment($id_rekening_penerima, $date_from_array, $date_to_array);
        $mpdf = new \Mpdf\Mpdf();

        if (is_null($date_from) && is_null($date_from)) {
            # code...
            $date_from_name = $date_to_name = 'null';
        } else {
            $date_from_name = $date_from;
            $date_to_name = $date_to;
        }

        $viewHtml  = view('laporan/form_laporan_payment', [
            'dHeaderRekening' => $dataRekeningHeader, 
            'dPayment' => $dataPayment, 
            'dDate_from' => $date_from_name,
            'dDate_to' => $date_to_name,
            'dSum' => $dataSum,
        ]);
        $mpdf->WriteHTML($viewHtml);
        $mpdf->shrink_tables_to_fit = 1;

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Form Verifikasi' . 
        ' (' . $date_from_name . ') ' . 
        ' - ' .
        ' (' . $date_to_name . ') ' .
        '.pdf', 'I');
    }

    public function getLapinvoice ($ket_payment, $ket_invoice, $date_from, $date_to){
        $dataInvoice = array();
        $datefrom = null;
        $dateto = null;
        $model = new ModelLaporan();
        if ($ket_payment == 0) {
            # code...
            $ket_payment = array('sisa_hutang >' => 0);
        } else if($ket_payment == 1) {
            $ket_payment = array('sisa_hutang =' => 0);
        } else {
            $ket_payment = null;
        }

        if ($ket_invoice == 0) {
            # code...
            $ket_invoice = array('ket_invoice' => 0);
        } else if($ket_invoice == 1) {
            $ket_invoice = array('ket_invoice' => 1);
        } else {
            $ket_invoice = null;
        }

        if ($date_from == "null" || $date_from == "undefined") {$date_from = null; } else {
            $datefrom = array('tgl_invoice >=' => $date_from);            
        }
        if ($date_to == "null" || $date_to == "undefined") {$date_to = null; } else {
            $dateto = array('tgl_invoice <=' => $date_to);            
        }

        $data = $model->getLapInvoice($ket_payment ,$ket_invoice, $datefrom, $dateto);
        foreach ($data as $key) {
            # code...
            if ($key->no_retur == null) {
                # code...
                $no_retur = '-';
            } else {
                $no_retur = $key->no_retur;
            }
            $invoice = array(
                'no_invoice' => $key->no_invoice,
                'nilai_invoice' => number_format($key->nilai_invoice,0,',','.'),
                'tgl_invoice' => $key->tgl_invoice,
                'jth_tmpo' => $key->jth_tmpo,
                'sisa_hutang' => number_format($key->sisa_hutang,0,',','.'),
                'nama_cstmr' => $key->nama_cstmr,
                'nama_usaha' => $key->nama_usaha,
                'ket_invoice' => $key->ket_invoice,
                'no_retur' => $no_retur,
                'potongan_retur' => number_format($key->potongan_retur,0,',','.')
            );
            array_push($dataInvoice, $invoice);            
        }
        echo json_encode($dataInvoice);
    }

    public function getLaporanSumInvoice($ket_payment, $ket_invoice, $date_from, $date_to)
    {
        $datefrominvoice = null;
        $datetoinvoice = null;

        $model = new ModelLaporan();
        if ($ket_payment == 0) {
            # code...
            $ket_payment = array('sisa_hutang >' => 0);
        } else if($ket_payment == 1) {
            $ket_payment = array('sisa_hutang =' => 0);
        } else {
            $ket_payment = null;
        }

        if ($ket_invoice == 0) {
            # code...
            $ket_invoice = array('ket_invoice' => 0);
        } else if($ket_invoice == 1) {
            $ket_invoice = array('ket_invoice' => 1);
        } else {
            $ket_invoice = null;
        }

        if ($date_from == "null" || $date_from == "undefined") {$date_from = null; } else {
            $datefrominvoice = array('tgl_invoice >=' => $date_from);            
            $datefromretur = array('tgl_retur <=' => $date_to);            
        }
        if ($date_to == "null" || $date_to == "undefined") {$date_to = null; } else {
            $datetoinvoice = array('tgl_invoice <=' => $date_to);            
            $datetoretur = array('tgl_retur <=' => $date_to);            
        }

        $dataTotalInvoice = $model->getLaporanSumInvoice($ket_payment, $ket_invoice, $datefrominvoice, $datetoinvoice);
        $dataTotalHutang = $model->getLaporanSumSisaHutang($ket_payment, $ket_invoice, $datefrominvoice, $datetoinvoice);
        $dataPotonganRetur = $model->getLaporanSumPotonganRetur($ket_payment, $ket_invoice, $datefrominvoice, $datetoinvoice);
        $dataTotal = array(
            'total_invoice' => number_format($dataTotalInvoice[0]->sum_nilai_invoice,0,',','.'),
            'total_hutang' => number_format($dataTotalHutang[0]->sum_sisa_hutang,0,',','.'),
            'potongan_retur' => number_format($dataPotonganRetur[0]->sum_potongan_retur,0,',','.'),
        );
        echo json_encode($dataTotal);
    }

    public function CetakLaporanInvoice($ket_payment, $ket_invoice, $date_from, $date_to){
        $model = new ModelLaporan();
        $date_from_name = null;
        $date_to_name = null;

        if ($ket_payment == 0) {
            # code...
            $ket_payment_array = array('sisa_hutang >' => 0);
        } else if($ket_payment == 1) {
            $ket_payment_array = array('sisa_hutang =' => 0);
        } else {
            $ket_payment_array = null;
        }

        if ($ket_invoice == 0) {
            # code...
            $ket_invoice_array = array('ket_invoice' => 0);
        } else if($ket_invoice == 1) {
            $ket_invoice_array = array('ket_invoice' => 1);
        } else {
            $ket_invoice_array = null;
        }

        if ($date_from == "null" || $date_from == "undefined") {$date_from_array = null; } else {
            $date_from_array = array('tgl_invoice >=' => $date_from);            
        }
        if ($date_to == "null" || $date_to == "undefined") {$date_to_array = null; } else {
            $date_to_array = array('tgl_invoice <=' => $date_to);            
        }

        $dataInvoice = $model->getLapinvoice($ket_payment_array, $ket_invoice_array, $date_from_array, $date_to_array);

        $dataTotalInvoice = $model->getLaporanSumInvoice($ket_payment_array, $ket_invoice_array, $date_from_array, $date_to_array);
        $dataTotalHutang = $model->getLaporanSumSisaHutang($ket_payment_array, $ket_invoice_array, $date_from_array, $date_to_array);
        $dataPotonganRetur = $model->getLaporanSumPotonganRetur($ket_payment_array, $ket_invoice_array, $date_from_array, $date_to_array);
        $dataSum = array(
            'total_invoice' => number_format($dataTotalInvoice[0]->sum_nilai_invoice,0,',','.'),
            'total_hutang' => number_format($dataTotalHutang[0]->sum_sisa_hutang,0,',','.'),
            'potongan_retur' => number_format($dataPotonganRetur[0]->sum_potongan_retur,0,',','.'),
        );
        $mpdf = new \Mpdf\Mpdf();

        if (is_null($date_from) && is_null($date_from)) {
            # code...
            $date_from_name = $date_to_name = 'null';
        } else {
            $date_from_name = $date_from;
            $date_to_name = $date_to;
        }

        $viewHtml  = view('laporan/form_laporan_invoice', [
            'dKetPayment' => $ket_payment, 
            'dKetInvoice' => $ket_invoice, 
            'dInvoice' => $dataInvoice, 
            'dDate_from' => $date_from_name,
            'dDate_to' => $date_to_name,
            'dSum' => $dataSum,
        ]);
        $mpdf->WriteHTML($viewHtml);
        $mpdf->shrink_tables_to_fit = 1;

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Form Verifikasi' . 
        ' (' . $date_from_name . ') ' . 
        ' - ' .
        ' (' . $date_to_name . ') ' .
        '.pdf', 'I');
    }
}
