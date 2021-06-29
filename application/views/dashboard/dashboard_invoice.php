    <div class="info-invoice">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold btn-warning disabled h4 p-3 " style="border-radius:10px; background-color:#ffcc29;">Invoice Jatuh Tempo</h6>
            </div>  
            <div class="card-body row justify-content-md-center small">
                <div class="table-responsive col-md-12 border border-primary rounded p-1">
                    <table class="table table-bordered" id="Table-Invoice-Jatuh-Tempo" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No Invoice</th>
                                <th class="text-center" scope="col">Customer</th>
                                <th class="text-center" scope="col">Tgl Invoice</th>
                                <th class="text-center" scope="col">Tgl Batas Pembayaran</th>
                                <th class="text-center" scope="col">Jatuh Tempo</th>
                                <th class="text-center" scope="col">Status Pembayaran</th>
                                <th class="text-center" scope="col">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="info-jo">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <h6 class="m-0 font-weight-bold btn-facebook disabled h4 p-3 " style="border-radius:10px;  background-color:#91c788;">Job Order Belum Ada Invoice</h6>
            </div>  
            <div class="card-body row justify-content-md-center small">
                <div class="table-responsive col-md-12 border border-primary rounded p-1 small">
                    <table class="table table-bordered" id="Table-JO-Belum-Invoice" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width ="10%" class="text-center" scope="col">No</th>
                                <th width ="10%" class="text-center" scope="col">No JO</th>
                                <th width ="10%" class="text-center" scope="col">Driver</th>
                                <th width ="10%" class="text-center" scope="col">No Pol</th>
                                <th width ="10%" class="text-center" scope="col">Mobil</th>
                                <th width ="17%" class="text-center" scope="col">Customer</th>
                                <th width ="15%" class="text-center" scope="col">Muatan</th>
                                <th width ="15%" class="text-center" scope="col">Asal</th>
                                <th width ="15%" class="text-center" scope="col">Tujuan</th>
                                <th width ="1%" class="text-center" scope="col">Tanggal</th>
                                <th width ="5%" scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
        <!-- Footer -->
        <footer class="sticky-footer bg-dark">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span class="text-light">Copyright &copy; 2021 PT.Sumber Karya Berkah</span>
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
                                                <th class="text-center" scope="col">Keterangan</th>
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
    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/jquery/jquery.mask.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
    <script>
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Invoice-Jatuh-Tempo').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/dashboard/view_invoice_jatuh_tempo') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "invoice_kode",
                        className: 'text-center'
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "tanggal_invoice",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(row["tgl_batas_pembayaran"]);
                        }
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-block btn-sm btn-danger'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>+"+row["batas_pembayaran"]+" hari</a>";
                            return html;
                        }
                    },
                    {
                        "data": "status_bayar",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (data == "Lunas") {
                                    let html = "<span class='btn-sm btn-block btn-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-warning'><i class='fa fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                        }
                    },
                    {
                        "data": "grand_total",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <script> //script datatables job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-JO-Belum-Invoice').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/dashboard/view_JO_no_invoice/') ?>",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "Jo_id",
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name"
                    },
                    {
                        "data": "mobil_no"
                    },
                    {
                        "data": "mobil_jenis"
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "muatan"
                    },
                    {
                        "data": "asal"
                    },
                    {
                        "data": "tujuan"
                    },
                    {
                        "data": "tanggal_surat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_jo/"+data+"/JO')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    $('.btn-detail-rute-paketan').click(function() {
                        let pk = $(this).data('pk');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutepaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                let html = "";
                                for(i=0;i<data.length;i++){
                                    html += "<tr>"+
                                    "<td>"+data[i]["cudtomer"]+"</td>"+
                                    "<td>"+data[i]["dari"]+"</td>"+
                                    "<td>"+data[i]["ke"]+"</td>"+
                                    "<td>"+data[i]["muatan"]+"</td>"+
                                    "</tr>"
                                }
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                    $('.btn-detail-rute-paketan-kosong').click(function() {
                        let pk = $(this).data('pk');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                    let html = "";
                                    html += "<tr>"+
                                    "<td>Rute ke-1</td>"+
                                    "<td>"+data["kosongan_dari"]+"</td>"+
                                    "<td>"+data["kosongan_ke"]+"</td>"+
                                    "<td>Kosongan</td>"+
                                    "</tr>";
                                    html += "<tr>"+
                                    "<td>Rute ke-2</td>"+
                                    "<td>"+data["asal"]+"</td>"+
                                    "<td>"+data["tujuan"]+"</td>"+
                                    "<td>"+data["muatan"]+"</td>"+
                                    "</tr>";
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                    $('.btn-detail-rute-paketan-reguler').click(function() {
                        let pk = $(this).data('pk');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjo') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                    let html = "";
                                    html += "<tr>"+
                                    "<td>Rute ke-1</td>"+
                                    "<td>"+data["asal"]+"</td>"+
                                    "<td>"+data["tujuan"]+"</td>"+
                                    "<td>"+data["muatan"]+"</td>"+
                                    "</tr>";
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                }
            });
        });
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
    <script>
        function change_tanggal(data){
            var data_tanggal = data.split("-");
            var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
            return tanggal;
        }
    </script>
     <!-- cek aktifitas pengguna -->
     <script>
        $(document).ready(function() {
            const idleDurationSecs = 900;
            const redirectUrl = '<?= base_url("index.php/login/logout")?>';
            let idleTimeout;

            const resetIdleTimeout = function() {
                if(idleTimeout){
                    clearTimeout(idleTimeout);
                }
                idleTimeout = setTimeout(() => location.href = redirectUrl, idleDurationSecs * 1000);
            };
            
            // Key events for reset time
            resetIdleTimeout();
            window.onkeypress = resetIdleTimeout;
            window.click = resetIdleTimeout;
            window.onclick = resetIdleTimeout;
            window.onmousemove = resetIdleTimeout;
            window.onscroll = resetIdleTimeout;

        });
    </script>