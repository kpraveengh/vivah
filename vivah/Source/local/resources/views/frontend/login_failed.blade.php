@include('include.frontpage_headers')
	  <!--header-->
     <!-- popup-->
       
       <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('assets/css/popup/css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/popup/src/jquery-prompt21.js') }}"></script>
  <script src="{{ asset('assets/js/popup/js/handlers.js') }}"></script>
        <!-- popup-->
		  <meta name="_token" content="{!! csrf_token() !!}"/>
		 <!--new html starts-->
         <div class="section2">
            <div class="container">
               <div class="row">
                  <div class="part-main1">
                     <div class="col-lg-12">
                        
						<?php
 
if(isset($_GET['attempt_failed'])) {
	 
	echo $attempt_failed = \Session::get('attempt_failed');
	 
	 
	
	echo '<div class="alert alert-danger" id="try">Username or password incorrect</div>' ;

}
 
 
 
?>
						
						   <div class="login-innerpart">
							   
							   
							  
							   
									<h4 class="login-head">LOGIN</h4>
									<hr class="horrizontalline1">
									
										<div class="inside-content">
											
													
												<p class="para11">Login ID</p>
                                            
                                            
                                             <form role="form"    id="login_pg">
                               <input type="text" placeholder="Email" class="field3" name="email">
                                              
												
												
												<p class="para11">Password</p>
                                               
											<input type="password" placeholder="password" class="field3" name="password">
											<label class="login-label">	<input class="login-checkbox" type="checkbox" id="remember" tabindex="3"  value="on" name="remember">Keep me logged in</label><br>
										<a href="#"></a><div class="lbl"><a href="#"> <div class="loginfiled-forgot show-popup">Forgotten your password?</div></a>
                       

                        <input type="button" value="LOGIN" class="save-button" id="loginpg_id">
                                                  
                    

              <div class="message">
							    
							   </div></form>

                      </div>
<!-- fgt pswd popup-->
                      <div class="popup" style='display:none;'>
                            <form class="form-horizontal">
                                <fieldset>

                                <!-- Form Name -->
                                <div class="pop-hd">
                                  Forgot Password  
                                </div>

                                <!-- Text input-->
                                <div class="popup-frm-mrgn">
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="email_forgot" required> Email</label>
                                  <div class="col-md-8">
                                  <input id="email_forgot" name="email_forgot" type="email" placeholder="Enter Your EmailID" class="form-control input-md" required="" value="">
                                   </div>
                                </div>
                               <div class="fgt_msg"></div>
                                 
            

                                <!-- Button (Double) -->
                                <div class="form-group">
                                  <label class="col-md-6 control-label" for="cancel"></label>
                                  <div class="col-md-5">
                                    <button type="button" id="cancel" class="btn btn-default cancel">Cancel</button>
                                    <button type="button" id="f_psw" class="btn btn-success submit">OK</button>
                                  </div>
                                </div>
                                </div>

                                </fieldset>
                            </form>
                             <div class="loader1" >
                 <img src="{{asset('assets/images/ajax-loader.gif')}}" />
                 </div>
                        </div>
                      
                       <!-- fgt pswd popup-->


								
								
								 <input type="hidden" value=" " id="attempt_get">
								
							</div>
						   
						   
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 <!--new html ends-->
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



<script>
$(document).ready(function(){
  	 
 
        
 
    $("#loginpg_id").click(function(){
								  
	var value =$("#login_pg").serialize() ;
	
	
		$.ajax({
		type:'POST',
		url:"{{ url('user/login') }}", 
		
		data: value,
		
		success:function (login){
       
		console.log(login);
                                                if(login==1 || login=='1Soulmate' || login=='Soulmate'){
                                           window.location="{{ url('user/search') }}";           
                
                                                    }
  

                                                    else if(login==2){
                                                      
													   window.location="{{ url('user/activation') }}"; 	
                                                        }
														else if(login==0){
				
                 window.location="{{ url('user/login-failed?attempt_failed') }}"; 
													 
       
															
				}											
           else if(login==3 || login=='3Soulmate')
                    {
               window.location="{{ url('user/profile') }}"; 
            } 
             else if(login==4)
            {
                if(login==4)
                    {
                      alert("Same Gender.So Choose Opposite Gender");
                       window.location="{{ url('/') }}";  
                    }
                else
                    {
                   $(".login-field").focus();
      window.location = "{!! URL::to('user/search-profile-view/"+login+"')!!}";
               /* setTimeout(function(){$(".login_msg").hide(); }, 3000);*/
                    }
                  
                              
            }
            else
            {
                if(login=='error')
                    {
                      alert("Same Gender.So Choose Opposite Gender in Highlighted Profile");
                       window.location="{{ url('/') }}";  
                    }
                else
                    {
                   $(".login-field").focus();
      window.location = "{!! URL::to('user/search-profile-view/"+login+"')!!}";
               /* setTimeout(function(){$(".login_msg").hide(); }, 3000);*/
                    }
                  
                              
            }
														
                                                    }
                                        });
        });
        });

$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>  

<script >
$(document).ready(function(){
    
   
   $("#f_psw").click(function(){
     $('.loader1').show(); 
                 
  var value =$("#email_forgot").val() ;
 
    $.ajax({
    type:'get',
    url:"{{ url('user/check-password') }}", 
    
    data: {email:value},
    
    success:function (login){
       $('.loader1').hide();  
          
            $(".fgt_msg").show();
    console.log(login);
                                                if(login==1)
                                                {
                                                  $("#email_forgot").hide();
                                                  $(".control-label").hide();
                                                   $(".fgt_msg").html(' <div class="alert alert-success">Check ' +value+ ' To Change Your Password</div>');
                                                   setTimeout(function(){$(".fgt_msg").hide(); }, 3000);
                                                   setTimeout(function(){$(".popup").hide(); }, 3000);
                                                   

                //alert('check'+value+'to change your password');
          
                                                    }
                                                    else{
                                                        
          $(".fgt_msg").html('<div class="alert alert-danger">Email Doesnot Exist, Please Enter a Valid Mail ID</div>');                    
                                                        setTimeout(function(){$(".fgt_msg").hide(); }, 3000);
                                                        }
                                                    }
                                        });
                        
    
     
                             
    
              
  });            
});
   
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script> 				 
						 
   </body>
</html>