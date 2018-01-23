

@include('include.frontpage_headers')

               <!--End nav-->
            
         <div class="section2">
            <div class="container">
               <div class="row">
                  
                   
                  <div class="part-main1">
                     <div class="col-lg-12">
                        <div class="upgradepart">
                           <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                              <ul role="tablist" class="nav nav-tabs upgradetab" id="myTabs">
                                 <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Contact us</a></li>
                                 
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                 <div aria-labelledby="home-tab" id="home" class="tab-pane active" role="tabpanel">
								 
								 
								 
								 
                                    <!--new html starts-->
                                    
                                    <div class="tab-inner-part">
                                       <div class="col-lg-12">
                                          <p class="para9">Share your Success Story and get an attractive gift. We will also plant a tree to celebrate and symbolize the beginning of your newly married life.</p>
                                          <hr class="horrizontalline1">
                                       </div>
                                         <form  id="contactdetails_forms">
                                         
                                       <div class="col-lg-6">
                                          
                                           <p class="para10">Your Name*</p>
                                             <input name="your_name" type="text" class="field3"  placeholder="Your Name" required>
                                         
                                          <p class="para10">Phone</p>
                                            <input name="phone" type="text" class="field3"  placeholder="Phone" required>
                                          
                                           <p class="para10">E-mail</p>
                                            <input name="email" type="text" class="field3"  placeholder="Email" required>
                                         
                                       </div>
                                       <div class="col-lg-6">
                                          <p class="para10">Suggestions / Feedback*</p>
                                          
                                             <textarea class="field3" name="message" rows="10" required ></textarea>
                                          <input type="submit" value="SUBMIT" class="submit-button">
                                           </form>
		                                      <div class="msg"></div>
                                       </div>
                                     
                                        <div class="loader_cls"></div>
                                    </div>
                                        
                                           
                                    <!--new html ends-->
									
									
									
									
                                 </div>
                                 <div aria-labelledby="profile-tab" id="profile" class="tab-pane" role="tabpanel">
								 
								 
								 
								 
                                  
									
									<div class="loader_cls"></div>
									
									
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Footer--> 
         @include('include.home_footer')
         <!-- End Footer -->
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="{{asset('assets/js/bootstrap.js')}}"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{asset('assets/js/ie10-viewport-bug-workaround.js')}}"></script>
      <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

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

 <script>             
				
     $(document).ready(function(){
      jQuery.validator.addMethod("accept", function(value, element, param) {
  return value.match(new RegExp("." + param + "$"));
});
      jQuery.extend(jQuery.validator.messages, {
        accept: "Please enter a value ."

        });
			
       $(".loader_cls").hide(); 
      $("#contactdetails_forms").validate({
				
       rules: {
		  
		your_name: {
             minlength: 2,
             maxlength: 15,
             accept: "[a-zA-Z]+"
                },  
		  
            email: {
            required: true,
            email: true
                   },
		message: { 
         required: true,
         minlength: 15,
         maxlength: 50
           },
		phone: {
            required: true,
			number:true,
            minlength: 10,
             maxlength: 15
                  },
	       },
    highlight: function(element) {
            $(element).addClass('red');
        },
        unhighlight: function(element) {
            $(element).removeClass('red');
        },
		 submitHandler: function (form) {
             
              $(".loader_cls").show(); 
							 
							   var value =$("#contactdetails_forms").serialize() ;
							  //alert(value);
                                 $.ajax({
                                 type:'get',
								 url: "{{ url('user/home-contact-details') }}",
                                 data: value,
                                 success:function (details){
                                     
                                      $(".loader_cls").hide(); 
                                 console.log(details);
								
                                          if(details==1)
                                          {
				   		//	alert("Submitted Succesfully");
                $(".msg").html('<div class="alert alert-success">Succesfully Add Contact Details</div>');     
                                                	
                           // window.location="{{ url('user/contact/contact_view') }}"; 													 
                                                             }
                                                     else{
                                                       $(".msg").html('<div class="alert alert-success">Error</div>');  
                                                         }
                                                     } 
                                        }); 
										 }
										  });
										  
										                     
		
		 
                             
										  
										  
										  
 });
										  
 $.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>


   </body>
</html>