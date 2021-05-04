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
                    <div class="col-md-4 col-md-offset-4 ">
                        <label for="Terbilang" class="form-label font-weight-bold">Terbilang</label>
                        <input autocomplete="off" type="text" class="form-control" id="Terbilang" name="Terbilang" required readonly>
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
                        <label class="form-label font-weight-bold" for="Kosongan">Rute Kosongan</label>
                        <select name="Kosongan" id="Kosongan" class="form-control" required onchange="kosongan(this)">
                            <option class="font-w700" disabled="disabled" selected value="">Rute Kosongan</option>
                            <option class="font-w700" value="Ya">Ya</option>
                            <option class="font-w700" value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-8 col-md-offset-4" >
                        <div style="display:none" id="rute_kosongan_pilih">
                            <label class="form-label font-weight-bold " for="kosongan_id">Rute Kosongan</label>
                            <select name="kosongan_id" value="DESC" id="kosongan_id" class="form-control selectpicker mb-4" data-live-search="true" onchange="set_uj()">
                            <option class="font-w700" selected value="0">Dari - Ke - Uang Jalan</option>
                                <?php foreach($kosongan as $value){?>
                                    <option value="<?=$value["kosongan_id"]?>"><?=$value["kosongan_dari"]?> - <?=$value["kosongan_ke"]?> - Rp.<?= number_format($value["kosongan_uang"],2,",",".")?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label for="uang_jalan_total" class="form-label font-weight-bold">Total Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="uang_jalan_total" name="uang_jalan_total" value=0 readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label for="uang_jalan_bayar" class="form-label font-weight-bold">Uang Jalan Dibayar</label>
                        <input autocomplete="off" type="text" class="form-control" id="uang_jalan_bayar" name="uang_jalan_bayar" required onkeyup="uang_cek(this)">
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
    function uang_cek(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
        var uj = $("#Uang").val().replaceAll(".","");
        var uj_kosongan = 0;
        $.ajax({
            async:false,
            type: "GET",
            url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
            dataType: "JSON",
            data: {
                id: $("#kosongan_id").val()
            },
            success: function(data) { //jika ambil data sukses
                uj_kosongan = data["kosongan_uang"];
            }
        });
        var uang_bayar = $("#uang_jalan_bayar").val().replaceAll(".","");
        if(parseInt(uj)+parseInt(uj_kosongan)<parseInt(uang_bayar)){
            alert('Jumlah Pembayaran UJ Harus Lebih Kecil Dari Rp.'+ rupiah(parseInt(uj)+parseInt(uj_kosongan)));
            $( '#uang_jalan_bayar' ).val("");
        }
    }
    function set_uj(){
        var uj = $("#Uang").val().replaceAll(".","");
        var uj_kosongan = 0;
        $.ajax({
            async:false,
            type: "GET",
            url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
            dataType: "JSON",
            data: {
                id: $("#kosongan_id").val()
            },
            success: function(data) { //jika ambil data sukses
                uj_kosongan = data["kosongan_uang"];
            }
        });
        $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)+parseInt(uj_kosongan)));
    }
    function kosongan(a){
        if($("#"+a.id).val()=="Ya"){
            $("#rute_kosongan_pilih").show();
        }else{
            $("#rute_kosongan_pilih").hide();
        }
    }
</script>