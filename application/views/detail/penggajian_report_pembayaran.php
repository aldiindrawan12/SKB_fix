<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!-- tampilan detail penggajian supir -->
<div class="container small">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center">Data Upah Supir</h6>
        </div>
        <div class="card-body" id="identitas">
            <table class="w-50">
                <tbody>
                    <tr>
                        <td width="25%">Id Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_id"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_name"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Operator</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["user_upah"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body" id="rincian">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">Tgl Keluar</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Uang Jalan</th>
                            <th class="text-center" width="8%" scope="col">Total Muatan</th>
                            <th class="text-center" width="10%" scope="col">Upah</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $uang_jalan = 0;
                    foreach($pembayaran_upah as $value){ 
                        if($value["uang_kosongan"]!=""){
                            $uang_jalan += $value["uang_jalan"]+$value["uang_kosongan"];   
                        }else{
                            $uang_jalan += $value["uang_jalan"];
                        }
                        ?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= change_tanggal($value["tanggal_surat"])?></td>
                            <td><?= change_tanggal($value["tanggal_bongkar"])?></td>
                            <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td>
                            <?php
                                if($value["uang_kosongan"]!=""){
                                    echo "<td>Rp.".number_format($value["uang_jalan"]+$value["uang_kosongan"],2,',','.')."</td>";
                                }else{
                                    echo "<td>Rp.".number_format($value["uang_jalan"],2,',','.')."</td>";
                                }
                            ?>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["upah"],2,',','.')?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan=6>Total</td>
                            <td>Rp.<?= number_format($uang_jalan,2,',','.')?></td>
                            <td></td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_nominal"],2,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Potong Kasbon</td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_bon"],2,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Bonus</td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_bonus"],2,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Grand Total Upah</td>
                            <td id="grand_total">Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_total"],2,",",".")?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end tampilan detail penggajian supir -->


<div class="container">
    <button onclick="print_rincian()" class="btn btn-success">Cetak Rincian Gaji</button>
</div>
<hr>

<script>
    function print_rincian(){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('identitas').innerHTML+document.getElementById('rincian').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>