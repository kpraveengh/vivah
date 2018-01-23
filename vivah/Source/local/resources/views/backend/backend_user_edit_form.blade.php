
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         Add User Details
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          
            <li class="active">Add User Details</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Form</h3>
                </div><!-- /.box-header -->
                  
                  <div class="box-header with-border">
                  <h3 class="box-title"></h3>
				    <div class="message" tabindex='1'></div>
                </div>
                  <?php

                  
                  foreach($user_list as $list)
								{
								?>
                  
                <!-- form start -->
                <form role="form" id="backend_user_update">
                     <input type="hidden" name="id"  value="<?php echo $list->id;?>" >
                
                  <div class="box-body">
                    <div class="form-group">
                     <label>Username</label>
                <input class="form-control regcom sample" placeholder="Username" name="username" value="<?php echo $list->username;?> " required>
                    </div>
                   
                        
                                         <div class="form-group">
                                            <label>Role</label>
                                           <input class="form-control regcom sample" placeholder="Role" name="role" value="<?php echo $list->role;?> "    required>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control regcom" placeholder="E-mail" name="email"  value="<?php echo $list->email;?> " >
                                            
                                        </div>
                                    <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input class="form-control regcom" placeholder="Mobile Number" name="mobile"  value="<?php echo $list->mobile;?> " >
                                            
                                        </div>
                      
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                   <?php
								    }
								    ?>
                  <div class="adminuser1"></div>
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
						  $('#backend_user_update').validate({	
				rules: {
					
			
            username: "required",   
          
             password: {
            required: true,
            minlength: 4,
			maxlength:12
                  },
			role: "required",           
           
       /* email: {
            required: true,
            email: true
                   },
			 
            mobile: {
            required: true,
			number:true,
			
            minlength: 10
                  },*/
        },
        highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		submitHandler: function(form) {
  

  		var value =$("#backend_user_update").serialize() ;
 
        
		$.ajax({
		type:'POST',
		url: "{{ url('admin/backend-user-update') }}",
		data:value,
		success:function (user_update){
        $(".adminuser1").show();
        console.log(user_update);
												
            if(user_update==1){
										
                 $(".adminuser1").html('<div class="alert alert-success">Success</div>'); 
          setTimeout(function(){$(".adminuser1").hide(); }, 3000);

													
               }
													
            else{
														
                $(".adminuser1").html('<div class="alert alert-danger">Error</div>'); 
          setTimeout(function(){$(".adminuser1").hide(); }, 3000);
                
														
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
