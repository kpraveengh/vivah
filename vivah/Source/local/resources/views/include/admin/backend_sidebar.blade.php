      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
               
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
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('assets/images/default_profile.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $role;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
                <?php
                
                
                //$role_sess=\Session::get('login_role_id');
                $pag_id=\Session::get('permission');
             
                $pg_id=explode(',',$pag_id);
                
               
                $select_pgs=\DB::table('pages')
                                  ->whereIn('p_id', $pg_id)
                                  ->get();
                 foreach($select_pgs as $row)
                 {
                   $page_name[]=$row->pages;
        
                        }
                
                ?>
                  
                
                 <?php
            if( in_array('newley-registered-mem-list',$page_name) || in_array('all-users-list',$page_name))
            {
              ?>
            <li class="treeview">
                
                    
              <a href="#">

                <i class="fa fa-user-md"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
                
                
              <ul class="treeview-menu">
       
                  <?php
            if((in_array('newley-registered-mem-list',$page_name)) )
            {?>
                <li><a href="{{ URL::to('admin/newley-registered-mem-list') }}"><i class="fa fa-circle-o"></i> New Users</a></li>
                  <?php 
            }
                if((in_array('all-users-list',$page_name)) )
            {?>
                  
                  ?>
                  
                 
                <li><a href="{{ URL::to('admin/all-users-list') }}"><i class="fa fa-circle-o"></i> All Users List</a></li>
                  <?php
                }
                ?>
              </ul>
               
            </li>
                 <?php
            }
              if( in_array('add-agent',$page_name) || in_array('agent-list',$page_name))
            {
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Agent Management</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('add-agent',$page_name)))
                     {
                     ?>
                  
                <li><a href="{{ URL::to('admin/add-agent') }}"><i class="fa fa-circle-o"></i> Add Agent</a></li>
                    <?php
                   }
                    if((in_array('agent-list',$page_name)))
                     {
                  ?>
                <li><a href="{{ URL::to('admin/agent-list') }}"><i class="fa fa-circle-o"></i> Agent List</a></li>
                <?php
                        
                    }
                  ?>
                        
              </ul>
            </li>
               <?php
            }
              if( in_array('add-country',$page_name) || in_array('place-list',$page_name))
            {
              ?>
               <li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i>

                <span>Places</span>
                 <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('add-country',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-country') }}"><i class="fa fa-circle-o"></i> Add Places</a></li>
                   <?php
                   }
                    if((in_array('place-list',$page_name)))
                     {
                  ?>
                     <li><a href="{{ URL::to('admin/place-list') }}"><i class="fa fa-circle-o"></i> Place List</a></li>
                
                 <?php
                        
                    }
                  ?>
              </ul>
            </li>
              <?php
              }
             if( in_array('add-religion',$page_name) || in_array('religion-list',$page_name))
            {
              ?>
               <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>

                <span>Religion</span>
                 <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('add-religion',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-religion') }}"><i class="fa fa-circle-o"></i> Add Religion</a></li>
                   <?php
                   }
                    if((in_array('religion-list',$page_name)))
                     {
                  ?>
                  
                   <li><a href="{{ URL::to('admin/religion-list') }}"><i class="fa fa-circle-o"></i> Religion List</a></li>
                
                   <?php
                        
                    }
                  ?>
              
                
              </ul>
            </li>
               <?php
              }
              if( in_array('add-caste',$page_name) || in_array('caste-list',$page_name))
            {
              ?>
               <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>

                <span>Sub Caste</span>
                 <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('add-caste',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-caste') }}"><i class="fa fa-circle-o"></i> Add Caste</a></li>
                  <?php
                   }
                    if((in_array('caste-list',$page_name)))
                     {
                  ?>
                  <li><a href="{{ URL::to('admin/caste-list') }}"><i class="fa fa-circle-o"></i> Caste List</a></li>
               <?php
                        
                    }
                  ?>
                
              </ul>
            </li>
              <?php
              }
            if( in_array('add-star',$page_name) || in_array('star-list',$page_name))
            {
              ?>
              
                <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>

                <span>Star</span>
                 <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('add-star',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-star') }}"><i class="fa fa-circle-o"></i> Add Star</a></li>
                   <?php
                   }
                    if((in_array('star-list',$page_name)))
                     {
                  ?>
                   <li><a href="{{ URL::to('admin/star-list') }}"><i class="fa fa-circle-o"></i> Star List</a></li>
                  <?php
                        
                    }
                  ?>
                
              </ul>
            </li>
              <?php
            }
               if( in_array('add-rasi',$page_name) || in_array('rasi-list',$page_name))
            {
              ?>
              
               <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>

                <span>Moon Sign</span>
                 <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('add-rasi',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-rasi') }}"><i class="fa fa-circle-o"></i> Add Rasi</a></li>
                   <?php
                   }
                    if((in_array('rasi-list',$page_name)))
                     {
                  ?>
                   <li><a href="{{ URL::to('admin/rasi-list') }}"><i class="fa fa-circle-o"></i> Rasi List</a></li>
                    <?php
                        
                    }
                  ?>
                
              </ul>
            </li>
              <?php
               }
              if( in_array('add-zodiac',$page_name) || in_array('zodiac-list',$page_name))
            {
              ?>
              
               <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>

                <span>Zodiac Sign</span>
                 <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('add-zodiac',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-zodiac') }}"><i class="fa fa-circle-o"></i> Add Zodiac</a></li>
                    <?php
                   }
                    if((in_array('zodiac-list',$page_name)))
                     {
                  ?>
                   <li><a href="{{ URL::to('admin/zodiac-list') }}"><i class="fa fa-circle-o"></i> Zodiac List</a></li>
              
                  <?php
                        
                    }
                  ?>
              </ul>
            </li>
              <?php
              }
               if( in_array('add-education',$page_name) || in_array('education-list',$page_name))
            {
              ?>
              
              <li class="treeview">
              <a href="#">
                  <i class="fa fa-graduation-cap"></i>

               
                <span>Education</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('add-education',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/add-education') }}"><i class="fa fa-circle-o"></i> Add Education</a></li>
                  <?php
                   }
                    if((in_array('education-list',$page_name)))
                     {
                  ?>
                   <li><a href="{{ URL::to('admin/education-list') }}"><i class="fa fa-circle-o"></i>  Education List</a></li>
               
                  <?php
                        
                    }
                  ?>
                
              </ul>
            </li>
              <?php
               }
               if( in_array('package',$page_name) || in_array('package-list',$page_name))
            {
              ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Packages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('package',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/package') }}"><i class="fa fa-circle-o"></i> Add Packages</a></li>
                   <?php
                   }
                    if((in_array('package-list',$page_name)))
                     {
                  ?>
                <li><a href="{{ URL::to('admin/package-list') }}"><i class="fa fa-circle-o"></i> Package List</a></li>
                <?php
                        
                    }
                  ?>
              </ul>
            </li>
              <?php
               }
               if( in_array('user-payment-list',$page_name))
            {
              ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o fa-fw"></i>
                <span>Payment</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('user-payment-list',$page_name)))
                     {
                     ?>
                <li><a href="{{ URL::to('admin/user-payment-list')}}"><i class="fa fa-circle-o"></i> Paid Members</a></li>
                <?php
                   }
                   ?>
                
              </ul>
            </li>
              <?php
               }
               if( in_array('user-report',$page_name) || in_array('agent-report',$page_name))
            {
              ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-sitemap fa-fw"></i>
                <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('user-report',$page_name)))
                     {
                     ?>
                <li><a href="{{URL::to('admin/user-report')}}"><i class="fa fa-circle-o"></i> User Report</a></li>
                    <?php
                   }
                    if((in_array('agent-report',$page_name)))
                     {
                  ?>
                <li><a href="{{URL::to('admin/agent-report')}}"><i class="fa fa-circle-o"></i> Agent Report</a></li>
                 <?php
                        
                    }
                  ?>
              </ul>
            </li>
              <?php
               }
               ?>

      <li class="treeview">
              <a href="#">
                <i class="fa fa-sitemap fa-fw"></i>
                <span>Add Advertisement</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  
                <li><a href="{{URL::to('admin/add-ad')}}"><i class="fa fa-circle-o"></i> Add Ad</a></li>
                  <li><a href="{{URL::to('admin/ad-view')}}"><i class="fa fa-circle-o"></i> View Ad</a></li>  
                
              </ul>
            </li>

               <?php
              if( in_array('change-password',$page_name) )
               {
              ?>
              
              <li class="treeview">
              <a href="#">
                <i class="fa fa-key"></i>
                <span>Change Password</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('change-password',$page_name)))
                     {
                     ?>
                <li><a href="{{URL::to('admin/change-password')}}"><i class="fa fa-circle-o"></i> Change Password</a></li>
                <?php
                }
                  ?>
                
              </ul>
            </li>
              <?php
             }
               if( in_array('role-management-page',$page_name) )
               {
              ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Role Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <?php
                   if((in_array('role-management-page',$page_name)))
                     {
                     ?>
                <li><a href="{{URL::to('admin/role-management-page')}}"><i class="fa fa-circle-o"></i> Role Management</a></li>
                <?php
                   }
                   ?>
              </ul>
            </li>
               <?php
                   }
              if( in_array('add-backend-user',$page_name) || in_array('backend-user-list',$page_name))
               {
                  ?>
           <li class="treeview">
              <a href="#">
                <i class="fa fa-user-plus"></i> <span>Backend User</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                   <?php
                   if((in_array('add-backend-user',$page_name)))
                     {
                     ?>
                <li><a href="{{URL::to('admin/add-backend-user')}}"><i class="fa fa-circle-o"></i> Add User</a></li>
                    <?php
                   }
                    if((in_array('backend-user-list',$page_name)))
                     {
                  ?>
                  <li><a href="{{URL::to('admin/backend-user-list')}}"><i class="fa fa-circle-o"></i> User List</a></li>
                  <?php
                    }
                  ?>
              </ul>
            </li>
           <?php
               }
              ?>
              
              <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench fa-fw"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  
                  
                <li><a href="{{URL::to('admin/add-settings')}}"><i class="fa fa-circle-o"></i> Settings</a></li>
                   
                  
                 
              </ul>
            </li> 
              
              
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>