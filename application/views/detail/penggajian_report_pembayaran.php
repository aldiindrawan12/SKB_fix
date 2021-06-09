<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!-- tampilan detail penggajian supir -->
<div class="container small">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center">Data Upah Supir</h6>
        </div>
        <div class="card-body" id="identitas">
            <table class="w-50">
                <tbody>
                    <tr>
                        <td width="25%">Status</td>
                        <td width="5%">:</td>
                        <?php if($pembayaran_upah[0]["pembayaran_upah_status"]=="Belum Lunas"){?>
                            <td class="text-danger"><?= $pembayaran_upah[0]["pembayaran_upah_status"]?></td>
                        <?php }else{ ?>
                            <td class="text-success"><?= $pembayaran_upah[0]["pembayaran_upah_status"]?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td width="25%">Id Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_id"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_name"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Bulan Kerja</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["bulan_kerja"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Operator</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["user_upah"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body" id="rincian">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">Tgl Keluar</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Uang Jalan</th>
                            <th class="text-center" width="8%" scope="col">Total Muatan</th>
                            <th class="text-center" width="10%" scope="col">Upah</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $uang_jalan = 0;
                    foreach($pembayaran_upah as $value){ 
                            $uang_jalan += $value["uang_jalan"];
                        ?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= change_tanggal($value["tanggal_surat"])?></td>
                            <td><?= change_tanggal($value["tanggal_bongkar"])?></td>
                            <?php if($value["muatan"]==""){?>
                                <td colspan=3 class="text-center">Paketan</td>
                            <?php }else{?>
                                <td><?= $value["muatan"]?></td>
                                <td><?= $value["asal"]?></td>
                                <td><?= $value["tujuan"]?></td>
                            <?php }?>
                            <?php
                                    echo "<td>Rp.".number_format($value["uang_jalan"],2,',','.')."</td>";
                            ?>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["upah"],2,',','.')?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan=6>Total</td>
                            <td>Rp.<?= number_format($uang_jalan,2,',','.')?></td>
                            <td></td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_nominal"],2,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Potong Kasbon</td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_bon"],2,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Bonus</td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_bonus"],2,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=8>Grand Total Upah</td>
                            <td id="grand_total">Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_total"],2,",",".")?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end tampilan detail penggajian supir -->


<div class="container">
    <button onclick="print_rincian()" class="btn btn-success">Cetak Rincian Gaji</button>
    <button onclick="isi_rekening()" class="btn btn-primary">Cetak Memo Transfer</button>
    <button onclick="print_memo_tunai()" class="btn btn-primary">Cetak Memo Tunai</button>
    <?php if($pembayaran_upah[0]["pembayaran_upah_status"]!="Lunas"){?>
        <button onclick="selesai()" class="btn btn-primary">Lunas</button>
    <?php }?>
</div>
<hr>
<!-- form rekening supir -->
<div class="container mt-3 small" style="display:none" id="form-rekening">
    <small>Isi Data Rekening Supir</small>
    <form class="row" id="form-rekening">
        <div class="form-group col-md-6">
            <label for="Bank" class="form-label">Bank</label>
            <input autocomplete="off" type="text" class="form-control" id="Bank" name="Bank" required>
            <label for="AN" class="form-label">A.N.</label>
            <input autocomplete="off" type="text" class="form-control" id="AN" name="AN" required>
            <label for="Norek" class="form-label">No Rek</label>
            <input autocomplete="off" type="text" class="form-control" id="Norek" name="Norek" required>
        </div>
        <div class="col-md-5 form-group">
            <label for="Keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="Keterangan" id="Keterangan" rows="3"></textarea>
        </div>
    </form>
    <div class="form-group">
        <button class="btn btn-info mb-3" onclick="print_memo_tf()">Cetak Memo Transfer</button>
    </div>
</div>
<!-- end form rekening supir -->

<div style="display:none" id="footer-surat">
    <div class="table-responsive">
        <table width="100%">
            <tbody>
                <tr class="text-center">
                    <td width="25%">Dibuat Oleh,</td>
                    <td width="25%">Disetujui Oleh,</td>
                    <td width="25%">Diserahkan Oleh,</td>
                    <td width="25%" >Diterima Oleh</td>
                </tr>
                <tr class="text-center" style="height:200px">
                    <td width="25%">(...............)</td>
                    <td width="25%">(...............)</td>
                    <td width="25%">(...............)</td>
                    <td width="25%">(...............)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- memo tf -->
    <div class="container" style="display:none">
        <div class="mb-4" id="cetak_tf">
            <div class="py-3">
                <h6 class="m-0 font-weight-bold text-center">Memo Transfer</h6>
            </div>
            <div class="card-body row">
                <div class="col-md-5">
                    <table>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>Bandar Lampung,<span id="tf_tanggal"></span></td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td><span id="tf_bank"></span></td>
                            </tr>
                            <tr>
                                <td>Rekening</td>
                                <td>:</td>
                                <td><span id="tf_norek"></span></td>
                            </tr>
                            <tr>
                                <td>A.N.</td>
                                <td>:</td>
                                <td><span id="tf_an"></span></td>
                            </tr>
                            <tr>
                                <td>Nominal</td>
                                <td>:</td>
                                <td>Rp.<span id="tf_gaji"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table>
                        <tbody>
                            <tr>
                                <td>Keterangan : </td>
                            </tr>
                            <tr>
                                <td id="isi_ket"><span id="tf_keterangan"></span></td>
                            </tr>
                            <tr>
                                <td style="height:100px"><span id="tf_supir"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="w-100 mt-5">
                    <tbody>
                        <tr class="text-center">
                            <td width="30%">Mengetahui,</td>
                            <td width="30%">Menyetujui,</td>
                            <td width="30%" >Kasir</td>
                        </tr>
                        <tr class="text-center" style="height:200px">
                            <td width="30%">(.................)</td>
                            <td width="30%">(.................)</td>
                            <td width="30%" >(.................)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
<!-- end memo tf -->

<!-- memo tunai -->
    <div class="container" style="display:none">
        <div class="w-50" id="cetak_tunai">
            <div class="text-center">
                <span class="h3">Memo Tunai</span>
                <hr>
            </div>
            <div>
                <div class="table-responsive">
                    <table class="" id="" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan=3>Bandar Lampung,<span id="tunai_tanggal"></span></td>
                            </tr>
                            <tr>
                                <td width="30%">Telah Terima Dari</td>
                                <td width="5%">:</td>
                                <td>Sumber Berkah Jaya</td>
                            </tr>
                            <tr>
                                <td width="30%">Sebesar</td>
                                <td width="5%">:</td>
                                <td>Rp.<span id="tunai_gaji"></span></td>
                            </tr>
                            <tr>
                                <td width="30%">Untuk</td>
                                <td width="5%">:</td>
                                <td>Pembayaran Gaji/Upah tunai</td>
                            </tr>
                            <tr>
                                <td colspan=3><hr></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr class="text-center">
                                <td width="25%">Mengetahui,</td>
                                <td width="25%">Menyetujui,</td>
                                <td width="25%">Kasir,</td>
                                <td width="25%" >Supir</td>
                            </tr>
                            <tr class="text-center" style="height:200px">
                                <td width="25%">(...............)</td>
                                <td width="25%">(...............)</td>
                                <td width="25%">(...............)</td>
                                <td width="25%">(<span id="tunai_supir"></span>)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- end memo tunai -->
<script>
    function isi_rekening(){
        $("#form-rekening").show();
    }
    function print_rincian(){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('identitas').innerHTML+document.getElementById('rincian').innerHTML+document.getElementById('footer-surat').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
    function print_memo_tf(){
        var Bank = $("#Bank").val();
        var AN = $("#AN").val();
        var Norek = $("#Norek").val();
        var Keterangan = $("#Keterangan").val();
        var date = new Date();
        var date_now = "";
        if((date.getMonth()+1)<10){
            date_now = date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear();
        }else{
            date_now = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
        }
        $("#tf_tanggal").text(date_now);
        $("#tf_bank").text(Bank);
        $("#tf_norek").text(Norek);
        $("#tf_an").text(AN);
        $("#tf_keterangan").text(Keterangan);
        $("#tf_supir").text("<?= $supir["supir_name"]?>");
        $("#tf_gaji").text("<?= number_format($pembayaran_upah[0]["pembayaran_upah_total"],2,",",".")?>");
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('cetak_tf').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        $("#form-rekening").hide();
    }
    function print_memo_tunai(){
        var date = new Date();
        var date_now = "";
        if((date.getMonth()+1)<10){
            date_now = date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear();
        }else{
            date_now = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
        }
        $("#tunai_tanggal").text(date_now);
        $("#tunai_supir").text("<?= $supir["supir_name"]?>");
        $("#tunai_gaji").text("<?= number_format($pembayaran_upah[0]["pembayaran_upah_total"],2,",",".")?>");
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('cetak_tunai').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
    function selesai(){
        var data_jo_id = [];
        <?php for($i=0;$i<count($jo_pembayaran_upah);$i++){?>
            data_jo_id.push("<?= $jo_pembayaran_upah[$i]["Jo_id"]?>");
        <?php }?>
        Swal.fire({
                title: 'konfirmasi Pembayaran Gaji',
                text:'Apakah Pembayaran Gaji Sudah Selesai?',
                showDenyButton: true,
                denyButtonText: `Batal`,
                confirmButtonText: 'Ya,Selesai',
                denyButtonColor: '#808080',
                confirmButtonColor: 'green',
                icon: "question",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url('index.php/detail/update_upah') ?>",
                        dataType: "text",
                        data: {
                            gaji_grand_total:"<?= $pembayaran_upah[0]["pembayaran_upah_total"]?>",
                            gaji_total:"<?= $pembayaran_upah[0]["pembayaran_upah_nominal"]?>",
                            supir_id:"<?= $supir["supir_id"]?>",
                            kasbon:"<?= $pembayaran_upah[0]["pembayaran_upah_bon"]?>",
                            bonus:"<?= $pembayaran_upah[0]["pembayaran_upah_bonus"]?>",
                            pembayaran_upah_id:"<?= $pembayaran_upah[0]["pembayaran_upah_id"]?>",
                            jo_id:data_jo_id,
                        },
                        success: function(data) {
                            alert(data);
                            window.location = "<?= base_url("index.php/detail/detail_penggajian_report_pembayaran/").$supir["supir_id"]."/".$pembayaran_upah[0]["pembayaran_upah_id"]?>";
                        }
                    });      
                }
            })
    }s
</script>