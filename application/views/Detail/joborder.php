<!-- Basic Card Example -->
<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Job Order</h6>
    </div>
    <div class="card-body">
            <div class="container ">
            <!-- <div class="float-right mb-3">
            <?php if($jo["status"]=="Dalam Perjalanan"){?>                    
                        <a class='btn btn-outline-danger btn-sm mr-2 ' href='<?= base_url("index.php/detail/updatejobatal/").$jo["Jo_id"]?>' id="">
                            <span>Batalkan Perjalanan JO</span>
                        </a>
                        <a class='btn btn-success btn-sm ' data-toggle='modal' data-target='#popup-status-jo' href='' id="<?php echo $jo["Jo_id"] ?>" onclick="datajo(this,<?php echo $jo['supir_id'] ?>,'<?php echo $jo['mobil_no'] ?>')">
                            <span class>Konfirmasi Sampai</span>
                        </a>
                        
                <?php }?></div> -->

                <div class="float-right mb-3">
                <?php if($jo["status"]=="Dalam Perjalanan"){?>                    
                            <a class='btn btn-primary btn-sm ' href='<?= base_url("index.php/print_berkas/uang_jalan/").$jo["Jo_id"]?>' id="">
                                <span>Cetak Bukti Uang Jalan</span>
                            </a>
                    <?php }?></div>

                
            </div>
                    

        <!-- tampilan detail jo -->
        <div class="container" id="detail-jo">
            <table class="table table-bordered">
                <tbody>         
                    <tr>
                        <td class="d-none d-sm-table-cell text-center " rowspan="16" style="width: 15%;">
                            <p class="badge badge-info">Customer</p>
                            <p class="font-size-sm font-weight-bold"><?= $customer["customer_name"] ?></p>
                            <hr>
                            <p class="font-weight-bold badge badge-success">ID JO</p>
                            <p class="font-size-sm font-weight-bold"><?= $jo["Jo_id"] ?></p>
                        </td>
                        <td class="font-weight-bold mt-2" style="width: 25%;">Muatan</td>
                        <td colspan=3 width="70%"><?= $jo["muatan"]?> </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Asal-Tujuan</td>
                        <td colspan=3><?= $jo["asal"]."--".$jo["tujuan"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Berangkat</td>
                        <td colspan=3><?= $jo["tanggal_surat"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Tanggal Bongkar</td>
                        <td colspan=3><?= $jo["tanggal_bongkar"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Status</td>
                        <td colspan=3><?= $jo["status"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Supir</td>
                        <td colspan=3><?= $supir["supir_name"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 25%;">Kendaraan</td>
                        <td colspan=3><?= $mobil["mobil_no"]." == ".$mobil["mobil_jenis"] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold " style="width: 25%;">Uang Jalan</td>
                        <td colspan=3><p>Rp.<?= number_format($jo["uang_jalan"],2,',','.')." (".$jo["terbilang"].")" ?></p></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan=3><strong>Detail Muatan</strong></td>
                    </tr>
                    <tr>
                        <td colspan=3>Muatan Tonase : <?= $jo["tonase"]?></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan=3><strong>Upah Supir</strong></td>
                    </tr>
                    <tr>
                        <td>Upah : Rp.<?= number_format($jo["upah"],2,',','.')?></td>
                        <td>Bonus : Rp.<?= number_format($jo["bonus"],2,',','.')?></td>
                        <td>Jumlah : Rp.<?= number_format($jo["bonus"]+$jo["upah"],2,',','.')?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Catatan/Keterangan</td>
                        <td colspan=3><?= $jo["keterangan"]?></td>
                    </tr>

                    

                </tbody>
            </table>
        </div>
        <!-- end tampilan detail jo -->
    </div>
</div>



<!-- pop up update status jo -->
<div class="modal fade mt-4 py-5" id="popup-status-jo" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title font-weight-bold">Konfirmasi Job Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <p>Isi Data Dengan Lengkap</p>
                <form id="form-status-jo"  method="POST" id="status_supir">
                    <input type="text" name="jo_id" id="jo_id" hidden>
                    <div class="mb-3 row">
                        <label for="tonase" class="col-sm-5 col-form-label">Muatan akhir</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="tonase" id="tonase" onkeyup="uang()" required>    
                        </div>
                    </div>
                     <!-- <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label" for="harga">Harga / Satuan</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="harga" id="harga" onkeyup="uang()" required>
                        </div>
                    </div> -->
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label" for="bonus">Biaya Lain</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="bonus" id="bonus" onkeyup="uang()" required>
                        </div>
                    </div>
                     <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label" for="Keterangan" class="form-label">Keterangan/Catatan Tambahan</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="Keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="float-right mr-5 px-3 mt-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update status jo -->

<script>

    function datajo(a,supir,mobil){
        jo_id = a.id;
        $('#jo_id').val(jo_id); //set value
        $('#form-status-jo').attr('action','<?php echo base_url("index.php/detail/updatestatusjo/")?>'+supir+'/'+mobil);
    }

    function cetak_invoice(){
        window.location.replace("<?= base_url("index.php/print_berkas/invoice/".$jo["Jo_id"]."/JO")?>");    
    }

    function uang(){
        $( '#tonase' ).mask('000.000.000', {reverse: true});
        $( '#harga' ).mask('000.000.000', {reverse: true});
        $( '#upah' ).mask('000.000.000', {reverse: true});
        $( '#bonus' ).mask('000.000.000', {reverse: true});
    }
</script>