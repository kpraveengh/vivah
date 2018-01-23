
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Place List
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Update Place List</li>
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
								
                  foreach($place as $place_list)
								{
								?>
                                    <form role="form" id="place_update">
                                         <input type="hidden" name="countryid"  value="<?php echo $place_list->country_id;?>" >
                                         <input type="hidden" name="stateid"  value="<?php echo $place_list->state_id;?>" >
                                         <input type="hidden" name="districtid"  value="<?php echo $place_list->district_id;?>" >
                  <div class="box-body">
                    <div class="form-group">
                      <label>Country</label>
                      <input type="text" class="form-control" name="country" placeholder="Enter Country" value="<?php echo $place_list->country;?>"  required>
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">State</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="state" placeholder="Enter State" value="<?php echo $place_list->state;?>" required>
                    </div>
                     <div class="form-group">
                      <label>District</label>
                      <input type="text" class="form-control" name="district" placeholder="Enter District" value="<?php echo $place_list->district;?>"  required>
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


						  $('#place_update').validate({	
				rules: {
			
            	
			 country:{
                minlength: 2,
                maxlength: 50,
                accept: "[a-zA-Z]+"
       },
            state:{
                minlength: 2,
                maxlength: 15,
                accept: "[a-zA-Z]+"
       },
      district:{
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
  

  		var value =$("#place_update").serialize() ;
 
        
		$.ajax({
		type:'POST',
		url: "{{ url('admin/place-update') }}",
		data:value,
		success:function (place_update){
         $(".ag_msg").show();
        console.log(place_update);
												
            if(place_update==1){
										
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
