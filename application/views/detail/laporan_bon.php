<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
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
        <div class="container w-50 ml-0 mb-5">
            <form action="<?= base_url("index.php/detail/detail_report_bon/").$supir_id."/periode"?>" method="POST">
                <div class="row">
                <input autocomplete="off" type="text" class="form-control col-md-4" id="tanggal1" name="tanggal1" value="<?= $tanggal1?>" required onclick="tanggal_berlaku(this)">
                <span class="col-md-1 text-center">sd</span>
                <input autocomplete="off" type="text" class="form-control col-md-4" id="tanggal2" name="tanggal2" value="<?= $tanggal2?>" required onclick="tanggal_berlaku(this)">
                <button type="submit" class="col-md-3 btn btn-primary">Terapkan</button>
                </div>
            </form>
        </div>
        <div class="container" id="detail-bon-supir">
            <div class="text-center mb-4 ">
            <h5 class="font-weight-bolder"><?=$supir?></h5>
            </div>
            <div class="container w-50 ml-0 mb-3">
                    <div class="row">
                        <input autocomplete="off" type="text" class="form-control col-md-4" id="tanggal1" name="tanggal1" value="<?= $tanggal1?>" readonly>
                        <span class="col-md-1 text-center">sd</span>
                        <input autocomplete="off" type="text" class="form-control col-md-4" id="tanggal2" name="tanggal2" value="<?= $tanggal2?>" readonly>
                    </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Tanggal Transaksi</th>
                        <th class="text-center">No.Bon</th>
                        <th class="text-center">No.Slip Gaji</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Debit</th>
                        <th class="text-center">Kredir</th>
                        <th class="text-center">Saldo Kasbon</th>
                    </tr>    
                </thead>
                <tbody>  
                    <?php  
                            $saldo=0;
                            if(count($transaksi_bon)==0){
                                $saldo_awal = 0;
                            }else{
                                $saldo_awal = $transaksi_bon[0]["bon_nominal"];                                
                            }
                            $debit = 0;
                            $kredit = 0;
                    foreach($transaksi_bon as $value){?>
                        <tr>
                            <td class=""><?= change_tanggal($value["bon_tanggal"])?></td>
                            <td class=""><?= $value["bon_id"]?></td>
                            <td class=""><?= $value["pembayaran_upah_id"]?></td>
                            <td class=""><?= $value["bon_keterangan"]?></td>
                            <?php if($value["bon_jenis"]=="Pembayaran" || $value["bon_jenis"]=="Potong Gaji"){
                                $saldo-=$value["bon_nominal"];
                                $debit+=$value["bon_nominal"];?>
                                <td class="">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                                <td class="">Rp.0</td>
                            <?php }else{
                                $saldo+=$value["bon_nominal"];
                                $kredit+=$value["bon_nominal"];?>
                                <td class="">Rp.0</td>
                                <td class="">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                            <?php }
                            if($saldo==0){?>
                                <td class="">Lunas</td>
                            <?php }else{?>
                                <td class="">Rp.<?= number_format($saldo,2,',','.')?></td>
                            <?php }?>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="container m-auto w-50">
                <table class="table table-bordered">
                    <tr>
                        <td>Saldo Bon Awal</td>
                        <td>Rp.<?= number_format($saldo_awal,2,',','.')?></td>
                    </tr>
                    <tr>
                        <td>Total Debit</td>
                        <td>Rp.<?= number_format($debit,2,',','.')?></td>
                    </tr>
                    <tr>
                        <td>Total Kredit</td>
                        <td>Rp.<?= number_format($kredit,2,',','.')?></td>
                    </tr>
                    <tr>
                        <td>Saldo Bon Akhir</td>
                        <?php if($saldo<0){?>
                            <td>Rp.<?= number_format($saldo,2,',','.')?> (Lunas)</td>
                        <?php }else{ ?>
                            <td>Rp.<?= number_format($saldo,2,',','.')?></td>
                        <?php }?>
                    </tr>
                </table>                            
            </div>
        </div>
        <!-- end tampilan detail transaksi bon -->
    </div>
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