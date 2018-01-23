<?php
$sess_id= \Session::get('id');
    $data1 = $results['login'];
       // var_dump($data1);exit;
    $sess = \Session::get('username');
    $user_prf=\ DB::table('user_profile')->get();
    $get_education=\ DB::table('education')->get();
    $get_rel=\ DB::table('religion')->get();
	$get_caste=\ DB::table('caste')->get();
	$get_stat=\ DB::table('state')->get();
	$get_dist=\ DB::table('district')->get();
	$get_occupation=\ DB::table('occupation')->get();


   ?>

@include('include.profile_header')
        
        
        
        <meta name="_token" content="{!! csrf_token() !!}"/>
        
      <!--  <link type="text/css" rel="stylesheet" media="all" href="{{asset('assets/css/chat/chat.css')}}" />
	  <link type="text/css" rel="stylesheet" media="all" href="{{asset('assets/css/chat/screen.css')}}" /> -->
	    
        
         
         <div class="section2">
            <div class="container">
              <div class="row">
                   <div class="part-main">
                    	 <button class="chat-btn">
           <img src="{{asset('assets/images/chat.png')}}">
           </button>
            
						
						<div class="part1">
                       

                        	<div class="col-lg-12">
                         <div class="left-part">
                     
                          <form class="filter_form">
                                <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
<?php
 $settings_permission=\DB::table('settings')
                       ->get();
                foreach($settings_permission as $permission)
                {
                 $s_religion=$permission->religion;
                 $s_education=$permission->education;
                 $s_occupation=$permission->occupation;
                 $s_place=$permission->place;
                  $s_age=$permission->age;


                }   
     if($s_religion==1)   
     {


?>

      <div class="panel panel-default">
        <div id="headingOne" role="tab" class="panel-heading">
          <h4 class="panel-title" id="-collapsible-group-item-#1-">
            <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="collapsed">
              RELIGION 
            </a>
          <a href="#-collapsible-group-item-#1-" class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div aria-labelledby="headingOne" >

          <div class="panel-body">
          <div class="scrollpart">
<?php 
foreach($get_rel as $religion)
{
	$r_id=$religion->religion_id;
?>
 <input type="checkbox" class="search_filter" name="religion[]" value="<?php echo $religion->religion_id; ?>" > &nbsp;&nbsp;<label class="label-checkbox"><?php echo $religion->religion; ?></label><br>

 <div class="sublist">
 <?php 
foreach($get_caste as $caste)
{
	$rel_id=$caste->religion_id;
	if($r_id==$rel_id)
	{
?>
 <input type="checkbox" class="search_filter" name="caste[]" value="<?php echo $caste->caste_id; ?>" > &nbsp;&nbsp; <label class="label-checkbox"><?php echo $caste->caste; ?></label><br>
 
    
 
<?php }}
?>
 <input type="checkbox" class="search_filter" name="other_caste[]" value="other_caste" > &nbsp;&nbsp; <label class="label-checkbox">Other</label><br>
  
          </div>
<?php } ?>
<br>

  <input type="checkbox" class="search_filter" name="other_religion[]" value="other_religion"  > &nbsp;&nbsp; <label class="label-checkbox">Other</label>

        </div>
      </div>
     </div>
      
      </div>
      
     <?php
   }
    if($s_place==1)   
     {
   ?>
      
         <div class="panel panel-default">
        <div id="headingThree" role="tab" class="panel-heading">
          <h4 class="panel-title" id="-collapsible-group-item-#3-">
            <a aria-controls="collapseThree" aria-expanded="false" href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="collapsed">
              PLACE
            </a>
          <a href="#-collapsible-group-item-#3-" class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div aria-labelledby="headingThree" >
          <div class="panel-body">
          <div class="scrollpart">
          <?php 
foreach($get_stat as $state)
{
	$st_id=$state->state_id;
?>
            <input type="checkbox" class="search_filter" name="state[]" value="<?php echo $state->state_id; ?>" > &nbsp;&nbsp; <label class="label-checkbox"><?php echo $state->state; ?></label><br>
           

            <div class="sublist">
             <?php 
foreach($get_dist as $district)
{
	$dst_id=$district->state_id;
	if($st_id==$dst_id)
	{
?>
     <input type="checkbox" class="search_filter" name="district[]" value="<?php echo $district->district_id; ?>" > &nbsp;&nbsp; <label class="label-checkbox"><?php echo $district->district; ?></label><br>
       
       <?php }}?>
          </div>
         
         
       <?php }?>    
           
        </div>
      </div>
     
      </div>
      </div>
      <?php
    }
     if($s_age==1)   
     {
      ?>
      
      <div class="panel panel-default">
        <div id="headingFour" role="tab" class="panel-heading">
          <h4 class="panel-title" id="-collapsible-group-item-#4-">
            <a aria-controls="collapseFour" aria-expanded="false" href="#collapseFour" data-parent="#accordion" data-toggle="collapse" class="collapsed">
              AGE
            </a>
          <a href="#-collapsible-group-item-#4-" class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div aria-labelledby="headingFour" >
          <div class="panel-body">
         
            <input type="checkbox" class="search_filter"  name="dob[]" value="18"> &nbsp;&nbsp; <label class="label-checkbox">18-23</label><br>
                                                                                                                  
        <input type="checkbox" class="search_filter"  name="dob[]" value="24" > &nbsp;&nbsp; <label class="label-checkbox">24-29</label><br>
          
            <input type="checkbox" class="search_filter"  name="dob[]" value="30" > &nbsp;&nbsp; <label class="label-checkbox">30-35</label><br>
           
            <input type="checkbox" class="search_filter"  name="dob[]" value="36"  > &nbsp;&nbsp; <label class="label-checkbox">36-41</label><br>                                                                                                               
        
      </div>
 
      </div>
      </div>
     <?php
   }
    if($s_education==1)   
     {
   ?>
      
      <div class="panel panel-default">
        <div id="headingTwo" role="tab" class="panel-heading">
          <h4 class="panel-title" id="-collapsible-group-item-#2-">


            <a aria-controls="collapseTwo" aria-expanded="false" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="collapsed">
              EDUCATION 
            </a>
          <a href="#-collapsible-group-item-#2-" class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div aria-labelledby="headingTwo" >
          <div class="panel-body">
              <div class="scrollpart">
              <?php
      
        foreach($get_education as $education)
        {
        ?>
       <input type="checkbox" class="search_filter" name="education[]" value="<?php echo $education->education_id; ?>" > &nbsp;&nbsp; <label class="label-checkbox"><?php echo $education->education; ?></label><br>

<?php }
?>
 
 
     
              </div>
          </div>
        </div>
      </div>
      <?php
    }
     if($s_occupation==1)   
     {
    ?>
     <div class="panel panel-default">
        <div id="headingOne" role="tab" class="panel-heading">
          <h4 class="panel-title" id="-collapsible-group-item-#1-">
            <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="collapsed">
              OCCUPATION 
            </a>
          <a href="#-collapsible-group-item-#1-" class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div aria-labelledby="headingOne" >

          <div class="panel-body">
          <div class="scrollpart">
<?php
foreach($get_occupation as $occu)
{
?>

 <input type="checkbox" class="search_filter" name="occupation[]" value="<?php echo $occu->occupation_id; ?>"> &nbsp;&nbsp; <label class="label-checkbox"><?php echo $occu->occupation; ?></label><br>
 
<?php }
?>

  

          </div>

        </div>
      </div>
     </div>
     
     <?php
   }
     ?>
     
      
      <!-- <input type="submit" value="filter" class="search_btn"> -->

    </div>
   </form>
                         </div>
                  </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                         <div class="part2 search-results">


			 <?php
	 $data = $results['users'];
	 
 	if( !empty($data) ) 
		                 {
     foreach($data as $user)
     {
		$dob=$user->dob;
		$birthdate = new DateTime($dob);
		$today   = new DateTime('today');
		$age = $birthdate->diff($today)->y;
	    $id=$user->user_id;
	    $encrypted_id = base64_encode($id);
	     

 
			
       ?>

                 <div class="col-md-4">
                     <div class="colum2">
                     	<p class="prfl-img">
                        <?php if(empty($user->path))
						{?>
                      <a href='search-profile-view/{{$encrypted_id}}'>  <img src="{{asset('assets/images/default_profile.jpg')}}"></a>
                        <?php } else
						{
							?>
						 <a href='search-profile-view/{{$encrypted_id}}'>	 <img src="{{asset($user->path)}}"/></a>
							<?php } ?>
                        </p>
                       <div class="personal-details">
                       
                        <p class="prfl-details">Name: <?php echo $user->name;?></p>
                         <p class="prfl-details">Age: <?php echo $age;?></p>
                        <p class="prfl-details">Religion: <?php if(empty($user->religion)){echo $user->other_religion;}else {
                          echo $user->religion;
                        }?>-<?php if(empty($user->caste)){echo $user->other_caste;}else {
                          echo $user->caste;
                        }?></p>
                        
                         <p class="prfl-details">Place: <?php echo $user->district;?>,<?php echo $user->state;?></p>
                       </div>
					   
					   
					  
                       <?php
					   $user_id=$user->user_id;
					   
						 
                        $interested= \DB::table('interests')
								     ->where('sender_name',$sess)
								     ->where('interested_member',$user_id)->get();
						$count=	count($interested);	
						
						 $button_text = 'INTEREST';
					 if($count==1)
					 {
						 $button_text = 'INTERESTED';
					 }
					 ?>
					
                      <div class="profile-interested-button">
                 <input type="button" intrst_id="<?php echo $user->user_id;?>" value="<?php echo $button_text; ?>" class="<?php if($user->gender=="male")
				        {echo "butn-interest-male";}
					   else {echo "butn-interest-female";}?> <?php if($button_text=="INTERESTED")
				        {echo "intrstd_clr";}?> interest intstd<?php echo $user->user_id;?> ">
                       </div>
                     </div>
               </div>
               <div class="int_msg"></div>

                  
						<?php
                       }
						 }
						 
                    else
	                {
						?>
						 
                    Sorry! No Results Found For Your Request.
                   
                   
                
           <?php
	   }
	   ?>
             


  </div>
						
						
		
				<div class="loader_cls"></div>		
						
						
                   </div>               
               </div>
               
               
            </div>
			
  <!--  chat-->
            <div id="main_container">
              <button class="chat-btn-close">
           X
           </button>
<ul class="headofchat">
  <li><img src="{{asset('assets/images/chat/chaticon.png')}}"></li>
  <li>Online Members</li>
</ul>
<div class="chatlistcontent">

<?php
$data = $results['chat_users'];

foreach($data as $status)
{

  ?>
 

<a title="" data-placement="left" data-toggle="tooltip" data-original-title="Tooltip on left" href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $status->username;?>', '<?php echo $status->name;?>')">
       <?php if($status->status =='online') {?>
                <img class="" src="{{asset('assets/images/chat/online.png')}}"><?php }
        elseif($status->status =='busy') {?>
                <img class="" src="{{asset('assets/images/chat/busy.png')}}"> <?php }
        else {?><img class="" src="{{asset('assets/images/chat/offline.png')}}">
        <?php }?>&nbsp;&nbsp;
                 <?php if(empty($status->path))
            {?>
                       <img  class="imagechat" src="{{asset('assets/images/default_profile.jpg')}}">
                        <?php } else
            {
              ?>
               <img class="imagechat" src="{{asset($status->path)}}">
              <?php } ?>
              &nbsp;&nbsp;  <?php echo $status->name;?></a>
             
             


<!-- YOUR BODY HERE -->
<?php }?>
</div>
<ul class="searchlistchat">
  <li class="textarealist"><img class="" src="{{asset('assets/images/chat/chat-search-icon.gif')}}">
    <input class="chatsearchfield chatsearch" type="text" id="inputSearch"   autocomplete="off" name="chatsearch" placeholder="Find a Member"></li>
    
    <div class="result1">
</div>





  <li class="statusdrpdwn">
  <div data-example-id="static-dropup" class="bs-example">
    <div class="dropup">
      <a aria-expanded="false" aria-haspopup="true" href="#" data-toggle="dropdown" id="dropdownMenu2" class="dropdown-toggle"><img class="" src="{{asset('assets/images/chat/chatstatus.png')}}"></a>
          
      <ul aria-labelledby="dropdownMenu2" class="dropdown-menu chatstatusdrpdw">
        <li><a href="#" class="a" title="offline"><span class="statuschat">Offline</span> <img class="statuschatimg" src="{{asset('assets/images/chat/offline.png')}}"></a></li>
        <li><a href="#" class="a" title="online"><span class="statuschat" >Online</span> <img class="statuschatimg" src="{{asset('assets/images/chat/online.png')}}"></a></li>
        <li><a href="#" class="a" title="busy"><span class="statuschat">Busy</span> <img class="statuschatimg" src="{{asset('assets/images/chat/busy.png')}}"></a></li>
      <!--   <li><a href="#" class="a" title="turnoffchat"><span class="statuschat">Turn Off Chat</span> </a></li> -->
    
      </ul>
    </div>
  </div>
  
  </li>
</ul>
</div>






            <!--  chat-->
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
	   <script type="text/javascript" src="{{asset('assets/js/chat/chat.js')}}"></script>
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
     $(".loader_cls").hide(); 
						  interest();
		 $(".search_filter").click(function(){
              $(".loader_cls").show(); 
			
             var value =$(".filter_form").serialize() ;
			
			$.ajax({
			type:'POST',
			url: "{{ url('user/userfilter')}}",
			data: value,
			success:function (results){
                 $(".loader_cls").hide(); 
				$('.search-results').html(results);
				interest();
					},
					error:function (results){
				
					}
				});
		});
});
			  /*ajax end here*/
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>

<script>
function interest() {
      $(".loader_cls").hide(); 
		 $(".interest").on("click",function(){
               $(".loader_cls").show(); 
             
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
                         $(".loader_cls").hide(); 
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
}
</script>	
<!--search-->
<script type="text/javascript">
$(function(){
$(".chatsearch").keyup(function() 
{ 

var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;

  
     $.ajax({
     type: "POST",
     url: "{{ url('user/chat-autocomplete') }}",
     data: dataString,
     cache: false,
     success: function(html)
     {
     
     $(".chatlistcontent").html(html).show();
     }
  
     });
      
      
      
      
return false; 
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
});

jQuery(".result1").on("click",function(e){ 
     var $clicked = $(e.target);
     var $name = $clicked.find('.name').html();
     var decoded = $("<div/>").html($name).text();
     $('#inputSearch').val(decoded);
});
jQuery(document).on("click", function(e) { 
     var $clicked = $(e.target);
     if (! $clicked.hasClass("chatsearch")){
     jQuery(".result1").fadeOut(); 
     }
});
$('#inputSearch').click(function(){
     jQuery(".result1").fadeIn();
});
});


</script>  
	  
	  <script>
$(document).ready(function(){
    $(".loader_cls").hide(); 
     $(".a").click(function(){
      var value =$(this).attr('title') ;
      
      /*if(value=='turnoffchat')
      {
      $('#main_container').hide();  
      }
      else
      {
        $('#main_container').show();
      }*/
      $.ajax({
      type:'GET',
       url: "{{ url('user/status-update') }}",
       data:{'stat':value},
      success:function (status_update){
         console.log(status_update);
           $(".loader_cls").show(); 
         location.reload('user/search');
      
      }
        });
    });
});
        /*ajax end here*/
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>

<script type="text/javascript" src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<script>
  $('.scrollpart').slimscroll({
        size: '7px',
    
  });
</script>
<script>
$(document).ready(function(){
    $(".chat-btn-close").click(function(){
        $("#main_container").fadeOut();
    });
    $(".chat-btn").click(function(){
        $("#main_container").fadeIn();
    });
 
});

</script>
	  
   </body>
</html>

