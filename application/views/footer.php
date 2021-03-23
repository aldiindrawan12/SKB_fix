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
    
    <!-- kendaraan -->
    <script> //script datatables kendaraan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Truck').DataTable({
                language: {
                    searchPlaceholder: "Nomor Polisi"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_truck/') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "mobil_no"
                    },
                    {
                        "data": "mobil_merk"
                    },
                    
                    {
                        "data": "mobil_type"
                    },
                    {
                        "data": "mobil_jenis"
                    },
                    
                    {
                        "data": "mobil_tahun",
                        className: 'text-center'
                    },
                    {
                        "data": "mobil_berlaku",
                        className: 'text-center'
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-detail-truck' href='javascript:void(0)' data-toggle='modal' data-target='#popup-kendaraan' data-pk='"+data+"'><i class='fas fa-eye'></i></a> || "+
                            "<a class='btn btn-light btn-update-truck' href='javascript:void(0)' data-toggle='modal' data-target='#popup-update-truck' data-pk='"+data+"'><i class='fas fa-pen-square'></i></a> || "+
                            "<a class='btn btn-light btn-delete-truck' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-trash-alt'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Kendaraan',
                            text:'Yakin anda akan menghapus data kendaraan ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            denyButtonColor: '#808080',
                            confirmButtonText: 'Hapus',
                            confirmButtonColor: '#FF0000',
                            icon: "warning"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletetruck') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-detail-truck').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/gettruck') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                            // alert(data);
                                $('td[name="mobil_no"]').text(data["mobil_no"]); //set value
                                $('td[name="mobil_jenis"]').text(data["mobil_jenis"]); //set value
                                $('td[name="status_jalan"]').text(data["status_jalan"]); //set value
                                $('td[name="mobil_max_load"]').text(data["mobil_max_load"]); //set value
                                $('td[name="mobil_keterangan"]').text(data["mobil_keterangan"]); //set value
                                $('td[name="mobil_merk"]').text(data["mobil_merk"]); //set value
                                $('td[name="mobil_type"]').text(data["mobil_type"]); //set value
                                $('td[name="mobil_dump"]').text(data["mobil_dump"]); //set value
                                $('td[name="mobil_tahun"]').text(data["mobil_tahun"]); //set value
                                $('td[name="mobil_berlaku"]').text(data["mobil_berlaku"]); //set value
                                $('td[name="mobil_pajak"]').text(data["mobil_pajak"]); //set value
                            }
                        });
                    });                    
                    $('.btn-update-truck').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/gettruck') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#mobil_no_update').val(data["mobil_no"]); //set value
                                $('#mobil_berlaku_update').val(data["mobil_berlaku"]); //set value
                                $('#mobil_pajak_update').val(data["mobil_pajak"]); //set value
                                $('#mobil_keterangan_update').val(data["mobil_keterangan"]); //set value
                            }
                        });
                    });
                },
                
            });
        });
    </script>
    <!-- end kendaraan -->

    <!-- JO -->
    <script> //script datatables job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Job-Order').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_JO/') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.status_JO = $('#status-JO').val();
                    }
                },
                "deferRender": true,
                "paging":false,
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center'
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
                        "data": "tanggal_surat"
                    },
                    {
                        "data": "status",
                        className: 'text-center',
                            render: function(data, type, row) {
                                if (data == "Sampai Tujuan") {
                                    let html = "<span class='btn-sm btn-block btn-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else if(data == "Dalam Perjalanan"){
                                    let html = "<span class='btn-sm btn-block btn-warning'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }else{
                                    let html = "<span class='btn-sm btn-block btn-danger'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
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
                ]
            });
            $("#status-JO").change(function() {
                table.ajax.reload();
                $('#link_cetaklaporanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val());
                $('#link_cetaklaporanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val());
            });
        });
    </script>
    <!-- end JO -->

    <!-- JO -->
    <script> //script datatables laporan job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Job-Order-report').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_JO_report/') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.tanggal = $('#Tanggal').val();
                        data.bulan = $('#Bulan').val();
                        data.tahun = $('#Tahun').val();
                        data.status_JO = $('#status-JO').val();
                    }
                },
                "deferRender": true,
                "paging":false,
                "searching":false,
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center'
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
                        "data": "tanggal_surat"
                    },
                    {
                        "data": "status",
                        className: 'text-center',
                            render: function(data, type, row) {
                                if (data == "Sampai Tujuan") {
                                    let html = "<span class='btn-sm btn-block btn-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-warning'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_jo/"+data+"/report')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
            $("#Tanggal").change(function() {
                // alert($('#Tanggal').val());   
                table.ajax.reload();
                $('#link_cetaklaporanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
                $('#link_cetaklaporanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
            });
            $("#Bulan").change(function() {
                // alert($('#Bulan').val());   
                table.ajax.reload();
                $('#link_cetaklaporanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
                $('#link_cetaklaporanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
            });
            $("#Tahun").change(function() {
                // alert($('#Tahun').val());   
                table.ajax.reload();
                $('#link_cetaklaporanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
                $('#link_cetaklaporanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
            });
            $("#status-JO").change(function() {
                // alert($("#status-JO").val())
                table.ajax.reload();
                $('#link_cetaklaporanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
                $('#link_cetaklaporanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/report');
            });
        });
    </script>
    <!-- end JO -->

    <!-- Uang Jalan -->
    <script> //script datatables laporan Uang Jalan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Uang-Jalan-report').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_JO_report/') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.tanggal = $('#Tanggal').val();
                        data.bulan = $('#Bulan').val();
                        data.tahun = $('#Tahun').val();
                        data.status_JO = $('#status-JO').val();
                    }
                },
                "deferRender": true,
                "paging":false,
                "searching":false,
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center'
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
                        "data": "supir_name"
                    },
                    {
                        "data": "mobil_no"
                    },
                    {
                        "data": "uang_jalan"
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_jo/"+data+"/uang_jalan')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
            $("#Tanggal").change(function() {
                // alert($('#Tanggal').val());   
                table.ajax.reload();
                $('#link_cetaklaporanuangjalanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
                $('#link_cetaklaporanuangjalanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
            });
            $("#Bulan").change(function() {
                // alert($('#Bulan').val());   
                table.ajax.reload();
                $('#link_cetaklaporanuangjalanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
                $('#link_cetaklaporanuangjalanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
            });
            $("#Tahun").change(function() {
                // alert($('#Tahun').val());   
                table.ajax.reload();
                $('#link_cetaklaporanuangjalanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
                $('#link_cetaklaporanuangjalanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
            });
            $("#status-JO").change(function() {
                // alert($("#status-JO").val())
                table.ajax.reload();
                $('#link_cetaklaporanuangjalanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
                $('#link_cetaklaporanuangjalanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val()+'/uangjalan');
            });
        });
    </script>
    <!-- end Uang Jalan -->

    <!-- bon -->
    <script> //script datatables bon
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Bon').DataTable({
                language: {
                    searchPlaceholder: "Nomor Bon/Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_bon/') ?>",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "bon_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name"
                    },
                    {
                        "data": "bon_jenis",
                        "orderable": true,
                            render: function(data, type, row) {
                                if (data == "Pembayaran") {
                                    let html = "<span class='btn-sm btn-block btn btn-outline-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn btn-outline-warning'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }
                    },
                    {
                        "data": "bon_nominal",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "bon_tanggal",
                        className: 'text-center'    
                    },
                    {
                        "data": "bon_id",
                        "orderable": false,
                        className: 'text-center',
                        render: function(data, type, row) {
                        let html = "<a class='btn btn-light btn-detail-bon' href='javascript:void(0)' data-toggle='modal' data-target='#popup-bon' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-detail-bon').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getbon') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('td[name="id"]').text(data["bon_id"]); //set value
                                $('td[name="supir"]').text(data["supir_name"]); //set value
                                $('td[name="jenis"]').text(data["bon_jenis"]); //set value
                                $('td[name="nominal"]').text("Rp."+rupiah(data["bon_nominal"])); //set value
                                $('td[name="tanggal"]').text(data["bon_tanggal"]); //set value
                                $('td[name="keterangan"]').text(data["bon_keterangan"]); //set value
                                // alert(data["supir_id"]+data["supir_name"]+data["bon_id"]+data["bon_jenis"]+data["bon_nominal"]);
                            }
                        });
                    });
                }
            });
        });
    </script>
    <!-- end bon -->

    <!-- Customer -->
    <script> //script datatables customer
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Customer').DataTable({
                language: {
                    searchPlaceholder: "Nama Customer"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Customer/') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    // {
                    //     "data": "customer_id",
                    //     className: 'text-center'
                    // },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "customer_alamat"
                    },
                    {
                        "data": "customer_kontak_person"
                    },
                    {
                        "data": "customer_telp"
                    },
                    {
                        "data": "customer_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_customer/"+data+"')?>'><i class='fas fa-file-invoice-dollar'></i></a> || "+
                            "<a class='btn btn-light btn-detail-customer' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-customer' data-pk='"+data+"'><i class='fas fa-eye'></i></a> || "+
                            "<a class='btn btn-light btn-update-customer' data-toggle='modal' data-target='#popup-update-customer' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a> || "+
                            "<a class='btn btn-light btn-delete-customer' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-customer').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getcustomer') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                // alert(data);
                                $("#customer_id_update").val(data["customer_id"]);
                                $("#customer_name_update").val(data["customer_name"]);
                                $("#customer_telp_update").val(data["customer_telp"]);
                                $("#customer_alamat_update").val(data["customer_alamat"]);
                                $("#customer_kontak_person_update").val(data["customer_kontak_person"]);
                                $("#customer_telp_update").val(data["customer_telp"]);
                                $("#customer_bank_update").val(data["customer_bank"]);
                                $("#customer_rekening_update").val(data["customer_rekening"]);
                                $("#customer_AN_update").val(data["customer_AN"]);
                                $("#customer_keterangan_update").val(data["customer_keterangan"]);
                            }
                        });
                    });
                    $('.btn-detail-customer').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getcustomer') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('td[name="customer_name"]').text(data["customer_name"]); //set value
                                $('td[name="customer_alamat"]').text(data["customer_alamat"]); //set value
                                $('td[name="customer_kontak_person"]').text(data["customer_kontak_person"]); //set value
                                $('td[name="customer_telp"]').text(data["customer_telp"]); //set value
                                $('td[name="customer_bank"]').text(data["customer_bank"]); //set value
                                $('td[name="customer_rekening"]').text(data["customer_rekening"]); //set value
                                $('td[name="customer_AN"]').text(data["customer_AN"]); //set value
                            }
                        });
                    }); 
                    $('.btn-delete-customer').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        Swal.fire({
                            title: 'Hapus Customer',
                            text:'Yakin anda ingin menghapus customer ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletecustomer') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
    </script>
    <!-- end Customer -->   

    <!-- Supir -->
    <script> //script datatables Supir
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Supir').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_kasbon",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "status_jalan",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                if (data == "Jalan") {
                                    let html = "<span class='btn-sm btn-block btn-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-warning'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }

                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-detail-supir' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-supir' data-pk='"+data+"'><i class='fas fa-eye'></i></a> || "+
                            "<a class='btn btn-light btn-update-supir' data-toggle='modal' data-target='#popup-update-supir' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a> || "+
                            "<a class='btn btn-light btn-delete-supir' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            // "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_penggajian/"+data+"')?>'><i class='fas fa-eye'></i></a> || "+
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-supir').click(function() {
                        let pk = $(this).data('pk');
                        $("#supir_id").val(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getsupirname') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#supir_name").val(data["supir_name"]);
                                $("#supir_alamat_update").val(data["supir_alamat"]);
                                $("#supir_telp_update").val(data["supir_telp"]);
                                $("#supir_ktp_update").val(data["supir_ktp"]);
                                $("#supir_sim_update").val(data["supir_sim"]);
                                $("#supir_keterangan_update").val(data["supir_keterangan"]);
                            }
                        });
                    });
                    $('.btn-detail-supir').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data supir
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getsupir') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                            // alert(data);
                                $('td[name="supir_name"]').text(data["supir_name"]); //set value
                                $('td[name="supir_alamat"]').text(data["supir_alamat"]); //set value
                                $('td[name="supir_telp"]').text(data["supir_telp"]); //set value
                                $('td[name="supir_ktp"]').text(data["supir_ktp"]); //set value
                                $('td[name="supir_sim"]').text(data["supir_sim"]); //set value
                                $('td[name="supir_kasbon"]').text("Rp."+rupiah(data["supir_kasbon"])); //set value
                                $('td[name="supir_keterangan"]').text(data["supir_keterangan"]); //set value
                            }
                        });
                    }); 
                    $('.btn-delete-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Supir',
                            icon: "warning",
                            text: 'Yakin anda ingin menghapus supir ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletesupir') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
    </script>
    <!-- End Supir -->

    <!-- Gaji Supir -->
    <script> //script datatables Gaji Supir
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Supir-Gaji').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_kasbon",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "status_jalan",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                if (data == "Jalan") {
                                    let html = "<span class='btn-sm btn-block btn-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-warning'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }

                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_penggajian/"+data+"')?>'><i class='fas fa-dollar-sign'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Gaji Supir -->

     <!-- Report Gaji Supir -->
     <script> //script datatables Report Gaji Supir
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Supir-Report').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_kasbon",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "status_jalan",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                if (data == "Jalan") {
                                    let html = "<span class='btn-sm btn-block btn-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-warning'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }

                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_penggajian_report/"+data+"')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Report Gaji Supir -->

    <!-- invoice -->
    <script> //script datatables Invoice
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Invoice').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Invoice') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.status_bayar = $('#status-invoice').val();
                    }
                },
                "deferRender": true,
                "paging":false,
                // "aLengthMenu": [
                //     [5, 10, 30, 50, 100],
                //     [5, 10, 30, 50, 100]
                // ],
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
                        className: 'text-center'
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center'
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
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_invoice/"+data+"/Invoice')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
            $("#status-invoice").change(function() {
                table.ajax.reload();
            });
        });
    </script>
    <!-- End Invoice -->

    <!-- invoice Belum Lunas-->
    <script>
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Invoice-Belum-Lunas').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_invoice_belum_lunas') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer_id = <?= $customer["customer_id"]?>;
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
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
                        className: 'text-center'
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center'
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
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_invoice/"+data+"/Customer')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Invoice Belum Lunas-->

    <!-- invoice Lunas-->
    <script>
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Invoice-Lunas').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_invoice_lunas') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer_id = <?= $customer["customer_id"]?>;
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
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
                        className: 'text-center'
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center'
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
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_invoice/"+data+"/Customer')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Invoice Lunas-->

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

     <!-- Akun -->
     <script> //script datatables customer
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Akun').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_akun/') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 30, 50, 100],
                    [5, 10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "akun_id",
                        className: 'text-center'
                    },
                    {
                        "data": "akun_name"
                    },
                    {
                        "data": "akun_role",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            if (data == "Super User") {
                                    let html = "<span class='btn-sm btn-block btn-dark'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-light'>" + data + "</span>";
                                    return html;
                                }
                        }
                    },
                    {   "data": "akun_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-update-akun' data-toggle='modal' data-target='#popup-update-akun' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a> || "+
                            "<a class='btn btn-light btn-update-akun' href='<?= base_url('index.php/form/konfigurasi/"+data+"')?>' data-pk="+data+"><i class='fas fa-user-cog'></i></a> || "+
                            "<a class='btn btn-light btn-delete-akun' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-akun').click(function() {
                        let pk = $(this).data('pk');
                        $("#akun_id").val(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getakunbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#akun_name").val(data["akun_name"]);
                                $("#username_update").val(data["username"]);
                                $("#password_update").val(data["password"]);
                                $("#role_update").val(data["akun_role"]);
                            }
                        });
                    });
                    $('.btn-delete-akun').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Akun',
                            text:'Yakin anda akan menghapus akun ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deleteakun') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
    </script>
    <!-- end Akun --> 
    
    <!-- rute -->
    <script> //script datatables rute
        $(document).ready(function() {
            var table = null;
            table = $('#Table-rute').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_rute')?>",
                    "type": "POST"
                },
                "deferRender": true,
                "paging":false,
                // "aLengthMenu": [
                //     [5, 10, 30, 50, 100],
                //     [5, 10, 30, 50, 100]
                // ],
                "columns": [
                    {
                        "data": "customer_name",
                        className: 'text-center'
                    },
                    {
                        "data": "rute_dari",
                        className: 'text-center'
                    },
                    {
                        "data": "rute_ke",
                        className: 'text-center'
                    },
                    {
                        "data": "rute_muatan",
                        className: 'text-center'
                    },
                    {
                        "data": "rute_uj_engkel",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "rute_uj_tronton",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "rute_tagihan",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "rute_gaji_engkel",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "rute_gaji_tronton",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "rute_gaji_engkel_rumusan",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-update-rute' data-toggle='modal' data-target='#popup-update-rute' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                            "<a class='btn btn-light btn-delete-rute' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-rute').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutebyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                // alert(data["customer_name"]);
                                $("#rute_id_update").val(data["rute_id"]);
                                $("#customer_id_update").val(data["customer_id"]);
                                $("#customer_name_update").val(data["customer_name"]);
                                $("#rute_dari_update").val(data["rute_dari"]);
                                $("#rute_ke_update").val(data["rute_ke"]);
                                $("#rute_muatan_update").val(data["rute_muatan"]);
                                $("#rute_uj_engkel_update").val(rupiah(data["rute_uj_engkel"]));
                                $("#rute_uj_tronton_update").val(rupiah(data["rute_uj_tronton"]));
                                $("#rute_tagihan_update").val(rupiah(data["rute_tagihan"]));
                                $("#rute_gaji_engkel_update").val(rupiah(data["rute_gaji_engkel"]));
                                $("#rute_gaji_tronton_update").val(rupiah(data["rute_gaji_tronton"]));
                                $("#rute_gaji_engkel_rumusan_update").val(rupiah(data["rute_gaji_engkel_rumusan"]));
                                $("#rute_gaji_tronton_rumusan_update").val(rupiah(data["rute_gaji_tronton_rumusan"]));
                                $("#rute_tonase_update").val(rupiah(data["rute_tonase"]));
                            }
                        });
                    });
                    $('.btn-delete-rute').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        Swal.fire({
                            title: 'Hapus Rute dan Muatan',
                            text:'Yakin anda ingin menghapus Rute dan Muatan ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deleterute') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
    </script>
    <!-- End rute -->

    <!-- script alert-alert -->
    <script>
        $(document).ready(function() {
            var login = '<?= $this->session->flashdata('status-login'); ?>';
            var akun = '<?= $this->session->flashdata('status-add-akun'); ?>';
            var update_akun = '<?= $this->session->flashdata('status-update-akun'); ?>';
            var delete_akun = '<?= $this->session->flashdata('status-delete-akun'); ?>';
            var supir = '<?= $this->session->flashdata('status-add-supir'); ?>';
            var update_supir = '<?= $this->session->flashdata('status-update-supir'); ?>';
            var delete_supir = '<?= $this->session->flashdata('status-delete-supir'); ?>';
            var kendaraan = '<?= $this->session->flashdata('status-add-kendaraan'); ?>';
            var update_truck = '<?= $this->session->flashdata('status-update-truck'); ?>';
            var delete_kendaraan = '<?= $this->session->flashdata('status-delete-kendaraan'); ?>';
            var customer = '<?= $this->session->flashdata('status-add-customer'); ?>';
            var delete_customer = '<?= $this->session->flashdata('status-delete-customer'); ?>';
            var update_customer = '<?= $this->session->flashdata('status-update-customer'); ?>';
            var satuan = '<?= $this->session->flashdata('status-add-satuan'); ?>';
            var update_rute = '<?= $this->session->flashdata('status-update-satuan'); ?>';
            var delete_satuan = '<?= $this->session->flashdata('status-delete-satuan'); ?>';
            if(login == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Login",
                        icon: "success",
                        text: "Selamat Datang",
                        type: "success",
                        timer: 1500
                    });
            }
            if(akun == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan akun baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan customer baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_akun == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data akun",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_truck == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data kendaraan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data customer",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_akun == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus akun",
                        type: "error",
                        timer: 2000
                    });
            }
            if(supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan data supir",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Update data supir",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus data supir",
                        type: "error",
                        timer: 2000
                    });
            }
            if(kendaraan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambah data kendaraan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_kendaraan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus data kendaraan",
                        type: "error",
                        timer: 2000
                    });
            }
            if(satuan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan data rute dan muatan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_rute == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data rute dan satuan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_satuan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus data rute dan muatan",
                        type: "error",
                        timer: 2000
                    });
            }
            if(delete_customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus data customer",
                        type: "error",
                        timer: 2000
                    });
            }
        });
    </script>
    <!-- end script alert -->
    <script type="text/javascript">
        $(function(){
            $("#mobil_berlaku").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
            $("#mobil_pajak").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
            $("#invoice_tgl").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
            //proses tanggal
            var date = new Date();
            if(date.getMonth()<10){
                $("#invoice_tgl").val(date.getFullYear()+"-0"+date.getMonth()+"-"+date.getDate());
            }else{
                $("#invoice_tgl").val(date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate());
            }
        });
    </script>
    <script>
        function tanggal_berlaku(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 500
            });
            $("#mobil_berlaku_update").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        }
        function tanggal_pajak(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 500
            });
            $("#mobil_pajak_update").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        }
    </script>
</body>

</html>