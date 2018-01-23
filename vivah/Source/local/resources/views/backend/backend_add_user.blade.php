
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
               
                  $get_role_details=\DB::table('role')
                                    ->where('r_id','!=','5')
                                   ->get();
                  
                  
                   
                 
                  ?>
                <!-- form start -->
                <form role="form" id="add_backend_user">
                   
                
                  <div class="box-body">
                     
                    <div class="form-group">
                     <label>Username</label>
                <input class="form-control regcom sample" placeholder="Username" name="username" id="signup-username" required>
                    </div>
                   
                        <div class="form-group">
                                            <label>Password</label>
                                           <input class="form-control regcom" placeholder="Password" name="password" id="signup-password" type="password" required>
                                        </div>
                                         <div class="form-group">
                                            <label>Role</label>
                                           <select class="form-control regcom sample"  name="role_id"  required>
                                               <?php
                                               foreach($get_role_details as $role_value)
                                                   {
                                                   ?>
                                               <option value="<?php echo $role_value->r_id; ?>"><?php echo $role_value->rolename;?> </option>
                                               <?php
                                               }
                                               ?>
                                             </select>
                                             
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control regcom" placeholder="E-mail" name="email"  id="signup-email" required>
                                            
                                        </div>
                                    <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input class="form-control regcom" placeholder="Mobile Number" name="mobile"   required>
                                            
                                        </div>
                      
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>

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


   jQuery.validator.addMethod("accept", function(value, element, param) {
  return value.match(new RegExp("." + param + "$"));
});



 jQuery.extend(jQuery.validator.messages, {
        accept: "Please enter a value ."

        });
   
				 $('#add_backend_user').validate({	
                     
				rules: {
					
			
            username:{
                minlength: 2,
                maxlength: 15,
                accept: "[a-zA-Z]+"
       },
          
             password: {
            required: true,
            minlength: 4,
			maxlength:12
                  },
			role: "required",           
           
        email: {
            required: true,
            email: true
                   },
			 
            mobile: {
            required: true,
			      number:true,
			
            minlength: 10,
            maxlength:15
                  },
        },
        highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		submitHandler: function(form) {
  

  		var value =$("#add_backend_user").serialize() ;
 

		$.ajax({
		type:'POST',
        url: "{{ url('admin/insert-backend-user') }}",
		data: value,
		success:function(res){
         $(".adminuser1").show();
         console.log(res);
					if(res==3){
						$(".adminuser1").focus();
						$(".adminuser1").html('<p class="error">User Already Exist!!!</p>');
						setTimeout(function(){$(".adminuser1").hide(); }, 3000);
					}
					else if(res==0){
						$(".adminuser1").focus();
						$(".adminuser1").html('<p class="error">Sorry Error Occured!!!</p>');
						setTimeout(function(){$(".adminuser1").hide(); }, 3000);
					}else if(res==4){
						$(".adminuser1").focus();
					   $(".adminuser1").html('<p class="error">Email Already Exist!!!</p>');
					   setTimeout(function(){$(".adminuser1").hide(); }, 3000);
					}else{
						$(".adminuser1").focus();

						$(".adminuser1").html('<p class="success">User Registered Successfully</p>');
						setTimeout(function(){$(".adminuser1").hide(); }, 1500);
						$('#add_backend_user')[0].reset();
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
