<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
                            <th class="text-center" width="12,5%" scope="col">Muatan</th>
                            <th class="text-center" width="12,5%" scope="col">Asal</th>
                            <th class="text-center" width="12,5%" scope="col">Tujuan</th>
                            <th class="text-center" width="12,5%" scope="col">Supir</th>
                            <th class="text-center" width="12,5%" scope="col">Mobil</th>
                            <th class="text-center" width="12,5%"  scope="col">Uang Jalan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jo as $value){ ?>
                        <tr>
                            <th ><?= $value["Jo_id"]?></th>
                            <th ><?= $value["muatan"]?></th>
                            <th ><?= $value["asal"]?></th>
                            <th ><?= $value["tujuan"]?></th>
                            <th ><?= $value["supir_name"]?></th>
                            <th ><?= $value["mobil_no"]?></th>
                            <th >Rp.<?= $value["uang_jalan"]?></th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
    </div>
</body>
</html>