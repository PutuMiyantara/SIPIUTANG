<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    @page {
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;
    }

    #header {
        border-bottom: 2px solid #000000;
    }

    td {
        border: 1px solid;
    }
    
    .tdHeader {
        border: 0px;
    }

    .tableform td {
        font-weight: bold;
        text-align: center;
    }
    
    </style>
</head>

<body>
    <div>
        <div id="header">
            <div style="width: 100%; text-align: center;">
                <h1>Laporan Penerimaan Piutang</h1></br>
                <h2>Agung Yama Abadi</h2>
                <table style="float: right;">
                <?php 
                $dataRekeningPenerima = null;
                    if ($dHeaderRekening != "undefined") {
                        # code...
                        foreach ($dHeaderRekening as $key) {
                            # code...
                            $dataRekeningPenerima = $key->nomor_rekening . " (" . $key->keterangan_penerima . ") " . $key->nama_rekening;
                        }
                    } else {
                        $dataRekeningPenerima = $dHeaderRekening;
                    }
                ?>
                    <tr>
                        <td class="tdHeader">Rekening</td>
                        <td class="tdHeader">: </td>
                        <td class="tdHeader"><?= $dataRekeningPenerima ?></td>
                    </tr>
                    <tr>
                        <td class="tdHeader">Tanggal</td>
                        <td class="tdHeader">: </td>
                        <td class="tdHeader"><?= $dDate_from . " s/d " . $dDate_to ?> </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="body" style="margin-top: 20px;">
            <table style="border: 1px solid black;">
                <tr class="tableform">
                    <td>No</td>
                    <td>Nomor Payment</td>
                    <td>Tanggal Pembayaran</td>
                    <td>Rekening Pembayar</td>
                    <td>Atas Nama Pembayar</td>
                    <td>Rekening Penerima</td>
                    <td>Nominal Payment</td>
                </tr>
                <?php
                $i = 1;
                foreach ($dPayment as $key) {
                    # code...
                    ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $key->no_payment ?></td>
                    <td><?= $key->tgl_pembayaran ?></td>
                    <td><?= $key->rekening." (".$key->alias.")" ?></td>
                    <td><?= $key->nama_cstmr ?></td>
                    <td><?= $key->nomor_rekening . " (" . $key->keterangan_penerima . ")" ?></td>
                    <td><?= number_format($key->nominal_payment,0,',','.') ?></td>
                </tr>
                <?php 
                $i = $i+1;
            }
            ?>
                <tr class="tableform">
                    <td colspan="6">Total Payment</td>
                    <td>Rp <?= number_format($dSum[0]->sum_nominal_payment,0,',','.') ?></td>
                </tr>
            </table>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>