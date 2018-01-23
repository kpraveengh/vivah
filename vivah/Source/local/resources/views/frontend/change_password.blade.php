 <?php  
                                  $user_key=$_GET['user_key'];
                                    $user_key;
                                  $sess = \Session::get('id');?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <script src="{{asset('assets/js/jquery.js')}}"></script>
   </head>
   <body>
      <div class="wrapper_main">
         <div class="nav_main">
          @include('include.frontpage_headers')
         </div>
		 <?php
		 if($user_key)
		 {
		 ?>
         <div class="section2">
            <div class="container">
               <div class="row">
                  <div class="minheight-section">
                     <div class="col-md-12">
					 <!--setting_main_psw-->
                        <div class="">
						<div class="resetpwd-section">
                           <meta name="_token" content="{!! csrf_token() !!}"/>
                           <div class="tab-pane" id="changepass">
                              <h2 class="head2"> Change Password </h2>
                              <p class="para9"> Your password must have a minimum of 4characters. </p>
                             
                              <form role="form"  id="psw_chng" >
							  <div class="col-lg-5">
                                 <input type="hidden" name="user_key" value="<?php echo $user_key;?>">
                                 <input type="password" placeholder="Enter New Password" name="newpassword"  class="input-a1 settingfield1 frgtpwd-field" required><br>
								 
                                 <input type="password" placeholder="Confirm Password" name="confirmpassword" class="input-a1 settingfield1 frgtpwd-field" required>
								
								  
								 
                                 <div style=" width:100%;">
                                    <input style="padding-left: 15px;
padding-right: 15px;padding-top:10px;padding-bottom:10px;border-radius:8px;border:1px solid transparent;color:#fff;background: transparent linear-gradient(to bottom, #2CBCEB 0%, #28BAE7 49%, #1AACDA 100%) repeat scroll 0% 0%;" class="stngbtn_sv login-maain-btn" type="submit" value="SAVE">
                                    <!-- <div class="stngbtn_sv"> SAVE </div>-->
                              </form>
							  
                              </div>
							   </div>
							  <div class="col-lg-7">
								  </div>
                           </div>
						   </div>
                        </div>
                        <div class="msg"> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 <?php
		  }
		 ?>
         @include('include.footer')
      </div>
      <script src="{{asset('assets/js/jquery.js')}}"></script>
      <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
      <script type="text/javascript">
         $(document).ready(function(){
         	$('#psw_chng').validate({
         				rules: {
         					newpassword: {
         				
         				minlength:4
         				
         				},
         				 
         				confirmpassword: {
         			 
         				minlength:4
         				
         				},
						
         			
                 },
         								
                 highlight: function(element) {
                     $(element).addClass('red');
                 },
                 unhighlight: function(element) {
                     $(element).removeClass('red');
                 },
         		submitHandler: function(form) {
         			/*ajax start here*/
         				 
         							var value =$("#psw_chng").serialize() ;
         							//alert(value);
						 
         							$.ajax({
         								   url: "{{ url('user/change-pswd') }}",
         								   method:'get',
         								   data:value,
         								   success:function(chng_pwd){
         									   
         									   if(chng_pwd=='1')
         									   {
												  alert('Succesfully Changed Your Password');
         										
												 window.location="{{ url('/') }}"; 
         									   }
         									   else if(chng_pwd=='2')
         									   {
         										   
         										   $(".msg").html('<div class="alert alert-danger">password not matching</div>');
         										  
         									   }
											   else
											   {
												    $(".msg").html('<div class="alert alert-danger">error</div>');
											   }
         										 	}
         									 });
					 
                   /*ajax end here*/
         		   
                 }
         		
         							
         	});					   
         });
         	$.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
         });
      </script>

