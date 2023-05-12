<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelPayment;
use App\Models\ModelInvoice;
use Mpdf\Mpdf;

class Payment extends BaseController
{
    public function index($where, $date_from, $date_to)
    {
        $dataPaymet = array();
        $model = new ModelPayment();
        if ($where == "null" || $where == "undefined") {$where = null; } else {
            $where = array('id_rekening_penerima' => $where);            
        }
        if ($date_from == "null" || $date_from == "undefined") {$date_from = null; } else {
            $date_from = array('tgl_pembayaran >=' => $date_from);            
        }
        if ($date_to == "null" || $date_to == "undefined") {$date_to = null; } else {
            $date_to = array('tgl_pembayaran <=' => $date_to);            
        }
        $data = $model->getPayment($where, $date_from, $date_to);
        foreach ($data as $key) {
            # code...
            $invoice = array(
                'id' => $key->id,
                'no_payment' => $key->no_payment,
                'id_rekening_penerima' => $key->id_rekening_penerima,
                'id_customer' => $key->id_customer,
                'nama_rekening' => $key->nama_rekening,
                'nomor_rekening' => $key->nomor_rekening,
                'keterangan_penerima' => $key->keterangan_penerima,
                'nama_cstmr' => $key->nama_cstmr,
                'nama_usaha' => $key->nama_usaha,
                'atas_nama' => $key->atas_nama,
                'nominal_payment' => number_format($key->nominal_payment,0,',','.'),
                'tgl_pembayaran' => $key->tgl_pembayaran,
                'keterangan_payment' => $key->keterangan_payment,
                'verifikasi' => $key->verifikasi
            );
            array_push($dataPaymet, $invoice);            
        }
        echo json_encode($dataPaymet);
    }

    public function getDetail ($where) {
        $model = new ModelPayment();
        $where = array('tb_payment.id' => $where);
        $dataPayment = $model->getPayment($where, null, null);

        echo json_encode($dataPayment);
    }

    public function getInvoiceDetail ($id_payment) {
        $dataPaymet = array();
        $model = new ModelPayment();
        $id_payment = array('invoice_payment.id_payment' => $id_payment);            
        $data = $model->getInvoiceDetail($id_payment);
        foreach ($data as $key) {
            # code...
            $invoice = array(
                'id' => $key->id,
                'no_invoice' => $key->no_invoice,
                'nilai_invoice' => number_format($key->nilai_invoice,0,',','.'),
                'tgl_invoice' => $key->tgl_invoice,
                'nominal_payment_invoice' => number_format($key->nominal_payment_invoice,0,',','.'),
            );
            array_push($dataPaymet, $invoice);            
        }
        
        echo json_encode($dataPaymet);
    }

    public function updateData ($where) {
        $errortext[] = null;
        $message = null;
        $model = new ModelPayment();
        $where = array('tb_payment.id' => $where);
        $dataJSON = $this->request->getJSON(true);

        $dataText = array(
            'id_rekening_penerima' => $dataJSON['id_rekening_penerima'],
            'keterangan' => $dataJSON['keterangan_payment'],
            'verifikasi' => $dataJSON['verifikasi'],
        );
        // echo json_encode($dataText); die;
        if ($this->validator->run($dataText, 'paymenttextupdate')) {
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

    public function verification () {
        $errortext[] = null;
        $message = null;
        $model = new ModelPayment();
        $dataJSON = $this->request->getJSON(true);
        $where = array('tb_payment.id' => $dataJSON['id']);

        $dataText = array(
            'tb_payment.verifikasi' => 1,
        );
        if ($model->updateData($where, $dataText)) {
            # code...
            $message = "Berhasil Mengubah Data";
        } else {
            # code...
            $errortext[] = "Gagal Menyimpan Data";
        }
        $validationtext = implode("", $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function payment ($where, $type) {
        $session = session();
        $id_user = $session->get('id');
        $mPayment = new ModelPayment();
        $mInvoice = new ModelInvoice();
        $dataJSON = $this->request->getPost();
        $fileBuktiTransfer = $this->request->getFile('file');
        $fileBuktiTransfer = array('file_bukti_tf' => $fileBuktiTransfer);
        $errortext[] = '';
        $message = '';
        $nominal_payment = $dataJSON['nominal_payment'];
        $uang = null;
        $lastinsert_id = null;
        $dataInvoicePayment = array();
        $dataInvoiceUpdate = array();
        $invoice_payment = array();
        $invoice = array();
        $dataInsertPayment = array();
        $sisa_hutang = null;
        $verifikasi = null;

        if ($dataJSON['keterangan'] == '0') {
            # code...
            $verifikasi = 1;
        } elseif ($dataJSON['keterangan'] == '1') {
            $verifikasi = 0;
        }

        if ($this->validator->run($fileBuktiTransfer, 'file_bukti_tf')) {
            $file_bukti_tf = $fileBuktiTransfer['file_bukti_tf']->getRandomName();
            if ($dataJSON['atas_nama_pembayar'] == 'undefined' || $dataJSON['nama_bank'] == 'undefined' || $dataJSON['rekening_pembayar'] == 'undefined' ||
            $dataJSON['atas_nama_pembayar'] == '' || $dataJSON['nama_bank'] == '' || $dataJSON['rekening_pembayar'] == '' ||
            $dataJSON['atas_nama_pembayar'] == 'null' || $dataJSON['nama_bank'] == 'null' || $dataJSON['rekening_pembayar'] == 'null') {
                # code...
                $dataInsertPayment = array(
                    'no_payment' => $dataJSON['no_payment'],
                    'nominal_payment' => $dataJSON['nominal_payment'],
                    'tgl_pembayaran' => $dataJSON['tgl_pembayaran'],
                    'id_rekening_penerima' => $dataJSON['id_rekening_penerima'],
                    'keterangan' => $dataJSON['keterangan'],
                    'file_bukti_tf' => $file_bukti_tf,
                    'verifikasi' => $verifikasi,
                    'id_user' => $id_user
                );
            } else {
                $dataInsertPayment = array(
                    'no_payment' => $dataJSON['no_payment'],
                    'nominal_payment' => $dataJSON['nominal_payment'],
                    'tgl_pembayaran' => $dataJSON['tgl_pembayaran'],
                    'id_rekening_penerima' => $dataJSON['id_rekening_penerima'],
                    'keterangan' => $dataJSON['keterangan'],
                    'file_bukti_tf' => $file_bukti_tf,  
                    'verifikasi' => $verifikasi,  
                    'id_user' => $id_user,  
                    'keterangan_pembayaran' => $dataJSON['rekening_pembayar'] . " (" . $dataJSON['nama_bank'] . ")" . " - " . $dataJSON['atas_nama_pembayar']
                );
            }
            if ($type == 'single') {
                # code...
                $where = array('tb_invoice.id' => $where);
                $dataInvoice = $mInvoice->getInvoice($where);
            } else if ($type == 'multiple') {
                # code...
                $where = array('tb_invoice.id_customer' => $where);
                $dataInvoice = $mInvoice->getInvoice($where);
            } 
    
            if ($this->validator->run($dataInsertPayment, 'paymenttext')) {
                $lastinsert_id = $mPayment->insertPayment($dataInsertPayment);
                foreach ($dataInvoice as $key) {
                    # code...
                    $sisa_hutang = $sisa_hutang + $key->sisa_hutang;
                }
                $uang = $nominal_payment;
                if ($sisa_hutang != null && $sisa_hutang >= $uang) {
                    # code...
                    foreach ($dataInvoice as $key) {
                        # code...
                        if ($key->sisa_hutang != 0) {
                            # code...
                            if ($uang > $key->sisa_hutang) {
                                # code...
                                $uang = $uang - $key->sisa_hutang;
                                $invoice_payment = array(
                                    'id_invoice' => $key->id,
                                    'id_payment' => $lastinsert_id,
                                    'nominal_payment_invoice' => $key->sisa_hutang,
                                );
                                $invoice = array(
                                    'id' => $key->id,
                                    'sisa_hutang' => 0,
                                );
                            } elseif ($uang == $key->sisa_hutang) {
                                # code...
                                $uang = $uang - $key->sisa_hutang;
                                $invoice_payment = array(
                                    'id_invoice' => $key->id,
                                    'id_payment' => $lastinsert_id,
                                    'nominal_payment_invoice' => $key->sisa_hutang,
                                );
                                $invoice = array(
                                    'id' => $key->id,
                                    'sisa_hutang' => 0,
                                );
                            } elseif ($uang < $key->sisa_hutang) {
                                # code...
                                $invoice_payment = array(
                                    'id_invoice' => $key->id,
                                    'id_payment' => $lastinsert_id,
                                    'nominal_payment_invoice' => $uang,
                                );
                                $invoice = array(
                                    'id' => $key->id,
                                    'sisa_hutang' => $key->sisa_hutang - $uang,
                                );
                                $uang = 0;
                            }
                            if ($invoice_payment['nominal_payment_invoice'] != 0) {
                                # code...
                                array_push($dataInvoicePayment, $invoice_payment);
                                array_push($dataInvoiceUpdate, $invoice);
                            }
                        }
                    }
                    // check file bukti transfer
                    if ($this->validator->run($fileBuktiTransfer, 'file_bukti_tf')) {
                        # code...
                        if ($fileBuktiTransfer['file_bukti_tf']->move("./bukti_transfer/", $file_bukti_tf)) {
                            # code...
                            $mPayment->payment($dataInvoiceUpdate, $dataInvoicePayment);
                            $message = "Berhasil Melakukan Pembayaran";
                        } else {
                            $errortext[] = "Gagal Melakukan Upload Bukti Pembayaran";
                        }
                    } else {
                        $errortext[] = implode(', ', $this->validator->getErrors());
                    }
                } else {
                    $where = array('id' => $lastinsert_id);
                    $mPayment->deleteDatWhenErrorInsert($where);
                    $errortext[] = 'Gagal Melakukan Pembayaran';
                }
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }        
            
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    // public function payment ($where, $type) {
    //     $mPayment = new ModelPayment();
    //     $mInvoice = new ModelInvoice();
    //     $dataInsertPayment = $this->request->getJSON(true);
    //     echo json_encode($dataInsertPayment); die;
    //     $errortext[] = '';
    //     $message = '';
    //     $nominal_payment = $dataInsertPayment['nominal_payment'];
    //     $uang = null;
    //     // $dataInvoiceUpdate = array();
    //     // $nominal_payment_invoice = null;
    //     $lastinsert_id = null;
    //     $dataInvoicePayment = array();
    //     $dataInvoiceUpdate = array();
    //     $data = array(
    //         'keterangan' => '0',
    //     );
    //     $invoice_payment = array();
    //     $invoice = array();
    //     if ($type == 'single') {
    //         # code...
    //         $where = array('tb_invoice.id' => $where);
    //         $dataInvoice = $mInvoice->getInvoice($where);
    //     } else if ($type == 'multiple') {
    //         # code...
    //         $where = array('tb_invoice.id_customer' => $where);
    //         $dataInvoice = $mInvoice->getInvoice($where);
    //     } 

    //     if ($this->validator->run($dataInsertPayment, 'paymenttext')) {
    //         $dataInsertPayment = array_merge($dataInsertPayment, $data);
    //     } else {
    //         $errortext[] = implode(', ', $this->validator->getErrors());
    //     }
    //     $lastinsert_id = $mPayment->insertPayment($dataInsertPayment);

    //     if ($lastinsert_id != null) {
    //         # code...
    //         $uang = $nominal_payment;
    //         foreach ($dataInvoice as $key) {
    //             # code...
    //             # code...
    //             if ($key->sisa_hutang != 0) {
    //                 # code...
    //                 if ($uang > $key->sisa_hutang) {
    //                     # code...
    //                     $uang = $uang - $key->sisa_hutang;
    //                     $invoice_payment = array(
    //                         'id_invoice' => $key->id,
    //                         'id_payment' => $lastinsert_id,
    //                         'nominal_payment_invoice' => $key->sisa_hutang,
    //                     );
    //                     $invoice = array(
    //                         'id' => $key->id,
    //                         'sisa_hutang' => 0,
    //                     );
    //                 } elseif ($uang == $key->sisa_hutang) {
    //                     # code...
    //                     $uang = $uang - $key->sisa_hutang;
    //                     $invoice_payment = array(
    //                         'id_invoice' => $key->id,
    //                         'id_payment' => $lastinsert_id,
    //                         'nominal_payment_invoice' => $key->sisa_hutang,
    //                     );
    //                     $invoice = array(
    //                         'id' => $key->id,
    //                         'sisa_hutang' => 0,
    //                     );
    //                 } elseif ($uang < $key->sisa_hutang) {
    //                     # code...
    //                     $invoice_payment = array(
    //                         'id_invoice' => $key->id,
    //                         'id_payment' => $lastinsert_id,
    //                         'nominal_payment_invoice' => $uang,
    //                     );
    //                     $invoice = array(
    //                         'id' => $key->id,
    //                         'sisa_hutang' => $key->sisa_hutang - $uang,
    //                     );
    //                     $uang = 0;
    //                 }
    //                 if ($invoice_payment['nominal_payment_invoice'] != 0) {
    //                     # code...
    //                     array_push($dataInvoicePayment, $invoice_payment);
    //                     array_push($dataInvoiceUpdate, $invoice);
    //                 }
    //             }
    //         }
    //         if ($mPayment->paymentAll($dataInvoiceUpdate, $dataInvoicePayment)) {
    //             # code...
    //             $message = 'Berhasil Melakukan Pembayaran';
    //         } else {
    //             $errortext[] = 'Gagal Melakukan Pembayaran';
                
    //         }
    //     }
    //     $validationtext = implode('', $errortext);
    //     $output = array('errortext' => $validationtext, 'message' => $message);
    //     echo json_encode($output);
    // }

    public function deleteData () {
        $model = new ModelPayment();
        $mInvoice = new ModelInvoice();
        $dataJSON = $this->request->getJSON(true);
        $dataInvoicePaymentUpdate = array();
        $dataInvoice = array();
        $id_payment = array();
        $invoice = array();
        $id = $dataJSON['id'];
        $id_payment = array('id' => $id);
        $id_payment_invoice_payment = array('invoice_payment.id_payment' => $id);
        $dataInvoicePayment = $model->getInvoicePayment($id_payment_invoice_payment);
        $whereIdinvoice = array();

        foreach ($dataInvoicePayment as $key) {
            $id_invoice = array('tb_invoice.id' => $key->id_invoice);
            $getInvoice = $mInvoice->getInvoice($id_invoice);
            # code...
            foreach ($getInvoice as $invo) {
                # code...
                $where = array(
                    'id' => $invo->id,
                );
                
                $invoice = array(
                    'id' => $invo->id,
                    'sisa_hutang' => $invo->sisa_hutang + $key->nominal_payment_invoice
                );
                array_push($whereIdinvoice, $where);
                array_push($dataInvoice, $invoice);
            }
        }
        // echo json_encode($where); die;
        $model->deleteData($dataInvoice, $id_payment_invoice_payment, $id_payment);
        return true;
    }

    public function cetakPayment($id_rekening_penerima, $date_from, $date_to){
        $model = new ModelPayment();
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
            $dataRekeningHeader = $model->getPayment($id_rekening_penerima, $date_from_array, $date_to_array, $date_from_array);
        } else {
            $dataRekeningHeader = "undefined";
        }
        $dataPayment = $model->getPayment($id_rekening_penerima, $date_from_array, $date_to_array, $date_from_array);
        $mpdf = new \Mpdf\Mpdf();

        if (is_null($date_from) && is_null($date_from)) {
            # code...
            $date_from_name = $date_to_name = 'null';
        } else {
            $date_from_name = $date_from;
            $date_to_name = $date_to;
        }

        $viewHtml  = view('laporan/formlaporan', [
            'dHeaderRekening' => $dataRekeningHeader, 
            'dPayment' => $dataPayment, 
            'dDate_from' => $date_from_name,
            'dDate_to' => $date_to_name
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
