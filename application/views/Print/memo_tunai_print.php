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
<body class="text-dark small">
    <div class="container w-50">
        <div class="text-center">
            <span class="h3">Memo Tunai</span>
            <hr>
        </div>
        <div>
            <div class="table-responsive">
                <table class="" id="" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td colspan=3>Bandar Lampung,<?= date("Y-m-d")?></td>
                        </tr>
                        <tr>
                            <td width="30%">Telah Terima Dari</td>
                            <td width="5%">:</td>
                            <td>Sumber Berkah Jaya</td>
                        </tr>
                        <tr>
                            <td width="30%">Sebesar</td>
                            <td width="5%">:</td>
                            <td>Rp.<?= number_format($gaji,2,',','.')?></td>
                        </tr>
                        <tr>
                            <td width="30%">Untuk</td>
                            <td width="5%">:</td>
                            <td>Pembayaran Gaji/Upah tunai</td>
                        </tr>
                        <tr>
                            <td colspan=3><hr></td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody>
                        <tr class="text-center">
                            <td width="25%">Mengetahui,</td>
                            <td width="25%">Menyetujui,</td>
                            <td width="25%">Kasir,</td>
                            <td width="25%" >Supir</td>
                        </tr>
                        <tr class="text-center" style="height:200px">
                            <td width="25%">(...............)</td>
                            <td width="25%">(...............)</td>
                            <td width="25%">(...............)</td>
                            <td width="25%">(<?= $supir["supir_name"]?>)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
    window.location.replace("<?= base_url("index.php/print_berkas/data_gaji/".$supir["supir_id"]."/".$gaji."/0")?>");    
</script>
</html>