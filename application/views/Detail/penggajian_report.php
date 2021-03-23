<!-- tampilan detail penggajian supir -->
<div class="container small">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center">Laporan Gaji Supir</h6>
        </div>
        <div class="card-body">
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
                </tbody>
            </table>
        </div>
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Belum Dibayar</h6>
        </div>
        <div class="card-body">
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
                            <th class="text-center" width="10%" scope="col">Upah+Bonus</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $uang_jalan = 0;
                    $upah = 0;
                    $data_jo_id = [];
                    foreach($jo_belumbayar as $value){ 
                        $uang_jalan += $value["uang_jalan"];
                        $upah += ($value["upah"]+$value["bonus"]);
                        $data_jo_id[] = $value["Jo_id"];
                        ?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= $value["tanggal_surat"]?></td>
                            <td><?= $value["tanggal_bongkar"]?></td>
                            <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td>
                            <td>Rp.<?= number_format($value["uang_jalan"],2,',','.') ?></td>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["upah"]+$value["bonus"],2,',','.')?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan=6>Total</td>
                            <td>Rp.<?= number_format($uang_jalan,2,',','.')?></td>
                            <td></td>
                            <td>Rp.<?= number_format($upah,2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Total Bon Terhutang</td>
                            <td>Rp.<?= number_format($supir["supir_kasbon"],2,',','.')?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Grand Total Upah</td>
                            <td>Rp.<?= number_format($upah-$supir["supir_kasbon"],2,',','.')?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sudah Dibayar</h6>
        </div>
        <div class="card-body">
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
                            <th class="text-center" width="10%" scope="col">Upah+Bonus</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $uang_jalan = 0;
                    $upah = 0;
                    $data_jo_id = [];
                    foreach($jo_bayar as $value){ 
                        $uang_jalan += $value["uang_jalan"];
                        $upah += ($value["upah"]+$value["bonus"]);
                        $data_jo_id[] = $value["Jo_id"];
                        ?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= $value["tanggal_surat"]?></td>
                            <td><?= $value["tanggal_bongkar"]?></td>
                            <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td>
                            <td>Rp.<?= number_format($value["uang_jalan"],2,',','.') ?></td>
                            <td><?= $value["tonase"]." ".$value["satuan"]?></td>
                            <td>Rp.<?= number_format($value["upah"]+$value["bonus"],2,',','.')?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan=6>Total</td>
                            <td>Rp.<?= number_format($uang_jalan,2,',','.')?></td>
                            <td></td>
                            <td>Rp.<?= number_format($upah,2,',','.')?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end tampilan detail penggajian supir -->


<!-- <div class="container"> -->
    <!-- button print daftar gaji -->
    <!-- <button onclick="print_gaji()" class="btn btn-primary">Cetak Bukti Upah</button> -->
    <!-- end button print daftar gaji -->

    <!-- button print memo tunai -->
    <!-- <button onclick="print_memo_tunai()" class="btn btn-primary">Cetak Memo Tunai</button> -->
    <!-- end button print memo tunai -->
<!-- </div> -->

<script>
    // function print_memo_tunai(){
    //     window.location.replace("<?= base_url("index.php/print_berkas/memo_tunai/".$supir["supir_id"]."/".($upah-$supir["supir_kasbon"]))?>");    
    // }
</script>