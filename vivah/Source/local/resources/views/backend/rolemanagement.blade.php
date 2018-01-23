
  @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="add_promocode">
           Add New Role
          </h1>
		  
		 
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Rolemanagement</li>
          </ol>
        </section>

        <!-- Main content -->
 <div class="">
			   <div class="">
                <div class="col-lg-12">
           <div class="box box-primary edit_promoform1">
				 
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
				        <div class="result-role"></div>
                        <div class="adminuser1"></div>
                <!-- /.box-header -->
                <!-- form start -->
				
                
				  <form method="post" class="form parsley-form col-sm-12" data-validate="parsley">
<div style="width:100%; float:left; clear:both; margin-bottom:25px">
<div class="pull-left">
<div class="btn-group" style="clear:both">
<input type="hidden" value="<?php if(isset($get_role_value)){ echo $get_role_value;} ?>" id="get_role_id"/>
<?php 
    foreach($getrole as $rolename)
    {
       $role=$rolename->r_id;
    ?>
    
    <button type="button" class="btn btn-default <?php if(isset($get_role_value)) { if($get_role_value== $role) { echo "active";}} ?>" style="text-transform:capitalize" onclick="window.location='{{URL::to('admin/role-management-page')}}/{{$role}}'"  ><?php echo $rolename->rolename; ?></button>
    <?php
    }
    ?>

</div>
<div style="margin:16px; margin-bottom:0; clear:both;">
 
 <input href="#"  data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary" value="Add Role" id="promoedit">
 <input href="#"  data-toggle="modal" data-target="#myModal1" style="margin-left:6px;" type="button" class="btn btn-primary" value="Delete Role" id="promoedit">
 
</div>
</div>
   <?php

if(!isset($get_role_value) || ($get_role_value== "5") ) {

		?>

        <div class="col-sm-12">
        <div class="jumbotron admin-page role_style">
        <p> All page are accessible </p>
        </div>
        </div>
        <?php
      }
    else
    {
        
         $id_role = $get_role_value;
		
        $check_role= \DB::table('role')
                      ->where('r_id',$id_role)
                      ->get();
       // var_dump(count($check_role));exit;
        
		if(count($check_role) == 0) {
			return redirect('role-management-page');
		}
		
		
        $role_id=\DB::table('role_permission')
                      ->where('role_id',$id_role)
                      ->get();
        
         //var_dump($role_id);exit;
		if(count($role_id)) {
            
           
			foreach($role_id as $result)
            {
			$id_page=$result->page_id;
			$str = rtrim($id_page,',');
			$pg_id = explode(',', $str);
        
    ?>
       
			
             <div class="col-sm-12 admin-roleman role_dropbox">
        
       
		<div class="col-sm-4">
        <label>User Management</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("2", $pg_id)) { echo "checked";} ?> type="checkbox" value="2">New Users </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("3", $pg_id)) { echo "checked";} ?> type="checkbox" value="3">All Users List </label></div>
            
        <label>Agent Management</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("32", $pg_id)) { echo "checked";} ?> type="checkbox" value="32">Add Agent </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("4", $pg_id)) { echo "checked";} ?> type="checkbox" value="4">Agent List </label></div> 
            
            
    <label>Places</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("9", $pg_id)) { echo "checked";} ?> type="checkbox" value="9">Add Places </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("10", $pg_id)) { echo "checked";} ?> type="checkbox" value="10">Place List </label></div> 
            
            
    <label>Religion</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("13", $pg_id)) { echo "checked";} ?> type="checkbox" value="13">Add Religion </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("14", $pg_id)) { echo "checked";} ?> type="checkbox" value="14">Religion List </label></div>          
            
            
            
                 </div>
            <div class="col-sm-4">     
                 <label>Sub Caste</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("16", $pg_id)) { echo "checked";} ?> type="checkbox" value="16">Add Caste </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("17", $pg_id)) { echo "checked";} ?> type="checkbox" value="17">Caste List </label></div>  
                
                 <label>Star</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("19", $pg_id)) { echo "checked";} ?> type="checkbox" value="19">Add Star </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("20", $pg_id)) { echo "checked";} ?> type="checkbox" value="20">Star List </label></div> 
                
                
                
                <label>Moon Sign</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("22", $pg_id)) { echo "checked";} ?> type="checkbox" value="22">Add Rasi </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("23", $pg_id)) { echo "checked";} ?> type="checkbox" value="23">Rasi List </label></div> 
                
                
                
                <label>Zodiac Sign</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("25", $pg_id)) { echo "checked";} ?> type="checkbox" value="25">Add Zodiac </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("26", $pg_id)) { echo "checked";} ?> type="checkbox" value="26">Zodiac List </label></div> 
                
                
                 </div>
                  <div class="col-sm-4">
                      
                 <label>Education </label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("28", $pg_id)) { echo "checked";} ?> type="checkbox" value="28">Add Education </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("29", $pg_id)) { echo "checked";} ?> type="checkbox" value="29">Education List </label></div>      
                      
            <label>Packages</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("6", $pg_id)) { echo "checked";} ?> type="checkbox" value="6">Add Packages </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("7", $pg_id)) { echo "checked";} ?> type="checkbox" value="7">Packages List </label></div>  
                       
                      <label>Payment</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("12", $pg_id)) { echo "checked";} ?> type="checkbox" value="12">Payment List </label></div>
                      

              <label>Change Password</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("35", $pg_id)) { echo "checked";} ?> type="checkbox" value="35">Change Password </label></div>
                                
                           
            <label>Backend User</label>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("33", $pg_id)) { echo "checked";} ?> type="checkbox" value="33">Add Backend User </label></div>
        <div class="checkbox"><label><input class="role_checkbox" <?php if(in_array("34", $pg_id)) { echo "checked";} ?> type="checkbox" value="34">Backend User List </label></div>  
                           
      
                      
                 </div>
		
		 <div class="col-sm-12">
       <input type="hidden" name="role_permission" class="role_permission1" id="role_permission" value="<?php echo $result->page_id; ?>"/>
         <input class="btn  btn-secondary role-sub role_submit"  type="button" name="role" id="submit" value="Submit"/>
        </div>
		
		</div>
           
      
	            <?php
			}
		} else {
		?>
        <div class="col-sm-12 role_dropbox">
    
	     <div class="col-sm-4">
       <label>User Management</label>
        <div class="checkbox"><label><input class="role_checkbox" type="checkbox" value="2">New Users  </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="3">All Users List </label></div>
        
        <label>Agent Management</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="32">Add Agent </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="4">Agent List </label></div>       
        
         <label>Places</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="9">Add Places </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="10">Place List </label></div>       
             
	  <label>Religion</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="13">Add Religion </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="14">Religion List </label></div>          
            </div>
            
        <div class="col-sm-4">     
         <label>Sub Caste</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="16">Add Caste </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="17">Caste List </label></div> 
            
            
            <label>Star</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="19">Add Star </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="20">Star List </label></div>
            
            
            
             <label>Moon Sign</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="22">Add Rasi </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="23">Rasi List </label></div> 
            
            
            <label>Zodiac Sign</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="25">Add Zodiac </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="26">Zodiac List </label></div> 
             
            </div>
            
            <div class="col-sm-4">
             <label>Education </label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="28">Add Education </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="29">Education List </label></div> 
                
                
                
             <label>Packages</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="6">Add Packages </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="7">Packages List </label></div>  
            
        <label>Payment</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="12">Paid Members </label></div>
                
             <label>Change Password</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="35">Change Password </label></div>
                    
            
             <label>Backend User</label>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="33">Add Backend User </label></div>
        <div class="checkbox"><label><input class="role_checkbox"  type="checkbox" value="34">Backend User List </label></div>          
                 
                
            </div>
                      
            <div class="col-sm-12">
		 <div class="col-sm-4">
        <input type="hidden" name="role_permission" class="role_permission1" id="role_permission" value="1,2"/>
         <input class="btn  btn-secondary role-sub role_submit"  type="button" name="role" id="submit" value="Submit"/>
        </div>
             
             
		</div>
        <?php
        }
		?>
        <div class="col-sm-4">
        
        </div>
        <?php
         }
         ?>
       
       
                   
				</div>  
			  </form>
	        </div>
				 
                
           </div><!-- /.box -->
      </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


 
    
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Role</h4>
      </div>
      <form id="validate-basic" action="#" data-validate="parsley" class="form parsley-form">
      <div class="modal-body">
        
        <div class="form-group">
                  <label for="name">Rolename</label>
                  <input type="text" id="rolename" name="name" class="form-control" data-required="true" >
                  
         </div>
         <div class="alert alert-success" id="rolerply" style="display:none;"></div>
         <div id="emptyerr" class="alert alert-danger" style="display:none">Please enter rolename</div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default rload" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary reload" id="addrole">Add Role</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->


 


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Role</h4>
      </div>
      <form id="validate-basic" action="#" data-validate="parsley" class="form parsley-form">
      <div class="modal-body">
      
        <div class="form-group">  
             <label for="name">Rolename</label>
                  <select data-required="true" class="form-control parsley-validated select2"  style="width: 100%;" name="validateSelect" id="deleterolename">
                    <option value="" selected>Please Select</option>
                   <?php
                      $role_table=\DB::table('role')
                                      ->where('rolename','!=','admin')
                                       ->get();
                      $num_role_table=count($role_table);
                      
                      if($num_role_table)
                      {
                      foreach($role_table as $num_value)
                      {
                          
                    
                      ?>
					
                       <option value="<?php echo $num_value->rolename; ?>"><?php echo $num_value->rolename; ?></option>
                        <?php
					}
                      }
                      ?>
					
                  </select>
         </div>
         <div class="alert alert-success" id="drolerply" style="display:none;"></div>
         <div id="emptyerr1" class="alert alert-danger" style="display:none">Please select rolename</div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default rload" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleterole">Delete Role</button>
      </div>
      </form>
    </div>
  </div>
</div>

  

      <!-- Control Sidebar -->
     <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

@include('include.admin.footer')
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
      

	  <script type="text/javascript">
  
  $(document).ready(function () {

      
        var t='';
	/* Get the checkboxes values based on the class attached to each check box */
	$(".role_checkbox").click(function() {
		
        $(".role_checkbox:checked").each(function() {
			
            t+=$(this).val()+',';
		
		});	
		var input = $('#role_permission');
		input.val(t);
	
		t='';
	});
	
      
	
	$('#addrole').click(function(){
        
        if ($('#rolename').val().length == 0){
			$('#emptyerr').slideToggle(500);
			$('#emptyerr').fadeOut(5000);
		} else {
		
			var rolename = $('#rolename').val();
			$.ajax({
				type: "POST",
			    url:"{{ url('admin/add-role') }}",
				data:{'rolename':rolename},
                success:function(result){
					
                        console.log(result);
						
                     $("#rolerply").html(result);
					$('#rolerply').slideToggle(500);
					$('#rolerply').fadeOut(5000);
                    }
						
				
				
			});
		}
		
	});
      
    	$('#deleterole').click(function(){
		if ($('#deleterolename').val().length == 0){
			$('#emptyerr1').slideToggle(500);
			$('#emptyerr1').fadeOut(5000);
		} else {
			var rolename = $('#deleterolename').val();
			$.ajax({
				type: "POST",
				url: "{{url('admin/role-delete')}}",
				data: {'rolename':rolename},
				cache: false,
				success: function(result)
				{
					  console.log(result);
					$("#drolerply").html(result);
					$('#drolerply').slideToggle(500);
					$('#drolerply').fadeOut(5000);
				}
			});
		}
	});  
      
     $('.rload').click(function(){
		window.location.reload();
	}); 

      
    $('.role-sub').click(function(){
       
		  var role_id = $('#get_role_id').val();
		  var page_id = $('.role_permission1').val();
         
        //alert(role_id +"a"+ page_id);
			 
		  $.ajax({
             url:"{{url('admin/update-role')}}",
             type:'post',
             data:{'role_id':role_id,'page_id':page_id},
             success:function(book){
	         $(".result-role").show();
             console.log(book);
            
                 if(book==2 || book ==4)
                 {
            $(".result-role").html('<p class="error">Error</p>');
	
                 }
                else if(book == 1)
                {
	       $(".result-role").html('<p class="success">Role Permission Added successfully</p>');
         // window.setTimeout(function(){location.reload()},3000);


                }
                 else
                 {
	       $(".result-role").html('<p class="success">Role Permission Changes successfully</p>');

                  }

	}
		});  
		 }); 
	
	
      
      
  });
          
 $.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>

  <script>
 
</script>  
  

  </body>
</html>
