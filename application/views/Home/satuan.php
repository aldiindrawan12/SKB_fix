<div class="container">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Satuan Muatan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-satuan'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Satuan Baru
            </span>
        </a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Satuan Muatan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-satuan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Kode</th>
                        <th class="text-center" scope="col">Nama Satuan</th>
                        <th class="text-center" scope="col">Simbol Singkatan</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($satuan as $value){?>
                    <tr>
                        <td class="text-center"><?= $value["satuan_id"]?></td>
                        <td class="text-center"><?= $value["satuan_name"]?></td>
                        <td class="text-center"><?= $value["satuan_simbol"]?></td>
                        <td class="text-center"><a class='btn btn-light' id='<?= $value["satuan_id"]?>' onclick="delete_satuan(this)"><i class='fas fa-trash-alt'></i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- pop up add truck -->
<div class="modal fade mt-5 px-5 py-5" id="popup-satuan" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Satuan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_satuan")?>" method="POST">
                    <div class="form-group">
                        <label for="satuan_name" class="form-label font-weight-bold">Nama Satuan</label>
                        <input autocomplete="off" type="text" class="form-control" id="satuan_name" name="satuan_name" required>
                    </div>
                    <div class="form-group">
                        <label for="satuan_simbol" class="form-label font-weight-bold">Simbol / Singkatan</label>
                        <input autocomplete="off" type="text" class="form-control" id="satuan_simbol" name="satuan_simbol" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add truck -->

<script>
    function delete_satuan(a){
        var id_satuan = a.id;
        // alert(id_satuan);
        Swal.fire({
            title: 'Hapus Satuan Ini?',
            showDenyButton: true,
            denyButtonText: `Batal`,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('index.php/form/deletesatuan') ?>",
                    dataType: "text",
                    data: {
                        id: id_satuan
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        })
    }
</script>