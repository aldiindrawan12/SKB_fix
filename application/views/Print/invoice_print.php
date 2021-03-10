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
<div class="mb-4">
        <div class="py-3">
            <h6 class="m-0 font-weight-bold text-center">Invoice</h6>
        </div>
        <div class="card-body">
            <table class="w-50 small">
                <tbody>
                    <tr>
                        <td width="35%">Customer</td>
                        <td width="5%">:</td>
                        <td><?= $customer["customer_name"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Invoice No</td>
                        <td width="5%">:</td>
                        <td><?= $invoice["invoice_kode"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Tanggal</td>
                        <td width="5%">:</td>
                        <td><?= $invoice["tanggal_invoice"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Batas Pembayaran</td>
                        <td width="5%">:</td>
                        <td><?= $invoice["batas_pembayaran"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Muatan</td>
                        <td width="5%">:</td>
                        <td><?= $invoice["muatan"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered small" id="Table-Jo" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">Tgl JO</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bngkr</th>
                            <th class="text-center" width="10%" scope="col">Mobil</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="8%" scope="col">Total Muatan</th>
                            <th class="text-center" width="10%" scope="col">Harga/Satuan</th>
                            <th class="text-center" width="10%" scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $invoice["tanggal_surat"]?></td>
                            <td><?= $invoice["tanggal_bongkar"]?></td>
                            <td><?= $invoice["mobil_no"]?></td>
                            <td><?= $invoice["asal"]?></td>
                            <td><?= $invoice["tujuan"]?></td>
                            <td><?= $invoice["tonase"]." ".$invoice["satuan"]?></td>
                            <td>Rp.<?= number_format($invoice["harga/kg"],2,',','.')?></td>
                            <td>Rp.<?= number_format($invoice["tonase"]*$invoice["harga/kg"],2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=7>Total</td>
                            <td>Rp.<?= number_format($invoice["tonase"]*$invoice["harga/kg"],2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=7>PPN 10%</td>
                            <td>Rp.<?= number_format(($invoice["tonase"]*$invoice["harga/kg"])*0.1,2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=7>Jumlah</td>
                            <td>Rp.<?= number_format(($invoice["tonase"]*$invoice["harga/kg"])+(($invoice["tonase"]*$invoice["harga/kg"])*0.1),2,',','.')?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="small">
                    <tbody>
                        <tr>
                            <td>Harap Pembayaran di Transfer Ke</td>
                        </tr>
                        <tr>
                            <td width="25%">Bank</td>
                            <td width="5%">:</td>
                            <td>OCBC NISP</td>
                        </tr>
                        <tr>
                            <td width="25%">A/N</td>
                            <td width="5%">:</td>
                            <td>PT.Sumber Karya Berkah</td>
                        </tr>
                        <tr>
                            <td width="25%">No.Rek</td>
                            <td width="5%">:</td>
                            <td>3308.0000.5911</td>
                        </tr>
                        <tr class="text-center">
                            <td>Hormat Kami</td>
                        </tr>
                        <tr class="text-center">
                            <td style="height:150px">(..........................................)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    var asal = '<?= $asal?>';
    window.print();
    if(asal == "JO"){
        window.location.replace("<?= base_url("index.php/detail/detail_jo/".$Jo_id)?>");
    }else if(asal == "invoice"){
        window.location.replace("<?= base_url("index.php/detail/detail_invoice/".$invoice_kode)?>");
    }
</script>
</html>