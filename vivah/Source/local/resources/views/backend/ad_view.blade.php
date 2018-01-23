

        
        @include('include.admin.backend_header')
        
        
      
      <!-- Left side column. contains the logo and sidebar -->
         @include('include.admin.backend_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Advertisement List
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          
            <li class="active">Advertisement List</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
          
               
                  <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                         <th>Sl No.</th>
                          <th>Ad Name</th>
                          <th>Ad image</th>
                          <th>Posted Date</th>
                          <th>Uploaded By</th>
                          <th>Manage</th>                  
                        </tr>
                    </thead>
                       <tbody>
                      
                          <?php
				            $serial = 0;
				            foreach ($ad_details as $ad_dtls) {

                      $ad_id=$ad_dtls->id;
                     
										?>   
                   
                      <tr>
                           <td><?php echo ++$serial;?></td>
                          <td><?php echo $ad_dtls->ad_name;?></td>
                          <td><img src="{{asset($ad_dtls->ad_image)}}"></td>
                          <td><?php echo $ad_dtls->ad_posted_date;?></td>
                          <td><?php echo $ad_dtls->uploaded_by;?></td>
                         
                          
                          <td><a href='adv-edit/{{$ad_id}}'>
                        <p class="fa fa-edit"> Edit </p>
                        </a> &nbsp; <a href="#" ad_id="<?php echo $ad_dtls->id;?>" class="ad_delete" >
                        <p class="fa fa-trash-o"> Delete </p>
                        </a></td>
                                   
                        </tr>
                     
                
                      
                      <?php
				              }
                          ?>
                              </tbody>
                    <tfoot>
                      <tr>
                      <th>Sl No.</th>
                          <th>Ad Name</th>
                          <th>Ad image</th>
                          <th>Posted Date</th>
                          <th>Uploaded By</th>
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
      <footer class="main-footer">
         @include('include.admin.footer')
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
  $(document).ready(function(){
  $(".ad_delete").click(function(){
              var thiss=$(this);
              var r = confirm("Do you want to delete?");
              
              if(r==true){
                var value =$(this).attr('ad_id') ;
                $.ajax({
                     url: "{{ url('admin/ad-delete') }}",
                     method:'get',
                     data:{'id':value},
                     success:function(ad_del){
                       $(".delete_show").show();  
                     console.log(ad_del);
                      if(ad_del==1){
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
         });
  
</script>

 



  </body>
</html>
