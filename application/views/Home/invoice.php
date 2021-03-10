<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Seluruh Data Invoice</h1>
    </div> 
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Inovice</h6>
    </div>
    <!-- tabel invoice -->
    <div class="card-body">
        <div class="float-right mt-2 mb-2">
            <select name="status-invoice" id="status-invoice" class="form-control">
                <option value="x">Semua Status</option>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Lunas">Lunas</option>
            </select>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Invoice" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="13%" scope="col">No Invoice</th>
                        <!-- <th class="text-center" width="10%" scope="col">ID JO</th> -->
                        <th class="text-center" width="25%" scope="col">Customer</th>
                        <th class="text-center" width="12%" scope="col">Tgl Invoice</th>
                        <th class="text-center" width="20%" scope="col">Batas Pembayaran</th>
                        <th class="text-center" width="25%" scope="col">Status Pembayaran</th>
                        <th class="text-center" scope="col">Grand Total</th>
                        <th class="text-center" scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel invoice -->
</div>

</div>