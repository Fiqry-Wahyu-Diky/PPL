<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

<?php
    //  require '../connect.php';
    // error_reporting(0);
    require 'function.php';
    $data_tiket = ("SELECT * FROM tiket"); 
    $hasildata = mysqli_query($conn,$data_tiket);
    // $tampildata = mysqli_fetch_array($hasil);
    // var_dump($hasil);die;

    if(isset($_POST["submit"])){
        // cek data
        if(tambahtiket($_POST) == 1){
            // var_dump('halo');die;
        ?>
        <script>
            Swal.fire({
                        title: 'BERHASIL',
                        text: "Selamat data berhasil ditambahkan",
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "stok_tiket.php";
                        }
                    })
        </script> <?php 
        }elseif(tambahtiket($_POST) == 2){ ?>
        <script>
            Swal.fire({
                        title: 'GAGAL',
                        text: "Tanggal harus besok/hari ini",
                        icon: 'error',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "stok_tiket.php";
                        }
                    })
        </script> <?php 
        }elseif(tambahtiket($_POST) == 3){ ?>
        <script>
            Swal.fire({
                        title: 'GAGAL',
                        text: "Tiket untuk tanggal tersebut sudah tersedia",
                        icon: 'error',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "stok_tiket.php";
                        }
                    })
        </script> <?php 
        }
    }

    $tanggal = date("Y-m-d");
    // echo $tanggal;die;
    $total = "SELECT * FROM tiket WHERE tanggal = '$tanggal'";
    $hasil = mysqli_query($conn,$total);
    $result = mysqli_fetch_array($hasil);
    // var_dump($hasil);die;
    if (empty($result)) {
        $tampil = $result['Tidak ada tiket hari ini'];
    }else{
        $tampil = $result['jumlah_tiket'];
    }

    
?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item -Pengunjung Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pengunjung</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="data_pengunjung.php">Data Pengunjung</a>
                            <a class="collapse-item" href="jumlah_pengunjung.php">Jumlah Pengunjung</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Tiket Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-ticket-alt"></i>
                        <span>Tiket</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="stok_tiket.php">Stok Tiket</a>
                            <a class="collapse-item" href="pemesanan.php">Data Pesan</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Pendapatan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="pendapatan.php">Data Pendapatan</a>
                        </div>
                    </div>
                </li>


                <!-- Nav Item - Logout -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
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

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tiket yang tersedia/hari ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo ($result['jumlah_tiket']) ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl-center font-weight-bold text-success text-uppercase mb-0">
                                                <?php date_default_timezone_set('Asia/Jakarta');
                                                      echo date('l, d-m-Y  H:i:s');
                                                ?>
                                            </div>
                                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">20</div> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Tiket</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <button class="btn btn-success mb-auto" data-toggle="modal" data-target="#modal">Tambah tiket</button>
                                <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                                    <thead style="text-align: center;">
                                        <tr class="table table-primary">
                                            <th width = "5%">No</th>
                                            <th width="20%">ID TIKET</th>
                                            <th>Tanggal</th>
                                            <th width="30%">Jumlah Tiket</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i=1 ?>
                                    <?php while ($row = mysqli_fetch_array($hasildata)) { ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?= $row['id_tiket'];?></td>
                                            <td><?= date('d-m-Y', strtotime( $row['tanggal']))?> </td>
                                            <td><?= $row['jumlah_tiket'];?></td>
                                            <!-- <td style="text-align: center;">
                                                <button class="btn btn-success">&nbsp;Edit&nbsp;</button>
                                            </td> -->
                                        </tr>
                                    <?php $i++; ?>
                                    <?php ;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- modal tiket -->
            <div class="modal" tabindex="-1" role="dialog" id="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tiket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <label >Tanggal</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label >Stok Tiket</label>
                            <input type="number" class="form-control" name="stok_tiket">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>