<div class="container">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Kendaraan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-truck'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Truck Baru
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
                        <th class="text-center" scope="col">Jenis Kendaraan</th>
                        <th class="text-center" scope="col">Maximum Load (Ton)</th>
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
<div class="modal fade mt-5 px-5 py-2" id="popup-truck" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Truck Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_truck")?>" method="POST">
                    <div class="form-group">
                        <label for="mobil_no" class="form-label font-weight-bold">Plat No Mobil</label>
                        <input autocomplete="off" type="text" class="form-control" id="mobil_no" name="mobil_no" required>
                    </div>
                    <div class="form-group">
                        <label for="mobil_jenis" class="form-label font-weight-bold">Jenis Mobil</label>
                        <input autocomplete="off" type="text" class="form-control" id="mobil_jenis" name="mobil_jenis" required>
                    </div>
                    <div class="form-group">
                        <label for="mobil_max_load" class="form-label font-weight-bold">Muatan Maksimal Mobil (Ton)</label>
                        <input autocomplete="off" type="number" class="form-control" id="mobil_max_load" name="mobil_max_load" required>
                    </div>

                    <div class="form-group">
                        <label for="mobil_keterangan" class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="mobil_keterangan" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


<!-- pop up detail kendaraan -->
<div class="modal fade mt-5 px-5 py-5 " id="popup-kendaraan" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
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
                    <tr>
                        <td class="font-weight-bold" style="width: 30%;">Maximum Load (Ton)</td>
                        <td name="mobil_max_load"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                        <td name="mobil_keterangan"></td>
                    </tr>
                   
                </tbody>
            </table>
            </div>
        </div>
    </div>



</div>
<!-- end pop up add kendaraan -->