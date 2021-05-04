<!-- MENGGUNAKAN NAMA KOLOM YANG ENGKEL AJA -->
<div class="container">    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rute Paketan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-paketan' onclick="mobil()">
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Rute Paketan
            </span>
        </a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rute Paketan</h6>
    </div>
    <div class="card-body small">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Paketan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%" scope="col">No</th>
                        <th class="text-center" width="5%" scope="col">Rute</th>
                        <th class="text-center" width="10%" scope="col">Jenis Mobil</th>
                        <th class="text-center" width="10%" scope="col">Ritase/Tonase</th>
                        <th class="text-center" width="10%" scope="col">Uang Jalan</th>
                        <th class="text-center" width="15%" scope="col">Status Validasi</th> 
                        <th class="text-center" width="15%" scope="col">Aksi</th>
                        <th class="text-center" width="15%" scope="col">Validasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add rute paketan -->
<div class="modal fade" id="popup-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Tambah Rute Paketan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_paketan")?>" method="POST">             
                    <div class="row">
                        <div class="col-md-6 border rounded">
                            <small class="font-weight-bold">Detail Rute</small>
                            <hr>
                            <a class="btn btn-sm btn-primary mb-3" data-toggle='modal' data-target='#popup-add-rute' id="btn-add-rute">
                                <span class="icon text-white-100">
                                    <i class="fas fa-plus"></i> 
                                </span>
                                <span class="text">
                                    Tambah Rute
                                </span>
                            </a>
                            <a class="btn btn-sm btn-primary mb-3" data-toggle='modal' data-target='#popup-add-kosongan' id="btn-add-kosongan">
                                <span class="icon text-white-100">
                                    <i class="fas fa-plus"></i> 
                                </span>
                                <span class="text">
                                    Tambah Kosongan
                                </span>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered small" id="table-data-rute" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th class="text-center" scope="col">No Rute</th> -->
                                            <th class="text-center" scope="col">Customer</th>
                                            <th class="text-center" scope="col">Dari</th>
                                            <th class="text-center" scope="col">Ke</th>
                                            <th class="text-center" scope="col">Muatan</th>
                                            <th class="text-center" scope="col">Uang Jalan</th>
                                            <th class="text-center" scope="col">Tagihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <input autocomplete="off" type="text" class="form-control" id="data_rute" name="data_rute" hidden>
                        </div>
                        <div class="col-md-3 border rounded">
                            <div class="form-group">
                                <label for="jenis_mobil" class="form-label font-weight-bold ">Jenis Mobil</label> 
                                <select name="jenis_mobil" id="jenis_mobil" class="form-control mb-4" required>
                                    <option class="font-w700" disabled="disabled" selected value="">Jenis Mobil</option>
                                </select>
                            </div>
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="paketan_uj" class="form-label font-weight-bold">Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="paketan_uj" name="paketan_uj" required onkeyup="uang(this)">
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
                        </div>
                        <div class="col-md-3 border rounded">
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
                                    <label for="paketan_gaji" class="form-label font-weight-bold">Gaji(FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="paketan_gaji" name="paketan_gaji" onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="Non-Fix" style="display:none">
                                <div class="form-group">
                                    <label for="paketan_gaji_rumusan" class="form-label font-weight-bold">Gaji Rumusan(Non-FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="paketan_gaji_rumusan" name="paketan_gaji_rumusan" onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paketan_keterangan" class="form-label font-weight-bold">keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="paketan_keterangan" name="paketan_keterangan" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group float-right mt-1 mr-1">
                        
                        <button type="reset" class="btn btn-outline-danger" onclick="reset_form()">Reset</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add rute paketan -->

<!-- pop up add detail rute paketan -->
<div class="modal fade" id="popup-detail-rute-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Detail Rute</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-data-rute-paketan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Customer</th>
                                            <th class="text-center" scope="col">Dari</th>
                                            <th class="text-center" scope="col">Ke</th>
                                            <th class="text-center" scope="col">Muatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-detail-paketan" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Keterangan</td>
                                            <td><span id="detail-keterangan"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Tonase</td>
                                            <td><span id="detail-tonase"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Type Gaji</td>
                                            <td><span id="detail-gaji"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Gaji Fix</td>
                                            <td><span id="detail-gaji-fix"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Gaji Non-Fix</td>
                                            <td><span id="detail-gaji-nonfix"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add detail rute paketan -->

<!-- pop up add rute Kosongan untuk form add rute paketan -->
<div class="modal fade" id="popup-add-kosongan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Pilih Rute Kosongan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <div class="form-group">
                    <label class="form-label font-weight-bold " for="kosongan_id">Rute Kosongan</label>
                    <select name="kosongan_id" value="DESC" id="kosongan_id" class="form-control selectpicker mb-4" data-live-search="true">
                    <option class="font-w700" selected value="0">Dari - Ke - Uang Jalan</option>
                        <?php foreach($kosongan as $value){?>
                            <option value="<?=$value["kosongan_id"]?>"><?=$value["kosongan_dari"]?> - <?=$value["kosongan_ke"]?> - Rp.<?= number_format($value["kosongan_uang"],2,",",".")?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" data-dismiss="modal" aria-label="Close" class="btn btn-success" onclick="add_rute('kosongan','x')"><i class="fas fa-plus"></i>Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add rute Kosongan untuk form add rute paketan -->

<!-- pop up add rute untuk form add rute paketan -->
<div class="modal fade" id="popup-add-rute" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Tambah Rute</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <div class="col-md-3 col-md-offset-4 mb-4">
                    <label class="form-label font-weight-bold " for="Customer">Customer</label>
                    <select name="Customer" value="DESC" id="Customer" class="form-control selectpicker mb-4" data-live-search="true" required onchange="customer()">
                        <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                        <?php foreach($customer as $value){?>
                            <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="Table-Add-Rute-Paketan" width="100%" cellspacing="0">
                            <thead>
                                <tr>    
                                    <th class="text-center" scope="col">Customer</th>
                                    <th class="text-center" scope="col">Muatan</th>
                                    <th class="text-center" scope="col">Dari</th>
                                    <th class="text-center" scope="col">Ke</th>
                                    <th class="text-center" scope="col">Uang Jalan</th>
                                    <th class="text-center" scope="col">Tagihan</th>
                                    <!-- <th class="text-center" scope="col">Tonase</th> -->
                                    <th class="text-center" width="15%" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add rute untuk form add rute paketan -->

<!-- pop up update rute paketan -->
<div class="modal fade" id="popup-update-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Rute Paketan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_paketan")?>" method="POST">
        
                    <div class="row">
                        <div class="col-md-6 border rounded mr-3 ml-3">
                            <div class="form-group">
                                <input autocomplete="off" type="text" class="form-control" name="paketan_id_update" id="paketan_id_update" required hidden>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-data-rute-update" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No Rute</th>
                                            <th class="text-center" scope="col">Dari</th>
                                            <th class="text-center" scope="col">Ke</th>
                                            <th class="text-center" scope="col">Muatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3">
                            <div class="form-group">
                                <label for="jenis_mobil_update" class="form-label font-weight-bold ">Jenis Mobil</label> 
                                <select name="jenis_mobil_update" id="jenis_mobil_update" class="form-control mb-4" required>
                                    <option class="font-w700" disabled="disabled" selected value="">Jenis Mobil</option>
                                </select>
                            </div>
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="paketan_uj_update" class="form-label font-weight-bold">Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="paketan_uj_update" name="paketan_uj_update" required onkeyup="uang(this)">
                            </div>
                            <small class="font-weight-bold">Detail Keuangan</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Ritase_update">Ritase/Tonase</label>
                                <input autocomplete="off" type="text" class="form-control" name="Ritase_update" id="Ritase_update" required readonly>
                            </div>
                        </div>
                        <div class="col border rounded mr-3 ml-3">
                            <small class="font-weight-bold">Detail Gaji</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Gaji_update">Gaji</label>
                                <input autocomplete="off" type="text" class="form-control" id="Gaji_update" name="Gaji_update" required readonly>
                            </div>
                            <div class="Tonase">
                                <div class="form-group">
                                    <label for="Tonase_update" class="form-label font-weight-bold">Tonase</label>  
                                    <input autocomplete="off" type="text" class="form-control" id="Tonase_update" name="Tonase_update">
                                </div>
                            </div>
                            <div class="Fix">
                                <div class="form-group">
                                    <label for="paketan_gaji_update" class="form-label font-weight-bold">Gaji(FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="paketan_gaji_update" name="paketan_gaji_update" onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="Non-Fix">
                                <div class="form-group">
                                    <label for="paketan_gaji_rumusan_update" class="form-label font-weight-bold">Gaji Rumusan(Non-FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="paketan_gaji_rumusan_update" name="paketan_gaji_rumusan_update" onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paketan_keterangan_update" class="form-label font-weight-bold">keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="paketan_keterangan_update" name="paketan_keterangan_update" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group float-right mt-1 mr-1">
                        
                        <button type="reset" class="btn btn-outline-danger" onclick="reset_form()">Reset</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update rute paketan -->


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
    function mobil(){
        $('#jenis_mobil').find('option').remove().end(); //reset option select
        var isi_jenis = [];
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
                        if(!isi_jenis.includes(data[i]["mobil_jenis"])){
                            $('#jenis_mobil').append('<option value="'+data[i]["mobil_jenis"]+'">'+data[i]["mobil_jenis"]+'</option>'); 
                            isi_jenis.push(data[i]["mobil_jenis"]);
                        }
                    }
                }
            }
        });
    }
</script>
<script>
    var array_dari = [];
    var array_ke = [];
    var array_muatan = [];
    function tambah_rute(){
        //before proses
        var dari = $("#rute_dari").val();
        var ke = $("#rute_ke").val();
        var muatan = $("#rute_muatan").val();

        //proses
        array_dari.push(dari);
        array_ke.push(ke);
        array_muatan.push(muatan);
        var html = "";
        for(i=0;i<array_dari.length;i++){
            html += "<tr>"+
            "<td>Rute ke-"+(i+1)+"</td>"+
            "<td>"+array_dari[i]+"</td>"+
            "<td>"+array_ke[i]+"</td>"+
            "<td>"+array_muatan[i]+"</td>"+
            "</tr>"
        }
        $("#table-data-rute tbody").html(html);
        $("#data_rute_dari").val(array_dari);
        $("#data_rute_ke").val(array_ke);
        $("#data_rute_muatan").val(array_muatan);
        //after proses
        $("#rute_dari").val("");
        $("#rute_ke").val("");
        $("#rute_muatan").val("");
    }
</script>