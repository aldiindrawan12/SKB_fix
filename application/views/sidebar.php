<body id="page-top" onload="asd()">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <?php
                if($_SESSION["user"]){
                    $link = base_url("index.php/home");
                }else{
                    $link = redirect(base_url());
                }
            ?>
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-2" href="<?= $link?>">
                <div class="sidebar-brand-icon fa-flip-horizontal">
                    <i class="fa fa-truck"></i>
                </div>
                <div class="sidebar-brand-text mx-3 ">TLEMU SKB</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider" id="HR_Master_Data">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="LI_Master_Data">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Master_Data"
                    aria-expanded="true" aria-controls="Master_Data" onclick="aktifasi('Master_Data')">
                    <span>Master Data</span>
                </a>
                <div id="Master_Data" class="collapse" aria-labelledby="headingTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" id="Kendaraan_page" href="<?=base_url("index.php/home/truck")?>">
                            <i class="fas fa-truck"></i>
                            <span>Data Kendaraan</span>
                        </a>
                        <a class="collapse-item" id="Supir_page" href="<?=base_url("index.php/home/penggajian")?>">
                            <i class="fas fa-money-check-alt"></i>
                            <span>Supir</span>
                        </a>
                        <a class="collapse-item"  id="Customer_page" href="<?=base_url("index.php/home/customer")?>">
                            <i class="fas fa-users"></i>
                            <span>Customer</span>
                        </a>
                        <a class="collapse-item" id="Satuan_page"href="<?=base_url("index.php/home/satuan")?>">  
                            <i class="fas fa-weight"></i>
                            <span>Rute dan Muatan</span>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider" id="HR_Perintah_Kerja">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="LI_Perintah_Kerja">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Perintah_Kerja"
                    aria-expanded="true" aria-controls="Perintah_Kerja" onclick="aktifasi('Perintah_Kerja')">
                    <span>Perintah Kerja</span>
                </a>
                <div id="Perintah_Kerja" class="collapse" aria-labelledby="headingTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" id="JO_page" href="<?=base_url("index.php/home")?>">
                            <i class="fas fa-envelope-open-text "></i>
                            <span id="coba">Job Order</span>
                        </a>
                        <a class="collapse-item" id="Invoice_page" href="<?=base_url("index.php/home/invoice")?>">   
                            <i class="fas fa-receipt mr-2"></i>
                            <span>Invoice</span>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider" id="HR_Penggajian">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="LI_Penggajian">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Penggajian"
                    aria-expanded="true" aria-controls="Penggajian" onclick="aktifasi('Penggajian')">
                    <span>Penggajian</span>
                </a>
                <div id="Penggajian" class="collapse" aria-labelledby="headingTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" id="Bon_page" href="<?=base_url("index.php/home/bon")?>">
                            <i class="fas fa-funnel-dollar"></i>
                            <span>Transaksi BON Supir</span>
                        </a>
                        <a class="collapse-item" id="Gaji_page" href="<?=base_url("index.php/home/gaji")?>">
                            <i class='fas fa-dollar-sign'></i>
                            <span>Transaksi Gaji Supir</span>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider" id="HR_Laporan">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="LI_Laporan">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Laporan"
                    aria-expanded="true" aria-controls="Laporan" onclick="aktifasi('Laporan')">
                    <span>Laporan</span>
                </a>
                <div id="Laporan" class="collapse" aria-labelledby="headingTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" id="Laporan_page" href="<?=base_url("index.php/home/report")?>">
                            <i class="fas fa-mail-bulk"></i>
                            <span>Laporan Job Order</span>
                        </a>
                        <a class="collapse-item" id="Laporan_Uang_Jalan_page" href="<?=base_url("index.php/home/report_uang_jalan")?>">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Laporan Uang Jalan</span>
                        </a>
                        <a class="collapse-item" id="Laporan_Gaji_page" href="<?=base_url("index.php/home/report_gaji")?>">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Laporan Gaji Supir</span>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider" id="HR_Konfigurasi">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="LI_Konfigurasi">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Konfigurasi"
                    aria-expanded="true" aria-controls="Konfigurasi" onclick="aktifasi('Konfigurasi')">
                    <span>Sistem dan Konfigurasi</span>
                </a>
                <div id="Konfigurasi" class="collapse" aria-labelledby="headingTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" id="Akun_page" href="<?=base_url("index.php/home/akun")?>">
                                <i class="fas fa-database"></i>
                                <span>Data Akun </span>
                            </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block my-1">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline my-1">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION["user"]?></span>
                                <i class="fas fa-user-friends"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

<script>
    function asd(){
        var page = '<?= $page?>';
        var collapse_group = '<?= $collapse_group?>';
        var konfigurasi = <?= $akun_akses["akun_akses"]?>;
        var HR = ["HR_Master_Data","HR_Perintah_Kerja","HR_Penggajian","HR_Laporan","HR_Konfigurasi"];
        var LI = ["LI_Master_Data","LI_Perintah_Kerja","LI_Penggajian","LI_Laporan","LI_Konfigurasi"];
        $("#"+page).addClass("active");
        $("#"+collapse_group).addClass("show");
        for(i=0;i<konfigurasi.length;i++){
            if(konfigurasi[i]==0){
                $("#"+HR[i]).hide();
                $("#"+LI[i]).hide();
            }
        }
    }
    function aktifasi(x){
        var collapse_group = ["Master_Data","Perintah_Kerja","Penggajian","Laporan","Konfigurasi"];
        for(i=0;i<collapse_group.length;i++){
            if(x!=collapse_group[i]){
                $("#"+collapse_group[i]).removeClass("show");
            }
        }
    }
</script>
