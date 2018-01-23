
 @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                  <a href="all-users-list"><span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span></a>
                <div class="info-box-content">
                  <span class="info-box-text">User Details</span>
                  <span class="info-box-number"><?php echo $reg_count;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                  <a href="agent-list"> <span class="info-box-icon bg-red"><i class="fa fa-flag-o"></i></span></a>
                <div class="info-box-content">
                  <span class="info-box-text">agent details</span>
                  <span class="info-box-number"><?php echo $agent_count;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
               <a href="user-payment-list">  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Revenue</span>
                  <span class="info-box-number"><?php echo $count_paid;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                  <a href="package-list">  <span class="info-box-icon bg-aqua">
<i class="fa fa-envelope-o"></i></span></a>
                <div class="info-box-content">
                  <span class="info-box-text">Package List</span>
                  <span class="info-box-number"><?php echo $count_package;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Payment Report</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                    
                      
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
               <!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i></span>
                        <h5 class="description-header">$<?php echo $total_revenue;?></h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> </span>
                        <h5 class="description-header">$<?php echo $monthly_revenue;?></h5>
                        <span class="description-text">MONTHLY REVENUE</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> </span>
                        <h5 class="description-header">$<?php echo $monthly_revenue;?></h5>
                        <span class="description-text">WEEKLY REVENUE</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block">
                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> </span>
                        <h5 class="description-header">$<?php echo $today_revenue;?></h5>
                        <span class="description-text">DAY REVENUE</span>
                      </div><!-- /.description-block -->
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
             <!-- /.box -->
              <div class="row">
                <div class="col-md-6">
                  <!-- DIRECT CHAT -->
                 <!--/.direct-chat -->
                </div><!-- /.col -->

                <div class="col-md-6">
                  <!-- USERS LIST -->
          <!--/.box -->
                </div><!-- /.col -->
              </div><!-- /.row -->

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Lists</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                            <th>Email</th>
                          <th>DOB</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          
                          
                          <?php
                           $serial=1;
                          foreach($reg_list as $user_list)
                          {
                              
                          
                          ?>
                        <tr>
                          <td><?php echo $serial++;?></td>
                          <td><?php echo $user_list->name; ?></td>
                          <td><?php echo $user_list->email; ?></td>
                          <td><?php echo $user_list->dob; ?></td>
                        </tr>
                       
                      <?php
                          }
                          ?>
                       
                       
                       
                        
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                  <a href="all-users-list" class="btn btn-sm btn-default btn-flat pull-right">View All List</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
              <!-- Info Boxes Style 2 -->
             <!-- /.info-box -->
             <!-- /.info-box -->
              <!-- /.info-box -->
            <!-- /.info-box -->

            <!-- /.box -->

              <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Recent Payment List</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <?php
                  foreach($paid_list as $paidlist)
                  {
                  ?>
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                  
                  
                   
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset($paidlist->path)}}" alt="Product Image">
                      </div>
                      <div class="product-info">
                       <?php echo $paidlist->name;?> <span class="label label-success pull-right">$<?php echo $paidlist->rate;?></span>
                        <span class="product-description">
                          <?php echo $paidlist->paid_date;?>
                        </span>
                      </div>
                    </li><!-- /.item -->
                  </ul>
                </div><!-- /.box-body -->
                  
                  <?php
                  }
                  ?>
                <div class="box-footer text-center">
                  <a href="user-payment-list" class="uppercase">View All Lists</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

       @include('include.admin.footer')


      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

 <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/admin/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/app.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('assets/admin/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{asset('assets/admin/plugins/chartjs/Chart.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('assets/admin/dist/js/pages/dashboard2.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
  </body>
</html>
