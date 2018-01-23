@include('include.frontpage_headers')
		 <!--header-->
		 
		  <meta name="_token" content="{!! csrf_token() !!}"/>
		 <!--new html starts-->
		 
        
   <div class="section2">
     
         <div class="container">
            <div class="row">
               <div class="part-main1">
                  <div class="">
                     <div class="upgradeparts_messagebody">
                        
						
						
							<div class="setting_main">
							   <div class="setting_hd"> Profile Settings </div>
							   <div class="setting_mtr_main">
								  <div class="row">
									 <div class="col-md-12">
											<div class="deactivation-part">										
												<h2 class="head4"> Do You Want To Activate Your Profile? </h2>
												<div class="button-yn">
													
                                                     <a class="save-button activation" title="0">  YES</a>
                                                     <a class="stngbtn_rst activation" title="1">  NO</a>
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
       <script type="text/javascript">
$(document).ready(function(){
	$(".activation").click(function(){
							 var value = $(this).attr('title');
							
			/*ajax start here*/
				 
							
							$.ajax({
								   url: "{{ url('user/profile-activation') }}",
								   method:'POST',
								   data:{status:value},
								   success:function(activation){
									   console.log(activation);
									   if(activation=='1')
									   {
										 window.location="{{ url('user/profileview') }}"; 
									   }
									   else
									   {
										   window.location="{{ url('/') }}"; 
									   }
										 	}
									 });
          /*ajax end here*/
		   
  
		
							
	});					   
});
	$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
   </body>
</html>