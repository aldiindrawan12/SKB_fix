<?php
// echo var_dump(json_decode($akun["akses"]));
?>
<div class="container">
    <div class="mb-4 text-center">
        <h1 class="h3 mb-0 text-gray-800">Konfigurasi Hak Akses</h1>
    </div> 
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="20%">Nama Akun</td>
                            <td width="5%">:</td>
                            <td ><?=$akun["akun_name"]?></td>
                        </tr>
                        <tr>
                            <td width="20%">Status Akun</td>
                            <td width="5%">:</td>
                            <td ><?=$akun["akun_role"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="<?= base_url("index.php/form/update_konfigurasi/".$akun["akun_id"])?>" method="POST">
                    <table width="100%" cellspacing="0">
                        <tbody>
                            <?php //$collapse = ["Master Data","Perintah Kerja","Penggajian","Laporan","Sistem dan Konfigurasi","XXXX"];
                                  $page = ["Master Data","Job Order","Konfirmasi Job Order","Tambah Invoice","Data Invoice",
                                  "Transaksi Bon","Transaksi Gaji","Laporan Job Order","Laporan Uang Jalan","Laporan Gaji Supir",
                                  "Laporan Bon Supir","Konfigurasi Akun"];?>
                            <!-- <tr>
                                <input type="text" class="cek1" name="cek1" hidden value="<?= json_decode($akun["akun_akses"])[0] ?>">
                                <td width="20%"><?= $collapse[0]?></td>
                                <td width="5%">:</td>
                                <td ><input class="isicek1" value="<?= json_decode($akun["akun_akses"])[0] ?>" 
                                <?php
                                    if(json_decode($akun["akun_akses"])[0]==1){
                                        echo 'checked';
                                    }
                                ?>
                                data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cek1','isicek1')"></td>
                            </tr>
                            <tr>
                                <input type="text" class="cek2" name="cek2" hidden value="<?= json_decode($akun["akun_akses"])[1] ?>">
                                <td width="20%"><?= $collapse[1]?></td>
                                <td width="5%">:</td>
                                <td ><input class="isicek2" value="<?= json_decode($akun["akun_akses"])[1] ?>" 
                                <?php
                                    if(json_decode($akun["akun_akses"])[1]==1){
                                        echo 'checked';
                                    }
                                ?>
                                data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cek2','isicek2')"></td>
                            </tr>
                            <tr>
                                <input type="text" class="cek3" name="cek3" hidden value="<?= json_decode($akun["akun_akses"])[2] ?>">
                                <td width="20%"><?= $collapse[2]?></td>
                                <td width="5%">:</td>
                                <td ><input class="isicek3" value="<?= json_decode($akun["akun_akses"])[2] ?>" 
                                <?php
                                    if(json_decode($akun["akun_akses"])[2]==1){
                                        echo 'checked';
                                    }
                                ?>
                                data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cek3','isicek3')"></td>
                            </tr>
                            <tr>
                                <input type="text" class="cek4" name="cek4" hidden value="<?= json_decode($akun["akun_akses"])[3] ?>">
                                <td width="20%"><?= $collapse[3]?></td>
                                <td width="5%">:</td>
                                <td ><input class="isicek4" value="<?= json_decode($akun["akun_akses"])[3] ?>" 
                                <?php
                                    if(json_decode($akun["akun_akses"])[3]==1){
                                        echo 'checked';
                                    }
                                ?>
                                data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cek4','isicek4')"></td>
                            </tr>
                            <tr>
                                <input type="text" class="cek5" name="cek5" hidden value="<?= json_decode($akun["akun_akses"])[4] ?>">
                                <td width="20%"><?= $collapse[4]?></td>
                                <td width="5%">:</td>
                                <td ><input class="isicek5" value="<?= json_decode($akun["akun_akses"])[4] ?>" 
                                <?php
                                    if(json_decode($akun["akun_akses"])[4]==1){
                                        echo 'checked';
                                    }
                                ?>
                                data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cek5','isicek5')"></td>
                            </tr> -->
                        </tbody>
                    </table>
                    <hr>
                    <table width="100%" cellspacing="0">
                        <tbody>
                            <?php for($i=0;$i<count($page);$i++){?>
                                <tr>
                                    <input type="text" class="cekpage<?= $i+1?>" name="cekpage<?= $i+1?>" hidden value="<?= json_decode($akun["akses"])[$i] ?>">
                                    <td width="20%"><?= $page[$i]?></td>
                                    <td width="5%">:</td>
                                    <td ><input class="isicekpage<?= $i+1?>" value="<?= json_decode($akun["akses"])[$i] ?>" 
                                    <?php
                                        if(json_decode($akun["akses"])[$i]==1){
                                            echo 'checked';
                                        }
                                    ?>
                                    data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cekpage<?= $i+1?>','isicekpage<?= $i+1?>')"></td>
                                </tr>
                            <?php }?>
                            <tr>
                                <td colspan=3><button type="submit" class="btn btn-primary mr-2">Simpan</button><button type="reset" class="btn btn-danger" onclick="reset_konfigurasi()">Batal</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function togglenih(cek,isicek){
        var hak_akses = $("."+isicek).val();
        // alert(hak_akses);
        if(hak_akses==1){
            $("."+cek).val(0);
            $("."+isicek).val(0);
        }else{
            $("."+cek).val(1);
            $("."+isicek).val(1);
        }
    }
    function reset_konfigurasi(){
        location.reload();
    }
    </script>