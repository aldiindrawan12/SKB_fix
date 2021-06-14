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
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-Seluruh-Invoice').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
  });
 });
 function print_pdf(){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('Table-Seluruh-Invoice-Print').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>