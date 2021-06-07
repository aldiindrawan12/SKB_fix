<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3 ">Buat Job Order (Reguler)</h1>
    </div> 
        <!-- Card Formulir JO -->
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Form Buat Job Order (Reguler)</h6>
            </div>
            <div class="card-body">
                <!-- form Job Order Baru -->
                <small>Pilih Rute Yang Tersedia Pada Tabel Rute Dibawah</small>
                <form action="<?=base_url("index.php/form/insert_JO")?>" method="POST" class="row">
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold " for="Customer">Customer</label>
                        <select name="Customer" value="DESC" id="Customer" class="form-control selectpicker mb-4" data-live-search="true" required onchange="customer()">
                            <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                            <?php foreach($customer as $value){?>
                                <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="Table-Pilih-Rute" width="100%" cellspacing="0">
                            <thead>
                                <tr>    
                                    <th class="text-center" scope="col">Customer</th>
                                    <th class="text-center" scope="col">Muatan</th>
                                    <th class="text-center" scope="col">Dari</th>
                                    <th class="text-center" scope="col">Ke</th>
                                    <th class="text-center" scope="col">Jenis Mobil</th>
                                    <th class="text-center" scope="col">Type Tonase</th>
                                    <th class="text-center" scope="col">Tonase</th>
                                    <th class="text-center" width="15%" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label for="Muatan" class="form-label font-weight-bold ">Muatan</label> 
                        <input autocomplete="off" type="text" class="form-control" name="Muatan" id="Muatan" required readonly>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4 mb-4">
                        <label class="form-label font-weight-bold" for="Asal ">Asal</label>
                        <input autocomplete="off" type="text" class="form-control" name="Asal" id="Asal" required readonly>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4 mb-4">
                        <label class="form-label font-weight-bold" for="Tujuan">Tujuan</label>
                        <input autocomplete="off" type="text" class="form-control" name="Tujuan" id="Tujuan" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Jenis">Jenis Mobil</label>
                        <input autocomplete="off" type="text" class="form-control" name="Jenis" id="Jenis" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Type_Tonase">Tipe Tonase</label>
                        <input autocomplete="off" type="text" class="form-control" name="Type_Tonase" id="Type_Tonase" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4 Tonase">
                        <label class="form-label font-weight-bold" for="Tonase">Tonase</label>
                        <input autocomplete="off" type="text" class="form-control" name="Tonase" id="Tonase" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Uang" class="form-label font-weight-bold">Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="Uang" name="Uang" value=0 required readonly>
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label for="tanggal_jo" class="form-label font-weight-bold">Tanggal</label>
                        <input autocomplete="off" type="text" class="form-control" id="tanggal_jo" name="tanggal_jo" required onclick="tanggal_berlaku(this)">
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Supir">Supir</label>
                        <select name="Supir" id="Supir" class="form-control selectpicker mb-4" data-live-search="true" required>
                            <option class="font-w700 mb-4" disabled="disabled" selected value="">Supir Pengiriman</option>
                            <?php foreach($supir as $value){
                                if($value["status_jalan"]!="Jalan"){?>
                                <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold " for="Kendaraan">Kendaraan</label>
                        <select name="Kendaraan" id="Kendaraan" class="form-control mb-4" required>
                            <option class="font-w700 font-weight-bold mb-4" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 ">
                        <label for="Keterangan" class="form-label font-weight-bold">Keterangan/Catatan</label>
                        <textarea class="form-control" name="Keterangan" id="Keterangan" rows="3"></textarea>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="jenis_tambahan">Tambahan/Potongan UJ</label>
                        <select name="jenis_tambahan" id="jenis_tambahan" class="form-control" onchange="tambahan(this)">
                            <option class="font-w700" disabled="disabled" selected value="">Tambahan/Potongan UJ</option>
                            <option class="font-w700" value="Tidak Ada">Tidak Ada</option>
                            <option class="font-w700" value="Tambahan">Tambahan</option>
                            <option class="font-w700" value="Potongan">Potongan</option>
                        </select>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        <div style="display:none" id="nominal_tambahan_id">
                            <label for="nominal_tambahan" class="form-label font-weight-bold">Nominal Tambahan/Potongan UJ</label>
                            <input autocomplete="off" type="text" class="form-control" id="nominal_tambahan" name="nominal_tambahan" onkeyup="set_uj(this),uang_format(this)">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label for="uang_jalan_total" class="form-label font-weight-bold">Total Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="uang_jalan_total" name="uang_jalan_total" value=0 readonly>
                    </div>
                    <input autocomplete="off" type="text" class="form-control" id="Upah" name="Upah" required hidden>
                    <input autocomplete="off" type="text" class="form-control" id="Tagihan" name="Tagihan" required hidden>
                    <div class="col-md-12 col-md-offset-4 ">
                        <button type="submit" class="btn btn-success ml-3 mt-5 float-md-right">Simpan dan Cetak</button>
                        <button type="reset" class="btn btn-outline-danger mb-3 mt-5  float-md-right" onclick="reset_form()">Reset</button>
                    </div>
                </form>
                <!-- end form Job Order Baru -->
            </div>
        </div>
    </div>
<script>
    function reset_form(){
        location.reload();
    }
    function uang_format(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
    // function uang_cek(a){
    //     $( '#'+a.id ).mask('000.000.000', {reverse: true});
    //     var uj = $("#Uang").val().replaceAll(".","");
    //     var uj_tambahan = $("#nominal_tambahan").val().replaceAll(".","");
    //     var uang_bayar = $("#uang_jalan_bayar").val().replaceAll(".","");
    //     if(parseInt(uj)+parseInt(uj_tambahan)<parseInt(uang_bayar)){
    //         alert('Jumlah Pembayaran UJ Harus Lebih Kecil Dari Rp.'+ rupiah(parseInt(uj)+parseInt(uj_kosongan)));
    //         $( '#uang_jalan_bayar' ).val("");
    //     }
    //     alert(parseInt(uj)+parseInt(uj_tambahan)+"=="+parseInt(uang_bayar))
    // }
    function set_uj(){
        var uj = $("#Uang").val().replaceAll(".","");
        var uj_tambahan = $("#nominal_tambahan").val().replaceAll(".","");
        if(uj_tambahan==""){
            uj_tambahan = 0;
        }
        if($("#jenis_tambahan").val()=="Potongan"){
            if(parseInt(uj)<parseInt(uj_tambahan)){
                alert("Potongan Tidak boleh Lebih Dari Rp."+rupiah(uj));
                $("#nominal_tambahan").val("");
                $( '#uang_jalan_total' ).val(rupiah(uj));
            }else{
                $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
            }
        }else if($("#jenis_tambahan").val()=="Tambahan"){
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
        }else{
            $("#nominal_tambahan").val(0);
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)));
        }
    }
    function tambahan(a){
        var uj = $("#Uang").val().replaceAll(".","");
        var uj_tambahan = $("#nominal_tambahan").val().replaceAll(".","");
        if(uj_tambahan==""){
            uj_tambahan = 0;
        }
        if($("#"+a.id).val()!="Tidak Ada"){
            $("#nominal_tambahan_id").show();  
        }else{
            $("#nominal_tambahan_id").hide();
        }

        if($("#"+a.id).val()=="Potongan"){
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
        }else{
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
        }
    }
</script>