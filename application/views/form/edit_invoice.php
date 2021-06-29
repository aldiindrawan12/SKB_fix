<?php
    function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }
    $jo = "";
    for($i=0;$i<count($invoice);$i++){
        $jo .= $invoice[$i]["Jo_id"].",";
    }
?>
<div class="container">
    <!-- form invoice -->
    <div class="card shadow mb-2">
        <div class="card-header ">
            <h6 class="m-0 font-weight-bold text-primary">Buat Invoice</h6>
        </div>
        <div class="card-body">
        <form action="<?=base_url("index.php/form/update_invoice")?>" method="POST">
            <div class="row">
                <div class="col-md-6 border rounded">
                    <div class="form-group">
                        <label for="invoice_tgl_edit" class="form-label font-weight-bold">Tgl.Invoice</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_tgl_edit" name="invoice_tgl_edit" required value="<?= change_tanggal($invoice[0]["tanggal_invoice"])?>" onclick="tanggal_berlaku(this)">
                    </div>          
                    <div class="form-group">
                        <label for="invoice_id" class="form-label font-weight-bold">Invoice Kode</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_id" name="invoice_id" required value="<?= $invoice[0]["invoice_kode"]?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold mr-3" for="customer_id">Customer</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="customer_id" name="customer_id" required value="<?= $customer["customer_id"]?>" hidden>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="customer_name" name="customer_name"  value="<?= $customer["customer_name"]?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="invoice_ppn">PPN</label>
                        <select name="invoice_ppn" id="invoice_ppn" class="form-control col-md-10" required>
                            <?php if($invoice[0]["ppn"]==0){?>
                                <option class="font-w700" value="Ya">Ya</option>
                                <option class="font-w700" selected value="Tidak">Tidak</option>
                            <?php }else{?>
                                <option class="font-w700" selected value="Ya">Ya</option>
                                <option class="font-w700" value="Tidak">Tidak</option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold " for="invoice_payment">Payment (hari)</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_payment" name="invoice_payment" required onkeyup="hanyaangka(this)" value="<?= $invoice[0]["batas_pembayaran"]?>">
                    </div>          
                </div>
                <div class="col-md-6 border rounded">
                    <div class="form-group row mt-3">
                        <label for="invoice_tonase" class="col-form-label col-sm-5 font-weight-bold">Total Tonase</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_tonase" name="invoice_tonase" required readonly value="<?= $invoice[0]["total_tonase"]?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_total" class="col-form-label col-sm-5 font-weight-bold">Total</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_total" name="invoice_total" required readonly value="<?= number_format($invoice[0]["total"],2,',','.')?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_ppn" class="col-form-label col-sm-5 font-weight-bold">PPN</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_ppn_nilai" name="invoice_ppn_nilai" required readonly value="<?= number_format($invoice[0]["ppn"],2,',','.')?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_grand_total" class="col-form-label col-sm-5 font-weight-bold">Grand Total</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_grand_total" name="invoice_grand_total" required readonly value="<?= number_format($invoice[0]["grand_total"],2,',','.')?>">
                        </div>
                    </div>
                    <input type="text" id="data_jo" name="data_jo" required value="<?= $jo?>" hidden>
                    <div class="form-group mt-3">
                        <label for="invoice_keterangan" class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="invoice_keterangan" id="invoice_keterangan" rows="3"><?= $invoice[0]["invoice_keterangan"]?></textarea>
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <button type="submit" class="btn btn-success mt-3">Simpan</button>
                <button type="reset" class="btn btn-danger mt-3" onclick="reset_form()">Reset</button>
            </div>
        </form>
        <!-- table invoice -->
        <div class="card shadow mt-3 mb-3 small">
            <div class="card-body">
                <div class="container">
                    <strong>Data JO Dalam Invoice Saat Ini</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="pilih-jo-saat-ini" width="100%" cellspacing="0">
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
                            <?php foreach($invoice as $value){?>
                                <tr>
                                    <td><?= $value["Jo_id"]?></td>
                                    <td><?= change_tanggal($value["tanggal_muat"])?></td>
                                    <td><?= change_tanggal($value["tanggal_bongkar"])?></td>
                                    <td><?= $value["mobil_no"]?></td>
                                    <td><?= $value["muatan"]?></td>
                                    <td><?= $value["asal"]?></td>
                                    <td><?= $value["tujuan"]?></td>
                                    <td><?= number_format($value["tonase"],0,',','.')?></td>
                                    <td><?= number_format($value["tagihan"],2,',','.')?></td>
                                    <td><?= number_format($value["total_tagihan"],2,",",".")?></td>
                                    <td><input class='btn-check-invoice' data-pk='<?= $value["Jo_id"]?>' type='checkbox' checked></td>
                                    <td><a class='btn btn-light' target='_blank'  href='<?= base_url('index.php/detail/detail_jo/'.$value['Jo_id'].'/JO')?>'><i class='fas fa-eye'></i></a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end table invoice -->
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