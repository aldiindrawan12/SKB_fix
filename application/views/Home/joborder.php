<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Seluruh Data Job Order</h6>
        </div>
        <!-- tabel JO -->
        <div class="card-body">
            <div class="conatiner w-50 m-auto">
                <div class="mb-2 form-group row">
                    <label for="Status" class="form-label font-weight-bold col-md-3">Status</label>
                    <select name="Status" id="Status" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Status</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                        <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                        <option value="Sampai Tujuan">Sampai Tujuan</option>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Supir">Supir</label>
                    <select name="Supir" id="Supir" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Supir Pengiriman</option>
                        <?php foreach($supir as $value){?>
                            <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Kendaraan">Kendaraan</label>
                    <select name="Kendaraan" id="Kendaraan" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                        <?php foreach($mobil as $value){?>
                                <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Jenis">Jenis Mobil</label>
                    <select name="Jenis" id="Jenis" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Jenis Mobil</option>
                        <?php $isi_jenis = array();
                            foreach($mobil as $value){
                            if(!in_array($value["mobil_jenis"],$isi_jenis)){
                                array_push($isi_jenis[] = $value["mobil_jenis"]);
                            }
                        }?>
                        <?php for($i=0;$i<count($isi_jenis);$i++){?>
                            <option value="<?= $isi_jenis[$i]?>"><?= $isi_jenis[$i]?></option>
                        <?php }?>
                    </select>
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
                    <label for="Tanggal" class="form-label font-weight-bold col-md-3">Tanggal JO</label>
                    <input autocomplete="off" type="text" class="form-control col-md-4 mr-4" id="Tanggal1" name="Tanggal1" onclick="tanggal_berlaku(this)">
                    <input autocomplete="off" type="text" class="form-control col-md-4" id="Tanggal2" name="Tanggal2" onclick="tanggal_berlaku(this)">
                </div>
                <div class="mb-2 form-group row">
                    <label for="Jo_id" class="form-label font-weight-bold col-md-3">ID JO</label>
                    <input autocomplete="off" type="text" class="form-control col-md-9" id="Jo_id" name="Jo_id">
                </div>
                <div class="mb-2 form-group text-center">
                    <button class="btn btn-primary" id="btn-cari">Cari</button>
                    <button class="btn btn-danger" onclick="reset_form()">Reset</button>
                </div>
            </div>
            <hr>
            <div class="container">
                <span>Total Data JO Yang Ditemukan : </span><span id="ditemukan"><?= count($jo)?></span>
            </div>
            <hr>
            <div class="container">
                    <form method="POST" action="<?= base_url("index.php/print_berkas/jo_excel_data/")?>" id="convert_form" class="col-md-2 float-right">
                        <input type="hidden" name="file_content" id="file_content">
                        <button type="submit" name="convert" id="convert" class="btn btn-primary btn-sm btn-icon-split">
                            <span class="icon text-white-100">  
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">Excel</span>
                        </button>
                    </form>
                    <button class="btn btn-primary btn-sm float-right mr-3" onclick="pdf()">Print/Export PDF</button>
                </div>
            <div class="table-responsive thead-dark small" id="print_jo">
                <table class="table table-bordered  small" id="Table-Job-Order" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  class="text-center" scope="col">No JO</th>
                            <th class="text-center" scope="col">Tanggal</th>
                            <th  scope="col">Status</th>
                            <th class="text-center" scope="col">Driver</th>
                            <th class="text-center" scope="col">No Pol</th>
                            <th class="text-center" scope="col">Jenis Mobil</th>
                            <th  class="text-center" scope="col">Customer</th>
                            <th  class="text-center" scope="col">Muatan</th>
                            <th  class="text-center" scope="col">Dari</th>
                            <th  class="text-center" scope="col">Ke</th>
                            <th class="text-center" scope="col">Total UJ</th>
                            <th class="text-center" scope="col">Sisa UJ</th>
                            <th class="text-center" scope="col">Biaya Lain</th>
                            <th class="text-center" scope="col">Payment</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end tabel JO -->
    </div>
</div>
<div class="modal fade" id="popup-update-jo" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Data Job Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?=base_url("index.php/form/update_JO")?>" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="Jo_id_update" class="form-label font-weight-bold">ID Job Order(JO)</label>
                                <input autocomplete="off" type="text" class="form-control" id="Jo_id_update" name="Jo_id_update" required value="<?= "Asd"?>" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal_jo_update" class="form-label font-weight-bold">Tanggal</label>
                                <input autocomplete="off" type="text" class="form-control" id="tanggal_jo_update" name="tanggal_jo_update" required onclick="tanggal_berlaku(this)">
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold " for="Customer_update">Customer</label>
                                <input type="text" name="Customer_update" id="Customer_update" class="form-control" required readonly>
                            </div>
                            <div class="mb-4">
                                <label for="Muatan" class="form-label font-weight-bold ">Muatan</label> 
                                <input type="text" name="Muatan" id="Muatan" class="form-control" required readonly>
                            </div>
                            <div class="mb-4 mb-4">
                                <label class="form-label font-weight-bold" for="Asal ">Asal</label>
                                <input type="text" name="Asal" id="Asal" class="form-control" required readonly>
                            </div>
                            <div class="mb-4 mb-4">
                                <label class="form-label font-weight-bold" for="Tujuan">Tujuan</label>
                                <input type="text" name="Tujuan" id="Tujuan" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label font-weight-bold" for="Supir_update">Supir <small>(Supir Saat Ini : <span id="Supir_now"></span>)</small></label>
                                <select name="Supir_update" id="Supir_update" class="form-control selectpicker" data-live-search="true">
                                    <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Supir Pengiriman</option>
                                    <?php foreach($supir as $value){?>
                                            <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold " for="Kendaraan_update">Kendaraan <small>(Kendaraan Saat Ini : <span id="Kendaraan_now"></span>)</small></label>
                                <select name="Kendaraan_update" id="Kendaraan_update" class="form-control  selectpicker" data-live-search="true" onchange="set_jenis_mobil(this)">
                                    <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                                    <?php foreach($mobil as $value){?>
                                            <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold" for="Jenis_update">Jenis Mobil</label>
                                <input autocomplete="off" type="text" class="form-control" name="Jenis_update" id="Jenis_update" required readonly>
                            </div>
                            <div class="mb-4">
                                <label for="Uang_update" class="form-label font-weight-bold">Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="Uang_update" name="Uang_update" value=0 required readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold" for="jenis_tambahan_update">Tambahan/Potongan UJ</label>
                                <select name="jenis_tambahan_update" id="jenis_tambahan_update" class="form-control" onchange="tambahan(this)">
                                    <option class="font-w700" disabled="disabled" selected value="">Tambahan/Potongan UJ</option>
                                    <option class="font-w700" value="Tidak Ada">Tidak Ada</option>
                                    <option class="font-w700" value="Tambahan">Tambahan</option>
                                    <option class="font-w700" value="Potongan">Potongan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <div id="nominal_tambahan_id">
                                    <label for="nominal_tambahan_update" class="form-label font-weight-bold">Nominal Tambahan/Potongan UJ</label>
                                    <input autocomplete="off" type="text" class="form-control" id="nominal_tambahan_update" name="nominal_tambahan_update" onkeyup="set_uj_tambahan(this),uang_format(this)">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="uang_jalan_total_update" class="form-label font-weight-bold">Total Uang Jalan</label>
                                <input autocomplete="off" type="text" class="form-control" id="uang_jalan_total_update" name="uang_jalan_total_update" value=0 readonly>
                            </div>
                            <input autocomplete="off" type="text" class="form-control" id="Upah_update" name="Upah_update" readonly hidden>
                            <input autocomplete="off" type="text" class="form-control" id="Tagihan_update" name="Tagihan_update" readonly hidden>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                               <label for="status_update" class="form-label">Status Saat Ini</label>
                                <select name="status_update" id="status_update" class="form-control custom-select " required>
                                    <option class="font-w700" disabled="disabled" selected value="">Status JO</option>
                                    <option value="Sampai Tujuan">Sampai Tujuan</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                    <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="tgl_muat_update" class="form-label">Tanggal Muat</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tgl_muat_update" id="tgl_muat_update" onclick="tanggal_berlaku(this)">    
                                </div>
                                <div class="form-group">
                                    <label for="tgl_bongkar_update" class="form-label">Tanggal Bongkar</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tgl_bongkar_update" id="tgl_bongkar_update" onclick="tanggal_berlaku(this)">    
                                </div>
                                <div class="form-group">
                                    <label for="tonase_update" class="form-label">Muatan akhir (Tonase)</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tonase_update" id="tonase_update" onkeyup="uang()">    
                                </div>
                                <div class="form-group">
                                    <label for="biaya_lain_update" class="form-label">Biaya Lain</label>
                                    <input autocomplete="off" class="form-control" type="text" name="biaya_lain_update" id="biaya_lain_update" onkeyup="uang()">    
                                </div>
                            <div class="mb-4">
                                <label for="Keterangan_update" class="form-label font-weight-bold">Keterangan/Catatan</label>
                                <textarea class="form-control" name="Keterangan_update" id="Keterangan_update" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success ml-3 mt-5 float-md-right">Simpan dan Cetak</button>
                        <button type="reset" class="btn btn-outline-danger mb-3 mt-5  float-md-right" onclick="reset_form()">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#convert').click(function() {
            var table_content = '<table>';
            table_content += $("head").html()+$('#Table-Job-Order').html();
            table_content += '</table>';
            $('#file_content').val(table_content);
            $('#convert_form').html();
        });
    });
    function pdf(){
        var tabel = document.getElementById("Table-Job-Order").rows;
        var bacabaris = tabel.length;
        for(var i=0;i<bacabaris;i++){
            tabel[i].deleteCell(-1);
            tabel[i].deleteCell(-1);
        }
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('print_jo').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script>
    function reset_form(){
        location.reload();
    }
    function set_jenis_mobil(a){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/form/getmobilbyno') ?>",
            dataType: "JSON",
            data: {
                mobil_no: $("#"+a.id).val(),
            },
            success: function(data) {
                $("#Jenis_update").val(data["mobil_jenis"]);
            }
        });
    }
    function uang_format(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
    function set_uj_tambahan(){
        var uj = $("#Uang_update").val().replaceAll(".","");
        var uj_tambahan = $("#nominal_tambahan_update").val().replaceAll(".","");
        if(uj_tambahan==""){
            uj_tambahan = 0;
        }
        if($("#jenis_tambahan_update").val()=="Potongan"){
            if(parseInt(uj)<parseInt(uj_tambahan)){
                alert("Potongan Tidak boleh Lebih Dari Rp."+rupiah(uj));
                $("#nominal_tambahan_update").val("");
                $( '#uang_jalan_total_update' ).val(rupiah(uj));
            }else{
                $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
            }
        }else if($("#jenis_tambahan_update").val()=="Tambahan"){
            $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
        }else{
            $("#nominal_tambahan_update").val(0);
            $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)));
        }
    }
    function tambahan(a){
        var uj = $("#Uang_update").val().replaceAll(".","");
        var uj_tambahan = $("#nominal_tambahan_update").val().replaceAll(".","");
        if(uj_tambahan==""){
            uj_tambahan = 0;
        }

        if($("#"+a.id).val()=="Potongan"){
            $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
        }else{
            $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
        }
    }
</script>

