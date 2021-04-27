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
    <div class="container">
        <div class="mb-4">
            <div class="py-3">
                <h6 class="m-0 font-weight-bold text-center">Memo Transfer</h6>
            </div>
            <div class="card-body row">
                <div class="col-md-5">
                    <table>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><?= date("d-m-Y")?></td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td id="isi_bank"><?= $data["Bank"]?></td>
                            </tr>
                            <tr>
                                <td>Rekening</td>
                                <td>:</td>
                                <td id="isi_rek"><?= $data["Norek"]?></td>
                            </tr>
                            <tr>
                                <td>A.N.</td>
                                <td>:</td>
                                <td id="isi_an"><?= $data["AN"]?></td>
                            </tr>
                            <tr>
                                <td>Nominal</td>
                                <td>:</td>
                                <?php if($bonus!="0"){?>
                                    <td>Rp. <span id="upah_print"><?= number_format($gaji+$bonus,2,",",".")?></span></td>
                                <?php }else{?>
                                    <td>Rp. <span id="upah_print"><?= number_format($gaji,2,",",".")?></span></td>
                                <?php }?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table>
                        <tbody>
                            <tr>
                                <td>Keterangan : </td>
                            </tr>
                            <tr>
                                <td id="isi_ket"><?= $data["Keterangan"]?></td>
                            </tr>
                            <tr>
                                <td style="height:100px">(<?= $supir["supir_name"]?>)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="w-100 mt-5">
                    <tbody>
                        <tr class="text-center">
                            <td width="30%">Mengetahui,</td>
                            <td width="30%">Menyetujui,</td>
                            <td width="30%" >Kasir</td>
                        </tr>
                        <tr class="text-center" style="height:200px">
                            <td width="30%">(.................)</td>
                            <td width="30%">(.................)</td>
                            <td width="30%" >(.................)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
    window.location.replace("<?= base_url("index.php/print_berkas/data_gaji/".$supir["supir_id"]."/".$gaji."/".$bonus)?>");    
</script>
</html>