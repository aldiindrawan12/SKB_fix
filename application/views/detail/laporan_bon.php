<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2 small">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Bon Supir</h6>
        <a href="" class="btn btn-primary btn-icon-split" onclick="print_bon()">
                <span class="icon text-white-100">
                    <i class="fas fa-print"></i> 
                </span>
                <span class="text">
                    Cetak Bon
                </span>
        </a>
    </div>
    <div class="card-body">
        <!-- tampilan detail transaksi bon -->
        <div class="container" id="detail-bon_supir">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th colspan=6 class="text-center font-weight-bold h5"><?=$supir?></th>
                    </tr>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Tanggal Transaksi</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Bayar</th>
                        <th class="text-center">Bon</th>
                        <th class="text-center">Sisa Bon</th>
                    </tr>    
                </thead>
                <tbody>  
                    <?php   $n=1;
                            $sisa_bon=0;
                    foreach($transaksi_bon as $value){?>
                        <tr>
                            <td class="text-center"><?= $n?></td>
                            <td class="text-center"><?= $value["bon_tanggal"]?></td>
                            <td class="text-center"><?= $value["bon_keterangan"]?></td>
                            <?php if($value["bon_jenis"]=="Pembayaran"){
                                $sisa_bon-=$value["bon_nominal"];?>
                                <td class="text-center">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                                <td class="text-center">Rp.0</td>
                            <?php }else{
                                $sisa_bon+=$value["bon_nominal"];?>
                                <td class="text-center">Rp.0</td>
                                <td class="text-center">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                            <?php }
                            if($sisa_bon==0){?>
                                <td class="text-center">Lunas</td>
                            <?php }else{?>
                                <td class="text-center">Rp.<?= number_format($sisa_bon,2,',','.')?></td>
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
</div>
