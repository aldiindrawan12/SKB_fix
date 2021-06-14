<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Seluruh Data Job Order</h6>
        </div>
        <!-- tabel JO -->
        <div class="card-body">
            <div class="conatiner w-50 m-auto">
                <div class="mb-2 form-group row">
                    <label for="Status" class="form-label font-weight-bold col-md-3">Status</label>
                    <select name="Status" id="Status" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Status</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                        <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                        <option value="Sampai Tujuan">Sampai Tujuan</option>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Supir">Supir</label>
                    <select name="Supir" id="Supir" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Supir Pengiriman</option>
                        <?php foreach($supir as $value){?>
                            <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Kendaraan">Kendaraan</label>
                    <select name="Kendaraan" id="Kendaraan" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                        <?php foreach($mobil as $value){?>
                                <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Jenis">Jenis Mobil</label>
                    <select name="Jenis" id="Jenis" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Jenis Mobil</option>
                        <?php $isi_jenis = array();
                            foreach($mobil as $value){
                            if(!in_array($value["mobil_jenis"],$isi_jenis)){
                                array_push($isi_jenis[] = $value["mobil_jenis"]);
                            }
                        }?>
                        <?php for($i=0;$i<count($isi_jenis);$i++){?>
                            <option value="<?= $isi_jenis[$i]?>"><?= $isi_jenis[$i]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Customer">Customer</label>
                    <select name="Customer" value="DESC" id="Customer" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                        <?php foreach($customer as $value){?>
                            <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label for="Tanggal" class="form-label font-weight-bold col-md-3">Tanggal JO</label>
                    <input autocomplete="off" type="text" class="form-control col-md-4 mr-4" id="Tanggal1" name="Tanggal1" onclick="tanggal_berlaku(this)">
                    <input autocomplete="off" type="text" class="form-control col-md-4" id="Tanggal2" name="Tanggal2" onclick="tanggal_berlaku(this)">
                </div>
                <div class="mb-2 form-group row">
                    <label for="Jo_id" class="form-label font-weight-bold col-md-3">ID JO</label>
                    <input autocomplete="off" type="text" class="form-control col-md-9" id="Jo_id" name="Jo_id">
                </div>
                <div class="mb-2 form-group text-center">
                    <button class="btn btn-primary" id="btn-cari">Cari</button>
                    <button class="btn btn-danger" onclick="reset_form()">Reset</button>
                </div>
            </div>
            <hr>
            <div class="container">
                <span>Total Data JO Yang Ditemukan : </span><span id="ditemukan"><?= count($jo)?></span>
            </div>
            <hr>
            <div class="table-responsive thead-dark small">
                <table class="table table-bordered  small" id="Table-Job-Order" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  class="text-center" scope="col">No JO</th>
                            <th class="text-center" scope="col">Tanggal</th>
                            <th  scope="col">Status</th>
                            <th class="text-center" scope="col">Driver</th>
                            <th class="text-center" scope="col">No Pol</th>
                            <th class="text-center" scope="col">Jenis Mobil</th>
                            <th  class="text-center" scope="col">Customer</th>
                            <th  class="text-center" scope="col">Muatan</th>
                            <th  class="text-center" scope="col">Dari</th>
                            <th  class="text-center" scope="col">Ke</th>
                            <th class="text-center" scope="col">Total UJ</th>
                            <th class="text-center" scope="col">Sisa UJ</th>
                            <th class="text-center" scope="col">Biaya Lain</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end tabel JO -->
    </div>
</div>
<!-- pop up add detail rute paketan -->
<div class="modal fade" id="popup-detail-rute-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md"  role="document"  >
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
                                            <th class="text-center" scope="col">Ketrangan</th>
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
        </div>
    </div>
</div>
<!-- end pop up add detail rute paketan -->
</div>

<script>
    function reset_form(){
        location.reload();
    }
</script>