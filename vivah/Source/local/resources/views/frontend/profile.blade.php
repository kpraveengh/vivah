<?php
$sess= \Session::get('id');
      $data1 = $results['login'];
	 $get_rel=\ DB::table('religion')->get();
     $get_strmon=\ DB::table('star')->get();
     $zodiac_sign=\ DB::table('zodiac_starsign')->get();
     $get_count=\ DB::table('country')->get();
     $get_educa=\ DB::table('education')->get();
	 $get_occupa=\ DB::table('occupation')->get();
	 $get_mothton=\ DB::table('mother_tongue')->get();
     
?>
@include('include.headerprofile')


<link href="{{ asset ('assets/css/imageupload/main.css') }}" rel="stylesheet" type="text/css" />
	  <link href="{{ asset ('assets/css/imageupload/jquery.Jcrop.min.css') }}" rel="stylesheet" type="text/css" />


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
                                  <!-- image upload-->
                                <?php
							
                             foreach($image as $images)
							 {
                                 $default_img=$images->path;
						         $img_status=$images->img_status;
								   	 
                             }
								 if($default_img=="" or $img_status==0)
									 
								 {
								 ?>	  
									 <div class="img_uploadadminapproval">Note:Choose Image Dimension:512x512<br>Image display only after admin approval</div>

							<img  class="profile-image" style="width:245px;height:265px;" src="{{asset('assets/images/default_profile.jpg')}}"/>
                              <?php
                                 }
                                 else
                                 {
                                 ?>	 
                              <img class='profile-image'  style='width:245px;height:265px;' src='{{asset($images->path)}}'/>  
		                     <?php
								  
					         }
						
				            ?>
                                
                                
                            	 <p data-toggle="modal" data-target="#myModal" class="paraloginlink">
                                 <a class="loginlink"  href="#">image upload </a>
                              </p>
							   
                              <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" >
                                 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-body">
                                             <div class="mybkngwte2">
                                                <div class="mybkngwte_bg">
                                                   <!-- upload form -->	    
                                                   <form id="upload_form" enctype="multipart/form-data" method="post"   onSubmit="return checkForm()" action={{('upload-image-file')}} accept-charset="UTF-8">
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <!-- hidden crop params -->
                                                      <input type="hidden" id="x1" name="x1" />
                                                      <input type="hidden" id="y1" name="y1" />
                                                      <input type="hidden" id="x2" name="x2" />
                                                      <input type="hidden" id="y2" name="y2" />
                                                      <div>
                                                          <input type="file" name="image_file" class="loginlink image_class" id="image_file" onChange="fileSelectHandler()"/>  
                                                      </div>
                                                      <div class="errors"></div>
                                                      <div class="step2">
                                                         <img id="preview" />
                                                         <div class="info">
                                                            <label class="info1">File size</label> <input type="text" class="info1" id="filesize" name="filesize" />
                                                            <label class="info1">Type</label> <input type="text"  class="info1" id="filetype" name="filetype" />
                                                            <label class="info1">Image dimension</label> <input type="text"  class="info1" id="filedim" name="filedim" />
                                                            <label class="info1">W</label> <input type="text" class="info1" id="w" name="w" />
                                                            <label class="info1">H</label> <input type="text" class="info1" id="h" name="h" />
															
															
                                                            <input type="submit" class="img-upload" value="Upload"/>
                                                            <!--<a class="cncelbuton" href="{{ URL::to('user/profile') }}">cancel</a>-->
                                                         </div>
														

                                                          </form>

                                                   </div> 
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                               <!-- image upload-->
                            </div>
                            
                           <?php
                            if($reg_values)
                            {
						   $values=$reg_values[0];
                           
									    $dob=$values->dob;
                                        $birthdate = new DateTime($dob);
                                        $today   = new DateTime('today');
                                        $age = $birthdate->diff($today)->y;
									?>
							 
                            	 <div class="col-sm-4">
                            	                              <div class="details">
                                 <h2 class="head-name"><span class="blue-name"><?php  echo $values->username; ?></span> <span class="black-code">(<?php  echo $values->rand_id;?>)</span></h2>
                                 <p class="para2">Username &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; <?php echo $values->username; ?></p>
                                 <p class="para2">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php  echo $values->email; ?></p>
                                 <p class="para2">Dob  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->dob;?></p>
                                 <p class="para2">Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->contact_num;?></p>
                              </div>
					    
                            </div>
							<?php
                            }
                            ?>
					
                            
                            <div class="col-sm-4">
                            	 <?php
                            	 $paymnt="";
                            $payment=\DB::table('user_payment_details')
							              ->where('uid',$sess)->get();
										  foreach($payment as $pay)
										  {
											  $paymnt=$pay->user_payment_status;
										  }
							
                            if($paymnt=='1')
							{
							?>
                            	<p class="para3">PREMIUM</p>
                                <?php } else{
									?>
                                <p class="para3"></p>
                                <?php }?>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="progressDiv">
                        <h2 class="head-name2">Profile Strength</h2>
                        
                        
            <div  id="PageRefresh" style="width:250px;height:194px;margin:18px auto;">
	    <div id="PageRefresh" class="percent" style="width:210px;height:210px;margin-left:22px;color:#2cbdeb;">
		                     
							 
	 
		<?php
		 
	$profile_values=$profile_str;
            //var_dump($profile_values);exit;
	?>
	
	      <p style="display:none;"> <?php echo $profile_values; ?> % </p>
			
         
		 </div>
		 </div>
            
            
        </div>
        
                    
                    </div>
                </div>
                </div>
                
                
                
                
                <div class="row">
                  <div class="prfl-details2">
                	<div class="col-lg-9">
                    <div class="left-part2">
                    	<div class="details2">
                        	<div class="col-sm-6">
                                 <div class="sub-details1">
                                    <ul class="inner-content">
                                       <li class="bluebg"><img src="{{ asset ('assets/images/img2.png') }}"/></li>
                                       <li>
                                          <p class="blue-para">Basic Details</p>
                                          <p class="grey-para">Adding a summary is a quick and easy way to highlight your experience and interests.</p>
                                       </li>
                                    </ul>
                                    <div class="add-btn">
                                       <p class="abb"><a href="#collapse22" id="1" class="toggle  panel1">ADD</a></p>
                                    </div>
                                 </div>
                              </div>
                           <div class="col-sm-6">
                                 <div class="sub-details1">
                                    <ul class="inner-content">
                                       <li class="bluebg"><img src="{{ asset ('assets/images/img6.png') }}"/></li>
                                       <li>
                                          <p class="blue-para">Religious Information</p>
                                          <p class="grey-para">Adding a summary is a quick and easy way to highlight your experience and interests.</p>
                                       </li>
                                    </ul>
                                    <div class="add-btn">
                                       <p class="abb"><a href="#collapse222" id="2" class="toggle panel2">ADD</a></p>
                                    </div>
                                 </div>
                              </div>
                        </div>
                        
                        
                        
                        
                        
                       <div class="details2">
                              <div class="col-sm-6">
                                 <div class="sub-details1">
                                    <ul class="inner-content">
                                       <li class="bluebg"><img src="{{ asset ('assets/images/img4.png') }}"/></li>
                                       <li>
                                          <p class="blue-para">Location</p>
                                          <p class="grey-para">Adding a summary is a quick and easy way to highlight your experience and interests.</p>
                                       </li>
                                    </ul>
                                    <div class="add-btn">
                                       <p class="abb"><a href="#collapse21" id="3" class="toggle panel3">ADD</a></p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="sub-details1">
                                    <ul class="inner-content">
                                       <li class="bluebg"><img src="{{ asset ('assets/images/img7.png') }}"/></li>
                                       <li>
                                          <p class="blue-para">Professional Information</p>
                                          <p class="grey-para">Adding a summary is a quick and easy way to highlight your experience and interests.</p>
                                       </li>
                                    </ul>
                                    <div class="add-btn">
                                       <p class="abb"><a href="#collapse23" id="4" class="toggle panel4">ADD</a></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        
                        
                        
                        
                        
                        
                        
                      <div class="details2">
                              <div class="col-sm-6">
                                 <div class="sub-details1">
                                    <ul class="inner-content">
                                       <li class="bluebg"><img src="{{ asset ('assets/images/img1.png') }}"/></li>
                                       <li>
                                          <p class="blue-para">Family Details</p>
                                          <p class="grey-para">Adding a summary is a quick and easy way to highlight your experience and interests.</p>
                                       </li>
                                    </ul>
                                    <div class="add-btn">
                                       <p class="abb"><a href="#collapse24" id="5" class="toggle panel5">ADD</a></p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="sub-details1">
                                    <ul class="inner-content">
                                       <li class="bluebg"><img src="{{ asset ('assets/images/img5.png') }}"/></li>
                                       <li>
                                          <p class="blue-para">About My Family</p>
                                          <p class="grey-para">Adding a summary is a quick and easy way to highlight your experience and interests.</p>
                                       </li>
                                    </ul>
                                    <div class="add-btn">
                                       <p class="abb"><a href="#collapse25" id="6" class="toggle panel6">ADD</a></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        
                        
                       <div class="down-part down1 pdng25">
                              <div id="collapse22" style="display:none">
                                 <p>
                                 <h3 class="head-form">Basic Details</h3>
                                 <form class="form-class"  id="basic_details">
								 <div class="row">
                                    <div class="col-lg-6">
                                       <input name="name" style="margin-top: 10px;" type="text" class="field m-b0" id="name12" placeholder="Name" required>  
                                    </div>
                                    <div class="col-lg-6">
                                       <select name="body_type"  type="text" class="field test_class" id="body_type" placeholder="Body Type" >
                                          <option	value="">Body Type</option>
                                          <option	value="">--select--</option>
                                          <option	value="Slim">Slim</option>
                                          <option	value="Athletic">Athletic</option>
                                          <option	value="Average">Average</option>
                                          <option	value="Heavy">Heavy</option>
                                       </select>
                                    </div>
									</div>
									 <div class="row">
                                    <div class="col-lg-6">
                                       <select name="complexion" type="text" class="field test_class" id="complexion" placeholder="Complexion" >
                                          <option value="">Complexion</option>
                                          <option	value="">--select--</option>
                                          <option	value="Very Fair">Very Fair</option>
                                          <option	value="Fair">Fair</option>
                                          <option	value="Wheatish">Wheatish</option>
                                          <option	value="Wheatish Brown">Wheatish Brown</option>
                                          <option	value="Dark">Dark</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="height" type="text" class="field test_class" id="height" placeholder="Height" >
                                          <option value="">Height</option>
                                          <option	value="">--select--</option>
                                           <?php for($i=135;$i<211;$i++)
                                             { echo '<option	value='.$i.'> '.$i.'</option>';}?>
                                       </select>
                                    </div>
									</div>
									 <div class="row">
                                    <div class="col-lg-6">
                                       <Select name="physical_status" type="text" class="field test_class" id="physical_status" placeholder="Physical Status" >
                                          <option value="">Physical Status</option>
                                          <option	value="">--select--</option>
                                          <option	value="Normal">Normal</option>
                                          <option	value="Handicapped">Handicapped</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="weight" type="text" class="field test_class" id="weight" placeholder="Weight" >
                                          <option value="">Weight</option>
                                          <option	value="">--select--</option>
                                          	 <?php for($j=35;$j<161;$j++)
                                             { echo '<option	value='.$j.'> '.$j.'</option>';}?>
                                       </select>
                                    </div>
									</div>
									 <div class="row">
                                    <div class="col-lg-6">
                                       <Select name="marital_status" type="text" class="field test_class" id="marital_status" placeholder="Marital Status" >
                                           <option	value="">Marital Status</option>
                                          <option	value="">--select--</option>
                                          <option value="Never Married">Never Married</option>
                                          <option	value="Widower">Widower</option>
                                          <option	value="Divorced">Divorced</option>
                                          <option	value="Awaiting divorce">Awaiting divorce</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="eating_habits" type="text" class="field test_class" id="eating_habits" placeholder="Eating Habits" >
                                          <option	value="">Eating Habits</option>
                                          <option	value="">--select--</option>
                                          <option value="Vegetarian">Vegetarian</option>
                                          <option	value="Non Vegetarian">Non Vegetarian</option>
                                          <option	value="Eggetarian">Eggetarian</option>
                                       </Select>
                                    </div>
									</div>
									 <div class="row">
                                    <div class="col-lg-6">
                                       <Select name="drinking_habit" type="text" class="field test_class" id="drinking_habit" placeholder="Drinking Habit" >
                                          <option	value="">Drinking Habit</option>
                                          <option	value="">--select--</option>
                                          <option value="No">No</option>
                                          <option	value="Occasionally">Drinks Socially</option>
                                          <option	value="Yes">Yes</option>
                                       </Select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="smoking_habits" type="text" class="field test_class" id="smoking_habits" placeholder="Smoking Habitsv" >
                                          <option	value="">Smoking Habits</option>
                                          <option	value="">--select--</option>
                                          <option value="No">No</option>
                                          <option	value="Occasionally">Occasionally</option>
                                          <option	value="Yes">Yes</option>
                                       </select>
                                    </div>
									</div>
									 <div class="row">
                                    <div class="col-lg-12 align-right" style="padding-right:10px;">
                                       <input type="submit" id="basic" class="submit but_ins" title="1" value="Save">
                                    </div>
									</div>
                                     
                                 </form>
                                  
                                 </p>
                              </div>
                           </div>
                          
                           <div class="down-part down2 pdng25">
                              <div id="collapse222" style="display:none">
                                 <p>
                                 <h3 class="head-form">Religious Information</h3>
                                 <form class="form-class"  id="religious_info">
								 <div class="row">
                                    <div class="col-lg-6">
                                       <Select class="field others test_class" name="religion" id="ri" required>
                                          <option value="">Religion</option>
                                          <?php
                                             foreach($get_rel as $getrel){
                                               ?>
                                           
                                          <option value="<?php echo $getrel->religion_id; ?>"><?php echo $getrel->religion; ?></option>
                                          <?php 
                                             }  ?>
                                          <option value="other_religion" >Others</option>
                                       </select>
                                       <input type="text" id="religion" class="rel_other other_lable einput" name="other_religion">
                                    </div>
                                    <div class="col-lg-6">
                                       	 <img src="{{asset('assets/images/loading3.gif')}}" class='loader'>
                                      
                                       <Select class="field Other user_caste test_class" name="caste" id="ce" required>
                                          <option value="">Caste</option>
                                         
                                          <option value="other_caste">Others</option>
                                       </select>
                                       <input type="text" id="otrs" class="user_othercaste other_lable einput" name="other_caste">
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <Select class="field other_star test_class" name="star" id="str">
                                          <option value="">Star</option>
                                         <?php
                                             foreach($get_strmon as $getstrmon){
                                               ?>	
                                          <option value="<?php echo $getstrmon->star_id; ?>"><?php echo $getstrmon->star; ?></option>
                                          <?php 
                                             }  ?>
                                         <!-- <option value="other_star">Others</option>-->
                                       </select>
                                      <!-- <input type="text" class="o_star other_lable" name="other_star">-->
                                    </div>
                                    <div class="col-lg-6">
                                      <img src="{{asset('assets/images/loading3.gif')}}" class='loader2'>	
                                       <Select class="field other_moonsign user_rassi test_class" name="rassi_moonsign" id="rms">
                                          <option value="">Raasi MoonSign</option>
                                         <!-- <option value="other_moonsign">Others</option>-->
                                       </select>
                                       <input type="text" class="user_moonsign other_lable" name="other_moonsign">
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <Select class="field other_Zodiac test_class" name="zodiac_starsign" id="zss">
                                          <option value="">Zodiac Starsign</option>
                                          <?php
                                             foreach($zodiac_sign as $zodiacsign){
                                               ?>	
                            <option value="<?php echo $zodiacsign->zodiac_starsign_id; ?>"><?php echo $zodiacsign->zodiac_starsign; ?></option>
                                          <?php 
                                             }  ?>	
                                       <!--   <option value="other_Zodiac">Others</option>-->
                                       </select>
                                       <input type="text" class="user_zodiac other_lable" name="other_Zodiac">  								
                                    </div>
									 <div class="col-lg-6">
									 </div>
									</div>
									<div class="row">
                                    <div class="col-lg-12 align-right" style="padding-right:10px;">
                                      <input type="submit" id="religious" class="submit but_ins" title="2" value="Save">
                                    </div>
									</div>
								
                                    
                                   					 
                                       
                                   
                                 </form>
                                 </p>    
                              </div>
                           </div>
                           <div class="down-part down3 pdng25">
                              <div id="collapse21" style="display:none">
                                 <p>
                                 <h3 class="head-form">Location</h3>
                                 <form class="form-class"  id="loc">
								 <div class="row">
                                    <div class="col-lg-6">
                                       <Select class="field other_country_livingin test_class" name="country_livingin" id="country_liv" required>
                                          <option value="">Country</option>
                                         <?php
                                             foreach($get_count as $getcount){
                                              ?>
                                          <option value="<?php echo $getcount->country_id; ?>"><?php echo $getcount->country; ?></option>
                                          <?php
                                             }
                                             ?>
                                         <!-- <option value="other_country_livingin">Other</option>-->
                                       </select>
                                     <!--  <input type="text" name="other_country_livingin" class="cntry other_lable">-->
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{asset('assets/images/loading3.gif')}}" class='loader_state'>
                                       <Select class="field other_residing_state user_state test_class" name="state" id="rstate" required>
                                          <option value="">State</option>
                                        <!--  <option value="other_residing_state">other</option>-->
                                       </select>
                                       <!--<input type="text" name="other_residing_state" class="user_rstate other_lable">	-->	
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       
                                       <Select class="field other_residing_city user_district test_class" name="district" id="rc" required>
                                          <option value="">District</option>
                                         <!-- <option value="other_residing_city">Other</option>-->
                                       </select>
                                      <!-- <input type="text" name="other_residing_city" class="user_city other_lable">-->
                                    </div>
                                    <div class="col-lg-6">
                                       <Select class="field drop-down-arw mt-5" name="mother_tongue"  class="field test_class" id="mother_tongue" required>
                                          <option	value="">Mother Tongue</option>
                                           <?php
                                             foreach($get_mothton as $getmothton){
                                             ?>
                                          <option value="<?php echo $getmothton->mother_tongue_id; ?>"><?php echo $getmothton->mother_tongue; ?></option>
                                          <?php
                                             }
                                             ?>
                                       </select>
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-12 align-right">      
                                       <input type="submit" id="locatn" class="submit but_ins" title="3" value="Save">  
                                    </div>
									</div>
                                 </form>
                                 </p>
                              </div>
                           </div>
                           <div class="down-part down4 pdng25">
                              <div id="collapse23" style="display:none">
                                 <p>
                                 <h3 class="head-form">Professional Information</h3>
                                 <form class="form-class"  id="prf_inf">
								 <div class="row">
                                    <div class="col-lg-6">
                                       <Select class="field other_education test_class" name="education" id="hed" required>
                                          <option value="">Education</option>
                                          <?php
                                             foreach($get_educa as $geteduca){
                                             ?>
                                          <option value="<?php echo $geteduca->education_id; ?>"><?php echo $geteduca->education; ?></option>
                                          <?php
                                             }
                                             ?>  
                                        
                                       </select>
                                       <input type="text" name="other_education" class="user_edu other_lable">      
                                    </div>
                                    <div class="col-lg-6">
                                       <Select class="field other_occupation test_class" name="occupation" id="occ" required>
                                          <option	value="">Occupation</option>
                                           <?php
                                             foreach($get_occupa as $getoccupa){
                                             ?>
                                          <option value="<?php echo $getoccupa->education_id; ?>"><?php echo $getoccupa->occupation; ?></option>
                                          <?php
                                             }
                                             ?>  
                                           
                                         
                                       </select>
                                       <input type="text" name="other_occupation" class="user_occu other_lable">      						
                                    </div>
									</div>
									<div class="row">
                                   
                                    <div class="col-lg-6">
                                       <Select name="employedin" type="text" class="field test_class" id="empi" placeholder="Employed in" >
                                          <option	value="">Employed in :</option>
                                          <option	value="">--select--</option>
                                          <option	value="Government">Government</option>
                                          <option	value="Private">Private</option>
                                          <option	value="Business">Business</option>
                                          <option	value="Defence">Defence</option>
                                          <option	value="Self Employed">Self Employed</option>
                                       <select>
                                    </div>
                                    <div class="col-lg-6">
                                    <Select name="annual_income" type="text" class="field test_class" id="auli" placeholder="Income" >
                                    <option	value="">Income(/Monthly)</option>
                                    <option	value="">--select--</option>
                                  
                                     <option  value="below">Below 8000/-</option>                                        
                                         
                                        <option  value="below 100000">Below 1,00,000/-</option>                                        
                                        <option value="100000-200000">1,00,000-2,00,000/-</option>
                                         
                                         <option value="above 200000">2,00,000 above</option>
                                    </select>				
                                    </div>
									</div>
									<div class="row">
                                     <div class="col-lg-6">
                                       <input name="college" type="text" class="field m-b0" id="Clg" placeholder="College Institution" >
                                    </div>
                                    <div class="col-lg-6">
                                       <input name="education_in_detail" type="text" class="field m-b0" id="education_in_detail" placeholder="Education in Detail">
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <input name="occupation_in_detail" type="text" class="field m-b0" id="occupation_in_detail" placeholder="Occupation in Detail" >
                                    </div>
									 <div class="col-lg-6">
									 </div>
									</div>
									<div class="row">
                                    <div class="col-lg-12 align-right">
                                       <input class="subbtn" type="submit" id="regg3" class="submit but_ins" title="4" value="Save">
                                    </div>
									</div>
                                 </form>
                                 </p>
                              </div>
                           </div>
                           <div class="down-part down5 pdng25">
                              <div id="collapse24" style="display:none">
                                 <p>
                                 <h3 class="head-form">Family Details</h3>
                                 <form class="form-class"  id="family_details">
								 <div class="row">
                                    <div class="col-lg-6">
                                       <input name="fathers_status" type="text" class="field m-b0" id="FathersStatus1" placeholder="Father's Status" >
                                    </div>
                                    <div class="col-lg-6">
                                       <input name="mothers_status" type="text" class="field m-b0" id="MothersStatus" placeholder="Mother's Status" >
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <Select name="family_values" type="text" id="family_values" class="field test_class" placeholder="family_values" required>
                                          <option	value="">Family Value </option>
                                          <option	value="">--select--</option>
                                          <option	value="Orthodox">Orthodox</option>
                                          <option	value="Traditional">Traditional</option>
                                          <option	value="Moderate">Moderate</option>
                                          <option	value="Liberal">Liberal</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="family_type" type="text" id="family_type" class="field test_class" placeholder="Family Type" required>
                                          <option	value="">Family Type </option>
                                          <option	value="">--select--</option>
                                          <option	value="Joint Family">Joint Family</option>
                                          <option	value="Nuclear Family">Nuclear Family</option>
                                          <option	value="Others">Others</option>
                                       </select>
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <Select name="familystatus" type="text" id="familystatus" class="field test_class" placeholder="Family Status" >
                                          <option	value="">Family Status </option>
                                          <option	value="">--select--</option>
                                          <option	value="Middle Class">Middle Class</option>
                                          <option	value="Upper Middle Class">Upper Middle Class</option>
                                          <option	value="Rich">Rich</option>
                                          <option	value="Affluent">Affluent</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="no_of_brothers" id="NfBs1" class="field test_class" >
                                          <option	value="">No Of Brothers</option>
                                          <option	value="None">None</option>
                                          <option	value="1">1</option>
                                          <option	value="2">2</option>
                                          <option	value="3">3</option>
                                          <option	value="4">4</option>
                                          <option	value="5">5</option>
                                          <option	value="other">Other</option>
                                       </select>
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <Select name="brothers_married" id="BrsM" class="field drop-down-arw mt-5 ">
                                          <option	value="">Brothers Married</option>
                                          <option	value="None">None</option>
                                          <option	value="1">1</option>
                                          <option	value="2">2</option>
                                          <option	value="3">3</option>
                                          <option	value="4">4</option>
                                          <option	value="5">5</option>
                                          <option	value="other">Other</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <Select name="no_of_sisters" id="NoS" class="field test_class">
                                          <option	value="">No Of Sisters</option>
                                          <option	value="None">None</option>
                                          <option	value="1">1</option>
                                          <option	value="2">2</option>
                                          <option	value="3">3</option>
                                          <option	value="4">4</option>
                                          <option	value="5">5</option>
                                          <option	value="other">Other</option>
                                       </select>
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-lg-6">
                                       <Select name="sisters_married" id="SiM" class="field drop-down-arw mt-5 ">
                                          <option	value="">Sisters Married</option>
                                          <option	value="None">None</option>
                                          <option	value="1">1</option>
                                          <option	value="2">2</option>
                                          <option	value="3">3</option>
                                          <option	value="4">4</option>
                                          <option	value="5">5</option>
                                          <option	value="other">Other</option>
                                       </select>
                                    </div>
									<div class="col-lg-6">
									</div>
									</div>
									<div class="row">
                                    <div class="col-lg-12 align-right">
                                       <input type="submit" id="regg4" class="submit but_ins" title="5" value="Save">
                                    </div>
									</div>
                                 </form>
                                 </p>
                              </div>
                           </div>
                           <div class="down-part down6 pdng25">
                              <div id="collapse25" style="display:none">
                                 <p>
                                 <form class="form-class"  id="abt_family">
                                    <h3 class="head-form">About My Family</h3>
									<div class="row">
									<div class="col-lg-12">
                                    <textarea class="textarea1" name="about_my_family" id="about_my_family" class="words" rows="5" cols="40"></textarea>
                                    <br>
                                    <div class="down-part down12 align-right" style="padding-right:15px;">
                                       <input type="submit" id="regg5" class="submit but_ins" title="6" value="submit">
                                    </div>
									</div>
									</div>
                                 </form>
                                 </p>
                              </div>
                           </div>
                        
                        <div class="linktonext">
                              <!--<a class="linktonext " href="{{ URL::to('user/profileview') }}">Next</a>-->
                           </div>
                <div class="loader1" >
                 <img src="{{asset('assets/images/ajax-loader.gif')}}" />
                 </div>
                 <div class="msg"></div>
             
                         
                        
                        </div>
                       
                      </div>
                        
                    <div class="col-lg-3">
                     <div class="right-part">
					  <div class="right-part1">
                    	<h2 class="head-name2">Daily Recommendations</h2>
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
                              <li class="imagerd"><?php if($img_status=='0')
                                 {?>
                                 <img  src="{{asset('assets/images/default_profile.jpg')}}">
                                 <?php } else
                                    {
                                    	?>
                                 <img  src="{{asset($data->path)}}">
                                 <?php } ?>
                              </li>
                              <li>
                                 <p class="pink-name" style="text-transform: capitalize;"><?php echo $data->name; ?></p>
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

 <link href="{{ asset ('assets/css/select2.min.css') }}" rel="stylesheet" />
 <script src="{{ asset ('assets/js/select2.min.js') }}"></script>
<script src="{{asset('assets/js/profilestrength/raphael-min.js')}}"></script>
<script src="{{ asset('assets/js/profilestrength/jQuery.circleProgressBar.js') }}"></script>
<script src="{{ asset('assets/js/imageupload/jquery.Jcrop.min.js') }}"></script>
<script src="{{ asset('assets/js/imageupload/script.js') }}"></script>

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
		
		
        $(document).ready(function() {
			$('.test_class').select2();
         $('p1').click(function(){
              $('.down-part').toggle(); 
          
});    
        });  
     
        $(document).ready(function() {
			 
						  $('#religion').hide();
			 
			                $(".others").change(function () {
				                   var others = $(".others").val();
                                   if(others == 'other_religion'){
                          $('#religion').show();
                              }else{
				          $('#religion').hide(); 
						 
			                       }
                          });
						  
						  $('#otrs').hide();
			 
			                $(".Other").change(function(){
				                   var Other = $(".Other").val();
                                   if(Other == 'other_caste'){
                          $('#otrs').show();
                              }else{
				          $('#otrs').hide(); 
						  
			                       }
                          });
						  
						 
						  
						  $('.o_star').hide();
			 
			                $(".other_star").change(function () {
				                   var other_star = $(".other_star").val();
                                   if( other_star == 'other_star'){
                          $('.o_star').show();
                              }else{
				          $('.o_star').hide(); 
						 
			                       }
                          });
						  
						  
						  
						  $('.user_moonsign').hide();
			 
			                $(".other_moonsign").change(function () {
				                   var other_moonsign = $(".other_moonsign").val();
                                   if( other_moonsign == 'other_moonsign'){
                          $('.user_moonsign').show();
                              }else{
				          $('.user_moonsign').hide(); 
						 
			                       }
                          });
						  
						  
						  $('.user_zodiac').hide();
			 
			                $(".other_Zodiac").change(function () {
				                   var other_Zodiac = $(".other_Zodiac").val();
                                   if( other_Zodiac == 'other_Zodiac'){
                          $('.user_zodiac').show();
                              }else{
				          $('.user_zodiac').hide(); 
						
			                       }
                          });
						  
						  
/////////////////////////////////////Location////////////////////////////////////////////////	
                             $('.cntry').hide();					    
							$(".other_country_livingin").change(function(){
								  var other_country_livingin = $(".other_country_livingin").val();
								  if(other_country_livingin == 'other_country_livingin'){
						   $('.cntry').show();
								  }else{
						   $('.cntry').hide();
                          						   
								  }						   
								});  
								
								
								$('.user_reg6').hide();
								$(".other_citizenship").change(function(){
								  var other_citizenship = $(".other_citizenship").val();
								  if(other_citizenship == 'other_citizenship'){
						   $('.user_reg6').show();
								  }else{
						   $('.user_reg6').hide();
                         						   
								  }						   
								});  
								
								
						  $('.user_rstate').hide();
								$(".other_residing_state").change(function(){
								  var other_residing_state = $(".other_residing_state").val();
								  if(other_residing_state == 'other_residing_state'){
						   $('.user_rstate').show();
								  }else{
						   $('.user_rstate').hide();
                         					   
								  }						   
								});  
								
								$('.user_city').hide();
								$(".other_residing_city").change(function(){
								  var other_residing_city = $(".other_residing_city").val();
								  if(other_residing_city == 'other_residing_city'){
						   $('.user_city').show();
								  }else{
						   $('.user_city').hide();
                          					   
								  }						   
								}); 
								
////////////////////////////////////////professional information///////////////////////////////////								
								$('.user_edu').hide();
								$(".other_education").change(function(){
								  var other_education = $(".other_education").val();
								  if(other_education == 'other_education'){
						   $('.user_edu').show();
								  }else{
						   $('.user_edu').hide();
                     						   
								  }						   
								}); 
								
								
								$('.user_occu').hide();
								$(".other_occupation").change(function(){
								  var other_occupation = $(".other_occupation").val();
								  if(other_occupation == 'other_occupation'){
						   $('.user_occu').show();
								  }else{
						   $('.user_occu').hide();
                         					   
								  }						   
								}); 
								
								$('.user_reg11').hide();
								$(".Occu_pation").change(function(){
								  var Occu_pation = $(".Occu_pation").val();
								  if(Occu_pation == 'Occu_pation'){
						   $('.user_reg11').show();
								  }else{
						   $('.user_reg11').hide();
                          					   
								  }						   
								}); 
								
								
	$('.loginlink').click(function(){

			    $('.image_class')[0].click();
			  
			 });  						
						  
///////////////////////////////////////ADD*ADD//////////////////////////////////////////////					  
						  
	         $('.toggle').click(function(){
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');                    

            //make the collapse content to be shown or hide
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function(){
              if($(this).css('display')=='none'){
                               //change the button label to be 'Show'
                toggle_switch.html('ADD');
				
              }else{
                               //change the button label to be 'Hide'
                toggle_switch.html('ADD');
				
              }
            });
          });
	

       //  });  
    
    
     setInterval(function(){
    var $sample = $(".paraloginlink");
    var $sample1 = $(".loginlink");
    if($sample.is(":hover")) {
       $sample.css("background", "");
	   $sample1.css("display", "block");
    }
    else {
       $sample.css("background", "transparent");
	   $sample1.css("display", "none");
    }
 }, 200);
         });  


  </script>

 <script>
 /***************************Basic Details**********************************/	                
       $(document).ready(function(){


      jQuery.validator.addMethod("accept", function(value, element, param) {
  return value.match(new RegExp("." + param + "$"));
});
      jQuery.extend(jQuery.validator.messages, {
        accept: "Please enter a name ."

        });
							
				 //$('.loader1').hide();   
																	  
            $("#basic").click(function(){
               
                 $('#basic_details').validate({
                rules: {
              name: {
             minlength: 2,
             maxlength: 15,
             accept: "[a-zA-Z]+"
                },    
              body_type:{required: true ,},
		      complexion:{required: true ,},
			  height:{required: true ,},
		      physical_status:{required: true ,},
			  weight:{required: true ,},
			  marital_status:{required: true ,},
			  eating_habits:{required: true ,},
			 drinking_habit:{required: true ,},
			  smoking_habits:{required: true ,},
             
                         },
                                
         highlight: function(element) {
             $(element).addClass('red');
         },
         unhighlight: function(element) {
             $(element).removeClass('red');
         },
         submitHandler: function(form) {	 		 

                             $('.panel2').click();	
							 $('.down1').hide();
							  
							   $('.loader1').show();	
               var value =$("#basic_details").serialize() ;
							 
  
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/basicdetails') }}",
                                 data: value,
                                 success:function (basicdetails){
                                      $('.loader1').hide();
                                     $(".msg").show();
                                 console.log(basicdetails);
								 
                                          if(basicdetails>1){
                                               
                             $('.percent').html('<p style="display:none;">'+basicdetails+'%</p>');
                             $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	}); 
											 
                 $(".msg").html('<div class="alert alert-success">Successfully Insert Your Basic Details</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                              
								 }											
								 }); 
                                        }	
								});		

               });
          
           ///////////////////////////////////religious information//////////////////////////////////										  
        $("#religious").click(function(){
							

           $('#religious_info').validate({
                rules: {
			    religion: {required: true ,},	
                caste: {required: true ,},
                star: {required: true ,},
				rassi_moonsign: {required: true ,},
				zodiac_starsign: {required: true ,},
               
				 },
                                
         highlight: function(element) {
             $(element).addClass('red');
         },
         unhighlight: function(element) {
             $(element).removeClass('red');
         },
         submitHandler: function(form) {								

							 
                                 $('.panel3').click();	
                                 $('.down2').hide();
							   $('.loader1').show();	
                              var value =$("#religious_info").serialize() ;
                                 
        
                                 $.ajax({
                                 type:'POST',
								                 url: "{{ url('user/religiousinformation') }}",
                                 data: value,
                                 success:function (religious_info){
                                      $('.loader1').hide();
                                     $(".msg").show();
                                 console.log(religious_info);
								
                                             if(religious_info>1){
														 
			                          	
                                                 $('.percent').html('<p style="display:none;">'+religious_info+'%</p>');
        
                                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	}); 
                                                 
                                                 $(".msg").html('<div class="alert alert-success">Successfully Insert Religious Information</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                     } 
                                         }); 
                                        }	
								});		

});									
          
    ///////////////////////////////////////////Other Religion/////////////////////////////////////////////										  
							     $("#regg6").click(function(){
							   
                                 var value =$(".rel_other").serialize();
                                
                                 $.ajax({
                                 type:'POST',
								                 url: "{{ url('user/otherreligion') }}",
                                 data: value,
                                 success:function (other_rel){
                                 console.log(other_rel);
								 
                                                     if(other_rel>1)
                                                     {
                                                          $('.percent').html('<p style="display:none;">'+other_rel+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                      
                                                //   $(".msg").html('<div class="alert alert-success">Loaded Successfully</div>');	
                                      //  setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                      //  $(".msg").html('<div class="alert alert-danger">error</div>');
                                   // setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                    } 
                                             }); 
									     });
           
           //////////display caste///////////////////////////
         
	 $('.loader').hide();	
	 $("#ri").on('change', function() {
		 $('.loader').show();
	
	  var value=$(this).val();
	 
       $.ajax({
         type: "GET",
         url: "{{ url('user/updatecaste') }}",
         data:{rel_val:value},
		
		 success:function (return_religion){
              $('.loader').hide();
              $(".msg").show();
 		 console.log(return_religion);
                
             if(return_religion!=0)
             {

                 $(".user_caste").html(return_religion);
                 }
             else
               {
            $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
			 	
                }
                                        }
       
        });  
	 });
     
           ///////////////////////////////////////////Other Caste/////////////////////////////////////////////										 
								 $("#regg6").click(function(){
							   
                                 var value =$(".user_othercaste").serialize();
                                
        
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/othercaste') }}",
                                 data: value,
                                 success:function (caste_othr){
                                 console.log(caste_othr);
								
                                                     if(caste_othr>1){
                                                         $('.percent').html('<p style="display:none;">'+caste_othr+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                     
                                                   $(".msg").html('<div class="alert alert-success">Loaded Successfully</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                    } 
                                             }); 
									     });	
           
           ///////////////////////////////////////////other Star/////////////////////////////////////////////										 
								 $("#regg6").click(function(){
							   
                                 var value =$(".o_star").serialize();
                                 
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/otherstar') }}",
                                 data: value,
                                 success:function (star){
                                 console.log(star);
								
                                                     if(star>1){
                                                          $('.percent').html('<p style="display:none;">'+star+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                  
                                                  $(".msg").html('success');
												 
                                                    }
                                                         else
													   
													{
                                                          $(".msg").html('error');
                                                    }
                                                    } 
                                             }); 
									     });
           ///////////////////////////////////////////Other Moonsign/////////////////////////////////////////////										 
								 $("#regg6").click(function(){
							   
                                 var value =$(".user_moonsign").serialize();
                                
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/othermoonsign') }}",
                                 data: value,
                                 success:function (moonsign){
                                 console.log(moonsign);
								
                                                     if(moonsign>1){
                                                         
                                                          $('.percent').html('<p style="display:none;">'+moonsign+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                
                                                  $(".msg").html('success');
												
                                                    }
                                                         else
													    
													{
                                                          $(".msg").html('error');
                                                    }
                                                    } 
                                             }); 
									     });	
            ///////////////////////////////////////////Other Zodiac/////////////////////////////////////////////										 
								 $("#regg6").click(function(){
							   
                                 var value =$(".user_zodiac").serialize();
                                 //alert(value);
        
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/otherzodiac') }}",
                                 data: value,
                                 success:function (otherzodiac){
                                 console.log(otherzodiac);
								 //location.reload();
                                                     if(otherzodiac>1){
                                                          $('.percent').html('<p style="display:none;">'+otherzodiac+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                  
                                                  $(".msg").html('success');
												
                                                    }
                                                         else
													
													{
                                                          $(".msg").html('error');
                                                    }
                                                    } 
                                             }); 
									     });
           //////////////////////////////////////////Location/////////////////////////////////////////////////										  
								 
                              	 
                        $("#locatn").click(function(){
         			$('#loc').validate({
                rules: {
			     country_livingin: {required: true ,},	
                state: {required: true ,},
                 district: {required: true ,},
				 mother_tongue: {required: true ,},
				
				 },
                                
         highlight: function(element) {
             $(element).addClass('red');
         },
         unhighlight: function(element) {
             $(element).removeClass('red');
         },
         submitHandler: function(form) {
         			
         		
         			
                            $('.panel4').click();	
                            $('.down3').hide();
             
                    var value =$("#loc").serialize() ;
                                         
                     //alert(value);
                                         $.ajax({
                                         type:'POST',
         							     url: "{{ url('user/location') }}",
                                         data: value,
                                         success:function (location){
                                        $('.loader1').hide();
                                        $(".msg").show();  
                                         console.log(location);
         							 
                                             if(location>1){
         											
                                                  $('.percent').html('<p style="display:none;">'+location+'%</p>');
                                    $('.percent').percentageLoader({
         	valElement: 'p',
         	strokeWidth: 30,
         	bgColor: '#d9d9d9',
         	ringColor: '#75d2e4',
         	textColor: '#2C3E50',
         	fontSize: '14px',
         	fontWeight: 'normal'
         }); 							
         	                                     $(".msg").html('<div class="alert alert-success">Successfully Insert Location Details</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                             } 
                                                          }); 
                                        }	
								});		

});	
           ////////////////////////////////////Other Country Living/////////////////////////////////////////////										  
								$("#regg6").click(function(){
							   
                                 var value =$(".cntry").serialize();
                                
    
                                 $.ajax({
                                 type:'get',
								 url: "{{ url('user/country') }}",
                                 data: value,
                                 success:function (country){
                                     $(".msg").show();
                                 console.log(country);
								
                                                     if(country>1)
                                                     {
			                                 
                                                         $('.percent').html('<p style="display:none;">'+country+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
                                                 $(".msg").html('<div class="alert alert-success">Loaded Successfully </div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                    } 
                                             }); 
									     });		
							////////////////////////////////////Resident state/////////////////////////////////////////////										  
								$("#regg6").click(function(){
							   
                                 var value =$(".user_rstate").serialize();
                               
        
                                 $.ajax({
                                 type:'POST',
								                 url: "{{ url('user/state') }}",
                                 data: value,
                                 success:function (state){
                                     $(".msg").show();
                                 console.log(state);
								
                                                     if(state>1){
			                                  
                                                         $('.percent').html('<p style="display:none;">'+state+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
                                                 $(".msg").html('<div class="alert alert-success">Loaded Successfully </div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                    } 
                                             }); 
									     });
           ////////////////////////////////////Other_Residing_City	/////////////////////////////////////////////										  
										  $("#regg6").click(function(){
							   
                                 var value =$(".user_city").serialize();
                               
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/city') }}",
                                 data: value,
                                 success:function (city){
                                     $(".msg").show();
                                 console.log(city);
								 
                                            if(city>1){
			                    					 
                                                    $('.percent').html('<p style="display:none;">'+city+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						 
                                                  $(".msg").html('<div class="alert alert-success">Loaded Successfully</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                    } 
                                             }); 
									     });			
								
           										 
///////////////////////////////////Professional Information//////////////////////////////////////////					  
						    $("#regg3").click(function(){
         						 
                           $('#prf_inf').validate({
                           rules: {
                              education: {required: true ,},	
                 college: {required: true ,},
                 education_in_detail: {required: true ,},
				 occupation_in_detail: {required: true ,},
				 employedin: {required: true ,},
				 annual_income: {required: true ,},
				
				 },
                                
         highlight: function(element) {
             $(element).addClass('red');
         },
         unhighlight: function(element) {
             $(element).removeClass('red');
         },
         submitHandler: function(form) {

		 
           
                                      $('.panel5').click();	
         						      $('.down4').hide();
         						   
                                        var value =$("#prf_inf").serialize() ;
                                         
                
                                         $.ajax({
                                         type:'POST',
         							     url: "{{ url('user/professionalinformation') }}",
                                         data: value,
                                         success:function (prf_inf){
                                         $('.loader1').hide();
                                         $(".msg").show();
                                         console.log(prf_inf);
         							
                                                             if(prf_inf>1){
                                                                 $('.percent').html('<p style="display:none;">'+prf_inf+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
         			                             $(".msg").html('<div class="alert alert-success">Successfully Insert Professional Information</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                             } 
                                                 }); 
                                        }	
								});		

});	
          
           ////////////////////////////////////Other_hightest education//////////////////////////////////////////										  
					$("#regg6").click(function(){
							   
                                 var value =$(".user_edu").serialize();
                                
        
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/education') }}",
                                 data: value,
                                 success:function (education){
                                 console.log(education);
								
                                                     if(education>1){
                                                         
                                                         
                                                          $('.percent').html('<p style="display:none;">'+education+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                    
                                                  $(".msg").html('success');
												
                                                    }
                                                         else
													   
													{
                                                          $(".msg").html('error');
                                                    }
                                                    } 
                                             }); 
									     });
           ////////////////////////////////////other_Occupation//////////////////////////////////////////										  
					$("#regg6").click(function(){
							   
                                 var value =$(".user_occu").serialize();
                              
                                 $.ajax({
                                 type:'POST',
								 url: "{{ url('user/occupation') }}",
                                 data: value,
                                 success:function (occu){
                                 $(".msg").show();
                                 console.log(occu);
							
                                                     if(occu>1){
                                                         
                                                          $('.percent').html('<p style="display:none;">'+occu+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
			                                 
                                                  $(".msg").html('<div class="alert alert-success">Successfully Insert </div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                    } 
                                             }); 
									     });	
					
           ////////////////////////////////////Family Details/////////////////////////////////////////////										  
							 $("#regg4").click(function(){
         		
                            $('#family_details').validate({
                           rules: {
			    
                fathers_status: {
             minlength: 2,
             maxlength: 15,
             accept: "[a-zA-Z]+"
                },  	
                 mothers_status: {
             minlength: 2,
             maxlength: 15,
             accept: "[a-zA-Z]+"
                },  
                 family_values: {required: true ,},
				 family_type: {required: true ,},
				 familystatus: {required: true ,},
				 brothers_married:{required:true,},
                no_of_sisters:{required:true,},
                sisters_married:{required:true,},
				 },
                                
         highlight: function(element) {
             $(element).addClass('red');
         },
         unhighlight: function(element) {
             $(element).removeClass('red');
         },
         submitHandler: function(form) {

		 
         		
                                      $('.panel6').click();	
         						      $('.down5').hide();
         						   
                                        var value =$("#family_details").serialize();
                
                                         $.ajax({
                                         type:'POST',
         							     url: "{{ url('user/familydetails') }}",
                                         data: value,
                                         success:function (family_details){
                                              $('.loader1').hide();
                                              $(".msg").show();
                                         console.log(family_details);
         							
                                                             if(family_details>1){
                                                                 
                                                                 
                                                                 
                                 $('.percent').html('<p style="display:none;">'+family_details+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
                                  						 
                                                        $(".msg").html('<div class="alert alert-success">Successfully Insert Family Details</div>');	
                                        setTimeout(function(){$(".msg").hide(); }, 3000);	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                             } 
                                                                                           }); 
                                        }	
								});		

});    								
//////////////////////////////////About My Family//////////////////////////////////////////										  
		 $("#regg5").click(function(){
         								 
         		  $('#abt_family').validate({
                           rules: {
			      about_my_family: 
           {
            required: true ,
             minlength: 100,
            maxlength:300
           }, 
				 },
                                
         highlight: function(element) {
             $(element).addClass('red');
         },
         unhighlight: function(element) {
             $(element).removeClass('red');
         },
         submitHandler: function(form) {				 
				


         						   
                                         var value =$("#abt_family").serialize();
                                         
                
                                         $.ajax({
                                         type:'POST',
         							     url: "{{ url('user/aboutmyfamily') }}",
                                         data: value,
                                         success:function (abt_fmly){
                                               $('.loader1').hide();
                                               $(".msg").show();
                                         console.log(abt_fmly);
         							
                                            if(abt_fmly>1){
                                                
                                                          $('.percent').html('<p style="display:none;">'+abt_fmly+'%</p>');
                                 $('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#75d2e4',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	      }); 						
         		                    	
                                                
         											     window.location="{{ url('user/profileview') }}"; 	
												
                                 }
                                else{
                        $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
                                  }
                                                             } 
                                                 }); 
                                        }	
								});		

});  
           
	 $("#country_liv").on('change', function() {
		
	  var value=$(this).val();
	 
       $.ajax({
         type: "GET",
         url: "{{ url('user/updatecountrystate') }}",
         data:{state_val:value},
		 success:function (return_sta){
		$(".msg").show();
		console.log(return_sta);
                                                if(return_sta!=0){
                                                   
                 $(".user_state").html(return_sta);
                                                    }
                                                    else{
                                                   $(".msg").html('<div class="alert alert-danger">error</div>');
                                    setTimeout(function(){$(".msg").hide(); }, 3000);
													 
                                                        }
                                                    }
       
        });  
	 });
	 
	  $('.loader2').hide();
	  $("#str").on('change', function() {
	  $('.loader2').show();
	  var value=$(this).val();
	 
	 
       $.ajax({
         type: "GET",
         url: "{{ url('user/updatemoonsigns') }}",
         data:{moonsign_val:value},
		 success:function (return_moonsign){
              $('.loader2').hide();
		console.log(return_moonsign);
                                               
                if(return_moonsign!=0){
                                           
                 $(".user_rassi").html(return_moonsign);
                                                    }
                                    else{
                                    $(".msg").html('error');
													  	
                                                        }
                                                    }
       
        });  
	 });
	 
       $('.loader_state').hide();
	 $("#rstate").on('change', function() {
     $('.loader_state').show();
	  var value=$(this).val();
	 
	 
       $.ajax({
         type: "GET",
         url: "{{ url('user/districtupdates') }}",
         data:{district_val:value},
		 success:function ($return_distrct){
		$('.loader_state').hide();
		console.log($return_distrct);
                                                if($return_distrct!=0){
                                             
                 $(".user_district").html($return_distrct);
                                                    }
                                                    else{
                                                     $(".msg").html('error');
													  	
                                                        }
                                                    }
       
        });  
	 });
	 

		
         ///////////////image/////////////////  
           
    $('.loginlink').click(function(){

			    $('.image_class')[0].click();
			  
			 });        
				    
       
       
       });	
      $.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
  <script type="text/javascript">
    $(document).ready(function (){
            $("#NoS").change(function() {
          
                // SiM is the id of the other select box 
               
                if ($(this).val() != "None") {
                    $("#SiM").show();
            
                    //$('.sis_m_class').select2();
                }else{
                    $("#SiM").hide();
                    
                } 
            });
        });


</script>
 <script type="text/javascript">
    $(document).ready(function (){

            $("#NfBs1").change(function() {
              //alert("hai");
                // SiM is the id of the other select box 
               var a=$(this).val();
               
                if ($(this).val() != "None") {
                    $("#BrsM").show();
            
                    //$('.sis_m_class').select2();
                }else{
                    $("#BrsM").hide();
                   
                   
                } 
            });
        });


</script>
      
   </body>
</html>

