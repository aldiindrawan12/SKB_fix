<div class="container">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rute dan Muatan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-rute'>
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
                        <th class="text-center" scope="col">Nama Customer</th>
                        <th class="text-center" scope="col">Dari</th>
                        <th class="text-center" scope="col">Ke</th>
                        <th class="text-center" scope="col">Muatan</th>
                        <th class="text-center" scope="col">UJ.Engkel</th>
                        <th class="text-center" scope="col">UJ.Tronton</th>
                        <th class="text-center" scope="col">Inv./Tagihan</th>
                        <th class="text-center" scope="col">Gj.Engkel</th>
                        <th class="text-center" scope="col">Gj.Tronton</th>
                        <th class="text-center" scope="col">Gj.Rumusan</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add rute dan muatan -->
<div class="modal fade px-5 py-5" id="popup-rute" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Rute dan Muatan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_rute")?>" method="POST">
                    <div class="row">
                        <div class="col border rounded border-secondary mr-3">
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
                        <div class="col border rounded border-secondary mr-3">
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_uj_engkel" class="form-label font-weight-bold">Uj.Engkel</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_engkel" name="rute_uj_engkel" required onkeyup="uang(this)">
                            </div>
                            <div class="form-group">
                                <label for="rute_uj_tronton" class="form-label font-weight-bold">Uj.Tronton</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_tronton" name="rute_uj_tronton" required onkeyup="uang(this)">
                            </div>
                            <small class="font-weight-bold">Detail Keuangan</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_tagihan" class="form-label font-weight-bold">Inv./Tagihan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_tagihan" name="rute_tagihan" required onkeyup="uang(this)">
                            </div>
                        </div>
                        <div class="col border rounded border-secondary">
                            <small class="font-weight-bold">Detail Gaji</small>
                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold" for="Gaji">Gaji</label>
                                <select name="Gaji" id="Gaji" class="form-control selectpicker mb-4" data-live-search="true" required onchange="gaji()">
                                    <option class="font-w700 mb-4" disabled="disabled" selected value="">Tipe Gaji</option>
                                    <option class="font-w700 mb-4" value="Fix">Fix</option>
                                    <option class="font-w700 mb-4" value="Non-Fix">Non-Fix</option>
                                </select>
                            </div>
                            <div class="Fix">
                                <div class="form-group">
                                    <label for="rute_gaji_engkel" class="form-label font-weight-bold">Gaji Engkel(FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel" name="rute_gaji_engkel" required onkeyup="uang(this)">
                                </div>
                                <div class="form-group">
                                    <label for="rute_gaji_tronton" class="form-label font-weight-bold">Gaji Tronton(FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="rute_gaji_tronton" name="rute_gaji_tronton" required onkeyup="uang(this)">
                                </div>
                            </div>
                            <div class="Non-Fix">
                                <div class="form-group">
                                    <label for="rute_gaji_engkel" class="form-label font-weight-bold">Gaji Engkel(Non-FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel" name="rute_gaji_engkel" required onkeyup="uang(this)">
                                </div>
                                <div class="form-group">
                                    <label for="rute_gaji_tronton" class="form-label font-weight-bold">Gaji Tronton(Non-FIX)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="rute_gaji_tronton" name="rute_gaji_tronton" required onkeyup="uang(this)">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="rute_gaji_rumusan" class="form-label font-weight-bold">Gaji Non-FIX</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_rumusan" name="rute_gaji_rumusan" required onkeyup="uang(this)">
                            </div> -->
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
<div class="modal fade px-5 py-5" id="popup-update-rute" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
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
                        <div class="col border rounded border-secondary mr-3">
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
                        </div>
                        <div class="col border rounded border-secondary mr-3">
                            <small class="font-weight-bold">Detail Uang Jalan (Uj)</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_uj_engkel_update" class="form-label font-weight-bold">Uj.Engkel</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_engkel_update" name="rute_uj_engkel_update" required onkeyup="uang(this)">
                            </div>
                            <div class="form-group">
                                <label for="rute_uj_tronton_update" class="form-label font-weight-bold">Uj.Tronton</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_uj_tronton_update" name="rute_uj_tronton_update" required onkeyup="uang(this)">
                            </div>
                            <small class="font-weight-bold">Detail Keuangan</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_tagihan_update" class="form-label font-weight-bold">Inv./Tagihan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_tagihan_update" name="rute_tagihan_update" required onkeyup="uang(this)">
                            </div>
                        </div>
                        <div class="col border rounded border-secondary">
                            <small class="font-weight-bold">Detail Gaji</small>
                            <hr>
                            <div class="form-group">
                                <label for="rute_gaji_engkel_update" class="form-label font-weight-bold">Gaji Engkel</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_engkel_update" name="rute_gaji_engkel_update" required onkeyup="uang(this)">
                            </div>
                            <div class="form-group">
                                <label for="rute_gaji_tronton_update" class="form-label font-weight-bold">Gaji Tronton</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_tronton_update" name="rute_gaji_tronton_update" required onkeyup="uang(this)">
                            </div>
                            <div class="form-group">
                                <label for="rute_gaji_rumusan_update" class="form-label font-weight-bold">Rumusan</label>
                                <input autocomplete="off" type="text" class="form-control" id="rute_gaji_rumusan_update" name="rute_gaji_rumusan_update" required onkeyup="uang(this)">
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

<script>
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
    function gaji(){
        $(".Fix").hide();
        $(".Non-Fix").hide();
        $("."+$("#Gaji").val()).show();
    }
</script>