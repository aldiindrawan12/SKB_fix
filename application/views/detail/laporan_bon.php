<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="m-0 font-weight-bold text-primary ml-4">Detail Bon Supir</h6>
        <a href="" class="btn btn-sm btn-primary btn-icon-split mr-3" onclick="print_bon()">
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
        <div class="container" id="detail-bon-supir">
            <div class="text-center mb-3 h5">
                <span><?=$supir?></span>
            </div>
            <table class="table table-bordered">
                <thead>
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
                            <td class="p-1"><?= $n?></td>
                            <td class="p-1"><?= $value["bon_tanggal"]?></td>
                            <td class="p-1"><?= $value["bon_keterangan"]?></td>
                            <?php if($value["bon_jenis"]=="Pembayaran" || $value["bon_jenis"]=="Potong Gaji"){
                                $sisa_bon-=$value["bon_nominal"];?>
                                <td class="p-1">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                                <td class="p-1">Rp.0</td>
                            <?php }else{
                                $sisa_bon+=$value["bon_nominal"];?>
                                <td class="p-1">Rp.0</td>
                                <td class="p-1">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                            <?php }
                            if($sisa_bon==0){?>
                                <td class="p-1">Lunas</td>
                            <?php }else{?>
                                <td class="p-1">Rp.<?= number_format($sisa_bon,2,',','.')?></td>
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
<script>
function print_bon(){
    var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById("detail-bon-supir").innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>