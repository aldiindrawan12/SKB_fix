<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Rute Kosongan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-kosongan'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Rute Kosongan
            </span>
        </a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rute Kosongan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Kosongan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="3%" scope="col">No</th>
                        <th class="text-center" width="11%" scope="col">Dari</th>
                        <th class="text-center" width="12%" scope="col">Ke</th>
                        <th class="text-center" width="12%" scope="col">Uang Jalan</th>
                        <th class="text-center" width="5%" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add truck -->
<div class="modal fade mt-3 px-3 " id="popup-kosongan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Rute Kosongan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mt-4">
            <?php echo form_open_multipart('form/insert_kosongan'); ?>
                <div class="form-group ">
                    <label for="kosongan_dari" class="form-label font-weight-bold">Dari</label>
                    <input autocomplete="off" type="text" class="form-control" id="kosongan_dari" name="kosongan_dari" required>
                </div>
                <div class="form-group">
                    <label for="kosongan_ke" class="form-label font-weight-bold">Ke</label>
                    <input autocomplete="off" type="text" class="form-control" id="kosongan_ke" name="kosongan_ke" required>
                </div>
                <div class="form-group">
                    <label for="kosongan_uang" class="form-label font-weight-bold">Uang Jalan</label>
                    <input autocomplete="off" type="text" class="form-control" id="kosongan_uang" name="kosongan_uang" required onkeyup="uang(this)">
                </div>
            </div>
            <div class="form-group mt-1 mr-4 ">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
                <button type="reset" class="btn btn-outline-danger mr-3 float-md-right" onclick="reset_form()">Reset</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- end pop up add truck -->

<!-- pop up update truck -->
<div class="modal fade mt-5 px-5 py-2" id="popup-update-kosongan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_kosongan")?>" method="POST">     
                    <input autocomplete="off" type="text" class="form-control" id="kosongan_id_update" name="kosongan_id_update" required hidden>
                    <div class="form-group">
                        <label for="kosongan_dari_update" class="form-label font-weight-bold">Dari</label>
                        <input autocomplete="off" type="text" class="form-control" id="kosongan_dari_update" name="kosongan_dari_update" required>
                    </div>
                    <div class="form-group">
                        <label for="kosongan_ke_update" class="form-label font-weight-bold">Ke</label>
                        <input autocomplete="off" type="text" class="form-control" id="kosongan_ke_update" name="kosongan_ke_update" required>
                    </div>
                    <div class="form-group">
                        <label for="kosongan_uang_update" class="form-label font-weight-bold">Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="kosongan_uang_update" name="kosongan_uang_update" required onkeyup="uang(this)">
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

<script>
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
</script>
