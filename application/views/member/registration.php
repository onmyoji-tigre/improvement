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
                        <h4 class="page-title">Form Registration</h4>&nbsp;
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <?php echo form_open("member/c_member/save"); ?>
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Registration Suggestion System Form</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tema</label>
                                        <div class="col-sm-2">
                                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="tema">
                                            <option value="QUALITY">QUALITY</option>
                                            <option value="COST">COST</option>
                                            <option value="DELIVERY">DELIVERY</option>
                                            <option value="SAFETY">SAFETY</option>
                                            <option value="MORAL">MORAL</option>
                                            <option value="ENVIRONTMENT">ENVIRONTMENT</option>
                                        </select>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-2">
                                            <input type="button" id="hidden10" class="btn btn-success" value="Tambah Pengusul ke-2" onclick="addPengusul(2); document.getElementById(&#39;hidden10&#39;).style.display=&#39;none&#39;; document.getElementById(&#39;hidden11&#39;).style.display=&#39;block&#39;;"   required />
                                            <input type="button" id="hidden11" class="btn btn-success" value="Tambah Pengusul ke-3" onclick="addPengusul(3); document.getElementById(&#39;hidden11&#39;).style.display=&#39;none&#39;; document.getElementById(&#39;hidden12&#39;).style.display=&#39;block&#39;;" style="display:none;color: white; "  required/>
                                            <input type="button" id="hidden13" class="btn btn-success" value="Tambah Pengusul" onclick="addPengusul(4); document.getElementById(&#39;hidden13&#39;).style.display=&#39;none&#39;" style="display:none" required />
                                        </div>
                                    </div>
                                    
                                    <!-- Pengusul Utama -->
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Pengusul</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan[]" value="<?php echo $nama_karyawan; ?>" readonly>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="nik_karyawan" name="nik_karyawan[]" value="<?php echo $nik_karyawan; ?>" readonly>
                                        </div>
                                    </div>
                                    <!-- Pengusul Ke-2 -->
                                    <div id="informal2" style="display:none">
                                    <div class="form-group row" > <!-- id="informal2" style="display:none" -->
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-4">
                                            <?php 
                                                $jsArray2 = "var nikKar2 = new Array();\n";  
                                                echo '<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="nama_karyawan[]" onchange="changeValue2(this.value)">';  
                                                echo '<option>--Pilih Karyawan--</option>';  
                                                foreach ($employee as $row) {  
                                                    echo '<option value="' . $row->NAMA_KARYAWAN . '">' . $row->NAMA_KARYAWAN . '</option>';  
                                                    $jsArray2 .= "nikKar2['" . $row->NAMA_KARYAWAN . "'] = {name:'" . addslashes($row->NIK_KARYAWAN) . "'};\n";  
                                                }  
                                                echo '</select>';  
                                            ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="p1nik" name="nik_karyawan[]" readonly>
                                                <button id="btn1" type="button" onclick="eraseText()">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Pengusul Ke-3 -->
                                    <div id="informal3" style="display:none">
                                    <div class="form-group row" > <!-- id="informal3" style="display:none" -->
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-4">
                                            
                                            <?php 
                                                $jsArray = "var nikKar = new Array();\n";  
                                                echo '<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="nama_karyawan[]" onchange="changeValue(this.value)">';  
                                                echo '<option>--Pilih Karyawan--</option>';  
                                                foreach ($employee as $row) {  
                                                    echo '<option value="' . $row->NAMA_KARYAWAN . '">' . $row->NAMA_KARYAWAN . '</option>';  
                                                    $jsArray .= "nikKar['" . $row->NAMA_KARYAWAN . "'] = {name:'" . addslashes($row->NIK_KARYAWAN) . "'};\n";  
                                                }  
                                                echo '</select>';  
                                            ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="p2nik" name="nik_karyawan[]" readonly>
                                                <button id="btn2" type="button" onclick="eraseText2()">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Latar Belakang</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="4" name="latar_belakang" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Usulan Perbaikan</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="4" name="usulan_perbaikan" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Target Manfaat</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="4" name="target_manfaat" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Target Penyelesaian</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="datepicker-autoclose" name="tgl_penyelesaian" placeholder="dd-mm-yyyy" autocomplete="off" required="required">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Alat / Bahan</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="4" name="alat_bahan" placeholder="Isi Strip (-) Jika Kosong" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Biaya</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="biaya" name="biaya" onkeypress="return isNumberKey(event);" autocomplete="off" placeholder="Isi 0 jika tidak ada biaya" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">No. WR</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="no_wr" name="no_wr" autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                          <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Pilih CG</label>
                                          <div class="col-lg-2">
                                                <input type="radio" value="plant" name="cg" required="required"> CG PLANT
                                            <!-- /input-group -->
                                          </div>
                                          <!-- /.col-lg-6 -->
                                           <div class="col-lg-2">
                                                <input type="radio" value="office" name="cg" required="required"> CG OFFICE
                                            </div>
                                      </div>

                                    <div class="form-group row">
                                        <label style="display: none;" id="label_line" class="col-sm-3 text-right control-label col-form-label">Line Proses</label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="line_proses" id="line_proses" style="display: none;">
                                              <option value="0">-- Pilih Line Proses --</option>
                                              <?php foreach($line_proses as $row)
                                              { 
                                                 echo '<option value="'.$row->id_line_proses.'">'.$row->nama_line_proses.'</option>';
                                              }
                                              ?>
                                            </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label style="display: none;" id="label_area" class="col-sm-3 text-right control-label col-form-label">Area Mesin</label>
                                        <div class="col-lg-3">
                                        <select class="form-control" name="area_mesin" id="area_mesin" style="display: none;">
                                          <option value="0">-- Pilih Area Mesin --</option>
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label style="display: none;" id="label_jenis" class="col-sm-3 text-right control-label col-form-label">Jenis Mesin</label>
                                        <div class="col-lg-3">
                                        <select class="form-control" name="jenis_mesin" id="jenis_mesin" style="display: none;">
                                          <option value="0">-- Pilih Jenis Mesin --</option>
                                        </select>
                                      </div>
                                      </div>


                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Koordinator</label>
                                        <div class="col-sm-3">
                                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="koordinator">
                                            <?php foreach($koordinator as $row)
                                              { 
                                               echo '<option value="'.$row->NIK_KARYAWAN.'">'.$row->NAMA_KARYAWAN.'</option>';
                                              }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Approver</label>
                                        <div class="col-sm-3">
                                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="approver">
                                            <?php foreach($approver as $row)
                                            { 
                                               echo '<option value="'.$row->NIK_KARYAWAN.'">'.$row->NAMA_KARYAWAN.'</option>';
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <?php echo form_close(); ?>
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
    <!-- This Page JS -->
    <script src="<?php echo base_url();?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/pages/mask/mask.init.js"></script>
    <script src="<?php echo base_url();?>assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?php echo base_url();?>assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/quill/dist/quill.min.js"></script>

    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>
    <script type="text/javascript">
        function addPengusul(a){
            document.getElementById('informal'+a).style.display ='block';
        }
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function eraseText() {
             document.getElementById("hidden10").style.display='block';
             document.getElementById("hidden11").style.display='none';
             document.getElementById("informal2").style.display='none';
             document.getElementById("informal3").style.display='none';
             document.getElementById("pengusul1").value = "";
             document.getElementById("p1nik").value = "";
             document.getElementById("pengusul2").value = "";
             document.getElementById("p2nik").value = "";
        }

        function eraseText2() {
             document.getElementById("hidden11").style.display='block';
             document.getElementById("informal3").style.display='none';
             document.getElementById("pengusul2").value = "";
             document.getElementById("p2nik").value = "";
        }

        
    </script>
    <script type="text/javascript">
        <?php echo $jsArray; ?>
            function changeValue(id){
                document.getElementById('p2nik').value = nikKar[id].name;
            };
    </script>
    <script type="text/javascript">
        <?php echo $jsArray2; ?>
            function changeValue2(id){
                document.getElementById('p1nik').value = nikKar2[id].name;
            };
    </script>
    <script type="text/javascript">
      $("input[type='radio']").change(function(){
       
      if($(this).val()=="plant")
      {
          $("#label_line").show();
          $("#line_proses").show();
          $("#label_area").show();
          $("#area_mesin").show();
          $("#label_jenis").show();
          $("#jenis_mesin").show();
      }
      else
      {
          $("#label_line").hide();
          $("#line_proses").hide(); 
          $("#label_area").hide();
          $("#area_mesin").hide();
          $("#label_jenis").hide();
          $("#jenis_mesin").hide();
      }
          
      });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('#line_proses').change(function(){
            var id=$(this).val();
            $.ajax({
              url : "<?php echo base_url('member/c_member/getAreamesin');?>",
              method : "POST",
              data : {id: id},
              async : false,
              dataType : 'json',
              success: function(data){
                var html = '';
                html += '<option value="0">-- Pilih Area Mesin --</option>';
                      var i;
                      var j = 1;
                      for(i=0; i<data.length; i++){
                          html += '<option value='+ j++ +'>'+data[i].nama_area_mesin+'</option>';
                      }
                      $('#area_mesin').html(html);
                
                }
              });
            });

           $('#area_mesin').change(function(){
            var idjenis=$(this).val();
            $.ajax({
              url : "<?php echo base_url('member/c_member/getJenismesin');?>",
              method : "POST",
              data : {idjenis: idjenis},
              async : true,
              dataType : 'json',
              success: function(data){
                var html = '';
                html += '<option value="0">-- Pilih Jenis Mesin --</option>';
                      var i;
                      var j =1;
                      for(i=0; i<data.length; i++){
                          html += '<option value= ' + j++ +'>'+data[i].nama_jenis_mesin+'</option>';
                      }
                      $('#jenis_mesin').html(html);
                
                }
              });
            });
        });
    </script>
</body>

</html>