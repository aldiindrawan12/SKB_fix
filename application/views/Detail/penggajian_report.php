<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!-- tampilan detail penggajian supir -->
<div class="container small">
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary col-md-8">Seluruh Data Slip Gaji</h6>
            <form method="POST" action="<?= base_url("index.php/print_berkas/gaji_excel/")?>" id="convert_form" class="col-md-2">
                <input type="hidden" name="file_content" id="file_content">
                <button type="submit" name="convert" id="convert" class="btn btn-primary btn-sm btn-icon-split">
                    <span class="icon text-white-100">  
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Excel</span>
                </button>
            </form>
            <button type="submit" class="btn btn-primary btn-sm btn-icon-split" onclick="print_pdf()">
                <span class="icon text-white-100">  
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Print/PDF</span>
            </button>
        </div>
        <!-- <div class="card-body">
            <table class="w-50">
                <tbody>
                    <tr>
                        <td width="25%">Id Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_id"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_name"]?></td>
                    </tr>
                </tbody>
            </table>
        </div> -->
        <div class="card-body" id="Table-Penggajian-Print">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%" scope="col">No Pembayaran</th>
                            <th class="text-center" width="10%" scope="col">Tgl Slip Gaji</th>
                            <th class="text-center" width="10%" scope="col">Supir</th>
                            <th class="text-center" width="10%" scope="col">Bulan Kerja</th>
                            <th class="text-center" width="10%" scope="col">Total Gaji</th>
                            <th class="text-center" width="10%" scope="col">Sisa Gaji</th>
                            <th class="text-center" width="10%" scope="col">Status</th>
                            <th class="text-center" width="10%" scope="col">Payment</th>
                            <th class="text-center" width="10%" scope="col">Detail</th>
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
<!-- end tampilan detail penggajian supir -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2021 PT.Sumber Karya Berkah</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mt-5 py-5" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar <i class="fa fa-lock"></i></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>

                <div class="modal-body"><i class="fa fa-question-circle"></i> Anda yakin ingin keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url("index.php/login/logout")?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup-ubah-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mt-5 py-5" role="document">
            <div class="modal-content ">
                <div class="modal-header mb-3">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="container mb-3">
                    <form action="<?= base_url('index.php/login/ubah_password')?>" method="POST" onsubmit="return cek_password();">
                        <div class="form-group row">
                            <label for="password_old" class="form-label col">Password Lama</label>
                            <input type="password" id="password_old" name="password_old" required class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label for="password_new" class="form-label col">Password Baru</label>
                            <input type="password" id="password_new" name="password_new" required class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label for="password_fix" class="form-label col">Konfirmasi Password Baru</label>
                            <input type="password" id="password_fix" name="password_fix" required class="form-control col">
                        </div>
                        <div class="form-group mt-1 mr-4 ">
                            <button type="submit" class="btn btn-success float-right" >Simpan</button>
                            <button type="reset" class="btn btn-outline-danger mr-3 float-md-right">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/jquery/jquery.mask.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <!-- data toggle bawah -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.js" integrity="sha512-bAjB1exAvX02w2izu+Oy4J96kEr1WOkG6nRRlCtOSQ0XujDtmAstq5ytbeIxZKuT9G+KzBmNq5d23D6bkGo8Kg==" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url("assets/js/sb-admin-2.min.js")?>"></script>
    <!-- Page level plugins -->
    <script src="<?=base_url("assets/vendor/chart.js/Chart.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/datatables/jquery.dataTables.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js")?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.js')?>"></script>
    
    <!-- cek password -->
    <script>
        function cek_password(){
            password_old = $("#password_old").val();
            password_new = $("#password_new").val();
            password_fix = $("#password_fix").val();
            validasi = "false";
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/login/cek_password/') ?>"+password_old+"/"+password_new+"/"+password_fix,
                dataType: "text",
                async:false,
                success: function(data) { 
                    validasi = data;
                }
            });
            if(validasi!="true"){
                if(validasi=="false lama"){
                    alert("password lama tidak sesuai");
                }else{
                    alert("password baru tidak cocok");
                }
                return false;
            }else{
                return true;
            }
        }
    </script>
    <!-- end cek password -->

    <script> //script datatables
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Penggajian').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/detail/view_laporan_penggajian/')?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [50, 100],
                    [50, 100]
                ],
                "columns": [
                    {
                        "data": "pembayaran_upah_id"
                    },
                    {
                        "data": "pembayaran_upah_tanggal",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return change_tanggal(data);
                        }
                    },
                    {
                        "data":"supir_name"
                    },
                    {
                        "data":"bulan_kerja"
                    },
                    {
                        "data": "pembayaran_upah_nominal",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "pembayaran_upah_nominal",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return "sisa gaji";
                        }
                    },
                    {
                        "data": "pembayaran_upah_status",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            if(data=="Lunas"){
                                html+="<span class='text-success'>"+data+"</span>";
                            }else{
                                html+="<span class='text-danger'>"+data+"</span>";
                            }
                            return html;
                        }
                    },
                    {
                        "data": "pembayaran_upah_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return "payment";
                        }
                    },
                    {
                        "data": "pembayaran_upah_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_penggajian_report_pembayaran/')?>"+row["supir_id"]+"/"+data+"'><i class='fas fa-eye'></i></a>";
                        }
                    },
                ]
            });
        });
    </script>

    <script>
        function change_tanggal(data){
            if(data==""){
                return "";
            }else{
                var data_tanggal = data.split("-");
                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                return tanggal;
            }
        }
    </script>
    <!-- scrip angka rupiah -->
    <script>
            function rupiah(uang){
            var bilangan = uang;
            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // alert(rupiah);
            return rupiah;
        }
    </script>
    <!-- end script angka rupiah -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#convert').click(function() {
                var table_content = '<table>';
                table_content += $("head").html()+$('#Table-Penggajian').html();
                table_content += '</table>';
                $('#file_content').val(table_content);
                $('#convert_form').html();
            });
        });
        function print_pdf(){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById('Table-Penggajian-Print').innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>