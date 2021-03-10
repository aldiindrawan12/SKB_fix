<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sumber Karya Berkah</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url("assets/vendor/fontawesome-free/css/all.min.css")?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css') ?>">
    <!-- Custom styles for this template-->
    <link href="<?=base_url("assets/css/sb-admin-2.min.css")?>" rel="stylesheet">
</head>
<body class="text-dark">
    <div class="container w-50">
        <div class="body-card text-center">
            <span class="h3">Bukti Titipan Uang Jalan</span>
            <hr>
        </div>
        <div class="card-body">
                <div class="table-responsive">
                    <table class="" id="" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="30%"><strong>JO ID</strong></td>
                                <td width="5%">:</td>
                                <td ><strong>#<?= $jo_id?></strong></td>
                            </tr>
                            <tr>
                                <td width="30%">No Pol</td>
                                <td width="5%">:</td>
                                <td><?= $mobil["mobil_no"]." || ".$mobil["mobil_jenis"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Supir</td>
                                <td width="5%">:</td>
                                <td><?= $supir["supir_name"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Muatan</td>
                                <td width="5%">:</td>
                                <td><?= $data["muatan"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Dari</td>
                                <td width="5%">:</td>
                                <td><?= $data["asal"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Ke</td>
                                <td width="5%">:</td>
                                <td><?= $data["tujuan"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Sebesar</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["uang_jalan"],2,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Terbilang</td>
                                <td width="5%">:</td>
                                <td><?= $data["terbilang"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Keterangan</td>
                                <td width="5%">:</td>
                                <td><?= $data["keterangan"]?></td>
                            </tr>
                            <tr>
                                <td colspan=3>Bandar Lampung,<?= $data["tanggal_surat"]?></td>
                            </tr>
                            <tr>
                                <td colspan=3><hr></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr class="text-center">
                                <td width="30%">Yang Menyerahkan,</td>
                                <td width="30%">Mengetahui,</td>
                                <td width="30%" >Yang Menerima</td>
                            </tr>
                            <tr class="text-center" style="height:200px">
                                <td width="30%">('''kasir''')</td>
                                <td width="30%">(bag.operasional)</td>
                                <td width="30%" >('''supir''')</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</body>
<script>
    window.print();
    window.location.replace("<?= base_url('index.php/home')?>");
</script>
</html>