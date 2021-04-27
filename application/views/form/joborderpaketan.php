    <div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3 ">Buat Job Order (Paketan)</h1>
    </div> 
        <!-- Card Formulir JO -->
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Form Buat Job Order (Paketan)</h6>
            </div>
            <div class="card-body">
                <small>Pilih Rute Pada Table di Bawah</small>
                <!-- form Job Order Baru -->
                <form action="<?=base_url("index.php/form/insert_JO_paketan")?>" method="POST" class="row">
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
                        <table class="table table-bordered" id="Table-Pilih-Rute-Paketan" width="100%" cellspacing="0">
                            <thead>
                                <tr>    
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nama Customer</th>
                                    <th class="text-center" scope="col">Rute</th>
                                    <th class="text-center" scope="col">Jenis Mobil</th>
                                    <th class="text-center" scope="col">Ritase/Tonase</th>
                                    <th class="text-center" scope="col">Uang Jalan</th>
                                    <th class="text-center" scope="col">Inv./Tagihan</th>
                                    <th class="text-center" width="20%" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Jenis">Jenis Mobil</label>
                        <input autocomplete="off" type="text" class="form-control" name="Jenis" id="Jenis" required readonly>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Type_Tonase">Tipe Tonase</label>
                        <input autocomplete="off" type="text" class="form-control" name="Type_Tonase" id="Type_Tonase" required readonly>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4 Tonase">
                        <label class="form-label font-weight-bold" for="Tonase">Tonase</label>
                        <input autocomplete="off" type="text" class="form-control" name="Tonase" id="Tonase" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Uang" class="form-label font-weight-bold">Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="Uang" name="Uang" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 ">
                        <label for="Terbilang" class="form-label font-weight-bold">Terbilang</label>
                        <input autocomplete="off" type="text" class="form-control" id="Terbilang" name="Terbilang" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label for="uang_jalan_bayar" class="form-label font-weight-bold">Uang Jalan Dibayar</label>
                        <input autocomplete="off" type="text" class="form-control" id="uang_jalan_bayar" name="uang_jalan_bayar" required onkeyup="uang(this)">
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Supir">Supir</label>
                        <select name="Supir" id="Supir" class="form-control selectpicker mb-4" data-live-search="true" required>
                            <option class="font-w700 mb-4" disabled="disabled" selected value="">Supir Pengiriman</option>
                            <?php foreach($supir as $value){
                                if($value["status_jalan"]!="Jalan"){?>
                                <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold " for="Kendaraan">Kendaraan</label>
                        <select name="Kendaraan" id="Kendaraan" class="form-control mb-4" required>
                            <option class="font-w700 font-weight-bold mb-4" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 ">
                        <label for="Keterangan" class="form-label font-weight-bold">Keterangan/Catatan</label>
                        <textarea class="form-control" name="Keterangan" id="Keterangan" rows="3"></textarea>
                    </div>
                    <div class="table-responsive col-md-12 col-md-offset-12 text-center">
                        <strong>Data Rute</strong>
                        <table class="table table-bordered" id="table-data-rute-paketan" width="100%" cellspacing="0">
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
                    <input autocomplete="off" type="text" class="form-control" id="paketan_id" name="paketan_id" required hidden>
                    <input autocomplete="off" type="text" class="form-control" id="Upah" name="Upah" required hidden>
                    <input autocomplete="off" type="text" class="form-control" id="Tagihan" name="Tagihan" required hidden>
                    <div class="col-md-12 col-md-offset-4 ">
                        <button type="submit" class="btn btn-success ml-3 mt-5 float-md-right">Simpan dan Cetak</button>
                        <button type="reset" class="btn btn-outline-danger mb-3 mt-5  float-md-right" onclick="reset_form()">Reset</button>
                    </div>
                </form>
                <!-- end form Job Order Baru -->
            </div>
        </div>
    </div>
    <!-- pop up add detail rute paketan -->
    <div class="modal fade" id="popup-detail-rute-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
        <div class="modal-dialog modal-xl"  role="document"  >
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
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-detail-paketan" width="100%" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td><span id="detail-keterangan"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Tonase</td>
                                                <td><span id="detail-tonase"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Type Gaji</td>
                                                <td><span id="detail-gaji"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Gaji Fix</td>
                                                <td><span id="detail-gaji-fix"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Gaji Non-Fix</td>
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

<script>
    function reset_form(){
        location.reload();
    }
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
</script>