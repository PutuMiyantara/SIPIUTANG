<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelInvoice;
use App\Models\ModelCustomer;

class Piutang extends BaseController
{
    // dasar rumus menentukan jumlah hutang invoice dan jumlah hutang ekspedisi
    public function index ($id)
    {
        $id = $id;
        if ($id == 'undefined'|| $id == 'null') {
            # code...
            $id = null;
        } 
        else{
            $id = array('id_customer' => $id);
        }
        $mInvoice = new ModelInvoice();
        $dataPiutang = array();
        $dataHutangTotal = $mInvoice->getHutang($id);

        // echo json_encode($dataHutangTotal); die;
        foreach ($dataHutangTotal as $key) {
            # code...
            // $sisa_hutang_ekspedisi = doubleval($key->sisa_hutang_ekspedisi);
            $status_piutang = 0;
            if ($key->hutang_invoice == 0) {
                # code...
                $status_piutang = 1;
            }
            $whereinvoice = array('id_customer' => $key->id_customer);
            $dataTanggalInvoice = $mInvoice->getInvoice($whereinvoice);
            $tgl_invoice = null;
            $jth_tmpo = null;
            foreach ($dataTanggalInvoice as $tgl) {
                # code...
                $tgl_invoice = $tgl->tgl_invoice;
                $jth_tmpo = $tgl->jth_tmpo;
            }

            $data = array(
                'id_customer' => $key->id_customer,
                'nama_usaha' => $key->nama_usaha,
                'nama_cstmr' => $key->nama_cstmr,
                'telepon' => $key->telepon,
                'atas_nama' => $key->atas_nama,
                'hutang_invoice' => number_format($key->hutang_invoice,0,',','.'),
                'tgl_invoice' => $tgl_invoice,
                'jth_tmpo' => $jth_tmpo,
            );
            array_push($dataPiutang, $data);
        }
        echo json_encode($dataPiutang);
    }

    public function deleteDetailPiutang () {
        $model = new ModelInvoice();
        $where = $this->request->getJSON(true);
        $data = $model->deleteData($where);
        return false;
    }

    public function getDetailHutang ($id_customer) {
        $mInvoice = new ModelInvoice();
        $where = array('tb_invoice.id_customer' => $id_customer);
        $data = $mInvoice->getDetailHutang($where);
        $dataInvoice = array();
        $date_now = date("Y-m-d");
        $sts_jth_tmpo = false;
        foreach ($data as $key) {
            # code...
            if ($date_now >= $key->jth_tmpo) {
                # code...
                $sts_jth_tmpo = true;
            }
            $invoice = array(
                'id' => $key->id,
                'no_invoice' => $key->no_invoice,
                'nilai_invoice' => number_format($key->nilai_invoice,0,',','.'),
                'tgl_invoice' => $key->tgl_invoice,
                'tgl_invoice' => $key->tgl_invoice,
                'jth_tmpo' => $key->jth_tmpo,
                'sts_jth_tmpo' => $sts_jth_tmpo,
                'sisa_hutang' => number_format($key->sisa_hutang,0,',','.'),
                'ket_invoice' => $key->ket_invoice,
                'id_customer' => $key->id_customer
            );
            array_push($dataInvoice, $invoice);            
        }
        
        echo json_encode($dataInvoice);
    }

    public function getDetailInvoice ($id_customer, $id_invoice_ekspedisi) {
        $model = new ModelInvoice();
        $id_customer = array('tb_invoice.id_customer' => $id_customer);
        $id_invoice_ekspedisi = array('tb_invoice.id_invoice_ekspedisi' => $id_invoice_ekspedisi);
        $data = $model->getDetailPiutangInvoice($id_customer, $id_invoice_ekspedisi);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelInvoice();
        $where = array('id' => $where);
        $dataJSON = $this->request->getJSON(true);

        $tgl_invoice = $dataJSON['tgl_invoice'];
        $arrayDate = explode('-' ,$tgl_invoice);
        $arrayDate[2] = $arrayDate[2] + $dataJSON['termin'];
        $jth_tmpo = implode('-',$arrayDate);


        $dataText = array(
            'no_invoice' => $dataJSON['no_invoice'],
            'nilai_invoice' => $dataJSON['nilai_invoice'],
            'tgl_invoice' => $dataJSON['tgl_invoice'],
            'status_piutang' => $dataJSON['status_piutang'],
            'termin' => $dataJSON['termin'],
            'jth_tmpo' => $jth_tmpo,
            'sisa_hutang' => $dataJSON['nilai_invoice'],
            'id_customer' => $dataJSON['id_customer'],
            'id_invoice_ekspedisi' => $dataJSON['id_invoice_ekspedisi'],
        );
        if ($this->validator->run($dataText, 'invoicetext')) {
            # code...
            if ($model->updateData($where, $dataText)) {
                # code...
                $message = "Berhasil Mengubah Data";
            } else {
                # code...
                $errortext[] = "Gagal Menyimpan Data";
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode("", $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getNotifikasi ()
    {
        $date_now = date("Y-m-d");
        $mInvoice = new ModelInvoice();
        $dataPiutang = array();
        $dateJthTmpo = array('jth_tmpo <=' => $date_now);
        $sisaHutang = array('sisa_hutang >' => 0);
        $dataHutangTotal = $mInvoice->getNotifikasi($dateJthTmpo, $sisaHutang);

        foreach ($dataHutangTotal as $key) {
            # code...
            $data = array(
                'id_customer' => $key->id_customer,
                'nama_usaha' => $key->nama_usaha,
                'nama_cstmr' => $key->nama_cstmr,
                'atas_nama' => $key->atas_nama,
                'hutang_invoice' => number_format($key->hutang_invoice,0,',','.'),
            );
            array_push($dataPiutang, $data);
        }
        echo json_encode($dataPiutang);
    }
}
