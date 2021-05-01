<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sumber Karya Berkah</title>
    <!-- Custom styles for this template-->
    <style>
        table,th,td{
            border: 1px solid black;
            text-align:center;
        }
        .judul{
            text-align:center;
            font-size:24px;
        }
        .tanggal{
            font-size:18px;
        }
    </style>
</head>
<body>
    <div class="judul">
        <span>Data Laporan Uang Jalan</span>
        <hr>
    </div>
    <div class="tanggal">
        <span>Tanggal : <?=$tanggal?></span>
    </div>
    <div>
    <table  id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="12,5%"  scope="col">No JO</th>
                            <th class="text-center" width="12,5%" scope="col">Customer</th>
                            <th class="text-center" width="30%" scope="col">Rute</th>
                            <th class="text-center" width="12,5%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="12,5%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="12,5%"  scope="col">Uang Jalan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jo as $value){ ?>
                        <tr>
                            <th ><?= $value["Jo_id"]?></th>
                            <th ><?= $value["customer_name"]?></th>
                            <?php $n=0; 
                            for($i=0;$i<count($paketan);$i++){
                                // if($paketan[$i]!=NULL){
                                    if($paketan[$i]["paketan_id"] == $value["paketan_id"]){
                                        $data_paketan = json_decode($paketan[$i]["paketan_data_rute"],true);
                                        $n++?>
                                        <td>
                                        <?php for($j=0;$j<count($data_paketan);$j++){?>
                                            <?= $data_paketan[$j]["dari"]."-".$data_paketan[$j]["ke"]." (".$data_paketan[$j]["muatan"].")<br>"?>
                                        <?php }?>
                                        </td>    
                                <?php }
                                // break;
                                // }
                            }?>
                            <?php 
                            for($i=0;$i<count($kosongan);$i++){
                                // if($kosongan[$i]!=NULL){
                                    if($kosongan[$i]["kosongan_id"] == $value["kosongan_id"]){
                                        $n++?>
                                        <td>
                                            <?= $kosongan[$i]["kosongan_dari"]."-".$kosongan[$i]["kosongan_ke"]." ("?>kosongan)<br>
                                            <?= $value["asal"]."-".$value["tujuan"]." (".$value["muatan"]?>)<br>
                                        </td>    
                                <?php }
                                // }
                            }?>
                            <?php if($n==0){?>
                                <td><?= $value["asal"]."-".$value["tujuan"]." (".$value["muatan"]?>)</td>
                            <?php }?>
                            <th ><?= $value["tanggal_surat"]?></th>
                            <th ><?= $value["tanggal_bongkar"]?></th>
                            <th >Rp.<?= number_format($value["uang_jalan_bayar"],2,",",".")?></th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
    </div>
</body>
</html>