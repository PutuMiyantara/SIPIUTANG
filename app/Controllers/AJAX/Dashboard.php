<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelCustomer;
use App\Models\ModelInvoice;
use App\Models\ModelLaporan;
use App\Models\ModelPayment;

class Dashboard extends BaseController
{
    public function getDataBoxDash()
    {
        $mLaporan = new ModelLaporan();
        $arrayPayment = [];
        $datefrom = date("Y") . '-01-01';
        $dateto = date("Y") . '-12-31';
        $output = array();

        $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
        $dateToInvoice = array('tgl_invoice <=' => $dateto);

        $dateFromPayment = array('tgl_pembayaran >=' => $datefrom);
        $dateToPayment = array('tgl_pembayaran <=' => $dateto);
        
        $dataInvoice = $mLaporan->getLaporanSumInvoice(null, null,$dateFromInvoice, $dateToInvoice);
        if (sizeof($dataInvoice) != 0) {
            # code...
            $data = array(
                'data_count' => number_format($dataInvoice[0]->count_invoice,0,',','.'),
                'data_sum' => number_format($dataInvoice[0]->sum_nilai_invoice,0,',','.')
            );
        } else {
            $data = array(
                'data_count' => number_format(0,0,',','.'),
                'data_sum' => number_format(0,0,',','.')
            );
        }
        array_push($output, $data);
        
        $wherePayment = array('verifikasi' => '1');
        $dataPayment = $mLaporan->getLaporanSumPayment($wherePayment ,$dateFromPayment, $dateToPayment);
        if (sizeof($dataPayment) != 0) {
            # code...
            $data = array(
                'data_count' => number_format($dataPayment[0]->count_payment,0,',','.'),
                'data_sum' => number_format($dataPayment[0]->sum_nominal_payment,0,',','.')
            );
        } else {
            $data = array(
                'data_count' => number_format(0,0,',','.'),
                'data_sum' => number_format(0,0,',','.')
            );
        }
        array_push($output, $data);
        
        $dataCustomer = $mLaporan->getLapCustomer($wherePayment ,$dateFromPayment, $dateToPayment);
        if (sizeof($dataCustomer) != 0) {
            # code...
            $data = array(
                'data_count' => number_format($dataCustomer[0]->count_cstmr,0,',','.'),
                'data_sum' => null
            );
        } else {
            $data = array(
                'data_count' => number_format(0,0,',','.'),
                'data_sum' => null
            );
        }
        array_push($output, $data);
        
        $whereInvoice = array('sisa_hutang >' => 0);
        $dataSisaHutang = $mLaporan->getLaporanSumInvoice($whereInvoice ,null ,$dateFromInvoice, $dateToInvoice);
        if (sizeof($dataSisaHutang) != 0) {
            # code...
            $data = array(
                'data_count' => number_format($dataSisaHutang[0]->count_sisa_hutang,0,',','.'),
                'data_sum' => number_format($dataSisaHutang[0]->sum_sisa_hutang,0,',','.')
            );
        } else {
            $data = array(
                'data_count' => number_format(0,0,',','.'),
                'data_sum' => number_format(0,0,',','.')
            );
        }
        array_push($output, $data);

        echo json_encode($output);
    } 

    public function getChartPiutang()
    {
        $mLaporan = new ModelLaporan();
        $arrayPayment = [];
        $datefrom = date("Y") . '-01-01';
        $dateto = date("Y") . '-12-31';

        $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
        $dateToInvoice = array('tgl_invoice <=' => $dateto);
        $dataInvoice = $mLaporan->getDataInvoiceDashboard($dateFromInvoice, $dateToInvoice);

        if (sizeof($dataInvoice) != 0) {
            # code...
            $hutang_terbayar = $dataInvoice[0]->sum_nilai_invoice - $dataInvoice[0]->sum_sisa_hutang;
            $output = array(
                'sum_nilai_invoice' => number_format($dataInvoice[0]->sum_nilai_invoice,0,',','.'),
                'hutang_terbayar' => $hutang_terbayar,
                'sum_sisa_hutang' => $dataInvoice[0]->sum_sisa_hutang,
                'sum_potongan_retur' => $dataInvoice[0]->sum_potongan_retur,
                'range_date' => $datefrom . " s/d " . $dateto,
            );

        } else {
            $hutang_terbayar = 0;
            $output = array(
                'sum_nilai_invoice' => number_format(0,0,',','.'),
                'hutang_terbayar' => $hutang_terbayar,
                'sum_sisa_hutang' => 0,
                'sum_potongan_retur' => 0,
                'range_date' => $datefrom . " s/d " . $dateto,
            );
        }
        echo json_encode($output);
    } 

    public function getChartTransaksi()
    {
        $mLaporan = new ModelLaporan();
        $arrayInvoice = [];
        $dataBulan = ['1','2','3','4','5','6','7','8','9','10','11','12'];
        // $dataInvoice = $mLaporan->getChartTransaksi($dateFromInvoice, $dateToInvoice);
        
        for ($i=0; $i < 12; $i++) { 
            # code...
            $lastDateInMonth = cal_days_in_month(CAL_GREGORIAN,$dataBulan[$i],date("Y"));
            $datefrom = date("Y") . '-' . $dataBulan[$i] . '-01';
            $dateto = date("Y") . '-' . $dataBulan[$i] . '-' . $lastDateInMonth;

            $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
            $dateToInvoice = array('tgl_invoice <=' => $dateto);
            
            $dataInvoice = $mLaporan->getDataInvoiceDashboard($dateFromInvoice, $dateToInvoice);
            foreach ($dataInvoice as $key) {
                # code...
                if ($key->sum_nilai_invoice == null) {
                    # code...
                    $sum = 0;
                } else {
                    $sum = $key->sum_nilai_invoice;
                }
                $invoice = array(
                    'month' => $dataBulan[$i],
                    'sum_nilai_invoice' => $sum
                );
                array_push($arrayInvoice, $invoice);
            }
        }
        echo json_encode($arrayInvoice);
    }

    // public function getChartTransaksi()
    // {
    //     $mLaporan = new ModelLaporan();
    //     $arrayInvoice = [];
    //     $datefrom = date("Y") . '-01-01';
    //     $dateto = date("Y") . '-12-31';
    //     $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
    //     $dateToInvoice = array('tgl_invoice <=' => $dateto);
    //     $dataBulan = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    //     $dataInvoice = $mLaporan->getChartTransaksi($dateFromInvoice, $dateToInvoice);
        
    //     $dataPerBulan = null;
    //     for ($i=0; $i < 12; $i++) { 
    //         # code...
    //         foreach ($dataInvoice as $key) {
    //             $jumlah = null;
    //             # code...
    //             list($y,$m,$d)=explode('-',$key->tgl_invoice);
    //             if ($dataBulan[$i] == $m) {
    //                 # code...
    //                 $jumlah = $jumlah+$key->nilai_invoice;
    //                 // echo $jumlah;
    //                 $invoiceSum = array(
    //                     'mounth' => $dataBulan[$i],
    //                     'sum' => 'con1',
    //                 );
    //             } else {
    //                 $jumlah = null;
    //                 // echo "-";
    //                 $invoiceSum = array(
    //                     'mounth' => $dataBulan[$i],
    //                     'sum' => 'con2',
    //                 );
    //             }
    //         }
    //         array_push($arrayInvoice, $invoiceSum);      
    //         // echo "</br>";
    //     }
    //     echo json_encode($arrayInvoice);
    // }


    // public function getChartTransaksi()
    // {
    //     $mLaporan = new ModelLaporan();
    //     $arrayInvoice = [];
    //     $datefrom = date("Y") . '-01-01';
    //     $dateto = date("Y") . '-12-31';
    //     $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
    //     $dateToInvoice = array('tgl_invoice <=' => $dateto);
    //     $dataBulan = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    //     $sum = null;
        
    //     $dataInvoice = $mLaporan->getChartTransaksi($dateFromInvoice, $dateToInvoice);
        
    //     $dataPerBulan = null;
    //     for ($i=0; $i < 12; $i++) { 
    //         # code...
    //         $jumlah = null;
    //         foreach ($dataInvoice as $key) {
    //             # code...
    //             list($y,$m,$d)=explode('-',$key->tgl_invoice);
    //             echo $dataBulan[$i];
    //             if ($dataBulan[$i] == $m) {
    //                 # code...
    //                 $jumlah = $jumlah+$key->nilai_invoice;
    //                 echo $jumlah;
    //             } else {
    //                 $jumlah = null;
    //                 echo "-";
    //                 $invoiceSum = array(
    //                     'mounth' => $m,
    //                     'sum' => $jumlah,
    //                 );
    //             }
                
    //         // array_push($arrayInvoice, $invoiceSum);            
    //         }
    //         echo "</br>";
    //     }
    //     echo json_encode($arrayInvoice);
    // }

    // public function getChartTransaksi()
    // {
    //     $mLaporan = new ModelLaporan();
    //     $arrayInvoice = [];
    //     $datefrom = date("Y") . '-01-01';
    //     $dateto = date("Y") . '-12-31';
    //     $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
    //     $dateToInvoice = array('tgl_invoice <=' => $dateto);
    //     $dataBulan = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    //     $sum = null;
        
    //     $dataInvoice = $mLaporan->getChartTransaksi($dateFromInvoice, $dateToInvoice);
        
    //     $dataPerBulan = null;
    //     for ($i=0; $i < 12; $i++) { 
    //         # code...
    //         foreach ($dataInvoice as $key) {
    //             # code...
    //             list($y,$m,$d)=explode('-',$key->tgl_invoice);
    //             if ($dataBulan[$i] == $m) {
    //                 # code...
    //                 echo $m;
    //             } else {
    //                 echo "-";
    //             }
    //         }
    //         echo "</br>";
    //     }
    // }


    // public function getChartTransaksi()
    // {
    //     $mLaporan = new ModelLaporan();
    //     $arrayInvoice = [];
    //     $datefrom = date("Y") . '-01-01';
    //     $dateto = date("Y") . '-12-31';
    //     $dateFromInvoice = array('tgl_invoice >=' => $datefrom);
    //     $dateToInvoice = array('tgl_invoice <=' => $dateto);
    //     $dataBulan = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    //     $sum = null;
        
    //     $dataInvoice = $mLaporan->getChartTransaksi($dateFromInvoice, $dateToInvoice);
        
    //     $dataPerBulan = null;
    //     $i = 0;
    //     foreach ($dataInvoice as $key) {
    //         # code...
    //         $invoiceSum = array();
    //         list($y,$m,$d)=explode('-',$key->tgl_invoice);
    //         echo $dataBulan[$i] .
    //         if ($dataBulan[$i] == $m) {
    //             # code...
    //             $sum = $sum+$key->nilai_invoice;
    //             $invoiceSum = array(
    //                 'bulan' => $m,
    //                 'sum_invoice' => $sum
    //             );
    //         } else {
    //             $invoiceSum = array(
    //                 'bulan' => $m,
    //                 'sum_invoice' => 0
    //             );
    //         }
    //         // array_push($arrayInvoice, $invoiceSum);            
    //         $i++;
    //     }
        
    //     echo json_encode($arrayInvoice);

    //     // $output = array(
    //     //     'sum_nilai_invoice' => number_format($dataInvoice[0]->sum_nilai_invoice,0,',','.'),
    //     //     'hutang_terbayar' => $hutang_terbayar,
    //     //     'sum_sisa_hutang' => $dataInvoice[0]->sum_sisa_hutang,
    //     //     'sum_potongan_retur' => $dataInvoice[0]->sum_potongan_retur,
    //     //     'range_date' => $datefrom . " s/d " . $dateto,
    //     // );
    //     // echo json_encode($output);
    // }
}
