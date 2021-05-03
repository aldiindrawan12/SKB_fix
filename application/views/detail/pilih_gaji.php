<!-- tampilan detail penggajian supir -->
<div class="container small">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center">Data Upah Supir</h6>
        </div>
        <div class="card-body" id="identitas">
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
        </div>
        <div class="card-body row" id="rincian">
            <div class="col-md-5 ">
                <form action="<?= base_url("index.php/detail/detail_penggajian/").$supir["supir_id"]?>" method="POST">
                    <input type="text" name="jo" id="jo" required hidden>
                    <div class="form-group row">
                        <label for="gaji_total" class="col-form-label col-sm-7 font-weight-bold">Total</label>
                        <div class="col-sm-5">
                            <input autocomplete="off" type="text" class="form-control" id="gaji_total" name="gaji_total" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kasbon" class="col-form-label col-sm-7 font-weight-bold">Bayar Kasbon (Rp.<?= number_format($supir["supir_kasbon"],2,",",".")?>)</label>
                        <div class="col-sm-5">
                            <input autocomplete="off" type="text" class="form-control" id="kasbon" name="kasbon" onkeyup="batas_kasbon(this)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bonus" class="col-form-label col-sm-7 font-weight-bold">Bonus</label>
                        <div class="col-sm-5">
                            <input autocomplete="off" type="text" class="form-control" id="bonus" name="bonus" onkeyup="bonus_nilai(this)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gaji_grand_total" class="col-form-label col-sm-7 font-weight-bold">Grand Total</label>
                        <div class="col-sm-5">
                            <input autocomplete="off" type="text" class="form-control" id="gaji_grand_total" name="gaji_grand_total" required readonly>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success float-right mt-3" onclick="cek_jo()">Selanjutnya</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive col-md-7">
                <table class="table table-bordered table-striped" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">Tgl Keluar</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <!-- <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Uang Jalan</th> -->
                            <th class="text-center" width="10%" scope="col">Upah</th>
                            <th class="text-center" width="10%" scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jo as $value){?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= $value["tanggal_surat"]?></td>
                            <td><?= $value["tanggal_bongkar"]?></td>
                            <!-- <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td> -->
                            <!-- <?php
                                if($value["uang_kosongan"]!=""){
                                    echo "<td>Rp.".number_format($value["uang_jalan"]+$value["uang_kosongan"],2,',','.')."</td>";
                                }else{
                                    echo "<td>Rp.".number_format($value["uang_jalan"],2,',','.')."</td>";
                                }
                            ?> -->
                            <td>Rp.<?= number_format($value["upah"]+$value["bonus"],2,',','.')?></td>
                            <td><input class='' id="<?= $value["Jo_id"]?>" data-toggle='toggle' type='checkbox' data-size='medium' data-onstyle='success' data-offstyle='danger' onchange="pilih_gaji(this)"></td>
                        </tr>
                    <?php } ?>
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
    <script>
        var data_jo = [];
        $("#gaji_total").val(0);
        $("#gaji_grand_total").val(0);
        function pilih_gaji(a){
            var jo_id = a.id;
            if(data_jo.includes(jo_id)!=true){
                data_jo.push(jo_id);
            }else{
                data_jo.splice(data_jo.indexOf(jo_id), 1 );
            }
            $("#jo").val(data_jo);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/detail/getjo') ?>",
                dataType: "JSON",
                data: {
                    id: jo_id
                },
                success: function(data) { //jika ambil data sukses
                    var gaji = data["upah"];
                    var kasbon = $("#kasbon").val().replaceAll(".","");
                    var bonus = $("#bonus").val().replaceAll(".","");
                    var gaji_total = $("#gaji_total").val().replaceAll(".","");
                    var gaji_grand_total = $("#gaji_grand_total").val().replaceAll(".","");

                    if(data_jo.includes(jo_id)==true){
                        var gaji_total = parseInt(gaji_total) + parseInt(gaji);
                        var gaji_grand_total = parseInt(gaji_grand_total) + parseInt(gaji);
                        $("#gaji_total").val(rupiah(gaji_total));
                        $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                    }else{
                        var gaji_total = parseInt(gaji_total) - parseInt(gaji);
                        var gaji_grand_total = parseInt(gaji_grand_total) - parseInt(gaji);
                        $("#gaji_total").val(rupiah(gaji_total));
                        $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                    }
                }
            });
        }
        function batas_kasbon(a){
            var bonus = 0;
            if($("#bonus").val().replaceAll(".","") == ""){
                bonus = 0;
            }else{
                bonus = $("#bonus").val().replaceAll(".","");
            }
            var total = parseInt($("#gaji_total").val().replaceAll(".",""))+parseInt(bonus);
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            var kasbon = '<?= $supir["supir_kasbon"]?>';
            var kasbon_bayar = $("#kasbon").val().replaceAll(".","");
            if(kasbon_bayar == ""){
                kasbon_bayar = 0;
            }
            if(parseInt(kasbon)<parseInt(kasbon_bayar)){
                alert('Jumlah Potong Kasbon Harus Lebih Kecil Dari Rp.'+ rupiah(kasbon));
                $( '#kasbon' ).val("");
                $("#gaji_grand_total").val(rupiah(total));
            }else{
                var gaji_grand_total = parseInt(total)-parseInt(kasbon_bayar);
                $("#gaji_grand_total").val(rupiah(gaji_grand_total));
            }
        }
        function bonus_nilai(a){
            var kasbon = 0;
            if($("#kasbon").val().replaceAll(".","") == ""){
                kasbon = 0;
            }else{
                kasbon = $("#kasbon").val().replaceAll(".","");
            }
            var total = parseInt($("#gaji_total").val().replaceAll(".",""))-parseInt(kasbon);
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            var bonus = $("#bonus").val().replaceAll(".","");
            if(bonus == ""){
                bonus = 0;
            }
            var gaji_grand_total = parseInt(total)+parseInt(bonus);
            $("#gaji_grand_total").val(rupiah(gaji_grand_total));
        }
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
            return rupiah;
        }
        function cek_jo(){
            if($("#jo").val()==""){
                alert("silakan pilih perjalanan supir");
            }
        }
    </script>