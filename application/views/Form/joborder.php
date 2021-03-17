<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Formulir Job Order</h1>
            <a href="<?=base_url("index.php/form/joborder/x")?>" class="btn btn-secondary btn-icon-split" data-toggle='modal' data-target='#popup-customer'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
                <span class="text">
                     Tambah Customer Baru
                </span>
            </a>
    </div> 
        <!-- Card Formulir JO -->
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Form Buat Job Order</h6>
            </div>
            <div class="card-body">
                <!-- form Job Order Baru -->
                <form action="<?=base_url("index.php/form/insert_JO")?>" method="POST" class="row">
                    <div class="col-md-3 col-md-offset-4">
                        <label class="form-label font-weight-bold " for="Customer">Customer</label>
                        <select name="Customer" id="Customer" class="form-control selectpicker mb-4" data-live-search="true" required onchange="customer()">
                            <?php if(count($customer_by_name)==0){?>
                                <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                            <?php }else{?>
                                <option class="font-w700" selected value="<?=$customer_by_name["customer_id"]?>"><?=$customer_by_name["customer_name"]?></option>
                            <?php }?>
                            <?php foreach($customer as $value){?>
                                <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-md-offset-4">
                        <label for="Muatan" class="form-label font-weight-bold ">Muatan</label> 
                        <select name="Muatan" id="Muatan" class="form-control mb-4" required onchange="muatan()">
                            <option class="font-w700" disabled="disabled" selected value="">Muatan</option>
                        </select>
                        <!-- <input autocomplete="off" type="text" class="form-control mb-4" id="Muatan" name="Muatan" required> -->
                    </div>
                    
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Asal ">Asal</label>
                        <select name="Asal" id="Asal" class="form-control mb-4" required onchange="asal()">
                            <option class="font-w700" disabled="disabled" selected value="">Asal</option>
                        </select>
                        <!-- <input autocomplete="off" type="text" class="form-control" id="Asal" name="Asal" required> -->
                    </div>
                    <div class="col-md-3 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Tujuan">Tujuan</label>
                        <select name="Tujuan" id="Tujuan" class="form-control mb-4" required onchange="tujuan()">
                            <option class="font-w700" disabled="disabled" selected value="">Tujuan</option>
                        </select>
                        <!-- <input autocomplete="off" type="text" class="form-control" id="Tujuan" name="Tujuan" required> -->
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
                        <label class="form-label font-weight-bold" for="Jenis">Jenis Mobil</label>
                        <select name="Jenis" id="Jenis" class="form-control mb-4" required onchange="jenis()">
                            <option class="font-w700 mb-4" disabled="disabled" selected value="">Jenis Mobil</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold " for="Kendaraan">Kendaraan</label>
                        <select name="Kendaraan" id="Kendaraan" class="form-control mb-4" required>
                            <option class="font-w700 font-weight-bold mb-4" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Uang" class="form-label font-weight-bold">Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control" id="Uang" name="Uang" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Terbilang" class="form-label font-weight-bold">Terbilang</label>
                        <input autocomplete="off" type="text" class="form-control" id="Terbilang" name="Terbilang" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label for="Keterangan" class="form-label font-weight-bold">Keterangan/Catatan</label>
                        <textarea class="form-control" name="Keterangan" id="Keterangan" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-md-offset-4 mt-5">
                        <button type="submit" class="btn btn-success ml-3 mt-5 float-md-right">Simpan dan Cetak</button>
                        <button type="reset" class="btn btn-outline-danger mb-3 mt-5  float-md-right" onclick="reset_form()">Reset</button>
                    </div>
                </form>
            <!-- end form Job Order Baru -->
            </div>
        </div>
    </div>

<!-- pop up add cutomer -->
<div class="modal fade mt-5 px-5 py-5" id="popup-customer" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold mt-2">Menambah Customer Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/insert_customer")?>" method="POST">
                    <div class="form-group">
                        <label for="Customer" class="form-label">Nama Customer</label>
                        <input autocomplete="off" type="text" class="form-control" id="Customer" name="Customer" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add cutomer -->

<script>
    function reset_form(){
        location.reload();
    }

    function customer(){ //ketika customer dipilih
        var customer_id = $("#Customer").val();
        $('#Muatan').find('option').remove().end(); //reset option select
        var isi_muatan = [];
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/form/getrutebycustomer/') ?>"+customer_id,
            dataType: "JSON",
            success: function(data) {
                if(data.length==0){
                    $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Muatan</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_muatan.includes(data[i]["rute_muatan"])){
                            $('#Muatan').append('<option value="'+data[i]["rute_muatan"]+'">'+data[i]["rute_muatan"]+'</option>'); 
                            isi_muatan.push(data[i]["rute_muatan"]);
                        }
                    }
                }
            }
        });
    }

    function muatan(){ //ketika customer dipilih
        var customer_id = $("#Customer").val();
        var muatan = $("#Muatan").val();
        $('#Asal').find('option').remove().end(); //reset option select
        var isi_asal = [];
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebymuatan') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                rute_muatan: muatan
            },
            success: function(data) {
                // alert(data);
                if(data.length==0){
                    $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Asal</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_asal.includes(data[i]["rute_dari"])){
                            $('#Asal').append('<option value="'+data[i]["rute_dari"]+'">'+data[i]["rute_dari"]+'</option>'); 
                            isi_asal.push(data[i]["rute_dari"]);
                        }
                    }
                }
            }
        });
    }

    function asal(){ //ketika customer dipilih
        var customer_id = $("#Customer").val();
        var muatan = $("#Muatan").val();
        var asal = $("#Asal").val();
        $('#Tujuan').find('option').remove().end(); //reset option select
        var isi_tujuan = [];
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebyasal') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                rute_muatan: muatan,
                rute_asal:asal
            },
            success: function(data) {
                // alert(data);
                if(data.length==0){
                    $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Tujuan</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_tujuan.includes(data[i]["rute_ke"])){
                            $('#Tujuan').append('<option value="'+data[i]["rute_ke"]+'">'+data[i]["rute_ke"]+'</option>'); 
                            isi_tujuan.push(data[i]["rute_ke"]);
                        }
                    }
                }
            }
        });
    }

    function tujuan(){
        $("#Jenis").append('<option value="Sedang(Engkel)">Sedang(Engkel)</option>'+
                            '<option value="Besar(Tronton)">Besar(Tronton)</option>');
    }
    function jenis(){ //ketika customer dipilih
        var mobil_jenis = $("#Jenis").val();
        var customer_id = $("#Customer").val();
        var muatan = $("#Muatan").val();
        var asal = $("#Asal").val();
        var ke = $("#Tujuan").val();
        $.ajax({
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
                    // $('#Kendaraan').append('<option class="font-w700" disabled="disabled" selected value="">Kendaraan Pengiriman</option>'); 
                    for(i=0;i<data.length;i++){
                            $('#Kendaraan').append('<option value="'+data[i]["mobil_no"]+'">'+data[i]["mobil_no"]+'  ||  '+data[i]["mobil_max_load"]+' Ton  ||  '+data[i]["mobil_jenis"]+'</option>'); 
                    }
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutefix') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                rute_muatan: muatan,
                rute_asal:asal,
                rute_ke:ke,
                mobil_jenis:mobil_jenis
            },
            success: function(data) {
                var uang = "";
                if(mobil_jenis=="Sedang(Engkel)"){
                    $("#Uang").val(rupiah(data["rute_uj_engkel"]));
                    uang = rupiah(data["rute_uj_engkel"]);
                }else{
                    $("#Uang").val(rupiah(data["rute_uj_tronton"]));
                    uang = rupiah(data["rute_uj_tronton"]);
                }
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+uang,
                    dataType: "text",
                    success: function(data) {
                        $('#Terbilang').val(data);
                    }
                });
            }
        });
    }
</script>