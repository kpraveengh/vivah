
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Moon Sign List
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Update Moon Sign List</li>
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
                <?php
								
                // var_dump($dtls);
								
                  foreach($rasi_list as $rasilist)
								{
                      
								?>
                                    <form role="form" id="rasi_update">
                                         <input type="hidden" name="rasi_id"  value="<?php echo $rasilist->rassimoonsign_id;?>" >
                                        
                  <div class="box-body">
                    <div class="form-group">
                      <label>Rasi</label>
                      <input type="text" class="form-control" name="rasi" placeholder="Enter Rasi" value="<?php echo $rasilist->rassi_moonsign;?>"  required>
                    </div>
                   
                    
                    
                     
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                   <?php
								    }
								    ?>
                   <div class="ag_msg"></div>
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

  
						  $('#rasi_update').validate({	
				rules: {
			
            	
			
             rasi:{
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
  

  		var value =$("#rasi_update").serialize() ;
 
        
		$.ajax({
		type:'POST',
		url: "{{ url('admin/rasi-update') }}",
		data:value,
		success:function (rasi_update){
       $(".ag_msg").show();
        console.log(rasi_update);
												
            if(rasi_update==1){
										
              $(".ag_msg").html('<div class="alert alert-success">Success</div>'); 
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
