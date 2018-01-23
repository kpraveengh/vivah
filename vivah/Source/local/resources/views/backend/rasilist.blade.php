

        
        @include('include.admin.backend_header')
        
        
      
      <!-- Left side column. contains the logo and sidebar -->
         @include('include.admin.backend_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Moon Sign List
          
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
         
            <li class="active">Moon Sign List</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
               <!-- <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div>-->
                  
                  
                  <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                         <th>Sl No.</th>
                         <th>Star</th>
                         <th>Moon Sign</th>
                         <th>Manage</th>                  
                        </tr>
                    </thead>
                      
                       <tbody>
                         <?php
				         
                         $serial=1;
                      
                     foreach($rasilist as $rasi_list)
                      {
                          
                       $rasiid=$rasi_list->rassimoonsign_id;  
                      ?>         
                   
                      <tr>
                          <td><?php echo $serial++;?></td>
                          <td><?php echo $rasi_list->star;?></td>
                          <td><?php echo $rasi_list->rassi_moonsign;?></td>
                          <td><a href='rasi-list-edit/{{$rasiid}}'>
                        <p class="fa fa-edit"> Edit </p>
                        </a> &nbsp;<a href="#"  rasi_id="<?php echo $rasi_list->rassimoonsign_id; ?>" class="rasi_delete" >
                        <p class="fa fa-trash-o"> Delete </p>
                        </a> 
                          </td>
                          
              
              
                
                        </tr>
                     
                   
                      
                      <?php
				         }
                          ?>
                           </tbody>
                    <tfoot>
                      <tr>
                      <th>Sl No.</th>
                        <th>Star</th>
                         <th>Moon Sign</th>
                           <th>Manage</th>    
                      </tr>
                    </tfoot>
                  </table>
                  <div class="delete_show"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
    <!-- DataTables -->
    <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/admin/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/app.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

<script type="text/javascript">
	jQuery(function ($) {
 $(document).on('click', '.rasi_delete', function () {
	
							var thiss=$(this);
							var r = confirm("Do you want to delete?");
							
							if(r==true){
								
                                var rasi_id =$(this).attr('rasi_id') ;
                             
								$.ajax({
									   url: "{{ url('admin/rasi-delete') }}",
									   method:'get',
									   data:{'rasi_id':rasi_id},
									   success:function(rasi_del){
                       $(".delete_show").show();
									   console.log(rasi_del);
										 
                                           if(rasi_del==1){
												thiss.parent().parent().hide();
														}
													 else{
                              $(".delete_show").html('<div class="alert alert-danger">Fail to delete try again!!</div>'); 
          setTimeout(function(){$(".delete_show").hide(); }, 3000);
												
														 }
										                        }
									   });
								         }
												 
				       });					   
				 })
	
</script>


  </body>
</html>
