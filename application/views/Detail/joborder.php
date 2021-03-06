<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!-- Basic Card Example -->
<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Job Order</h6>
    </div>
    <div class="card-body">
            <div class="container ">
                <div class="float-right mb-3">
                    <?php if($jo["status"]=="Dalam Perjalanan"){?>                    
                        <a class='btn btn-primary btn-sm ' href='<?= base_url("index.php/print_berkas/uang_jalan/").$jo["Jo_id"]?>' id="">
                            <span>Cetak Bukti Uang Jalan</span>
                        </a>
                    <?php }?>
                </div>
            </div>
        <!-- tampilan detail jo -->
        <div class="container" id="detail-jo">
            <table class="table table-bordered">
                <tbody>         
                    <tr>
                        <td class="d-none d-sm-table-cell text-center " rowspan="16" style="width: 15%;">
                            <p class="badge badge-info">Customer</p>
                            <?php if($customer){?>
                            <p class="font-size-sm font-weight-bold"><?= $customer["customer_name"] ?></p>
                            <?php }else{?>
                                <p class="font-size-sm font-weight-bold">-</p>
                            <?php }?>
                            <hr>
                            <p class="font-weight-bold badge badge-success">ID JO</p>
                            <p class="font-size-sm font-weight-bold"><?= $jo["Jo_id"] ?></p>
                            <hr>
                            <p class="font-weight-bold badge badge-success">Tipe Job Order</p>
                            <?php if($tipe_jo=="paketan"){?>
                                <p class="font-size-sm font-weight-bold">Paketan</p>
                            <?php }else{?>
                                <p class="font-size-sm font-weight-bold">Reguler</p>
                            <?php }?>
                            <hr>
                            <p class="font-weight-bold badge badge-primary">Operator</p>
                            <p class="font-size-sm font-weight-bold"><?= $jo["user"] ?></p>
                        </td>
                        <td class="font-weight-bold" style="width: 25%;">Rute Muatan</td>
                        <td colspan=3>
                                    <table class="table table-bordered small">
                                        <thead>
                                            <tr>
                                                <th>Keterangan</th>
                                                <th>Dari</th>
                                                <th>Ke</th>
                                                <th>Muatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($tipe_jo=="paketan"){?>
                                                <?php $data_rute = json_decode($paketan["paketan_data_rute"],true);?>
                                                <?php for($i=0;$i<count($data_rute);$i++){?>
                                                    <tr>
                                                        <td><?= $data_rute[$i]["customer"]?></td>
                                                        <td><?= $data_rute[$i]["dari"]?></td>
                                                        <td><?= $data_rute[$i]["ke"]?></td>
                                                        <td><?= $data_rute[$i]["muatan"]?></td>
                                                    </tr>
                                                <?php }?>
                                            <?php }else{?>
                                                <?php if($kosongan != null){?>
                                                <tr>
                                                    <td>Rute ke-1</td>
                                                    <td><?= $kosongan["kosongan_dari"]?></td>
                                                    <td><?= $kosongan["kosongan_ke"]?></td>
                                                    <td>Kosongan</td>
                                                </tr>
                                                <tr>
                                                    <td>Rute ke-2</td>
                                                    <td><?= $jo["asal"]?></td>
                                                    <td><?= $jo["tujuan"]?></td>
                                                    <td><?= $jo["muatan"]?></td>
                                                </tr>
                                                <?php }else{?>
                                                    <tr>
                                                        <td>Rute ke-1</td>
                                                        <td><?= $jo["asal"]?></td>
                                                        <td><?= $jo["tujuan"]?></td>
                                                        <td><?= $jo["muatan"]?></td>
                                                    </tr>
                                                <?php }?>
                                            <?php }?>
                                        </tbody>
                                    </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Berangkat</td>
                        <td colspan=3><?= change_tanggal($jo["tanggal_surat"]) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Bongkar</td>
                        <td colspan=3><?= change_tanggal($jo["tanggal_bongkar"]) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Status</td>
                        <td colspan=3><?= $jo["status"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Supir</td>                
                            <?php if($jo["status"]=="Dalam Perjalanan"){?>
                                <td colspan=3>
                                    <div class="row ">
                                        <p class="col"><?= $supir["supir_name"] ?></p>
                                        <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#supir_update">
                                            <span>Ganti Supir</span>
                                        </a>
                                    </div>                                    
                                </td>
                            <?php }else{?>
                                <td colspan=3><?= $supir["supir_name"] ?></td>
                            <?php }?>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Kendaraan</td>
                            <?php if($jo["status"]=="Dalam Perjalanan"){?>
                                <td colspan=3>
                                    <div class="row ">
                                        <p class="col"><?= $mobil["mobil_no"]." == ".$mobil["mobil_jenis"] ?></p>
                                        <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#mobil_update">
                                            <span>Ganti mobil</span>
                                        </a>
                                    </div>                                    
                                </td>
                            <?php }else{?>
                                <td colspan=3><?= $mobil["mobil_no"]." == ".$mobil["mobil_jenis"] ?></td>
                            <?php }?>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Uang Jalan</td>
                        <td colspan=3><p>Rp.<?= number_format($jo["uang_jalan"],2,',','.')." (".$jo["terbilang"].")" ?></p></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Uang Jalan Kosongan</td>
                        <?php if($jo["uang_kosongan"]==0){
                            $jo["uang_kosongan"] = 0;?>
                            <td colspan=3><p>Rp.0 (Tidak Ada Rute Kosongan)</p></td>
                        <?php }else{?>
                            <td colspan=3><p>Rp.<?= number_format($jo["uang_kosongan"],2,',','.') ?></p></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Total Uang Jalan</td>
                        <td colspan=3><p>Rp.<?= number_format($jo["uang_jalan"]+$jo["uang_kosongan"],2,',','.')?></p></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Uang Jalan Terbayar</td>
                        <?php if($jo["uang_jalan_bayar"]>=$jo["uang_jalan"]+$jo["uang_kosongan"] || $jo["status"]=="Dibatalkan"){?>
                            <td colspan=3>
                                <div class="row ">
                                    <p class="col">Rp.<?= number_format($jo["uang_jalan_bayar"],2,',','.')?></p>
                                    <div class="col ">
                                        <a class='btn btn-sm btn-success col-md-12  active float-right'>
                                            Pembayaran UJ Lunas atau Dibatalkan
                                        </a>
                                    </div>
                                </div>
                                
                            </td>
                        <?php }else{?>
                            <td colspan=3>
                                <div class="row ">
                                    <p class="col">Rp.<?= number_format($jo["uang_jalan_bayar"],2,',','.')?></p>
                                    <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#update_ju" onclick="sisa_uj(<?= $jo['uang_jalan']+$jo['uang_kosongan']-$jo['uang_jalan_bayar']?>)">
                                        <span>Konfirmasi Bayar UJ</span>
                                    </a>
                                </div>
                            </td>
                        <?php }?>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Catatan/Keterangan</td>
                        <td colspan=3><?= $jo["keterangan"]?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Upah Supir</td>
                        <td colspan=3><p>Rp.<?= number_format($jo["upah"],2,',','.')?></p></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan=3><strong>Detail Muatan</strong></td>
                    </tr>
                    <tr>
                        <td colspan=3>Muatan Tonase : <?= $jo["tonase"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end tampilan detail jo -->
    </div>
</div>

<!-- pop up update bayar uang jalan -->
<div class="modal fade mt-4 py-5" id="update_ju" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title font-weight-bold">Konfirmasi Uang Jalan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?php echo base_url("index.php/detail/updateUJ/").$jo["Jo_id"]?>" method="POST">
                    <small>Sisa Uang Jalan Belum Dibayar = Rp.<span id="sisa_uj"></span></small>
                    <div class="mb-3 row">
                        <label for="uang_jalan_bayar" class="col-sm-5 col-form-label">Nominal Uang Jalan Yang Dibayar</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="uang_jalan_bayar" id="uang_jalan_bayar" onkeyup="uang(this)" required>    
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Keterangan" class="col-sm-5 col-form-label">Keterangan</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="Keterangan" id="Keterangan" required>    
                        </div>
                    </div>
                    <div class="float-right mr-5 px-3 mt-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update bayar uang jalan -->

<!-- pop up update supir -->
<div class="modal fade mt-4 py-5" id="supir_update" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title font-weight-bold">Ganti Supir</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?php echo base_url("index.php/detail/updatesupirjo/").$jo["Jo_id"]."/".$jo["supir_id"]?>" method="POST">
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Supir">Supir</label>
                        <select name="Supir" id="Supir" class="form-control selectpicker" data-live-search="true" required>
                            <?php if(count($all_supir)==0){?>
                                <option class="font-w700" disabled="disabled" selected value="">Supir Kosong</option>
                            <?php }else{ ?>
                                <option class="font-w700" disabled="disabled" selected value="">Nama Supir</option>
                                <?php for($i=0;$i<count($all_supir);$i++){?>
                                    <option value="<?= $all_supir[$i]["supir_id"]?>"><?= $all_supir[$i]["supir_name"]?></option>
                                <?php }
                            }?>
                        </select>
                    </div>
                    <div class="float-right mr-5 px-3 mt-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update supir -->

<!-- pop up update mobil -->
<div class="modal fade mt-4 py-5" id="mobil_update" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title font-weight-bold">Ganti Mobil</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?php echo base_url("index.php/detail/updatemobiljo/").$jo["Jo_id"]."/".$jo["mobil_no"]?>" method="POST">
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Mobil">Mobil</label>
                        <select name="Mobil" id="Mobil" class="form-control selectpicker" data-live-search="true" required>
                            <?php if(count($all_mobil)==0){?>
                                <option class="font-w700" disabled="disabled" selected value="">Mobil Kosong</option>
                            <?php }else{ ?>
                                <option class="font-w700" disabled="disabled" selected value="">Mobil</option>
                                <?php for($i=0;$i<count($all_mobil);$i++){?>
                                    <option value="<?= $all_mobil[$i]["mobil_no"]?>"><?= $all_mobil[$i]["mobil_no"]."==".$all_mobil[$i]["mobil_jenis"]?></option>
                                <?php }
                            }?>
                        </select>
                    </div>
                    <div class="float-right mr-5 px-3 mt-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update mobil -->

<script>
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
        var sisa = '<?= $jo['uang_jalan']+$jo['uang_kosongan']-$jo['uang_jalan_bayar']?>';
        var uang_bayar = $("#uang_jalan_bayar").val().split(".");
        var uang_bayar_fix = "";
        for(i=0;i<uang_bayar.length;i++){
            uang_bayar_fix += uang_bayar[i];
        }
        if(parseInt(sisa)<parseInt(uang_bayar_fix)){
            alert('Jumlah Pembayaran UJ Harus Lebih Kecil Dari Rp.'+ rupiah(sisa));
            $( '#uang_jalan_bayar' ).val("");
        }
    }
    function sisa_uj(sisa){
        $("#sisa_uj").text(rupiah(sisa));
    }
</script>