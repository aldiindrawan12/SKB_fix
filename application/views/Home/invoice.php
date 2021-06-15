<div class="container">
    <!-- form invoice -->
    <div class="card shadow mb-2">
        <div class="card-header ">
            <h6 class="m-0 font-weight-bold text-primary">Buat Invoice</h6>
        </div>
        <div class="card-body">
        <form action="<?=base_url("index.php/form/insert_invoice")?>" method="POST">
            <div class="row">
                <div class="col-md-6 border rounded">
                    <div class="form-group">
                        <label for="invoice_tgl" class="form-label font-weight-bold">Tgl.Invoice</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_tgl" name="invoice_tgl" required>
                    </div>          
                    <div class="form-group">
                        <label for="invoice_id" class="form-label font-weight-bold">Invoice Kode</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_id" name="invoice_id" required readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold mr-3" for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control selectpicker col-md-10" data-live-search="true" required onchange="customer()">
                            <option class="font-w700 " disabled="disabled" selected value="">Customer</option>
                            <?php foreach($customer as $value){?>
                                <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="invoice_ppn">PPN</label>
                        <select name="invoice_ppn" id="invoice_ppn" class="form-control col-md-10" required>
                            <option class="font-w700" disabled="disabled" selected value="">PPN</option>
                            <option class="font-w700" value="Ya">Ya</option>
                            <option class="font-w700" value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold " for="invoice_payment">Payment (hari)</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_payment" name="invoice_payment" required onkeyup="hanyaangka(this)">
                    </div>          
                </div>
                <div class="col-md-6 border rounded">
                    <div class="form-group row mt-3">
                        <label for="invoice_tonase" class="col-form-label col-sm-5 font-weight-bold">Total Tonase</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_tonase" name="invoice_tonase" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_total" class="col-form-label col-sm-5 font-weight-bold">Total</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_total" name="invoice_total" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_ppn" class="col-form-label col-sm-5 font-weight-bold">PPN</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_ppn_nilai" name="invoice_ppn_nilai" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_grand_total" class="col-form-label col-sm-5 font-weight-bold">Grand Total</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_grand_total" name="invoice_grand_total" required readonly>
                        </div>
                    </div>
                    <input type="text" id="data_jo" name="data_jo" required hidden>
                    <div class="form-group mt-3">
                        <label for="invoice_keterangan" class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="invoice_keterangan" id="invoice_keterangan" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <button type="submit" class="btn btn-success mt-3">Simpan</button>
                <button type="reset" class="btn btn-danger mt-3" onclick="reset_form()">Reset</button>
            </div>
        </form>
    </div>
    <!-- end form invoice -->
</div>

<!-- table invoice -->
<div class="card shadow mb-5 small">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="pilih-jo" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="" scope="col">ID JO</th>
                        <th class="text-center" width="" scope="col">Tgl.Muat</th>
                        <th class="text-center" width="" scope="col">Tgl.Plng</th>
                        <th class="text-center" width="" scope="col">Nopol</th>
                        <th class="text-center" width="" scope="col">Muatan</th>
                        <th class="text-center" width="" scope="col">Dari</th>
                        <th class="text-center" width="" scope="col">Ke</th>
                        <th class="text-center" width="" scope="col">Tonase</th>
                        <th class="text-center" width="" scope="col">Harga</th>
                        <th class="text-center" width="" scope="col">Total</th>
                        <th class="text-center" width="" scope="col">Pilih</th>
                        <th class="text-center" width="" scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end table invoice -->

<script>
    function customer(){
        var nama_customer = $("#customer_id option:selected").text();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/home/no_invoice') ?>",
            dataType: "text",
            data: {
                customer_name: nama_customer
            },
            success: function(data) {
                var date = new Date();
                if(date.getMonth()<10){
                    $("#invoice_id").val(data+"-"+"SKB"+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
                }else{
                    $("#invoice_id").val(data+"-"+"SKB"+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
                }
            }
        })
    }
    function reset_form(){
        location.reload();
    }
    function hanyaangka(a){
		var charCode = (a.which) ? a.which : event.keyCode;
	   if (charCode > 31 && (charCode < 48 || charCode > 57)){
           alert("Masukkan Hanya Angka Saja dan Tanpa Tanda Baca");
           $("#"+a.id).val("");
       }
    }
</script>