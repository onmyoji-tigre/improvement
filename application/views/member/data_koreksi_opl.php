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
                        <h4 class="page-title">Data SS Registrasi</h4>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List Data Koreksi OPL</h5>
                                <div class="table-responsive">
                                    <table id="example3" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                              <th>Tgl Reg</th>
                                              <th>No. Reg</th>
                                              <th>Tema</th>
                                              <th>Perbaikan</th>
                                              <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Tgl Reg</th>
                                              <th>No. Reg</th>
                                              <th>Tema</th>
                                              <th>Perbaikan</th>
                                              <th>View</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- Modal -->

            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title">Data SS</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="ID_IMPROVEMENT"/> 
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tema</label>
                                        <div class="col-md-3">
                                            <input name="TEMA" placeholder="TEMA" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Diusulkan Oleh</label>
                                        <div class="col-md-6">
                                            <table class="form-control" id="NIK_KARYAWAN">
                                              
                                            </table>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Target Penyelesaian</label>
                                        <div class="col-md-3">
                                            <input name="PENYELESAIAN" placeholder="PENYELESAIAN" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Latar Belakang</label>
                                        <div class="input-group">
                                            <textarea name="LATAR_BELAKANG" class="form-control" rows="5" placeholder="Enter ..." ></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Usulan Perbaikan</label>
                                        <div class="input-group">
                                            <textarea name="PERBAIKAN" class="form-control" rows="5" placeholder="Enter ..."  ></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Target/Manfaat</label>
                                        <div class="input-group">
                                            <textarea name="MANFAAT" class="form-control" rows="5" placeholder="Enter ..."  ></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Alat & Bahan</label>
                                        <div class="input-group">
                                            <textarea name="ALAT_BAHAN" class="form-control" rows="5" placeholder="Enter ..."  readonly></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Biaya</label>
                                        <div class="col-md-3">
                                            <input name="BIAYA" placeholder="BIAYA" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">No WR</label>
                                        <div class="col-md-3">
                                            <input name="NO_WR" placeholder="NO_WR" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Koreksi</label>
                                        <div class="input-group">
                                            <textarea name="KOREKSI" class="form-control" rows="5" placeholder="Enter ..." readonly></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Accept</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
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
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url();?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url();?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="<?php echo base_url();?>assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?php echo base_url();?>assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?php echo base_url();?>assets/extra-libs/DataTables/datatables.min.js"></script>
    
    <script type="text/javascript">
        <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
        $('#modal_form').on('hidden.bs.modal', function () {
          location.reload();
        })
        //datatables
        table = $('#example3').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('member/c_member/ajax_list_correction_opl')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            ],

            });


        });
        function edit_person(ID_IMPROVEMENT)
        {
          //Ajax Load data from ajax
          $.ajax({
              url : "<?php echo site_url('member/c_member/ajax_edit/')?>/" + ID_IMPROVEMENT,
              type: "GET",
              dataType: "JSON",
              success: function(data)
              {

                             $.each(data,function(index,item){
                              $("<tr>").append(
                              $("<td>").text(item.NIK),
                              $("<td>").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"),
                              $("<td>").text(item.NAMA_KARYAWAN)
                              ).appendTo("#NIK_KARYAWAN");
                              $('[name="ID_IMPROVEMENT"]').val(item.ID_IMPROVEMENT);
                              $('[name="TEMA"]').val(item.TEMA);
                              $('[name="PENYELESAIAN"]').val(item.PENYELESAIAN);
                              $('[name="LATAR_BELAKANG"]').val(item.LATAR_BELAKANG);
                              $('[name="PERBAIKAN"]').val(item.PERBAIKAN);
                              $('[name="MANFAAT"]').val(item.MANFAAT);
                              $('[name="ALAT_BAHAN"]').val(item.ALAT_BAHAN);
                              $('[name="BIAYA"]').val(item.BIAYA);
                              $('[name="NO_WR"]').val(item.NO_WR);
                              $('[name="KOREKSI"]').val(item.KOREKSI);
                             });

                  $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Detail Suggestion System'); // Set title to Bootstrap modal title
                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error get data from ajax');
              }
          });
        }

        function edit_person_opl(ID_IMPROVEMENT)
        {
          //Ajax Load data from ajax
          $.ajax({
              url : "<?php echo site_url('member/c_member/ajax_edit_opl/')?>/" + ID_OPL,
              type: "GET",
              dataType: "JSON",
              success: function(data)
              {

                             $.each(data,function(index,item){
                              $("<tr>").append(
                              $("<td>").text(item.NIK),
                              $("<td>").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"),
                              $("<td>").text(item.NAMA_KARYAWAN)
                              ).appendTo("#NIK_KARYAWAN");
                              $('[name="ID_IMPROVEMENT"]').val(item.ID_IMPROVEMENT);
                              $('[name="TEMA"]').val(item.TEMA);
                              $('[name="PENYELESAIAN"]').val(item.PENYELESAIAN);
                              $('[name="LATAR_BELAKANG"]').val(item.LATAR_BELAKANG);
                              $('[name="PERBAIKAN"]').val(item.PERBAIKAN);
                              $('[name="MANFAAT"]').val(item.MANFAAT);
                              $('[name="ALAT_BAHAN"]').val(item.ALAT_BAHAN);
                              $('[name="BIAYA"]').val(item.BIAYA);
                              $('[name="NO_WR"]').val(item.NO_WR);
                              $('[name="KOREKSI"]').val(item.KOREKSI);
                             });

                  $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Detail Suggestion System'); // Set title to Bootstrap modal title
                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error get data from ajax');
              }
          });
        }

        function save()
        {
            var url;

           
                url = "<?php echo site_url('member/c_member/ajax_correctionopl_update')?>";
            

            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');

                }
            });
        }
    </script>

</body>

</html>