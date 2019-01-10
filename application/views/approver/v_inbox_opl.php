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
            <?php echo $this->load->view('topbar_approver');?>
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
                        <h4 class="page-title">Inbox Suggestion System</h4>
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
                                <h5 class="card-title">List Data OPL</h5>
                                <div class="table-responsive">
                                    <table id="example4" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                              <th>No. Registrasi</th>
                                              <th>Perbaikan</th>
                                              <th>Tema</th>
                                              <th style="width:125px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>No. Registrasi</th>
                                              <th>Perbaikan</th>
                                              <th>Tema</th>
                                              <th style="width:125px;">Action</th>
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
                    <div class="form-body">
                        <div class="form-group">
                          <div class="row">
                            <label class="control-label col-md-3">Tema</label>
                              <div class="col-md-3">
                                <input type="hidden" value="" name="id_opl"/> 
                                <input name="TEMA" placeholder="TEMA" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                              </div>
                            <label class="control-label col-md-3">NO. Registrasi</label>
                              <div class="col-md-3">
                                <input name="NO_REGISTRASI" placeholder="NO_REGISTRASI" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Usulan Perbaikan</label>
                                <div class="input-group">
                                  <textarea name="PERBAIKAN" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                  <span class="help-block"></span>
                                </div>
                            </div>

                        
                        <div class="form-group">
                            <label class="control-label col-md-5">Diusulkan Oleh</label>
                            <div class="col-md-6">
                                <table class="form-control" id="tabel_nik">
                                  
                                </table>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                            <label class="control-label col-md-5">BEFORE</label>
                                          <div id="image_before"></div> 
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-md-6">
                                            <label class="control-label col-md-5">AFTER</label>
                                          <div id="image_after"></div> 
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Keterangan Before</label>
                            <div class="input-group">
                                <textarea name="keterangan_before" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Keterangan After</label>
                            <div class="input-group">
                                <textarea name="keterangan_after" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Quality Before</label>
                            <div class="input-group">
                                <textarea name="bq" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Quality After</label>
                            <div class="input-group">
                                <textarea name="aq" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Cost Before</label>
                            <div class="input-group">
                                <textarea name="bc" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Cost After</label>
                            <div class="input-group">
                                <textarea name="ac" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Delivery Before</label>
                            <div class="input-group">
                                <textarea name="bd" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Delivery After</label>
                            <div class="input-group">
                                <textarea name="ad" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Safety Before</label>
                            <div class="input-group">
                                <textarea name="bs" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Safety After</label>
                            <div class="input-group">
                                <textarea name="as" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Moral Before</label>
                            <div class="input-group">
                                <textarea name="bm" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Moral After</label>
                            <div class="input-group">
                                <textarea name="am" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Environtment Before</label>
                            <div class="input-group">
                                <textarea name="be" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label col-md-6">Environtment After</label>
                            <div class="input-group">
                                <textarea name="ae" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                         </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Koreksi</label>
                            <div class="input-group">
                                <textarea name="KOREKSI" id="KOREKSI" class="form-control" rows="3" placeholder="Enter ..." ></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        </div> <!-- form group --> 
                    </div>  <!-- form body -->     
                </form>
            </div>

            <div class="modal-footer">
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Accept</button>
              <button type="button" id="btnSave" onclick="koreksi()" class="btn btn-primary">Koreksi</button>
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
    <script src="<?php echo base_url();?>assets/extra-libs/DataTables/datatables.min.js"></script>approver/c_approver/ajax_list_opl
    
    <script>
        var save_method; //for save method string
var table;

$(document).ready(function() {
    $('#modal_form').on('hidden.bs.modal', function () {
      location.reload();
    })
    //datatables
    table = $('#example4').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('approver/c_approver/ajax_list_opl')?>",
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

function edit_person_opl(ID_OPL)
{
   
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('approver/c_approver/ajax_approve_opl/')?>/" + ID_OPL,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
                        
                       $.each(data,function(index,item){
                        $("<tr>").append(
                        $("<td>").text(item.nik_karyawan),
                        $("<td>").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"),
                        $("<td>").text(item.nama_karyawan)
                        ).appendTo("#tabel_nik");
                        $('[name="id_opl"]').val(item.id_opl);
                        $('[name="NO_REGISTRASI"]').val(item.no_registrasi);
                        $('[name="TEMA"]').val(item.tema);
                        $('[name="PERBAIKAN"]').val(item.perbaikan);
                        $('[name="keterangan_before"]').val(item.keterangan_before);
                        $('[name="keterangan_after"]').val(item.keterangan_after);
                        $('[name="aq"]').val(item.aq);
                        $('[name="bq"]').val(item.bq);
                        $('[name="ac"]').val(item.ac);
                        $('[name="bc"]').val(item.bc);
                        $('[name="ad"]').val(item.ad);
                        $('[name="bd"]').val(item.bd);
                        $('[name="as"]').val(item.a_s);
                        $('[name="bs"]').val(item.bs);
                        $('[name="am"]').val(item.am);
                        $('[name="bm"]').val(item.bm);
                        $('[name="ae"]').val(item.ae);
                        $('[name="be"]').val(item.be);
                        $('#image_before').html('<img src="<?php echo base_url();?>/assets/foto_opl/'+item.image_before+'" height="300px" width="380px">');
                        $('#image_after').html('<img src="<?php echo base_url();?>/assets/foto_opl/'+item.image_after+'" height="300px" width="380px">');

                       });

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail One Point Lesson'); // Set title to Bootstrap modal title
            
            
            
           

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

   
        url = "<?php echo site_url('approver/c_approver/ajax_update_opl')?>";
    
    
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
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function koreksi()
{
    
    var url;

   
        url = "<?php echo site_url('approver/c_approver/ajax_koreksi_opl')?>";
    
        var koreksi = document.getElementById("KOREKSI").value;
        if (koreksi == "") {
            alert('Anda harus mengisi kolom Koreksi !');
            $("#KOREKSI").focus();
            return false;
        }else{
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
}
    </script>

</body>

</html>