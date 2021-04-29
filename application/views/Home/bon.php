<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Seluruh Data Transaksi BON</h1>
            <a href="<?=base_url("index.php/form/bon")?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
                <span class="text">
                Buat Transaksi BON
                </span>
            </a>
    </div> 
    <!-- tabel transaksi bon -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Bon</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Table-Bon" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center" scope="col">ID Transaksi</th>
                            <th width="16%" class="text-center" scope="col">Nama Supir</th>
                            <th width="12%" class="text-center" scope="col">Nominal</th>
                            <th width="16%" class="text-center" scope="col">Tanggal Transaksi</th>
                            <th width="16%" class="text-center"  scope="col">Jenis Transaksi</th>
                            <th width="5%" class="text-center" scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end tabel transaksi bon -->
</div>

<!-- pop up detail bon -->
<div class="modal fade mt-5 px-5 py-5 " id="popup-bon" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Transaksi Bon</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Transaksi ID</td>
                        <td name="id"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Nama Supir</td>
                        <td name="supir"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Jenis Transaksi</td>
                        <td name="jenis"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Nonimal Transaksi</td>
                        <td name="nominal"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Tanggal Transaksi</td>
                        <td name="tanggal"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                        <td name="keterangan"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Operator</td>
                        <td name="operator"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<!-- end pop up detail bon -->
