
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Moon Sign
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Add Moon Sign</li>
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
                <form role="form" id="add_rasi">
                  
                   <div class="box-body"> 
                 <div class="form-group">
                      <label>Star</label>
                      <select class="form-control" name="star_id">
                           <?php
                    foreach($star as $starlist)
                    {
                        ?>
                        <option value="<?php echo $starlist->star_id;?>"><?php echo $starlist->star;?></option>
                        <?php
                    }
                    ?>
                      </select>
                    </div>    
                     </div> 
                  <div class="box-body">
                    <div class="form-group">
                      <label>Rasi</label>
                      <input type="text" class="form-control" name="rasi" placeholder="Enter Rasi"  required>
                    </div>
                   
                       
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                  <div class="message"></div>
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

						  $('#add_rasi').validate({	
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
  

  		var value =$("#add_rasi").serialize() ;
 

		$.ajax({
		type:'POST',
        url: "{{ url('admin/insert-rasi') }}",
		data: value,
		success:function (add_rasi){
       $(".message").show();  
        console.log(add_rasi);
												
            if(add_rasi==1)
            {
				
          window.location="{{ url('admin/rasi-list') }}";

             }
          else{
         $(".message").html('<div class="alert alert-danger">Error</div>'); 
          setTimeout(function(){$(".message").hide(); }, 3000); 
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
