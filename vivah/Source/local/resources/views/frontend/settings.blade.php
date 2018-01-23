<?php

 $data1 = $results['login'];
  $sess = \Session::get('id');
?>
@include('include.profile_header')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datetimepicker/DateTimePicker.css')}}" />
         <meta name="_token" content="{!! csrf_token() !!}"/>
        
        
        
         
        
        
        
         
         <div class="myprfl-section2">
		 
			<div class="bgimage"></div>
         
         </div>
         
         <div class="myprfl-section3">
            <div class="container">
             	<div class="row">
                  
				  
				  
				  
				  <!--new html starts-->
				  
					<div class="profiledet2">
   <div class="col-md-12">
      <div class="setting_main">
         <div class="setting_hd"> Profile Settings </div>
         <div class="setting_mtr_main">
            <div class="row">
                
                <?php
               
				 $email_tab = 'active';
				
				 if(isset($delete_tab))
                 {
					 if($delete_tab == 'delete')
                     {
					 $email_tab = '';
                     $delete_tab = 'active'; 
					 }
					 
				 }
				 ?>
                
               <div class="col-md-12">
                  <div class="settings-tab">
                     <div class="tabs-left">
                        <ul class="nav nav-tabs">
                           <li class="<?php echo $email_tab; ?>"><a href="#email" data-toggle="tab" aria-expanded="false"> Edit e-mail Address </a></li>
                           <li class=""><a href="#changepass" data-toggle="tab" aria-expanded="false"> Change Password </a></li>
                           <li class=""> <a href="#pckgstng" data-toggle="tab" aria-expanded="true"> Package Details </a></li>
                           <li class=""><a href="#datvprfl" data-toggle="tab" aria-expanded="true"> Deactivate Profile </a></li>
                           <li class="<?php echo $delete_tab; ?>"><a href="#dltprfl" data-toggle="tab" aria-expanded="false"> Delete Profile </a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                           <div class="tab-pane <?php echo $email_tab; ?>" id="email">
                              <h2> Edit e-mail Address </h2>
                              <p> A valid e-mail id will be used to send you partner search mailers, member to member communication mailers and special offers. </p>
                              <form id="email_change">
                                 <input type="text" placeholder="Email Address" name="email" class="settingfield" required=""><br>
                                 <div style="float:left; width:100%;">
                                 <input type="submit" class="save-button" value="SAVE"> 
                                    
                                 </div>
                              </form>
                              <div class="email_show"></div>
                           </div>
                           <div class="tab-pane" id="changepass">
                              <h2> Change Password </h2>
                              <p> Your password must have a minimum of 4 characters. We recommend you choose an alphanumeric password. E.g.: Matri123 </p>
                              <form role="form" id="pwd_chg">
         <input type="hidden" name="id" value="<?php echo $sess;?>">
        <input type="password" placeholder="Enter Current Password" class="settingfield"  name="currentpassword" required>
        <input type="password" placeholder="Enter New Password" class="settingfield" name="newpassword" required>
        <input type="password" placeholder="Confirm Password" class="settingfield" name="confirmpassword" required>
                                 <div style="float:left; width:100%;">
                                    <input class="save-button" type="submit" value="SAVE">
                                    <div class="chg_show"></div>
                                 </div>
                              </form>
                           </div>
                       <!-- package -->
                       <div class="tab-pane" id="pckgstng">
					
					   
                              <h2> Package Details </h2>
                                <div class="out-pckage">
                        <?php
                  $subscri=\DB::table('user_payment_details')
                           ->where('uid',$sess)
                           ->get();
                   
                   $days_date="";       
              foreach($subscri as $subs)
              {
                $days_date=$subs->paid_date;
                $pd_days=$subs->period;
                $u_status=$subs->user_payment_status;

              }  
             
        
                     $prd_date = new DateTime($days_date);
                     $today   =new DateTime('today');
                     $date_subs = $prd_date->diff($today)->days;
                       foreach ($p_dtls as $k_lue) {
                       
                        ?>   
         
        <label  >Package name :<?php echo $k_lue->package_name;?></label><br>
        <label >Package rate:<?php echo $k_lue->rate;?></label><br>
        <label  >Package period:<?php echo $k_lue->period;?>Days</label><br>
         <label >Paid date:<?php echo $k_lue->paid_date;?></label><br>
         <label >Valid Upto:<?php echo $date_subs;?> Days</label>
        <?php
      }
      ?>
                             </div>    
                           </div>
                           <!-- package -->

                           <div class="tab-pane" id="datvprfl">
                              <div class="stng_mailart_dv">
                                 <div class="stng_mailart_dv1">
                                    <h2>Deactivate Profile</h2>
                                 </div>
                              </div>
                              <p>You can temporarily deactivate your profile if you do not want to delete it. On deactivation your profile
                              will be hidden from our members and you will not be able to contact any member until you activate.</p>
                              <p>Your profile status is currently <a href="#">active</a>. If you would like to change your status, please select Deactivate Now.</p><br>
                              <p><b>Select the number of days / months you would like to keep your profile deactivated.</b></p>
                              <form id="deactivate">
                                 <select class="drop-down-arw deact-days"name="days" required>
                                    <option value="">--Select Days--</option>
                                    <option value="15">15 Days</option>
                                    <option value="30">1 Month</option>
                                    <option value="60">2 Months</option>
                                    <option value="120">3 Months</option>
                                 </select>
                                 <br>
                                 <h4 style="text-align:justify">NOTE : Your profile will be activated after the selected time period elapses. E.G. 
                                    If you select 15 days as the time period, your profile will be deactivated for 15 days and will be automatically 
                                    activated on the 16th day. You will receive a mailer in this regard.
                                 </h4>
                                 <div class="stng_mailart_dv"> 
                                    <input type="submit" class="save-button" value="Deactivate"> <br><br>
                                 </div>
                              </form>
                              <div class="msg_deac"></div>
                              <h4 style="text-align:justify"> Note: Once you deactivate your profile you will not be able to contact any member either through Express
                                 Interest, Personalised Messages or Chat and your profile details will also not be visible to members.
                              </h4>
                           </div>
                           <div class="tab-pane <?php echo $delete_tab; ?>" id="dltprfl">
                              <div class="stng_mailart_dv">
                                 <div class="stng_mailart_dv1">
                                    <h2>Delete Profile</h2>
                                 </div>
                              </div>
                              <p>We hope you found your life partner and this is the 
                              reason you decided to delete your profile.</p>
                              <p><b>Please note
                              that profiles once deleted cannot be restored.</b><p>
							  <br>
                              
                              <p><b>Select the reason for deleting your profile </b></p>
                              
                              <form id="delete_prf" novalidate="novalidate">
                                 <ul class="liststyle-none">
                                    <li><input type="radio" name="reason" value="married">&nbsp;Married</li>
                                    <li><input type="radio" name="reason" value="mrg_fixed">&nbsp;Marriage fixed</li>
                                    <li><input type="radio" name="reason" value="other_reasons">&nbsp;Other reasons</li>
                                 </ul>
								 
                                 <p><b>Select a source</b></p>
                                 
                                 <ul class="liststyle-none">
                                    <li><input type="radio" name="source" value="soulmate">&nbsp;Through Soulmate </li>
                                    <li><input type="radio" name="source" value="other_site">&nbsp;Through Other Site</li>
                                    <li><input type="radio" name="source" value="other_source">&nbsp;Through Other Source</li>
                                 </ul>
								 
                                 <p><b>Date of Marriage</b>(Optional)<p>
                                 <div>
                                    <!--include calender-->
                                    <input type="text" class="settingfield" name="date_of_mrg" id="datepicker" placeholder="Date of Marriage" data-field="date" readonly>
                                 </div>
                                 
                                 <p><b>Share Your Experience</b><p>
                                 <p>Every success story is a motivation for us. 
                                 We will be delighted to add your success story. <br>Share your
                                 success story and get an attractive gift from us.<p><br>
                                 <textarea style="border: 1px solid rgb(231, 231, 231);" name="experience" rows="5" cols="50"> 
</textarea>
                                 (optional)<br><br>
                                 <p><b>Provide your Address and we will send you an Attractive Gift</b></p>
                                 <p>Every success story is a motivation for us. 
                                 We will be delighted to add your success story. <br>Share your
                                 success story and get an attractive gift from us.<p>
                                 <textarea style="border: 1px solid rgb(231, 231, 231);" name="address" rows="4" cols="50"> 
</textarea>
                                 (optional)<br>
                                 
								 <input class="save-button" type="submit" value="SUBMIT">
								 
                              </form>
                           </div>
                           <div class="msg_show"></div>
                             <div id="dtBox"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /tab-content -->
            </div>
            <!-- /tabbable -->
         </div>
         <!-- /col -->
      </div>
   </div>
</div>

 <!--new html ends-->
 <div class="loader_cls"></div>

				  
				  
				  
				  
				  
                </div>
                
                
                
                                             
            </div>
         </div>
         
          
         
         
         <!-- Footer--> 
            @include('include.footer')
         <!-- End Footer -->
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="{{asset('assets/js/bootstrap.js')}}"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{asset('assets/js/ie10-viewport-bug-workaround.js')}}"></script>
 <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

 <script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker-i18n.js')}}"></script>

      <script type="text/javascript">
         $(function() {
         	$("#slider").blissSlider({
         		auto: 1,
             			transitionTime: 500,
             			timeBetweenSlides: 4000
         	});
         });
		 
		 
		 
      </script>


      
      <script type="text/javascript">
      
      		$(function(){
      var $ppc = $('.progress-pie-chart'),
        percent = parseInt($ppc.data('percent')),
        deg = 360*percent/100;
      if (percent > 50) {
        $ppc.addClass('gt-50');
      }
      $('.ppc-progress-fill').css('transform','rotate('+ deg +'deg)');
      $('.ppc-percents span').html(percent+'%');
    });
   
      
      </script>
      
      
      <script type="text/javascript">
	  $(document).ready(function(){
								 
			 $(window).scroll(function(){
														  
				  var e= $(window).scrollTop();
								
					if ( e > 50){
							
						 $(".nav_main").addClass("short_menu")
					
					}else{
						  $(".nav_main").removeClass("short_menu")
										
					}
			});
			
		}); 
					
							  	
							  
						
      </script>

<script type="text/javascript">
$(document).ready(function(){
    
      $(".loader_cls").hide(); 
	$('#email_change').validate({
				rules: {
					 email: {
            required: true,
            email: true
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
				   $(".loader_cls").show(); 
							var value =$("#email_change").serialize() ;
						
							$.ajax({
								   url: "{{ url('user/change-email') }}",
								   method:'POST',
								   data:value,
								   success:function(email_change){
                                         $(".loader_cls").hide(); 
                                   $(".email_show").show();
								   console.log(email_change);
									
                                       if(email_change=='1')
									   {
										 $(".email_show").html('<div class="alert alert-success">Check your email to change your Email ID</div>');
                                            setTimeout(function(){$(".email_show").hide(); }, 3000);
									   }
									   else
									   {
										   
										 $(".email_show").html('EmailId already exist');
                                           setTimeout(function(){$(".email_show").hide(); }, 3000);
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
<script type="text/javascript">
$(document).ready(function(){
    
     $(".loader_cls").hide(); 
    
	$('#pwd_chg').validate({
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
				 
               $(".loader_cls").show(); 
            
							var value =$("#pwd_chg").serialize() ;
							$.ajax({
								   url: "{{ url('user/changepassword-settings') }}",
								   method:'POST',
								   data:value,
								   success:function(chng_pwd){
                                        $(".loader_cls").hide(); 
                                   $(".chg_show").show();
								   console.log(chng_pwd);
								
                                       if(chng_pwd=='1')
									   {
										window.location="{{ url('user/profileview') }}"; 
									   }
									   else
									   {
										 alert(chng_pwd);
										  $(".chg_show").html('<div class="alert alert-danger">Password cannot Changed</div>');
                                            setTimeout(function(){$(".chg_show").hide(); }, 3000);
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
<script type="text/javascript">
$(document).ready(function(){
    
     $(".loader_cls").hide(); 
    
	$('#deactivate').validate({
				rules: {
					days: {required: true }
			
                        },
				
			
    
								
        highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		submitHandler: function(form) {
			/*ajax start here*/
            
             $(".loader_cls").show(); 
            
			  var thiss=$(this);
					 var r = confirm("Do you want to deactivate your profile?");
							
							if(r==true){
				 
							var value =$("#deactivate").serialize() ;
							$.ajax({
								   url: "{{ url('user/deactivate-profile') }}",
								   method:'POST',
								   data:value,
								   success:function(insert){
                                        $(".loader_cls").hide(); 
                                   $(".msg_deac").show();
                                       
                                   
								   console.log(insert);
									   
                                       if(insert==1)
									   {
										window.location="{{ url('user/logout') }}"; 
										
									   }
									   else
									   {
										  
										 $(".msg_deac").html('<div class="alert alert-danger">Deactivation Failed</div>');
                                           setTimeout(function(){$(".msg_deac").hide(); }, 3000);
									   }
										 	}
									 });
          /*ajax end here*/
							}
		}
       
		
							
	});					   
});
	$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>

 <script type="text/javascript">
$(document).ready(function(){
    
    $(".loader_cls").hide(); 
    
	$('#delete_prf').validate({
				rules: {
					reason: {
				
				 required: true,
				
				},
				source: {
				
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
			/*ajax start here*/
            
            
            $(".loader_cls").show(); 
            
				  var thiss=$(this);
					 var r = confirm("Do you want to delete?");
							
							if(r==true){
							var value =$("#delete_prf").serialize() ;
							$.ajax({
								   url: "{{ url('user/delete-profile') }}",
								   method:'POST',
								   data:value,
								   success:function(prfl_ins){
                                       $(".loader_cls").hide(); 
                                       
									   console.log(prfl_ins);
									   if(prfl_ins==1)
									   {
										window.location="{{ url('user/logout') }}"; 
										
									   }
									   else
									   {
										  
										 $(".msg_show").html('<div class="alert alert-danger">Deletion Failed</div>');
									   }
										 	}
									 });
          /*ajax end here*/
							}
		   
        }
		
							
	});					   
});
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

