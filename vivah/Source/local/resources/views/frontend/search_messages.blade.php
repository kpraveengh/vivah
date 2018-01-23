<?php
$id= \Session::get('id');
      $data1 = $results['login'];
   $send_id= \Session::get('senderid');
 
     
?>
@include('include.profile_header')
		 
		 
		 <!--new html starts-->
		 
         <div class="message-section-main">
   <div class="message-section">
      <div class="bgimage">
         <div class="container">
            <div class="row">
               <div class="part-main1">
                  <div class="">
                     <div class="upgradeparts_messagebody">
                        <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                           <div class="col-lg-4">
                              <div class="left-tab-message">
                                 <ul role="tablist" class="nav nav-tabs" id="myTabs">
                                    <li class="active" role="presentation"><a aria-expanded="true" data-target="#home, #All" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home"><span class="arrowmsg"></span> &nbsp;&nbsp; Sent</a></li>
                                 </ul>
                              </div>
                           </div>
                          
                              <div aria-labelledby="All-tab" id="All" class="tab-pane fade active in" role="tabpanel">
                            <div aria-labelledby="home-tab" id="home" class="tab-pane fade active in" role="tabpanel">
                                 <div class="col-lg-8 paddng0">
                                    <div class="message-tob-tab">
                                       <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                                          <ul role="tablist" class="nav nav-tabs" id="myTabs">
                                             <li class="active" role="presentation"><a aria-expanded="true" aria-controls="All" data-toggle="tab" role="tab" id="All-tab" href="#All">ALL</a></li>
                                             <li role="presentation" class=""><a aria-controls="New" data-toggle="tab" id="New-tab" role="tab" href="#New" aria-expanded="false">New</a></li>
                                          </ul>
                                          <div class="upgradeparts-inner">
                                             <div class="tab-content" id="myTabContent">
                                             
                                                <div aria-labelledby="All-tab" id="All" class="tab-pane fade active in" role="tabpanel">
												
                                                      <?php
                          if($sentmessage)
                          {
                                          foreach($sentmessage as $sentbox_message)
                      {
                        
                         $dob=$sentbox_message->dob;
                                        $birthdate = new DateTime($dob);
                                        $today   = new DateTime('today');
                                        $age = $birthdate->diff($today)->y;
                        
                        
                        
                        $user_id=$sentbox_message->user_id;
            
               $interested= \DB::table('interests')
                     ->where('sender_id',$id)
                     ->where('interested_member',$user_id)
                                    ->get();
        $count=count($interested);  
            
             $button_text = 'INTEREST';
           if($count>0)
           {
             $button_text = 'INTERESTED';
           }
            $sess= \Session::get('senderid');
            $receiver_id = base64_encode($sess);
                      ?>

                                                   <div class="msg_notify ">
                                                   
                                                      <div class="col-lg-3">
                                                       
                                                         <img class="msgg_images" src="{{asset($sentbox_message->path)}}">            
                                                      </div>
                                                      <div class="col-lg-9 margin25">
                                                         <div class="msg_body">
                                                        
                                                            <h3 class="heading_messages">To: <?php echo $sentbox_message->name; ?></h3>
                                                             
                                                            <p class="para12"><?php echo $sentbox_message->message; ?></p>
                                                            <p class="para12"><?php echo $sentbox_message->message_date; ?></p>
                                                             <input style="width:25%;" type="button" intrst_id="<?php echo $sentbox_message->user_id;?>" value="<?php echo $button_text; ?>" class="msg_addphoto interest intstd<?php echo $sentbox_message->user_id;?>"   >
                                                            <a href="{{URL::to('user/search-profile-view')}}/{{$sess}}"> <input class="msg_sendmail"   value="View Profile"></a>
                                                           <!--   <a href="#" sent_id="<?php echo $sentbox_message->user_id; ?>" class="sent_delete" > <input class="msg_sendmail" type="button"   value="Delete"></a> -->
                                                            
                                                         </div>
                                                      </div>
                                                   
                                                    
                                                </div>
												 <?php
                         }
                       }
                      else
                      {
                        echo "No Messages";
                      }
                      ?>
												
												</div>
                                               
                                                <div aria-labelledby="New-tab" id="New" class="tab-pane fade" role="tabpanel">
                                                   <div class="msg_notify ">
                                                      
                                                      <div class="col-lg-12">
                                                         <div class="msg_body">
                                                          <div class="new-msg">
                   
                   
   
    
     <?php
    foreach($drop_down as $drop_down_res)
   {
   // var_dump($drop_down_res);exit;
    ?>
     <input class="input-msg"  type="text" value="<?php echo $drop_down_res->name; ?>" readonly>
   <?php
   }
   // $receiver_id="";
   ?>
  
      
      
  <input type="hidden" value="<?php echo $id; ?>" id="hid_id">  <br />
 

<textarea id="compose_message" rows="4" class="compose-area mousetrap mesgtextarea" placeholder="Write your message" aria-hidden="true" name="message..."></textarea> <br />

<input type="submit" name="dataAndImageForm"  id="login_id" value="SUBMIT" class="btn-success-stories save-button">
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
	   <link href="{{asset('assets/css/select2.min.css') }}" rel="stylesheet" />
      <script src="{{asset('assets/js/select2.min.js') }}"></script>
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
         					 
							   $('select').select2();
		 
  
							 
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

 
 
     $("#login_id").click(function(){
 
        
      var s_id=$("#hid_id").val();
    // var r_id=$("#rec_id").val();
     var msg=$("#compose_message").val();
     
          $.ajax({
            type: "GET",
            url: "{{ url('user/search-send-message') }}",
            data:{s_id:s_id,msg:msg},
      success:function (return_rel){
          //$('.loader').hide();
      console.log(return_rel);
                                                   if(return_rel==1){
                                                 
                                                // $(".user_caste").html(return_rel);
                                                  window.location="{{ url('user/search-messages') }}";
                                                       }
                                                       else{
                                                        $(".msg").html('error');
                                                   
                                                           }
                                                       }
          
           });  
     });
 
</script>
<script>
$(document).ready(function(){
       $(".interest").on("click",function(){
         var value =$(this).attr('intrst_id') ;
         var type =$(this).attr('value');
         var button_text = 'INTERESTED';
         var url = "{{ url('user/interestedmember') }}";
         if(type == 'INTERESTED') {
            url = "{{ url('user/interestedmemberstatus') }}";
            button_text = 'INTEREST';
         }
         var thiss = $(this);
         $.ajax({
               type:'POST',
               url: url,
               data:{'intr_id':value},
               success:function (intrstd_people){
                  console.log(intrstd_people);
                  if(intrstd_people==1){
                     $('.intstd'+value).val(button_text);
                     if(button_text=='INTERESTED')
                     {
                       $('.intstd'+value).addClass('intrstd_clr');
                     }
                     else
                     {
                         $('.intstd'+value).removeClass('intrstd_clr');
                     }
                  }
                     else{
                        $(".int_show").html('error');
                        }
                        }
                        });
         });

           /*ajax end here*/
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
      });
 
</script>
<script type="text/javascript">
	$(document).ready(function(){
	$(".sent_delete").click(function(){
							var thiss=$(this);
							var r = confirm("Do you want to delete?");
							
							if(r==true){
								var value =$(this).attr('sent_id') ;
								$.ajax({
									   url: "{{ url('user/search-messages-delete') }}",
									   method:'get',
									   data:{'id':value},
									   success:function(del){
									   console.log(del);
										 
                                           if(del==1){
												thiss.parent().parent().hide();
														}
													 else{
												 $(".delete_show").html('Fail to delete try again!!');
														 }
										                        }
									   });
								         }
												 
				       });					   
				 });
	
</script>

   </body>
</html>