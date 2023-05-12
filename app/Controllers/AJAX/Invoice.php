<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelInvoice;
use App\Models\ModelRetur;

class Invoice extends BaseController
{
    public function index()
    {
        $model = new ModelInvoice();
        $data = $model->getInvoice(null);
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
                'termin' => $key->termin,
                'jth_tmpo' => $key->jth_tmpo,
                'sisa_hutang' => $key->sisa_hutang,
                'id_customer' => $key->id_customer,
                'nama_cstmr' => $key->nama_cstmr,
                'atas_nama' => $key->atas_nama,
                'nama_usaha' => $key->nama_usaha,
                'id_user' => $key->id_user,
                'ket_invoice' => $key->ket_invoice,
                'id_retur' => $key->id_retur,
                'potongan_retur' => $key->potongan_retur,
                'sts_jth_tmpo' => $sts_jth_tmpo
            );
            array_push($dataInvoice, $invoice);            
        }
        
        echo json_encode($dataInvoice);
    }

    public function insertData(){
        $session = session();
        $model = new ModelInvoice();
        $modelRetur = new ModelRetur();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        $jth_tmpo = date('Y-m-d', strtotime('+'.$dataJSON['termin'].' days', strtotime($dataJSON['tgl_invoice']))); 
        $nilai_sisa_retur = 0;
        $id_user = $session->get('id');

        if ($dataJSON['id_retur'] == 'undefined') {
            # code...
            $data = array(
                'no_invoice' => $dataJSON['no_invoice'],
                'tgl_invoice' => $dataJSON['tgl_invoice'],
                'termin' => $dataJSON['termin'],
                'jth_tmpo' => $jth_tmpo,
                'nilai_invoice' => $dataJSON['nilai_invoice'],
                'sisa_hutang' => $dataJSON['nilai_invoice'],
                'id_customer' => $dataJSON['id_customer'],
                'ket_invoice' => $dataJSON['ket_invoice'],
                'id_user' => $id_user,
            );
            if ($this->validator->run($data, 'invoicetext')) {
                # code...
                if ($model->insertData($data)) {
                    # code...
                    $message = "Berhasil Menyimpan Data";
                } else {
                    $errortext[] = "Gagal Menyimpan Data";
                }
            } else {
                # code...
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        } else {
            $sisa_hutang_invoice = $dataJSON['nilai_invoice'] - $dataJSON['nilai_sisa_retur'];
            if ($sisa_hutang_invoice >= 0) {
                # code...
                $data = array(
                    'no_invoice' => $dataJSON['no_invoice'],
                    'tgl_invoice' => $dataJSON['tgl_invoice'],
                    'termin' => $dataJSON['termin'],
                    'jth_tmpo' => $jth_tmpo,
                    'nilai_invoice' => $dataJSON['nilai_invoice'],
                    'sisa_hutang' => $sisa_hutang_invoice,
                    'id_customer' => $dataJSON['id_customer'],
                    'ket_invoice' => $dataJSON['ket_invoice'],
                    'id_user' => $id_user,
                    'id_retur' => $dataJSON['id_retur'],
                    'potongan_retur' => $dataJSON['nilai_sisa_retur'],
                );
            } else if ($sisa_hutang_invoice < 0) {
                # code...
                $nilai_sisa_retur = $dataJSON['nilai_sisa_retur'] - $dataJSON['nilai_invoice'];
                $data = array(
                    'no_invoice' => $dataJSON['no_invoice'],
                    'tgl_invoice' => $dataJSON['tgl_invoice'],
                    'termin' => $dataJSON['termin'],
                    'jth_tmpo' => $jth_tmpo,
                    'nilai_invoice' => $dataJSON['nilai_invoice'],
                    'sisa_hutang' => 0,
                    'id_customer' => $dataJSON['id_customer'],
                    'ket_invoice' => $dataJSON['ket_invoice'],
                    'id_retur' => $dataJSON['id_retur'],
                    'potongan_retur' => $dataJSON['nilai_sisa_retur'] - $nilai_sisa_retur,
                );
            }
            $where = array('tb_retur.id' => $dataJSON['id_retur']);
                $updateRetur = $modelRetur->getRetur($where);
                foreach ($updateRetur as $key) {
                    # code...
                    if ($key->nilai_sisa_retur > 0) {
                        # code...
                        $id_retur = array('tb_retur.id' => $key->id);
                        if ($nilai_sisa_retur >= 0) {
                            # code...
                            $retur = array(
                                'id' => $key->id,
                                'nilai_sisa_retur' => $nilai_sisa_retur,
                            );
                        } else{
                            $errortext[] = "Nilai Retur Tidak Mencukupi";
                        }
                        if ($this->validator->run($data, 'invoicetext')) {
                            # code...
                            if ($model->insertWithRetur($data, $retur, $id_retur)) {
                                # code...
                                $message = "Berhasil Menyimpan Data";
                            } else {
                                $errortext[] = "Gagal Menyimpan Data";
                            }
                        } else {
                            # code...
                            $errortext[] = implode(', ', $this->validator->getErrors());
                        }
                    } else {
                        $errortext[] = "Nilai Retur Tidak Mencukupi";
                    }
                }
            
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function deleteData () {
        $model = new ModelInvoice();
        $modelRetur = new ModelRetur();
        $dataJSON = $this->request->getJSON(true);
        $where = array('id' => $dataJSON['id']);
        $id_retur = array('id' => $dataJSON['id_retur']);
        if ($dataJSON['id_retur'] != NULL) {
            # code...
            $dataRetur = $modelRetur->getRetur($id_retur);
            foreach ($dataRetur as $key) {
                # code...
                $dataReturUpdate = array(
                    'id' => $dataJSON['id_retur'],
                    'nilai_sisa_retur' => $key->nilai_sisa_retur + $dataJSON['nilai_dibayar']
                );
            }
            $query = $model->deleteDataUpdateRetur($where, $id_retur, $dataReturUpdate);
        } else{
            $query = $model->deleteData($where);
        }
        return true;
    }

    public function getDetail ($where) {
        $model = new ModelInvoice();
        $where = array('tb_invoice.id' => $where);
        $data = $model->getInvoice($where);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelInvoice();
        $where = array('tb_invoice.id' => $where);
        $dataJSON = $this->request->getJSON(true);
        $jth_tmpo = date('Y-m-d', strtotime('+'.$dataJSON['termin'].' days', strtotime($dataJSON['tgl_invoice']))); 

        $dataText = array(
            'no_invoice' => $dataJSON['no_invoice'],
            'tgl_invoice' => $dataJSON['tgl_invoice'],
            'termin' => $dataJSON['termin'],
            'jth_tmpo' => $jth_tmpo,
            'id_customer' => $dataJSON['id_customer'],
            'ket_invoice' => $dataJSON['ket_invoice'],
        );
        if ($this->validator->run($dataText, 'invoicetextupdate')) {
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
}
