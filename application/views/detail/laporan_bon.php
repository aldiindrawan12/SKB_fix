<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2 small">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Bon Supir</h6>
    </div>
    <div class="card-body">
        <!-- tampilan detail transaksi bon -->
        <div class="container" id="detail-bon_supir">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan=6 class="text-center"><?=$supir?></th>
                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>Keterangan</th>
                        <th>Bayar</th>
                        <th>Bon</th>
                        <th>Sisa Bon</th>
                    </tr>    
                </thead>
                <tbody>  
                    <?php   $n=1;
                            $sisa_bon=0;
                    foreach($transaksi_bon as $value){?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $value["bon_tanggal"]?></td>
                            <td><?= $value["bon_keterangan"]?></td>
                            <?php if($value["bon_jenis"]=="Pembayaran"){
                                $sisa_bon-=$value["bon_nominal"];?>
                                <td>Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                                <td>Rp.0</td>
                            <?php }else{
                                $sisa_bon+=$value["bon_nominal"];?>
                                <td>Rp.0</td>
                                <td>Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                            <?php }
                            if($sisa_bon==0){?>
                                <td>Lunas</td>
                            <?php }else{?>
                                <td>Rp.<?= number_format($sisa_bon,2,',','.')?></td>
                            <?php }?>
                        </tr>
                    <?php $n++;
                    }?>
                </tbody>
            </table>
        </div>
        <!-- end tampilan detail transaksi bon -->
    </div>
</div>