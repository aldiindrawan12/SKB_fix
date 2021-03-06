<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Seluruh Data Job Order</h1>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <span class="icon text-white-100">
                    <i class="fas fa-plus"></i> 
                </span>
                Buat Job Order
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?=base_url("index.php/form/joborder")?>">Reguler</a>
                <a class="dropdown-item" href="<?=base_url("index.php/form/joborderpaketan")?>">Paketan</a>
            </div>
        </div>
    </div> 
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Job Order(JO)</h6>
    </div>
    <!-- tabel JO -->
    <div class="card-body">
        <div class="float-right mb-2 ">
            <select name="status-JO" id="status-JO" class="form-control">
                <option class="" value="x">Semua Status</option>
                <option value="Dibatalkan">Dibatalkan</option>
                <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                <option value="Sampai Tujuan">Sampai Tujuan</option>
            </select>
        </div>
        <div class="table-responsive thead-dark">
            <table class="table table-bordered  " id="Table-Job-Order" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width ="10%" class="text-center" scope="col">No</th>
                        <th width ="10%" class="text-center" scope="col">No JO</th>
                        <th width ="17%" class="text-center" scope="col">Customer</th>
                        <th width ="17%" class="text-center" scope="col">Tipe JO</th>
                        <th width ="15%" class="text-center" scope="col">Rute dan Muatan</th>
                        <th width ="1%" class="text-center" scope="col">Tanggal</th>
                        <th width ="25%" scope="col">Status</th>
                        <th width ="5%" scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel JO -->
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