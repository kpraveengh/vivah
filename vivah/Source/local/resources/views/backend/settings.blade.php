
      @include('include.admin.backend_header')
      <!-- Left side column. contains the logo and sidebar -->
     
          @include('include.admin.backend_sidebar')
      <!-- Content Wrapper. Contains page content -->

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/parsley/parsley.css')}}" />
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
           
            <li class="active">Settings</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <?php
                  $get_currency=\DB::table('country')
                                 ->get();

                  //var_dump($settings);exit;
                  foreach($settings as $sett)
                  {
                  ?>
                  <form  id="myForm" action="{{URL::to('admin/settings-update')}}" method="post"  accept-charset="UTF-8" data-parsley-validate="">   
            
                  <div class="box-body">
                    <div class="form-group">
                      <label>Site Title</label>
                      <input type="text" class="form-control" name="title" placeholder="Enter Site Title" value="<?php echo $sett->title;?>" data-parsley-minlength="4" data-parsley-maxlength="15"  required="" data-parsley-trigger="change"  >
                    </div>
                     <div class="form-group">
                      <label>Currency Symbol</label>
                     <select name="currency" class="form-control" required="" data-parsley-trigger="change">
                      <?php
                      foreach($get_currency as $currency)
                      {
                        ?>
                        <option><?php echo $currency->currency_symbol;?></option>
                        <?php
                      }
                      ?>
                     </select>
                    </div>
                      <div class="form-group">
                           <div class="row">
                                           <div class="col-lg-12">
                                          <div class="col-sm-6">
                       <label>Logo</label>
                          <input type="file" name="image" class="form-control" id="catagry_logo" value="<?php echo $sett->image; ?>" required="" data-parsley-trigger="change">
                      Please select an image 212px/73px
                      </div>                  
                        <div class="col-sm-6 text-right">
                                          
                                               <img src="{{asset($sett->image)}} ">
											  
                                           </div>
                                        </div>
                                        </div>
                                        </div>
                      <div class="form-group">
                                            <label>Fav Icon </label>
                                           <input   name="fav_icon"  id="favicon" type="file" value="<?php echo $sett->fav_icon; ?>" required="" data-parsley-trigger="change">
										   Please select an image 16px/16px
                                          
                                           
                                        </div>
                      <div class="form-group">
                      <label>Select Filter Options</label><br>
                    
                           
                        <input type="checkbox" name="religion" value="1" >  RELIGION<br>
                         <input type="checkbox" name="place" value="1"> PLACE<br>
                          <input type="checkbox" name="education" value="1"> EDUCATION<br>
                           <input type="checkbox" name="occupation" value="1"> OCCUPATION<br>
                            <input type="checkbox" name="age"  value="1"> AGE<br>
                            
                      
                    
                    </div>   
                       <div class="form-group">
                      <label>Search Without Login</label><br>
                    
                      <select name="search_without_login" class="form-control" required="" data-parsley-trigger="change">
                        <option value="on">On</option>
                         <option value="off">Off</option>
                      </select>     
                      
                      
                    
                    </div>                    
                      
                    <div class="form-group">
                      <label >Smtp Username</label>
                      <input type="text" class="form-control" name="smtp_username" placeholder="Smtp Username" value="<?php echo $sett->smtp_username;?>" required="" data-parsley-trigger="change">
                    </div>
                    <div class="form-group">
                      <label >Smtp Host</label>
                      <input type="text" class="form-control"  name="smtp_host" placeholder="Enter Smtp Host" value="<?php echo $sett->smtp_host;?>" required="" data-parsley-trigger="change">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Smtp Password</label>
                       <input type="password" class="form-control" id="exampleInputPassword1" name="smtp_password" value="<?php echo $sett->smtp_password;?>" placeholder="Enter Smtp Password" required="" data-parsley-trigger="change">
                    </div>
                     
                      <div class="form-group">
                      <label>Paypal Username</label>
                       <input type="text" class="form-control" name="payment_gateway_username" value="<?php echo $sett->payment_gateway_username;?>" placeholder="Enter paypal Username" required="" data-parsley-trigger="change">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputPassword1">Paypal Password</label>
                       <input type="password" class="form-control" id="exampleInputPassword1" name="payment_gateway_password" value="<?php echo $sett->payment_gateway_password;?>" placeholder="Enter Paypal Password" required="" data-parsley-trigger="change">
                    </div>
                     <div class="form-group">
                      <label>Paypal Signature</label>
                       <input type="text" class="form-control" name="payment_gateway_signature" value="<?php echo $sett->payment_gateway_signature;?>" placeholder="Enter Paypal signature" required="" data-parsley-trigger="change">
                    </div>
                     <div class="form-group">
                      <label>Paypal Test Mode</label>
                       <input type="text" class="form-control" name="payment_gateway_testmode" value="<?php echo $sett->payment_gateway_testmode;?>" placeholder="true/false" required="" data-parsley-trigger="change">
                    </div>
                      
                      <input type="hidden" name="_token" value="{{ csrf_token()}}">
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="dataAndImageForm" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                 
                  <?php
                  }
                  ?>
                   <div class="ag_msg"></div>
                  <div id="output1"></div> 
            @if (Session::has('message1'))
    <div class="alert alert-info">{{ Session::get('message1') }}</div>
@endif
 
              </div><!-- /.box -->

            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
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
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
  <script src="{{asset('assets/js/parsley/parsley.min.js')}}"></script> 




 <script src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript">
  
  

$('#myForm').ajaxForm(function(options) { 
              $('.resultss').html(options );
           });

</script>

  </body>
</html>
