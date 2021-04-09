<!-- tampilan detail penggajian supir -->
<div class="container small">
    <div class="card shadow mb-2">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-center">Laporan Gaji Supir</h5>
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
        
        
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%" scope="col">No Pembayaran</th>
                            <th class="text-center" width="10%" scope="col">Tgl Pembayaran</th>
                            <th class="text-center" width="13%" scope="col">Nominal</th>
                            <th class="text-center" width="10%" scope="col">Bonus</th>
                            <th class="text-center" width="10%" scope="col">Potong Kasbon</th>
                            <th class="text-center" width="10%" scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $nominal = 0;
                    $bonus = 0;
                    $bon = 0;
                    $grand = 0;
                    foreach($pembayaran_upah as $value){ 
                        $nominal += $value["pembayaran_upah_nominal"];
                        $bonus += $value["pembayaran_upah_bonus"];
                        $bon += $value["pembayaran_upah_bon"];
                        $grand += $value["pembayaran_upah_nominal"]+$value["pembayaran_upah_bonus"]-$value["pembayaran_upah_bon"];
                        ?>
                        <tr>
                            <td><?= $value["pembayaran_upah_id"]?></td>
                            <td><?= $value["pembayaran_upah_tanggal"]?></td>
                            <td>Rp.<?= number_format($value["pembayaran_upah_nominal"],2,",",".")?></td>
                            <td>Rp.<?= number_format($value["pembayaran_upah_bonus"],2,",",".")?></td>
                            <td>Rp.<?= number_format($value["pembayaran_upah_bon"],2,",",".")?></td>
                            <td>Rp.<?= number_format($value["pembayaran_upah_nominal"]+$value["pembayaran_upah_bonus"]-
                            $value["pembayaran_upah_bon"],2,',','.') ?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan=2>Grand Total</td>
                            <td>Rp.<?= number_format($nominal,2,',','.')?></td>
                            <td>Rp.<?= number_format($bonus,2,',','.')?></td>
                            <td>Rp.<?= number_format($bon,2,',','.')?></td>
                            <td>Rp.<?= number_format($grand,2,',','.')?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>  
<!-- end tampilan detail penggajian supir -->