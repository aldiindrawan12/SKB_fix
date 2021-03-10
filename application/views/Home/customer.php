<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Data Customer</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-customer'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Customer Baru
            </span>
        </a>


    </div> 
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
    </div>
    <!-- tabel data cutomer -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Customer" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="3%" scope="col">ID Customer</th>
                        <th class="text-center" width="20%" scope="col">Nama Customer</th>
                        <th class="text-center" width="5%" scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel data cutomer -->
</div>


<!-- pop up add customer -->
<div class="modal fade mt-5 px-5 py-5" id="popup-customer" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Customer Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_customerMenu")?>" method="POST">
                    <div class="form-group">
                        <label for="Customer" class="form-label font-weight-bold">Nama Customer</label>
                        <input autocomplete="off" type="text" class="form-control" id="Customer" name="Customer" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add customer -->


</div>