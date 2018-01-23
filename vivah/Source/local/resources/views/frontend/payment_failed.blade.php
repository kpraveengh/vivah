@include('include.frontpage_headers')
	  

		 
		 
		 <!--new html starts-->
		 
        
   <div class="section2">
     
         <div class="container">
            <div class="row">
               <div class="part-main1">
                  <div class="">
                     <div class="upgradeparts_messagebody">
                        
						
						
							<div class="setting_main">
							   <div class="setting_hd"> Payment </div>
							   <div class="setting_mtr_main">
								  <div class="row">
									 <div class="col-md-12">
											<div class="deactivation-part">										
												<h2 class="head4"> Payment Failed </h2>
												<div class="button-yn">
													<a  href="{{URL::to('/')}}"><input type="submit" class="save-button" value="HOME"></a>
													
												</div>
											</div>
									 </div>
								  </div>
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