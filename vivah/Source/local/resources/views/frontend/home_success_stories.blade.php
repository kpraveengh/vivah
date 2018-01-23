
@include('include.frontpage_headers')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datetimepicker/DateTimePicker.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/parsley/parsley.css')}}" />
 <meta name="_token" content="{!! csrf_token() !!}"/>


<div class="section2">
            <div class="container">
               <div class="row">
                  <div class="part-main1">
                     <div class="col-lg-12">
                        <div class="upgradepart">
                           <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                              <ul role="tablist" class="nav nav-tabs upgradetab" id="myTabs">
                                 <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">SUCCESS STORIES</a></li>
  
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                 <div aria-labelledby="home-tab" id="home" class="tab-pane active" role="tabpanel">
                                    <!--new html starts-->
                                    <div class="tab-inner-part">
                                        
                    <?php
                     $state_s=\DB::table('state')
                               ->get();
                 $country_s=\DB::table('country')
                             ->get();
		 foreach($details as $dtls)
		 {
			
			 $img=$dtls->images;
			 $images=explode(",",$img);

      
			
		 ?>
										<div class="conetntupgd_successstories">
										   <div class="col-lg-2">
											  <div class="img_successstory">
												 <img width="150" height="150" src="{{asset($img)}}">
											  </div>
										   </div>
										   <div class="col-lg-10">
											  <p class="succ_stories_id">  <?php echo $dtls->rand_id;?>| <?php echo $dtls->mrg_date; ?></p>
											  <p class="succ_stories_name"><?php echo $dtls->bride_name;?> &amp;  <?php echo $dtls->groom_name;?></p>
											  <p class="succ_stories_senten"> <?php echo $dtls->success_story;?></p>
										   </div>
										</div>
										
										 <?php } ?>
										
										
										
										
										
										
										
										
                                    </div>
                                    <!--new html ends-->
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
         <!-- Footer--> 
         @include('include.home_footer')
         <!-- End Footer -->
      
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="{{asset('assets/js/bootstrap.js')}}"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{asset('assets/js/ie10-viewport-bug-workaround.js')}}"></script>
      <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
       <script src="{{asset('assets/js/jquery.form.js')}}"></script> 
    <script src="{{asset('assets/js/parsley/parsley.min.js')}}"></script> 

 <!--datepicker-->
<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/datetimepicker/DateTimePicker-i18n.js')}}"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

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
  
/*if ($('#myForm').parsley().validate() ) {*/
$('#myForm').ajaxForm(function(options) { 
              $('.resultss').html(options );
           });
/*}
 $.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});*/

</script>

 <script type="text/javascript">
     $(document).ready(function()
 {
       
     $("#dtBox").DateTimePicker();
    
 });
   </script>
   </body>
</html>