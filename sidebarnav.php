<?php 
 
session_start();
 
if (!isset($_SESSION['id_petugas'])) {
    header("Location: ../Auth/LoginPage.php");
}
 
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-SAPI</title>

    <!-- icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/icons/font-awesome/css/fontawesome.css">
    <link href="assets/css/icons/font-awesome/css/brands.css" rel="stylesheet">
    <link href="assets/css/icons/font-awesome/css/solid.css" rel="stylesheet">

    <!-- CSS -->
    <link href="assets/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- style form css -->
    <link rel="stylesheet" href="assets/css/button-style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/path/to/select2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text --> 
                            <div class="ps-3 bg-transparent text-dark ">SI-Distribusi Susu Sapi</div>
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto mt-md-0 ps-4">
                        <?php 
                            date_default_timezone_set('Asia/jakarta');
                            $time= time();
                            $atime = date('Y-m-d',$time);
                            
                            echo "<h5 class='text-white bg-transparent'>" . $atime . "</h5><br>"; 
                        ?>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <?php if($_SESSION['nama_roles'] != 'Peternak') {?>
                                <?php echo "<h4 class='pe-4 text-white bg-transparent'>Selamat Datang,petugas " . $_SESSION['nama_roles'] ."!". "</h4>"; ?>
                            <?php } ?>

                            <?php if($_SESSION['nama_roles'] == 'Peternak') {?>
                                <?php echo "<h4 class='pe-4 text-white bg-transparent'>Selamat Datang," . $_SESSION['nama_pemilik'] ."!". "</h4>"; ?>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- Divider -->

                        <?php if($_SESSION['nama_roles'] == 'Admin') {?>
                            <div class="px-4 sidebar-heading">
                                Menu Admin
                            </div>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="dashboard.php" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                        aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="kelolaPetugas.php" aria-expanded="false">
                                    <i class="me-3 fa fa-users" aria-hidden="true"></i><span
                                        class="hide-menu">Kelola Petugas</span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="kelolaPeternak.php" aria-expanded="false">
                                    <i class="me-3 fa fa-address-book" aria-hidden="true"></i><span
                                        class="hide-menu">Kelola Peternak</span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="kelolamitra.php" aria-expanded="false">
                                    <i class="me-3 fa fa-truck" aria-hidden="true"></i><span
                                        class="hide-menu">Kelola Mitra</span></a>
                            </li>
                        <?php } ?>
                        
                        <?php if($_SESSION['nama_roles'] == 'Transaksi' || $_SESSION['nama_roles'] == 'Pencatatan' || $_SESSION['nama_roles'] =='Setor' ) {?>
                            <div class="px-4 sidebar-heading">
                                Menu Petugas
                            </div>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="dashboard.php" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                        aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="pencatatanSusu.php" aria-expanded="false"><i class="me-3 fa fa-filter"
                                        aria-hidden="true"></i><span class="hide-menu">Pencatatan Susu</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="kelolaGudang.php" aria-expanded="false"><i class="me-3 fa fa-home"
                                        aria-hidden="true"></i><span class="hide-menu">Gudang Susu</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="map-google.html" aria-expanded="false"><i class="me-3 fa fa-credit-card-alt "
                                        aria-hidden="true"></i><span class="hide-menu">Pembayaran</span></a></li>
                            <?php } ?>      
                                        
                            <li class="text-center p-20">
                                    <a href="Logout.php" class="btn btn-danger text-white mt-4">Logout</a>
                            </li>

                        <?php if($_SESSION['nama_roles'] != 'Admin' ||$_SESSION['nama_roles'] != 'Transaksi' || $_SESSION['nama_roles'] != 'Pencatatan' || $_SESSION['nama_roles'] !='Setor' ) { ?>
                            <div class="px-4 sidebar-heading">
                                Menu Peternak
                            </div>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="#" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                        aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="peternak.php" aria-expanded="false">
                                    <i class="me-3 fa fa-user" aria-hidden="true"></i><span
                                        class="hide-menu">Kelola Peternak</span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
