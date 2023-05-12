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
                <h1>Laporan Invoice dan Piutang</h1></br>
                <h2>Agung Yama Abadi</h2>
                <table style="float: right;">
                <?php 
                ?>
                    <tr>
                        <td class="tdHeader">Ket Payment</td>
                        <td class="tdHeader">: </td>
                        <td class="tdHeader"><?php if ($dKetPayment == 1) {
                            # code...
                            echo "Lunas";
                        } else if ($dKetPayment == 0) {
                            # code...
                            echo "Belum Lunas";
                        } else{
                            echo "undefined";
                        } ?></td>
                    </tr>
                    <tr>
                        <td class="tdHeader">Ket Invoice</td>
                        <td class="tdHeader">: </td>
                        <td class="tdHeader"><?php if ($dKetInvoice == 0) {
                            # code...
                            echo "Ekspedisi";
                        } else if ($dKetInvoice == 1) {
                            # code...
                            echo "Barang";
                        } else{
                            echo "undefined";
                        } ?></td>
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
                    <td>Nomor Invoice</td>
                    <td>Nilai Invoice</td>
                    <td>Tanggal Invoice</td>
                    <td>Sisa Hutang</td>
                    <td>Keterangan Invoice</td>
                    <td>Nama Customer</td>
                    <td>Nama Usaha</td>
                    <td>No Retur</td>
                    <td>Potongan Retur</td>
                </tr>
                <?php
                // var_dump($dSum); die;
                $i = 1;
                foreach ($dInvoice as $key) {
                    # code...
                    ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $key->no_invoice ?></td>
                    <td><?= number_format($key->nilai_invoice,0,',','.') ?></td>
                    <td><?= $key->tgl_invoice ?></td>
                    <td><?= number_format($key->sisa_hutang,0,',','.') ?></td>
                    <?php if ($key->ket_invoice == '1') {
                        # code...
                        echo "<td>Barang</td>";
                    } else {
                        echo "<td>Ekspedisi</td>";
                    } ?>
                    <td><?= $key->nama_cstmr ?></td>
                    <td><?= $key->nama_usaha ?></td>
                    <?php if ($key->no_retur != null) {
                        # code...
                        echo "<td>". $key->no_retur ."</td>";
                    } else {
                        echo "<td>-</td>";
                    }?>
                    <td><?= number_format($key->potongan_retur,0,',','.') ?></td>
                </tr>
                <?php 
                $i = $i+1;
            }
            ?>
                <tr class="tableform">
                    <td colspan="2">Total Transaksi</td>
                    <td>Rp<?= $dSum['total_invoice'] ?></td>
                    <td colspan="1">Total Sisa Hutang</td>
                    <td>Rp<?= $dSum['total_hutang']?></td>
                    <td colspan="4">Total Retur Terbayar</td>
                    <td>Rp<?= $dSum['potongan_retur']?></td>
                </tr>
            </table>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>