<div class="container">
    <div class="text-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Data Nota Kasbon</h1>
            <!-- <a href="<?=base_url("index.php/form/bon")?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
                <span class="text">
                Buat Transaksi BON
                </span>
            </a> -->
    </div> 
    <!-- tabel transaksi bon -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Bon</h6>
            <form method="POST" action="<?= base_url("index.php/print_berkas/bon_excel/")?>" id="convert_form">
                <input type="hidden" name="file_content" id="file_content">
                <button type="submit" name="convert" id="convert" class="btn btn-primary">
                    <span class="icon text-white-100">  
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Excel</span>
                </button>
            </form>
            <button type="submit" class="btn btn-primary" onclick="print_pdf()">
                <span class="icon text-white-100">  
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Print/PDF</span>
            </button>
        </div>
        <div class="card-body" id="Table-Bon-Print">
            <div class="table-responsive">
                <table border="1" class="table table-bordered" id="Table-Bon" width="100%" cellspacing="0">
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
            <a class='btn btn-primary btn-sm ' id="link_print_bon">
                <span>Cetak Nota Kas Bon</span>
            </a>
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
                        <td class="font-weight-bold" style="width: 20%;">Terbilang</td>
                        <td name="terbilang"></td>
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
                        <td class="font-weight-bold" style="width: 20%;">No Slip Gaji</td>
                        <td name="pembayaran_upah_id"></td>
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

<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
 $(document).ready(function() {
  $('#convert').click(function() {
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-Bon').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
  });
 });
 function print_pdf(){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('Table-Bon-Print').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>
