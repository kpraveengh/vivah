
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Agent Form
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Agent Form</li>
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
                <form role="form" id="agent_reg">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Enter Your Name"  required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1"name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Valid Email" required>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <textarea class="form-control" rows="3" name="address" placeholder="Enter Your Address" required></textarea>
                    </div>
                
                   
                
                    
                   
                    
                      <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control" name="company" placeholder="Enter text">
                    </div>
                      <div class="form-group">
                      <label>Contact Number</label>
                      <input type="text" class="form-control" name="contact_num" placeholder="Enter Valid Contact Number" required>
                    </div>
                       <div class="form-group">
                      <label>Added User</label>
                      <input type="text" class="form-control" name="added_user" placeholder="Enter text" required>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              
                   <div class="ag_msg"></div>
              </div><!-- /.box -->

            </div><!--/.col (left) -->

          </form>

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

						  $('#agent_reg').validate({


      

				rules: {
					email:{
					email : true			 
			},	
       username:{
                minlength: 2,
                maxlength: 15,
                accept: "[a-zA-Z]+"
       },
			contact_num: {
				
				number: true,
				minlength:10,
				maxlength:15
				},
            	
			
			 password: {
				
				minlength:8,
        maxlength:10
				
				},
        address:{
       
        minlength:15,
        maxlength:50
        },
        added_user:
        {
                 minlength: 2,
                maxlength: 15,
                accept: "[a-zA-Z]+"
        },
        },
        highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		submitHandler: function(form) {
  

  		var value =$("#agent_reg").serialize() ;
 

		$.ajax({
		type:'POST',
        url: "{{ url('admin/agent-registration') }}",
		data: value,
		success:function (agent_reg){
       $(".ag_msg").show();
			console.log(agent_reg);
				if(agent_reg==1){
										
                    
                    window.location="{{ url('admin/agent-list') }}";

				                 }

                  else if(agent_reg==2){
                    
                    
                  $(".ag_msg").html('<div class="alert alert-danger">Username Already Exist </div>');     
                         setTimeout(function(){$(".ag_msg").hide(); }, 3000);

                         }
                  else if(agent_reg==3){
                    
                    
                  $(".ag_msg").html('<div class="alert alert-danger">Email Already Exist </div>');     
                         setTimeout(function(){$(".ag_msg").hide(); }, 3000);

                         }

				            else{
                      $(".ag_msg").html('<div class="alert alert-danger">Error</div>'); 
          setTimeout(function(){$(".ag_msg").hide(); }, 3000);
				        
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
