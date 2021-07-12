<?php
    function change_tanggal($data){
        if($data==""){
            return "";
        }else{
            $data_tanggal = explode('-', $data);
            $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
            return $tanggal;
        }
    }
?>
<!-- Basic Card Example -->
<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Detail Job Order</h6>
        <div class="float-right ml-3">
                <a class='btn btn-primary btn-sm ' href='<?= base_url("index.php/print_berkas/uang_jalan/").$jo["Jo_id"]."/detail"?>' id="">
                    <span>Print/PDF</span>
                </a>
        </div>
        <div class="float-right">
            <form method="POST" action="<?= base_url("index.php/print_berkas/jo_excel/")?>" id="convert_form">
                <input type="hidden" name="file_content" id="file_content">
                <button type="submit" name="convert" id="convert" class="btn btn-primary btn-sm">
                    <span class="text">Excel</span>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <!-- tampilan detail jo -->
        <div class="container" id="detail-jo">
            <table class="table table-bordered" id="Table-JO">
                <tbody>     
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">ID JO</td>
                        <td colspan=3><?= $jo["Jo_id"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal JO</td>
                        <td colspan=3><?= change_tanggal($jo["tanggal_surat"]) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Supir</td>                
                            <?php if($jo["status"]=="Dalam Perjalanan"){?>
                                <td colspan=3>
                                    <div class="row ">
                                        <p class="col"><?= $supir["supir_name"] ?></p>
                                        <!-- <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#supir_update">
                                            <span>Ganti Supir</span>
                                        </a> -->
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
                                        <!-- <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#mobil_update">
                                            <span>Ganti mobil</span>
                                        </a> -->
                                    </div>                                    
                                </td>
                            <?php }else{?>
                                <td colspan=3><?= $mobil["mobil_no"]." == ".$mobil["mobil_jenis"] ?></td>
                            <?php }?>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Customer</td>
                        <td colspan=3><?= $customer["customer_name"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Rute Muatan</td>
                        <td colspan=3>
                            <table class="table table-bordered small">
                                <thead>
                                    <tr>
                                        <th>Dari</th>
                                        <th>Ke</th>
                                        <th>Muatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $jo["asal"]?></td>
                                        <td><?= $jo["tujuan"]?></td>
                                        <td><?= $jo["muatan"]?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Uang Jalan</td>
                        <td colspan=3><p>Rp.<?= number_format($jo["uang_jalan"],2,',','.') ?></p></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Tambahan/Potongan Uang Jalan</td>
                            <td colspan=3><p>Rp.<?= number_format($jo["nominal_tambahan"],2,',','.') ?> (<?= $jo["jenis_tambahan"]?>)</p></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Total Uang Jalan</td>
                        <td colspan=3><p>Rp.<?= number_format($jo["uang_total"],2,',','.')?></p></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Sisa Uang Jalan</td>
                        <td colspan=3>Rp.<?=number_format($jo["sisa"],2,',','.')?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Catatan/Keterangan</td>
                        <td colspan=3><?= $jo["keterangan"]?></td>
                    </tr>
                                        <tr>
                        <td class="font-weight-bold" style="width: 25%;">Status</td>
                        <td colspan=3><?= $jo["status"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Muat</td>
                        <td colspan=3><?= change_tanggal($jo["tanggal_muat"]) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Bongkar</td>
                        <td colspan=3><?= change_tanggal($jo["tanggal_bongkar"]) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Berat Muatan</td>
                        <td colspan=3><?= $jo["tonase"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Biaya Lain-lain</td>
                        <td colspan=3>Rp.<?= number_format($jo["biaya_lain"],2,',','.')?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">No Slip Gaji</td>
                        <td colspan=3><?= $slip_gaji[0]["pembayaran_upah_id"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Slip Gaji</td>
                        <td colspan=3><?= change_tanggal($slip_gaji[0]["pembayaran_upah_tanggal"]) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Nominal Gaji</td>
                        <td colspan=3>Rp.<?= number_format($jo["upah"],2,',','.')?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">No Invoice</td>
                        <td colspan=3><?= $invoice[0]["invoice_id"]?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Invoice</td>
                        <td colspan=3><?= change_tanggal($invoice[0]["tanggal_invoice"])?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Nominal Invoice</td>
                        <td colspan=3>Rp.<?= number_format($jo["total_tagihan"],2,',','.')?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Pembuat JO</td>
                        <td colspan=3><?= $jo["user"]?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Penutup JO</td>
                        <td colspan=3><?= $jo["user_closing"]?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Pembuat Slip Gaji</td>
                        <td colspan=3><?= $slip_gaji[0]["user_upah"]?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Pembuat Invoice</td>
                        <td colspan=3><?= $invoice[0]["user_invoice"]?></td>
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
<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script>
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
        var sisa = '<?= $jo['uang_total']-$jo['uang_jalan_bayar']?>';
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
<script type="text/javascript">
 $(document).ready(function() {
  $('#convert').click(function() {
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-JO').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
  });
 });
 function print_pdf(){
     alert("ASdsa");
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('Table-Bon-Print').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>