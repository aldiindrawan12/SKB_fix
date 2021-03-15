<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Data Supir</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-supir'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Supir
            </span>
        </a>
    </div>  
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Supir</h6>
    </div>
    <!-- tabel supir -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Supir" width="100%" cellspacing="0">
                <thead>
                    <tr>        
                        <th class="text-center" width="3%" scope="col">ID Supir</th>
                        <th class="text-center" width="13%" scope="col">Nama Supir</th>
                        <th class="text-center" width="10%" scope="col">Kasbon</th>
                        <th width="7%" scope="col">Status</th>
                        <th width="10%" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel supir -->
</div>

<!-- pop up add supir -->
<div class="modal fade mt-5 px-5 py-5" id="popup-supir" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Supir Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_supir")?>" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label for="Supir" class="form-label font-weight-bold">Nama Supir</label>
                            <input autocomplete="off" type="text" class="form-control" id="Supir" name="Supir" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_alamat" class="form-label font-weight-bold">Alamat</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_alamat" name="supir_alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_telp" class="form-label font-weight-bold">Telp./HP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_telp" name="supir_telp" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_ktp" class="form-label font-weight-bold">No.KTP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_ktp" name="supir_ktp" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_sim" class="form-label font-weight-bold">No.SIM</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_sim" name="supir_sim" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_keterangan" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="supir_keterangan" id="supir_keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add supir -->

<!-- pop up update supir -->
<div class="modal fade" id="popup-update-supir" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update data Supir</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_supir")?>" method="POST">
                    <input type="text" name=supir_id id=supir_id hidden>
                    <div class="row">
                        <div class="form-group">
                            <label for="supir_name" class="form-label font-weight-bold">Nama Supir</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_name" name="supir_name" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_alamat_update" class="form-label font-weight-bold">Alamat</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_alamat_update" name="supir_alamat_update" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_telp_update" class="form-label font-weight-bold">Telp./HP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_telp_update" name="supir_telp_update" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_ktp_update" class="form-label font-weight-bold">No.KTP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_ktp_update" name="supir_ktp_update" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_sim_update" class="form-label font-weight-bold">No.SIM</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_sim_update" name="supir_sim_update" required>
                        </div>
                        <div class="form-group">
                            <label for="supir_keterangan_update" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="supir_keterangan_update" id="supir_keterangan_update" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update supir -->

<!-- pop up detail supir -->
<div class="modal fade mt-5 px-5 py-5 " id="popup-detail-supir" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Supir</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm text-justify">
            <div class="">
                <div class="">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Nama</td>
                                <td name="supir_name"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Alamat</td>
                                <td name="supir_alamat"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Telp/HP</td>
                                <td name="supir_telp"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 30%;">Kasbon</td>
                                <td name="supir_kasbon"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">No.KTP</td>
                                <td name="supir_ktp"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">No.SIM</td>
                                <td name="supir_sim"></td>
                            </tr>
                            <tr>
                            <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                                <td name="supir_keterangan"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               
            </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- end pop up detail supir -->
</div>