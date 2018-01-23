<?php
$id= \Session::get('id');
      $data1 = $results['login'];
   
     
?>
@include('include.profile_header')
    <div class="myprfl-section2">
        </div>
    <div class="container">
      <div class="settings-wrap">
      <div class="settings-head">
      <h1>Messages</h1>
      </div>
      <div class="row padng0">
        <div class="settings-tab-wrap">
          <div class="col-md-4">
            <div class="settings-tab1">
              <ul class="profile-tabs nav nav-tabs">
                <li class="profile-tab-li active"><a data-toggle="tab" href="#home">Inbox</a></li>
                <li class="profile-tab-li"><a data-toggle="tab" href="#menu1">Sent Items</a></li>
                <li class="profile-tab-li"><a data-toggle="tab" href="#menu4">Trash</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-8 padngl0" style="width:100%;">
            <div class="settings-tab2 padng0 border0">
              <div class="tab-content">
                
                <!--inbox-tab -->
                
                  <div id="home" class="inbox-tab tab-pane fade in active">
                    <ul class="nav nav-tabs inbox-ul">
                      <li class="inbox-li active"><a data-toggle="tab" href="#home1">All</a></li>
                    </ul>

                    <?php 
                        if($message_get)
                        {
                          $i=0;
                        foreach($message_get as $get_message)
                          {
                            $i++;
                        
                        $user_id=$get_message->user_id;
            
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
                          $receiver_id = base64_encode($user_id);
                 
                                ?>
                    <div class="tab-content">
                    <div id="home1" class="tab-pane fade in active">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" style="padding-bottom:10px;">
                          <div class="panel-heading" role="tab" id="headingOne">
                              <li class="msg-list">
                                <div class="msg-wrap">
                                  <div class="msg-prof-pic-holder">
                                    <div class="msg-prof-pic"><img src="{{asset($get_message->path)}}" style="width:100px;height:100px;">
                                    </div>
                                  </div>
                                  <div class="msg-prof-details-holder">
                                    <div class="msg-prof-details">
                                      <h1><?php echo $get_message->name.'('.$get_message->rand_id.')'; ?></h1>
                                      <p>Received Date: <?php echo $get_message->message_date; ?></p>
                                      <div class="msg-btn-bay">
                                        <input type="button" intrst_id="<?php echo $get_message->user_id;?>" class="msg-btns interest intstd<?php echo $get_message->user_id;?>" value="<?php echo $button_text; ?>">
                                        <a href="{{URL::to('user/search-profile-view')}}/{{$receiver_id}}" class="msg-btns" >View Profile</a>
                                         <a href="#" inbox_id="<?php echo $get_message->msgid; ?>" class="inbox_delete msg-btns" style="background:red";>Delete</a>
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapseOne" style="width:100%;">
                                        <input type="button" class="msg-btns" value="Message">
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                          </div>
                          <div id="collapse<?php echo $i;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body msg-container">
                              <p class="msgfrm">From <?php echo $get_message->name;?></p>
                               
                              <li class="msg-list1">
                                  <div class="msg">
                                    <div class="msg-checkng">
                                      <input id="1-1" type="checkbox" class="search-check" >
                                      <label for="1-1" class="search-check"></label>
                                    </div>
                                   
                                    <div class="msg-whole">
                                   
                                      <div class="msgcontent"> <?php echo $get_message->message; ?></div>
                                      <p class="msgtime">Received Date: <?php echo $get_message->message_date; ?></p>
                                    </div>
                                    
                                  </div>
                              </li>
                               
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    
                    </div>
                    </div>

                     <?php
                        }
                        }
                        else
                        {
                         ?>
                        <div class="no-msg"> No Messages</div>
						<?php
                        }
                        ?>
              </div>
                <!-- end-inbox-tab -->
                
                <!-- sent-tab -->
                  <div id="menu1" class="sent-tab tab-pane fade">
                    <ul class="nav nav-tabs sent-ul">
                      <li class="sent-li active"><a data-toggle="tab" href="#home2">All</a></li>
                      <li class="sent-li"><a data-toggle="tab" href="#menu12">New</a></li>
                    </ul>

                   

                    <div class="tab-content">
                       <?php
                          if($get_message_sent)
                          {
                             $j=20;
                       foreach($get_message_sent as $sentbox_message)
                         {
                          $j++;
                        //var_dump($sentbox_message);
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
         
                         $receiver_id = base64_encode($user_id);

                                ?>
                      <div id="home2" class="tab-pane fade in active">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" style="padding-bottom:10px;">
                          <div class="panel-heading" role="tab" id="headingOne">
                              <li class="msg-list">
                                <div class="msg-wrap">
                                  <div class="msg-prof-pic-holder">
                                    <div class="msg-prof-pic"><img src="{{asset($sentbox_message->path)}}" style="width:100px;height:100px;">
                                    </div>
                                  </div>
                                  <div class="msg-prof-details-holder">
                                    <div class="msg-prof-details">
                                      <h1><?php echo $sentbox_message->name.'('.$sentbox_message->rand_id.')';?></h1>
                                      <p>Sent Date : <?php echo $sentbox_message->message_date; ?></p>
                                      <div class="msg-btn-bay">
                                        <input type="button" class="msg-btns interest intstd<?php echo $sentbox_message->user_id;?>" intrst_id="<?php echo $sentbox_message->user_id;?>" value="<?php echo $button_text; ?>">
                                        <a href="{{URL::to('user/search-profile-view')}}/{{$receiver_id}}" class="msg-btns" >View Profile</a>
                                         <a href="#" sent_id="<?php echo $sentbox_message->messageid; ?>" class="sent_delete msg-btns" style="background:red";>Delete</a>
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j;?>" aria-expanded="true" aria-controls="collapseOne" style="width:100%;">
                                        <input type="button" class="msg-btns" value="Message">
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                          </div>
                          <div id="collapse<?php echo $j;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body msg-container">
                              <p class="msgfrm">To <?php echo $sentbox_message->name; ?></p>
                              
                              <li class="msg-list1">
                                  <div class="msg">
                                    <div class="msg-checkng">
                                      <input id="1-1" type="checkbox" class="search-check" >
                                      <label for="1-1" class="search-check"></label>
                                    </div>
                                    <div class="msg-whole">
                                    
                                      <div class="msgcontent"> <?php echo $sentbox_message->message; ?></div>
                                      <p class="msgtime">Sent Date : <?php echo $sentbox_message->message_date; ?></p>
                                    </div>
                                  </div>
                              </li>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                      
                 
                        
                      </div>
                      <?php
                       }
                       }
                      else
                      {
						  ?>
                        <div class="no-msg"> No Messages</div>
						<?php
                      }
                       ?>
                      <div id="menu12" class="tab-pane fade">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" style="padding-bottom:10px;">
                          <div class="panel-heading" role="tab" id="headingOne">
                              <li class="msg-list">
                                <div class="msg-wrap">
                                  <div style="width:100%;">
                                    <select  class="js-example-basic-multiple multiple-name msg-sent"  id="drops" multiple="multiple" >
                                    
                                   <?php
                                   foreach($drop_down as $drop_down_res)
                                  {?>
                                    <option value="<?php echo $drop_down_res->user_id; ?>"><?php echo $drop_down_res->name; ?></option>
                                  <?php
                                  }
                                  ?>
    
                               </select>
                               <input type="hidden" value="<?php echo $id; ?>" id="hid_id">  <br />
                                  <input id="compose_message" class="msg-sent1" type="text" placeholder="Write your message" >
                                  <input class="msg-btns" type="button" name="dataAndImageForm"  id="login_id" value="SEND" style="margin-top:10px;font-size:15px;width:100px;">
</div>
                                 
                                  
                                </div>
                                 <div class="msg"></div>
                                                          <div class="loader1" >
                <img src="{{asset('assets/images/ajax-loader.gif')}}" />
                </div>
                              </li>
                          </div>
                          
                        </div>
                      </div>
                      
                      
                      </div>
                      
                    </div>
                  </div>
                  
                <!-- end-sent-tab -->
            
                
                <!-- trash-tab -->    
                    <div id="menu4" class="tab-pane fade trash-tab">
                      <ul class="nav nav-tabs trash-ul">
                        <li class="trash-li active"><a data-toggle="tab" href="#home5">All</a></li>
                       
                      </ul>
                       <?php
                   
                    if($dltd_msgs)
                    {
                       
                                 
                foreach($dltd_msgs as $dltd)
                 {
                 
                 
                  $dltd_code =  json_decode($dltd);
                   $k=30;
                  foreach ($dltd_code as $key)
                   {
                     $k++;
                      $prfl=\DB::table('user_profile')
                                 ->where('user_id',$key->sender_id)
                                 ->get();
                  
                  foreach ($prfl as $user_p) 
                      {
                                            
                    $snd_name=$user_p->name."<br/>";
                       }
                    ?>
                      <div class="tab-content">
                        <div id="home5" class="tab-pane fade in active">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" style="padding-bottom:10px;">
                          <div class="panel-heading" role="tab" id="headingOne">
                              <li class="msg-list">
                                <div class="msg-wrap">
                                  <div class="msg-prof-pic-holder">
                                    <!-- <div class="msg-prof-pic">
                                    </div> -->
                                  </div>
                                  <div class="msg-prof-details-holder">
                                    <div class="msg-prof-details">
                                      <h1><?php echo $snd_name; ?></h1>
                                      <p><?php echo $key->message_date; ?></p>
                                      <div class="msg-btn-bay">
                                        
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $k;?>" aria-expanded="true" aria-controls="collapseOne" style="width:100%;">
                                        <input type="button" class="msg-btns" value="Message">
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                          </div>
                          <div id="collapse<?php echo $k;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body msg-container">
                              <p class="msgfrm">From <?php echo $snd_name; ?></p>
                              <li class="msg-list1">
                                  <div class="msg">
                                    <div class="msg-checkng">
                                      <input id="1-1" type="checkbox" class="search-check" >
                                      <label for="1-1" class="search-check"></label>
                                    </div>
                                    <div class="msg-whole">
                                    
                                      <div class="msgcontent"> <?php echo $key->message; ?></div>
                                      <p class="msgtime">Deleted Date :<?php echo $key->message_date; ?></p>
                                    </div>
                                  </div>
                              </li>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                     
                        </div>
                       
                      </div>
                      <?php
                       } 
                       }
                       } 
 else
                    {
                      ?>
                        <div class="no-msg"> No Messages</div>
						<?php
                    }
                    ?>
                    </div>
                <!-- end-trash-tab -->      
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
    </div>
    <link href="{{asset('assets/css/select2.min.css') }}" rel="stylesheet" />
      <script src="{{asset('assets/js/select2.min.js') }}"></script>
     <script type="text/javascript" src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.js')}}"></script>
       <script src="{{asset('assets/js/ie10-viewport-bug-workaround.js')}}"></script>
       

       <script>
    $('.msg-container').slimscroll({
        size: '5px',
    height:'200px',
    distance : '5px'

      });
    </script>
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

          $(function(){
      var $ppc = $('.progress-pie-chart'),
        percent = parseInt($ppc.data('percent')),
        deg = 360*percent/100;
      if (percent > 50) {
        $ppc.addClass('gt-50');
      }
      $('.ppc-progress-fill').css('transform','rotate('+ deg +'deg)');
      $('.ppc-percents span').html(percent+'%');
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
 
         $('.loader1').show();  
      var s_id=$("#hid_id").val();
     var r_id=$("#drops").val();
     var msg=$("#compose_message").val();
     
          $.ajax({
            type: "GET",
            url: "{{ url('user/send-message') }}",
            data:{r_id:r_id,s_id:s_id,msg:msg},
      success:function (return_rel){
           $('.loader1').hide();  
      console.log(return_rel);
                                                    if(return_rel==1){
                                                      $(".msg").html('<div class="alert alert-success">Succesfully Sent Your Message</div>');     
                                               
                                                 window.location="{{ url('user/messages') }}";
                                                       }
                                                       else{
                                                                 $(".msg").html('<div class="alert alert-danger">Error</div>'); 
                                                   
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
  $(".inbox_delete").click(function(){
              var thiss=$(this);
              var r = confirm("Do you want to delete?");
              
              if(r==true){
                var value =$(this).attr('inbox_id') ;
                $.ajax({
                     url: "{{ url('user/messages-delete') }}",
                     method:'get',
                     data:{'id':value},
                     success:function(del){
                     console.log(del);
                     
                                           if(del==1){
                        thiss.parent().parent().hide();
                          window.location="{{ url('user/messages') }}";
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
<script type="text/javascript">
  $(document).ready(function(){
  $(".sent_delete").click(function(){
              var thiss=$(this);
              var r = confirm("Do you want to delete?");
              
              if(r==true){
                var value =$(this).attr('sent_id') ;
                $.ajax({
                     url: "{{ url('user/sent-messages-delete') }}",
                     method:'get',
                     data:{'id':value},
                     success:function(del){
                     console.log(del);
                     
                                           if(del==1){
                        thiss.parent().parent().hide();
                           window.location="{{ url('user/messages') }}";
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
