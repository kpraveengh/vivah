

        
        @include('include.admin.backend_header')
        
        
      
      <!-- Left side column. contains the logo and sidebar -->
         @include('include.admin.backend_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User List
          
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">User List</li>
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
                         <th>Username</th>
                         <th>Email</th>
                          <th>Role</th>
                         <th>Mobile Number</th>
                         <th>Manage</th>                  
                        </tr>
                    </thead>
                      
                         <tbody>
                         <?php
				         
                         $serial=1;
                      
                     foreach($users as $userlist)
                      {
                          
                       $id=$userlist->id;  
                      ?>         
                 
                      <tr>
                          <td><?php echo $serial++;?></td>
                          <td><?php echo $userlist->username;?></td>
                          <td><?php echo $userlist->email;?></td>
                          <td><?php echo $userlist->role;?></td>
                          <td><?php echo $userlist->mobile;?></td>
                          <td><a href='backend-list-edit/{{$id}}'>
                        <p class="fa fa-edit"> Edit </p>
                        </a> &nbsp;<a href="#"  id="<?php echo $userlist->id; ?>" class="list_delete" >
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
                         <th>Username</th>
                         <th>Email</th>
                          <th>Role</th>
                         <th>Mobile Number</th>
                         <th>Manage</th>     
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

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
 $(document).on('click', '.list_delete', function () {
	
							var thiss=$(this);
							var r = confirm("Do you want to delete?");
							
							if(r==true){
								
                                var id =$(this).attr('id') ;
                             
								$.ajax({
									   url: "{{ url('admin/backend-user-delete') }}",
									   method:'get',
									   data:{'id':id},
									   success:function(u_delete){
                         $(".delete_show").show();
									   console.log(u_delete);
										 
                                           if(u_delete==1){
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
