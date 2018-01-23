
<!DOCTYPE html>
<?php
 $getimage=\DB::table('settings')
                       ->get();
                 foreach($getimage as $image)
                 {
                  $logo=$image->image;
                  $favicon=$image->fav_icon;
                 }     
?>

<html lang="en">
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
      <title>Soulmate</title>
      <!-- Bootstrap core CSS -->
      <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
      <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <script src="{{asset('assets/js/ie-emulation-modes-warning.js')}}"></script>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="{{asset('assets/js/jquery.js')}}"></script>
      <script src="{{asset('assets/js/jquery.carouFredSel-6.0.4-packed.js')}}"></script>
      <link rel="stylesheet" href="{{asset('assets/css/bnr/normalize.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/bnr/bliss-slider.css')}}">
      <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
      <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
      <link rel="shortcut icon" href=$favicon>
      <script type="text/javascript" src="{{asset('assets/js/bnr/bliss-slider.js')}}"></script>
      
       <script src="{{asset('assets/js/soulmate.js')}}"></script>
      <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
       
       
       
       
       
       
       
       
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
  
       
       
       
   </head>
   <body>
   
   <!-- popup-->
       
       <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('assets/css/popup/css/custom.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/js/popup/src/jquery-prompt21.js') }}"></script>
	<script src="{{ asset('assets/js/popup/js/handlers.js') }}"></script>
        <!-- popup-->
   
      <div class="wrapper_main">
         <div class="nav_main">
            <div class="container">



              
               <!--nav-->
               <div class="row">
                  <div class="col-md-3">
                     <div class="logo"><a href="{{ URL::to('/') }}"> <img src="{{asset($logo)}}"/ ></a></div>
                  </div>
                  <div class="col-md-9">
                     <div class="indexheader"> </div>
                     <div class="nav_clm2">
                        <form id="login_form">
                        <div class="emailpart"> 
						<div><div class="usrname"> <input class="field1 login-field" name="email" type="text" placeholder="Email"></div></div>
						
							<div><label class="headerpara"><input type="checkbox" class="login-checkbox" id="remember" tabindex="3"  value="on" name="remember">&nbsp; Keep me logged in</label></div>
						</div>
                            
                        <div class="emailpart"> 
                        <div class="usrname"> <input class="field1 login-field" name="password" type="password" placeholder="Password"></div>
						<a href="#"></a><div class="lbl"><a href="#"> <div class="headerpara show-popup">Forgotten your password?</div></a>
 					</div>
					
					</div>
                        <a href="#">
                          <div class="login_btn" id="login_id"> Login </div>
                       </a>
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
                         </form>
                         <div class="login_msg"></div></div>
                      
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
                                  <input id="email_forgot" name="email_forgot" type="email" placeholder="Enter Your Email ID" class="form-control input-md" required="" value="">
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
                       
                      
                      
                     </div>
                  </div>
               </div>
               <!--End nav-->
            </div>
         </div>