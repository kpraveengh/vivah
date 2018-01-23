<?php
 $data1 = $results['login'];
?>

@include('include.profile_header')
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
                                 <li role="presentation" class=""><a aria-controls="profile" data-toggle="tab" id="profile-tab" role="tab" href="#profile" aria-expanded="false">POST YOUR SUCCESS STORY</a></li>
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
                                 <div aria-labelledby="profile-tab" id="profile" class="tab-pane" role="tabpanel">
                                    <!--new html starts-->
                                    <div aria-labelledby="profile-tab" id="profile" class="tab-pane active" role="tabpanel">
                                       <div class="tab-inner-part">
                                          <h3 class="head3">Share Your Success Story &amp; Get an Attractive Gift!</h3>
                                          <p class="post-para">Share your succes story and get an attractive gift. we will also plant a tree to celibrate and symbolize the beggining of your newly married life.
                                          </p>
                                          <hr class="horrizontalline1">
                                  <form  id="myForm" action="{{URL::to('user/insert-successstory')}}" method="post"  accept-charset="UTF-8" data-parsley-validate="">  
                                   
                                             <div class="col-lg-6">
                                                
                                                 <p class="para11">Bride Name(Female)*</p>
                                    <input type="text" name="bride_name" class="field3 required" placeholder="Bride Name" data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-pattern="/^[A-Za-z\d\s]+$/" required="" data-parsley-trigger="change" >
                                                 
                                                <p class="para11">Your Matrimony ID*</p>
                                                <input type="text" name="user_matrimony_id" class="field3 required" placeholder="Your Matrimony ID" data-parsley-minlength="8" data-parsley-maxlength="10"  required="" data-parsley-trigger="change" >
                                                
                                                 <p class="para11">E-mail*</p>
                                                <input type="email" name="email" class="field3 required" placeholder="E-mail" required="" data-parsley-trigger="change" >
                                                
                                                 
                                                 <p class="para11">Engagement Date</p>
                                                <input type="text" name="engagement_date" class="field3 datepicker" data-field="date" readonly required="">
                                                 
                                                  <div id="dt1Box"></div>

                                                <p class="para11">Marriage Date*</p>
                                                <input type="text" name="mrg_date" class="field3 datepicker required" data-field="date" readonly required="">
                                                
                                                 <div id="dtBox"></div>
                                                
                                                 <p class="para11">Tel/Mobile*</p>
                                                <input type="text" name="contact_num" class="field3 required" placeholder="Telephone/Mobile" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-trigger="change" required="" data-parsley-minlength="10" data-parsley-maxlength="15">
                                                
                                                 <p class="para11">Success Story*</p>
                                                <textarea class="field3 required" name="success_story" rows="5" data-parsley-trigger="change" data-parsley-minlength="15" data-parsley-minlength="100" required=""></textarea>
                                            
                                                
                                             </div>
                                             <div class="col-lg-6">
                                                <p class="para11">Groom Name(Male)*</p>
                                                <input type="text" name="groom_name" class="field3 required" placeholder="Groom Name(Male)" data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-pattern="/^[A-Za-z\d\s]+$/" data-parsley-trigger="change" required="">
                                                <p class="para11">Your Partner's Matrimony ID</p>
                                                <input type="text" name="partners_matrimony_id" class="field3" placeholder="Your Partner's Matrimony ID" data-parsley-trigger="change" required="" data-parsley-minlength="8" data-parsley-maxlength="10"> 
                                                
                                                 <p class="para11">Address*</p>
                                                <textarea class="field3" name="address" rows="5" data-parsley-minlength="40" required="" data-parsley-trigger="change"></textarea>
                                                
                                                 <p class="para11">Country Living In</p>
                                               <!--  <input type="text" name="country_livingin" class="field3" placeholder="Country Living In"> -->
                                               <select name="country_livingin" class="field3 drop-down-arw" required="" data-parsley-trigger="change">
                                                 <?php 
                                              foreach($country_s as $s_country) 
                                              {
                                                ?>
                                                <option><?php echo $s_country->country;?></option>
                                                <?php
                                                }
                                                ?>
                                               </select>
                                                <p class="para11">State</p>
                                               <!--  <input type="text" name="state" class="field3" placeholder="State"> -->
                                             
                                               <select name="state" class="field3 drop-down-arw" required="" data-parsley-trigger="change">
                                                 <?php 
                                              foreach($state_s as $s_state) 
                                              {
                                                ?>
                                                <option><?php echo $s_state->state;?></option>
                                                <?php
                                                }
                                                ?>
                                               </select>
                                                <div class="col-lg-6">
                                                   <p class="hed_Upload_photo">Upload Photo</p><br>
												    <div class="img_uploadadminapproval1">Note:Choose Image Dimension:212x73,Type:png</div><br>
													  <input type="file" class="hed_Upload_photo im" name="image" size="40" multiple="true" required="" data-parsley-fileextension='png' data-parsley-trigger="change">
                                                </div>
                                                
                                                <div class="col-lg-6">
													<br>
                                                 
                                                </div>
                                                
                                             </div>
											 <div class="col-lg-6">
											 <div class="submt-btn">
                                               <input type="submit" value="SUBMIT" class="save-button" name="dataAndImageForm">
											   </div>
											   </div>
                                      
                                           </form>
                                           <div id="output1"></div> 
                                       </div>
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
         @include('include.footer')
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
  $(document).ready(function() {
  window.ParsleyValidator
        .addValidator('fileextension', function (value, requirement) {
            var fileExtension = value.split('.').pop();
            
            return fileExtension === requirement;
        }, 32)
        .addMessage('en', 'fileextension', 'The extension doesn\'t match the required');
  
/*if ($('#myForm').parsley().validate() ) {*/
$('#myForm').ajaxForm(function(options) { 
              $('.resultss').html(options );
           });
});
//alert("Successfully Filled")
/*}
 $.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});*/

</script>

 <script type="text/javascript">
     $(document).ready(function()
 {
       
     $("#dtBox").DateTimePicker();
    

    
       
     $("#dt1Box").DateTimePicker();


     
    
 });
   </script>
   </body>
</html>