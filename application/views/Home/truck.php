<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Kendaraan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-truck'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Kendaraan
            </span>
        </a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kendaraan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Truck" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">No Polisi</th>
                        <th class="text-center" scope="col">Merk</th>
                        <th class="text-center" scope="col">Type</th>
                        <th class="text-center" scope="col">Jenis Kendaraan</th>
                        <th class="text-center" scope="col">Tahun</th>
                        <th class="text-center" scope="col">Tgl.Berlaku STNK</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add truck -->
<div class="modal fade  px-3 " id="popup-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form action="<?= base_url("index.php/form/insert_truck")?>" method="POST">
                        <div class="form-group mt-1">
                            <label for="mobil_no" class="form-label font-weight-bold">Plat No Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no" name="mobil_no" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_merk" class="form-label font-weight-bold">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_merk" name="mobil_merk" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_type" class="form-label font-weight-bold">Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_type" name="mobil_type" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_jenis">Jenis Mobil</label>
                            <select name="mobil_jenis" id="mobil_jenis" class="form-control custom-select" required onchange="nominal()">
                                <option class="font-w700" disabled="disabled" selected value="">Jenis Mobil</option>
                                <option value="Sedang(Engkel)">Sedang(Engkel)</option>
                                <option value="Besar(Tronton)">Besar(Tronton)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_dump">Dump</label>
                            <select name="mobil_dump" id="mobil_dump" class="form-control custom-select" required onchange="nominal()">
                                <option class="font-w700" disabled="disabled" selected value="">Pilih Ya/Tidak</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>    
                    <div class="col ml-1">
                        <div class="form-group">
                            <label for="mobil_tahun" class="form-label font-weight-bold">Tahun</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_tahun" name="mobil_tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_max_load" class="form-label font-weight-bold">Muatan Maksimal Mobil (Ton)</label>
                            <input autocomplete="off" type="number" class="form-control" id="mobil_max_load" name="mobil_max_load" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku" class="form-label font-weight-bold">Tgl.Berlaku STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku" name="mobil_berlaku" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_pajak" class="form-label font-weight-bold">Tgl.Pajak STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_pajak" name="mobil_pajak" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_keterangan" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="mobil_keterangan" rows="3"></textarea>
                        </div>
                    </div>
                </div>  
            </div>
                    <div class="form-group mt-1 mr-4 ">
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- end pop up add truck -->

<!-- pop up update truck -->
<div class="modal fade mt-5 px-5 py-2" id="popup-update-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_truck")?>" method="POST">     
                    <input autocomplete="off" type="text" class="form-control" id="mobil_no_update" name="mobil_no_update" required hidden>
                        <div class="form-group">
                            <label for="mobil_berlaku_update" class="form-label font-weight-bold">Tgl.Berlaku STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_update" name="mobil_berlaku_update" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_pajak_update" class="form-label font-weight-bold">Tgl.Pajak STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_pajak_update" name="mobil_pajak_update" required onclick="tanggal_pajak(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_keterangan_update" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" id="mobil_keterangan_update" name="mobil_keterangan_update" rows="3"></textarea>
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update truck -->

<!-- pop up detail kendaraan -->
<div class="modal fade" id="popup-kendaraan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">No Polisi</td>
                                <td name="mobil_no"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Jenis Kendaraan</td>
                                <td name="mobil_jenis"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Status Jalan</td>
                                <td name="status_jalan"></td>
                            </tr>
                            <!-- <tr>
                                <td class="font-weight-bold" style="width: 30%;">Maximum Load (Ton)</td>
                                <td name="mobil_max_load"></td>
                            </tr> -->
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                                <td name="mobil_keterangan"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Merk</td>
                                <td name="mobil_merk"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Type</td>
                                <td name="mobil_type"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Dump</td>
                                <td name="mobil_dump"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 30%;">Tahun</td>
                                <td name="mobil_tahun"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Tgl.Berlaku STNK</td>
                                <td name="mobil_berlaku"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Tgl.Pajak STNK</td>
                                <td name="mobil_pajak"></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<!-- end pop up detail kendaraan -->