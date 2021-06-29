<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary col-md-8">Seluruh Data Invoice</h6>
            <form method="POST" action="<?= base_url("index.php/print_berkas/invoice_excel/")?>" id="convert_form" class="col-md-2">
                <input type="hidden" name="file_content" id="file_content">
                <button type="submit" name="convert" id="convert" class="btn btn-primary btn-sm btn-icon-split">
                    <span class="icon text-white-100">  
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Excel</span>
                </button>
            </form>
            <a type="submit" class="btn btn-primary btn-sm btn-icon-split" onclick="print_pdf()">
                <span class="icon text-white-100">  
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Print/PDF</span>
            </a>
        </div>
            <div class="conatiner w-50 m-auto">
                <div class="mb-2 mt-3 form-group row">
                    <label for="Status" class="form-label font-weight-bold col-md-3">Status</label>
                    <select name="Status" id="Status" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Status</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label for="Tanggal_Top" class="form-label font-weight-bold col-md-3">Due Date</label>
                    <input autocomplete="off" type="text" class="form-control col-md-9" id="Tanggal_Top" name="Tanggal_Top" onclick="tanggal_berlaku(this)">
                </div>
                <div class="mb-2 form-group row">
                    <label for="Tanggal" class="form-label font-weight-bold col-md-3">Tanggal Invoice</label>
                    <input autocomplete="off" type="text" class="form-control col-md-4 mr-4" id="Tanggal1" name="Tanggal1" onclick="tanggal_berlaku(this)">
                    <input autocomplete="off" type="text" class="form-control col-md-4" id="Tanggal2" name="Tanggal2" onclick="tanggal_berlaku(this)">
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Customer">Customer</label>
                    <select name="Customer" value="DESC" id="Customer" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                        <?php foreach($customer as $value){?>
                            <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label for="No_Invoice" class="form-label font-weight-bold col-md-4">No Invoice</label>
                    <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Invoice1" name="No_Invoice1" value="x">
                    <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Invoice2" name="No_Invoice2" value="SKB" readonly>
                    <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Invoice3" name="No_Invoice3" value="x">
                    <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Invoice4" name="No_Invoice4" value="x">
                </div>
                <div class="mb-2 mt-3 form-group row">
                    <label for="Ppn" class="form-label font-weight-bold col-md-3">PPN</label>
                    <select name="Ppn" id="Ppn" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">PPN</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="mb-2 form-group text-center">
                    <button class="btn btn-primary" id="btn-cari">Cari</button>
                    <button class="btn btn-danger" onclick="reset_form()">Reset</button>
                </div>
            </div>
            <hr>
            <div class="container">
                <span>Total Data Invoice Yang Ditemukan : </span><span id="ditemukan"><?= count($invoice)?></span><br>
                <span>Total Invoice Belum Dibayar : </span>Rp.<span id="tagihan"><?= number_format($tagihan,2,",",".")?></span>
            </div>
            <hr>
        <div class="container small" id="Table-Seluruh-Invoice-Print">
            <div class="card shadow mb-4 mt-3">
                <!-- tabel Seluruh invoice-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="Table-Seluruh-Invoice" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">No Invoice</th>
                                    <th class="text-center" scope="col">Tgl Invoice</th>
                                    <th class="text-center" scope="col">Customer</th>
                                    <th class="text-center" scope="col">Total Tagihan</th>
                                    <th class="text-center" scope="col">Sisa Tagihan</th>
                                    <th class="text-center" scope="col">Batas Pembayaran</th>
                                    <th class="text-center" scope="col">Status Pembayaran</th>
                                    <th class="text-center" scope="col">Payment</th>
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
    </div>
</div>
    <!-- tabel data cutomer -->
    <!-- <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Invoice-Customer" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Nama Customer</th>
                        <th class="text-center" scope="col">Alamat</th>
                        <th class="text-center" scope="col">Contact Person</th>
                        <th class="text-center" scope="col">Telp./HP</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div> -->
    <!-- end tabel data cutomer -->
    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
 $(document).ready(function() {
  $('#convert').click(function() {
    var tabel = document.getElementById("Table-Seluruh-Invoice").rows;
    var bacabaris = tabel.length;
    for(var i=0;i<bacabaris;i++){
        tabel[i].deleteCell(-1);
        tabel[i].deleteCell(-1);
    }      
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-Seluruh-Invoice').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
  });
 });
 function print_pdf(){
    var tabel = document.getElementById("Table-Seluruh-Invoice").rows;
    var bacabaris = tabel.length;
    for(var i=0;i<bacabaris;i++){
        tabel[i].deleteCell(-1);
        tabel[i].deleteCell(-1);
    }
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('Table-Seluruh-Invoice-Print').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>
<script>
    function reset_form(){
        location.reload();
    }
</script>