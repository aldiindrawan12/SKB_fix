<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0 text-gray-800  ">Buat Invoice</h1>
    </div> 
    <!-- form invoice -->
    <div class="card shadow mb-2">
        <div class="card-body">
        <form action="<?=base_url("index.php/form/insert_invoice")?>" method="POST">
            <div class="row">
                <div class="col-md-4 border rounded mr-4 ml-3">
                    <div class="form-group mt-3">
                        <label class="form-label font-weight-bold " for="customer_id">Customer</label>
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
                        <label for="invoice_id" class="form-label font-weight-bold">Invoice Kode</label>
                        <div class="row">
                            <input autocomplete="off" type="text" class="form-control col-md-2 ml-3 mr-1" id="invoice_id1" name="invoice_id1" required>
                            <input autocomplete="off" type="text" class="form-control col-md-4  mr-1" id="invoice_id2" name="invoice_id2" required readonly>
                            <input autocomplete="off" type="text" class="form-control col-md-3" id="invoice_id3" name="invoice_id3" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="invoice_tgl" class="form-label font-weight-bold">Tgl.Invoice</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_tgl" name="invoice_tgl" required>
                    </div>                    
                </div>
                <div class="col-md-4 border rounded mr-4">
                         
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
                    <div class="form-group">
                        <label class="form-label font-weight-bold " for="invoice_payment">Payment (hari)</label>
                        <input autocomplete="off" type="text" class="form-control" id="invoice_payment" name="invoice_payment" required>
                    </div>
                    <input type="text" id="data_jo" name="data_jo" required hidden>
                </div>
                <div class="col-md-3 border rounded mr-2">

                <div class="form-group mt-3">
                        <label for="invoice_keterangan" class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="invoice_keterangan" id="invoice_keterangan" rows="11" required></textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success float-right mt-3">Simpan</button>
            </div>
        </form>
    </div>
    <!-- end form invoice -->
</div>

<!-- table invoice -->
<div class="card shadow mb-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="pilih-jo" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="" scope="col">Tipe JO</th>
                        <th class="text-center" width="" scope="col">Rute dan Muatan</th>
                        <th class="text-center" width="" scope="col">Tgl.Brgkt</th>
                        <th class="text-center" width="" scope="col">Tgl.Plng</th>
                        <th class="text-center" width="" scope="col">Tonase</th>
                        <th class="text-center" width="" scope="col">Inv./Tagihan</th>
                        <th class="text-center" width="" scope="col">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end table invoice -->
<!-- pop up add detail rute paketan -->
<div class="modal fade" id="popup-detail-rute-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Detail Rute</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-data-rute-paketan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No Rute</th>
                                <th class="text-center" scope="col">Dari</th>
                                <th class="text-center" scope="col">Ke</th>
                                <th class="text-center" scope="col">Muatan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add detail rute paketan -->

<script>
    function customer(){
        var nama_customer = $("#customer_id option:selected").text();
        var date = new Date();
        $("#invoice_id2").val("-"+nama_customer);
        if(date.getMonth()<10){
            $("#invoice_id3").val("-0"+date.getMonth()+"-"+date.getFullYear());
        }else{
            $("#invoice_id3").val("-"+date.getMonth()+"-"+date.getFullYear());
        }
    }
</script>