@include('include.frontpage_headers')
		 
		 <!--new html starts-->
         <div class="section2">
            <div class="container">
               <div class="row">
                  <div class="part-main1">
                     <div class="col-lg-12">
                        
							<?php
            $getimage=\DB::table('settings')
                       ->get();
                 foreach($getimage as $image)
                 {
                  $logo=$image->image;
                 }      
            ?>
						
						   <div class="print-page">
							   
							   
								<div class="head-print">
									<img src="{{asset($logo)}}"/ >
								</div>
							   
									<?php
									foreach($get_report as $report)
									{

									?>
									<div class="content-print">
										
										<div class="content-print-inner">
										
										<div class="col-md-9 paddingzero">
										
											<ul class="print-list-details">
												<li  class="detailed-lists">Name :</li>
												<li class="detailed-lists-an"><?php echo $report->name;?></li>
											</ul>

											<ul class="print-list-details">
												<li class="detailed-lists">Package Name :</li>
												<li class="detailed-lists-an"><?php echo $report->package_name;?></li>
											</ul>
										
										
										<ul class="print-list-details">
												<li class="detailed-lists">Date :</li>
												<li class="detailed-lists-an"><?php echo $report->paid_date;?></li>
											</ul>
											
											
											
											<ul class="print-list-details">
												<li class="detailed-lists">Period :</li>
												<li class="detailed-lists-an"><?php echo $report->period;?>days</li>
											</ul>
											
											
											
											<ul class="print-list-details">
												<li class="detailed-lists">Transaction Id :</li>
												<li class="detailed-lists-an"><?php echo $report->transaction_id;?></li>
											</ul>
										
										
										<ul class="print-list-details">
												<li class="detailed-lists">Amount :</li>
												<li class="detailed-lists-an">$<?php echo $report->rate;?></li>
											</ul>
										
										
										
										</div>
										
										<div class="col-md-3">
										
											<a href="{{URL::to('user/print-report')}}"><input class="printbtn" value="print" type="button"></a>
										 
										</div>
										<div class="col-md-3">
										
											<a href="{{URL::to('user/logout')}}"><input class="printbtn" value="logout" type="button"></a>
										 
										</div>
											
										</div>
									</div>
										
								
								
								<?php
							}
								?>
								
								
								
								
								
								
								
								<div class="col-md-12">
								
								<div class="important-details">
								
									<h2 class="head5">Important</h2>
								
								
								<ul class="lowerrules">
									<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
									<li>It is a long established fact that a reader will be distracted by the </li>
									<li>readable content of a page when looking at its layout. </li>
									<li>Many desktop publishing packages and web page editors now </li>
									<li>use Lorem Ipsum as their default model text, and a search</li>
									<li>full fare unless original age proof certificate is produced at time of journey</li>                    
								</ul>
								
								
								
								</div>
								</div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
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
   </body>
</html>