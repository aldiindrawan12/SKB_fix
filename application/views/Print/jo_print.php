<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
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
            <span class="h3">Bukti Titipan Uang Jalan</span><br>
            <?php if($tipe_jo=="paketan"){?>
                <span class="h3">Tipe Paketan</span>
            <?php }else{?>
                <span class="h3">Tipe Reguler</span>
            <?php }?>
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
                                <td width="30%">Rute</td>
                                <td width="5%">:</td>
                                <td>
                                    <table class="table table-bordered small">
                                        <thead>
                                            <tr>
                                                <th>No Rute</th>
                                                <th>Dari</th>
                                                <th>Ke</th>
                                                <th>Muatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($tipe_jo=="paketan"){?>
                                                <?php $data_rute = json_decode($paketan["paketan_data_rute"],true);?>
                                                <?php for($i=0;$i<count($data_rute);$i++){?>
                                                    <tr>
                                                        <td>Rute ke-<?= $i+1?></td>
                                                        <td><?= $data_rute[$i]["dari"]?></td>
                                                        <td><?= $data_rute[$i]["ke"]?></td>
                                                        <td><?= $data_rute[$i]["muatan"]?></td>
                                                    </tr>
                                                <?php }?>
                                            <?php }else{?>
                                                <?php if($kosongan != 0){?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><?= $kosongan["kosongan_dari"]?></td>
                                                        <td><?= $kosongan["kosongan_ke"]?></td>
                                                        <td>Kosongan</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td><?= $data["asal"]?></td>
                                                        <td><?= $data["tujuan"]?></td>
                                                        <td><?= $data["muatan"]?></td>
                                                    </tr>
                                                <?php }else{?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><?= $data["asal"]?></td>
                                                        <td><?= $data["tujuan"]?></td>
                                                        <td><?= $data["muatan"]?></td>
                                                    </tr>
                                                <?php }?>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Uang Jalan</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["uang_jalan"],2,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Terbilang</td>
                                <td width="5%">:</td>
                                <td><?= $data["terbilang"]?></td>
                            </tr>
                            <?php if($tipe_jo=="reguler"){?>
                                <tr>
                                    <td width="30%">Uang Jalan Kosongan</td>
                                    <td width="5%">:</td>
                                    <?php if($tipe_jo!="paketan" && $kosongan!=null){?>
                                        <td>Rp.<?= number_format($kosongan["kosongan_uang"],2,",",".")?></td>
                                    <?php }else{?>
                                        <td>Rp.0 (Tidak Ada)</td>
                                    <?php }?>
                                </tr>
                            <?php }?>
                            <tr>
                                <td width="30%">Total Uang Jalan</td>
                                <td width="5%">:</td>
                                <?php if($tipe_jo!="paketan"){?>
                                    <td>Rp.<?= number_format($data["uang_jalan"]+$data["uang_kosongan"],2,',','.')?></td>
                                <?php }else{?>
                                    <td>Rp.<?= number_format($data["uang_jalan"],2,',','.')?></td>
                                <?php }?>
                            </tr>
                            <tr>
                                <td width="30%">Total Uang Jalan Dibayar</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["uang_jalan_bayar"],2,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Keterangan</td>
                                <td width="5%">:</td>
                                <td><?= $data["keterangan"]?></td>
                            </tr>
                            <tr>
                                <td colspan=3>Bandar Lampung,<?= change_tanggal($data["tanggal_surat"])?></td>
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
    var asal = '<?= $asal?>';
    if(asal=="detail"){
        window.location.replace("<?= base_url('index.php/detail/detail_jo/').$jo_id."/JO"?>");
    }else{
        window.location.replace("<?= base_url('index.php/home')?>");
    }
</script>
</html>