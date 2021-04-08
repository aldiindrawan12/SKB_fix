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
                            <option class="font-w700" disabled="disabled" selected value="">Rute Kosongan</option>
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
            </div>
        </div>
    </div>
<script>
    function reset_form(){
        location.reload();
    }
    // fungsi form
        // function customer(){ //ketika customer dipilih
        //     var customer_id = $("#Customer").val();
        //     $('#Muatan').find('option').remove().end(); //reset option select
        //     $('#Asal').find('option').remove().end(); //reset option select
        //     $('#Tujuan').find('option').remove().end(); //reset option select
        //     $('#Jenis').find('option').remove().end(); //reset option select
        //     $('#Kendaraan').find('option').remove().end(); //reset option select
        //     $('#Type_Tonase').find('option').remove().end(); //reset option select
        //     $('#Uang').val("");
        //     $('#Terbilang').val("");
        //     var isi_muatan = [];
        //     $.ajax({
        //         type: "GET",
        //         url: "<?php echo base_url('index.php/form/getrutebycustomer/') ?>"+customer_id,
        //         dataType: "JSON",
        //         success: function(data) {
        //             if(data.length==0){
        //                 $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
        //             }else{
        //                 $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Muatan</option>'); 
        //                 for(i=0;i<data.length;i++){
        //                     if(!isi_muatan.includes(data[i]["rute_muatan"])){
        //                         $('#Muatan').append('<option value="'+data[i]["rute_muatan"]+'">'+data[i]["rute_muatan"]+'</option>'); 
        //                         isi_muatan.push(data[i]["rute_muatan"]);
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // }
        // function muatan(){ //ketika customer dipilih
        //     var customer_id = $("#Customer").val();
        //     var muatan = $("#Muatan").val();
        //     $('#Asal').find('option').remove().end(); //reset option select
        //     $('#Tujuan').find('option').remove().end(); //reset option select
        //     $('#Jenis').find('option').remove().end(); //reset option select
        //     $('#Kendaraan').find('option').remove().end(); //reset option select
        //     $('#Type_Tonase').find('option').remove().end(); //reset option select
        //     $('#Uang').val("");
        //     $('#Terbilang').val("");
        //     var isi_asal = [];
        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo base_url('index.php/form/getrutebymuatan') ?>",
        //         dataType: "JSON",
        //         data: {
        //             customer_id: customer_id,
        //             rute_muatan: muatan
        //         },
        //         success: function(data) {
        //             if(data.length==0){
        //                 $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
        //             }else{
        //                 $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Asal</option>'); 
        //                 for(i=0;i<data.length;i++){
        //                     if(!isi_asal.includes(data[i]["rute_dari"])){
        //                         $('#Asal').append('<option value="'+data[i]["rute_dari"]+'">'+data[i]["rute_dari"]+'</option>'); 
        //                         isi_asal.push(data[i]["rute_dari"]);
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // }
        // function asal(){ //ketika customer dipilih
        //     var customer_id = $("#Customer").val();
        //     var muatan = $("#Muatan").val();
        //     var asal = $("#Asal").val();
        //     $('#Tujuan').find('option').remove().end(); //reset option select
        //     $('#Jenis').find('option').remove().end(); //reset option select
        //     $('#Kendaraan').find('option').remove().end(); //reset option select
        //     $('#Type_Tonase').find('option').remove().end(); //reset option select
        //     $('#Uang').val("");
        //     $('#Terbilang').val("");
        //     var isi_tujuan = [];
        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo base_url('index.php/form/getrutebyasal') ?>",
        //         dataType: "JSON",
        //         data: {
        //             customer_id: customer_id,
        //             rute_muatan: muatan,
        //             rute_asal:asal
        //         },
        //         success: function(data) {
        //             // alert(data);
        //             if(data.length==0){
        //                 $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
        //             }else{
        //                 $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Tujuan</option>'); 
        //                 for(i=0;i<data.length;i++){
        //                     if(!isi_tujuan.includes(data[i]["rute_ke"])){
        //                         $('#Tujuan').append('<option value="'+data[i]["rute_ke"]+'">'+data[i]["rute_ke"]+'</option>'); 
        //                         isi_tujuan.push(data[i]["rute_ke"]);
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // }
        // function tujuan(){
        //     $('#Jenis').find('option').remove().end(); //reset option select
        //     $('#Kendaraan').find('option').remove().end(); //reset option select
        //     $('#Type_Tonase').find('option').remove().end(); //reset option select
        //     $('#Uang').val("");
        //     $('#Terbilang').val("");
        //     $('#Jenis').append('<option class="font-w700" disabled="disabled" selected value="">Jenis Mobil</option>'); 
        //     $("#Jenis").append('<option value="Sedang(Engkel)">Sedang(Engkel)</option>'+
        //                         '<option value="Besar(Tronton)">Besar(Tronton)</option>');
        // }
        // function jenis(){ //ketika jenis mobil dipilih
        //     var mobil_jenis = $("#Jenis").val();
        //     var customer_id = $("#Customer").val();
        //     var muatan = $("#Muatan").val();
        //     var asal = $("#Asal").val();
        //     var ke = $("#Tujuan").val();
        //     var tipe_tonase = $("#Type_Tonase").val();
        //     var tonase = 0;
        //     if(tipe_tonase=="Non-Fix"){
        //         tonase=$("#Tonase").val();
        //     }
        //     $('#Kendaraan').find('option').remove().end(); //reset option select
        //     $('#Type_Tonase').find('option').remove().end(); //reset option select
        //     $("#Uang").val("");
        //     $("#Terbilang").val("");
        //     $.ajax({ //ajax set option kendaraan
        //         type: "POST",
        //         url: "<?php echo base_url('index.php/form/getmobilbyjenis') ?>",
        //         dataType: "JSON",
        //         data: {
        //             mobil_jenis: mobil_jenis,
        //         },
        //         success: function(data) {
        //             if(data.length==0){
        //                 $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
        //             }else{
        //                 $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kendaraan Pengiriman</option>'); 
        //                 for(i=0;i<data.length;i++){
        //                         $('#Kendaraan').append('<option value="'+data[i]["mobil_no"]+'">'+data[i]["mobil_no"]+'  ||  '+data[i]["mobil_max_load"]+' Ton  ||  '+data[i]["mobil_jenis"]+'</option>'); 
        //                 }
        //             }
        //         }
        //     });
        //     $('#Type_Tonase').find('option').remove().end(); //reset option select
        //     $('#Type_Tonase').append('<option class="font-w700" disabled="disabled" selected value="">Tipe Tonase</option>'); 
        //     $("#Type_Tonase").append('<option value="Fix">Fix</option>'+
        //                         '<option value="Non-Fix">Non-Fix</option>');
        // }
        // function tonase(){ //ketika jenis tonase dipilih
        //     var mobil_jenis = $("#Jenis").val();
        //     var customer_id = $("#Customer").val();
        //     var muatan = $("#Muatan").val();
        //     var asal = $("#Asal").val();
        //     var ke = $("#Tujuan").val();
        //     var tonase = 0;
        //     $("#Upah").val("");
        //     $("#Uang").val("");
        //     $("#Terbilang").val("");
        //     if($("#Type_Tonase").val()=="Non-Fix"){
        //         $('.Tonase').find('option').remove().end(); //reset option select
        //         $('#Tonase').removeAttr("disabled");
        //         $('#Uang').val("");
        //         $('#Terbilang').val("");
        //         $.ajax({
        //             type: "POST",
        //             url: "<?php echo base_url('index.php/form/getrutetonase') ?>",
        //             dataType: "JSON",
        //             data: {
        //                 customer_id: customer_id,
        //                 rute_muatan: muatan,
        //                 rute_asal:asal,
        //                 rute_ke:ke
        //             },
        //             success: function(data) {
        //                 $('.Tonase').attr('required','true');
        //                 if(data.length==0){
        //                     $('#Tonase').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
        //                 }else{
        //                     $('#Tonase').append('<option class="font-w700" disabled="disabled" selected value="">Tonase</option>'); 
        //                     for(i=0;i<data.length;i++){
        //                             $('#Tonase').append('<option value="'+data[i]["rute_tonase"]+'">'+data[i]["rute_tonase"]+'</option>'); 
        //                     }
        //                 }
        //             }
        //         });
        //     }else if($("#Type_Tonase").val()=="Fix"){
        //         $('.Tonase').find('option').remove().end(); //reset option select
        //         $('#Tonase').attr("disabled","true");
        //         $.ajax({
        //             type: "POST",
        //             url: "<?php echo base_url('index.php/form/getrutefix') ?>",
        //             dataType: "JSON",
        //             data: {
        //                 customer_id: customer_id,
        //                 rute_muatan: muatan,
        //                 rute_asal:asal,
        //                 rute_ke:ke,
        //                 mobil_jenis:mobil_jenis,
        //                 rute_tonase:tonase
        //             },
        //             success: function(data) {
        //                 var uang = "";
        //                 if(mobil_jenis=="Sedang(Engkel)"){
        //                     $("#Upah").val(rupiah(data["rute_gaji_engkel"]));
        //                     $("#Uang").val(rupiah(data["rute_uj_engkel"]));
        //                     $("#Tagihan").val(rupiah(data["rute_tagihan"]));
        //                     uang = rupiah(data["rute_uj_engkel"]);
        //                 }else{
        //                     $("#Upah").val(rupiah(data["rute_gaji_tronton"]));
        //                     $("#Uang").val(rupiah(data["rute_uj_tronton"]));
        //                     $("#Tagihan").val(rupiah(data["rute_tagihan"]));
        //                     uang = rupiah(data["rute_uj_tronton"]);
        //                 }
        //                 $.ajax({
        //                     type: "GET",
        //                     url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+uang,
        //                     dataType: "text",
        //                     success: function(data) {
        //                         $('#Terbilang').val(data);
        //                     }
        //                 });
        //             }
        //         });
        //     }
        // }
        // function tonase_non_fix(){
        //     var mobil_jenis = $("#Jenis").val();
        //     var customer_id = $("#Customer").val();
        //     var muatan = $("#Muatan").val();
        //     var asal = $("#Asal").val();
        //     var ke = $("#Tujuan").val();
        //     var tonase = $("#Tonase").val();
        //         $.ajax({
        //             type: "POST",
        //             url: "<?php echo base_url('index.php/form/getrutefix') ?>",
        //             dataType: "JSON",
        //             data: {
        //                 customer_id: customer_id,
        //                 rute_muatan: muatan,
        //                 rute_asal:asal,
        //                 rute_ke:ke,
        //                 mobil_jenis:mobil_jenis,
        //                 rute_tonase:tonase
        //             },
        //             success: function(data) {
        //                 var uang = "";
        //                 if(mobil_jenis=="Sedang(Engkel)"){
        //                     $("#Upah").val(rupiah(data["rute_gaji_engkel_rumusan"]));
        //                     $("#Uang").val(rupiah(data["rute_uj_engkel"]));
        //                     $("#Tagihan").val(rupiah(data["rute_tagihan"]));
        //                     uang = rupiah(data["rute_uj_engkel"]);
        //                 }else{
        //                     $("#Upah").val(rupiah(data["rute_gaji_tronton_rumusan"]));
        //                     $("#Uang").val(rupiah(data["rute_uj_tronton"]));
        //                     $("#Tagihan").val(rupiah(data["rute_tagihan"]));
        //                     uang = rupiah(data["rute_uj_tronton"]);
        //                 }
        //                 $.ajax({
        //                     type: "GET",
        //                     url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+uang,
        //                     dataType: "text",
        //                     success: function(data) {
        //                         $('#Terbilang').val(data);
        //                     }
        //                 });
        //             }
        //         });
        // }
    // fungsi form
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
    function kosongan(a){
        if($("#"+a.id).val()=="Ya"){
            $("#rute_kosongan_pilih").show();
        }else{
            $("#rute_kosongan_pilih").hide();
        }
    }
</script>