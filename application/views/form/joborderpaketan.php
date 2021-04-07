<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3 ">Buat Job Order (Paketan)</h1>
    </div> 
        <!-- Card Formulir JO -->
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Form Buat Job Order (Paketan)</h6>
            </div>
            <div class="card-body">
                <!-- form Job Order Baru -->
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
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label for="Muatan" class="form-label font-weight-bold ">Muatan</label> 
                        <input autocomplete="off" type="text" class="form-control" name="Muatan" id="Muatan" required readonly>
                        <!-- <select name="Muatan" id="Muatan" class="form-control mb-4" required onchange="muatan()">
                            <option class="font-w700" disabled="disabled" selected value="">Muatan</option>
                        </select> -->
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4 mb-4">
                        <label class="form-label font-weight-bold" for="Asal ">Asal</label>
                        <input autocomplete="off" type="text" class="form-control" name="Asal" id="Asal" required readonly>
                        <!-- <select name="Asal" id="Asal" class="form-control mb-4" required onchange="asal()">
                            <option class="font-w700" disabled="disabled" selected value="">Asal</option>
                        </select> -->
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4 mb-4">
                        <label class="form-label font-weight-bold" for="Tujuan">Tujuan</label>
                        <input autocomplete="off" type="text" class="form-control" name="Tujuan" id="Tujuan" required readonly>
                        <!-- <select name="Tujuan" id="Tujuan" class="form-control mb-4" required onchange="tujuan()">
                            <option class="font-w700" disabled="disabled" selected value="">Tujuan</option>
                        </select> -->
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Jenis">Jenis Mobil</label>
                        <input autocomplete="off" type="text" class="form-control" name="Jenis" id="Jenis" required readonly>
                        <!-- <select name="Jenis" id="Jenis" class="form-control mb-4" required onchange="jenis()">
                            <option class="font-w700 mb-4" disabled="disabled" selected value="">Jenis Mobil</option>
                        </select> -->
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Type_Tonase">Tipe Tonase</label>
                        <input autocomplete="off" type="text" class="form-control" name="Type_Tonase" id="Type_Tonase" required readonly>
                        <!-- <select name="Type_Tonase" id="Type_Tonase" class="form-control" required onchange="tonase()">
                            <option class="font-w700" disabled="disabled" selected value="">Tipe Tonase</option>
                            <option class="font-w700" value="Fix">Fix</option>
                            <option class="font-w700" value="Non-Fix">Non-Fix</option>
                        </select> -->
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4 Tonase">
                        <label class="form-label font-weight-bold" for="Tonase">Tonase</label>
                        <input autocomplete="off" type="text" class="form-control" name="Tonase" id="Tonase" required readonly>
                        <!-- <select name="Tonase" id="Tonase" class="form-control mb-4" onchange="tonase_non_fix()" disabled>
                            <option class="font-w700" disabled="disabled" selected value="">Tonase</option>
                        </select> -->
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Uang" class="form-label font-weight-bold">Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="Uang" name="Uang" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 ">
                        <label for="Terbilang" class="form-label font-weight-bold">Terbilang</label>
                        <input autocomplete="off" type="text" class="form-control" id="Terbilang" name="Terbilang" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label for="uang_jalan_bayar" class="form-label font-weight-bold">Uang Jalan Dibayar</label>
                        <input autocomplete="off" type="text" class="form-control" id="uang_jalan_bayar" name="uang_jalan_bayar" required onkeyup="uang(this)">
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
                            <option class="font-w700" disabled="disabled" selected value="">Tipe Tonase</option>
                            <option class="font-w700" value="Ya">Ya</option>
                            <option class="font-w700" value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-8 col-md-offset-4" style="display:none" id="rute_kosongan_pilih">
                        <label class="form-label font-weight-bold " for="kosongan_id">Rute Kosongan</label>
                        <select name="kosongan_id" value="DESC" id="kosongan_id" class="form-control selectpicker mb-4" data-live-search="true">
                        <option class="font-w700" disabled="disabled" selected value="">Dari - Ke - Uang Jalan</option>
                            <?php foreach($kosongan as $value){?>
                                <option value="<?=$value["kosongan_id"]?>"><?=$value["kosongan_dari"]?> - <?=$value["kosongan_ke"]?> - Rp.<?= number_format($value["kosongan_uang"],2,",",".")?></option>
                            <?php } ?>
                        </select>
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
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
</script>