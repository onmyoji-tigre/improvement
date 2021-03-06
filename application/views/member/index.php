<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Header -->
<?php $this->load->view('header');?>
<!-------------------------->

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <!-- header global -->
        	<?php echo $this->load->view('topbar');?>
        <!-- end header global -->
			
        
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard Pencapaian</h4>&nbsp;
                        <?php echo $nama_karyawan; ?> (<?php echo $nik_karyawan; ?>)
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <a href="<?php echo base_url('member/c_member/list_registration');?>">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="m-r-10 mdi mdi-information-variant"></i></h1>
                                <h6 class="text-white">Information SS</h6>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <a href="<?php echo base_url('member/c_member/list_koreksi_ss');?>">
                            <div class="box bg-danger text-center">
                                <?php foreach($count->result() as $row) { ?>
                                <span class="badge badge-pill badge-light float-right" style="font-size: 16px;color:red;"><b><?php echo $row->jumlah_koreksi; ?></b></span>
                                <?php } ?>
                                <h1 class="font-light text-white"><i class="m-r-10 mdi mdi-inbox-arrow-down" style="padding-left:25pt;"></i></h1>
                                <h6 class="text-white">Correction Inbox SS</h6>
                            </div>
                            </a>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <a href="<?php echo base_url('member/c_member/list_koreksi_opl');?>">
                            <div class="box bg-info text-center">
                                <?php foreach($count_opl->result() as $row) { ?>
                                <span class="badge badge-pill badge-light float-right" style="font-size: 16px;color:red;"><b><?php echo $row->jumlah_koreksi; ?></b></span>
                                <?php } ?>
                                <h1 class="font-light text-white"><i class="m-r-10 mdi mdi-inbox-arrow-down" style="padding-left:25pt;"></i></h1>
                                <h6 class="text-white">Correction Inbox OPL</h6>
                            </div>
                            </a>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body border-top">
                                <h5 class="card-title">Informasi Pencapaian</h5>
                                <div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">Poin Registrasi</h4>
                                  <?php foreach($sum_register->result() as $row) { ?>
                                  <p>Perolehan : <?php echo $row->poin_register; ?> </p>
                                  <?php } ?>
                                  <hr>
                                  <p class="mb-0">Jumlah SS didaftarkan : <?php echo $row->jml_register; ?></p>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                  <h4 class="alert-heading">Poin Implementasi</h4>
                                  <p>Perolehan : </p>
                                  <hr>
                                  <p class="mb-0">Target per Year : 26</p>
                                </div>
                               <i><p class="mb-0"><b>nb</b> :</p>
                               <h6 class="card-title" style="color:red;">- Target Poin yang harus dicapai yaitu Poin Implementasi sebesar 26 Poin / Tahun.</h6>
                               <h6 class="card-title" style="color:red;">- Jika terdapat karyawan baru masuk maka Target Poin Implementasi dihitung proporsional berdasarkan bulan masuk.</h6>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix. Designed and Developed by <a href="https://kmiers">IT KMI</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url();?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url();?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url();?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="<?php echo base_url();?>assets/libs/flot/excanvas.js"></script>
    <script src="<?php echo base_url();?>assets/libs/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/libs/flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url();?>assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url();?>assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="<?php echo base_url();?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/pages/chart/chart-page-init.js"></script>

</body>

</html>