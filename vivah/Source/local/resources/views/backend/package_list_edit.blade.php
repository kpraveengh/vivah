
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Package List Update
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Package List Update</li>
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
                </div>
                  <!-- /.box-header -->
                <!-- form start -->
                  
                  <?php
                 // var_dump($pckgdtls);exit;
                  //echo $getid;
				 foreach($pckgdtls as $pkg)
								{
                        
								?>
                <form role="form" id="package_reg">
                    <input type="hidden" name="pkgid"  value="<?php echo $getid; ?>" >
                      <input type="hidden" name="id"  value="<?php echo $pkg->id; ?>" >
                  <div class="box-body">
                    <div class="form-group">
                      <label>Package Name</label>
                      <input type="text" class="form-control" name="package_name" placeholder="Enter Package Name"  value="<?php echo $pkg->package_name;?>" required>
                    </div>
                    <div class="form-group">
                      <label>Period</label>
                      <select class="form-control" name="period"  required>
                         <option <?php if($pkg->period=='90') { echo "selected='selected'"; } ?>>90</option>  
                         <option <?php if($pkg->period=='180') { echo "selected='selected'"; } ?>>180</option> 
                       
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Rate</label>
                      <input type="text" class="form-control"  name="rate" placeholder="Rate" value="<?php echo $pkg->rate;?>" required>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                  </div>
                </form>
                  <?php
				    }
                    ?>
                                   
                  <div class="pckg_msg"></div>
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


 <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
   
$(document).ready(function(){
						  $('#package_reg').validate({	
				rules: {
					
			rate: {
				
				number: true
				
				},
            	
			
			 
        },
        highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		submitHandler: function(form) {
  

  		var value =$("#package_reg").serialize() ;
 
        alert(value);
		$.ajax({
		type:'POST',
        url: "{{ url('admin/package-update') }}",
		data:value,
		success:function (package_updatet){
       $(".pkg_msg").show();
        console.log(package_updatet);
												
            if(package_updatet==1){
				
                $(".pkg_msg").html('<div class="alert alert-success">success</div>'); 
          setTimeout(function(){$(".pkg_msg").hide(); }, 3000);

				                  }
													
                  else{
				    $(".pkg_msg").html('<div class="alert alert-danger">Error</div>'); 
          setTimeout(function(){$(".pkg_msg").hide(); }, 3000);
				      }
												}
										});
		}
		});
		});
			  /*ajax end here*/
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>

  </body>
</html>
