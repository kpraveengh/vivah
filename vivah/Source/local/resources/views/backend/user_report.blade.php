
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')

 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datetimepicker/DateTimePicker.css')}}" />
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Report
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          
            <li class="active">User Report</li>
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
                <form role="form" id="user_report">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Date From</label>
                      <input type="text" class="form-control" name="date_from" placeholder="Pick Your Date" data-field="date" readonly >
                    </div>
                    <div class="form-group">
                      <label>Date To</label>
                      <input type="text" class="form-control" name="date_to" placeholder="Pick Your Date"  data-field="date" readonly>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                   <div id="dtBox"></div>
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
<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker-i18n.js')}}"></script>


 <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
   
$(document).ready(function(){
						  $('#user_report').validate({	
				rules: {
					date_from: {
				
				required: true,
				
				},
			date_to: {
				
				required: true,
				
				},
        },
        highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		submitHandler: function(form) {
  

  		var value =$("#user_report").serialize() ;
 
     
		$.ajax({
		type:'POST',
		url: "{{ url('print/user-report-details')}}",
		data: value,
		success:function (user_rep_dtls){
        console.log(user_rep_dtls);
			 //alert(user_rep_dtls);
												/*if(user_rep_dtls==1){
							
                                                    $(".message").html('success');
							
					//window.location="{!! URL::to('/user_report_dtls_page/" +value +"')!!}";
							
							
						}
						else{
							$(".message").html('No Result Found!');
						}*/
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

 <script type="text/javascript">
$(document).ready(function()
 {
       
     $("#dtBox").DateTimePicker();
       
  
 });
   </script>


  </body>
</html>
