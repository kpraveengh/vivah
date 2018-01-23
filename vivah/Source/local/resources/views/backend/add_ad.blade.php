
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datetimepicker/DateTimePicker.css')}}" />

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Advertisement
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Advertisement</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
                  <form  id="myForm" action="{{URL::to('admin/upload-ad')}}" method="post"  accept-charset="UTF-8" >   
            
                  <div class="box-body">
                    <div class="form-group">
                      <label>Advertisement Name</label>
                      <input type="text" class="form-control" name="ad_name" placeholder="Advertisement name"   required>
                    </div>
                    
                      <div class="form-group">
                           <div class="row">
                                           <div class="col-lg-12">
                                             <div class="img_uploadadminapproval">Note: Please select an image 212px/73px</div>
                                          <div class="col-sm-6">
                       <label>Add Advertisement </label>
                          <input type="file" name="ad_image" class="form-control" id="catagry_logo" >
                 
                      </div>                  
                      
                                        </div>
                                        </div>
                                        </div>
                     
                     
                                     
                      
                    <div class="form-group">
                      <label >Uploaded Date</label>
                      <input type="text" class="form-control" name="ad_posted_date"  data-field="date" readonly>
                    </div>
                    <?php
                    $tbl=\DB::table('role')
                          ->get();
                    ?>
                   <div class="form-group">
                      <label>Uploaded By</label><br>
                    
                      <select name="uploaded_by" class="form-control">
                        <?php
                        foreach ($tbl as $table)
                         {
                          ?>
                     
                        <option ><?php echo $table->rolename;?></option>
                        <?php
                      }
                      ?>
                        
                      </select>     
                      
                      
                    
                    </div>     
                   
                   
                      <input type="hidden" name="_token" value="{{ csrf_token()}}">
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="dataImageForm" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                 
                    <div id="dtBox"></div>
                   <div class="ag_msg"></div>
                  <div id="output1"></div> 
           
 
              </div><!-- /.box -->

            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      @include('include.admin.footer')

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/admin/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/app.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker-i18n.js')}}"></script>




 <script src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript">
  
  

$('#myForm').ajaxForm(function(options) { 
              $('.resultss').html(options );
           });

</script>
<script type="text/javascript">
$(document).ready(function()
 {
       
     $("#dtBox").DateTimePicker();
       
  
 });
   </script>

  </body>
</html>
