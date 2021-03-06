<?php
    function change_tanggal($data){
        $date_time = explode(' ', $data);
        $data_tanggal = explode('-', $date_time[0]);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0]." ".$date_time[1];
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

    <link href="<?=base_url("assets/css/sb-admin-2.min.css")?>" rel="stylesheet">
</head>
<body class="text-dark" >
    <div class="container w-50">
        <div class="body-card text-center">
            <span class="h3">Kwitansi Transaksi BON</span>
            <hr>
        </div>
        <div class="card-body">
                <div class="table-responsive">
                    <table class="" id="" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan=3>Bandar Lampung,<?= change_tanggal($data["bon_tanggal"])?></td>
                            </tr>
                            <tr>
                                <td colspan=3><strong>#<?= $bon_id?></strong></td>
                            </tr>
                            <tr>
                                <td colspan=3><hr></td>
                            </tr>
                            <tr>
                                <td width="30%">Telah Terima Dari</td>
                                <td width="5%">:</td>
                                <?php if($data["bon_jenis"]=="Pengajuan"){ ?>
                                    <td>Sumber Karya Berkah</td>
                                <?php }else{ ?>
                                    <td><?= $supir["supir_name"]?></td>
                                <?php } ?>
                            </tr>

                            <tr>
                                <td width="30%">Untuk</td>
                                <td width="5%">:</td>
                                <?php if($data["bon_jenis"]=="Pengajuan"){ ?>
                                    <td><?= $supir["supir_name"]?></td>
                                <?php }else{ ?>
                                    <td>Sumber Karya Berkah</td>
                                <?php } ?>
                            </tr>

                            <tr>
                                <td width="30%">Sebesar</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["bon_nominal"],2,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Jenis Transaksi</td>
                                <td width="5%">:</td>
                                <td><?= $data["bon_jenis"]?> BON</td>
                            </tr>
                            <tr>
                                <td width="30%">Keterangan</td>
                                <td width="5%">:</td>
                                <td><?= $data["bon_keterangan"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Sisa Bon Terhutang</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($supir["supir_kasbon"],2,',','.')?></td>
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
                                <?php if($data["bon_jenis"]=="Pengajuan"){ ?>
                                    <td width="30%">('''kasir''')</td>
                                    <td width="30%">(bag.operasional)</td>
                                    <td width="30%" ><?= $supir["supir_name"]?></td>
                                <?php }else{ ?>
                                    <td width="30%" ><?= $supir["supir_name"]?></td>
                                   <td width="30%">(bag.operasional)</td>
                                    <td width="30%">('''kasir''')</td>
                                <?php } ?>
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
    if(asal=="insert"){ 
        window.location.replace("<?= base_url("index.php/home/bon")?>");
    }else if(asal="batal JO"){
        window.location.replace("<?= base_url("index.php/home/konfirmasi_jo/")?>");
    }else{
        window.location.replace("<?= base_url("index.php/detail/detail_jo/").$data_jo["Jo_id"]."/JO"?>");
    }
</script>
</html>