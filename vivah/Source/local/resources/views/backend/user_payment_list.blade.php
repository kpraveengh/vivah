

        
        @include('include.admin.backend_header')
        
        
      
      <!-- Left side column. contains the logo and sidebar -->
         @include('include.admin.backend_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Paid Users List
          
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Paid Users List</li>
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
                         <th>Gender</th>
                          <th>Packagename </th>
                          <th>Period</th>
                          <th>Rate</th>                   
                        </tr>
                    </thead>
                      
                      
                         <?php
				         
                         $serial=1;
                      foreach($paidlist as $paid)
                      {
                      ?>         
                    <tbody>
                      <tr>
                          <td><?php echo $serial++;?></td>
                          <td><?php echo $paid->username;?></td>
                          <td><?php echo $paid->gender;?></td>
                          <td><?php echo $paid->package_name;?></td>
                          <td><?php echo $paid->period;?></td>
                          <td><?php echo $paid->rate;?></td>
                          
                          
              
              

                        </tr>
                     
                    </tbody>
                      
                      <?php
                      }
                          ?>
                    <tfoot>
                      <tr>
                      <th>Sl No.</th>
                         <th>Username</th>
                         <th>Gender</th>
                          <th>Packagename </th>
                          <th>Period</th>
                          <th>Rate</th> 
                      </tr>
                    </tfoot>
                  </table>
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



  </body>
</html>
