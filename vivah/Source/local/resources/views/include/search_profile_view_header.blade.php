
<!DOCTYPE html>
<?php
	$id= \Session::get('id');
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
       <meta name="_token" content="{!! csrf_token() !!}"/>
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
      <link rel="stylesheet" href="{{asset('assets/css/bnr/normalize.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/bnr/bliss-slider.css')}}">
      <link href="http://www.jqueryscript.net/css/jquerysctipttop.css')}}" rel="stylesheet" type="text/css">
      <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="{{asset('assets/js/bnr/bliss-slider.js')}}"></script>
   
   </head>
   <body>
      <div class="wrapper_main">
         <div class="nav_main">
         		
         			 
            
         
            <div class="container">
               <!--nav-->
               <div class="row">
                  <div class="col-md-3">
                     <div class="logo"><a href="{{ URL::to('user/search') }}"> <img src="{{asset($logo)}}"/ ></a></div>
                     
                     
                  </div>
                  <div class="col-md-9">
                     <!--list-->	
                     <form class="searchbox">

        <input type=" " class="search" id="inputSearch"   autocomplete="off" name="search"/>  
        <button class="searchbtn" value="search1" type="button" name="btn" onClick="goto_detail_page()">&nbsp;</button>
        <div class="result"></div>
 
					 
     				 </form>
                     <div class="navbg">
                        <div class="nav1">
                           <ul>
                              <li> <a href="{{ URL::to('user/search') }}"> HOME </a> </li>
                              <li> <a href="{{ URL::to('user/success-stories') }}">SUCCESS STORIES </a>  </li>
                              <li> <a href="{{ URL::to('user/messages') }}">MESSAGES</a>  </li>
                              <li style="border:none;"> <a href="{{ URL::to('user/contact/contact_view') }}"> CONTACT US</a>  </li>
                           </ul>
                        </div>
                     </div>
                     <!--End list-->
                    
                      <?php 
                     $check_availability_uograde=\DB::table('user_payment_details')
                                ->where('uid',$id)
                                ->where('user_payment_status','=','1')
                                ->count();
                                ?>
                    
                     <div class="profile">
                        <ul class="profile-head">
                          <?php
                          if($check_availability_uograde==0)
                          {
                          ?>
            <li><a href="{{ URL::to('user/payment-plans') }}" ><img src="{{asset('assets/images/dwn.png')}}"/></a></li>
            <?php
          }

            ?>
            
						
			<li>
                <div class="bs-example">
                <div class="dropdown">
				<?php 
            $count_value=$results['count_value'];
            
                    if($count_value>0) {?><span id="count-notification" class="countspan"><?php  echo $count_value; ?></span> <?php }                    ?>
                    
                <a href="#" data-toggle="dropdown"  id="notificationLink"><img src="{{asset('assets/images/noti.png')}}"/></a>
                <ul class="dropdown-menu settingsdropdwn">
					   
							<?php
						 $notification=\ DB::table('notification')
						               ->join('user_profile', 'user_profile.user_id', '=', 'notification.s_id')
						               ->where('r_id', '=', $id)
						               ->orderBy('r_id', 'asc')
							           ->limit(7)
							           ->get(); 
							
					 
			foreach($notification as $getnoti)
			 {
				 $s_id=$getnoti->s_id;
                $sender_id= base64_encode( $s_id) ;
				
			 ?>
				
		  
   <div class="display_box" align="left">
					  

      <li> <a href="{{URL::to('user/search-profile-view')}}/{{$sender_id}}" > <img src=" {{asset($getnoti->path)}} " style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php  echo  $getnoti->name." is interested in your profile"; ?> </a></li>
               		 </div>
									
				<?php
					}
					?>
						 
 
					<?php	
if(count($notification)>0)
{
	?>		
	<li class="lastlistdpdw"   ><a class="see" href="{{URL::to('user/all-notification-result')}}" target=blank>see all</a></li>
			
				<?php
}else{
				?>
				
					<li class="lastlistdpdw"   ><a class="see" href="#" >You have no new notifications</a></li>
					<?php
}?>

                                     </ul>
                                  </div>
                              </div>
							</li>
					
					 
						
						   <li><a href="{{ URL::to('user/messages') }}" ><img src="{{asset('assets/images/messages.png')}}"/></a></li>
                        	
                                
            <?php
    
    
    $menu_shows=\DB::table('user_profile')
                 ->where('user_id',$id)
                 ->where('profile_strength','>','60')
                 ->count();

                       // var_dump($menu_shows);exit;      

            ?>
                          
                               <li>
                               <div class="bs-example">
                                  <div class="dropdown">
                                     <a href="#" data-toggle="dropdown" class="olu"><img src="{{asset('assets/images/setting.png')}}"/></a>
                                     <ul class="dropdown-menu settingsdropdwn">
                                      <?php
                                      if($menu_shows)
                                      {
                                      ?>
                                        <li><a href="{{ URL::to('user/profileview') }}"><img src="{{asset('assets/images/icon3.png')}}">&nbsp;&nbsp; Edit Profile</a></li>
                                        <li><a href="{{ URL::to('user/settings/settings_view') }}"><img src="{{asset('assets/images/icon6.png')}}">&nbsp;&nbsp; Settings</a></li>
                                        <li><a href="{{ URL::to('user/settings/delete') }}"><img src="{{asset('assets/images/icon7.png')}}">&nbsp;&nbsp; Delete Profile</a></li>
                                       <li><a href="{{ URL::to('user/contact/feedback') }}" ><img src="{{asset('assets/images/icon1.png')}}">&nbsp;&nbsp; Feedback</a></li>
                                        <li class="lastlistdpdw"><a href="{{ URL::to('user/logout') }}"><img src="{{asset('assets/images/icon2.png')}}"> Logout</a></li>
                                        <?php
                                      }
                                      else
                                      {
                                        ?>
                                       <li class="lastlistdpdw"><a href="{{ URL::to('user/logout') }}"><img src="{{asset('assets/images/icon2.png')}}"> Logout</a></li> 
                                      <?php
                                    }
                                      ?>
                                     </ul>
                                  </div>
                               </div>
						   </li>
                            
                            
                            
                            <?php
						$reg=\DB::table('user_reg') 
						         ->where('id','=',$id)
                                ->get();
					 	foreach($reg as $stat)
						{
							 $status=$stat->status;
						}
					 	    if($data1) {
							$user = $data1[0];
							?>
						
							<li class="profilepic"><a class="" href="{{ URL::to('user/profileview') }}" ><img src="{{asset($user->path)}}"/> &nbsp;&nbsp;&nbsp;<?php echo $user->name."(".$user->rand_id.")"; ?></a></li>
							&nbsp;<?php if($status =='online') {?>
                <img class="" src="{{asset('assets/images/chat/online.png')}}"><?php }
				elseif($status =='busy') {?>
                <img class="" src="{{asset('assets/images/chat/busy.png')}}"> <?php }
				else {?><img class="" src="{{asset('assets/images/chat/offline.png')}}">
				<?php } }?>
					                      

					   </ul>
                     </div>
                  </div>
               </div>
               <!--End nav-->
            </div>
         </div>
        
	 <script type="text/javascript">
       
$(function(){
$(".search").keyup(function() 
{ 
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
 
      $.ajax({
      type: "POST",
        url: "{{ url('user/profile-autocomplete') }}",
 
      data: dataString,
      cache: false,
      success: function(html)
      {
      $(".result").html(html).show();
      }
      });
	  
	  
	  
	  
 return false;    
});

jQuery(".result").on("click",function(e){ 
      var $clicked = $(e.target);
      var $name = $clicked.find('.name').html();
      var decoded = $("<div/>").html($name).text();
      $('#inputSearch').val(decoded);
});
jQuery(document).on("click", function(e) { 

      var $clicked = $(e.target);
      if (! $clicked.hasClass("search")){
      jQuery(".result").fadeOut(); 
      }
	  
});
$('#inputSearch').click(function(){
      jQuery(".result").fadeIn();
});
});
$.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
 
 
</script>

	<!-- <script type="text/javascript">
	 
 
 function goto_detail_page()
    {
	 var inpu = $('.search').val();
	 var dat=inpu;
	 window.location="{{URL::to('soulmate/user/searchresult')}}/?srch="+dat;
    }
	
 $.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
 

</script>-->
        
<script type="text/javascript" >
     function notificationcount()
    {
       $("#count-notification").fadeOut("slow");
  $.ajax({
       type: "GET",
       url: "{{ url('user/notificationcount') }}",
       data: { stat:0 },
       cache: false,
       
      });
 
    }
$(document).ready(function()
{
	
$("#notificationLink").click(function()
{

notificationcount();
 
});


});
</script>

 