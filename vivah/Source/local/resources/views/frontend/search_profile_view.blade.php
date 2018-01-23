 

<?php
 $data1 = $results['login'];
  $sess= \Session::get('id');
  $get_religion=\ DB::table('religion')->get();
  $get_star=\ DB::table('star')->get();
  $getzodiac_sign=\ DB::table('zodiac_starsign')->get();
  $get_country=\ DB::table('country')->get();
  $get_mothr_tounge=\ DB::table('mother_tongue')->get();
  $get_education=\ DB::table('education')->get();
   ?>

@include('include.search_profile_view_header')
         <meta name="_token" content="{!! csrf_token() !!}"/>
      <div class="myprfl-section2">
          <div class="bgimage"></div>
    </div>
    
      
      <div class="myprfl-section3">
         <div class="container">
            <div class="row">
               <div class="profiledetl">
            <div class="col-lg-9">
                      <div class="profile-details">
                        
                          <div class="col-sm-4">
                                <?php
                               // echo $senderid;exit;
                              //  $users=$values['user_details'];
                              if($users) {
                                  
                             
                             $values=$users[0];
                                  
                              $dob=$values->dob;
                              $birthdate = new DateTime($dob);
                              $today   = new DateTime('today');
                              $age = $birthdate->diff($today)->y;
                              $rand_id=$values->rand_id;
                              
                             
                                ?>
                              
                              <img class="profile-image" style='width:245px;height:265px;' src="{{asset($values->path)}}"/>
                                <?php
                                }
                                ?>
                            </div>
                            
                        
               
                               <div class="col-sm-4">
                            <div class="details">
                                  <h2 class="head-name"><span class="blue-name" id="update_username"><?php  echo $values->name; ?></span>
    
                               <span class="black-code">(<?php  echo $values->rand_id; ?>)</span></h2>
                                             
                                   <p class="para2">Age, Height &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; <?php echo $age; ?>/<?php echo $values->height; ?></p>
                                    <p class="para2">Religion &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->religion; ?></p>
                                    <p class="para2">Location &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->state;?>-<?php echo $values->district; ?></p>
                                    <p class="para2">Education &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->education;?></p>
                                    <p class="para2">Occupation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->occupation;?></p><br>
                                             
                                 
                                     <?php
                  $user_id=$values->user_id;
            
                        $interested= \DB::table('interests')
                                      ->where('sender_id',$sess)
                                      ->where('interested_member',$user_id)
                                      ->get();
        $count=count($interested);  
            
             $button_text = 'INTEREST';
           if($count>0)
           {
             $button_text = 'INTERESTED';
           }
           $send_id= \Session::get('senderid');

                 ?>
           
           
                          <input style="width:49%;" type="button" intrst_id="<?php echo $values->user_id;?>" value="<?php echo $button_text; ?>" class="btn-intrst interest intstd<?php echo $values->user_id;?> ">
                         <a href="{{URL::to('user/search-messages')}}/{{$send_id}}"> <input type="button" value="MESSAGES" class="btn-msg"></a>
                              </div>
              
                            </div>
              
          
                            
                            <div class="col-sm-4">
                             <?php
                               $paymnt="";
                            $payment=\DB::table('user_payment_details')
                                     ->where('uid',$sess)
                                     ->get();
                      foreach($payment as $pay)
                      {
                        $paymnt=$pay->user_payment_status;
                      }
              
                            if( $paymnt=='1')
              {
              ?>
                              <p class="para3">PREMIUM</p>
                                <?php } else{
                  ?>
                                <p class="para3"></p>
                                <?php }?>

                                  <!-- socialmedia -->
                            <div class="socialmedia2">
                               <?php
                                $s_id=base64_decode($send_id);
                               $socialmedias=\DB::table('user_profile')
                                              ->where('user_id',$s_id)
                                              ->get();
                             foreach($socialmedias as $get_social)
                             {
                              $fb=$get_social->facebook;
                              $twitter=$get_social->twitter;
                              $googleplus=$get_social->google_plus;
                              }
                                ?>
                           <ul class="socialmedialink">
                             
                              <a href="https://<?php echo $fb;?> ">
                                 <li><img src="{{asset('assets/images/fb.png')}}"></li>
                              </a>
                              <a href="https://<?php echo $twitter;?>">
                                 <li><img src="{{asset('assets/images/twtr.png')}}"></li>
                              </a>
                              <a href="https://<?php echo $googleplus;?>">
                                 <li><img src="{{asset('assets/images/google.png')}}"></li>
                              </a>
                           </ul>
                          
                         
                        </div>
                    <!-- socialmedia -->
                                
                            </div>
                            
                        </div>
                    </div>
                  
                  <div class="col-lg-3">
                     <div class="progressDiv">
                        <h2 class="head-name2">Profile Strength</h2>
                        <div class="statChartHolder">
                           <div style="width:250px;height:150px;margin:18px auto;">
                              <div class="percent" style="width:210px;height:210px;margin-left:22px;color:#2cbdeb;">
                                 
                                <?php
     
  //$profile_strength=\DB::table('user_profile')
  ?>
  
        <p style="display:none;"> <?php echo $values->profile_strength; ?> % </p>
      
                              </div>
                           </div>
                        </div>
                     </div>
                  </div></div>
               </div>
               <?php


                         $de_id=base64_decode($send_id);
                          $visibility_get=\DB::table('user_profile')
                                           ->where('user_id',$de_id)
                                           ->pluck('user_visibility');
                          
                         $visible = json_decode($visibility_get);
                      // var_dump($visible);exit;
                 $name=$visible->name;
$body_type=$visible->body_type;
$complexion=$visible->complexion;
$height=$visible->height;
$physical_status=$visible->physical_status;
$weight=$visible->weight;
$marital_status=$visible->marital_status;
$eating_habits=$visible->eating_habits;
$drinking_habits=$visible->drinking_habits;
$smoking_habits=$visible->smoking_habits;
$religion=$visible->religion;
$caste=$visible->caste;
$star=$visible->star;
$rasi=$visible->rasi;
$zodiac=$visible->zodiac;
$country=$visible->country;
$state=$visible->state;
$mother_tongue=$visible->mother_tongue;
$district=$visible->district;
$education=$visible->education;
$occupation=$visible->occupation;
$college=$visible->college;
$education_in_detail=$visible->education_in_detail;
$occupation_in_detail=$visible->occupation_in_detail;
$employed_in=$visible->employed_in;
$annual_income=$visible->annual_income;
$fathers_status=$visible->fathers_status;
$mother_status=$visible->mother_status;
$family_values=$visible->family_values;
$family_type=$visible->family_type;
$family_status=$visible->family_status;
$no_of_brothers=$visible->no_of_brothers;
$no_of_sisters=$visible->no_of_sisters;
$brothers_married=$visible->brothers_married;
$sisters_married=$visible->sisters_married;
$about_my_family=$visible->about_my_family;

$basic=($name==1 or $body_type==1 or $complexion==1 or $height==1 or $physical_status==1 or $weight==1 
  or $marital_status ==1 or $eating_habits==1  or $drinking_habits==1  or $smoking_habits==1);

$loc=($country==1 or $state==1 or $mother_tongue==1 or $district==1);

$reli=($religion==1 or $caste==1 or $star==1 or $rasi==1 or $zodiac==1 );

$prf=($education==1 or $occupation==1 or $college==1 or $education_in_detail==1 or 
         $occupation_in_detail==1 or $employed_in==1 or $annual_income==1);

$fam=($fathers_status==1 or $mother_status==1 or $family_values==1 or $family_type==1 or
 $family_status==1 or $no_of_brothers==1 or $no_of_sisters==1 or $brothers_married==1
  or $sisters_married==1);

$abt=($about_my_family==1);

               ?>
            
           <div class="row">
               <div class="prfl-details2">
                  <div class="col-lg-9">
                    <?php
                     
                      if($users)
                        {
                       $user = $users[0];
                         ?>

                     <div class="profile-details1">
                <h1>Personel Information</h1>
                <div class="profile-inner1">
                   <?php
                    if($basic)
                    {
                      ?>
               
                  <div class="prof-sec">
                    <div class="head-edit">
                      <div class="head-icon"><img src="{{ asset('assets/images/img2.png') }}"></div>
                      <div class="head-txt"><h2>Basic Details</h2></div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      <ul class="parent-list">
                        <li>
                           <?php
                            if($name==1)
                                {
                             ?>
                          <ul class="child-list">
                            <li class="first">Name</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->name; ?></li>
                          </ul>
                          <?php
                             }
                            ?>
                        </li>
                        <li>
                      <?php
                        if($height==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Height</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->height; ?></li>
                          </ul>
                           <?php
                             }
                            ?>
                        </li>
                        <li>
                        <?php
                        if($weight==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Weight</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->weight; ?></li>
                          </ul>
                           <?php
                            }
                            ?>  
                        </li>
                        <li>
                         <?php
                        if($eating_habits==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Eating Habbit</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->eating_habits; ?></li>
                          </ul>
                          <?php
                           }
                          ?>
                        </li>
                        <li>
                          <?php
                        if($smoking_habits==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Smoking Habbit</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->smoking_habits; ?></li>
                          </ul>
                          <?php
                            }
                           ?>
                        </li>
                      </ul>


                      </div>
                      <div class="col-md-6">
                        <ul class="parent-list">
                        <li>
                           <?php
                        if($body_type==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Body Type</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->body_type; ?></li>
                          </ul>
                          <?php
                            }
                           ?>
                        </li>
                        <li>
                        <?php
                        if($complexion==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Complextion</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->complexion; ?></li>
                          </ul>
                           <?php
                            }
                            ?>
                        </li>
                        <li>
                          <?php
                        if($marital_status==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Martial Status</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->marital_status; ?></li>
                          </ul>
                          <?php
                            }
                            ?>
                        </li>
                        <li>
                          <?php
                        if($physical_status==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Physical Staus</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->physical_status; ?></li>
                          </ul>
                          <?php
                            }
                            ?>
                        </li>
                        <li>
                          <?php
                        if($drinking_habits==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Drinking Habbit</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->drinking_habit; ?></li>
                          </ul>
                           <?php
                            }
                            ?>
                        </li>
                      </ul>


                      </div>

                    </div>


                    <hr class="hbar">
                  </div>
                     <?php
                         }
                         if($reli)
                         {
                         ?>
                  <div class="prof-sec">
                    <div class="head-edit">
                      <div class="head-icon"><img src="{{ asset('assets/images/img6.png') }}"></div>
                      <div class="head-txt"><h2>Religious Information</h2></div>
                   
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <ul class="parent-list">
                        <li>
                           <?php
                        if($religion==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Religion</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->religion; ?></li>
                          </ul>
                          <?php
                            }
                           ?>
                        </li>
                        <li>
                          <?php
                        if($caste==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Caste</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->caste; ?></li>
                          </ul>
                           <?php
                             }
                             ?>
                        </li>
                        <li>
                       <?php
                        if($star==1)
                        {
                        ?>

                          <ul class="child-list">
                       <?php
                          foreach($users as $trial)
                           {
                           $star=$trial->star;
                            }
                         if($star!="")
                            {
                          ?>
                            <li class="first">Star</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->star; ?></li>
                            <?php
                             }
                            ?>
                          </ul>
                          <?php
                            }
                            ?>
                        </li>
                        <li>
                          <?php
                        if($rasi==1)
                        {
                        ?>
                          <ul class="child-list">
                             <?php
                          foreach($users as $trial)
                            {
                          $rassi_moonsign=$trial->rassi_moonsign;
                            }
                          if($rassi_moonsign!="")
                            {
                             ?>
                            <li class="first">Raasi Moon Sign</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->rassi_moonsign; ?></li>
                             <?php
                             }
                             ?>
                          </ul>
                           <?php
                             }
                            ?>
                        </li>
                        <li>
                          <?php
                        if($zodiac==1)
                        {
                        ?>
                          <ul class="child-list">
                            <?php
                                  foreach($users as $trial)
                                      {
                                $zodiac_starsign=$trial->zodiac_starsign;
                                     }
                               if($zodiac_starsign!="")
                                   {
                               ?>
                            <li class="first">Zodiac Star Sign</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $trial->zodiac_starsign; ?></li>
                             <?php
                               }
                               ?>
                          </ul>
                           <?php
                              }
                              ?>
                        </li>
                      </ul>


                      </div>
                    </div>
                    <hr class="hbar">
                  </div>
                       <?php
                         }
                        if($loc)
                        {
                       ?>
                  <div class="prof-sec">
                    <div class="head-edit">
                      <div class="head-icon"><img src="{{ asset('assets/images/img4.png') }}"></div>
                      <div class="head-txt"><h2>Location Information</h2></div>
                   
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <ul class="parent-list">
                        <li>
                           <?php
                        if($country==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Country</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->country; ?></li>
                          </ul>
                           <?php
                            }
                           ?>
                        </li>
                        <li>
                           <?php
                        if($mother_tongue==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Mother Tongue</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->mother_tongue; ?></li>
                          </ul>
                          <?php
                           }
                          ?>
                        </li>
                        <li>
                           <?php
                        if($state==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Residing State</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->state; ?></li>
                          </ul>
                           <?php
                           }
                            ?>
                        </li>
                        <li>
                           <?php
                        if($district==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">District</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $trial->district; ?></li>
                          </ul>
                          <?php
                           }
                          ?>
                        </li>
                      </ul>
                      </div>
                    </div>
                    <hr class="hbar">
                  </div>
                   <?php
                         }
                         if($prf)
                         {
                           ?>
                  <div class="prof-sec">
                    <div class="head-edit">
                      <div class="head-icon"><img src="{{ asset('assets/images/img7.png') }}"></div>
                      <div class="head-txt"><h2>Professional Information</h2></div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <ul class="parent-list">
                        <li>
                           <?php
                        if($education==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Education</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->education; ?></li>
                          </ul>
                            <?php
                             }
                            ?>
                        </li>
                        <li>
                            <?php
                        if($college==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">College</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->college; ?></li>
                          </ul>
                          <?php
                             }
                            ?>
                        </li>
                        <li>
                           <?php
                        if($education_in_detail==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Education in Detail</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->education_in_detail; ?></li>
                          </ul>
                           <?php
                           }
                             ?>
                        </li>
                        <li>
                           <?php
                        if($occupation==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Occupation</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->occupation; ?></li>
                          </ul>
                           <?php
                             }
                             ?>
                        </li>
                        <li>
                          <?php
                        if($occupation_in_detail==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Occupation in Detail</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->occupation_in_detail; ?></li>
                          </ul>
                           <?php
                            }
                              ?>
                        </li>
                        <li>
                           <?php
                        if($employed_in==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Employed In</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->employedin; ?></li>
                          </ul>
                           <?php
                             }
                            ?>
                        </li>
                        <li>
                          <?php
                        if($annual_income==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Annuval Income</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->annual_income; ?></li>
                          </ul>
                           <?php
                                       }
                                          ?>
                        </li>
                      </ul>
                      </div>
                    </div>
                    <hr class="hbar">
                  </div>
                     <?php
                         }
                         if($fam)
                         {
                         ?>
                  <div class="prof-sec">
                    <div class="head-edit">
                      <div class="head-icon"><img src="{{ asset('assets/images/img1.png') }}"></div>
                      <div class="head-txt"><h2>Family Details</h2></div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <ul class="parent-list">
                        <li>
                          <?php
                        if($family_values==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Family Value</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->family_values; ?></li>
                          </ul>
                          <?php
                            }
                            ?>
                              
                        </li>
                        <li>
                          <?php
                        if($family_type==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Family Type</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->family_type; ?></li>
                          </ul>
                          <?php
                           }
                             ?>
                        </li>
                        <li>
                          <?php
                        if($family_status==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Family Status</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->familystatus; ?></li>
                          </ul>
                           <?php
                            }
                              ?>
                        </li>
                        <li>
                           <?php
                        if($fathers_status==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Father Status</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->fathers_status; ?></li>
                          </ul>
                           <?php
                            }
                            ?>
                        </li>
                        <li>
                           <?php
                        if($mother_status==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">Mother Status</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->mothers_status; ?></li>
                          </ul>
                             <?php
                              }
                                ?>
                        </li>
                        <li>
                            <?php
                        if($no_of_brothers==1)
                        {
                        ?>
                          <ul class="child-list">
                             <?php
                                  foreach($users as $trial)
                                   {
                                 $no_of_brothers=$trial->no_of_brothers;
                                    }
                               if($no_of_brothers!="")
                                {
                               ?>
                            <li class="first">No of Brother</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->no_of_brothers; ?></li>
                         <?php
                            }
                            ?>
                         </ul>
                            <?php
                            }
                           ?>
                        </li>
                        <li>
                           <?php
                        if($brothers_married==1)
                        {
                        ?>
                          <ul class="child-list">
                              <?php
                              foreach($users as $trial)
                                {
                                    $brothers_married=$trial->brothers_married;
                                 }
                           if($brothers_married!="")
                                {
                                  ?>
                            <li class="first">Brothers Married</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->brothers_married; ?></li>
                         <?php
                            }
                            ?>
                           </ul>
                          <?php
                            }
                            ?> 
                        </li>
                        <li>
                           <?php
                        if($no_of_sisters==1)
                        {
                        ?>
                          <ul class="child-list">
                             <?php
                           foreach($users as $trial)
                           {
                            $no_of_sisters=$trial->no_of_sisters;
                            }
                          if($no_of_sisters!="")
                            {
                          ?>
                            <li class="first">No of Sisters</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->no_of_sisters; ?></li>
                          <?php
                          }
                          ?>
                         </ul>
                          <?php
                           }
                           ?>
                        </li>
                        <li>
                           <?php
                        if($sisters_married==1)
                        {
                        ?>
                          <ul class="child-list">
                             <?php
                           foreach($users as $trial)
                           {
                  $sisters_married=$trial->sisters_married;
                           }
                            if($sisters_married!="")
                           {
                            ?>
                            <li class="first">Sisters Married</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->sisters_married; ?></li>
                         <?php
                          }
                          ?>
                        </ul>
                          <?php
                           }
                           ?>
                        </li>
                      </ul>
                      </div>
                    </div>
                    <hr class="hbar">
                  </div>
                  <?php
                         }
                       if($abt)
                       {
                           ?>
                  <div class="prof-sec">
                    <div class="head-edit">
                      <div class="head-icon"><img src="{{ asset('assets/images/img5.png') }}"></div>
                      <div class="head-txt"><h2>About my Family</h2></div>
                     
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                      <ul class="parent-list">
                        <li>
                           <?php
                        if($about_my_family==1)
                        {
                        ?>
                          <ul class="child-list">
                            <li class="first">About My Family</li>
                            <li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->about_my_family;?></li>
                          </ul>
                            <?php
                            }
                           ?>
                        </li>
                      </ul>
                    </div>
                    </div>
                  </div>
                  <?php
                   }
                   ?>
                </div>
              </div>
              <?php
                }
                ?>
                  </div>
                  <div class="col-lg-3">
                     <div class="right-part">
					  <div class="right-part1">
                        <h2 class="head-name2">Daily Recommendations</h2>
                        <br>
                        <div class="right-content">
                             <?php
                            if($recommendation)
                             {
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
                                
                                 <p class="pink-name" style="text-transform: capitalize;"><a href=<?php echo $encrypted_id;?> ><?php echo $data->name; ?></a></p>
                                 </p>
                                 <p class="qulif"><?php echo $data->education; ?>  (<?php echo $age; ?> yrs)</p>
                              </li>
                           </ul>
                           <?php
                              }
                         }
                            else
                            {
                              echo "No Results Found";
                            }
                              ?>
                          
                        </div>
						</div>
            </div> 
                  </div> 
                   <!-- advertisement -->
   <div class="col-lg-3">
                     <div class="right-part">
 <div class="right-part1">
                        <h2 class="head-name2">Advertisement</h2>
                        <br>
                        <div class="right-content">
                             <?php

                             $ad=\DB::table('advertisement')
                                  ->get();
                             foreach ($ad as $ads)
                              {
                              
                              ?>
                            
                              <ul class="prfldetails">

                           
                              
                                 <img  src="{{asset($ads->ad_image)}}">
                             
                           </ul>
                           <?php
                         }
                           ?>
                          
                          
                        </div>
						</div>
                     </div>


               </div>

<!-- advertisement -->  
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
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
   <!-- Placed at the end of the document so the pages load faster -->
   <link href="{{ asset ('assets/css/select2.min.css') }}" rel="stylesheet" />
   <script src="{{ asset ('assets/js/select2.min.js') }}"></script>
<script src="{{asset('assets/js/profilestrength/raphael-min.js')}}"></script>
<script src="{{ asset('assets/js/profilestrength/jQuery.circleProgressBar.js') }}"></script>


<script>
/////////////////////////////////////////profile Strength////////////////////////////////////////////
$(function () {
  $('.percent').percentageLoader({
    valElement: 'p',
    strokeWidth: 30,
    bgColor: '#d9d9d9',
    ringColor: '#75d2e4',
    textColor: '#2C3E50',
    fontSize: '14px',
    fontWeight: 'normal'
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
  
</body>
</html>

