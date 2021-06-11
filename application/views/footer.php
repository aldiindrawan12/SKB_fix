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

    <!-- kendaraan -->
    <script> //script datatables kendaraan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Truck').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [5, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_truck/') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "mobil_no",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "mobil_no",
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
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            tambah = "";
                            edit = "";
                            hapus = "";
                            if(data=="ACC"){
                                tambah = "<a class='btn btn-success rounded-pill btn-sm'>Tambah <i class='fas fa-check'></i></a>";
                            }else{
                                tambah = "<a class='btn btn-danger rounded-pill btn-sm'>Tambah <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_edit']=="ACC"){
                                edit = "<a class='btn btn-success rounded-pill btn-sm'>Edit <i class='fas fa-check'></i></a>";
                            }else{
                                edit = "<a class='btn btn-danger rounded-pill btn-sm'>Edit <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_delete']=="ACC"){
                                hapus = "<a class='btn btn-success rounded-pill btn-sm'>Hapus <i class='fas fa-check'></i></a>";
                            }else{
                                hapus = "<a class='btn btn-danger rounded-pill btn-sm'>Hapus <i class='fas fa-exclamation'></i></a>";
                            }
                            let html = "<span class='small'>"+tambah+"<br>"+edit+"<br>"+hapus+"</span>";
                            return html;
                        }
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            html += "<a class='btn btn-light btn-detail-truck' href='javascript:void(0)' data-toggle='modal' data-target='#popup-kendaraan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>"
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-truck' href='javascript:void(0)' data-toggle='modal' data-target='#popup-update-truck' data-pk='"+data+"'><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-truck' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-trash-alt'></i></a>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-truck' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-truck' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-truck'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-truck' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
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
                                $('td[name="mobil_no_rangka"]').text(data["mobil_no_rangka"]); //set value
                                $('td[name="mobil_no_mesin"]').text(data["mobil_no_mesin"]); //set value
                                $('td[name="mobil_bpkb"]').text(data["mobil_bpkb"]); //set value
                                $('td[name="mobil_usaha"]').text(data["mobil_usaha"]); //set value
                                $('td[name="mobil_berlaku_usaha"]').text(change_tanggal(data["mobil_berlaku_usaha"])); //set value
                                $('td[name="mobil_jenis"]').text(data["mobil_jenis"]); //set value
                                $('td[name="status_jalan"]').text(data["status_jalan"]); //set value
                                $('td[name="mobil_max_load"]').text(data["mobil_max_load"]); //set value
                                $('td[name="mobil_keterangan"]').text(data["mobil_keterangan"]); //set value
                                $('td[name="mobil_merk"]').text(data["mobil_merk"]); //set value
                                $('td[name="mobil_type"]').text(data["mobil_type"]); //set value
                                $('td[name="mobil_dump"]').text(data["mobil_dump"]); //set value
                                $('td[name="mobil_tahun"]').text(data["mobil_tahun"]); //set value
                                $('td[name="mobil_berlaku"]').text(change_tanggal(data["mobil_berlaku"])); //set value
                                $('td[name="mobil_pajak"]').text(change_tanggal(data["mobil_pajak"])); //set value
                                $('#file_foto_detail').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data["file_foto"]);
                                $('#file_stnk_detail').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data["file_stnk"]);
                                $('td[name="mobil_stnk"]').text(data["mobil_stnk"]); //set value
                                $('td[name="mobil_berlaku_kir"]').text(change_tanggal(data["mobil_berlaku_kir"])); //set value
                                $('td[name="mobil_kir"]').text(data["mobil_kir"]); //set value
                                $('td[name="mobil_berlaku_ijin_bongkar"]').text(change_tanggal(data["mobil_berlaku_ijin_bongkar"])); //set value
                                $('td[name="mobil_ijin_bongkar"]').text(data["mobil_ijin_bongkar"]); //set value

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
                                $('#mobil_no_rangka_update').val(data["mobil_no_rangka"]); //set value
                                $('#mobil_no_mesin_update').val(data["mobil_no_mesin"]); //set value
                                $('#mobil_merk_update').val(data["mobil_merk"]); //set value
                                $('#mobil_type_update').val(data["mobil_type"]); //set value
                                $('#mobil_jenis_update').val(data["mobil_jenis"]); //set value
                                $('#mobil_dump_update').val(data["mobil_dump"]); //set value
                                $('#mobil_tahun_update').val(data["mobil_tahun"]); //set value
                                $('#mobil_bpkb_update').val(data["mobil_bpkb"]); //set value
                                $('#mobil_usaha_update').val(data["mobil_usaha"]); //set value
                                $('#mobil_berlaku_usaha_update').val(change_tanggal(data["mobil_berlaku_usaha"])); //set value

                                $('#mobil_stnk_update').val(data["mobil_stnk"]); //set value
                                $('#mobil_berlaku_update').val(change_tanggal(data["mobil_berlaku"])); //set value
                                $('#mobil_pajak_update').val(change_tanggal(data["mobil_pajak"])); //set value
                                $('#mobil_kir_update').val(data["mobil_kir"]); //set value
                                $('#mobil_ijin_bongkar_update').val(data["mobil_ijin_bongkar"]); //set value
                                $('#mobil_berlaku_kir_update').val(change_tanggal(data["mobil_berlaku_kir"])); //set value
                                $('#mobil_berlaku_ijin_bongkar_update').val(change_tanggal(data["mobil_berlaku_ijin_bongkar"])); //set value
                                $('#mobil_keterangan_update').val(data["mobil_keterangan"]); //set value
                            }
                        });
                    });
                    $('.btn-acc-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Kendaraan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Kendaraan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acctruck/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acctruck/Ditolak') ?>",
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
                    $('.btn-acc-edit-truck').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/gettruck') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_mobil"])
                                $('td[name="mobil_no_edit"]').text(data["mobil_no"]); //set value
                                $('td[name="mobil_no_rangka_edit"]').text(data_temp["mobil_no_rangka"]); //set value
                                $('td[name="mobil_no_mesin_edit"]').text(data_temp["mobil_no_mesin"]); //set value
                                $('td[name="mobil_bpkb_edit"]').text(data_temp["mobil_bpkb"]); //set value
                                $('td[name="mobil_usaha_edit"]').text(data_temp["mobil_usaha"]); //set value
                                $('td[name="mobil_berlaku_usaha_edit"]').text(change_tanggal(data_temp["mobil_berlaku_usaha"])); //set value
                                $('td[name="mobil_jenis_edit"]').text(data["mobil_jenis"]); //set value
                                $('td[name="status_jalan_edit"]').text(data["status_jalan"]); //set value
                                $('td[name="mobil_max_load_edit"]').text(data["mobil_max_load"]); //set value
                                $('td[name="mobil_keterangan_edit"]').text(data_temp["mobil_keterangan"]); //set value
                                $('td[name="mobil_merk_edit"]').text(data["mobil_merk"]); //set value
                                $('td[name="mobil_type_edit"]').text(data["mobil_type"]); //set value
                                $('td[name="mobil_dump_edit"]').text(data["mobil_dump"]); //set value
                                $('td[name="mobil_tahun_edit"]').text(data["mobil_tahun"]); //set value
                                $('td[name="mobil_berlaku_edit"]').text(change_tanggal(data_temp["mobil_berlaku"])); //set value
                                $('td[name="mobil_pajak_edit"]').text(change_tanggal(data_temp["mobil_pajak"])); //set value
                                $('#file_foto_edit').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data_temp["file_foto"]);
                                $('#file_stnk_edit').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data_temp["file_stnk"]);
                                $('td[name="mobil_stnk_edit"]').text(data_temp["mobil_stnk"]); //set value
                                $('td[name="mobil_berlaku_kir_edit"]').text(change_tanggal(data_temp["mobil_berlaku_kir"])); //set value
                                $('td[name="mobil_kir_edit"]').text(data_temp["mobil_kir"]); //set value
                                $('td[name="mobil_berlaku_ijin_bongkar_edit"]').text(change_tanggal(data_temp["mobil_berlaku_ijin_bongkar"])); //set value
                                $('td[name="mobil_ijin_bongkar_edit"]').text(data_temp["mobil_ijin_bongkar"]); //set value
                                mobil_no = data["mobil_no"];
                                $('.ACC').attr('id',mobil_no);
                                $('.Tolak').attr('id',mobil_no);
                            }
                        });
                    });
                    $('.btn-acc-delete-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Kendaraan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Kendaraan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletetruck/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletetruck/Ditolak') ?>",
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
                },
                
            });
        });
        function acc_edit_truck(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/accedittruck/ACC') ?>",
                dataType: "text",
                data: {
                    id: id.id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_truck(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/accedittruck/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id.id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- end kendaraan -->

    <!-- merk -->
     <script> //script datatables merk
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Merk').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_merk/viewmerk') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "merk_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "merk_nama"
                    },
                    
                    {
                        "data": "merk_type"
                    },
                    {
                        "data": "merk_jenis"
                    },
                    
                    {
                        "data": "merk_dump",
                        className: 'text-center'
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            tambah = "";
                            edit = "";
                            hapus = "";
                            if(data=="ACC"){
                                tambah = "<a class='btn btn-success rounded-pill btn-sm'>Tambah <i class='fas fa-check'></i></a>";
                            }else{
                                tambah = "<a class='btn btn-danger rounded-pill btn-sm'>Tambah <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_edit']=="ACC"){
                                edit = "<a class='btn btn-success rounded-pill btn-sm'>Edit <i class='fas fa-check'></i></a>";
                            }else{
                                edit = "<a class='btn btn-danger rounded-pill btn-sm'>Edit <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_delete']=="ACC"){
                                hapus = "<a class='btn btn-success rounded-pill btn-sm'>Hapus <i class='fas fa-check'></i></a>";
                            }else{
                                hapus = "<a class='btn btn-danger rounded-pill btn-sm'>Hapus <i class='fas fa-exclamation'></i></a>";
                            }
                            let html = "<span class='small'>"+tambah+"<br>"+edit+"<br>"+hapus+"</span>";
                            return html;
                        }
                    },
                    {   
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html +="<a class='btn btn-light btn-update-merk' href='javascript:void(0)' data-toggle='modal' data-target='#popup-update-merk' data-pk='"+data+"'><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-merk' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-trash-alt'></i></a>";
                            }
                            return html;
                        }
                    },
                    {
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-merk' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-merk' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-merk'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-merk' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Merk',
                            text:'Yakin anda akan menghapus data Merk ini?',
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
                                    url: "<?php echo base_url('index.php/form/deletemerk') ?>",
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
                    $('.btn-update-merk').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#merk_id_update').val(data["merk_id"]); //set value
                                $('#merk_nama_update').val(data["merk_nama"]); //set value
                                $('#merk_type_update').val(data["merk_type"]); //set value
                                $('#merk_jenis_update').val(data["merk_jenis"]); //set value
                                $('#merk_dump_update').val(data["merk_dump"]); //set value
                            }
                        });
                    });
                    $('.btn-acc-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Merk',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Merk ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accmerk/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accmerk/Ditolak') ?>",
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
                    $('.btn-acc-edit-merk').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_merk"]);
                                $('#merk_nama_edit').val(data_temp["merk_nama"]); //set value
                                $('#merk_type_edit').val(data_temp["merk_type"]); //set value
                                $('#merk_jenis_edit').val(data_temp["merk_jenis"]); //set value
                                $('#merk_dump_edit').val(data_temp["merk_dump"]); //set value
                                $('#ACC').attr('onclick','acc_edit_merk('+data["merk_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_merk('+data["merk_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Merk',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Merk ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletemerk/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletemerk/Ditolak') ?>",
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
                },
                
            });
        });
        function acc_edit_merk(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditmerk/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_merk(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditmerk/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
     </script>
    <!-- end merk -->

    <!-- pilih merk -->
    <script> //script datatables merk
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Pilih-Merk').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_merk/addtruck') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "merk_id",
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "merk_nama"
                    },
                    
                    {
                        "data": "merk_type"
                    },
                    {
                        "data": "merk_jenis"
                    },
                    
                    {
                        "data": "merk_dump"
                    },
                    {
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-light btn-pilih-merk' href='javascript:void(0)' data-pk='"+data+"'>Pilih <i class='fas fa-check-circle'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-pilih-merk').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#merk_id').val(data["merk_id"]); //set value
                                $('#mobil_type').val(data["merk_type"]); //set value
                                $('#mobil_merk').val(data["merk_nama"]); //set value
                                $('#mobil_jenis').val(data["merk_jenis"]); //set value
                                $('#mobil_dump').val(data["merk_dump"]); //set value
                            }
                        });
                    });
                },
                
            });
        });
    </script>
    <!-- end pilih merk -->

    <!-- JO -->
    <script> //script datatables job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Job-Order').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_JO/') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.status_JO = $('#status-JO').val();
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    // {
                    //     "data": "Jo_id",
                    //     render: function(data, type, row) {
                    //         let html = row["no"];
                    //         return html;
                    //     }
                    // },
                    {
                        "data": "Jo_id",
                        className: 'text-center'
                    },
                    {
                        "data": "tanggal_surat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "supir_name",
                        className: 'text-center'
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center'
                    },
                    {
                        "data": "mobil_jenis",
                        className: 'text-center'
                    },
                    {
                        "data": "customer_name",
                        className: 'text-center'
                    },
                    {
                        "data": "muatan",
                    },
                    {
                        "data": "asal",
                    },
                    {
                        "data": "tujuan",
                    },
                    {
                        "data": "uang_total",
                        render: function(data, type, row) {
                            return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "sisa_uj",
                        render: function(data, type, row) {
                            return "Rp."+rupiah(data);
                        }
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
                                    "<td>"+data[i]["customer"]+"</td>"+
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
                },
            });
            $("#status-JO").change(function() {
                table.ajax.reload();
                $('#link_cetaklaporanpdf').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanpdf/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val());
                $('#link_cetaklaporanexcel').attr('href','<?=base_url("index.php/print_berkas/cetaklaporanexcel/")?>'+$('#Tanggal').val()+'/'+$('#Bulan').val()+'/'+$('#Tahun').val()+'/'+$('#status-JO').val());
            });
        });
    </script>
    <!-- end JO -->

    <!-- konfirmasi JO -->
    <script> //script datatables konfirmasi job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Konfirmasi-Job-Order').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_konfirmasi_JO/') ?>",
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
                        className: 'text-center'
                    },
                    {
                        "data": "customer_name",
                        className: 'text-center'
                    },
                    {
                        "data": "muatan",
                    },
                    {
                        "data": "asal",
                    },
                    {
                        "data": "tujuan",
                    },
                    {
                        "data": "tanggal_surat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "status",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                    let html = "<a class='btn btn-block btn-sm btn-outline-warning btn-update-jo' data-pk='"+row['Jo_id']+"' data-toggle='modal' data-target='#update_jo' ><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</a>";
                                    return html;
                            }
                    },
                ],
                drawCallback: function() {
                    $('.btn-update-jo').click(function() {
                        let pk = $(this).data('pk');
                        $('#jo_id').val(pk); //set value
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjo') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#form_update_jo").attr('action','<?php echo base_url("index.php/form/update_jo_status/")?>'+data['supir_id']+'/'+data['mobil_no'])
                            }
                        });
                    });
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
                                    "<td>"+data[i]["customer"]+"</td>"+
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
                },
            });
        });
    </script>
    <!-- end konfirmasi JO -->

    <!-- report JO -->
    <script> //script datatables laporan report job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Job-Order-report').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
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
                        "data": "paketan_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            if(data!=0){
                                let html = "<a class='btn btn-light btn-detail-rute-paketan' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                                return html;
                            }
                            if(row["kosongan_id"]!=0){
                                let html = "<a class='btn btn-light btn-detail-rute-paketan-kosong' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+row["kosongan_id"]+"'><i class='fas fa-eye'></i></a>";
                                return html;
                            }else{
                                let html = "<a class='btn btn-light btn-detail-rute-paketan-reguler' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+row["Jo_id"]+"'><i class='fas fa-eye'></i></a>";
                                return html;
                            }
                        } 
                    },
                    {
                        "data": "tanggal_surat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "status",
                        className: 'text-center',
                            render: function(data, type, row) {
                                if (data == "Sampai Tujuan") {
                                    let html = "<span class='btn-sm btn-block btn-success active'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block btn-warning active'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_jo/"+data+"/report')?>'><i class='fas fa-eye'></i></a>";
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
                                    "<td>Rute ke-"+(i+1)+"</td>"+
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
                },
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
    <!-- end report JO -->

    <!-- Uang Jalan -->
    <script> //script datatables laporan Uang Jalan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Uang-Jalan-report').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
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
                        "data": "paketan_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            if(data!=0){
                                let html = "<a class='btn btn-light btn-detail-rute-paketan' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                                return html;
                            }
                            if(row["kosongan_id"]!=0){
                                let html = "<a class='btn btn-light btn-detail-rute-paketan-kosong' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+row["kosongan_id"]+"'><i class='fas fa-eye'></i></a>";
                                return html;
                            }else{
                                let html = "<a class='btn btn-light btn-detail-rute-paketan-reguler' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+row["Jo_id"]+"'><i class='fas fa-eye'></i></a>";
                                return html;
                            }
                        } 
                    },
                    {
                        "data": "supir_name"
                    },
                    {
                        "data": "mobil_no"
                    },
                    {
                        "data": "uang_jalan_bayar",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "Rp."+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_jo/"+data+"/uang_jalan')?>'><i class='fas fa-eye'></i></a>";
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
                                    "<td>Rute ke-"+(i+1)+"</td>"+
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
                },
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
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_bon/') ?>",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
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
                        "data": "bon_nominal",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "bon_tanggal",
                        className: 'text-center',
                        render: function(data, type, row) {
                            var data_tanggal = data.split("-");
                            var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                            return tanggal;
                        }
                    },
                    {
                        "data": "bon_jenis",
                        "orderable": true,
                            render: function(data, type, row) {
                                if (data == "Pembayaran" || data == "Potong Gaji") {
                                    let html = "<span class='btn-sm btn-block btn btn-success active'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else if (data == "Pengajuan"){
                                    let html = "<span class='btn-sm btn-block btn btn-warning active'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }else {
                                    let html = "<span class='btn-sm btn-block btn btn-danger active'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }
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
                                nominal = rupiah(data["bon_nominal"]);
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+nominal,
                                    dataType: "text",
                                    success: function(data) {
                                        $('td[name="terbilang"]').text(data);
                                    }
                                });
                                var data_tanggal = data["bon_tanggal"].split("-");
                                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                                $('td[name="tanggal"]').text(tanggal); //set value
                                $('td[name="keterangan"]').text(data["bon_keterangan"]); //set value
                                $('td[name="pembayaran_upah_id"]').text(data["pembayaran_upah_id"]); //set value
                                $('td[name="operator"]').text(data["user"]); //set value
                                $('#link_print_bon').attr('href','<?= base_url("index.php/print_berkas/print_bon/")?>'+data["bon_id"]);
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
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Customer/viewcustomer') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "customer_id",
                        className: 'text-center small',
                        render: function(data, type, row) {
                            let html = row["nomor"];
                            return html;
                        }
                    },
                    {
                        "data": "customer_name",
                        className: 'text-center small'
                    },
                    {
                        "data": "customer_alamat",
                        className: 'text-center small'
                    },
                    {
                        "data": "customer_kontak_person",
                        className: 'text-center small'
                    },
                    {
                        "data": "customer_telp",
                        className: 'text-center small'
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            tambah = "";
                            edit = "";
                            hapus = "";
                            if(data=="ACC"){
                                tambah = "<a class='btn btn-success rounded-pill btn-sm'>Tambah <i class='fas fa-check'></i></a>";
                            }else{
                                tambah = "<a class='btn btn-danger rounded-pill btn-sm'>Tambah <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_edit']=="ACC"){
                                edit = "<a class='btn btn-success rounded-pill btn-sm'>Edit <i class='fas fa-check'></i></a>";
                            }else{
                                edit = "<a class='btn btn-danger rounded-pill btn-sm'>Edit <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_delete']=="ACC"){
                                hapus = "<a class='btn btn-success rounded-pill btn-sm'>Hapus <i class='fas fa-check'></i></a>";
                            }else{
                                hapus = "<a class='btn btn-danger rounded-pill btn-sm'>Hapus <i class='fas fa-exclamation'></i></a>";
                            }
                            let html = "<span class='small'>"+tambah+"<br>"+edit+"<br>"+hapus+"</span>";
                            return html;
                        }
                    },
                    {
                        "data": "customer_id",
                        className: 'text-center small',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            html += "<a class='btn btn-light btn-detail-customer' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-customer' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-customer' data-toggle='modal' data-target='#popup-update-customer' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-customer' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "customer_id",
                        className: 'text-center small',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-customer' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-customer' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-customer'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-customer' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
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
                                $('td[name="customer_keterangan"]').text(data["customer_keterangan"]); //set value
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
                    $('.btn-acc-customer').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Customer',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Customer ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acccustomer/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acccustomer/Ditolak') ?>",
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
                    $('.btn-acc-edit-customer').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getcustomer') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_customer"]);
                                $('td[name="customer_name_edit"]').text(data_temp["customer_name"]); //set value
                                $('td[name="customer_alamat_edit"]').text(data_temp["customer_alamat"]); //set value
                                $('td[name="customer_kontak_person_edit"]').text(data_temp["customer_kontak_person"]); //set value
                                $('td[name="customer_telp_edit"]').text(data_temp["customer_telp"]); //set value
                                $('td[name="customer_keterangan_edit"]').text(data_temp["customer_keterangan"]); //set value
                                $('#ACC').attr('onclick','acc_edit_customer('+data["customer_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_customer('+data["customer_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-customer').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Customer',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Customer ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletecustomer/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletecustomer/Ditolak') ?>",
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
        function acc_edit_customer(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditcustomer/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_customer(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditcustomer/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- end Customer -->   

    <!-- invoice Customer -->
    <script> //script datatables invoice customer
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Invoice-Customer').DataTable({
                language: {
                    searchPlaceholder: "Nama Customer"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Customer/viewcustomerinvoice') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "customer_id",
                        className: 'text-center'
                    },
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
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_customer/"+data+"')?>'><i class='fas fa-file-invoice-dollar'></i></a>"
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- end invoice Customer -->   

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
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/viewsupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_id",
                        className: 'font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(row["supir_kasbon"])+"<a class='btn btn-light float-right' href='<?= base_url('index.php/detail/detail_report_bon/"+data+"/detail')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    },
                    {
                        "data": "status_aktif",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                if (data == "Aktif") {
                                    let html = "<a class='btn btn-block btn-sm btn-outline-success  btn-update-status-aktif-supir' data-pk='"+row['supir_id']+"' data-toggle='modal' data-target='#update_status_aktif_supir' ><i class='fa fa-fw fa-check mr-2'></i>" + data + "</a>";
                                    return html;
                                } else {
                                    let html = "<a class='btn btn-block btn-sm btn-outline-danger btn-update-status-aktif-supir' data-pk='"+row['supir_id']+"' data-toggle='modal' data-target='#update_status_aktif_supir' ><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</a>";
                                    return html;
                                }
                            }
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            tambah = "";
                            edit = "";
                            hapus = "";
                            if(data=="ACC"){
                                tambah = "<a class='btn btn-success rounded-pill btn-sm'>Tambah <i class='fas fa-check'></i></a>";
                            }else{
                                tambah = "<a class='btn btn-danger rounded-pill btn-sm'>Tambah <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_edit']=="ACC"){
                                edit = "<a class='btn btn-success rounded-pill btn-sm'>Edit <i class='fas fa-check'></i></a>";
                            }else{
                                edit = "<a class='btn btn-danger rounded-pill btn-sm'>Edit <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_delete']=="ACC"){
                                hapus = "<a class='btn btn-success rounded-pill btn-sm'>Hapus <i class='fas fa-check'></i></a>";
                            }else{
                                hapus = "<a class='btn btn-danger rounded-pill btn-sm'>Hapus <i class='fas fa-exclamation'></i></a>";
                            }
                            let html = "<span class='small'>"+tambah+"<br>"+edit+"<br>"+hapus+"</span>";
                            return html;
                        }
                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            html += "<a class='btn btn-light btn-detail-supir' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-supir' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-supir' data-toggle='modal' data-target='#popup-update-supir' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-supir' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-supir' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-supir' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-supir'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-supir' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
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
                                $("#supir_panggilan_update").val(data["supir_panggilan"]);
                                $("#supir_tempat_lahir_update").val(data["supir_tempat_lahir"]);
                                $("#supir_tgl_lahir_update").val(change_tanggal(data["supir_tgl_lahir"]));
                                $("#supir_alamat_update").val(data["supir_alamat"]);
                                $("#supir_telp_update").val(data["supir_telp"]);
                                $("#supir_ktp_update").val(data["supir_ktp"]);
                                $("#supir_sim_update").val(data["supir_sim"]);
                                $("#supir_tgl_sim_update").val(change_tanggal(data["supir_tgl_sim"]));
                                $("#supir_tgl_aktif_update").val(change_tanggal(data["supir_tgl_aktif"]));
                                $("#darurat_nama_update").val(data["darurat_nama"]);
                                $("#darurat_telp_update").val(data["darurat_telp"]);
                                $("#darurat_referensi_update").val(data["darurat_referensi"]);
                                $("#supir_keterangan_update").val(data["supir_keterangan"]);
                            }
                        });
                    });
                    $('.btn-update-status-aktif-supir').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getsupirname') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#update_status_supir_id").val(data["supir_id"]);
                                $("#update_status_supir_name").val(data["supir_name"]);
                                $("#update_status_status_aktif").val(data["status_aktif"]);
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
                                $('td[name="supir_name"]').text(data["supir_name"]+" ("+data["supir_panggilan"]+")"); //set value
                                $('td[name="supir_alamat"]').text(data["supir_alamat"]); //set value
                                $('td[name="supir_ttl"]').text(data["supir_tempat_lahir"]+","+change_tanggal(data["supir_tgl_lahir"])); //set value
                                $('td[name="supir_telp"]').text(data["supir_telp"]); //set value
                                $('td[name="supir_ktp"]').text(data["supir_ktp"]); //set value
                                $('td[name="supir_sim"]').text(data["supir_sim"]+" (s/d "+change_tanggal(data["supir_tgl_sim"])+")"); //set value
                                $('td[name="supir_kasbon"]').text("Rp."+rupiah(data["supir_kasbon"])); //set value
                                $('td[name="supir_keterangan"]').text(data["supir_keterangan"]); //set value
                                $('#aktif').text(data["status_aktif"]); //set value
                                if(data["status_aktif"]=="Aktif"){
                                    $('#tgl-aktif').text(change_tanggal(data["supir_tgl_aktif"])+" - Sekarang"); //set value
                                }else{
                                    $('#tgl-aktif').text(change_tanggal(data["supir_tgl_aktif"])+" - "+change_tanggal(data["supir_tgl_nonaktif"])); //set value
                                }
                                $('td[name="darurat_nama"]').text(data["darurat_nama"]); //set value
                                $('td[name="darurat_referensi"]').text(data["darurat_referensi"]); //set value
                                $('td[name="darurat_telp"]').text(data["darurat_telp"]); //set value
                                $('#foto').attr('src','<?= base_url("assets/berkas/driver/")?>'+data["file_foto"]);
                                $('#sim').attr('src','<?= base_url("assets/berkas/driver/")?>'+data["file_sim"]);
                                $('#ktp').attr('src','<?= base_url("assets/berkas/driver/")?>'+data["file_ktp"]);
                            }
                        });
                    }); 
                    $('.btn-delete-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Driver',
                            icon: "warning",
                            text: 'Yakin anda ingin menghapus Driver ini?',
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
                    $('.btn-acc-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Driver',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Driver ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accsupir/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accsupir/Ditolak') ?>",
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
                    $('.btn-acc-edit-supir').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data supir
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getsupir') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_supir"]);
                                $('td[name="supir_name_edit"]').text(data_temp["supir_name"]+" ("+data_temp["supir_panggilan"]+")"); //set value
                                $('td[name="supir_alamat_edit"]').text(data_temp["supir_alamat"]); //set value
                                $('td[name="supir_ttl_edit"]').text(data_temp["supir_tempat_lahir"]+","+change_tanggal(data_temp["supir_tgl_lahir"])); //set value
                                $('td[name="supir_telp_edit"]').text(data_temp["supir_telp"]); //set value
                                $('td[name="supir_ktp_edit"]').text(data_temp["supir_ktp"]); //set value
                                $('td[name="supir_sim_edit"]').text(data_temp["supir_sim"]+" (s/d "+change_tanggal(data_temp["supir_tgl_sim"])+")"); //set value
                                $('td[name="supir_keterangan_edit"]').text(data_temp["supir_keterangan"]); //set value
                                $('td[name="darurat_nama_edit"]').text(data_temp["darurat_nama"]); //set value
                                $('td[name="darurat_referensi_edit"]').text(data_temp["darurat_referensi"]); //set value
                                $('td[name="darurat_telp_edit"]').text(data_temp["darurat_telp"]); //set value
                                $('#foto_edit').attr('src','<?= base_url("assets/berkas/driver/")?>'+data_temp["file_foto"]);
                                $('#sim_edit').attr('src','<?= base_url("assets/berkas/driver/")?>'+data_temp["file_sim"]);
                                $('#ktp_edit').attr('src','<?= base_url("assets/berkas/driver/")?>'+data_temp["file_ktp"]);
                                $('#ACC').attr('onclick','acc_edit_supir('+data["supir_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_supir('+data["supir_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Driver',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Driver ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletesupir/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletesupir/Ditolak') ?>",
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
        function acc_edit_supir(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditsupir/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_supir(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditsupir/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- End Supir -->

    <!-- Report Bon Supir -->
    <script> //script datatables report bon Supir
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Report-Bon-Supir').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/bonsupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
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
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_report_bon/"+data+"/detail')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Report Bon Supir -->

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
                    "url": "<?php echo base_url('index.php/home/view_Supir/gajisupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
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
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/pilih_gaji/"+data+"/home/x/x')?>'><i class='fas fa-dollar-sign'></i></a>";
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
                    "url": "<?php echo base_url('index.php/home/view_Supir/reportsupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
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
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
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
                    [2, 'desc']
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
                            return data+" hari ("+change_tanggal(row["tanggal_batas_pembayaran"])+")";
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
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_invoice/"+data+"')?>'><i class='fas fa-eye'></i></a>";
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
                    [2, 'desc']
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
                            return data+" hari ("+change_tanggal(row["tanggal_batas_pembayaran"])+")";
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
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_invoice/"+data+"')?>'><i class='fas fa-eye'></i></a>";
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
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
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
                                    let html = "<span class='btn-sm btn-block active btn-dark'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='btn-sm btn-block active btn-light'>" + data + "</span>";
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
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_rute/viewrute')?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = "x";
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "rute_dari"
                    },
                    {
                        "data": "rute_ke"
                    },
                    {
                        "data": "rute_muatan"
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
                        "data": "validasi_rute",
                        className: 'text-center',
                        render: function(data, type, row) {
                            tambah = "";
                            edit = "";
                            hapus = "";
                            if(data=="ACC"){
                                tambah = "<a class='btn btn-success rounded-pill btn-sm'>Tambah <i class='fas fa-check'></i></a>";
                            }else{
                                tambah = "<a class='btn btn-danger rounded-pill btn-sm'>Tambah <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_rute_edit']=="ACC"){
                                edit = "<a class='btn btn-success rounded-pill btn-sm'>Edit <i class='fas fa-check'></i></a>";
                            }else{
                                edit = "<a class='btn btn-danger rounded-pill btn-sm'>Edit <i class='fas fa-exclamation'></i></a>";
                            }
                            if(row['validasi_rute_delete']=="ACC"){
                                hapus = "<a class='btn btn-success rounded-pill btn-sm'>Hapus <i class='fas fa-check'></i></a>";
                            }else{
                                hapus = "<a class='btn btn-danger rounded-pill btn-sm'>Hapus <i class='fas fa-exclamation'></i></a>";
                            }
                            let html = "<span class='small'>"+tambah+"<br>"+edit+"<br>"+hapus+"</span>";
                            return html;
                        }
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            html += "<a class='btn btn-light btn-detail-rute' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            if(row["validasi_rute"]!="Pending" && row["validasi_rute_edit"]!="Pending" && row["validasi_rute_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-rute' data-toggle='modal' data-target='#popup-update-rute' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-rute' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi_rute"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-rute' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_rute_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-rute' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-rute'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_rute_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-rute' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
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
                                $("#jenis_mobil_update").val(data["jenis_mobil"]);
                                $("#rute_uj_engkel_update").val(rupiah(data["rute_uj_engkel"]));
                                // $("#rute_uj_tronton_update").val(rupiah(data["rute_uj_tronton"]));
                                $("#rute_tagihan_update").val(rupiah(data["rute_tagihan"]));
                                $("#rute_gaji_engkel_update").val(rupiah(data["rute_gaji_engkel"]));
                                // $("#rute_gaji_tronton_update").val(rupiah(data["rute_gaji_tronton"]));
                                $("#rute_gaji_engkel_rumusan_update").val(rupiah(data["rute_gaji_engkel_rumusan"]));
                                // $("#rute_gaji_tronton_rumusan_update").val(rupiah(data["rute_gaji_tronton_rumusan"]));
                                $("#rute_tonase_update").val(rupiah(data["rute_tonase"]));
                                $("#rute_keterangan_update").val(data["rute_keterangan"]);
                                $("#Ritase_update").val(data["ritase"]);
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
                    $('.btn-detail-rute').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutebyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#rute_id_detail").val(data["rute_id"]);
                                $("#customer_id_detail").val(data["customer_id"]);
                                $("#customer_name_detail").val(data["customer_name"]);
                                $("#rute_dari_detail").val(data["rute_dari"]);
                                $("#rute_ke_detail").val(data["rute_ke"]);
                                $("#rute_muatan_detail").val(data["rute_muatan"]);
                                $("#jenis_mobil_detail").val(data["jenis_mobil"]);
                                $("#rute_uj_engkel_detail").val(rupiah(data["rute_uj_engkel"]));
                                // $("#rute_uj_tronton_detail").val(rupiah(data["rute_uj_tronton"]));
                                $("#rute_tagihan_detail").val(rupiah(data["rute_tagihan"]));
                                $("#rute_gaji_engkel_detail").val(rupiah(data["rute_gaji_engkel"]));
                                // $("#rute_gaji_tronton_detail").val(rupiah(data["rute_gaji_tronton"]));
                                $("#rute_gaji_engkel_rumusan_detail").val(rupiah(data["rute_gaji_engkel_rumusan"]));
                                // $("#rute_gaji_tronton_rumusan_detail").val(rupiah(data["rute_gaji_tronton_rumusan"]));
                                $("#rute_tonase_detail").val(rupiah(data["rute_tonase"]));
                                $("#rute_keterangan_detail").val(data["rute_keterangan"]);
                                $("#Ritase_detail").val(data["ritase"]);

                            }
                        });
                    });
                    $('.btn-acc-rute').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Rute dan Muatan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Rute dan Muatan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accrute/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accrute/Ditolak') ?>",
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
                    $('.btn-acc-edit-rute').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutebyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_rute"])
                                $("#rute_id_edit").val(data["rute_id"]);
                                $("#customer_id_edit").val(data["customer_id"]);
                                $("#customer_name_edit").val(data["customer_name"]);
                                $("#rute_dari_edit").val(data_temp["rute_dari"]);
                                $("#rute_ke_edit").val(data_temp["rute_ke"]);
                                $("#rute_muatan_edit").val(data_temp["rute_muatan"]);
                                $("#jenis_mobil_edit").val(data["jenis_mobil"]);
                                $("#rute_uj_engkel_edit").val(rupiah(data_temp["rute_uj_engkel"]));
                                $("#rute_tagihan_edit").val(rupiah(data_temp["rute_tagihan"]));
                                $("#rute_gaji_engkel_edit").val(rupiah(data_temp["rute_gaji_engkel"]));
                                $("#rute_keterangan_edit").val(data_temp["rute_keterangan"]);
                                $('#ACC').attr('onclick','acc_edit_rute('+data["rute_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_rute('+data["rute_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-rute').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Rute dan Muatan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapsu Data Rute dan Muatan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeleterute/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeleterute/Ditolak') ?>",
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
        function acc_edit_rute(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditrute/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_rute(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditrute/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- End rute -->

    <!-- paketan -->
    <script> //script datatables rute
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Paketan').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_paketan/viewpaketan')?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = "x";
                    }
                },
                "deferRender": true,
                "paging":false,
                "columns": [
                    {
                        "data": "paketan_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "paketan_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-detail-rute-paketan' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            return html;
                        } 
                    },
                    {
                        "data": "jenis_mobil"
                    },
                    {
                        "data": "ritase"
                    },
                    {
                        "data": "paketan_uj",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "validasi_paketan",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = "<span>Tambah = "+data+"<br>Edit = "+row['validasi_paketan_edit']+"<br>Hapus = "+row['validasi_paketan_delete']+"</span>";
                            return html;
                        }  
                    },
                    {
                        "data": "paketan_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                                if(row["validasi_paketan"]!="Pending" && row["validasi_paketan_edit"]!="Pending" && row["validasi_paketan_delete"]!="Pending"){
                                    html += "<a class='btn btn-light btn-update-paketan' data-toggle='modal' data-target='#popup-update-paketan' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a> || "+
                                    "<a class='btn btn-light btn-delete-paketan' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                                    return html;
                                }
                                return html;
                        } 
                    },
                    {
                        "data": "paketan_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi_paketan"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-paketan' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_paketan_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-paketan' href='javascript:void(0)' data-pk='"+data+"'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_paketan_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-paketan' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        } 
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-paketan').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        Swal.fire({
                            title: 'Hapus Rute Paketan',
                            text:'Yakin anda ingin menghapus Rute Paketan ini?',
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
                                    url: "<?php echo base_url('index.php/form/deletepaketan') ?>",
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
                    $('.btn-update-paketan').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getpaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                var data_rute = JSON.parse(data["paketan_data_rute"]);
                                let html = "";
                                for(i=0;i<data_rute.length;i++){
                                    html += "<tr>"+
                                    "<td>"+data_rute[i]["customer"]+"</td>"+
                                    "<td>"+data_rute[i]["dari"]+"</td>"+
                                    "<td>"+data_rute[i]["ke"]+"</td>"+
                                    "<td>"+data_rute[i]["muatan"]+"</td>"+
                                    "</tr>"
                                }
                                $("#table-data-rute-update tbody").html(html);

                                var data_mobil = data["jenis_mobil"];
                                $('#jenis_mobil_update').find('option').remove().end(); //reset option select
                                var isi_jenis = [];
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/getallmobil/') ?>",
                                    dataType: "JSON",
                                    success: function(data) {
                                        if(data.length==0){
                                            $('#jenis_mobil_update').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                                        }else{
                                            $('#jenis_mobil_update').append('<option class="font-w700" selected value="'+data_mobil+'">'+data_mobil+'</option>'); 
                                            for(i=0;i<data.length;i++){
                                                if(!isi_jenis.includes(data[i]["mobil_jenis"])){
                                                    $('#jenis_mobil_update').append('<option value="'+data[i]["mobil_jenis"]+'">'+data[i]["mobil_jenis"]+'</option>'); 
                                                    isi_jenis.push(data[i]["mobil_jenis"]);
                                                }
                                            }
                                        }
                                    }
                                });
                                
                                if(data["paketan_tonase"]==0){  
                                    $("#Gaji_update").val("FIX");
                                    $("#paketan_gaji_rumusan_update").attr("readonly",true);
                                    $("#paketan_gaji_update").removeAttr("readonly");
                                    $("#Tonase_update").attr("readonly",true);
                                }else{
                                    $("#Gaji_update").val("NON-FIX");
                                    $("#paketan_gaji_rumusan_update").removeAttr("readonly");
                                    $("#paketan_gaji_update").attr("readonly",true);
                                    $("#Tonase_update").removeAttr("readonly");
                                }
                                $("#paketan_id_update").val(data["paketan_id"]);
                                $("#paketan_uj_update").val(rupiah(data["paketan_uj"]));
                                $("#Ritase_update").val(data["ritase"]);
                                $("#paketan_gaji_rumusan_update").val(rupiah(data["paketan_gaji_rumusan"]));
                                $("#paketan_gaji_update").val(rupiah(data["paketan_gaji"]));
                                $("#paketan_tagihan_update").val(rupiah(data["paketan_tagihan"]));
                                $("#Tonase_update").val(rupiah(data["paketan_tonase"]));
                                $("#paketan_keterangan_update").val(data["paketan_keterangan"]);
                            }
                        });
                    });
                    $('.btn-detail-rute-paketan').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutepaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                // alert(data[0]["dari"]);
                                let html = "";
                                for(i=0;i<data.length;i++){
                                    html += "<tr>"+
                                    "<td>"+data[i]["customer"]+"</td>"+
                                    "<td>"+data[i]["dari"]+"</td>"+
                                    "<td>"+data[i]["ke"]+"</td>"+
                                    "<td>"+data[i]["muatan"]+"</td>"+
                                    "</tr>"
                                }
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getpaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#detail-keterangan").text(data["paketan_keterangan"]);
                                $("#detail-tonase").text(data["paketan_tonase"]);
                                if(data["paketan_tonase"]==0){  
                                    $("#detail-gaji").text("FIX");
                                }else{
                                    $("#detail-gaji").text("NON-FIX");
                                }
                                $("#detail-gaji-fix").text("Rp."+rupiah(data["paketan_gaji"]));
                                $("#detail-gaji-nonfix").text("Rp."+rupiah(data["paketan_gaji_rumusan"]));
                            }
                        });
                    });
                    $('.btn-acc-paketan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Rute Paketan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Rute Paketan ini?',
                            showDenyButton: true,
                            showCancelButton: true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accpaketan/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accpaketan/Ditolak') ?>",
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
                    $('.btn-acc-edit-paketan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Edit Data Rute Paketan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Edit Data Rute Paketan ini?',
                            showDenyButton: true,
                            showCancelButton: true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acceditpaketan/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acceditpaketan/Ditolak') ?>",
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
                    $('.btn-acc-delete-paketan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Rute Paketan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Rute Paketan ini?',
                            showDenyButton: true,
                            showCancelButton: true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletepaketan/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletepaketan/Ditolak') ?>",
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
    <!-- End paketan -->

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
            var merk = '<?= $this->session->flashdata('status-add-merk'); ?>';
            var invoice = '<?= $this->session->flashdata('status-insert-invoice'); ?>';
            var update_merk = '<?= $this->session->flashdata('status-update-merk'); ?>';
            var delete_merk = '<?= $this->session->flashdata('status-delete-merk'); ?>';
            var supir_jo = '<?= $this->session->flashdata('supir_jo'); ?>';
            var mobil_jo = '<?= $this->session->flashdata('mobil_jo'); ?>';
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
            if(invoice == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Invoice baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(supir_jo == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Supir",
                        type: "success",
                        timer: 2000
                    });
            }
            if(mobil_jo == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Mobil",
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
                        text: "Menambahkan data driver",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Update data driver",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
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
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
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
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
            if(delete_customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
            if(merk == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan data merk",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_merk == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Update data merk",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_merk == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
        });
    </script>
    <!-- end script alert -->

    <script> //script set tanggal saat ini
        $(function(){
            $("#invoice_tgl").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true
            });
            //proses tanggal
            var date = new Date();
            if((date.getMonth()+1)<10){
                $("#invoice_tgl").val(date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
                $("#update_status_tanggal_nonaktif").val(date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
            }else{
                $("#invoice_tgl").val(date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
                $("#update_status_tanggal_nonaktif").val(date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
            }
        });
    </script>

    <script> //script input tanggal
        function tanggal_berlaku(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                icon: "success",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 500
            });
            $("#"+a.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        }
    </script>

    <script> //script pilih JO untuk invoice
        $(document).ready(function() {
            var table = null;
            table = $('#pilih-jo').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/form/view_pilih_jo') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = $('#customer_id').val();
                    }
                },
                "paging":false,
                "deferRender": true,
                "columns": [
                    {
                        "data": "Jo_id"
                    },
                    // {
                    //     "data": "paketan_id",
                    //     className: 'text-center',
                    //     "orderable": false,
                    //     render: function(data, type, row) {
                    //         if(data!=0){
                    //             let html = "<a class='btn btn-light btn-detail-rute-paketan' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                    //             return html;
                    //         }
                    //         if(row["kosongan_id"]!=0){
                    //             let html = "<a class='btn btn-light btn-detail-rute-paketan-kosong' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-jo='"+row["Jo_id"]+"' data-pk='"+row["kosongan_id"]+"'><i class='fas fa-eye'></i></a>";
                    //             return html;
                    //         }else{
                    //             let html = "<a class='btn btn-light btn-detail-rute-paketan-reguler' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+row["Jo_id"]+"'><i class='fas fa-eye'></i></a>";
                    //             return html;
                    //         }
                    //     } 
                    // },
                    {
                        "data": "tanggal_muat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "tanggal_bongkar",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "mobil_no"
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
                        "data": "tonase"
                    },
                    {
                        "data": "tagihan",
                        render: function(data, type, row) {
                            let html = "Rp."+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<input class='btn-check-invoice' data-pk='"+data+"' data-toggle='toggle' type='checkbox' data-size='medium' data-onstyle='success' data-offstyle='danger'>";
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' target='_blank'  href='<?= base_url('index.php/detail/detail_jo/"+data+"/JO')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    var data_jo = [];
                    $(".btn-check-invoice").click(function() {
                        let pk = $(this).data('pk');
                        if(data_jo.includes(pk)!=true){
                            data_jo.push(pk);
                        }else{
                            data_jo.splice(data_jo.indexOf(pk), 1 );
                        }
                        // alert(data_jo);
                        $("#data_jo").val(data_jo);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjo') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                if(data_jo.includes(pk)==true){
                                    if($("#invoice_tonase").val()=="" || $("#invoice_tonase").val()=="0"){
                                        var tonase = parseInt(data["tonase"]);
                                        var total = parseInt(data["tagihan"]);
                                    }else{
                                        var tonase = parseInt($("#invoice_tonase").val().replaceAll(".",""))+parseInt(data["tonase"]);
                                        var total = parseInt($("#invoice_total").val().replaceAll(".",""))+parseInt(data["tagihan"]);
                                    }
                                    if($("#invoice_ppn").val()=="Ya"){
                                        var ppn = total*0.1;
                                    }else{
                                        var ppn = 0;
                                    }
                                    var grand_total=total+ppn;
                                    $("#invoice_tonase").val(rupiah(tonase));
                                    $("#invoice_total").val(rupiah(total));
                                    $("#invoice_ppn_nilai").val(rupiah(ppn));
                                    $("#invoice_grand_total").val(rupiah(grand_total));
                                }else{
                                    var tonase = parseInt($("#invoice_tonase").val().replaceAll(".",""))-parseInt(data["tonase"]);
                                    var total = parseInt($("#invoice_total").val().replaceAll(".",""))-parseInt(data["tagihan"]);
                                    $("#invoice_tonase").val(rupiah(tonase));
                                    $("#invoice_total").val(rupiah(total));
                                    if($("#invoice_ppn").val()=="Ya"){
                                        var ppn = total*0.1;
                                    }else{
                                        var ppn = 0;
                                    }
                                    var grand_total=total+ppn;
                                    $("#invoice_ppn_nilai").val(rupiah(ppn));
                                    $("#invoice_grand_total").val(rupiah(grand_total));
                                }
                            }
                        });
                    });
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
                                    "<td>Rute ke-"+(i+1)+"</td>"+
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
                        let jo = $(this).data('jo');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk,
                                jo:jo
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
            $("#customer_id").change(function() {
                table.ajax.reload();
            });
            $("#invoice_ppn").change(function() {
                var total = $("#invoice_total").val().replaceAll(".","");
                if(total!=""){
                    if($("#invoice_ppn").val()=="Ya"){
                        var ppn=total*0.1;
                    }else{
                        var ppn=0;
                    }
                    var grand_total=parseInt(total)+parseInt(ppn);
                    $("#invoice_ppn_nilai").val(rupiah(ppn));
                    $("#invoice_grand_total").val(rupiah(grand_total));
                }
            });
        });
    </script>

    <script> //script pilih rute untuk JO
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Pilih-Rute').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_rute/addjo')?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = $("#Customer").val();
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "rute_muatan"
                    },
                    {
                        "data": "rute_dari"
                    },
                    {
                        "data": "rute_ke"
                    },
                    {
                        "data": "jenis_mobil"
                    },
                    {
                        "data": "rute_tonase",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            if(data=="0"){
                                let html ="<small>FIX</small>";
                                return html;
                            }else{
                                let html ="<small>NON-FIX</small>";
                                return html;
                            }
                        }
                    },
                    {
                        "data": "rute_tonase"
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-light btn-pilih-rute' href='javascript:void(0)' data-pk='"+data+"'>Pilih<i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    $('.btn-pilih-rute').click(function() {
                        let pk = $(this).data('pk');
                        if($("#nominal_tambahan").val()==""){
                            $("#uang_jalan_total").val(0);
                        }else{
                            $("#uang_jalan_total").val($("#nominal_tambahan").val());
                        }
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getrute') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                if($("#jenis_tambahan").val()=="Potongan"){
                                    total = rupiah( parseInt(data["rute_uj_engkel"])-parseInt($("#uang_jalan_total").val().replaceAll(".","")) ) ;
                                }else if($("#jenis_tambahan").val()=="Tambahan"){
                                    total = rupiah( parseInt(data["rute_uj_engkel"])+parseInt($("#uang_jalan_total").val().replaceAll(".","")) ) ;
                                }else{
                                    total = rupiah( parseInt(data["rute_uj_engkel"])) ;
                                }
                                $('#Muatan').val(data["rute_muatan"]); //set value
                                $('#Asal').val(data["rute_dari"]); //set value
                                $('#Tujuan').val(data["rute_ke"]); //set value
                                $('#Jenis').val(data["jenis_mobil"]); //set value
                                if(data["rute_tonase"]==0){
                                    $('#Type_Tonase').val("FIX"); //set value
                                    $('#Upah').val(data["rute_gaji_engkel"]); //set value
                                }else{
                                    $('#Type_Tonase').val("NON-FIX"); //set value
                                    $('#Upah').val(data["rute_gaji_engkel_rumusan"]); //set value
                                }
                                $('#Tonase').val(data["rute_tonase"]); //set value
                                $('#Uang').val(rupiah(data["rute_uj_engkel"])); //set value
                                $('#Tagihan').val(data["rute_tagihan"]); //set value
                                $( '#uang_jalan_total' ).val(total);
                                // uang = rupiah(data["rute_uj_engkel"]);
                                // $.ajax({
                                //     type: "GET",
                                //     url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+uang,
                                //     dataType: "text",
                                //     success: function(data) {
                                //         $('#Terbilang').val(data);
                                //     }
                                // });
                                var mobil_jenis = $("#Jenis").val();
                                $('#Kendaraan').find('option').remove().end(); //reset option select
                                $.ajax({ //ajax set option kendaraan
                                    type: "POST",
                                    url: "<?php echo base_url('index.php/form/getmobilbyjenis') ?>",
                                    dataType: "JSON",
                                    data: {
                                        mobil_jenis: mobil_jenis,
                                    },
                                    success: function(data) {
                                        if(data.length==0){
                                            $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                                        }else{
                                            $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kendaraan Pengiriman</option>'); 
                                            for(i=0;i<data.length;i++){
                                                    $('#Kendaraan').append('<option value="'+data[i]["mobil_no"]+'">'+data[i]["mobil_no"]+'  ||  '+data[i]["mobil_jenis"]+'</option>'); 
                                            }
                                        }
                                    }
                                });
                            }
                        });
                    });
                },
            });
            $("#Customer").change(function() {
                table.ajax.reload();
            });
        });
    </script>

    <script> //script pilih rute untuk paketan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Add-Rute-Paketan').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_rute/addjo')?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = $("#Customer").val();
                    }
                },
                "deferRender": true,
                "paging":false,
                "columns": [
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "rute_muatan"
                    },
                    {
                        "data": "rute_dari"
                    },
                    {
                        "data": "rute_ke"
                    },
                    {
                        "data": "rute_uj_engkel",
                        render: function(data, type, row) {
                            return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "rute_tagihan",
                        render: function(data, type, row) {
                            return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-light btn-pilih-rute' data-dismiss='modal' aria-label='Close' href='javascript:void(0)' data-pk='"+data+"'>Pilih<i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    $('.btn-pilih-rute').click(function() {
                        let pk = $(this).data('pk');
                        add_rute("rute",pk)
                    });
                },
            });
            $("#Customer").change(function() {
                table.ajax.reload();
            });
        });
    </script>

    <script>//add kosongan dan rute pada add paketan
        var data_rute = [];
        var n_kosongan = 0;
        var n_rute = 0;
        function add_rute(tipe,a){
            var html = "";
            var uj = 0;
            if(tipe=="kosongan"){
                var kosongan_id = $("#kosongan_id").val();
                if( kosongan_id != 0 ){
                    n_kosongan += 1;
                    $("#btn-add-kosongan").hide();
                    data_rute.push("k"+kosongan_id);
                }
            }else{
                var rute_id = a;
                n_rute += 1;
                if(n_rute==2){
                    $("#btn-add-rute").hide();
                }
                data_rute.push("r"+rute_id);
            }
            for(i=0;i<data_rute.length;i++){
                if(data_rute[i][0]=="k"){
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
                        dataType: "JSON",
                        data: {
                            id: data_rute[i].replace("k","")
                        },
                        success: function(data) { //jika ambil data sukses
                            html += "<tr>"+
                                "<td>-</td>"+
                                "<td>"+data["kosongan_dari"]+"</td>"+
                                "<td>"+data["kosongan_ke"]+"</td>"+
                                "<td>Kosongan</td>"+
                                "<td>Rp."+rupiah(data["kosongan_uang"])+"</td>"+
                                "<td>-</td>"+
                                "</tr>";
                            $("#table-data-rute tbody").html(html);
                            uj += parseInt(data["kosongan_uang"]);
                            $("#paketan_uj").val(rupiah(uj));
                        }
                    });
                }else{
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url('index.php/detail/getrute') ?>",
                        dataType: "JSON",
                        data: {
                            id: data_rute[i].replace("r","")
                        },
                        success: function(data) {
                            html += "<tr>"+
                            "<td>"+data["customer_name"]+"</td>"+
                            "<td>"+data["rute_dari"]+"</td>"+
                            "<td>"+data["rute_ke"]+"</td>"+
                            "<td>"+data["rute_muatan"]+"</td>"+
                            "<td>Rp."+rupiah(data["rute_uj_engkel"])+"</td>"+
                            "<td>Rp."+rupiah(data["rute_tagihan"])+"</td>"+
                            "</tr>";
                            $("#table-data-rute tbody").html(html);
                            uj += parseInt(data["rute_uj_engkel"]);
                            $("#paketan_uj").val(rupiah(uj));
                        }
                    })
                }
            }
            $("#data_rute").val(data_rute);
        }
    </script>

    <script> //script datatables kosongan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Kosongan').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_kosongan/') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "paging":false,
                "columns": [
                    {
                        "data": "kosongan_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "kosongan_dari",
                    },
                    {
                        "data": "kosongan_ke"
                    },
                    {
                        "data": "kosongan_uang",
                        render: function(data, type, row) {
                            let html = "Rp."+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = "<span class='small'>Tambah = "+data+"<br>Edit = "+row['validasi_edit']+"<br>Hapus = "+row['validasi_delete']+"</span>";
                            return html;
                        }   
                    },
                    {
                        "data": "kosongan_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                                if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                    html += "<a class='btn btn-light btn-update-kosongan' href='javascript:void(0)' data-toggle='modal' data-target='#popup-update-kosongan' data-pk='"+data+"'><i class='fas fa-pen-square'></i></a> || "+
                                    "<a class='btn btn-light btn-delete-kosongan' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-trash-alt'></i></a>";
                                    return html;
                                }
                                return html;
                        }
                    },
                    {
                        "data": "kosongan_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-kosongan' href='javascript:void(0)' data-pk='"+data+"'>ACC Tambah<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-kosongan' href='javascript:void(0)' data-pk='"+data+"'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-kosongan' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-kosongan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Rute Kosongan',
                            text:'Yakin anda akan menghapus data Rute Kosongan ini?',
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
                                    url: "<?php echo base_url('index.php/form/deletekosongan') ?>",
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
                    $('.btn-update-kosongan').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#kosongan_id_update').val(pk); //set value
                                $('#kosongan_dari_update').val(data["kosongan_dari"]); //set value
                                $('#kosongan_ke_update').val(data["kosongan_ke"]); //set value
                                $('#kosongan_uang_update').val(rupiah(data["kosongan_uang"])); //set value
                            }
                        });
                    });
                    $('.btn-acc-kosongan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Rute Kosongan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Rute Kosongan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({ //ajax ambil data bon
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acckosongan/ACC') ?>",
                                    dataType: "JSON",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) { //jika ambil data sukses
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({ //ajax ambil data bon
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acckosongan/Ditolak') ?>",
                                    dataType: "JSON",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) { //jika ambil data sukses
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-edit-kosongan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Edit Data Rute Kosongan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Edit Data Rute Kosongan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({ //ajax ambil data bon
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acceditkosongan/ACC') ?>",
                                    dataType: "JSON",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) { //jika ambil data sukses
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({ //ajax ambil data bon
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acceditkosongan/Ditolak') ?>",
                                    dataType: "JSON",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) { //jika ambil data sukses
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-delete-kosongan').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Rute Kosongan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Rute Kosongan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({ //ajax ambil data bon
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletekosongan/ACC') ?>",
                                    dataType: "JSON",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) { //jika ambil data sukses
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({ //ajax ambil data bon
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletekosongan/Ditolak') ?>",
                                    dataType: "JSON",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) { //jika ambil data sukses
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                },
            });
        });
    </script>

    <script>
        function upload_foto(a){
            var filePath = a.value;
            var fileSize = a.files[0].size;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(filePath)) {
                Swal.fire({
                    title: "Upload Gagal",
                    icon: "error",
                    text: "File Harus Berupa Gambar JPG,JPEG,PNG",
                    type: "error",
                    timer: 2000
                });
                a.value = '';
            }
            if (fileSize>2000000) {
                Swal.fire({
                    title: "Upload Gagal",
                    icon: "error",
                    text: "Ukuran File Harus Kurang Dari 2 MB",
                    type: "error",
                    timer: 2000
                });
                a.value = '';
            }
        }
    </script>

    <!-- pilih rute paketan untuk jo paketan-->
    <script> //script datatables rute
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Pilih-Rute-Paketan').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_paketan/addjo')?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = 'x';
                    }
                },
                "deferRender": true,
                "paging":false,
                "columns": [
                    {
                        "data": "paketan_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "paketan_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-detail-rute-paketan' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute-paketan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            return html;
                        } 
                    },
                    {
                        "data": "jenis_mobil"
                    },
                    {
                        "data": "ritase"
                    },
                    {
                        "data": "paketan_uj",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "paketan_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-light btn-pilih-rute-paketan' href='javascript:void(0)' data-pk='"+data+"'>Pilih<i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    $('.btn-pilih-rute-paketan').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getpaketan') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                if(data["paketan_tonase"]==0){
                                    $('#Type_Tonase').val("FIX"); //set value
                                    $('#Upah').val(data["paketan_gaji"]); //set value
                                }else{
                                    $('#Type_Tonase').val("NON-FIX"); //set value
                                    $('#Upah').val(data["paketan_gaji_rumusan"]); //set value
                                }
                                $('#Jenis').val(data["jenis_mobil"]); //set value
                                $('#Tonase').val(data["paketan_tonase"]); //set value
                                $('#Uang').val(rupiah(data["paketan_uj"])); //set value
                                $('#paketan_id').val(data["paketan_id"]); //set value
                                $('#Tagihan').val(data["paketan_tagihan"]); //set value
                                uang = rupiah(data["paketan_uj"]);
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+uang,
                                    dataType: "text",
                                    success: function(data) {
                                        $('#Terbilang').val(data);
                                    }
                                });
                                var mobil_jenis = $("#Jenis").val();
                                $('#Kendaraan').find('option').remove().end(); //reset option select
                                $.ajax({ //ajax set option kendaraan
                                    type: "POST",
                                    url: "<?php echo base_url('index.php/form/getmobilbyjenis') ?>",
                                    dataType: "JSON",
                                    data: {
                                        mobil_jenis: mobil_jenis,
                                    },
                                    success: function(data) {
                                        if(data.length==0){
                                            $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                                        }else{
                                            $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kendaraan Pengiriman</option>'); 
                                            for(i=0;i<data.length;i++){
                                                    $('#Kendaraan').append('<option value="'+data[i]["mobil_no"]+'">'+data[i]["mobil_no"]+'  ||  '+data[i]["mobil_max_load"]+' Ton  ||  '+data[i]["mobil_jenis"]+'</option>'); 
                                            }
                                        }
                                    }
                                });
                                var data_rute = JSON.parse(data["paketan_data_rute"]);
                                let html = "";
                                for(i=0;i<data_rute.length;i++){
                                    html += "<tr>"+
                                    "<td>"+data_rute[i]["customer"]+"</td>"+
                                    "<td>"+data_rute[i]["dari"]+"</td>"+
                                    "<td>"+data_rute[i]["ke"]+"</td>"+
                                    "<td>"+data_rute[i]["muatan"]+"</td>"+
                                    "</tr>"
                                }
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                    $('.btn-detail-rute-paketan').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutepaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                // alert(data[0]["dari"]);
                                let html = "";
                                for(i=0;i<data.length;i++){
                                    html += "<tr>"+
                                    "<td>"+data[i]["customer"]+"</td>"+
                                    "<td>"+data[i]["dari"]+"</td>"+
                                    "<td>"+data[i]["ke"]+"</td>"+
                                    "<td>"+data[i]["muatan"]+"</td>"+
                                    "</tr>"
                                }
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getpaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#detail-keterangan").text(data["paketan_keterangan"]);
                                $("#detail-tonase").text(data["paketan_tonase"]);
                                if(data["paketan_tonase"]==0){  
                                    $("#detail-gaji").text("FIX");
                                }else{
                                    $("#detail-gaji").text("NON-FIX");
                                }
                                $("#detail-gaji-fix").text("Rp."+rupiah(data["paketan_gaji"]));
                                $("#detail-gaji-nonfix").text("Rp."+rupiah(data["paketan_gaji_rumusan"]));
                            }
                        });
                    });
                },
            });
        });
    </script>
    <!-- End pilih rute paketan untuk jo paketan-->

    <script>
        function change_tanggal(data){
            if(data==""){
                return "";
            }else if(data=="0000-00-00"){
                return "";
            }else{
                var data_tanggal = data.split("-");
                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                return tanggal;
            }
        }
    </script>
    
</body>

</html>