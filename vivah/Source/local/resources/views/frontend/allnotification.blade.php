<?php
  $sess= \Session::get('id');
  $data1 = $results['login'];
  $id= \Session::get('id');
 
 
 
 $noti=\ DB::table('notification')
						->select('*','notification.id AS n_id')
						 ->join('user_profile', 'user_profile.user_id', '=', 'notification.s_id')
						  ->join('user_reg', 'user_reg.id', '=', 'notification.s_id')
						->where('r_id', '=', $id)
						->orderBy('r_id', 'desc')
						->get(); 
						
               if($noti){
						$get_date=$noti[0];
						}


?>
          @include('include.profile_header')
        
        
  
         
         <div class="section2">
            <div class="container">
              <div class="row">
                   <div class="part-main1">           
                        <div class="col-lg-12">
						

                              
							    
							  <div class="col-lg-9">
							  <div class="upgradepart">							  						
                                 <?php	
                          if(count($noti)>0)
                               {
	                           ?>
		
							  <h2 class="notification_heads">Your Latest Updates</h2>
						      <?php
							         $dt = date("Y-m-d");
							  $yesterday = date('Y-m-d', time()-86400);
							  $display_head = '';
							foreach($noti as $disp_all)
							{
								$display_day = date('M-d, Y', strtotime($disp_all->date1));
								if($dt == $disp_all->date1) 
									{ $display_day = "Today"; }
								elseif($yesterday == $disp_all->date1) { $display_day = "Yesterday"; }
								if($display_head != $display_day	) 
								{
								   ?>
							  <div class="natification_head">
							    <div class="notifi_details">
								
							       <h3><?php echo $display_day; ?> </h3>
								</div>
							  </div>
                                   <?php
							 $display_head = $display_day;
								}
							 ?>
							
					  <div class="natification_alert">
					 
							  <div class="col-lg-1">
		                        <div class="img_successstory">
								
		                           <img class="notifition_img" src="{{ asset($disp_all->path) }}">		
						 
		                        </div>	
                              </div>
                              <div class="col-lg-9">
							  <?php
									$user_id=$disp_all->s_id;
					  
						 
                        $interested= \DB::table('interests')
								     ->where('interested_member',$user_id)->get();
				   $count=count($interested);	
						
					 	 $button_text = 'SendInterest';
					 if($count>0)
					 {
						  $button_text = 'Interested';
					 }
					 
					   $sender_id = base64_encode($disp_all->s_id);
					       ?>
					 
							    <p class="notification_idmsg"> <?php echo  "(".$disp_all->rand_id.")"; ?> Has Expressed Interest In Your Profile</p> 
							 
                                <a class="notify_link interest intstd" "<?php echo $button_text; ?>" intrst_id="<?php echo $disp_all->s_id;?>"  ><?php echo $button_text; ?></a> &nbsp; | &nbsp; <a class="notify_link " target=blank href='search-profile-view/{{$sender_id}}'>View Profile</a>
							  </div>   
							  <div class="col-lg-2">
							    <img class="delete_img delete-option"   alt="<?php echo $disp_all->n_id;?>" src="{{ asset ('assets/images/dlt_icon.png') }}">	 
								<br> <p style="color:#999999;float:right;margin:0;">Delete
								 </p>
							  </div>
							  
							  </div>
							  
	 <?php
							}
								
 					


}
else{
	?>

	<h2 class="notification_heads">You currently, have no new notifications</h2>
	<?php
	
}?>					 
					 
			</div><div class="spacingpart"> </div>
                            
                            </div>		 		
                            
                            
                                        <div class="col-lg-3">
                     <div class="right-part">
					  <div class="right-part1">
                        <h2 class="head-name2">Daily Recommendations</h2>
                        <br>
                        <div class="right-content">
                             <?php
                           
                              foreach($recommendation as $data)
                              {
                              	
                              	$dob=$data->dob;
                              	$birthdate = new DateTime($dob);
                              	$today   = new DateTime('today');
                              	$age = $birthdate->diff($today)->y;
                              	$id=$data->user_id;
                              	 $img_status=$data->img_status; 
                              	   $encrypted_id = base64_encode($id);
                              ?>
                            
                              <ul class="prfldetails">
                              	  <a href="{{URL::to('user/search-profile-view')}}/{{$encrypted_id}}">
                              <li class="imagerd"><?php if($img_status=='0')
                                 {?>
                                 <img  src="{{asset('assets/images/default_profile.jpg')}}">
                                 <?php } else
                                    {
                                    	?>
                                 <img  src="{{asset($data->path)}}">
                                 <?php } ?></a>
                              </li>
                              <li>
                                 <p class="pink-name">  <a href="{{URL::to('user/search-profile-view')}}/{{$encrypted_id}}"><?php echo $data->name; ?></a></p>
                                 </p>
                                 <p class="qulif"><?php echo $data->education; ?>  (<?php echo $age; ?> yrs)</p>
                              </li>
                           </ul>
                           <?php
                              }
                         
                              ?>
                          
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
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
    
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{ asset ('assets/js/ie10-viewport-bug-workaround.js') }}"></script>
	  
      <script type="{{ asset ('text/javascript') }}">
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
		 $(".interest").on("click",function(){
			var value =$(this).attr('intrst_id') ;
			var type =$(this).html();
			var button_text = 'Interested';
			var url = "{{ url('user/interestedmember') }}";
			if(type == 'Interested') {
				url = "{{ url('user/interestedmemberstatus') }}";
				button_text = 'SendInterest';
				  
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
						   if(button_text=='Interested')
						   {
						     $('.intstd'+value).addClass('intrstd_clr');
							  location.reload();
						   }
						   else
						   {
							    $('.intstd'+value).removeClass('intrstd_clr');
								 location.reload();
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
		        $(document).ready(function() {
			 
         $('.delete_img').click(function(){
			
   	  var value= $(this).attr( "alt" );
	  alert("are you sure you want to delete");
	 
	  
       $.ajax({
         type: "GET",
         url: "{{ url('user/delete-notification') }}",
         data:{del_noti:value},
		 success: function(html)
      {
  location.reload();
      }
       
        });  
          
});    
        });  					  	
							  
						
      </script>
	  

   </body>
</html>

