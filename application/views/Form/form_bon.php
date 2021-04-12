<!-- Basic Card Example -->
    <div class="card shadow mb-4 ml-5 mr-5 py-2 px-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Transaksi BON</h6>
        </div>
        <div class="card-body">
            <!-- form transaksi bon -->
            <div class="container">
                <form action="<?=base_url("index.php/form/insert_bon")?>" method="POST" class="row">
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Supir_bon">Supir</label>
                        <select name="Supir_bon" id="Supir_bon" class="form-control selectpicker" data-live-search="true" required onchange="bon_user()">
                            <option class="font-w700" disabled="disabled" selected value="">Supir Pengiriman</option>
                            <?php foreach($supir as $value){ ?>
                                <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                    <label for="" class="form-label font-weight-bold">Bon Hutang Saat Ini</label>
                        <input autocomplete="off" type="text" class="form-control" id="bon-saat-ini-tampilan" name="" disabled>
                        <input autocomplete="off" type="text" class="form-control" id="bon-saat-ini" name="" required hidden>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                    <label class="form-label font-weight-bold" for="Jenis">Jenis Transaksi</label>
                        <select name="Jenis" id="Jenis" class="form-control custom-select" required onchange="nominal()">
                            <option class="font-w700" disabled="disabled" selected value="">Jenis Transaksi</option>
                            <option value="Pengajuan">Pengajuan</option>
                            <option value="Pembayaran">Pembayaran</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                    <label for="Nominal" class="form-label font-weight-bold">Nominal</label>
                        <input autocomplete="off" type="text" class="form-control" id="Nominal" name="Nominal" required onkeyup="nominal()">
                    </div>
                    <div class="col-md-8 mb-4 ">
                        <label for="Keterangan" class="form-label font-weight-bold">Keterangan/Catatan</label>
                        <textarea class="form-control" name="Keterangan" id="Keterangan" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-md-offset-4 mt-5 ">
                        <button type="submit" class="btn btn-success mb-3 ml-3 float-right">Simpan</button>    
                        <button type="reset" class="btn btn-outline-danger mb-3 float-right">Reset</button> 
                    </div>
                </form>
            </div>
            <!-- end form transaksi bon -->
        </div>
    </div>
    </div>
    





<script>
    function nominal(){
        $( '#Nominal' ).mask('000.000.000', {reverse: true})
        uang = $( '#Nominal' ).val().split('.');
        uang_fix = ""
        for(i=0;i<uang.length;i++){
            uang_fix = uang_fix+uang[i];
        }
        // alert(uang_fix);
        if($("#Jenis").val()=='Pembayaran'){
            if(parseInt(uang_fix)>parseInt($("#bon-saat-ini").val())){
                alert('Jumlah Pembayaran Harus Lebih Kecil Dari Rp.'+ rupiah($("#bon-saat-ini").val()));
                $( '#Nominal' ).val("");
            }
        }
    }
    function bon_user(){
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/form/getbonsupir') ?>",
            dataType: "text",
            data:{
                id:$("#Supir_bon").val()
            },
            success: function(data) {
                $("#bon-saat-ini-tampilan").attr('placeholder','Rp.'+rupiah(data));
                $("#bon-saat-ini").val(data);
                nominal();
            }
        });
    }
</script>