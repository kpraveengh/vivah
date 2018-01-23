
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Soulmate</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/_all-skins.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/admin/custom.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
<header class="main-header">
    <?php
            $getimage=\DB::table('settings')
                       ->get();
                 foreach($getimage as $image)
                 {
                  $logo=$image->image;
                 }      
            ?>
        <!-- Logo -->
        <a href="dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"> <img src="{{asset($logo)}}"/ ></span>
           
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
            
            <?php
             $today_date= Carbon\Carbon::today()->format('Y-m-d');
                            
                         $member_noti=\DB::table('user_reg')
                                       ->where('date',$today_date)
                                       ->get(); 
                        $mem_count=count($member_noti);
             
            $deactivate_users=\DB::table('user_reg')
                                          ->where('deactivate_status','=',1)
                                          ->where('deactivation_date',$today_date)
                                          ->get();
                        $deact_user_count=count($deactivate_users);
            
            
             $delete_users=\DB::table('delete_user_profile')
                                      ->where('deleted_date',$today_date)
                                      ->get();
                        
                        $delete_users_count=count($delete_users);
            
            
             $payment_list=\DB::table('user_payment_details')
                                        ->where('user_payment_status','=',1)
                                        ->where('paid_date',$today_date)
                                         ->get();
                        $payment_users_count=count($payment_list);
            
            $feedback_list=\DB::table('feedback_details')
                                         ->where('send_date',$today_date)
                                         ->get();
                         $feedback_users_count=count($feedback_list);
            
            
                         $a=$mem_count+$deact_user_count+$delete_users_count+$payment_users_count+$feedback_users_count;
            
            
            ?>
            
            
            
            
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
             
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php echo $a; ?></span>
                </a>
             
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $a; ?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                       
                      <li>
                        <a href="register-member-list">
                          <i class="fa fa-users text-aqua"></i> <?php echo $mem_count;?> new members joined today
                        </a>
                      </li>
                      
                        <li>
                        <a href="deactivated-member-list">
                          <i class="fa fa-warning text-yellow"></i> <?php echo $deact_user_count;?> members deactivated today
                        </a>
                      </li>
                        
                         <li>
                        <a href="deleted-member-list">
                          <i class="fa fa-users text-red"></i> <?php echo $delete_users_count;?> members deleted profile today
                        </a>
                      </li>
                        
                         <li>
                        <a href="paid-member-list">
                          <i class="fa fa-shopping-cart text-green"></i> <?php echo $payment_users_count;?> members paid today
                        </a>
                      </li>
                       
                          <li>
                        <a href="feedback-member-list">
                          <i class="fa fa-user text-red"></i> <?php echo $feedback_users_count;?> feedback send today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--<li class="footer"><a href="#">View all</a></li>-->
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
            
                
             <?php
                 $role_sess=\Session::get('login_role_id');
                
                $admin_details=\DB::table('admin')
                               ->where('role_id',$role_sess)
                               ->get();
                foreach($admin_details as $details)
                {
                    $role=$details->username;
                    
                }
                
                ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('assets/images/default_profile.jpg')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $role;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{asset('assets/images/default_profile.jpg')}}" class="img-circle" alt="User Image">
                    <p>
                    <?php echo $role;?>
                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{URL::to('admin/change-password')}}" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{URL::to('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
             
            </ul>
          </div>
        </nav>
      </header>