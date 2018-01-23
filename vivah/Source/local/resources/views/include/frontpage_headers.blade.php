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
      <script src="js/ie-emulation-modes-warning.js"></script>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="{{asset('assets/js/jquery.js')}}"></script>
      <link rel="stylesheet" href="{{asset('assets/css/bnr/normalize.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/bnr/bliss-slider.css')}}">
      <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
      <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="{{asset('assets/js/bnr/bliss-slider.js')}}"></script>
      <link rel="shortcut icon" href=$favicon>
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
   </head>
   <body>
      <div class="wrapper_main">
	  
	  <!--header-->
         <div class="nav_main backgrnd-gradt">
            <div class="container">

              
               <!--nav-->
               <div class="row">
                  <div class="col-md-3">
                     <div class="logo"><a href="{{ URL::to('/') }}"> <img src="{{asset($logo)}}"/ ></a></div>
                  </div>
                  <div class="col-md-9">
                     <!--list-->
                     
                  </div>
               </div>
               <!--End nav-->
            </div>
         </div>
		 