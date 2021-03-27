<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Konfirmasi Job Order</h1>
    </div> 
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Job Order(JO)</h6>
    </div>
    <!-- tabel konfirmasi JO -->
    <div class="card-body">
        <div class="table-responsive thead-dark">
            <table class="table table-bordered  " id="Table-Konfirmasi-Job-Order" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width ="10%" class="text-center" scope="col">No JO</th>
                        <th width ="17%" class="text-center" scope="col">Customer</th>
                        <th width ="15%" class="text-center" scope="col">Muatan</th>
                        <th width ="16%" class="text-center" scope="col">Asal</th>
                        <th width ="16%" class="text-center" scope="col">Tujuan</th>
                        <th width ="1%" class="text-center" scope="col">Tanggal</th>
                        <th width ="25%" scope="col">Konfirmasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel konfirmasi JO -->
</div>

</div>
<div class="modal fade mt-4" id="update_jo" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Pilih Status JO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="container mt-3">
                <div class="row">
                    <div class="col table-bordered">
                        <form id="form_update_jo" method="POST">
                            <input type="text" name="jo_id" id="jo_id" hidden>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control custom-select " required onchange="status_jenis()">
                                    <option class="font-w700" disabled="disabled" selected value="">Status JO</option>
                                    <option value="Sampai Tujuan">Sampai Tujuan</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="konfirmasi" style="display:none">
                                <div class="form-group">
                                    <label for="tonase" class="form-label">Muatan akhir</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tonase" id="tonase" onkeyup="uang()">    
                                </div>
                                <!-- <div class="form-group">
                                    <label class="form-label" for="harga">Harga / Tonase</label>
                                    <input autocomplete="off" class="form-control" type="text" name="harga" id="harga" onkeyup="uang()">
                                </div> -->
                                <div class="form-group">
                                    <label class="form-label" for="bonus">Biaya Lain</label>
                                    <input autocomplete="off" class="form-control" type="text" name="bonus" id="bonus" onkeyup="uang()">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="Keterangan" class="form-label">Keterangan/Catatan Tambahan</label>
                                    <textarea class="form-control" name="Keterangan" rows="3"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="form-group mt-3 mr-2 px-1">
                    <button type="submit" class="btn btn-success float-right mb-3">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function uang(){
        $( '#tonase' ).mask('000.000.000', {reverse: true});
        // $( '#harga' ).mask('000.000.000', {reverse: true});
        // $( '#upah' ).mask('000.000.000', {reverse: true});
        $( '#bonus' ).mask('000.000.000', {reverse: true});
    }
    function status_jenis(){
        var status = $("#status").val();
        if(status=="Dibatalkan"){
            $(".konfirmasi").hide();
            $("#tonase").removeAttr('required');
            // $("#harga").removeAttr('required');
            $("#bonus").removeAttr('required');
        }else{
            $(".konfirmasi").show();
            $("#tonase").attr('required','true');
            // $("#harga").attr('required','true');
            $("#bonus").attr('required','true');
        }
    }
</script>