<div class="container">
    <div class=" py-3 text-center mb-3">
        <h4 class="m-0 font-weight-bold text-dark"><?= $customer["customer_name"]?></h4>
        <input type="text" id="customer-id" value="<?= $customer["customer_id"]?>" hidden>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
         <h5><span class="badge badge-success">Lunas</span></h5>
        
    </div>
    <!-- tabel invoice Lunas-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Table-Invoice-Lunas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No Invoice</th>
                                <th class="text-center" scope="col">Customer</th>
                                <th class="text-center" scope="col">Tgl Invoice</th>
                                <th class="text-center" scope="col">Batas Pembayaran</th>
                                <th class="text-center" scope="col">Status Pembayaran</th>
                                <th class="text-center" scope="col">Grand Total</th>
                                <th class="text-center" scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end tabel invoice Lunas-->
    
</div>

</div>
</div>
    

    <div class="container">
            <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
         
                <h5><span class="badge badge-warning">Belum Lunas</span></h5>
            </div>
            <!-- tabel invoice Belum Lunas-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Table-Invoice-Belum-Lunas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No Invoice</th>
                                <th class="text-center" scope="col">Customer</th>
                                <th class="text-center" scope="col">Tgl Invoice</th>
                                <th class="text-center" scope="col">Batas Pembayaran</th>
                                <th class="text-center" scope="col">Status Pembayaran</th>
                                <th class="text-center" scope="col">Grand Total</th>
                                <th class="text-center" scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
