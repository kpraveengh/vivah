

        
        @include('include.admin.backend_header')
        
        
      
      <!-- Left side column. contains the logo and sidebar -->
         @include('include.admin.backend_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            All Users List
          
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">All Users List</li>
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
                  
                  <form class="filter_gender" method="get" action="{{'all-users-list'}}" accept-charset="UTF-8">
                        Gender
                        <select name="gend_filt" id="gendr">
                        <option >----select---</option>
                        <option>Male</option>
                        <option>Female</option>
                        </select>
                        </form>
                  <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                         <th>Sl No.</th>
                         <th>Username</th>
                         <th>Gender</th>
                          <th>Age</th>
                          <th>Place</th>
                          <th>View More</th>                   
                        </tr>
                    </thead>
                       <tbody>
                      
                         <?php
				         
                         $serial=1;
                      
                     foreach($data as $user_list)
                      {
                          
                         $dob=$user_list->dob;
                         $birthdate = new DateTime($dob);
                         $today   = new DateTime('today');
                         $age = $birthdate->diff($today)->y;
                      ?>         
                   
                      <tr>
                          <td><?php echo $serial++;?></td>
                          <td><?php echo $user_list->username;?></td>
                          <td><?php echo $user_list->gender;?></td>
                          <td><?php echo $age;?></td>
                          <td><?php echo $user_list->district;?></td>
                          <td><p data-toggle="modal" data-target="#myModal<?php echo $user_list->user_id;?>" >
             
              <a class="loginlink" href="#">view more</a></p><?php if($user_list->img_status==0){?><span  propic_id="<?php echo $user_list->id;?>" class="pic approve">Image Approve</span><?php } else {?><span  propic_id="<?php echo $user_list->id;?>" class="pic approved">Image Approved</span><?php }?>
              /<?php if($user_list->img_status==0){?><span  prpic_id="<?php echo $user_list->id;?>" class="pic canceled">Canceled</span><?php } else {?><span  prpic_id="<?php echo $user_list->id;?>" class="pics cancel">Cancel</span><?php }?></td>
              
              
                 <!--  popup -->
              
              <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" >
          
            <div id="myModal<?php echo $user_list->user_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                          <div class="modal-body">
                                  <div class="mybkngwte2">
                                        <div class="mybkngwte_bg">
                                            <h3> User Details </h3>
                                            <div class="colum2">
                     	<p class="prfl-img"><img src="{{asset($user_list->path)}}"/></p>
                       <div class="personal-details">
                        <p class="prfl-details">Religion: <?php if(empty($user_list->religion)){echo $user_list->other_religion;}else {
                          echo $user_list->religion;
                        }?>-<?php if(empty($user_list->caste)){echo $user_list->other_caste;}else {
                          echo $user_list->caste;
                        }?></p>
                        <p class="prfl-details">Education : <?php echo $user_list->education;?></p>
                        <p class="prfl-details">Occupation : <?php echo $user_list->occupation;?></p>
                       
                       </div>
                       
                     </div>
                                        </div> 
                                    </div>
          
          
        </div>
    </div>
  </div>
</div>


          
          </ul>
          
        </div>
               <!--  popup -->
                        </tr>
                     
                  
                      
                      <?php
				         }
                          ?>
                            </tbody>
                    <tfoot>
                      <tr>
                      <th>Sl No.</th>
                         <th>Username</th>
                         <th>Gender</th>
                          <th>Age</th>
                          <th>Place</th>
                          <th>View More</th>
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


 <script type="text/javascript">

	jQuery(function ($) {
 $(document).on('click', '.pic', function () {

							var thiss=$(this);
							var r = confirm("Do you want to approve image?");
							
							if(r==true){
								var value =$(this).attr('propic_id') ;
                               
								$.ajax({
									   url: "{{ url('admin/all-users-profilepic-approve') }}",
									   method:'post',
									   data:{'id':value},
									   success:function(img_stat_update){
									   console.log(img_stat_update);
										 thiss.html("Approved");
                                         thiss.removeClass("Approve");
										 thiss.addClass("approved");  
                     window.location="{{url('admin/all-users-list')}} " ;
                                   
                   }
									   });
								         }
												 
				       });					   
				 })
	$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
<script type="text/javascript">
  jQuery(function ($) {
 $(document).on('click', '.pics', function () {

              var thiss=$(this);
              var r = confirm("Do you want to Cancel image approval?");
              
              if(r==true){
                var value =$(this).attr('prpic_id') ;
                               
                $.ajax({
                     url: "{{ url('admin/all-users-profilepic-cancel') }}",
                     method:'post',
                     data:{'id':value},
                     success:function(img_stat_update){
                     console.log(img_stat_update);
                     thiss.html("Cancel");
                                         thiss.removeClass("Canceled");
                     thiss.addClass("Cancel");  
                     window.location="{{url('admin/all-users-list')}} " ;
                                   
                   }
                     });
                         }
                         
               });             
         })
  $.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
 
<script type="text/javascript">
 $(document).ready(function(){
 $("#gendr").change(function (){
     
   
$(".filter_gender").submit();
						});
 });
 </script>
  </body>
</html>
