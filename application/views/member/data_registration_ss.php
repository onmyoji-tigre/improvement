<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Header -->
<?php $this->load->view('header');?>
<style>
    .prev_container{
      overflow: auto;
      width: 380px;
      height: 300px;
    }
    .prev_thumb{
      height: 300px;
    }
</style>
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
                                <h5 class="card-title">List Data SS</h5>
                                <div class="table-responsive">
                                    <table id="example3" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                              <th>Tanggal Registrasi</th>
                                              <th>No. Registrasi</th>
                                              <th>Tema</th>
                                              <th>Perbaikan</th>
                                              <th>Status SS</th>
                                              <th>Status OPL</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  
                                               foreach ($list_data_ss -> result() as $row)  
                                            {  
                                            ?>
                                          <tr>
                                          <td><?php echo $row->TGL_USUL;?></td>
                                          <td><?php echo $row->NO_REGISTRASI;?></td>
                                          <td><?php echo $row->TEMA;?></td>
                                          <td><a href="javascript:void()" style="color:green;" title="Accept" onclick="edit_person('<?php echo $row->ID_IMPROVEMENT;?>')"><?php echo $row->PERBAIKAN;?></a></td>
                                          <?php
                                            if($row->STATUS =='p')
                                            {
                                                echo "<td>Process Approver</td>";
                                            }
                                            elseif($row->STATUS =='a')
                                            {
                                                echo "<td>Process Koordinator</td>";
                                            }
                                            elseif($row->STATUS =='d')
                                            {
                                                echo "<td>Process Sekretariat</td>";
                                            }
                                            elseif($row->STATUS =='r')
                                            {
                                                echo '<td><a href="javascript:void()" title="Accept" onclick="show_reject('."'".$row->ID_IMPROVEMENT."'".')"> Rejected by Koordinator</a></td>';
                                            }
                                            elseif($row->STATUS =='j')
                                            {
                                                echo '<td><a href="javascript:void()" title="Accept" onclick="show_reject('."'".$row->ID_IMPROVEMENT."'".')"> Rejected by Approver</a></td>';
                                            } 
                                            elseif($row->STATUS =='c')
                                            {
                                                echo "<td>Complete</td>";
                                            }
                                            else{
                                                echo"<td>Process Corection</td>";
                                            }
                                            ?>
                                            <?php
                                            if($row->OPL=='0')
                                            {
                                            $NIK_KAR = $this->session->userdata('nik_karyawan');
                                                if($row->NIK_KARYAWAN != $NIK_KAR)
                                                {
                                                    echo "<td>Pending</td>";
                                                }

                                                else
                                                {
                                                    if($row->STATUS != 'c')
                                                    {
                                                        echo "<td>Pending</td>";
                                                    }
                                                    else
                                                    echo '<td><a href="javascript:void()" title="'.$row->NIK_KARYAWAN.'" onclick="add_opl('."'".$row->ID_IMPROVEMENT."'".')"> Pending</a></td> ';    
                                                }
                                                
                                            }
                                            elseif($row->OPL=='1')
                                            {
                                               $sqlopl = "SELECT * FROM ira_data_opl WHERE no_registrasi='".$row->NO_REGISTRASI."' ";
                                               $query = $this->db->query($sqlopl);
                                               foreach($query->result() as $rows )
                                               {
                                                if($rows->status=='a')
                                                {
                                                ?>
                                                <td><a class="iframe" href="javascript:void()" title="Complete" onclick="view_opl('<?php echo $rows->id_opl;?>')">In Process Approver</a></td>                      
                                                <?php                        
                                                  
                                                }
                                                elseif($rows->status=='c')
                                                {?>
                                                <td><a class=iframe" href="javascript:void()" title="Complete" onclick="view_opl('<?php echo $rows->id_opl;?>')">In Process Koordinator</a></td>
                                                <?php
                                                  
                                                }
                                                
                                                elseif($rows->status=='r')
                                                {?>
                                                <td><a class="iframe" href="javascript:void()" title="Complete" onclick="view_opl('<?php echo $rows->id_opl;?>')">Reject</a></td>
                                                <?php  
                                                }
                                                
                                                 elseif($rows->status=='b')
                                                {?>
                                                <td>Koreksi</td>
                                                <?php  
                                                }
                                                
                                                else
                                                {
                                                ?>
                                                <td><a class="iframe" href="javascript:void()" title="Complete" onclick="view_opl('<?php echo $rows->id_opl;?>')">Complete</a></td>
                                                <?php
                                                
                                                }
                                               }
                                               
                                            }
                                            ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
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
                                            <input name="TEMA" placeholder="TEMA" class="form-control form-white" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 1rem;">
                                         <div class="col-md-6">
                                        <label class="control-label col-md-5">Diusulkan Oleh</label>
                                       
                                            <table class="form-control form-white" id="NIK_KARYAWAN">
                                              
                                            </table>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-3">
                                        <label class="control-label col-md-12">Target Penyelesaian</label>
                                        
                                            <input name="PENYELESAIAN" placeholder="PENYELESAIAN" class="form-control form-white" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 1rem;">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Latar Belakang</label>
                                            <div class="input-group">
                                                <textarea name="LATAR_BELAKANG" class="form-control form-white" rows="4" placeholder="Enter ..." readonly></textarea>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Usulan Perbaikan</label>
                                            <div class="input-group">
                                                <textarea name="PERBAIKAN" class="form-control form-white" rows="4" placeholder="Enter ..."  readonly></textarea>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 1rem;">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-3">Target/Manfaat</label>
                                            <div class="input-group">
                                                <textarea name="MANFAAT" class="form-control form-white" rows="4" placeholder="Enter ..."  readonly></textarea>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-12">Alat & Bahan</label>
                                            <div class="input-group">
                                                <textarea name="ALAT_BAHAN" class="form-control form-white" rows="4" placeholder="Enter ..."  readonly></textarea>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 1rem;">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-3">Biaya</label>
                                            <div class="col-md-6">
                                                <input name="BIAYA" placeholder="BIAYA" class="form-control form-white" type="text" readonly>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-3">No WR</label>
                                            <div class="col-md-6">
                                                <input name="NO_WR" placeholder="NO_WR" class="form-control form-white" type="text" readonly>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
    <div class="modal fade" id="modal_view_opl" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title-asik">Data OPL</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body form">
                    <form action="#" id="form_view_opl" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                              <div class="row">
                                
                                <label class="control-label col-md-3">NO. Registrasi</label>
                                  <div class="col-md-3">
                                    <input name="NO_REGISTRASI2" placeholder="NO_REGISTRASI" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                  </div>
                                  <label class="control-label col-md-3">Tema</label>
                                  <div class="col-md-3">
                                    <input type="hidden" value="" name="id_opl2"/> 
                                    <input name="TEMA2" placeholder="TEMA" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                  </div>
                                <label class="control-label col-md-3">NO. OPL</label>
                                  <div class="col-md-3">
                                    <input name="NOOPL" placeholder="NO. OPL" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label col-md-3">Usulan Perbaikan</label>
                                    <div class="input-group">
                                      <textarea name="PERBAIKAN2" class="form-control" rows="2" placeholder="Enter ..."  readonly></textarea>
                                      <span class="help-block"></span>
                                    </div>
                                </div>

                            
                            <div class="form-group">
                                <label class="control-label col-md-5">Diusulkan Oleh</label>
                                <div class="col-md-6">
                                    <table class="form-control" id="view_opl2">
                                      
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
                                    <textarea name="keterangan_before2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Keterangan After</label>
                                <div class="input-group">
                                    <textarea name="keterangan_after2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
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
                                    <textarea name="bq2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Quality After</label>
                                <div class="input-group">
                                    <textarea name="aq2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
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
                                    <textarea name="bc2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Cost After</label>
                                <div class="input-group">
                                    <textarea name="ac2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
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
                                    <textarea name="bd2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Delivery After</label>
                                <div class="input-group">
                                    <textarea name="ad2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
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
                                    <textarea name="bs2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Safety After</label>
                                <div class="input-group">
                                    <textarea name="as2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
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
                                    <textarea name="bm2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Moral After</label>
                                <div class="input-group">
                                    <textarea name="am2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
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
                                    <textarea name="be2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label col-md-6">Environtment After</label>
                                <div class="input-group">
                                    <textarea name="ae2" class="form-control" rows="3" placeholder="Enter ..."  readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                             </div>
                            </div>
                            

                            </div> <!-- form group --> 
                        </div>  <!-- form body -->     
                    </form>
                </div>
                
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modal_alasan_reject" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title-reject">Alasan Reject</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body form">
                    <form action="#" id="form_alasan_reject" class="form-horizontal">
                        <input type="hidden" value="" name="ID_IMPROVEMENT"/> 
                        <div class="form-body">
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea name="REJECT" class="form-control" rows="5" placeholder="Enter ..." readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        <div class="modal fade" id="modal_opl" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title-reject">Input Data OPL</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body form">
                    <form action="<?php echo base_url();?>index.php/member/c_member/save_opl" method="POST" id="form_opl" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" value="" name="ID_IMPROVEMENT"/> 
                        <div class="form-body">
                            <input type="hidden" value="" name="ID_IMPROVEMENT"/> 
                            <div class="form-group">
                              <div class="row">
                                <label class="control-label col-md-3">No. Registrasi</label>
                                <div class="col-md-3">
                                    <input name="NO_REGISTRASI" placeholder="NO REGISTRASI" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <label class="control-label col-md-2">Tema</label>
                                <div class="col-md-3">
                                    <input name="TEMA" placeholder="TEMA" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-3">Perbaikan</label>
                                <div class="input-group">
                                    <textarea name="PERBAIKAN" class="form-control" rows="3" placeholder="Enter ..." readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Diusulkan Oleh</label>
                                <div class="col-md-6">
                                    <table class="form-control" id="NIK_KARYAWAN2">
                                      
                                    </table>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Foto OPL</label>
                                <div class="row">
                                  <div class="col-md-6">
                                    <input name="beforeimage" class="file" id="file1" type='file' multiple title="test #1" required="required" />
                                    <div id="prev_file1"></div>
                                  </div>
                                  <div class="col-md-6">
                                    <input name="afterimage" class="file" id="file2" type='file' multiple title="test #2" required="required" />
                                    <div id="prev_file2"></div>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Keterangan Sebelum</label>
                                    <textarea name="keterangan_before" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Keterangan Sesudah</label>
                                    <textarea name="keterangan_after" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Quality Sebelum</label>
                                    <textarea name="bq" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Quality Sesudah</label>
                                    <textarea name="aq" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Cost Sebelum</label>
                                    <textarea name="bc" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Cost Sesudah</label>
                                    <textarea name="ac" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Delivery Sebelum</label>
                                    <textarea name="bd" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Delivery Sesudah</label>
                                    <textarea name="ad" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Safety Sebelum</label>
                                    <textarea name="bs" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Safety Sesudah</label>
                                    <textarea name="as" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Moral Sebelum</label>
                                    <textarea name="bm" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-5">Moral Sesudah</label>
                                    <textarea name="am" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label class="control-label col-md-12">Environtment Sebelum</label>
                                    <textarea name="be" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label col-md-12">Environtment Sesudah</label>
                                    <textarea name="ae" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                              <label>Koordinator</label>
                                <div class="col-md-5">
                                  <select class="form-control" name="koordinator" readonly >
                                  <?php foreach($koordinator as $row)
                                    { 
                                    echo '<option value="'.$row->NIK_KARYAWAN.'">'.$row->NAMA_KARYAWAN.'</option>';
                                    }
                                ?>
                                 </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Approver</label>
                                <div class="col-md-5">
                                    <input name="nik_approver" class="form-control" type="text" hidden>
                                    <input name="approver" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                            
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        $(document).ready(function() {
            //datatables
            $('#modal_form').on('hidden.bs.modal', function () {
              location.reload();
            });
            $('#example3').DataTable();
            $('#modal_opl').on('hidden.bs.modal', function () {
            location.reload();
            });
            $('#modal_view_opl').on('hidden.bs.modal', function () {
            location.reload();
            });
            $('.file').preimage();
            $('#modal_alasan_reject').on('hidden.bs.modal', function () {
            location.reload();
            });
        });

        function edit_person(ID_IMPROVEMENT)
        {
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('approver/c_approver/ajax_edit/')?>/" + ID_IMPROVEMENT,
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
                url = "<?php echo site_url('approver/c_approver/ajax_update')?>";
            

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

        function koreksi()
        {
            
            var url;

           
                url = "<?php echo site_url('approver/c_approver/ajax_koreksi')?>";
            
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

        function reject()
        {
            var url;

           
                url = "<?php echo site_url('approver/c_approver/ajax_reject_approver')?>";
            

            var reject = document.getElementById("REJECT").value;
                if (reject == "") {
                    alert('Anda harus mengisi kolom Alasan Reject !');
                    $("#REJECT").focus();
                    return false;
                }else{
                    
                
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

        function add_opl(ID_IMPROVEMENT)
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
                            ).appendTo("#NIK_KARYAWAN2");
                            $('[name="ID_IMPROVEMENT"]').val(item.ID_IMPROVEMENT);
                            $('[name="NIK"]').val(item.NIK);
                            $('[name="TEMA"]').val(item.TEMA);
                            $('[name="NO_REGISTRASI"]').val(item.NO_REGISTRASI);
                            $('[name="PERBAIKAN"]').val(item.PERBAIKAN);
                            $('[name="approver"]').val(item.nama_approver);
                            $('[name="nik_approver"]').val(item.approver);
                            $('[name="nik_kar"]').val(item.NIK);
                            
                           });

                $('#modal_opl').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('OPL'); // Set title to Bootstrap modal title
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function view_opl(ID_OPL)
    {
       
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('member/c_member/ajax_approve_opl/')?>/" + ID_OPL,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                            
                           $.each(data,function(index,item){
                            $("<tr>").append(
                            $("<td>").text(item.nik_karyawan),
                            $("<td>").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"),
                            $("<td>").text(item.nama_karyawan)
                            ).appendTo("#view_opl2");
                            $('[name="id_opl2"]').val(item.id_opl);
                            $('[name="NO_REGISTRASI2"]').val(item.no_registrasi);
                            $('[name="NOOPL"]').val(item.no_opl);
                            $('[name="TEMA2"]').val(item.tema);
                            $('[name="PERBAIKAN2"]').val(item.perbaikan);
                            $('[name="keterangan_before2"]').val(item.keterangan_before);
                            $('[name="keterangan_after2"]').val(item.keterangan_after);
                            $('[name="aq2"]').val(item.aq);
                            $('[name="bq2"]').val(item.bq);
                            $('[name="ac2"]').val(item.ac);
                            $('[name="bc2"]').val(item.bc);
                            $('[name="ad2"]').val(item.ad);
                            $('[name="bd2"]').val(item.bd);
                            $('[name="as2"]').val(item.a_s);
                            $('[name="bs2"]').val(item.bs);
                            $('[name="am2"]').val(item.am);
                            $('[name="bm2"]').val(item.bm);
                            $('[name="ae2"]').val(item.ae);
                            $('[name="be2"]').val(item.be);
                            $('#image_before').html('<img src="<?php echo base_url();?>/assets/foto_opl/'+item.image_before+'" height="300px" width="380px">');
                            $('#image_after').html('<img src="<?php echo base_url();?>/assets/foto_opl/'+item.image_after+'" height="300px" width="380px">');

                           });

                $('#modal_view_opl').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail One Point Lesson'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function show_reject(ID_IMPROVEMENT)
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
                            $('[name="REJECT"]').val(item.REJECT);
                           });

                $('#modal_alasan_reject').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title-reject').text('Alasan Reject'); // Set title to Bootstrap modal title
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    </script>
    <script type="text/javascript">
    (function( $ ){
      var settings = {
          'scale': 'contain', // cover
          'prefix': 'prev_',
          'types': ['image/gif', 'image/png', 'image/jpeg'],
          'mime': {'jpe': 'image/jpeg', 'jpeg': 'image/jpeg', 'jpg': 'image/jpeg', 'gif': 'image/gif', 'png': 'image/png', 'x-png': 'image/png', 'tif': 'image/tiff', 'tiff': 'image/tiff'}
      };

      var methods = {
         init : function( options ) {
        settings = $.extend(settings, options);
        
        return this.each(function(){
          $(this).bind('change', methods.change);
          $('#'+settings['prefix']+this.id).html('').addClass(settings['prefix']+'container');
        });
         },
         destroy : function( ) {
        return this.each(function(){
          $(this).unbind('change');
        })
         },
         change : function(event) { 
          var id = this.id
          
          $('#'+settings['prefix']+id).html('');
          
          if(window.FileReader){
            for(i=0; i<this.files.length; i++){
            if(!$.inArray(this.files[i].type, settings['types']) == -1){
              window.alert("File of not allowed type"); 
              return false
            }
          }
          
              for(i=0; i<this.files.length; i++){
                var reader = new FileReader();
              reader.onload = function (e) {
                $('<div />').css({'background-image': ('url('+e.target.result+')'), 'background-repeat': 'no-repeat', 'background-size': settings['scale'] }).addClass(settings['prefix']+'thumb').appendTo($('#'+settings['prefix']+id));
              };
              reader.readAsDataURL(this.files[i]);
              }
          }else{
            //if(window.confirm('Internet Explorer do not support required HTML5 features. \nPleas, download better browser - Firefox, Google Chrome, Opera... \nDo you want to download and install Google Chrome now?')){ window.location("//google.com/chrome"); }
          }
         }
      };

      $.fn.preimage = function( method ) {
        if ( methods[method] ) {
        return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
        return methods.init.apply( this, arguments );
        } else {
        $.error( 'Method ' +  method + ' does not exist on jQuery.preimage' );
        }    
      
      };

    })( jQuery );

</script>

</body>

</html>