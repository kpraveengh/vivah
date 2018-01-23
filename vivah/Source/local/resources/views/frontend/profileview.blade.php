 

<?php
  $sess= \Session::get('id');
 $data1 = $results['login'];
  $sess= \Session::get('id');
  $get_religion=\ DB::table('religion')->get();
  $get_star=\ DB::table('star')->get();
  $getzodiac_sign=\ DB::table('zodiac_starsign')->get();
  $get_country=\ DB::table('country')->get();
  $get_mothr_tounge=\ DB::table('mother_tongue')->get();
  $get_education=\ DB::table('education')->get();
   ?>

@include('include.profile_header')

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
                                <?php
								//  $users=$values['user_details'];
								if($users)
								{
								$values=$users[0];
								$dob=$values->dob;
								$birthdate = new DateTime($dob);
								$today   = new DateTime('today');
								$age = $birthdate->diff($today)->y;
								$default_img=$values->path;
								$img_status=$values->img_status;
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
                              <img class='profile-image'  style='width:245px;height:265px;' src='{{asset($values->path)}}'/>  
								<?php
								}
								}
                                ?>
								<p data-toggle="modal" data-target="#myModal" class="paraloginlink">
									<a class="loginlink" href="#">image upload</a>
								</p>
                                <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" >
									<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-body">
													<div class="mybkngwte2">
														<div class="mybkngwte_bg">
                                                <!-- upload form -->	    
														<form id="upload_form" enctype="multipart/form-data" method="post"  onSubmit="return checkForm()" action={{('upload-image-file')}} accept-charset="UTF-8">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                   <!-- hidden crop params -->
														<input type="hidden" id="x1" name="x1" />
														<input type="hidden" id="y1" name="y1" />
														<input type="hidden" id="x2" name="x2" />
														<input type="hidden" id="y2" name="y2" />
														<div>
															<input type="file" name="image_file" class="loginlink image_class" id="image_file" onChange="fileSelectHandler()"/> 
														</div>
                                                  <!-- <div class="errors"></div>-->
														<div class="step2">
															<img id="preview" />
															<div class="info">
																<label class="info1">File size</label> <input type="text" class="info1" id="filesize" name="filesize" />
																<label class="info1">Type</label> <input type="text"  class="info1" id="filetype" name="filetype" />
																<label class="info1">Image dimension</label> <input type="text"  class="info1" id="filedim" name="filedim" />
																<label class="info1">W</label> <input type="text" class="info1" id="w" name="w" />
																<label class="info1">H</label> <input type="text" class="info1" id="h" name="h" />
																<input type="submit" class="img-upload" value="Upload"/>
																<!--<input type="submit" href="{{ URL::to('user/profileview') }}" class="cncelbuton" value="Cancel"/>-->
															</div>
															<div class="error"></div>
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
                            <div class="col-sm-4">
								<div class="details">
									<h2 class="head-name"><span class="blue-name" style="text-transform: capitalize;" id="update_username"><?php  echo $values->name; ?></span><span class="black-code">(<?php  echo $values->rand_id; ?>)</span></h2>
									<p class="para2">Age, Height &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; <?php echo $age; ?>/<?php echo $values->height; ?></p>
									<p class="para2">Religion &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->religion; ?></p>
									<p class="para2">Location &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->state;?>-<?php echo $values->district; ?></p>
									<p class="para2">Education &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->education;?></p>
									<p class="para2">Occupation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $values->occupation;?></p><br>
								</div>
							</div>
							<div class="col-sm-4">
                            	<?php
                            	$paymnt="";
								$payment=\DB::table('user_payment_details')
							              ->where('uid',$sess)->get();
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
                               $socialmedias=\DB::table('user_profile')
                                              ->where('user_id',$sess)
                                              ->get();
                             foreach($socialmedias as $get_social)
                             {
                              $fb=$get_social->facebook;
                              $twitter=$get_social->twitter;
                              $googleplus=$get_social->google_plus;
                              }
                                ?>
                           <ul class="socialmedialink">
                         
                                 <li><button name="text" data-content="" title="" data-toggle="popover1" class="update_username1" type="button" data-original-title="Social Media"></button></li>
                             
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
                          
                           <div class="edit_usernameform1">
                              <form id="register_username1">
                                 <input type="text" class="Social_Media" name="facebook" id="socialmedia_link" placeholder="facebook" /></br>
                                 <input type="text" class="Social_Media" name="twitter" id="socialmedia_link" placeholder="twitter" /></br>
                                 <input type="text" class="Social_Media" name="google plus" id="socialmedia_link" placeholder="google plus" /></br>
                                 <input type="button" id="user_social"  class="socialmedia_user" value="submit"/>
                                 <a class="cncel_buton" href="{{ URL::to('user/profileview') }}">cancel</a>
                              </form>
                           </div>
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
		 
										$profile_values=$profile_str;
										?>
										<p style="display:none;"> <?php echo $profile_values; ?> % </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
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
                          
									<div class="prof-sec ">
										<div class="head-edit">
											<div class="head-icon"><img src="{{ asset('assets/images/img2.png') }}"></div>
											<div class="head-txt"><h2>Basic Details</h2></div>
											<button class="head-edit-icon basic_edit"></button>
										</div>
										<div class="row">
											<div class="col-md-6">
											<ul class="parent-list basicdetails_form">
												<li>
													<ul class="child-list">
														<li class="first">Name</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->name; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Height</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->height; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Weight</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->weight; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Eating Habbit</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->eating_habits; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Smoking Habbit</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->smoking_habits; ?></li>
													</ul>
												</li>
											</ul>


											</div>
											<div class="col-md-6">
												<ul class="parent-list basicdetails_form">
												<li>
													<ul class="child-list">
														<li class="first">Body Type</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->body_type; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Complextion</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->complexion; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Martial Status</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->marital_status; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Physical Staus</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->physical_status; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Drinking Habbit</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->drinking_habit; ?></li>
													</ul>
												</li>
											</ul>


											</div>

										</div>


										<hr class="hbar">
									</div>
									<!--edit basic details -->
									<div class="prof-sec" id="editform" style="display:none">

										<form class="form-class"  id="basicdtls">
              
										<div class="row pdng25">
											<div class="col-md-4">
												Name :<br>
												<input class="einput" type="text" name="name" id="name12" placeholder="Name" value="<?php echo $user->name; ?>">
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_name" onchange="common_value()">
													<option value="1">Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>

											<div class="col-md-4">
												Body Type :<br>
												<Select class="eselect dda" type="text" name="body_type" id="body_type" placeholder="Body Type" required>
												 <option <?php if($user->body_type=='Slim') { echo "selected='selected'"; } ?>>Slim</option>
                                                <option	<?php if($user->body_type=='Athletic') { echo "selected='selected'"; } ?>>Athletic</option>
                                                <option	<?php if($user->body_type=='Average') { echo "selected='selected'"; } ?>>Average</option>
                                                <option	<?php if($user->body_type=='Heavy') { echo "selected='selected'"; } ?>>Heavy</option>
												</Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_body_type" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
										</div>


										<div class="row pdng25">
											<div class="col-md-4">
												Complextion :<br>
												<Select class="eselect dda" name="complexion" id="complexion" >
												<option	<?php if($user->complexion=='Very Fair'){echo "selected='selected'";} ?>>Very Fair</option>
                                                <option	<?php if($user->complexion=='Fair'){echo "selected='selected'";} ?>>Fair</option>
                                                <option	<?php if($user->complexion=='Wheatish'){echo "selected='selected'";} ?>>Wheatish</option>
                                                <option	<?php if($user->complexion=='Wheatish Brown'){echo "selected='selected'";} ?>>Wheatish Brown</option>
                                                <option	<?php if($user->complexion=='Dark'){echo "selected='selected'";} ?>>Dark</option>
												</Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_complexion" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>

											<div class="col-md-4">
												Height :<br>
												<Select class="eselect dda" name="height" id="height">
													<option value="">Height</option>
                                               <?php 
                                               for($i=135;$i<211;$i++)
                                                { 
                                                ?>
                                             <option <?php if($user->height==$i){echo "selected='selected'";} ?>	value='<?php echo $i; ?>'> <?php echo $i; ?></option>
                                             <?php 
                                               } 
                                               ?>		
												</Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_height" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
										</div>


										<div class="row pdng25">
											<div class="col-md-4">
												Physical Status :<br>
												<Select class="eselect dda" name="physical_status" id="physical_status">
													 <option	<?php if($user->physical_status=='Normal'){echo "selected='selected'";} ?>>Normal</option>
                                                <option	<?php if($user->physical_status=='Handicapped'){echo "selected='selected'";} ?>>Handicapped</option>
												</Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_physical_status" onchange="common_value()">
													  <option value="1" >Public</option>
                                                       <option value="0">Private</option>
												</select>
											</div>

											<div class="col-md-4">
												Weight :<br>
												<Select class="eselect dda" type="text">
													 <option value="">Weight</option>
                                                <?php 
                                                for($j=35;$j<161;$j++)
                                                { 
											   ?>
											<option	<?php if($user->weight==$j) {echo "selected='selected'";} ?> value='<?php echo $j ?>'> <?php echo $j; ?></option>
												<?php 
											      } 
											      ?>
												</Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_weight" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>

										<div class="row pdng25">
											<div class="col-md-4">
												Maritial Status :<br>
												<Select class="eselect dda" type="text" name="marital_status" id="marital_status">
												 <option <?php if($user->marital_status=='Never Married'){echo "selected='selected'";}?>>Never Married</option>
                                                <option	<?php if($user->marital_status=='Widower'){echo "selected='selected'";}?>>Widower</option>
                                                <option	<?php if($user->marital_status=='Divorced'){echo "selected='selected'";}?>>Divorced</option>
                                                <option	<?php if($user->marital_status=='Awaiting divorc'){echo "selected='selected'";}?>>Awaiting divorce</option>
                                             </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_marital_status" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>

											<div class="col-md-4">
												Eating Habits :<br>
												<Select class="eselect dda" name="eating_habits" id="eating_habits">

												 <option <?php if($user->eating_habits=='Vegetarian'){echo "selected='selected'";}?>>Vegetarian</option>
                                                <option	<?php if($user->eating_habits=='Non Vegetarian'){echo "selected='selected'";}?>>Non Vegetarian</option>
                                                <option	<?php if($user->eating_habits=='Eggetarian'){echo "selected='selected'";}?>>Eggetarian</option>
                                             </Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_eating_habits" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
										</div>

										<div class="row pdng25">
											<div class="col-md-4">
												Drinking Habbits :<br>
												<Select class="eselect dda" name="drinking_habit">
												 <option <?php if($user->drinking_habit=='No'){echo "selected='selected'";}?>>No</option>
                                                <option	<?php if($user->drinking_habit=='Drinks Socially'){echo "selected='selected'";}?>>Drinks Socially</option>
                                                <option	<?php if($user->drinking_habit=='Yes'){echo "selected='selected'";}?>>Yes</option>
                                             </Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_drinking_habits" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>

											<div class="col-md-4">
												Smoking Habbits :<br>
												<Select class="eselect dda" name="smoking_habits" id="smoking_habits">
												 <option <?php if($user->smoking_habits=='No'){echo "selected='selected'";}?>>No</option>
                                                <option	<?php if($user->smoking_habits=='Occasionally'){echo "selected='selected'";}?>>Occasionally</option>
                                                <option	<?php if($user->smoking_habits=='Yes'){echo "selected='selected'";}?>>Yes</option>
                                             </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_smoking_habits" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<input type="submit" class="sbt-btn" value="Submit" id="basic_details">
											<input type="submit" value="Cancel">
										</div>





										<hr class="hbar">
											</form>
									</div>
							<!--end edit basic details-->

							
									<div class="prof-sec">
										<div class="head-edit">
											<div class="head-icon"><img src="{{ asset('assets/images/img6.png') }}"></div>
											<div class="head-txt"><h2>Religious Information</h2></div>
											<button class="head-edit-icon Religious_Information"></button>
										</div>
										<div class="row">
											<div class="col-md-12">
											<ul class="parent-list religious_info_details">
												<li>
													<ul class="child-list">
														<li class="first">Religion</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php if($user->religion==""){ echo $user->other_religion;}else {echo $user->religion;} ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Caste</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php if($user->caste==""){echo $user->other_caste;}else {echo $user->caste;} ?></li>
													</ul>
												</li>
												<li>
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
												</li>
												<li>
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
												</li>
												<li>
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
												</li>
											</ul>


											</div>
										</div>
										<hr class="hbar">
									</div>

									<!--start edit religious info form-->
									<div class="prof-sec" id="location_hide" style="display:none">
                                      <form class="form-class"  id="loctnform">

										

										<div class="row pdng25">
											<div class="col-md-4">
												Religion :<br>
												<Select class="eselect dda others" name="religion" id="religion_id">
												    <?php
                                            
                                                foreach($get_religion as $getrel)
                                                  {
                                                 $s = '';
					                              if($getrel->religion_id == $user->religion_id) 
					                                 {
						                           $s = "selected";
						                             }
                                                  ?>
                                             <option <?php echo $s; ?> value="<?php echo $getrel->religion_id; ?>"><?php echo $getrel->religion; ?></option>
                                               <?php
                                                  }
                                                ?>			 
                                                <option value="other_religion" >Others</option>
                                             </select>
                                              <input type="text" id="rii" class="user_reg other_lable einput" name="other_religion">
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_religion" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Caste :<br>
												 <img src="{{asset('assets/images/loading3.gif')}}" class='loader'>
												<Select class="eselect dda Other user_caste" name="caste" id="ce">
												<option value="<?php echo $user->caste_id; ?>"><?php echo $user->caste; ?></option>
                                             <option value="other_caste">Others</option>
                                          </select>
                                          <input type="text" id="otrs" class="user_reg1 other_lable einput" name="other_caste">
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_caste" onchange="common_value()">
													       <option value="1" >Public</option>
                                                           <option value="0">Private</option>
												</select>
											</div>
										</div>

										<div class="row pdng25">
											<div class="col-md-4">
												Star :<br>
												<Select class="eselect dda other_star" name="star" id="star_id">
												 <?php
                                            
                                                foreach($get_star as $getstr)
                                                  {
                                                $select = '';
                                                 if($getstr->star_id == $user->star_id) 
                                                    {
                                                $select = "selected";
                                                    }
                                                
                                                  ?>
                                             <option <?php echo $select; ?> value="<?php echo $getstr->star_id; ?>"><?php echo $getstr->star; ?></option>
                                             <?php 
                                                } 
                                                ?>
                                                <option value="other_star">Others</option>
                                                
                                             </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_star" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Raasi :<br>
												<Select class="eselect dda other_moonsign user_rassi" name="rassi_moonsign" id="rms">
												  <option value="<?php echo $user->rassimoonsign_id; ?>"><?php echo $user->rassi_moonsign; ?></option>	
						                          <option value="other_moonsign">Others</option>
                                               </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_rasi" onchange="common_value()">
													  <option value="1" >Public</option>
                                                      <option value="0">Private</option>
												</select>
											</div>
										</div>

										<div class="row pdng25">
											<div class="col-md-4">
												Zodiac :<br>
												<Select class="eselect dda other_Zodiac" name="zodiac_starsign" id="zss">
												<?php
                                           
                                                foreach($getzodiac_sign as $zodiacsign)
                                                {
                                                $select = '';
                                                 if($zodiacsign->zodiac_starsign_id == $user->zodiac_starsign_id)
                                                  {
                                                $select = "selected";
                                                  }
                                                  ?>	
                                             <option <?php echo $select; ?> value="<?php echo $zodiacsign->zodiac_starsign_id; ?>"><?php echo $zodiacsign->zodiac_starsign; ?></option>
                                             <?php 
                                                }  
                                                ?>	 	  
                                              
                                                
                                             </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_zodiac" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">

											</div>

											<div class="col-md-2">

											</div>
										</div>

										<div class="row pdng25">
											<input type="submit" class="sbt-btn" id="regg1" value="submit">
											<input type="submit" value="Cancel">
										</div>


										<hr class="hbar">
									</form>
									</div>
									<!--end rel edit form-->

                               

                                  
									<div class="prof-sec">
										<div class="head-edit">
											<div class="head-icon"><img src="{{ asset('assets/images/img4.png') }}"></div>
											<div class="head-txt"><h2>Location Information</h2></div>
											<button class="head-edit-icon edit_location"></button>
										</div>
										<div class="row">
											<div class="col-md-12">
											<ul class="parent-list location_details">
												<li>
													<ul class="child-list">
														<li class="first">Country</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->country; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Mother Tongue</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->mother_tongue; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Residing State</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->state; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">District</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $trial->district; ?></li>
													</ul>
												</li>
											</ul>
											</div>
										</div>
										<hr class="hbar">
									</div>
                                 <!--start edit location form-->
                                  <form class="form-class"  id="lctndetails-form">
                                 <div class="prof-sec" id="loctn_hide" style="display:none">

                                 	
										
										<div class="row pdng25">
											<div class="col-md-4">
												Country :<br>
												<Select class="eselect dda other_country_livingin test_class" name="country_livingin" id="country_id">
												 <?php
                                                     foreach($get_country as $getcountry)
                                                     {
													 $select = '';
													  if($getcountry->country_id == $user->country_id)
													    {
												      $select = "selected";
													    }
													 ?>
													 
                                             <option <?php echo $select; ?> value="<?php echo $getcountry->country_id; ?>"> <?php echo $getcountry->country; ?></option>
													 <?php 
													  }
													  ?>
                                                
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_country" onchange="common_value()">
												   <option value="1" >Public</option>
                                                   <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Mother Tongue :<br>
												<Select class="eselect dda" name="mother_tongue" id="mother_tongue">
												  <?php
                                                 foreach($get_mothr_tounge as $get_mother_tounge)
                                                     {
													 $s = '';
													 if($get_mother_tounge->id == $user->mother_tongue_id)
													   {
												      $s = "selected";
													   }
                                                  ?>
                                             <option <?php echo $s; ?> value="<?php echo $get_mother_tounge->id; ?>"> <?php echo $get_mother_tounge->mother_tongue; ?></option>
                                             <?php 
                                               } 
                                               ?>
                                             </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_mother_tongue" onchange="common_value()">
													  <option value="1" >Public</option>
                                                      <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<div class="col-md-4">
												Residing State :<br>
												 <img src="{{asset('assets/images/loading3.gif')}}" class='loader_state'>
												<Select class="eselect dda user_state test_class" name="state" id="state_id">
												 <option value="<?php echo $user->state_id; ?>"><?php echo $user->state; ?></option>
                                                </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_state" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												District :<br>
												<Select class="eselect dda user_district test_class" name="district" id="rc">
												   <option value="<?php echo $user->district_id; ?>"><?php echo $user->district; ?></option>
												</Select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_district" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<input type="submit" id="loc_dtls" class="sbt-btn" value="submit">
											<input type="submit" value="Cancel">
										</div>

										<hr class="hbar">

								
									</div>
										</form>

									<!--end edit location form-->

                                


									<div class="prof-sec">
										<div class="head-edit">
											<div class="head-icon"><img src="{{ asset('assets/images/img7.png') }}"></div>
											<div class="head-txt"><h2>Professional Information</h2></div>
											<button class="head-edit-icon edit_professionalinfo"></button>
										</div>
										<div class="row">
											<div class="col-md-12">
											<ul class="parent-list details_professionalinformation">
												<li>
													<ul class="child-list">
														<li class="first">Education</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->education; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">College</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->college; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Education in Detail</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->education_in_detail; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Occupation</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->occupation; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Occupation in Detail</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->occupation_in_detail; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Employed In</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->employedin; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Annuval Income</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->annual_income; ?></li>
													</ul>
												</li>
											</ul>
											</div>
										</div>
										<hr class="hbar">
									</div>
                                    <!--edit professional info form-->
                                     
                                      
									<div class="prof-sec" id="prf_info_hide" style="display:none">
										<form class="form-class"  id="profesional_info_form">
										
										<div class="row pdng25">
											<div class="col-md-4">
												Education :<br>
												<Select class="eselect dda other_education" name="education" id="educationfield_id">
												         <?php
                                                foreach($get_education as $geteduca)
                                                  {
												$select = '';
												if($geteduca->education == $user->education) 
												  {
												$select = "selected";
											       }
												
                                                ?>
                                             <option <?php echo $select; ?> value="<?php echo $geteduca->education_id; ?>"><?php echo $geteduca->education; ?></option>
                                             <?php 
                                                } 
                                                ?>  
                                                <option value="other_education">Other</option>
                                             </select>
                                             <input type="text" name="other_education" class="user_reg9 other_lable">   
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_education" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Occupation :<br>
												<img src="{{asset('assets/images/loading3.gif')}}" class='loader_occupation'>
												<Select class="eselect dda user_occupation" name="occupation" id="occ">
												  <option value="<?php echo $user->occupation_id; ?>"><?php echo $user->occupation; ?></option>
                                                  <option value="other_occupation">Other</option>
												</Select>
												<input type="text" name="other_occupation" class="user_reg10 other_lable">     
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_occupation" onchange="common_value()">
													           <option value="1" >Public</option>
                                                               <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<div class="col-md-4">
												College :<br>
												<input class="einput" type="text" name="college" id="Clg" placeholder="College Institution" value="<?php echo $user->college; ?>"> 

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_college" onchange="common_value()">
													 <option value="1" >Public</option>
                                                      <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Education in Detail :<br>
												<input class="einput" type="text" name="education_in_detail"  id="education_in_detail" placeholder="Education in Detail" value="<?php echo $user->education_in_detail; ?>">

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_education_in_detail" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<div class="col-md-4">
												Occupation in Detail :<br>
												<input class="einput" type="text" name="occupation_in_detail"  id="occupation_in_detail" placeholder="Occupation in Detail" value="<?php echo $user->occupation_in_detail; ?>">
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_occupation_in_detail" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Employed in:<br>
												<select class="eselect dda" type="text" name="employedin" id="empi" placeholder="Employed in">
												  <option	value="Government">Government</option>
                                                <option	value="Private">Private</option>
                                                <option	value="Business">Business</option>
                                                <option	value="Defence">Defence</option>
                                                <option	value="Self Employed">Self Employed</option>
												</select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_employed_in" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
										<div class="col-md-4">
												Annual Income(/Monthly):<br>
												<select class="eselect dda" type="text" name="annual_income" id="auli" placeholder="Annual Income">
												  <option  <?php if($user->annual_income=='below 100000'){echo "selected='selected'";}?>>Below 1,00,000/-</option>                                        
                                        <option    <?php if($user->annual_income=='100000-200000'){echo "selected='selected'";}?>>1,00,000-2,00,000/-</option>
                                            <option <?php if($user->annual_income=='above 200000'){echo "selected='selected'";}?>>2,00,000 above</option>   			
                                          </select>
											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_annual_income"  onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										
										
										<div class="row pdng25">
											<input type="submit" class="sbt-btn" id="prf_inf_submit" value="Submit">
										<input type="submit" value="Cancel">
										</div>

										<hr class="hbar">
										</form>
									</div>


                                     <!--end edit professional info form-->


									<div class="prof-sec">
										<div class="head-edit">
											<div class="head-icon"><img src="{{ asset('assets/images/img1.png') }}"></div>
											<div class="head-txt"><h2>Family Details</h2></div>
											<button class="head-edit-icon edit_familydetails"></button>
										</div>
										<div class="row">
											<div class="col-md-12">
											<ul class="parent-list details_familydetails">
												<li>
													<ul class="child-list">
														<li class="first">Family Value</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->family_values; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Family Type</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->family_type; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Family Status</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->familystatus; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Father Status</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->fathers_status; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<li class="first">Mother Status</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->mothers_status; ?></li>
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<?php
                                                   foreach($users as $trial)
                                                     {
								                    $no_of_brothers=$trial->no_of_brothers;
						                             }
						                            if($no_of_brothers!="None")
							                             {
								                         ?>
														<li class="first">No of Brother</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->no_of_brothers; ?></li>
														<?php
							                             }
							                             ?>
													</ul>
												</li>
												 <?php
                                            if($no_of_brothers!="None")
                                               {

                                                  ?>
												<li>
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
												</li>
											<?php
							                   }
							                   ?>
												<li>
													<ul class="child-list">
													<?php
                                                foreach($users as $trial)
                                                 {
								               $no_of_sisters=$trial->no_of_sisters;
						                         }
						                       if($no_of_sisters!="None")
							                     {
								                   ?>	
														<li class="first">No of Sisters</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->no_of_sisters; ?></li>
												<?php
							                      }
							                      ?>		
													</ul>
												</li>
												<li>
													<ul class="child-list">
														<?php
                                                foreach($users as $trial)
                                                  {
								                 $sisters_married=$trial->sisters_married;
						                           }
						                         if($sisters_married!="None")
							                       {
								                         ?>
														<li class="first">Sisters Married</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->sisters_married; ?></li>
												 <?php
							                      }
							                      ?>		
													</ul>
												</li>
											</ul>
											</div>
										</div>
										<hr class="hbar">
									</div>
                                <!--start edit family dtls form-->
                                <form class="form-class"  id="family_details_form">
                                  <div class="prof-sec" id="family_dtls_hide" style="display:none">
										
										<div class="row pdng25">
											<div class="col-md-4">
												Father Status :<br>
												<input class="einput" type="text" name="fathers_status"  id="FathersStatus1" placeholder="Father's Status" value="<?php echo $user->fathers_status; ?>">

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_fathers_status" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Mother Status :<br>
												<input class="einput" type="text" name="mothers_status"  id="MothersStatus" placeholder="Mother's Status" value="<?php echo $user->mothers_status; ?>">

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_mother_status" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<div class="col-md-4">
												Family Values :<br>
												<Select class="eselect dda" type="text" name="family_values"  id="family_values"  placeholder="Family Values">
												 <option	<?php if($user->family_values=='Orthodox'){echo "selected='selected'";}?>>Orthodox</option>
                                                <option	<?php if($user->family_values=='Traditional'){echo "selected='selected'";}?>>Traditional</option>
                                                <option	<?php if($user->family_values=='Moderate'){echo "selected='selected'";}?>>Moderate</option>
                                                <option	<?php if($user->family_values=='Liberal'){echo "selected='selected'";}?>>Liberal</option>
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_family_values" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												Family Type :<br>
												<Select class="eselect dda" type="text" name="family_type"  id="family_type"  placeholder="Family Type">
												 <option <?php if($user->family_type=='Joint Family'){echo "selected='selected'";}?>>Joint Family</option>
                                                <option	<?php if($user->family_type=='Nuclear Family'){echo "selected='selected'";}?>>Nuclear Family</option>
                                                <option	<?php if($user->family_type=='Others'){echo "selected='selected'";}?>>Others</option>
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_family_type" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											<div class="col-md-4">
												Family Status :<br>
												<Select class="eselect dda" type="text" name="familystatus"  id="familystatus"  placeholder="Family Status">
												 <option	<?php if($user->familystatus=='Middle Class'){echo "selected='selected'";}?>>Middle Class</option>
                                                <option	<?php if($user->familystatus=='Upper Middle Class'){echo "selected='selected'";}?>>Upper Middle Class</option>
                                                <option	<?php if($user->familystatus=='Rich'){echo "selected='selected'";}?>>Rich</option>
                                                <option	<?php if($user->familystatus=='Affluent'){echo "selected='selected'";}?>>Affluent</option>
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_family_status" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												No of Brothers :<br>
												<Select class="eselect dda"  name="no_of_brothers" id="NfBs1" >
												 <option  <?php if($user->no_of_brothers=='None'){echo "selected='selected'";}?>>None</option>
                                                <option	<?php if($user->no_of_brothers=='1'){echo "selected='selected'";}?>>1</option>
                                                <option	<?php if($user->no_of_brothers=='2'){echo "selected='selected'";}?>>2</option>
                                                <option	<?php if($user->no_of_brothers=='3'){echo "selected='selected'";}?>>3</option>
                                                <option	<?php if($user->no_of_brothers=='4'){echo "selected='selected'";}?>>4</option>
                                                <option	<?php if($user->no_of_brothers=='5'){echo "selected='selected'";}?>>5</option>
                                                <option	<?php if($user->no_of_brothers=='other'){echo "selected='selected'";}?>>Other</option>
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_no_of_brothers" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
								 
								 <?php
                                 if($user->no_of_brothers=='None')
                                   {
                                $a='style="display:none;"';
                                   }
                                  else
                                   {
                                 $a="";
                                   }
                                  ?>                      
     
											<div class="col-md-4" <?php echo $a;?>>
												Brothers Married :<br>
												<Select class="eselect dda"  name="brothers_married" id="BrsM" >
												 <option  <?php if($user->brothers_married=='None'){echo "selected='selected'";}?>>None</option>
                                               
                                                <option	<?php if($user->brothers_married=='1'){echo "selected='selected'";}?>>1</option>
                                                <option	<?php if($user->brothers_married=='2'){echo "selected='selected'";}?>>2</option>
                                                <option	<?php if($user->brothers_married=='3'){echo "selected='selected'";}?>>3</option>
                                                <option	<?php if($user->brothers_married=='4'){echo "selected='selected'";}?>>4</option>
                                                <option	<?php if($user->brothers_married=='5'){echo "selected='selected'";}?>>5</option>
                                                <option	<?php if($user->brothers_married=='other'){echo "selected='selected'";}?>>Other</option>
                                             </select>

											</div>

											<div class="col-md-2" <?php echo $a;?>>
												<select  class="edrop dda" id="visibility_brothers_married" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">
												No of Sister :<br>
												<Select class="eselect dda"  name="no_of_sisters" id="NoS" >
												 <option  <?php if($user->no_of_sisters=='None'){echo "selected='selected'";}?>>None</option>
                                                <option	<?php if($user->no_of_sisters=='1'){echo "selected='selected'";}?>>1</option>
                                                <option	<?php if($user->no_of_sisters=='2'){echo "selected='selected'";}?>>2</option>
                                                <option	<?php if($user->no_of_sisters=='3'){echo "selected='selected'";}?>>3</option>
                                                <option	<?php if($user->no_of_sisters=='4'){echo "selected='selected'";}?>>4</option>
                                                <option	<?php if($user->no_of_sisters=='5'){echo "selected='selected'";}?>>5</option>
                                                <option	<?php if($user->no_of_sisters=='other'){echo "selected='selected'";}?>>Other</option>
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_no_of_sisters" onchange="common_value()">
													<option value="1" >Public</option>
                                                    <option value="0">Private</option>
												</select>
											</div>
										</div>
										<div class="row pdng25">
											 <?php
                                     if($user->no_of_sisters=='None')
                                       {
                                       $b='style="display:none;"';
                                        }
                                        else
                                        {
                                         $b="";
                                        }
                                        ?>   
											<div class="col-md-4" <?php echo $b;?>>
												Sisters Married :<br>
												<Select class="eselect dda" type="text">
												 <option <?php if($user->sisters_married=='None'){echo "selected='selected'";}?>>None</option>
                                                <option	<?php if($user->sisters_married=='1'){echo "selected='selected'";}?>>1</option>
                                                <option	<?php if($user->sisters_married=='2'){echo "selected='selected'";}?>>2</option>
                                                <option	<?php if($user->sisters_married=='3'){echo "selected='selected'";}?>>3</option>
                                                <option	<?php if($user->sisters_married=='4'){echo "selected='selected'";}?>>4</option>
                                                <option	<?php if($user->sisters_married=='5'){echo "selected='selected'";}?>>5</option>
                                                <option	<?php if($user->sisters_married=='other'){echo "selected='selected'";}?>>Other</option>
                                             </select>

											</div>

											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_sisters_married" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
											<div class="col-md-4">


											</div>

											<div class="col-md-2">

											</div>
										</div>
										<div class="row pdng25">
											<input type="submit" class="sbt-btn" value="submit" id="regg4">
											<input type="submit" value="Cancel">
										</div>

										<hr class="hbar">

									</div>
								</form>

                                <!--end edit family dtls form-->

									<div class="prof-sec">
										<div class="head-edit">
											<div class="head-icon"><img src="{{ asset('assets/images/img5.png') }}"></div>
											<div class="head-txt"><h2>About my Family</h2></div>
											<button class="head-edit-icon edit_aboutfamily"></button>
										</div>
										<div class="row">
										<div class="col-md-12">
											<ul class="parent-list details_aboutmyfamily">
												<li>
													<ul class="child-list">
														<li class="first parent-list">About My Family</li>
														<li class="second">:&nbsp;&nbsp;&nbsp;<?php echo $user->about_my_family; ?></li>
													</ul>
												</li>
											</ul>
										</div>
										</div>
									</div>
									<!--start edit about my family form-->
									 <form class="form-class"  id="aboutmyfamily-form">
                                     <div class="prof-sec" id="abt_myfamily_hide" style="display:none">
										
										<div class="row pdng25">
										<div class="col-md-10">
												About My Family :<br>
												<textarea class="einput" type="text"  name="about_my_family" style="height:150px;"><?php echo $user->about_my_family;?></textarea>

											</div>
											<div class="col-md-2">
												<select  class="edrop dda" id="visibility_about_my_family" onchange="common_value()">
													 <option value="1" >Public</option>
                                                     <option value="0">Private</option>
												</select>
											</div>
										</div>


										
											<div class="row pdng25">
											<input type="submit" class="sbt-btn" value="Submit" id="abtmyfamily_form">
											<input type="submit" value="Cancel">
										</div>

									</div>
								</form>
									<!--end edit about my family form-->
								</div>
							</div>
							<?php
						      }

							?>
                          <div class="loader_cls"></div>
							<!-- hide -->
								<div class="profile-details1">
								
								<div class="profile-inner1">
										
									


									
									
									
								</div>
							</div>
							<!-- hide -->
						

				
                  </div>
                  <div class="col-lg-3">
                     <div class="right-part">
					 <div class="right-part1">
                        <h2 class="head-name2">Daily Recommendations</h2>
                        <br>
						<hr>
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

                              <li class="imagerd">
                                <a href='search-profile-view/{{$encrypted_id}}'> 
                                <?php if($img_status=='0')
                                 {?>
                                <img  src="{{asset('assets/images/default_profile.jpg')}}">
                                 <?php } else
                                    {
                                    	?>
                                 <img  src="{{asset($data->path)}}">
                                 <?php } ?></a>
                              </li>
                              <li>
                                 <p class="pink-name" style="text-transform: capitalize;"><a href='search-profile-view/{{$encrypted_id}}'><?php echo $data->name; ?></a></p>
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
						<hr>
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
      @include('include.footer')
      <!-- End Footer -->
   </div>
   <!-- Bootstrap core JavaScript
      ================================================== -->
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
 <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
   <!-- Placed at the end of the document so the pages load faster -->
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
   	  
   			  $('#rii').hide();
    
                   $(".others").change(function () {
   	                   var others = $(".others").val();
                                   if(others == 'other_religion'){
                          $('#rii').show();
                              }else{
   	          $('#rii').hide(); 
   			
                          }
                          });
   			  
   			  $('#otrs').hide();
    
                   $(".Other").change(function(){
   	                   var Other = $(".Other").val();
                                   if(Other == 'other_caste'){
                          $('#otrs').show();
                              }else{
   	          $('#otrs').hide(); 
   			  //$('#otrs').val(Other);
                          }
                          });
   			  
   			 
   			  
   			  $('.user_reg2').hide();
    
                   $(".other_star").change(function () {
   	                   var other_star = $(".other_star").val();
                                   if( other_star == 'other_star'){
                          $('.user_reg2').show();
                              }else{
   	          $('.user_reg2').hide(); 
   			 // $('.user_reg2').val(other_star);
                          }
                          });
   			  
   			  
   			  
   			  $('.user_reg3').hide();
    
                   $(".other_moonsign").change(function () {
   	                   var other_moonsign = $(".other_moonsign").val();
                                   if( other_moonsign == 'other_moonsign'){
                          $('.user_reg3').show();
                              }else{
   	          $('.user_reg3').hide(); 
   			 // $('.user_reg3').val(other_moonsign);
                          }
                          });
   			  
   			  
   			  $('.user_reg4').hide();
    
                   $(".other_Zodiac").change(function () {
   	                   var other_Zodiac = $(".other_Zodiac").val();
                                   if( other_Zodiac == 'other_Zodiac'){
                          $('.user_reg4').show();
                              }else{
   	          $('.user_reg4').hide(); 
   			  //$('.user_reg4').val(other_Zodiac);
                          }
                          });
   			   $('.user_reg5').hide();					    
   				$(".other_country_livingin").change(function(){
   					  var other_country_livingin = $(".other_country_livingin").val();
   					  if(other_country_livingin == 'other_country_livingin'){
   			   $('.user_reg5').show();
   					  }else{
   			   $('.user_reg5').hide();
                          // $('.user_reg5').val(other_country_livingin);						   
   					  }						   
   					});  
   					
   					
   					$('.user_reg6').hide();
   					$(".other_citizenship").change(function(){
   					  var other_citizenship = $(".other_citizenship").val();
   					  if(other_citizenship == 'other_citizenship'){
   			   $('.user_reg6').show();
   					  }else{
   			   $('.user_reg6').hide();
                           //$('.user_reg6').val(other_citizenship);						   
   					  }						   
   					});  
   					
   					
   			  $('.user_reg7').hide();
   					$(".other_residing_state").change(function(){
   					  var other_residing_state = $(".other_residing_state").val();
   					  if(other_residing_state == 'other_residing_state'){
   			   $('.user_reg7').show();
   					  }else{
   			   $('.user_reg7').hide();
                           //$('.user_reg7').val(other_residing_state);						   
   					  }						   
   					});  
   					
   					$('.user_reg8').hide();
   					$(".other_residing_city").change(function(){
   					  var other_residing_city = $(".other_residing_city").val();
   					  if(other_residing_city == 'other_residing_city'){
   			   $('.user_reg8').show();
   					  }else{
   			   $('.user_reg8').hide();
                           //$('.user_reg8').val(other_residing_city);						   
   					  }						   
   					}); 
   					
   ////////////////////////////////////////professional information///////////////////////////////////								
   					$('.user_reg9').hide();
   					$(".other_education").change(function(){
   					  var other_education = $(".other_education").val();
   					  if(other_education == 'other_education'){
   			   $('.user_reg9').show();
   					  }else{
   			   $('.user_reg9').hide();
                          // $('.user_reg9').val(other_education);						   
   					  }						   
   					}); 
   					
   					
   					$('.user_reg10').hide();
   					$(".other_occupation").change(function(){
   					  var other_occupation = $(".other_occupation").val();
   					  if(other_occupation == 'other_occupation'){
   			   $('.user_reg10').show();
   					  }else{
   			   $('.user_reg10').hide();
                          // $('.user_reg10').val(other_occupation);						   
   					  }						   
   					}); 
   					
   					$('.user_reg11').hide();
   					$(".Occu_pation").change(function(){
   					  var Occu_pation = $(".Occu_pation").val();
   					  if(Occu_pation == 'Occu_pation'){
   			   $('.user_reg11').show();
   					  }else{
   			   $('.user_reg11').hide();
                           //$('.user_reg11').val(Occu_pation);						   
   					  }						   
   					});
   					
   			   
   			});
       $('.loginlink').click(function(){

			    $('.image_class')[0].click();
			  
			 });  	
   				
</script>

   <script type="text/javascript">
     
      $(document).ready(function(){
      $("#editform").hide();
      $(".basic_edit").click(function(){
      $(".basicdetails_form").hide();
      $("#editform").show();
      
      });
        $(".loader_cls").hide();  
      $("#basic_details").click(function(){
            $('#basicdtls').validate({
                rules: {
              name: {required: true ,
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
           $(".loader_cls").show();  
     
          $(".basicdetails_form").show();
      $("#editform").hide();
         
      
      var value =$("#basicdtls").serialize() ;
          
            
                               $.ajax({
                               type:'POST',
                               url: "{{ url('user/update-basicdetails') }}",
                               data: value,
                               success:function (update_basicdetails){
                                   $(".loader_cls").hide();
                               console.log(update_basicdetails);
      
                                         if(update_basicdetails==1){
                                                   window.location="{{ url('user/profileview') }}";
                                                   //alert("Successfully Updated");
                                                
                                                   location.reload();													 
                                                    													 
                                                           }
                                                   else{
                                                   $(".msg").html('error');
                                                       }
                                                   } 
                                      }); 
                   } 
                });   
      		  });
    
 
     ////////////////////////////////update religious info////////////////////////////////////////////////	 
      
      $("#location_hide").hide();
      $(".Religious_Information").click(function(){
      $(".religious_info_details").hide();
      $("#location_hide").show();
      
      });
       $(".loader_cls").hide(); 
      $("#regg1").click(function(){

        $('#loctnform').validate({
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


           $(".loader_cls").show(); 
      $(".religious_info_details").show();
      $("#location_hide").hide();
      
            var value =$("#loctnform").serialize() ;
                               
      
                               $.ajax({
                               type:'POST',
                                url: "{{ url('user/update-religiousinformation') }}",
                               data: value,
                               success:function (editreligious_info){
                                     $(".loader_cls").hide(); 
                               console.log(editreligious_info);
       
                                            if(editreligious_info==1){
      
                                                window.location="{{ url('user/profileview') }}";	
                                               
      		
                                                           }
                                                   else{
                                                   $(".msg").html('error');
                                                       }
                                                   } 
                                      }); 
                             }
                           });
      		  });
          
           //////////////////////////////////update location//////////////////////////////////////////////
     
      $("#loctn_hide").hide();
      $(".edit_location").click(function(){
      $(".location_details").hide();
      $("#loctn_hide").show();
      
      });
      $(".loader_cls").hide();  
      $("#loc_dtls").click(function(){

          $('#lctndetails-form').validate({
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
          $(".loader_cls").show();  
      $(".location_details").show();
      $("#loctn_hide").hide();
      
      var value =$("#lctndetails-form").serialize() ;
                             
      
                               $.ajax({
                               type:'POST',
                               url: "{{ url('user/update-location') }}",
                               data: value,
                               success:function (location){
                                   $(".loader_cls").hide();  
                               console.log(location);
       
                                            if(location==1){
      
                                                window.location="{{ url('user/profileview') }}";
                                              
      		
                                                           }
                                                   else{
                                                   $(".msg").html('error');
                                                       }
                                                   } 
                                      }); 
                             }
                           });
      		  });
          //////////////////////////////////update professional information///////////////////////////////////////////////	 
     
      $("#prf_info_hide").hide();
      $(".edit_professionalinfo").click(function(){
      $(".details_professionalinformation").hide();
      $("#prf_info_hide").show();
      
      });
      $(".loader_cls").hide();  
      $("#prf_inf_submit").click(function(){

    $('#profesional_info_form').validate({
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


          $(".loader_cls").show();  
      $(".details_professionalinformation").show();
      $("#prf_info_hide").hide();
      
      var value =$("#profesional_info_form").serialize() ;
                               
      
                               $.ajax({
                               type:'POST',
                               url: "{{ url('user/update-professionalinfo') }}",
                               data: value,
                               success:function (prf_info){
                                   $(".loader_cls").hide();  
                               console.log(prf_info);
   
                                            if(prf_info==1){
      
                                                window.location="{{ url('user/profileview') }}";
                                                
      		
                                                           }
                                                   else{
                                                   $(".msg").html('error');
                                                       }
                                                   } 
                                      }); 
                             }
                           });
      		  });
           //////////////////////////////////update family details///////////////////////////////////////////////	 
          
      $("#family_dtls_hide").hide();
      $(".edit_familydetails").click(function(){
      $(".details_familydetails").hide();
      $("#family_dtls_hide").show();
      
      });
      $(".loader_cls").hide();  
      $("#regg4").click(function(){
         $('#family_details_form').validate({
                           rules: {
          
                fathers_status: {required: true ,}, 
                 mothers_status: {required: true ,},
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
          $(".loader_cls").show();  
      $(".details_familydetails").show();
      $("#family_dtls_hide").hide();
      
      var value =$("#family_details_form").serialize() ;
                               
                               $.ajax({
                               type:'POST',
                               url: "{{ url('user/update-familydetails') }}",
                               data: value,
                               success:function (family_dtls){
                                   $(".loader_cls").hide();  
                               console.log(family_dtls);
       
                                           if(family_dtls==1){
      
                                    
      				  window.location="{{ url('user/profileview') }}";	
      				 
                                                           }
                                                   else{
                                                   $(".msg").html('error');
                                                       }
                                                   } 
                                      }); 
                             }
                           });
      		  });
            //////////////////////////////////update about my family///////////////////////////////////////////////	 
          
          
      $("#abt_myfamily_hide").hide();
      $(".edit_aboutfamily").click(function(){
      $(".details_aboutmyfamily").hide();
      $("#abt_myfamily_hide").show();
      
      });
      $(".loader_cls").hide();  
      $("#abtmyfamily_form").click(function(){

         $('#aboutmyfamily-form').validate({
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
          $(".loader_cls").show();  
      $(".details_aboutmyfamily").show();
      $("#abt_myfamily_hide").hide();
      
      var value =$("#aboutmyfamily-form").serialize() ;
                               
                               $.ajax({
                               type:'POST',
                               url: "{{ url('user/update-aboutmyfamily') }}",
                               data: value,
                               success:function (abt_myfamily){
                                   $(".loader_cls").hide();  
                               console.log(abt_myfamily);
       
                                           if(abt_myfamily==1){
      
                                              window.location="{{ url('user/profileview') }}";
                                             
      			
                                                           }
                                                else{
                                                $(".msg").html('error');
                                                }
                                              } 
                                       }); 
                             }
                           });
      		 });
      
      
          
      
      });
  				
       $.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
 
     
   </script>
   
 <script>
    var selected_caste = '';
      $('.loader').hide();
    var value=$("#religion_id").val();
      
      selected_caste = $(".user_caste").val();
      
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-religioncaste') }}",
             data:{rel_val:value,caste:selected_caste},
             success:function (return_rel){
                  $('.loader').hide();
             console.log(return_rel);
                if(return_rel!=0){
                                  
                       
                $(".user_caste").html(return_rel);
					
					$('.test_class').select2();
                                  }
                              else
                                {
               $(".msg").html('error');
      											 
                                                            }
                                                        }
           
            }); 
     $("#religion_id").on('change', function() {
           
       $('.loader').show();
      var value=$(this).val();
      
      
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-religioncast') }}",
             data:{rel_val:value},
             success:function (return_rel){
                  $('.loader').hide();
             console.log(return_rel);
                                                    if(return_rel!=0){
                                                       
                                                  $(".user_caste").html(return_rel);
                                                        }
                                                        else{
                                                          $(".msg").html('error');
      											 	
                                                            }
                                                        }
           
            });  
      });
     //////////////////////////////////display state and district/////////////////////////////////////////
     $('.loader_state').hide(); 
     var value=$("#country_id").val();
      
      var selected_state = $(".user_state").val();
      
        
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-country') }}",
             data:{state_val:value},
             success:function (return_sta){
            $('.loader_state').hide(); 
             console.log(return_sta);
                
                 if(return_sta!=0){
                                                     
                     $(".user_state").html(return_sta);
		             $('.user_state').val(selected_state);
					 
                                                        }
                                                        else{
                                                  $(".msg").html('error');
      											  
                                                            }
                                                        }

            });		
				
      $("#country_id").on('change', function() {
     
          $('.loader_state').show(); 
          
       var value=$(this).val();
      
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-country') }}",
             data:{state_val:value},
             success:function (return_sta){
                 $('.loader_state').hide(); 
             console.log(return_sta);
                
                 if(return_sta!=0){
                                              
                     $(".user_state").html(return_sta);
                                                        }
                                                        else{
                                                $(".msg").html('error');
      											
                                                            }
                                                        }
           
            });  
      });
     
       //////////////////////////////////display star moonsign/////////////////////////////////////////
     
      $('.loader_district').hide();
     var value=$("#star_id").val();
        var selected_rassi = $(".user_rassi").val();
       
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-moonsign') }}",
             data:{moonsign_val:value},
             success:function (return_starmoon){
                  $('.loader_district').hide();
             console.log(return_starmoon);
            
                 if(return_starmoon!=0){
                                                   
                     $(".user_rassi").html(return_starmoon);
					 $('.user_rassi').val(selected_rassi);
					 
                                                        }
                                                        else{
                                                            $(".msg").html('error');
      											 	
                                                            }
                                                        }
           
            });  
       $("#star_id").on('change', function() {
       $('.loader_district').show();
       var value=$(this).val();
      
        
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-moonsign') }}",
             data:{moonsign_val:value},
             success:function (return_starmoon){
                  $('.loader_district').hide();
             console.log(return_starmoon);
                                                    
                 if(return_starmoon!=0){
                                                
                     $(".user_rassi").html(return_starmoon);
                                                        }
                                                        else{
                                                            $(".msg").html('error');
      											 	
                                                            }
                                                        }
           
            });  
      });
      //////////////////////////////////display district/////////////////////////////////////////
      $('.loader_district').hide(); 
     var value=$("#state_id").val();
         var selected_district = $(".user_district").val();
       
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-district') }}",
             data:{district_val:value},
             success:function (return_district){
                  $('.loader_district').hide();
             console.log(return_district);
                                                     if(return_district!=0){
                                                     
                                    $(".user_district").html(return_district);
									$('.user_district').val(selected_district);
		               
                                                        }
                                                        else{
                                                        	
                                                            }
                                                        }
           
            });  
            
      $("#state_id").on('change', function() {
        $('.loader_district').show();
       var value=$(this).val();
      
      
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-district') }}",
             data:{district_val:value},
             success:function (return_district){
                  $('.loader_district').hide();
             console.log(return_district);
                                                     if(return_district!=0){
                                                 
                                                     $(".user_district").html(return_district);
                                                        }
                                                        else{
                                                         $(".msg").html('error');
      											  	
                                                            }
                                                        }
           
            });  
      });
      
      $('.loader_occupation').hide();
    var value=$("#educationfield_id").val();
      var selected_caste = $(".user_occupation").val();
     
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-education') }}",
             data:{education_val:value},
             success:function (return_education){
                  $('.loader_occupation').hide();
             console.log(return_education);
                                                    if(return_education!=0){
                                                    
                                                  $(".user_occupation").html(return_education);
      						                      $('.user_occupation').val(selected_caste);
      						  
                                                        }
                                                        else{
                                                         $(".msg").html('error');
      											 
                                                            }
                                                        }
           
            });  
      
       $("#educationfield_id").on('change', function() {
          $('.loader_occupation').show();
      var value=$(this).val();
      
  
           $.ajax({
             type: "GET",
             url: "{{ url('user/update-education') }}",
             data:{education_val:value},
              success:function (return_education){
                   $('.loader_occupation').hide();
              console.log(return_education);
                                                    if(return_education!=0){
                                                      
                                                  $(".user_occupation").html(return_education);
                                                        }
                                                        else{
                                           $(".msg").html('error');
      											   
                                                            }
                                                        }
           
            });  
      });  
      
</script>

<!-- user visibility -->

<script type="text/javascript">

function common_value(){

  /* basicdtls*/

   var name=$("#visibility_name").val();
  var body_type=$('#visibility_body_type').val();
  var complexion=$("#visibility_complexion").val(); 
  var height=$("#visibility_height").val();
  var physical_status=$("#visibility_physical_status").val();
  var weight=$("#visibility_weight").val();
  var marital_status=$("#visibility_marital_status").val();
   var eating_habits=$("#visibility_eating_habits").val();
  var drinking_habits=$('#visibility_drinking_habits').val();
  var smoking_habits=$("#visibility_smoking_habits").val(); 

     /* religious_info*/

  var religion=$("#visibility_religion").val();
  var caste=$("#visibility_caste").val();
  var star=$("#visibility_star").val();
  var rasi=$("#visibility_rasi").val();
   var zodiac=$("#visibility_zodiac").val();
  /* location*/

  var country=$("#visibility_country").val();
  var state=$("#visibility_state").val();
  var mother_tongue=$("#visibility_mother_tongue").val();
  var district=$("#visibility_district").val();

  /* professional_info*/

   var education=$("#visibility_education").val();
  var occupation=$('#visibility_occupation').val();
  var college=$("#visibility_college").val(); 
  var education_in_detail=$("#visibility_education_in_detail").val();
  var occupation_in_detail=$("#visibility_occupation_in_detail").val();
  var employed_in=$("#visibility_employed_in").val();
  var annual_income=$("#visibility_annual_income").val();

   /* family_dtls*/

   var fathers_status=$("#visibility_fathers_status").val();
  var mother_status=$('#visibility_mother_status').val();
  var family_values=$("#visibility_family_values").val(); 
  var family_type=$("#visibility_family_type").val();
  var family_status=$("#visibility_family_status").val();
  var no_of_brothers=$("#visibility_no_of_brothers").val();
  var no_of_sisters=$("#visibility_no_of_sisters").val();
  var brothers_married=$("#visibility_brothers_married").val();
  var sisters_married=$("#visibility_sisters_married").val();

   /* about_my_family*/

   var about_my_family=$("#visibility_about_my_family").val();

  $.ajax({
    type:'POST',
    url:"{{ url('user/user-visibility-permission') }}", 
    data: {name:name,body_type:body_type,complexion:complexion,height:height,physical_status:physical_status,weight:weight,
marital_status:marital_status,eating_habits:eating_habits,drinking_habits:drinking_habits,smoking_habits:smoking_habits,
religion:religion,caste:caste,star:star,rasi:rasi,zodiac:zodiac,country:country,state:state,mother_tongue:mother_tongue,
district:district,education:education,occupation:occupation,college:college,education_in_detail:education_in_detail,
occupation_in_detail:occupation_in_detail,employed_in:employed_in,annual_income:annual_income,
fathers_status:fathers_status,mother_status:mother_status,family_values:family_values,family_type:family_type,
family_status:family_status,no_of_brothers:no_of_brothers,no_of_sisters:no_of_sisters,brothers_married:brothers_married,
sisters_married:sisters_married,about_my_family:about_my_family
}, 
    success:function (insert_visibility){ 
      console.log(insert_visibility);
                                                   
             if(insert_visibility==1){
                             $(".msg").html('success');
                              //  window.location="{{ url('user/profileview') }}";                                                                                        $(".user_occupation").html(return_education);
                                  }
                              else{
                        $(".msg").html('error');
                               
                                   }
    
    }
                            
});

}

</script>
 <!-- user visibility -->
  <script type="text/javascript">
    $(document).ready(function (){
            $("#NoS").change(function() {
          
                // SiM is the id of the other select box 
               
                if ($(this).val() != "None") {
                    $(".sis_m").show();
            
                    //$('.sis_m_class').select2();
                }else{
                    $(".sis_m").hide();
                    $("#visibility_sisters_married").hide();
                    $(".sis").hide();
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
               //alert(a);
                if ($(this).val() != "None") {
                    $("#BrsM").show();
            
                    //$('.sis_m_class').select2();
                }else{
                    $("#BrsM").hide();
                    $("#visibility_brothers_married").hide();
                    $(".bro").hide();
                } 
            });
        });


</script>
<script>
      $(document).ready(function(){
      var content = $('.edit_usernameform1').html();
        $('[data-toggle="popover1"]').popover({content:content, html:true});  
      
        $(".update_username1").click(function(){
                                       
            $("#user_social").click(function(){
          var value =$("#register_username1").serialize();
             //alert(value);
             
          $.ajax({
          type:'get',
           url: "{{ url('user/update-socialmedia') }}",
          data: value,
           success:function (v){ 
      console.log(v);
                                                   
             if(v==1){
                             $(".msg").html('success');
                              window.location="{{ url('user/profileview') }}";                                                                                        $(".user_occupation").html(return_education);
                                  }
                              else{
                        $(".msg").html('error');
                               
                                   }
         }
                                             }); 
                                           });});
      
      });
        
   </script>
</body>
</html>

