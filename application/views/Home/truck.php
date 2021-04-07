<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Kendaraan</h1>
        <a class="btn btn-primary btn-icon-split" data-toggle='modal' data-target='#popup-truck'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Kendaraan
            </span>
        </a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kendaraan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table-Truck" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="3%" scope="col">No</th>
                        <th class="text-center" width="11%" scope="col">No Polisi</th>
                        <th class="text-center" width="12%" scope="col">Merk</th>
                        <th class="text-center" width="12%" scope="col">Type</th>
                        <th class="text-center" width="15%" scope="col">Jenis Kendaraan</th>
                        <th class="text-center" width="10%" scope="col">Tahun</th>
                        <th class="text-center" width="17%" scope="col">Pajak Tahunan STNK</th>
                        <th class="text-center" width="30%" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add truck -->
<div class="modal fade mt-3 px-3 " id="popup-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mt-4">
            <?php echo form_open_multipart('form/insert_truck'); ?>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="mobil_no" class="form-label font-weight-bold">Plat No Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no" name="mobil_no" required>
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" type="text" class="form-control" id="merk_id" name="merk_id" required hidden>
                            <label for="mobil_merk" class="form-label font-weight-bold" onclick="merk()"">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_merk" name="mobil_merk" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_type" class="form-label font-weight-bold">Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_type" name="mobil_type" required readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_jenis">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_jenis" name="mobil_jenis" required readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_dump">Dump</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_dump" name="mobil_dump" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_keterangan" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="mobil_keterangan" rows="3"></textarea>
                        </div>
                    </div>    
                    <div class="col">
                        <div class="form-group">
                            <label for="mobil_tahun" class="form-label font-weight-bold">Tahun</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_tahun" name="mobil_tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_max_load" class="form-label font-weight-bold">Muatan Maksimal Mobil (Ton)</label>
                            <input autocomplete="off" type="number" class="form-control" id="mobil_max_load" name="mobil_max_load" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku" class="form-label font-weight-bold">Tgl Pajak 1 Tahunan STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku" name="mobil_berlaku" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_pajak" class="form-label font-weight-bold">Tgl Pajak 5 Tahunan STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_pajak" name="mobil_pajak" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_stnk" class="form-label font-weight-bold">No STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_stnk" name="mobil_stnk" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="mobil_kir" class="form-label font-weight-bold">No KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_kir" name="mobil_kir" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_kir" class="form-label font-weight-bold">Berlaku KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_kir" name="mobil_berlaku_kir" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_ijin_bongkar" class="form-label font-weight-bold">No Ijin Bongkar</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_ijin_bongkar" name="mobil_ijin_bongkar" required >
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_ijin_bongkar" class="form-label font-weight-bold">Berlaku Ijin Bongka</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_ijin_bongkar" name="mobil_berlaku_ijin_bongkar" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_foto" class="form-label font-weight-bold">Foto STNK</label>
                            <input type="file" class="form-control" id="file_foto" name="file_foto" required onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_STNK" class="form-label font-weight-bold">Foto STNK</label>
                            <input type="file" class="form-control" id="file_STNK" name="file_STNK" required onchange="upload_foto(this)"> 
                        </div>
                    </div>
                </div>  
            </div>
            <div class="form-group mt-1 mr-4 ">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
                <button type="reset" class="btn btn-outline-danger mr-3 float-md-right" onclick="reset_form()">Reset</button>
            </div>
            <?php echo form_close();?>
            <div class="table-responsive">
                <table class="table table-bordered" id="Table-Pilih-Merk" width="100%" cellspacing="0">
                    <thead>
                        <tr>    
                            <th class="text-center" width="12%" scope="col">No</th>
                            <th class="text-center" width="12%" scope="col">Merk</th>
                            <th class="text-center" width="12%" scope="col">Type</th>
                            <th class="text-center" width="15%" scope="col">Jenis Kendaraan</th>
                            <th class="text-center" width="10%" scope="col">Dump</th>
                            <th class="text-center" width="30%" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end pop up add truck -->

<!-- pop up update truck -->
<div class="modal fade mt-5 px-5 py-2" id="popup-update-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_truck")?>" method="POST">     
                        <div class="form-group">
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_update" name="mobil_no_update" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_stnk_update" class="form-label font-weight-bold">NO STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_stnk_update" name="mobil_stnk_update" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_update" class="form-label font-weight-bold">Tgl.STNK 1 Tahunan</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_update" name="mobil_berlaku_update" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_pajak_update" class="form-label font-weight-bold">Tgl.STNK 5 Tahunan</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_pajak_update" name="mobil_pajak_update" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_kir_update" class="form-label font-weight-bold">KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_kir_update" name="mobil_kir_update" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_kir_update" class="form-label font-weight-bold">Tgl.Berlaku KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_kir_update" name="mobil_berlaku_kir_update" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_ijin_bongkar_update" class="form-label font-weight-bold">Ijin Bongkar</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_ijin_bongkar_update" name="mobil_ijin_bongkar_update" required>
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_ijin_bongkar_update" class="form-label font-weight-bold">Tgl.Berlaku Ijin Bongkar</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_ijin_bongkar_update" name="mobil_berlaku_ijin_bongkar_update" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_keterangan_update" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" id="mobil_keterangan_update" name="mobil_keterangan_update" rows="3"></textarea>
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update truck -->

<!-- pop up detail kendaraan -->
<div class="modal fade mt-3 px-3" id="popup-kendaraan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify row">
                <div class="col">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Polisi</td>
                                <td name="mobil_no"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jenis Kendaraan</td>
                                <td name="mobil_jenis"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status Jalan</td>
                                <td name="status_jalan"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Keterangan</td>
                                <td name="mobil_keterangan"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Merk</td>
                                <td name="mobil_merk"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Type</td>
                                <td name="mobil_type"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dump</td>
                                <td name="mobil_dump"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tahun</td>
                                <td name="mobil_tahun"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tgl.STNK 1 Tahunan</td>
                                <td name="mobil_berlaku"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tgl.STNK 5 Tahunan</td>
                                <td name="mobil_pajak"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No STNK</td>
                                <td name="mobil_stnk"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No KIR</td>
                                <td name="mobil_kir"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku KIR</td>
                                <td name="mobil_berlaku_kir"></td>
                            </tr>                            
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Ijin Bongkar</td>
                                <td name="mobil_ijin_bongkar"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku Ijin Bongkar</td>
                                <td name="mobil_berlaku_ijin_bongkar"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                                    <div class="container w-10">
                                        <img src="" alt="foto mobil" id="file_foto_detail" class="img-thumbnail">
                                    </div>
                      
                                    <div class="container w-10">
                                        <img src="" alt="foto stnk" id="file_stnk_detail" class="img-thumbnail">
                                    </div>
                      
            </div>
        </div>
    </div>
    </div>
    </div>
    
</div>
<!-- end pop up detail kendaraan -->

<script>
    function merk(){
        $.ajax({ //ajax ambil data bon
            type: "GET",
            url: "<?php echo base_url('index.php/detail/getallmerk') ?>",
            dataType: "JSON",
            success: function(data) { //jika ambil data sukses
                alert(data);
            }
        });
    }
</script>