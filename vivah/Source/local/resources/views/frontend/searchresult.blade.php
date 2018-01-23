<?php

	$id= \Session::get('id');
?>
          @include('include.profile_header')
   
        
  
         <div class="section2">
            <div class="container">
             
              
               
               <div class="row">
                   <div class="part-main">
                    	<div class="part1">
                        	<div class="col-lg-12">
                         	
                  </div>
                        </div>
                        
                        <div class="part2">
						 
						<?php
						
           if(count($data)>0)
            { 
           foreach($data as $details)
						{
			?>             
                  
                 
                  <div class="col-lg-4">
                     <div class="colum2">
                     	<p class="prfl-img"><img src="{{asset($details->path)}}"/></p>
                       <div class="personal-details">
                        <p class="prfl-details"><?php echo $details->email; ?></p>
                        <p class="prfl-details"><?php echo $details->dob; ?></p>
                        <p class="prfl-details"><?php echo $details->gender; ?></p>
                        <p class="prfl-details"><?php echo $details->state; ?></p>
                       </div>
                       <input type="button" value="INTEREST" class="butn-interest-male">
                     </div>              	
                  </div>
                  	<?php
			}
			}	 
			
else
{
	echo "no results found";
}
						 
?>
                  
                
                  
                   
                  
                        
                        </div>
                   </div>               
               </div>
               
               
            </div>
         </div>
         
         
         
         
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

