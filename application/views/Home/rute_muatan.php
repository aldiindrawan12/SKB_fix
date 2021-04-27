<!-- MENGGUNAKAN NAMA KOLOM YANG ENGKEL AJA -->
<div class="container">    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rute dan Muatan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-rute' onclick="mobil()">
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Rute & Muatan
            </span>
        </a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rute dan Muatan</h6>
    </div>
    <div class="card-body small">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-rute" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">No</th>
                        <th class="text-center" scope="col">ID Rute</th>
                        <th class="text-center" scope="col">Nama Customer</th>
                        <th class="text-center" scope="col">Dari</th>
                        <th class="text-center" scope="col">Ke</th>
                        <th class="text-center" scope="col">Muatan</th>
                        <th class="text-center" scope="col">Uang Jalan</th>
                        <th class="text-center" scope="col">Inv./Tagihan</th>
                        <th class="text-center" scope="col">Status Validasi</th>
                        <th class="text-center" width="20%" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add rute dan muatan -->
<div class="modal fade" id="popup-rute" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Tambah Rute dan Muatan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_rute")?>" method="POST">
                    <div class="row">
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <div class="form-group">
                            <label class="form-label font-weight-bold " for="customer_id">Nama Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control selectpicker" data-live-search="true" required>
                                <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                                <?php foreach($customer as $value){?>
                                    <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="rute_dari">Dari</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_dari" name="rute_dari" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="rute_ke">Ke</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_ke" name="rute_ke" required>
                            </div>
                            <div class="form-group">
                                <label for="rute_muatan" class="form-label font-weight-bold ">Muatan</label> 
                                <input autocomplete="off" type="text" class="form-control" id="rute_muatan" name="rute_muatan" required>
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <div class="form-group">
                                <label for="jenis_mobil" class="form-label font-weight-bold ">Jenis Mobil</label> 
                                <select name="jenis_mobil" id="jenis_mobil" class="form-control mb-4" required>
                                    <option class="font-w700" disabled="disabled" selected value="">Jenis Mobil</option>
                                </select>
                            </div>
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_uj_engkel" class="form-label font-weight-bold">Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_engkel" name="rute_uj_engkel" required onkeyup="uang(this)">
                            </div>
                            <small class="font-weight-bold">Detail Keuangan</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Ritase">Ritase/Tonase</label>
                                <select name="Ritase" id="Ritase" class="form-control" required>
                                    <option class="font-w700" disabled="disabled" selected value="">Ritase/Tonase</option>
                                    <option class="font-w700" value="Ritase">Ritase</option>
                                    <option class="font-w700" value="Tonase">Tonase</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rute_tagihan" class="form-label font-weight-bold">Inv./Tagihan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_tagihan" name="rute_tagihan" required onkeyup="uang(this)">
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <small class="font-weight-bold">Detail Gaji</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Gaji">Gaji</label>
                                <select name="Gaji" id="Gaji" class="form-control" required onchange="gaji()">
                                    <option class="font-w700" disabled="disabled" selected value="">Tipe Gaji</option>
                                    <option class="font-w700" value="Fix">Fix</option>
                                    <option class="font-w700" value="Non-Fix">Non-Fix</option>
                                </select>
                            </div>
                            <div class="Tonase" style="display:none">
                                <div class="form-group">
                                    <label for="Tonase" class="form-label font-weight-bold">Tonase</label>  
                                    <input autocomplete="off" type="text" class="form-control" id="Tonase" name="Tonase">
                                </div>
                            </div>
                            <div class="Fix" style="display:none">
                                <div class="form-group">
                                    <label for="rute_gaji_engkel" class="form-label font-weight-bold">Gaji(FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel" name="rute_gaji_engkel" onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="Non-Fix" style="display:none">
                                <div class="form-group">
                                    <label for="rute_gaji_engkel_rumusan" class="form-label font-weight-bold">Gaji Rumusan(Non-FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel_rumusan" name="rute_gaji_engkel_rumusan" onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rute_keterangan" class="form-label font-weight-bold">Keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_keterangan" name="rute_keterangan" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mt-3 float-right">Simpan</button>
                    <button type="reset" class="btn btn-outline-danger mr-3  mt-3 float-md-right" onclick="reset_form()">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add rute dan muatan -->

<!-- pop up update rute dan muatan -->
<div class="modal fade" id="popup-update-rute" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Rute dan Muatan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_rute")?>" method="POST">
                    <div class="row">
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <input type="text" name="rute_id_update" id="rute_id_update" hidden>
                            <input autocomplete="off" type="text" class="form-control" id="customer_id_update" name="customer_id_update" required hidden>
                            <div class="form-group">
                                <label class="form-label font-weight-bold " for="customer_name_update">Nama Customer</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_name_update" name="customer_name_update" required readonly>
                            </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="rute_dari_update">Dari</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_dari_update" name="rute_dari_update" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="rute_ke_update">Ke</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_ke_update" name="rute_ke_update" required>
                            </div>
                            <div class="form-group">
                                <label for="rute_muatan_update" class="form-label font-weight-bold ">Muatan</label> 
                                <input autocomplete="off" type="text" class="form-control" id="rute_muatan_update" name="rute_muatan_update" required>
                            </div>
                            <div class="rute_tonase_update">
                                <div class="form-group">
                                    <label for="rute_tonase_update" class="form-label font-weight-bold">Tonase</label>  
                                    <input autocomplete="off" type="text" class="form-control" id="rute_tonase_update" name="rute_tonase_update">
                                </div>
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <div class="form-group">
                                <label for="jenis_mobil_update" class="form-label font-weight-bold ">Jenis Mobil</label> 
                                <input autocomplete="off" type="text" class="form-control"  name="jenis_mobil_update" id="jenis_mobil_update" readonly>
                            </div>
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_uj_engkel_update" class="form-label font-weight-bold">Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_engkel_update" name="rute_uj_engkel_update" required onkeyup="uang(this)">
                            </div>
                            <small class="font-weight-bold">Detail Keuangan</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Ritase_update">Ritase/Tonase</label>
                                <input autocomplete="off" type="text" class="form-control" name="Ritase_update" id="Ritase_update" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="rute_tagihan_update" class="form-label font-weight-bold">Inv./Tagihan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_tagihan_update" name="rute_tagihan_update" required onkeyup="uang(this)">
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <small class="font-weight-bold">Detail Gaji Supir</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_gaji_engkel_update" class="form-label font-weight-bold">Gaji(Fix)</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel_update" name="rute_gaji_engkel_update" required onkeyup="uang(this)">
                            </div>
                            <div class="form-group">
                                <label for="rute_gaji_engkel_rumusan_update" class="form-label font-weight-bold">Gaji Rumusan(Non-Fix)</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel_rumusan_update" name="rute_gaji_engkel_rumusan_update" required onkeyup="uang(this)">
                            </div>
                            <div class="form-group">
                                <label for="rute_keterangan_update" class="form-label font-weight-bold">keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_keterangan_update" name="rute_keterangan_update">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 mt-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update rute dan muatan -->

<!-- pop up detail rute -->
<div class="modal fade" id="popup-detail-rute" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Rute</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <div class="row ">
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <div class="form-group">
                                <label class="form-label font-weight-bold " for="customer_name_detail">Nama Customer</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_name_detail" name="customer_name_detail" readonly>
                            </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="rute_dari_detail">Dari</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_dari_detail" name="rute_dari_detail" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="rute_ke_detail">Ke</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_ke_detail" name="rute_ke_detail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rute_muatan_detail" class="form-label font-weight-bold ">Muatan</label> 
                                <input autocomplete="off" type="text" class="form-control" id="rute_muatan_detail" name="rute_muatan_detail" readonly>
                            </div>
                            <div class="rute_tonase_detail">
                                <div class="form-group">
                                    <label for="rute_tonase_detail" class="form-label font-weight-bold">Tonase</label>  
                                    <input autocomplete="off" type="text" class="form-control" id="rute_tonase_detail" name="rute_tonase_detail" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <div class="form-group">
                                <label for="jenis_mobil_detail" class="form-label font-weight-bold">Jenis Mobil</label>  
                                <input autocomplete="off" type="text" class="form-control" id="jenis_mobil_detail" name="jenis_mobil_detail" readonly>
                            </div>
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_uj_engkel_detail" class="form-label font-weight-bold">Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_engkel_detail" name="rute_uj_engkel_detail" readonly>
                            </div>
                            <small class="font-weight-bold">Detail Keuangan</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Ritase_detail">Ritase/Tonase</label>
                                <input autocomplete="off" type="text" class="form-control" id="Ritase_detail" name="Ritase_detail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rute_tagihan_detail" class="form-label font-weight-bold">Inv./Tagihan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_tagihan_detail" name="rute_tagihan_detail" readonly>
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3 mb-3 mt-3">
                            <small class="font-weight-bold">Detail Gaji Supir</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_gaji_engkel_detail" class="form-label font-weight-bold">Gaji(Fix)</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel_detail" name="rute_gaji_engkel_detail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rute_gaji_engkel_rumusan_detail" class="form-label font-weight-bold">Gaji Rumusan(Non-Fix)</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel_rumusan_detail" name="rute_gaji_engkel_rumusan_detail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rute_keterangan_detail" class="form-label font-weight-bold">keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_keterangan_detail" name="rute_keterangan_detail" readonly>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- end pop up detail rute -->

<script>
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
    function gaji(){
        $(".Fix").hide();
        $(".Non-Fix").hide();
        $("."+$("#Gaji").val()).show();
        if($("#Gaji").val()=="Non-Fix"){
            $(".Tonase").show();
        }else{
            $(".Tonase").hide();
        }
    }
</script>
<script>
    function mobil(){
        $('#jenis_mobil').find('option').remove().end(); //reset option select
        var isi_muatan = [];
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/form/getallmobil/') ?>",
            dataType: "JSON",
            success: function(data) {
                if(data.length==0){
                    $('#jenis_mobil').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#jenis_mobil').append('<option class="font-w700" disabled="disabled" selected value="">Jenis Mobil</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_muatan.includes(data[i]["mobil_jenis"])){
                            $('#jenis_mobil').append('<option value="'+data[i]["mobil_jenis"]+'">'+data[i]["mobil_jenis"]+'</option>'); 
                            isi_muatan.push(data[i]["mobil_jenis"]);
                        }
                    }
                }
            }
        });
    }
</script>