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
                        <td width="35%">Invoice Kode</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["invoice_kode"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Tanggal</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["tanggal_invoice"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Batas Pembayaran</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["batas_pembayaran"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Keterangan/Catatan</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["invoice_keterangan"]?></td>
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
                            <th class="text-center" width="10%" scope="col">rute</th>
                            <th class="text-center" width="8%" scope="col">Total Muatan</th>
                            <th class="text-center" width="10%" scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($invoice as $value){?>
                        <tr>
                            <td><?= $value["tanggal_surat"]?></td>
                            <td><?= $value["tanggal_bongkar"]?></td>
                            <td><?= $value["mobil_no"]?></td>
                            <?php $n=0; 
                            for($i=0;$i<count($paketan);$i++){
                                if($value["paketan_id"]!="0"){
                                    if($paketan[$i]["paketan_id"] == $value["paketan_id"]){
                                        $data_paketan = json_decode($paketan[$i]["paketan_data_rute"],true);
                                        $n++?>
                                        <td>
                                        <?php for($j=0;$j<count($data_paketan);$j++){?>
                                            <?= $data_paketan[$j]["dari"]."=>".$data_paketan[$j]["ke"]."=>".$data_paketan[$j]["muatan"]?>
                                        <?php }?>
                                        </td>    
                                <?php }
                                }
                            }?>
                            <?php 
                            for($i=0;$i<count($kosongan);$i++){
                                if($value["kosongan_id"]!="0"){
                                    if($kosongan[$i]["kosongan_id"] == $value["kosongan_id"]){
                                        $n++?>
                                        <td>
                                            <?= $kosongan[$i]["kosongan_dari"]."=>".$kosongan[$i]["kosongan_ke"]."=>"?>kosongan<br>
                                            <?= $value["asal"]."=>".$value["tujuan"]."=>".$value["muatan"]?><br>
                                        </td>    
                                <?php }
                                }
                            }?>
                            <?php if($n==0){?>
                                <td><?= $value["asal"]."=>".$value["tujuan"]."=>".$value["muatan"]?></td>
                            <?php }?>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["total"],2,',','.')?></td>
                        </tr>
                    <?php }?>
                        <tr>
                            <td colspan=5>Total</td>
                            <td>Rp.<?= number_format($invoice[0]["total"],2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=5>PPN 10%</td>
                            <td>Rp.<?= number_format($invoice[0]["ppn"],2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=5>Jumlah</td>
                            <td>Rp.<?= number_format($invoice[0]["grand_total"],2,',','.')?></td>
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
    window.location.replace("<?= base_url("index.php/detail/detail_invoice/".$invoice_kode."/Invoice")?>");
</script>
</html>