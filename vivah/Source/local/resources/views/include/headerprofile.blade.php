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
      <link rel="shortcut icon" href=$favicon>
   </head>
   <body>
      <div class="wrapper_main">
         <div class="nav_main">
         		
         
         
            <div class="container">
               <!--nav-->
               <div class="row">
                  <div class="col-md-3">
                     <div class="logo"><a href="{{ URL::to('user/profile') }}"> <img src="{{asset($logo)}}"/ ></a></div>
                     
                     
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
                              <li> <a href="{{ URL::to('user/profile') }}"> HOME </a> </li>
                              <li> <a href="{{ URL::to('user/profile') }}">SUCCESS STORIES </a>  </li>
                              <li> <a href="{{ URL::to('user/profile') }}">MESSAGES</a>  </li>
                              <li style="border:none;"> <a href="{{ URL::to('user/profile') }}"> CONTACT US</a>  </li>
                           </ul>
                        </div>
                     </div>
                     <!--End list-->
                     <?php 
                     $check_availability_uograde=\DB::table('user_payment_details')
                                ->where('uid',$id)
                                ->where('user_payment_status','=','1')
                                ->count();
                        //  var_dump($check_availability_uograde);exit;
                                ?>
                    
                     <div class="profile">
                        <ul class="profile-head">
                          <?php
                          if($check_availability_uograde==0)
                          {
                          ?>
						<li><a href="{{ URL::to('user/profile') }}" ><img src="{{asset('assets/images/dwn.png')}}"/></a></li>
            <?php
          }
          else
          {

          }

            ?>
						
						
			<li>
                <div class="bs-example">
                <div class="dropdown">
			
            
                 
                    
                <a href="#" data-toggle="dropdown"  id="notificationLink"><img src="{{asset('assets/images/noti.png')}}"/></a>
               
                                  </div>
                              </div>
							</li>
					
					   <li><a href="{{ URL::to('user/profile') }}" ><img src="{{asset('assets/images/messages.png')}}"/></a></li>
						
						
                        	
                               <li>
                               <div class="bs-example">
                                  <div class="dropdown">
                                     <a href="#" data-toggle="dropdown" class="olu"><img src="{{asset('assets/images/setting.png')}}"/></a>
                                     <ul class="dropdown-menu settingsdropdwn">
                                     
                                        <li><a href="{{ URL::to('user/profile') }}"><img src="{{asset('assets/images/icon3.png')}}">&nbsp;&nbsp; Edit Profile</a></li>
                                        <li><a href="{{ URL::to('user/profile') }}"><img src="{{asset('assets/images/icon6.png')}}">&nbsp;&nbsp; Settings</a></li>
                                        <li><a href="{{ URL::to('user/profile') }}"><img src="{{asset('assets/images/icon7.png')}}">&nbsp;&nbsp; Delete Profile</a></li>
                                       <li><a href="{{ URL::to('user/profile') }}" ><img src="{{asset('assets/images/icon1.png')}}">&nbsp;&nbsp; Feedback</a></li>
                                        <li class="lastlistdpdw"><a href="{{ URL::to('user/logout') }}"><img src="{{asset('assets/images/icon2.png')}}"> Logout</a></li>
                                      
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
						
							<li class="profilepic"><a class="" href="{{ URL::to('user/profile') }}" ><img src="{{asset($user->path)}}"/> &nbsp;&nbsp;&nbsp;<?php echo $user->name."(".$user->rand_id.")"; ?></a></li>
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
        
	 

 