<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\notification;
use App\models\dailyrecommendation;
use App\models\profilestrength;

use View;
use Input;
use Redirect;
use Response;
use Mail;
use Session;
use Carbon\Carbon;
use Cookie;
use Illuminate\Cookie\CookieJar;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;
use Illuminate\Routing\Route;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
  public function anyFirstShow()
  {
    unlink('installer/test.php');
  unlink('installer/installer.php');
  return redirect('/');
   }
   

  
   
    /**
     * user registration.
     * set unique username and email
     * email send
     */
   public function postUserregistration()
   {
        
         $cur_date= date("Y-m-d");
        $my_data=Input::all(); 
    $random_id=$my_data['random_id'];
    $gender=$my_data['gender'];
    $username=$my_data['username'];
    $pass=$my_data['password'];
    $password=base64_encode($pass);
    $email=$my_data['email'];    
        $dob = $my_data['dob'];
        $contact_num=$my_data['contact_num'];
        $key=$email.$password; 
      
         $registration=\DB::table('user_reg')
                       ->where(['email' => $email])
                       ->count();
         echo json_encode($registration);
                
         $date_for = date("Y-m-d", strtotime($dob));
          
        
         if($registration)
         {
            
            echo 0;
         }
         else
         {
         $check_uname=\DB::table('user_reg')
                           ->where(['username' => $username])
                           ->count();
             if($check_uname)
               {
      
               echo 2;
                }
  
              else
    
               {
                  
                  
                  
                  
     Mail::send('emails.welcome', array('email' => $email, 'user_key' => md5($key)), function ($message) use($email)
           {
    $message->to($email, 'To')->subject('Welcome to Soulmate!');
           });
                  
        
         $registration=\DB::table('user_reg')->insert(
       ['rand_id' => $random_id,'username' => $username, 'password'=>$password,'email' => $email,'gender' => $gender,        
        'dob' =>$date_for,'date'=>$cur_date,'contact_num' => $contact_num,'email_key' =>md5($key)]);
        
                  
                  $prvcy_dtls=array('name'=>1,'body_type'=>1,'complexion'=>1,'height'=>1,'physical_status'=>1,'weight'=>1,
                   'marital_status'=>1, 'eating_habits'=>1,'drinking_habits'=>1,'smoking_habits'=>1,
                   'religion'=>1,'caste'=>1,'star'=>1,'rasi'=>1,'zodiac'=>1,'country'=>1,'state'=>1,
                   'mother_tongue'=>1,'district'=>1,'education'=>1,'occupation'=>1, 'college'=>1,
                   'education_in_detail'=>1,'occupation_in_detail'=>1,'employed_in'=>1,'annual_income'=>1,
           'fathers_status'=>1,'mother_status'=>1,'family_values'=>1,'family_type'=>1,'family_status'=>1,
           'no_of_brothers'=>1,'no_of_sisters'=>1,'brothers_married'=>1,'sisters_married'=>1,
           'about_my_family'=>1);

 $privcy=json_encode($prvcy_dtls);
                  
                   $user_login_values=\ DB::table('user_reg')
                                    ->where(['email' => $email, 'password'=>$password])
                                        ->get();
         
   foreach($user_login_values as $values)
        {
            $user_id=$values->id;
    }
     
                  $social_media_data_insertion=\DB::table('user_profile')
                     ->insert(['user_id' => $user_id, 'path' =>'assets/images/default_profile.jpg', 'google_plus' =>'plus.google.com', 'facebook' =>'fb.com', 'twitter' =>'mobile.twitter.com','user_visibility'=>$privcy]);

 

                  
                  echo 1;
               }
          }
       
   }
     /*
   *verify email
   *set email key null for email verification
   *set status online
     *session set for username,id and gender
   */
    public function getVerifymail()
    { 
  $verify_key=$_GET['user_key'];
  $verify_acc = \ DB::table('user_reg')
            ->where('email_key',$verify_key)
            ->get();
        
        foreach($verify_acc as $get_verify_acc)
            {
            $id=$get_verify_acc->id;
            $username=$get_verify_acc->username;
              $gender=$get_verify_acc->gender;
            }
      $count=count($verify_acc);
         if($count == 1)    
         {
       $verified=\DB::table('user_reg')
             ->where('email_key',$verify_key) 
             ->update(['email_key'=>null]);
               
       if($verified)
         {
        $online_status=\DB::table('user_reg')
                      ->where('id',$id) 
                      ->update(['status' =>'online']);
         \Session::put(['gender'=>$gender,'username'=>$username,'id'=>$id]); 
            
                //$header_results = with(new notification)->headersearch(); 
          //return View::make('frontend.profile',array('results'=>$header_results));
                 return redirect('user/profile');
        }
        }
        else
          {
      return Redirect::to('user/error-page')->with('message', 'please verify your account');
       
          }
            
    }
     public function postLogin()
     {  
    
            
          $email = trim(\Input::get('email', false));
          $passw = trim(\Input::get('password', false));
           $remember = (Input::has('remember')) ? true : false;
         $password=base64_encode($passw);
        
     $login=\DB::table('user_reg')
           ->where(['email' => $email,'password'=>$password,'email_key'=>null])
              ->get();
        // var_dump($login);exit;
          
         $payment=\Session::get('packageid');
        $paymentid= base64_encode($payment);

        $not_lg_user=\Session::get('not_lg_id');
        $not_lg_id= base64_encode($not_lg_user);

         $deactivation = 0;
     
         foreach($login as $value)
         {
           $id = $value->id;
       $username = $value->username; 
           $gender=$value->gender;
             
           $deactivation=$value->deactivate_status;
       $deac_date=$value->deactivation_date;
       $deac_days=$value->deactivate_days;
       
       \Session::put(['gender'=>$gender,'username'=>$username,'id'=>$id]); 
       $s_id=\Session::get('id');
       
       $strength=\DB::table('user_profile')
                  ->where('user_id',$id)
                 ->where('profile_strength','>','59')
                 ->count();
             
          
             if($remember==true)
            {
             $response = new \Illuminate\Http\Response('Soulmate');
             $response->withCookie(cookie('soulmate', $id, 360));
//return $response;
              }
             
              $online_status=\DB::table('user_reg')
             ->where('id',$id) 
             ->update(['status' =>'online']);
             
         }         
        
         
         if($deactivation == 1)
         {
        
        $deacdate = new Carbon($deac_date);
    $today   = Carbon::now();
    $date_deactivation = $deacdate->diff($today)->days;
    
      if($date_deactivation > $deac_days)
         {
          $deac_status=\DB::table('user_reg')
                     ->where('id',$id) 
                     ->update(['deactivate_status' =>0]);
             
       }
       else
       {
    
    
         echo 2;
       }
      }
    elseif($paymentid){
         //$pkg_id=base64_encode($pkg_id);
            $p_id= \Session::get('packageid');
             $get_pk_id= base64_encode($p_id);
             $gender_check=\DB::table('user_reg')
                            ->where('id',$p_id)
                            ->get();
             foreach($gender_check as $gender)
             {
                 $user_gender=$gender->gender;
             }
             $payment_user_gender=\Session::get('gender');
             if($payment_user_gender==$user_gender)
             {
                 echo "error";
                 Session::flush();
               //return redirect('/'); 
             }
               else
               {
          echo $get_pk_id;
               }
  
       } 
     elseif($not_lg_id){
         
             $gendercheck=\DB::table('user_reg')
                            ->where('id',$not_lg_user)
                            ->get();
             foreach($gendercheck as $gender)
             {
                 $usergender=$gender->gender;
             }
             $user_gender=\Session::get('gender');
             if($user_gender==$usergender)
             {
                 echo 4;
                 Session::flush();
               //return redirect('/'); 
             }
               else
               {
          echo $not_lg_id;
               }
  
       } 
        elseif($login)
        {
          if($strength==0) 
          {
            echo 3;
          }
          else
          {
             
            $subscription=\DB::table('user_payment_details')
                           ->where('uid',$id)
                           ->get();
                           $u_status = "";
              foreach($subscription as $sub)
              {
                $days_date=$sub->paid_date;
                $pd_days=$sub->period;
                $u_status=$sub->user_payment_status;

              }  
              /*if($u_status == "")
                    {
           echo 1;
         }*/
                //  $u_status="";
                 if($u_status == 1)
                    {
        
                     $prd_date = new Carbon($days_date);
                     $today   = Carbon::now();
                     $date_subs = $prd_date->diff($today)->days;
                        //var_dump($date_subs);exit;
                                       if($date_subs > $pd_days)
                                                {
                                                  //echo "hai";
                                           $deac_status=\DB::table('user_payment_details')
                                                        ->where('uid',$id) 
                                                        ->delete();
             
                                                 }  
                                                 echo 1;  
                                                 }      
            
          }
         
           
       if(isset($response))
        {
    
        return $response;
         }
            
        }
       
        else
        {
          echo 0;
        
        }    
        
     }
    public function getActivation()
  {
        $id= \Session::get('id');
        $cookie = Cookie::get('soulmate');
    if($cookie) {
      $id = $cookie;
    }
        
        if($id)
        {
      if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
     return View::make('frontend.activation');
         }
        else
        {
            return redirect('user/error-page');
        }
  }
    public function postProfileActivation()
  {
    $id= \Session::get('id');
    $data=Input::all();
    $status=$data['status'];
    
        $activation=\DB::table('user_reg')
             ->where('id',$id) 
             ->update(['deactivate_status'=>$status]);
      if($activation)
        {
          echo 1; 
        }
        else
        {
          echo 0;
        }   
  }
    public function anyNotificationcount()
    {
       $header_values = with(new notification)->headersearch();
        return $header_values;
    }
   
    public function getProfile()
   {
      $sess=\Session::get('id');
      $cookie = Cookie::get('soulmate');
      
         if($cookie) {
      $sess = $cookie;
           }

         
         $get_image=\ DB::table('user_profile')
                        ->where(['user_id' => $sess])
                        ->get();
      
         $get_register=\ DB::table('user_reg')
                     ->where(['id' => $sess])
                         ->get(); 
            
         
    if($sess)
     {
      if($cookie)
      {
      $sess1= \Session::put('id',$cookie);
          }
         $header_results = with(new notification)->headersearch();
          $daily_recommendation= with(new dailyrecommendation)->dailyrecommendation();
          $profile_strength=with(new profilestrength)->profilestrength($sess);
        // var_dump($profile_strength);exit;
     
       return View::make('frontend.profile',array('image'=>$get_image,'reg_values'=>$get_register,'results'=>$header_results,'recommendation'=>$daily_recommendation,'profile_str'=>$profile_strength));
              }
        else
        {
            return redirect('user/error-page');
        }
         
   }
      
    public function postBasicdetails()
        {
       $my_data=Input::all();
         $name = $my_data['name'];
                   
          $id= \Session::get('id');
          $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                     ->where('user_id', '=', $id)
                      ->get(); 
            
            $count=count($profile);
         $profile_values=0;
      
            if ($count==0)  
        {
           $basicdetails=\DB::table('user_profile')
                                ->insert($my_data); 
        }
       else
        {
             
            $basicdetails=\DB::table('user_profile')
                              ->where('user_id', $id)
                              ->update($my_data);
           }
        
           $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;
         
            
       
        }
     public function postReligiousinformation()
        {
       $my_data=Input::all();
             $religion=$my_data['religion'];
           $other_religion=$my_data['other_religion'];
             $caste=$my_data['caste'];
             $other_caste=$my_data['other_caste'];
             $star=$my_data['star'];
             $rasi=$my_data['rassi_moonsign'];
             $zodiac=$my_data['zodiac_starsign'];
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
         //var_dump($my_data);exit;
         if($other_religion=="" || $other_caste=="" )
         {
         // echo "hai";
            $new_data['other_religion']=""; 
            $new_data['other_caste']="";
            $new_data['religion']=$religion;
            $new_data['caste']=$caste;
            $new_data['star']=$star;
            $new_data['rassi_moonsign']=$rasi;
            $new_data['zodiac_starsign']=$zodiac;
         }
         else
         {
             $new_data['other_religion']= $other_religion; 
              $new_data['religion']="";
             $new_data['other_caste']= $other_caste; 
             $new_data['caste']="";
               $new_data['star']=$star;
            $new_data['rassi_moonsign']=$rasi;
            $new_data['zodiac_starsign']=$zodiac;
         }
          
          $profile=\ DB::table('user_profile')
                    ->where('user_id', '=', $id)
                    ->get(); 
           
            $count=count($profile);
    
         $profile_values=0;
            
         if ($count==0) 
        {
             $religious_info=\DB::table('user_profile')
                                    ->where('user_id', $id)
                                    ->insert($new_data); 
                                  }
            else
            {
          
                 $religious_info=\DB::table('user_profile')
                                  ->where('user_id', $id)
                                  ->update($new_data);
            } 
      
          $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;
         
            
        
        }
    public function postOtherreligion()
        {
       
            $my_data=Input::all();
        $id= \Session::get('id');
            $my_data['user_id'] = $id;
             
            $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
      
            if ($count==0)  
        {
            $other_rel=\DB::table('user_profile')
                              ->insert($my_data);  
      }          
            else
            {
           $other_rel=\DB::table('user_profile')
                               ->where('user_id', $id)
                               ->update($my_data);
            } 
      
            
        }
    
   public function getUpdatecaste()
    
    {
      
      $my_data=Input::all();

          $caste="";
          $selected_caste = '';
          
         if(isset($my_data['caste']))
            {
          $selected_caste = $my_data['caste'];
          }
        
         if(isset($my_data['rel_val']))
           {
           $rel_val=$my_data['rel_val'];  
       
                   
                    $return_religion=\ DB::table('caste')
                                      ->where('religion_id','=', $rel_val)
                                      ->get();
      
    
      $caste.='<option></option>';
      foreach($return_religion as $ret_caste)
        {
        $s = '';
        if($ret_caste->caste_id == $selected_caste) {
          $s = 'selected';
        }
        $caste.='<option '.$s.' value="'.$ret_caste->caste_id.'">'.$ret_caste->caste.'</option>';
        }     
           if($return_religion)
             {  
        echo $caste;
              }
          else
                {
        echo 0;
              }
           }
    }
     public function postOthercaste()
        {
       $my_data=Input::all();

       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
            $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 



           
            $count=count($profile);
            
           if ($count==0) 
        {
             $caste_othr=\DB::table('user_profile')
                                ->insert($my_data);  
      }          
            else
            {
           $caste_othr=\DB::table('user_profile')
                                ->where('user_id', $id)
                                ->update($my_data);
            } 
      
           
           
        }
    public function postOtherstar()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                    ->where('user_id', '=', $id)
                    ->get(); 
            
            $count=count($profile);
      
            if ($count==0)  
        {
             $star=\DB::table('user_profile')
                          ->insert($my_data);  
      }          
            else
            {
           $star=\DB::table('user_profile')
                          ->where('user_id', $id)
                          ->update($my_data);
            } 
      
           
        }
    
    public function postOthermoonsign()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
            
            $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
      
            if ($count==0)  
        {
             $moonsign=\DB::table('user_profile')
                             ->insert($my_data);  
      }          
            else
            {
           $moonsign=\DB::table('user_profile')
                             ->where('user_id', $id)
                             ->update($my_data);
            } 
      
           
        }
    
     public function postOtherzodiac()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
           
            $count=count($profile);
      
            if ($count==0)  
        {
             $otherzodiac=\DB::table('user_profile')
                                 ->insert($my_data);  
      }          
            else
            {
           $otherzodiac=\DB::table('user_profile')
                                ->where('user_id', $id)
                                ->update($my_data);
            } 
      
            
        }
    public function postLocation()
        {
        
       $my_data=Input::all();
        // var_dump($my_data);
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
      
            $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
        $profile_values=0;  
        
            if ($count==0)
        
        {
             $location=\DB::table('user_profile')
                              ->insert($my_data);   
            }
            else
            {
        $location=\DB::table('user_profile')
                           ->where('user_id', $id)
                           ->update($my_data); 
            }
         $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;
         
      
        }
    public function getCountry()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
      
            if ($count==0)
        
        {
             $country=\DB::table('user_profile')
                            ->insert($my_data);   
            }
            else
            {
        $country=\DB::table('user_profile')
                           ->where('user_id', $id)
                           ->update($my_data); 
            }
      
        }           
      public function postState()
                 {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
          $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
      
            if ($count==0)
        
        {
             $state=\DB::table('user_profile')
                           ->insert($my_data);   
            }
            else
            {
        $state=\DB::table('user_profile')
                       ->where('user_id', $id)
                       ->update($my_data); 
            }
      
        }
    
      
       public function postCity()
                 {
         $my_data=Input::all();
         $id= \Session::get('id');
       $my_data['user_id'] = $id;
             
               $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
      
            if ($count==0)
        
        {
             $city=\DB::table('user_profile')
                          ->insert($my_data);   
            }
            else
            {
        $city=\DB::table('user_profile')
                     ->where('user_id', $id)
                     ->update($my_data); 
            }
      
        }           
      public function postProfessionalinformation()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
            
            $count=count($profile);
          
          $profile_values=0;
          
            if ($count==0)
        
        {
             $prf_inf=\DB::table('user_profile')
                           ->insert($my_data);   
          
      }
            else
            {
           $prf_inf=\DB::table('user_profile')
                         ->where('user_id', $id)
                         ->update($my_data);
            }
          $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;
         
      
      
        }
    public function postEducation()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
           
            $count=count($profile);
      
            if ($count==0)
        
        {
             $education=\DB::table('user_profile')
                               ->insert($my_data);   
      }
            else
            {
           $education=\DB::table('user_profile')
                     ->where('user_id', $id)
                     ->update($my_data);
            }
      
        }
    public function postOccupation()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
          $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
         
            $count=count($profile);
            if ($count==0)
        
        {
             $occu=\DB::table('user_profile')
                         ->insert($my_data);   
      }
            else
            {
           $occu=\DB::table('user_profile')
                     ->where('user_id', $id)
                     ->update($my_data);
            }
      
        } 
    public function postFamilydetails()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
           
            $count=count($profile);
           
            $profile_values=0;
      
            if ($count==0)
        
        {
             $family_details=\DB::table('user_profile')
                                    ->insert($my_data);   
            }
            else
        {
        $family_details=\DB::table('user_profile')
                                 ->where('user_id', $id)
                                 ->update($my_data);
      } 
         $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;
         
      
      
    }
      
      public function postAboutmyfamily()
        {
       $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
             
           $profile=\ DB::table('user_profile')
                            ->where('user_id', '=', $id)
                            ->get(); 
           
            $count=count($profile);
            $profile_values=0;
    
            if ($count==0)
        
        {
             $abt_fmly=\DB::table('user_profile')
                                 ->insert($my_data);  
      }
            else
        {
        $abt_fmly=\DB::table('user_profile')
                    ->where('user_id', $id)
                    ->update($my_data);
            }
           $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;
         
      
    }
    public function getUpdatecountrystate()
    
    {
      
      $my_data=Input::all();
          $state="";
        
               if(isset($my_data['state_val']))
           {
           $state_val=$my_data['state_val'];
          
        
      $return_sta=\ DB::table('state')
                  ->where('country_id','=', $state_val)->get();
      
    
      $state.='<option></option>';
      
      foreach($return_sta as $ret_state)
      {
        $state.='<option value="'.$ret_state->state_id.'">'.$ret_state->state.'</option>';
      }     
       
      
      if($return_sta)
      { 
        echo $state;
      }
      else
        {
        echo 0;
      }
           }
    }
   public function getUpdatemoonsigns()
      {
      
      $my_data=Input::all();
          $rassi_moonsign="";
        
               if(isset($my_data['moonsign_val']))
           {
            $moonsign_val=$my_data['moonsign_val'];
          
        
      $return_moonsign=\ DB::table('rassi_moonsign')
                      ->where('star_id','=', $moonsign_val)
                            ->get();
      
      $rassi_moonsign.='<option></option>';
      
      
      foreach($return_moonsign as $ret_monsig)
      {
        
        $rassi_moonsign.='<option value="'.$ret_monsig->rassimoonsign_id.'">'.$ret_monsig->rassi_moonsign.'</option>';
      }     
       
      
      if($return_moonsign)
      { 
        echo $rassi_moonsign;
      }
      else
        {
        echo 0;
      }
           }
    }   
public function getDistrictupdates()
      {
      
      $my_data=Input::all();
          $state="";
        
               if(isset($my_data['district_val']))
           {
           $district_val=$my_data['district_val'];
          
        
      $return_distrct=\ DB::table('district')
                      ->where('state_id','=', $district_val)
                            ->get();
          
        
       
      $state.='<option></option>';      
      foreach($return_distrct as $ret_district)
      {
        $state.='<option value="'.$ret_district->district_id.'">'.$ret_district->district.'</option>';
      }     
       
      
      if($return_distrct)
      { 
        echo $state;
      }
      else
        {
        echo 0;
      }
           }
    } 
        public function postAutocomplet()
          {
            $sess= \Session::get('id');
            $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }
            
  if($sess)
     {
        if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
    return view::make('frontend.autocomplete');
         }
        else
        {
            return redirect('user/error-page');
        }
 
    } 
   
    public function getSearchresult()
  {
    $sess= \Session::get('id');
        $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

    $login=\ DB::table('user_reg')
            ->where(['id' => $sess])->get(); 
    foreach ($login as $user)
      {  
        $id=$user->id;
        
         
      }
    $s_data=$_GET['srch'];
    
   if($sess)
     {
  
         if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
         
     $dataget=\ DB::table('user_reg')
              ->join('user_profile','user_profile.user_id','=','user_reg.id')
              ->where('username','=', $s_data)->get(); 
     
    
    return view::make('frontend.searchresult', array('data' => $dataget));
         }
        else
        {
            return redirect('user/error-page');
        }
     
  }        
    public function getLogout()
  {
      $id= \Session::get('id');
    
    $online_status=\DB::table('user_reg')
             ->where('id',$id) 
             ->update(['status' =>'offline']);
             
 
      Session::flush();
      //return redirect('/');
      // Auth::logout();
      return redirect('/')->withCookie(Cookie::forget('soulmate'));
 
  }
  
  public function postUserfilter()
  {
    
    $id=\Session::get('id');
    $gender=\Session::get('gender');
    
    $matches=\DB::table('user_profile')
            ->where('user_id',$id)->get();
     foreach($matches as $match)
     {
         $caste=$match->caste;
         $state=$match->state;
         $religion=$match->religion;
     }
    
    $user_gender=trim($gender);
    $user_religion=trim($religion);
    $user_caste=trim($caste);
    $user_state=trim($state);

        

    $minage=18;
    $maxage=41;
    
    if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }
    $search_filter = Input::all();
    
    $query = \DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
          ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
          ->leftJoin('caste','caste.caste_id','=','user_profile.caste')
          ->leftJoin('state','state.state_id','=','user_profile.state')
          ->leftJoin('district','district.district_id','=','user_profile.district')
          ->leftJoin('education','education.education_id','=','user_profile.education')
          ->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
          ->where('user_reg.email_key','=',null)
           ->where('user_reg.deactivate_status','=','0')
          ->where('user_profile.profile_strength','>','59')
          ->where('user_reg.gender','=',$search_gender);

          //var_dump($query);exit;  
          
          //show matching profile of login user
    if(!isset($search_filter['religion']) and !isset($search_filter['caste']) and !isset($search_filter['state']) and !isset($search_filter['dob']) and !isset($search_filter['education']) and !isset($search_filter['district']) and !isset($search_filter['occupation']) and !isset($search_filter['other_religion']) and !isset($search_filter['other_caste']))
    {
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      
      $query = $query->where('user_profile.religion',$user_religion)
                     ->where('user_profile.caste',$user_caste)
                     ->where('user_profile.state',$user_state)
                     ->where('user_reg.gender','=',$search_gender)
                     ->whereBetween('user_reg.dob',[$mindate,$maxdate]);
             //var_dump($query);exit;       
             
    }  
    
    //filter section
     foreach($search_filter as $key=>$val)
      {
      //var_dump($key);
      //var_dump($val);
       if($key == 'other_caste') {
      $query = $query->where('user_profile.caste','=','');
                 }
    elseif ($key == 'other_religion') {
      $query = $query->where('user_profile.religion','=','');
                 }
    elseif($key == 'dob') {
      $minage=min($search_filter['dob']);
      $maxage=max($search_filter['dob'])+5;
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      
      $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);

                 }
     else {
       
       $query = $query->whereIn('user_profile.'.$key, $val);
      
          }

        }
     
   $results = $query->get();
  
   $response = '';
   
   if( !empty($results) ) 
  {
     foreach($results as $user)
     {
    $dob=$user->dob;
    $birthdate = new Carbon($dob);
    $today   = Carbon::now();
    $age = $birthdate->diff($today)->y;
    $id=$user->user_id;    
      
      $path=asset($user->path);
    
    if(empty($user->religion)){$user_religion= $user->other_religion;}else {
                          $user_religion=$user->religion;
                        }
             
             
             
       if(empty($user->caste))
        {
          $user_caste= $user->other_caste;
        }
        else {
            $user_caste=$user->caste;
                        }
      if($user->gender=="male"){$button_color="butn-interest-male";}
             else {$button_color="butn-interest-female";}
            
          if(empty($user->path)){$path= asset('assets/images/default_profile.jpg');}   
      
      
      $user_id=$user->user_id;
       $encrypted_id = base64_encode($user_id);      
      $sess = \Session::get('username');       
                        
      $interested= \DB::table('interests')
                     ->where('sender_name',$sess)
                     ->where('interested_member',$user_id)->get();
            $count= count($interested); 
            
             $button_text = 'INTEREST';
           if($count==1)
           {
             $button_text = 'INTERESTED';
           }
           $color='';
           if($button_text=="INTERESTED")
                {$color= "intrstd_clr";}
      
      $response .= ' <div class="col-md-4">
                     <div class="colum2">
               <p class="prfl-img"> <a href="search-profile-view/'.$encrypted_id.'"><img src="'.$path.'"/></a></p>
               <div class="personal-details">
               <p class="prfl-details">Name: '.$user->name.'</p>
               <p class="prfl-details">Age: '.$age.'</p> 
               <p class="prfl-details">Religion: '.$user_religion.'-'.$user_caste.'</p>
               <p class="prfl-details">Place: '. $user->district.','.$user->state.'</p>
               </div>
               <input type="button" class="interest intstd'.$user_id.' '.$button_color.' '.$color.' " value="'.$button_text.'"  intrst_id="'.$user->user_id.'">
               </div>
                     </div>';
         
      
     }
  }
  else
   {
    $response .= 'Sorry! No Results Found For Your Request.';
  }
  echo $response;
  
  }
  

  public function getSearch()
  {
      $id=\Session::get('id');
        $cookie = Cookie::get('soulmate');
    if($cookie) {
      $id = $cookie;
    }
    $gender=\Session::get('gender');
    
    $matches=\DB::table('user_profile')
            ->where('user_id',$id)->get();
    //var_dump($matches);
    foreach($matches as $match)
     {
        $caste=$match->caste;
         $state=$match->state;
         $religion=$match->religion;
     }
        if($id)
    {
      if($cookie){
      $sess1= \Session::put('id',$cookie);
          }
     $user_gender=trim($gender);
      $user_religion=trim($religion);
      $user_caste=trim($caste);
      $user_state=trim($state);

    
    $minage=18;
    $maxage=41;
    
    if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }
    $query = \DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
          ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
          ->leftJoin('caste','caste.caste_id','=','user_profile.caste')
          ->leftJoin('state','state.state_id','=','user_profile.state')
          ->leftJoin('district','district.district_id','=','user_profile.district')
          ->leftJoin('education','education.education_id','=','user_profile.education')
          ->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
          ->where('user_reg.email_key','=',null)
          ->where('user_reg.deactivate_status','=','0')
          ->where('user_profile.profile_strength','>','59')
          ->where('user_reg.gender','=',$search_gender);
          
         
          
        

          //show matching profile of login user

    if(!isset($_POST['religion']) and !isset($_POST['caste']) and !isset($_POST['state']) and !isset($search_filter['dob']) and !isset($search_filter['education']) and !isset($search_filter['district']) and !isset($search_filter['occupation']) and !isset($search_filter['other_religion']) and !isset($search_filter['other_caste']))
    {
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      
           $query = $query->where('user_profile.religion',$user_religion);
           $query = $query->where('user_profile.caste','=',$user_caste);
           $query = $query->where('user_profile.state','=',$user_state);
           $query =$query->where('user_reg.gender','=',$search_gender);
           $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);
        
    }  
    //var_dump($query->get());
        //exit(); 
    //filter section
     foreach($_POST as $key=>$val)
      {
       if($key == 'other_caste') {
      $query = $query->orWhere('user_profile.caste','=','');
                 }
    elseif ($key == 'other_religion') {
      $query = $query->orWhere('user_profile.religion','=','');
      
                 }
    elseif($key == 'dob') {
      $minage=min($_POST['dob']);
      $maxage=max($_POST['dob'])+5;
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      
      $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);
                 }
     else {
       $query = $query->whereIn($key, $val);
          }

        }
         
         $results= with(new notification)->headersearch();
         $results['users'] = $query->get();
         $results['chat_users'] = $this->userregvalues();
         
          
     return view::make('frontend.search',array('results'=>$results));
    }
    else
    {
       return redirect('user/error-page');
    }
    
  }
   function UserregValues()
  {
    
    $id=\Session::get('id'); 
    $gender=\Session::get('gender');
     $user_gender=$gender;
    
    if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }
    
    $query = \DB::table('user_reg')
                ->join('user_profile', 'user_profile.user_id', '=', 'user_reg.id')
                ->where('gender',$search_gender)
                ->where('deactivate_status','=','0')
                ->where('profile_strength','>=','59')
                ->where('user_id','!=',$id)->get();
    
    
    return $query;
      
   } 
  public function postInterestedmemberstatus()
  {
     $sess_int= \Session::get('username');
     $sender_id=\Session::get('id');
     $intrstd=Input::all();
    
     $intr_mem=$intrstd['intr_id'];
     //echo $intr_mem;
      $date=date('Y-m-d');
    
    $intrstd_ppl_notification_del=\DB::table('notification')
    ->where('intrst_status','=','1')
    ->where('r_id','=',$intr_mem)
    ->where('s_id','=',$sender_id)
    ->delete(); 
    
     $intrstd_people=\DB::table('interests')
                     ->where('sender_name',$sess_int)
                     ->where('interested_member',$intr_mem)->delete();
    
    
             
   if($intrstd_people)
    {
      echo 1;
      
    }
    else
    {
      echo 0;

    }        
  
  }
  public function postInterestedmember()
  {
     $sess_int= \Session::get('username');
     $senser_id=\Session::get('id');
     $intrstd=Input::all();
    
     $intr_mem=$intrstd['intr_id'];
     $date=date('Y-m-d');
     $intrstd_people=\DB::table('interests')
                      ->insert(['sender_id'=>$senser_id,'sender_name'=>$sess_int,'interested_member'=>$intr_mem,'intrst_status' => '1','date'=>$date]);
     
   
      $inst_tbl=\DB::table('interests')
              ->where('sender_name',$sess_int)->get();
     
    foreach($inst_tbl as $noti_inst)
    {
      $int_id=$noti_inst->id;
      $intrst_status=$noti_inst->intrst_status;
   
    }
     $dt = date("Y-m-d");
     $tm=date("H");
$intrstd_ppl_notification=\DB::table('notification')

                          ->where('id',$senser_id)
                            ->insert(['s_id'=>$senser_id,'r_id'=>$intr_mem,'intrst_id'=>$int_id,'date1'=>$dt,'tm'=>$dt,'intrst_status' => $intrst_status]);

    if($intrstd_people)
    {
      echo 1;
      

    }
    else
    {
      echo 0;

    }        
  
  }
     public function getProfileview()
   {
         $id= \Session::get('id');
         $cookie = Cookie::get('soulmate');
    if($cookie) {
      $id = $cookie;
    }
    $query=\DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
            ->leftJoin('religion', 'religion.religion_id', '=', 'user_profile.religion')
            ->leftJoin('caste', 'caste.caste_id', '=', 'user_profile.caste')
            ->leftJoin('star', 'star.star_id', '=', 'user_profile.star')
            ->leftJoin('rassi_moonsign','rassi_moonsign.rassimoonsign_id', '=', 'user_profile.rassi_moonsign')
            ->leftJoin('zodiac_starsign', 'zodiac_starsign.zodiac_starsign_id', '=', 'user_profile.zodiac_starsign')
              ->leftJoin('country', 'country.country_id', '=', 'user_profile.country_livingin')
            ->leftJoin('state', 'state.state_id', '=', 'user_profile.state')
            ->leftJoin('district', 'district.district_id', '=', 'user_profile.district')
            ->leftJoin('mother_tongue', 'mother_tongue.mother_tongue_id', '=', 'user_profile.mother_tongue')
            ->leftJoin('education', 'education.education_id', '=', 'user_profile.education')
            ->leftJoin('occupation', 'occupation.occupation_id', '=', 'user_profile.occupation')
          
                 ->where(['user_id' => $id])->get();
         if($id)
         {
             
          if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
       // $values['user_details']=$query->get();
           $header_results = with(new notification)->headersearch();
       $daily_recommendation= with(new dailyrecommendation)->dailyrecommendation();
             
            // var_dump($daily_recommendation);exit;
          $profile_strength=with(new profilestrength)->profilestrength($id);
             
     return View::make('frontend.profileview',array('users'=>$query,'results'=>$header_results,'recommendation'=>$daily_recommendation,'profile_str'=>$profile_strength));
         }
         else
         {
            return redirect('user/error-page'); 
         }
      }
    public function postUpdateBasicdetails()
        {
          
        $my_data=Input::all();
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
            
           $update_basicdetails=\DB::table('user_profile')
                                 ->where('user_id', $id)
                                 ->update($my_data);  
              
            if($update_basicdetails)
        
        {
               echo 1;
        }
              else
          {
             echo 0;
            }
     
        }
    public function postUpdateReligiousinformation()
        {
        $my_data=Input::all();

        //var_dump($my_data);
            $religion=$my_data['religion'];
             $other_religion=$my_data['other_religion'];
             $caste=$my_data['caste'];
             $other_caste=$my_data['other_caste'];
             $star=$my_data['star'];
             $rasi=$my_data['rassi_moonsign'];
             $zodiac=$my_data['zodiac_starsign'];
      $id= \Session::get('id');
          $my_data['user_id'] = $id;
             
        if($other_religion=="" || $other_caste=="" )
         {
           $new_data['other_religion']=""; 
            $new_data['other_caste']="";
            $new_data['religion']=$religion;
            $new_data['caste']=$caste;
            $new_data['star']=$star;
            $new_data['rassi_moonsign']=$rasi;
            $new_data['zodiac_starsign']=$zodiac;
         }
         else
         {
             $new_data['other_religion']= $other_religion; 
              $new_data['religion']="";
             $new_data['other_caste']= $other_caste; 
             $new_data['caste']="";
              $new_data['star']=$star;
            $new_data['rassi_moonsign']=$rasi;
            $new_data['zodiac_starsign']=$zodiac;
         }

        // echo $relig;exit;
          $editreligious_info=\DB::table('user_profile')
                              ->where('user_id', $id)
                              ->update($new_data);
                             // ->update(['religion'=>$religion,'other_religion'=>$other_religion,'caste'=>$caste,'other_caste'=>$other_caste,'star'=>$star,'rassi_moonsign'=>$rasi,'zodiac_starsign'=>$zodiac]);
          
          if($editreligious_info)
            {
             echo 1;
            }
            else
          {
             echo 0;
            }
        }
    public function postUpdateLocation()
        {
         $my_data=Input::all();
         //var_dump($my_data);exit;
       
       $id= \Session::get('id');
           $my_data['user_id'] = $id;
              
           $location=\DB::table('user_profile')
                     ->where('user_id', $id)
                     ->update($my_data);
                
                 if($location)
            {
             echo 1;
            }
            else
          {
             echo 0;
            }
        }
    public function postUpdateProfessionalinfo()
        {
        $my_data=Input::all();
      $id= \Session::get('id');
          $my_data['user_id'] = $id;
             
           $prf_info=\DB::table('user_profile')
                      ->where('user_id', $id)
                      ->update($my_data);
          if($prf_info)
        {
        echo 1;
            }
            else
          {
             echo 0;
            }
        }
    public function postUpdateFamilydetails()
        {
        $my_data=Input::all();
      $id= \Session::get('id');
          $my_data['user_id'] = $id;
             
           $family_dtls=\DB::table('user_profile')
                         ->where('user_id', $id)
                         ->update($my_data);
               if($family_dtls)
            {
             echo 1;
            }
            else
          {
             echo 0;
            }
        }
    public function postUpdateAboutmyfamily()
        {
                 $my_data=Input::all();
                 //var_dump($my_data);exit;
               $id= \Session::get('id');
             $my_data['user_id'] = $id;
            
           $abt_myfamily=\DB::table('user_profile')
                                 ->where('user_id', $id)
                                 ->update($my_data);
            if($abt_myfamily)
            {
             echo 1;
            }
            else{
             echo 0;
            }
      
        }
    public function getUpdateReligioncaste()
    
    {
       
      
      $my_data=Input::all();
          $caste="";
          $selected_caste = '';
          if(isset($my_data['caste'])) {
          $selected_caste = $my_data['caste'];
          }
       
               if(isset($my_data['rel_val']))
           {
           $rel_val=$my_data['rel_val'];  
      
                       $return_rel=\ DB::table('caste')
                              ->where('religion_id','=', $rel_val)
                                    ->get();
      
    
      $caste.='<option></option>';
      foreach($return_rel as $ret_caste)
      {
        $s = '';
        if($ret_caste->caste_id == $selected_caste) {
          $s = 'selected';
        }
        $caste.='<option '.$s.' value="'.$ret_caste->caste_id.'">'.$ret_caste->caste.'</option>';
      }     
      if($return_rel)
      { 
        echo $caste;
      }
      else
        {
        echo 0;
      }
           }
    }
  public function getUpdateReligioncast()
    
    {
      //echo "hi";
      $my_data=Input::all();
          $caste="";
          $selected_caste = '';
          if(isset($my_data['caste'])) {
          $selected_caste = $my_data['caste'];
          }
       
               if(isset($my_data['rel_val']))
           {
           $rel_val=$my_data['rel_val']; 

      $return_rel=\ DB::table('caste')
                  ->where('religion_id','=', $rel_val)
                  ->get();
      
    
      $caste.='<option></option>';
      foreach($return_rel as $ret_caste)
      {
        $s = '';
        if($ret_caste->caste_id == $selected_caste) {
          $s = 'selected';
        }
        $caste.='<option '.$s.' value="'.$ret_caste->caste_id.'">'.$ret_caste->caste.'</option>';
      }     
      if($return_rel)
      { 
        echo $caste;
      }
      else
        {
        echo 0;
      }
           }
    }
    public function getUpdateCountry()
    
    {
      
      $my_data=Input::all();
          $state="";
                    $selected_state = '';
        
               if(isset($my_data['state_val']))
           {
           $state_val=$my_data['state_val'];
          
        
      $return_sta=\ DB::table('state')
                   ->where('country_id','=', $state_val)
                         ->get();
      
    
      $state.='<option></option>';
      
      foreach($return_sta as $ret_state)
      {
        $s = '';
        if($ret_state->state_id == $selected_state) {
          $s = 'selected';
        }
        $state.='<option '.$s.' value="'.$ret_state->state_id.'">'.$ret_state->state.'</option>';
      }     
       
      
      if($return_sta)
      { 
        echo $state;
      }
      else
        {
        echo 0;
      }
           }
    }
    public function getUpdateMoonsign()
      {
      
      $my_data=Input::all();
          $rassi_moonsign="";
       
               if(isset($my_data['moonsign_val']))
           {
            $moonsign_val=$my_data['moonsign_val'];
          
        
      $return_starmoon=\ DB::table('rassi_moonsign')
                        ->where('star_id','=', $moonsign_val)->get();
      
      $rassi_moonsign.='<option></option>';
      
      
      foreach($return_starmoon as $ret_monsig)
      {
        
        $rassi_moonsign.='<option value="'.$ret_monsig->rassimoonsign_id.'">'.$ret_monsig->rassi_moonsign.'</option>';
      }     
       
      
      if($return_starmoon)
      { 
        echo $rassi_moonsign;
      }
      else
        {
        echo 0;
      }
           }
    }
    
    public function getUpdateDistrict()
      {
    
      $my_data=Input::all();
          $state="";
        
               if(isset($my_data['district_val']))
           {
           $district_val=$my_data['district_val'];
          
        
      $return_district=\ DB::table('district')
                    ->where('state_id','=', $district_val)
                          ->get();
         
        
       
      $state.='<option></option>';      
      foreach($return_district as $ret_district)
      {
        $state.='<option value="'.$ret_district->district_id.'">'.$ret_district->district.'</option>';
      }     
       
      
      if($return_district)
      { 
        echo $state;
      }
      else
        {
        echo 0;
      }
           }
    }
    public function getUpdateEducation()
    
    {
      
      $my_data=Input::all();
          $education="";
        
               if(isset($my_data['education_val']))
           {
           $education_val=$my_data['education_val'];  
      $return_education=\ DB::table('occupation')
                         ->where('education_id','=', $education_val)
                               ->get();
      
    
      $education.='<option></option>';
      
      foreach($return_education as $ret_educationoccupation)
      {

                $education.='<option value="'.$ret_educationoccupation->occupation_id.'">'.$ret_educationoccupation->occupation.'</option>';
      }     
      if($return_education)
      { 
        echo $education;
      }
      else
        {
        echo 0;
      }
           }
    }
    public function getSettings($settings_view)
  {
       $sess= \Session::get('id');
     $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

    
     if($sess)
     {
        if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
           
            $userid=\Session::get('id');
  $get_dtls=\DB::table('user_payment_details')
               ->leftJoin('user_profile','user_profile.user_id','=','user_payment_details.uid')
              ->leftJoin('packages','packages.id','=','user_payment_details.package_id')
               ->where('user_payment_details.uid',$userid)
              ->get();
               
       $header_results = with(new notification)->headersearch();
    
    return view('frontend.settings',array('results'=>$header_results,'delete_tab'=>$settings_view,'p_dtls'=>$get_dtls));
         }
        else
        {
            return redirect('user/error-page');
        }
     
  }
  public function postChangeEmail()
  {
    $id= \Session::get('id');
    $value=Input::all();
    $email=$value['email'];
       
      
        $email_value= \DB::table('user_reg')
             ->where('email',$email)
             ->get();
            
    $count= count($email_value);
    
    if($count==0)
    {
            
           
           $email_change=\DB::table('user_reg')
             ->where('id',$id) 
             ->update(['change_email'=>$email]);
            Mail::send('emails.change_email', array('email' => $email,'session_id'=>$id), function ($message) use($email)
                         {
                                $message->to($email, 'To')->subject('change email!');
                         }); 
    echo 1;
            
    }
    else
    {
      echo 0;
    }
  }
    public function getVerifyChangeMail()
    { 
  $verify_id=$_GET['session_id'];
  
        $verify_account = \ DB::table('user_reg')
            ->where('id',$verify_id)
            ->get();
        
        foreach($verify_account as $get_verify_accnt)
            {
            $id=$get_verify_accnt->id;
            $username=$get_verify_accnt->username;
              $gender=$get_verify_accnt->gender;
                      $change_email=$get_verify_accnt->change_email;
            }
            
        $count= count($verify_account);
            
        if($count == 1)   
    {
       $verified=\DB::table('user_reg')
             ->where('id',$verify_id) 
               ->update(['email'=>$change_email,'change_email'=>null]);
               
       if($verified)
              {
                $online_status=\DB::table('user_reg')
                                     ->where('id',$id) 
                                     ->update(['status' =>'online']);
         
                 \Session::put(['gender'=>$gender,'username'=>$username,'id'=>$id]); 
            
                
                 return redirect('user/settings/settings_view');
        }
        }
        else
          {
      return Redirect::to('user/error-page')->with('message', 'please verify your emailID');
       
          }
            
    }
    public function postChangepasswordSettings()
  {
    $id= \Session::get('id');
    $data=Input::all();
    
        $pas=$data['currentpassword'];
        $pass=base64_encode($pas);

    $query_changepwd = \ DB::table('user_reg')
            ->where('id',$id)
            ->where('password',$pass)
            ->get();
    $count= count($query_changepwd);
    
        if($count == 1)   
    {
      if($data['newpassword']==$data['confirmpassword'])
      {

        $a=$data['newpassword'];
         $b =base64_encode($a);

        $value = array('password'=>$b);
         //var_dump($value);exit;
        
         $chng_pwd=\DB::table('user_reg')
             ->where('id',$id) 
             ->update($value);
        if($chng_pwd)
        {
          echo 1; 
        }
        else
        {
          echo 0;
        }   
      }
      else
      {
        echo"newpassword and confirm password are  not correct";
      }
    }
    else
    {
      echo"currentpassword not correct";
    }
  }
   
    public function postDeactivateProfile()
  {
    $id= \Session::get('id');
    $data=Input::all();
    
    $deactivate_days=$data['days'];
    $date_t=date("Y-m-d");
        $date=date("Y-d-m", strtotime($date_t));
    
     $insert=\DB::table('user_reg')
               ->where('id',$id)
               ->update(['deactivate_status' =>1,'deactivate_days'=>$deactivate_days,'deactivation_date'=>$date]);
                   
        if($insert)
        {
          echo 1; 
        }
        else
        {
          echo 0;
        }   
  }
    public function postDeleteProfile()
  {
    $id= \Session::get('id');
  
    $user_details =\DB::table('user_reg')
                  ->join('user_profile', 'user_profile.user_id', '=', 'user_reg.id')
            ->where('user_id',$id)->get();
    $details=json_encode($user_details);        
          //var_dump($details);exit();
    $data=Input::all();
    $reason=$data['reason'];
    $source=$data['source'];
    $date_mrg=$data['date_of_mrg'];
    $experience=$data['experience'];
    $address=$data['address'];
         $date_del=date("Y-m-d");
      $date=date("Y-m-d", strtotime($date_del));
      $date_of_mrg=date("Y-m-d", strtotime($date_mrg));
        
        
    $prfl_ins=\DB::table('delete_user_profile')->insert(
    ['userid' =>$id,'deleted_date'=>$date,'reason'=>$reason,'source'=>$source,'date_of_mrg'=>$date_of_mrg,'experience'=>$experience,'address'=>$address,'user_details'=>$details]
         );
    if($prfl_ins)
    {
      echo 1;
      $del_user_reg=\DB::table('user_reg')
                     ->where('id',$id)
                    ->delete();
        $del_user_prf=\DB::table('user_profile')
                     ->where('user_id',$id)
                       ->delete();
    }
    else
    {
      echo 0;
    }
    
  }
     public function getContact($contact_view)
         {
          $sess= \Session::get('id');
         $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

        
        if($sess)
     {
            
            if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
          $header_results = with(new notification)->headersearch();
       
    return View::make('frontend.contact_and_feedback',array('results'=>$header_results,'feedback_tab'=>$contact_view));
             }
        else
     {
      return redirect('user/error-page'); 
         }   
         }
    
     public function getContactDetails()
     {
       $my_data=Input::all();
       
         $your_name = $my_data['your_name'];
           $phone = $my_data['phone'];
             $email = $my_data['email'];
           $messages = $my_data['message'];
         
         
             $id= \Session::get('id');
             $my_data['id'] = $id;
             
            $noti=\ DB::table('contact_details')
                            ->where('id', '=', $id)
                            ->get(); 
            
      $key=$email.$id;
            $count=count($noti);
      
            if ($count==0)  
        {
             $details=\DB::table('contact_details')
                              ->insert($my_data);    
        }
       else
        {
               $details=\DB::table('contact_details')
                              ->where('id', $id)
                              ->update($my_data);
               
        }
           
          if($details or $count==1)
                    {
                       echo 1;
             Mail::send('emails.contact', array('your_name' => $your_name,'phone' => $phone,'email' => $email,'messages' => $messages, 'user_key' => md5($key)), function ($message) use($email)
                         {
                                $message->to($email, 'To')->subject('contact_details!');
                         });
                    }
            else
          {
             echo 0;
            }
          
          Mail::send('emails.contact', array('your_name' => $your_name,'phone' => $phone,'email' => $email,'messages' => $messages, 'user_key' => md5($key)), function ($message) use($email)
                          {
                                 $message->to($email, 'To')->subject('contact_details!');
                          });
     }
     public function getFeedbackDetails()
     {
       $my_data=Input::all();
       
         $your_name = $my_data['your_namef'];
               $matrimony_id = $my_data['matrimony_idf'];
               $priority = $my_data['priority'];
               $groom_name = $my_data['groom_namef'];
           $suggestion_feedback = $my_data['suggestion_feedback'];
         $date= Carbon::today()->format('Y-m-d');
         
             $id= \Session::get('id');
             $my_data['id'] = $id;
             $noti=\ DB::table('feedback_details')
                            ->where('id', '=', $id)
                            ->get(); 
           
            $count=count($noti);
      
            if ($count==0)  
        {
             $feedback=\DB::table('feedback_details')->insert(['userid'=>$id,'your_namef'=>$your_name,'matrimony_idf'=>$matrimony_id,'priority'=>$priority,'groom_namef'=>$groom_name,'suggestion_feedback'=>$suggestion_feedback,'send_date'=>$date]);    
        }
       else
        {
              $feedback=\DB::table('feedback_details')->where('id', $id)->update(['userid'=>$id,'your_namef'=>$your_namef,'matrimony_idf'=>$matrimony_idf,'priority'=>$priority,'groom_namef'=>$groom_namef,'suggestion_feedback'=>$suggestion_feedback,'send_date'=>$date]);
               
        }
              if($feedback)
            {
             echo 1;
            }
            else
          {
             echo 0;
            }
     }
    
    public function getSuccessStories()
    {
        $sess= \Session::get('id');
        $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

        
        if($sess)
     {
            
            if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
        $header_results = with(new notification)->headersearch();
         $story_details= $this->successstorydetails();
        
        return View::make('frontend.success_stories',array('results'=>$header_results,'details'=>$story_details));
        }
        else
     {
      return redirect('user/error-page'); 
         }   
      
    }
   
    public function postInsertSuccessstory()
    {
       // echo "hai";exit;
    
    if(isset($_POST['dataAndImageForm']))  
       {  
    $value=Input::all();
      //var_dump($value);
        $bride_name=$value['bride_name'];
        $groom_name=$value['groom_name'];
        $user_matrimony_id=$value['user_matrimony_id'];
        $partners_matrimony_id=$value['partners_matrimony_id'];
        $email=$value['email'];
        $address=$value['address'];
        $mrg=$value['mrg_date'];
        $engagement=$value['engagement_date'];
        $country_livingin=$value['country_livingin'];
        $state=$value['state'];
        $contact_num=$value['contact_num'];
        $success_story=$value['success_story'];
         $id= \Session::get('id');
   

    
        $destinationPath = 'assets/success_stories'; // upload path
    
    
    $engagement_date = date("Y-m-d", strtotime($engagement));
        $mrg_date= date("Y-m-d", strtotime($mrg));
  
     $image_name = '';
     $fav_icon='';
          //var_dump($_FILES);exit;
    if ($_FILES['image']['name']) {
         
   
     $fileName = rand(11111,99999).'-'.$_FILES['image']['name']; // renaming image

       // var_dump($fileName);exit;
     // Input::file('images')->move($destinationPath, $fileName); // uploading file to given path
    $image_name=$destinationPath.'/'.$fileName ;

              $error=false;

              // if no errors and size less than 250kb
              if (! $_FILES['image']['error'] && $_FILES['image']['size']< 130 * 117) {
                  if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            
          
   
                      // new unique filename
                      $sTempFileName = 'assets/success_stories/'.$fileName;
   
                      // move uploaded file into cache folder
                      move_uploaded_file($_FILES['image']['tmp_name'], $sTempFileName);
   
                      // change file permission to 644
                      @chmod($sTempFileName, 0644);
   
                     }}
                /* }
                   else
                   {
                  
                        $error=true;
                   }*/

                 }
                     //}
    
            $image_names= $image_name;             
        
    
     $insert_stories=\DB::table('success_stories')->where(['email' => $email])
                ->count();
          //var_dump($insert_stories);
           
    if($insert_stories==0){
         $insertion=\DB::table('success_stories')->insert(
   ['id_user' =>$id,'bride_name'=>$bride_name,'groom_name'=>$groom_name,'user_matrimony_id'=>$user_matrimony_id,'partners_matrimony_id'=>$partners_matrimony_id,'email'=>$email,'address'=>$address,'mrg_date'=>$mrg_date,'engagement_date'=>$engagement_date,'country_livingin'=>$country_livingin,'state'=>$state,'contact_num'=>$contact_num,'success_story'=>$success_story,'images'=>$image_names]                                                         
                                        );
                    //var_dump($insertion);
                     
        if($insertion)
        {
          echo "success";
      //echo 1;
         }
        else
        {
          echo "error";
           //echo  0;
        } 
        }
        else
    {
      echo "email already exist";
      //echo 2;
    }
               }
  
     }
     function SuccessStoryDetails()
  {
     $details= \DB::table('success_stories')
                   ->join('user_reg', 'user_reg.id', '=', 'success_stories.id_user')
                       ->get();
            
    
     return $details;
  }
    public function getSearchProfileView($sender_id)
  {
    $sess= \Session::get('id');
    $encrypted_id= $sender_id;
    $id = base64_decode($encrypted_id);
    
    \Session::put('senderid',$encrypted_id);

    $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }
    
    $query=\DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
            ->leftJoin('religion', 'religion.religion_id', '=', 'user_profile.religion')
            ->leftJoin('caste', 'caste.caste_id', '=', 'user_profile.caste')
            ->leftJoin('star', 'star.star_id', '=', 'user_profile.star')
            ->leftJoin('rassi_moonsign','rassi_moonsign.rassimoonsign_id', '=', 'user_profile.rassi_moonsign')
            ->leftJoin('zodiac_starsign', 'zodiac_starsign.zodiac_starsign_id', '=', 'user_profile.zodiac_starsign')
              ->leftJoin('country', 'country.country_id', '=', 'user_profile.country_livingin')
            ->leftJoin('state', 'state.state_id', '=', 'user_profile.state')
            ->leftJoin('district', 'district.district_id', '=', 'user_profile.district')
            ->leftJoin('mother_tongue', 'mother_tongue.mother_tongue_id', '=', 'user_profile.mother_tongue')
            ->leftJoin('education', 'education.education_id', '=', 'user_profile.education')
            ->leftJoin('occupation', 'occupation.occupation_id', '=', 'user_profile.occupation')
          
                 ->where(['user_id' => $id])->get();

    
    if($sess)
     {
      if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
      
        $header_results = with(new notification)->headersearch();
              $daily_recommendation= with(new dailyrecommendation)->dailyrecommendation();
      
       
        return View::make('frontend.search_profile_view',array('users'=>$query,'results'=>$header_results,'recommendation'=>$daily_recommendation));  
   }

     else
     {
      return redirect('user/error-page'); 
         }   
         
       
     

    }
     public function getPaymentPlans()
   {
         $sess= \Session::get('id');
         $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

    if($sess)
     {
    if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
            
      $header_results = with(new notification)->headersearch();
         $upgrade= $this->upgrade();
     return View::make('frontend.payment_plans',array('results'=>$header_results,'packages'=>$upgrade));
        
        }
        else
     {
      return redirect('user/error-page'); 
         }  
   }
      
    
     function Upgrade()
   {
     
     $upgrade=\DB::table('packages')->get();
      return $upgrade;
   }
   
    public function postUploadImageFile()
  { 

     
       $my_data=Input::all();
     $id= \Session::get('id');
     
          $iWidth = $iHeight = 200; // desired image result dimensions
          $iJpgQuality = 90;
   
          if ($_FILES) {

              //if no errors and size less than 250kb
              if (! $_FILES['image_file']['error'] && $_FILES['image_file']['size'] < 250 * 1024) 
                  { 
                  if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {
            
          
   
                      // new unique filename
                      $sTempFileName = 'assets/profileimages/' . md5(time().rand());
   
                      // move uploaded file into 'profileimages' folder
                      move_uploaded_file($_FILES['image_file']['tmp_name'], $sTempFileName);
   
                      // change file permission to 644
                      @chmod($sTempFileName, 0644);
   
                      if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
                          $aSize = getimagesize($sTempFileName); // try to obtain image info
                          if (!$aSize) {
                              @unlink($sTempFileName);
                              return;
                                       }
   
                          // check for image type
                          switch($aSize[2]) {
                              case IMAGETYPE_JPEG:
                                  $sExt = '.jpg';
   
                                  // create a new image from file
                                  $vImg = @imagecreatefromjpeg($sTempFileName);
                                  break;
                              case IMAGETYPE_PNG:
                                  $sExt = '.png';
   
                                  // create a new image from file
                                  $vImg = @imagecreatefrompng($sTempFileName);
                                  break;
                              default:
                                  @unlink($sTempFileName);
                                  return;
                          }
   
                          // create a new true color image
                          $vDstImg = @imagecreatetruecolor( $iWidth, $iHeight );
   
   
   
   
   
                          // copy and resize part of an image with resampling
                          imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$_POST['x1'], (int)$_POST['y1'], $iWidth, $iHeight, (int)$_POST['w'], (int)$_POST['h']);
   
                          // define a result image filename
                          $sResultFileName = $sTempFileName . $sExt;
   
                          // output image to file
                          imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
                          @unlink($sTempFileName);
 
                            
    $insert_data['user_id'] = $id;
    
    $insert_data['path'] = $sResultFileName;  
    
            
          $profile_values = 0;
           
       
        $updatepath=\DB::table('user_profile')
                        ->where('user_id', $id)
                        ->update(['user_id'=>$id,'path'=>$sResultFileName,'img_status'=>0]);
     
      
      $sess= \Session::get('id');
            
          
          $profile_completeness=\ DB::table('user_profile')
                                   ->where(['user_id' => $sess])
                                   ->get();

        
               if(!empty($profile_completeness)) 
          {
            $profile_strength = $profile_completeness[0];
        if(!empty($profile_strength->body_type))
            {
                 $profile_values=$profile_values+10;         
            }
        if(!empty($profile_strength->path))
            {
                 $profile_values=$profile_values+10;         
            }
        
        }
      echo $profile_values;

        $im=\ DB::table('user_reg')
                      ->join('user_profile','user_profile.user_id','=','user_reg.id')
                      ->where('user_id' , $sess)
                      ->where('profile_strength','>','59')
                      ->count();

         
     if($im)
     {
           return redirect('user/profileview');
      //echo "success";
         }
         else
         {
          return redirect('user/profile');
         }
              
                      }
                  }
              } else
        {
                    
              //echo "error";     
          Session::flash('message', "upload image of size less than 250kb");
                    return redirect('user/profileview');
                 
        }
 
          
          
          }
        
      
  }
 
public function getLoginFailed()
{
    $sess= \Session::get('id');
     $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }
    
     if($sess)
     {
      
             if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
        return redirect('user/search' );
     }

     else
     {
    return View::make('frontend.login_failed');
         }
  }
public function getHighlightedProfileView($pk_id)
  {
  
    $sess_id=\Session::get('id');
      $id=$pk_id;
     \Session::put('packageid',$id);
    $b=\Session::get('packageid');
    //var_dump($b);exit;
        $a= base64_encode($b);
     $gender=\Session::get('gender');
          if($sess_id=="")
     {
          
              
        return redirect('/')->with('alert-danger', 'please sign in');
            
     }

     else
     {
       
     return redirect('user/search-profile-view/'.$a);
      
     }
  }
    public function getCheckPassword()
    {
    
     $my_data=Input::all();
  
 
             //echo $my_data['email'];
    /*  if(isset($my_data['email']))
      {
        */
       $email=$my_data['email'];
        
              $check_pswd=\DB::table('user_reg')
                           ->where(['email' => $email])
                           ->count();
     
     if($check_pswd)
     {
          
   
  $key = $email.time();
  
  
     
Mail::send('emails.forgot', array('email' => $email, 'user_key' => md5($key)), function ($message) use($email)
{
    $message->to($email, 'To')->subject('forgot password!');
});
     $update_key=\DB::table('user_reg')
             ->where('email',$email) 
             ->update(['email_key' =>md5($key)]); 
             
  echo 1;
     }
     else{
      
       
 echo 0;
       
       
  }
  //}     
    
  }
    public function getPasswordChangePage()
    {
        
    return View::make('frontend.change_password');   
  }
     public function getChangePswd()
    {
      
     
    $data=Input::all();
    
    if(isset($data['newpassword']))
    {
    $user_key=$data['user_key'];
      $newpassword=$data['newpassword'];
      $confirmpassword=$data['confirmpassword'];
    $query_changepwd = \ DB::table('user_reg')
            ->where('email_key',$user_key)
            ->get();
        if($query_changepwd)  {
          
       
     
      if($newpassword==$confirmpassword)
      {
        //$value = array('password'=>$data['newpassword']);
        $pass=base64_encode($newpassword);
         $chng_pwd=\DB::table('user_reg')
             ->where('email_key',$user_key) 
               ->update(['password' =>$pass,'email_key'=>null]);
        if($chng_pwd)
        {
          echo 1; 
        }
        else
        {
          echo 0;
        }   
      }
      else
      {
        echo 2;
      }
    }}
      
  }
    public function getAllNotificationResult()
    {
         $cookie = Cookie::get('soulmate');
    $sess= \Session::get('id');
    if($sess or $cookie)
      {
      if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
      
        $header_results = with(new notification)->headersearch();
        $daily_recommendation= with(new dailyrecommendation)->dailyrecommendation();
       
        
        return View::make('frontend.allnotification',array('results'=>$header_results,'recommendation'=>$daily_recommendation));
            }
      else
      {
        
            return redirect('user/error-page'); 

      }
    }
   public  function getDeleteNotification()
         {
         
         $my_data=Input::all();
         if($my_data)
         {
         $s_id=$my_data['del_noti'];
         
        $del_val=\DB::table('notification')
        ->where('id','=',$s_id)
        ->delete();
         
    return  $del_val;
       }
         }
 
    
     public function postProfileAutocomplete()
          {
            $sess= \Session::get('id');
            $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }
            
  if($sess)
     {
        if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
    return view::make('frontend.profile_autocomplete');
         }
        else
        {
            return redirect('user/error-page');
        }
 
    } 


public function anyMakepayment()
   {

       
    

        $data = Input::all();
              //var_dump($data);exit;
                 $package_name= $data['package_name'];
                 $period=$data['period'];
                 $price=number_format($data['rate'], 2,'.','');
                 $package_id=$data['package_id'];
                 $period=$data['period'];
                 $user_id=\Session::get('id');
                 $user_name=\Session::get('username');
                 Session::put('package_id',$package_id);
                 Session::put('period',$period);

           $params = array(
                     'cancelUrl'     => 'http://localhost/soulmate/Source/user/paymentfailed',
                     'returnUrl'     => 'http://localhost/soulmate/Source/user/paymentsuccess',
                     'name'        => $user_name,
                     'description'     => 'Soulmate upgrade',
                     'amount'     => "$price",
                     'currency'     => "AUD"
           );

           Session::put('params', $params);
           Session::save();

           $gateway = Omnipay::create('PayPal_Express');
           $gateway->setUsername('shajeermhmmd-facilitator_api1.gmail.com');
           $gateway->setPassword('WLNW9ZAZ67R39Z7Y');
           $gateway->setSignature('AiPC9BjkCyDFQXbSkoZcgqH3hpacAeGlrg4u9bfsrQbjCcxnzFSrEZ0x');

           $gateway->setTestMode(true);
           $response = $gateway->purchase($params)->send();
               if ($response->isSuccessful()) {

                

             

                   // payment was successful: update database
                   print_r($response);
           } elseif ($response->isRedirect()) {

                   // redirect to offsite payment gateway
                   $response->redirect();
           } else {
                 // payment failed: display message to customer
                 echo $response->getMessage();
           }
        //}

       }

   public function anyPaymentsuccess()
   {

    $get_gateway_details=\DB::table('settings')->get();
   // var_dump($get_gateway_details);
      foreach($get_gateway_details as $gateway)
      {
       $gateway_username=$gateway->payment_gateway_username;
        $gateway_password=$gateway->payment_gateway_password;
        $gateway_signature=$gateway->payment_gateway_signature;
        $payment_gateway_testmode=$gateway->payment_gateway_testmode;

      }                   


     $gateway = Omnipay::create('PayPal_Express');
     $gateway->setUsername($gateway_username);
     $gateway->setPassword($gateway_password);
     $gateway->setSignature($gateway_signature);
     $gateway->setTestMode($payment_gateway_testmode);
     $params = Session::get('params');
     $response = $gateway->completePurchase($params)->send();
     $paypalResponse = $response->getData();
     //var_dump($paypalResponse);
     if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
          
        $user_id=\Session::get('id');
        $user_name=\Session::get('username');
        $package_id=\Session::get('package_id');
        $prd=\Session::get('period');

       $ack=$paypalResponse['PAYMENTINFO_0_ACK'];
       $transaction_id=$paypalResponse['PAYMENTINFO_0_TRANSACTIONID'];
       $transaction_type=$paypalResponse['PAYMENTINFO_0_TRANSACTIONTYPE'];
       $payment_type=$paypalResponse['PAYMENTINFO_0_PAYMENTTYPE'];
       $datetime=$paypalResponse['PAYMENTINFO_0_ORDERTIME'];
       $amount=$paypalResponse['PAYMENTINFO_0_AMT'];
       $currency_code=$paypalResponse['PAYMENTINFO_0_CURRENCYCODE'];
       $payment_status=$paypalResponse['PAYMENTINFO_0_PAYMENTSTATUS'];
       $date=date('Y-m-d');


       
       
        $insert_database=\DB::table('user_payment_details')
                               
                                 ->insert(['uid'=>$user_id,'paid_date'=>$date,'username'=>$user_name,'package_id'=>$package_id,'period'=>$prd,'rate'=>$amount,'user_payment_status'=>'1','ack'=>$ack,'transaction_id'=>$transaction_id,'transaction_type'=>$transaction_type,'payment_type'=>$payment_type,'datetime'=>$datetime,'currency_code'=>$currency_code,'payment_status'=>$payment_status]);



         return redirect('user/payment-success-report');

         //echo "payment success";

      
     }
        else
        {
        return redirect('user/paymentfailed');

           }

   }
   public function anyPaymentSuccessReport()
   {
       
        $user_id=\Session::get('id');
  $get_report=\DB::table('user_payment_details')
               ->leftJoin('user_profile','user_profile.user_id','=','user_payment_details.uid')
              ->leftJoin('packages','packages.id','=','user_payment_details.package_id')
               ->where('user_payment_details.uid',$user_id)
              ->get();
             
                  



   return View::make('frontend.payment_success_report',array('get_report'=>$get_report));

   }
   public function anyPaymentfailed()
   {
      
   return View::make('frontend.payment_failed');
   }
   public function anyReportPrint()
   {
     /*$user_report=Input::all();
       
    $from=$user_report['date_from'];
    $to=$user_report['date_to'];
        
         $date_from = date("Y-m-d", strtotime($from));
     $date_to=date("Y-m-d", strtotime($to));
    
     
        
       $data= dailyrecommendation::whereBetween('date',[$date_from,$date_to])->get()->toArray();
      var_dump($data);exit;
         
         Excel::create('Filename', function($excel) use($data) {

         $excel->sheet('Sheetname', function($sheet) use($data) {

         $sheet->fromArray($data);

         });
             
      })->export('xls');*/
          
   }
    public function anySearchMessages()
   {
   $gender= \Session::get('gender');
   $user_gender=$gender;
  
 if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }
  $sess= \Session::get('senderid');
   $receiver_id = base64_decode($sess);
  $drop_down=\ DB::table('user_reg')
                ->leftJoin('user_profile','user_profile.user_id','=','user_reg.id')
                ->where(['user_id' => $receiver_id])
                ->where('deactivate_status','!=','1')
                ->where('user_reg.gender',$search_gender)
                ->get(); 

          //var_dump($drop_down);exit;  
   
   
    //var_dump($search_sent);exit;
     $sess= \Session::get('id');
         $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

        
        if($sess)
     {
            
            if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
       $header_results = with(new notification)->headersearch();
    $search_sent = $this->searchsentgetmessage();
    return View::make('frontend.search_messages',array('results'=>$header_results,'sentmessage'=>$search_sent,'drop_down'=>$drop_down));
     }
        else
     {
      return redirect('user/error-page'); 
         }   
   }
   function searchsentgetmessage()
  { 
    $sess= \Session::get('senderid');
    $receiver_id = base64_decode($sess);
 

 $gender= \Session::get('gender');
 $user_gender=$gender;
 
 if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }

    
    $dataget=\ DB::table('messages')
                ->leftJoin('user_profile','user_profile.user_id','=','messages.receiver_id')
                ->leftJoin('user_reg','user_reg.id','=','messages.receiver_id')
                ->where('messages.receiver_id' , $receiver_id)
                ->where('user_reg.gender','=',$search_gender)
                ->groupBy('messages.id') 
                ->get();
        
      return($dataget);      
  
  }
   public function anySearchSendMessage()
  {   
    $dt = date("Y-m-d ");
    $my_data=Input::all();
    //var_dump($my_data);
     
     // $r_id="";
      
     // array($r_id);
       $sess= \Session::get('senderid');
    $r_id = base64_decode($sess);
    // $r_id=$my_data['r_id'];
    $s_id=$my_data['s_id'];
    $msg=$my_data['msg'];
    
    $online_sta=\DB::table('user_reg')
                ->where(['id' =>$s_id])
                ->get();
           
      $online_stat=$online_sta[0];  
      
      $online_status=$online_stat->status;
   
    
       
    $msg_insert=\DB::table('messages')->insert(
       ['sender_id' => $s_id,'receiver_id' => $r_id, 'message'=>$msg,'message_date' => $dt,'online_status' => $online_status]
       );

if($msg_insert)
{
  echo 1;
}
else
{
  echo 0;
}
   
  
 }
  public function anySearchMessagesDelete()
   {
   $sess= \Session::get('senderid');
    $delete=Input::all();
   $id=$delete['id'];
  $date=date("Y-m-d");

   $deleted_msgs=\DB::table('messages')
                  ->where('messages.receiver_id','=',$id)
                  ->get();
                  //var_dump($deleted_msgs);exit;

   $dltd_msgs=json_encode($deleted_msgs);
   
   $prflins=\DB::table('deleted_messages')->insert(
    ['user_id' =>$sess,'deleted_date'=>$date,'chat_messages'=>$dltd_msgs]);

    
    if($prflins)
    {
      $del=\DB::table('messages')
          ->where('receiver_id',$id)
          ->delete();

   
    }
    else
    {
      echo 0;
    }
   }
 
   public function anyMessages()
   {

    
 $gender= \Session::get('gender');
 $user_gender=$gender;
  //var_dump($gender);
 if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }
  $drop_down=\ DB::table('user_reg')
                ->leftJoin('user_profile','user_profile.user_id','=','user_reg.id')
                ->where('deactivate_status','!=','1')
                ->where('user_reg.gender',$search_gender)
                ->get(); 
               //var_dump($drop_down);exit;
                
  


    
    //var_dump($deleted);exit;


          $sess= \Session::get('id');
         $cookie = Cookie::get('soulmate');
    if($cookie) {
      $sess = $cookie;
    }

        
        if($sess)
     {
            
            if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
      $header_results = with(new notification)->headersearch();
      $msg_get = $this->inboxmessagesget();
      $msg_get_sent = $this->sentgetmessage();
      $deleted=$this->deletedchatmessagesget();
      
      $data = array('results'=>$header_results,
            'message_get'=>$msg_get,
            'drop_down'=>$drop_down,
            'get_message_sent'=>$msg_get_sent,
            'dltd_msgs'=>$deleted);

   return View::make('frontend.messages',$data);
   }
        else
     {
      return redirect('user/error-page'); 
         }   
   }

 function InboxMessagesGet()
  {  
    $sess= \Session::get('id');
   $gender= \Session::get('gender');

    $dataget=\ DB::table('messages')
              ->leftJoin('user_profile','user_profile.user_id','=','messages.sender_id')
              ->leftJoin('user_reg','user_reg.id','=','messages.sender_id')
              //->leftJoin('chat','chat.sendr_id','=','messages.sender_id')
              ->select('*', 'messages.id as msgid')
              ->where(['receiver_id' => $sess])
              ->where('user_reg.gender','!=',$gender)
              ->groupBy('messages.id')          
              ->get(); 
        
            
      return($dataget);  
     
  
  }
  //sent box
 function sentgetmessage()
  { 
    $sess= \Session::get('id');
    $gender= \Session::get('gender');
    $user_gender=$gender;
  //var_dump($gender);
 if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }
    $datage=\ DB::table('messages')

                ->join('user_profile','user_profile.user_id','=','messages.receiver_id')
                ->leftJoin('user_reg','user_reg.id','=','messages.receiver_id')
               // ->leftJoin('chat','chat.sendr_id','=','messages.receiver_id')
                ->select('*', 'messages.id as messageid')
                ->where(['sender_id' => $sess])
               ->where('user_reg.gender','=',$search_gender)
               ->groupBy('messages.id') 
               ->get();
        
      return($datage);      
  
  }
    public function anySendMessage()
  {   
    $dt = date("Y-m-d ");
    $my_data=Input::all();
    // var_dump($my_data);exit;
      $r_id="";
      
      array($r_id);
     $r_id=$my_data['r_id'];
    $s_id=$my_data['s_id'];
    $msg=$my_data['msg'];

    
    $online_sta=\DB::table('user_reg')
                ->where(['id' =>$s_id])
                ->get();
                //var_dump($online_sta);exit;
    
      $online_stat=$online_sta[0];  
      
      $online_status=$online_stat->status;
    // var_dump($online_sta);
     
     foreach($r_id as $rid){
       
    $msg_insert=\DB::table('messages')
                             ->insert(
       ['sender_id' => $s_id,'receiver_id' => $rid, 'message'=>$msg,'message_date' => $dt,'online_status' => $online_status]
       );

    /*$msg_chat=\DB::table('chat')->insert(
       ['sendr_id' => $s_id, 'receivr_id' => $rid,'message'=>$msg,'sent' => $dt,'recd' => '1']
       );*/
  }
   if($msg_insert)
{
  echo 1;
}
else
{
  echo 0;
}
 }
  
   public function anyMessagesDelete()
   {
 $sess= \Session::get('id');
    $delete=Input::all();
   $id=$delete['id'];
  $date=date("Y-m-d");

   $deleted_msgs=\DB::table('messages')
                 // ->join('chat','chat.sendr_id','=','messages.sender_id')
                  ->where('messages.id','=',$id)
                  ->get();
                  //var_dump($deleted_msgs);exit;

   $dltd_msgs=json_encode($deleted_msgs);
   
   $prflins=\DB::table('deleted_messages')->insert(
    ['user_id' =>$sess,'deleted_date'=>$date,'chat_messages'=>$dltd_msgs]);

    
    if($prflins)
    {
      $del=\DB::table('messages')
          ->where('id',$id)
          ->delete();

   /* $del=\DB::table('chat')
          ->where('sendr_id',$id)
          ->delete();*/
     
          echo 1;
    }
    else
    {
      echo 0;
    }
   }
 function DeletedChatMessagesGet()
   {


 $sess= \Session::get('id');

   

    $del_msgs=\DB::table('deleted_messages')
                  ->where('user_id',$sess)
                 ->get();
   
        $num = count($del_msgs); 
      if($num>0){
        foreach ($del_msgs as $k_msgs) {
              
                $g_msg[]=$k_msgs->chat_messages;
                }   


     
  return ($g_msg);
} 
else {
  return null;
}


   }
    public function anySentMessagesDelete()
   {
    $sess= \Session::get('id');
    $delete=Input::all();
   $id=$delete['id'];
    $date=date("Y-m-d");

   $del_msgs=\DB::table('messages')
                  //->join('chat','chat.sendr_id','=','messages.sender_id')
                  ->where('messages.id','=',$id)
                  ->get();
                 // var_dump($del_msgs);exit;

   $deltd_msgs=json_encode($del_msgs);
  // var_dump($deltd_msgs);exit;
   
   $ins=\DB::table('sent_deleted_messages')->insert(
    ['uid' =>$sess,'deleted_date'=>$date,'message'=>$deltd_msgs]);

    
    if($ins)
    {
      $del=\DB::table('messages')
          ->where('id',$id)
          ->delete();

  /*  $del=\DB::table('chat')
          ->where('sendr_id',$id)
          ->delete();*/
     
          echo 1;
    }
    else
    {
      echo 0;
    }
   }
    public function anyErrorPage()
   {
     return View::make('frontend.404_page');
   }
 public function anyUserSearch()
  {
    $search_value=Input::all();
   // var_dump($search_value);
   $gender=$search_value['search_gender'];
   if(isset($_POST['religion']))
   {
   $religion=$search_value['religion'];
   }
   else
   {
    $religion="";
   }
  if(isset($_POST['caste']))
   {
   $caste=$search_value['caste'];
    }
   else
   {
    $caste="";
   }
   if(isset($_POST['state']))
   {
   $state=$search_value['state'];
   }
   else
   {
    $state="";
   }
   if(isset($_POST['district']))
   {
   $district=$search_value['district'];
   }
   else
   {
    $district="";
   }
   if(isset($_POST['dateob']))
   {
   $dob=$search_value['dateob'];
   }
   else
   {
    $dob="";
   }
    
    $religion_get= \DB::table('religion')
        ->where('religion', $religion)
        ->pluck('religion_id');

    $caste_get= \DB::table('caste')
        ->where('caste', $caste)
        ->pluck('caste_id');

    $state_get= \DB::table('state')
        ->where('state', $state)
        ->pluck('state_id'); 

    $district_get= \DB::table('district')
        ->where('district', $district)
        ->pluck('district_id');    
//var_dump($religion_get);
 \Session::put(['srch_gender'=>$gender,'srch_religion'=>$religion_get,'srch_caste'=>$caste_get,'srch_state'=>$state_get,'srch_district'=>$district_get,'srch_dob'=>$dob]); 
       

  if($search_value)
  {
  echo 1;
  }
  else
  {
    echo 0;
  }
 

  }
   public function getNotLoginSearch()
  {
   

       $user_gender=\Session::get('srch_gender');
   
      $user_caste=\Session::get('srch_caste');
      $user_state=\Session::get('srch_state');
      $user_religion=\Session::get('srch_religion');
    
       
     

    $minage=18;
    $maxage=41;
    
    if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }

    $query = \DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
          ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
          ->leftJoin('caste','caste.caste_id','=','user_profile.caste')
          ->leftJoin('state','state.state_id','=','user_profile.state')
          ->leftJoin('district','district.district_id','=','user_profile.district')
          ->leftJoin('education','education.education_id','=','user_profile.education')
          ->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
          ->where('user_reg.email_key','=',null)
          ->where('user_reg.deactivate_status','=','0')
          ->where('user_profile.profile_strength','>','59')
            ->where('user_reg.gender','=',$search_gender);
          
        //var_dump($query->get());  
//show matching profile of login user

    if(!isset($_POST['religion']) and !isset($_POST['caste']) and !isset($_POST['state']) and !isset($search_filter['dateob']))
    {
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
         if($user_religion)
         {
           $query = $query->where('user_profile.religion',$user_religion);
         }
         if($user_caste)
         {
           $query = $query->where('user_profile.caste','=',$user_caste);
         }
         if($user_state)
         {
           $query = $query->where('user_profile.state','=',$user_state);
         }
         if($search_gender)
         {
           $query =$query->where('user_reg.gender','=',$search_gender);
         }
         
           $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);
         
        
    }  
    //var_dump($query->get());
        //exit(); 

         
    //filter section
     foreach($_POST as $key=>$val)
      {
       if($key == 'other_caste') {
      $query = $query->orWhere('user_profile.caste','=','');
                 }
    elseif ($key == 'other_religion') {
      $query = $query->orWhere('user_profile.religion','=','');
      
                 }
    elseif($key == 'dob') {
      $minage=min($_POST['dateob']);
      $maxage=max($_POST['dateob'])+5;
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      
      $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);
                 }
     else {
       $query = $query->whereIn($key, $val);
          }

        }
         
        // $results= with(new notification)->headersearch();
         $results['users'] = $query->get();
       
         
          
     return view::make('frontend.search_not_login',array('results'=>$results));
    
   
    
  }
    public function postNotLoginUserfilter()
  {
    
    
     
       $user_gender=\Session::get('srch_gender');
   
      $user_caste=\Session::get('srch_caste');
      $user_state=\Session::get('srch_state');
      $user_religion=\Session::get('srch_religion');
    
       

    $minage=18;
    $maxage=41;
    
    if($user_gender=='male')
    {
      $search_gender="female";
    }
    else
    {
      $search_gender="male";
    }

    
    
    $search_filter = Input::all();
    
    $query = \DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
          ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
          ->leftJoin('caste','caste.caste_id','=','user_profile.caste')
          ->leftJoin('state','state.state_id','=','user_profile.state')
          ->leftJoin('district','district.district_id','=','user_profile.district')
          ->leftJoin('education','education.education_id','=','user_profile.education')
          ->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
          ->where('user_reg.email_key','=',null)
           ->where('user_reg.deactivate_status','=','0')
          ->where('user_profile.profile_strength','>','59')
            ->where('user_reg.gender','=',$search_gender);

          //var_dump($query);exit;  
          
          //show matching profile of login user
   

    if(!isset($_POST['religion']) and !isset($_POST['caste']) and !isset($_POST['state']) and !isset($search_filter['dob']) and !isset($search_filter['education']) and !isset($search_filter['district']) and !isset($search_filter['occupation']) and !isset($search_filter['other_religion']) and !isset($search_filter['other_caste']))
    {
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      if($user_religion)
         {
           $query = $query->where('user_profile.religion',$user_religion);
         }
         if($user_caste)
         {
           $query = $query->where('user_profile.caste','=',$user_caste);
         }
         if($user_state)
         {
           $query = $query->where('user_profile.state','=',$user_state);
         }
         if($search_gender)
         {
           $query =$query->where('user_reg.gender','=',$search_gender);
         }
         
          $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);
        
    }  
    //var_dump($query->get());
        //exit(); 
    
    //filter section
     foreach($search_filter as $key=>$val)
      {
      //var_dump($key);
      //var_dump($val);
       if($key == 'other_caste') {
      $query = $query->where('user_profile.caste','=','');
                 }
    elseif ($key == 'other_religion') {
      $query = $query->where('user_profile.religion','=','');
                 }
    elseif($key == 'dob') {
      $minage=min($search_filter['dob']);
      $maxage=max($search_filter['dob'])+5;
      $maxdate = date('Y-m-d', strtotime($minage . ' years ago'));
      $mindate = date('Y-m-d', strtotime($maxage . ' years ago'));
      
      $query = $query->whereBetween('user_reg.dob',[$mindate,$maxdate]);

                 }
     else {
       
       $query = $query->whereIn('user_profile.'.$key, $val);
      
          }

        }
     
   $results = $query->get();
  
   $response = '';
   
   if( !empty($results) ) 
  {
     foreach($results as $user)
     {
    $dob=$user->dob;
    $birthdate = new Carbon($dob);
    $today   = Carbon::now();
    $age = $birthdate->diff($today)->y;
    $id=$user->user_id;    
      
      $path=asset($user->path);
    
    if(empty($user->religion)){$user_religion= $user->other_religion;}else {
                          $user_religion=$user->religion;
                        }
             
             
             
       if(empty($user->caste))
        {
          $user_caste= $user->other_caste;
        }
        else {
            $user_caste=$user->caste;
                        }
      if($user->gender=="male"){$button_color="butn-interest-male";}
             else {$button_color="butn-interest-female";}
            
          if(empty($user->path)){$path= asset('assets/images/default_profile.jpg');}   
      
      
      $user_id=$user->user_id;
       $encrypted_id = base64_encode($user_id);      
      $sess = \Session::get('username');       
                        
      $interested= \DB::table('interests')
                     ->where('sender_name',$sess)
                     ->where('interested_member',$user_id)->get();
            $count= count($interested); 
            
             $button_text = 'INTEREST';
           if($count==1)
           {
             $button_text = 'INTERESTED';
           }
           $color='';
           if($button_text=="INTERESTED")
                {$color= "intrstd_clr";}
      
      $response .= ' <div class="col-md-4">
                     <div class="colum2">
               <p class="prfl-img"> <a href="login-failed"><img src="'.$path.'"/></a></p>
               <div class="personal-details">
               <p class="prfl-details">Name: '.$user->name.'</p>
               <p class="prfl-details">Age: '.$age.'</p> 
               <p class="prfl-details">Religion: '.$user_religion.'-'.$user_caste.'</p>
               <p class="prfl-details">Place: '. $user->district.','.$user->state.'</p>
               </div>
               <a href="login-failed"><input type="button" class="interest intstd'.$user_id.' '.$button_color.' '.$color.' " value="'.$button_text.'"  intrst_id="'.$user->user_id.'"></a>
               </div>
                     </div>';
         
      
     }
  }
  else
   {
    $response .= 'Sorry! No Results Found For Your Request.';
  }
  echo $response;
  
  }

  /*
  *chat
  *
  */
  public function anyChatContent()
    {

    $this->startChatSession();
    
    if (!isset($chatHistory)) {
       $chatHistory = array();  
       }
       
    if (!isset($openChatBoxes)) {
      $openChatBoxes = array(); 
      }
    }
    
  public function anyChatgetreadmsg() {
    $sess= \Session::get('username');
    $data = Input::all();
    $chatuser = $data['chatuser'];
  $_SESSION['username'] =  $sess;
  $query=\ DB::table('chat')
      ->where(function($q) use($chatuser){
        $q->where('from_user', $_SESSION['username'])
          ->where('to_user', $chatuser);
      })
      ->orWhere(function($qs) use($chatuser){
        $qs->where('from_user', $chatuser)
          ->where('to_user', $_SESSION['username']);
      })
      
      ->OrderBy('id', 'asc')->get();
      /*->where(['from_user' => $_SESSION['username'], 'to_user' => 'olu'])
      ->orWhere(['from_user' => 'olu', 'to_user' => $_SESSION['username']])
      
      ->where(function($q) {
        $q->where('to_user', $_SESSION['username'])
          ->where('from_user', 'olu');
      })*/
      
  $items = '';

  $chatBoxes = array();

  foreach ($query as $chat )
    {
    $msg_user = $chat->from_user;
    

    $chat->message =$this->sanitize($chat->message);

    $items .= '{
      "s": "0",
      "f": "'.$msg_user.'",
      "m": "'.$chat->message.'"
      
       } ,';

    
    }

    if (!empty($openChatBoxes)) 
    {
      foreach ($openChatBoxes as $chatbox => $time)
         {
    if (!isset($tsChatBoxes[$chatbox])) {
      $now = time()-strtotime($time);
      $time = date('g:iA M dS', strtotime($time));

      $message = "Sent at $time";
      if ($now > 180) {
        $items .= 
                  '{
            "s": "2",
            "f": "'.$chatbox.'",
            "m": "'.$message.'"
            },';
            
     if (!isset($chatHistory[$chatbox])) {
    $chatHistory[$chatbox] = '';
        }

       $chatHistory[$chatbox] .= '{
       "s": "2",
       "f": "'.$chatbox.'",
       "m": "'.$message.'"
       },';
       $tsChatBoxes[$chatbox] = 1;
    }
    }
    }
   }

  
  
  

  if ($items != '') {
    $items = substr($items, 0, -1);
      }
    header('Content-type: application/json');
    echo '{
    "items": [ '.$items.' ]
            }';

      exit(0);
    
  }
  public function anyChatHeartbeat()
    {
  
  $sess= \Session::get('username');
  $_SESSION['username'] =  $sess;
  $query=\ DB::table('chat')
      ->where('to_user',$_SESSION['username'])
      ->where('recd',0)
        ->OrderBy('id', 'asc')->get();
      
  $items = '';

  $chatBoxes = array();

  foreach ($query as $chat )
    {

    if (!isset($openChatBoxes[$chat->from_user]) && isset($chatHistory[$chat->from_user])) {
      $items = $chatHistory[$chat->from_user];
         }

    $chat->message =$this->sanitize($chat->message);

    $items .= '{
      "s": "0",
      "f": "'.$chat->from_user.'",
      "m": "'.$chat->message.'"
    
       } ,';

     if (!isset($chatHistory[$chat->from_user])) {
    $chatHistory[$chat->from_user] = '';
       }

      $chatHistory[$chat->from_user] .= '{
               {
      "s": "0",
      "f": "'.$chat->from_user.'",
      "m": "'.$chat->message.'"
         },';
    
    //unset($tsChatBoxes[$chat->from_user]);
     $openChatBoxes[$chat->from_user] = $chat->sent;
    }

    if (!empty($openChatBoxes)) 
    {
      foreach ($openChatBoxes as $chatbox => $time)
         {
    if (!isset($tsChatBoxes[$chatbox])) {
      $now = time()-strtotime($time);
      $time = date('g:iA M dS', strtotime($time));

      $message = "Sent at $time";
      if ($now > 180) {
        $items .= 
                  '{
            "s": "2",
            "f": "'.$chatbox.'",
            "m": "'.$message.'"
            },';
            
     if (!isset($chatHistory[$chatbox])) {
    $chatHistory[$chatbox] = '';
        }

       $chatHistory[$chatbox] .= '{
       "s": "2",
       "f": "'.$chatbox.'",
       "m": "'.$message.'"
       },';
       $tsChatBoxes[$chatbox] = 1;
    }
    }
    }
   }

  
  $query=\DB::table('chat')
           ->where('to_user',$_SESSION['username'])
       ->where('recd','=',0)
       ->update(array('recd' => 1));
  

  if ($items != '') {
    $items = substr($items, 0, -1);
      }
    header('Content-type: application/json');
    echo '{
    "items": [ '.$items.' ]
            }';

      exit(0);
   }

  public function anyChatBoxSession($chatbox)
    {
  
  $items = '';
  
  if (isset($chatHistory[$chatbox])) {
    $items = $chatHistory[$chatbox];
     }

  return $items;
    }

  function startChatSession()
    {
    $sess= \Session::get('username');
  $_SESSION['username'] =  $sess;
  $items = '';
  if (!empty($openChatBoxes)) {
    foreach ($openChatBoxes as $chatbox => $void) {
      $items .= chatBoxSession($chatbox);
    }


  if ($items != '') {
  }
    $items = substr($items, 0, -1);
  }

   header('Content-type: application/json');

   echo '{
    "username":"'. $_SESSION['username'].'",
    "items": ['.$items.']
      
        
         }';

  exit(0);
   }

  public function anySendChat() 
   {

  $sess= \Session::get('username');
  $_SESSION['username'] =  $sess;
  $from = $_SESSION['username'];
  $my_data=Input::all();
    $to = $my_data['to'];       
  //$to = $_POST['to'];
  $message = $my_data['message'];

  $openChatBoxes[$to] = date('Y-m-d H:i:s', time());
  
  $messagesan =$this-> sanitize($message);

  if (!isset($chatHistory[$to])) {
    $chatHistory[$to] = '';
  }

  $chatHistory[$to] .= '{
      "s": "1",
      "f": "{'.$to.'}",
      "m": "{'.$messagesan.'}"
     },';


  //unset($tsChatBoxes[$to]);

  
  
  $query=\DB::table('chat')->insert(
    ['from_user' => $from, 'to_user' => $to , 'message'=>$message,'sent'=>date('Y-m-d H:i:s')]
     );
  //$query = mysql_query($sql);
  echo "1";
  exit(0);
    }

   function closeChat() 
    {
    $my_value=Input::all();
    $chatbox = $my_value['chatbox'];  
  
//  unset($openChatBoxes[$chatbox]);
  
  echo "1";
  exit(0);
   }

 function sanitize($text) {
  $text = htmlspecialchars($text, ENT_QUOTES);
  $text = str_replace("\n\r","\n",$text);
  $text = str_replace("\r\n","\n",$text);
  $text = str_replace("\n","<br>",$text);
  return $text;
}
 
public function anyChatAutocomplete()
{
    
    return View::make('frontend.chatautocomplet');

}
 public function anyStatusUpdate()
  {
     $sess_st= \Session::get('id');
     
     $update_st=Input::all();
    
     $status=$update_st['stat'];
    
     $status_updatet=\DB::table('user_reg')
             ->where('id',$sess_st) 
             ->update(['status' => $status]);
             
  
  }
    public function anyChatuserProfileView()
  {

    
    //$id= \Session::get('id');
    $id= $_GET['user'];
    $cookie = Cookie::get('soulmate');
    if($cookie) {
      $id = $cookie;
    }
    
    $query=\DB::table('user_profile')
          ->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
            ->leftJoin('religion', 'religion.religion_id', '=', 'user_profile.religion')
            ->leftJoin('caste', 'caste.caste_id', '=', 'user_profile.caste')
            ->leftJoin('star', 'star.star_id', '=', 'user_profile.star')
            ->leftJoin('rassi_moonsign','rassi_moonsign.rassimoonsign_id', '=', 'user_profile.rassi_moonsign')
            ->leftJoin('zodiac_starsign', 'zodiac_starsign.zodiac_starsign_id', '=', 'user_profile.zodiac_starsign')
            ->leftJoin('country', 'country.country_id', '=', 'user_profile.country_livingin')
            ->leftJoin('state', 'state.state_id', '=', 'user_profile.state')
            ->leftJoin('district', 'district.district_id', '=', 'user_profile.district')
            ->leftJoin('mother_tongue', 'mother_tongue.mother_tongue_id', '=', 'user_profile.mother_tongue')
            ->leftJoin('education', 'education.education_id', '=', 'user_profile.education')
            ->leftJoin('occupation', 'occupation.occupation_id', '=', 'user_profile.occupation')
            ->where(['username' => $id])
            ->get();

         // var_dump($get_image);
        // exit;
 
 
    
    if($id)
     {
       if($cookie){
      $sess1= \Session::put('id',$cookie);
      }
      
   
        $header_results = with(new notification)->headersearch();
        $daily_recommendation= with(new dailyrecommendation)->dailyrecommendation();
       
      return View::make('frontend.search_profile_view',array('users'=>$query,'results'=>$header_results,'recommendation'=>$daily_recommendation));  
     
       
     }

     else
     {
     return redirect('user/error-page'); 
    }   
      
   
  }
  public function getNotLoginProfileView($id)
  {
  
    $sess_id=\Session::get('id');
      $user_id=$id;
     \Session::put('not_lg_id',$user_id);
    $b=\Session::get('not_lg_id');
    //var_dump($b);exit;
        $a= base64_encode($b);
     $gender=\Session::get('gender');
          if($sess_id=="")
     {
          
              
        return redirect('user/login-failed')->with('alert-danger', 'please sign in');
            
     }

     else
     {
       
     return redirect('user/search-profile-view/'.$a);
      
     }
  }
  public function postUserVisibilityPermission()
  {
      $sess=\Session::get('id');
    $data=Input::all();
    
    $visibility_values=json_encode($data);
//var_dump($visibility_values);exit;
    $insert_visibility=\DB::table('user_profile')
                        ->where('user_id',$sess)
                        ->update(['user_visibility'=>$visibility_values]);

     if($insert_visibility)  
     {
       echo 1;
     }
     else
     {
        echo 0;
     }                 

   
   
  }

  public function getHomeSuccessStories()
    {
        $story_details= \DB::table('success_stories')
                       ->join('user_reg', 'user_reg.id', '=', 'success_stories.id_user')
                       ->get();
        
       
        
        return View::make('frontend.home_success_stories',array('details'=>$story_details));
        
    }
     public function getHomeContact()
         {
         
       
    return View::make('frontend.home_contact_us');
            
         }
    
     public function getHomeContactDetails()
     {
       $my_data=Input::all();
       
         $your_name = $my_data['your_name'];
           $phone = $my_data['phone'];
             $email = $my_data['email'];
           $messages = $my_data['message'];
         
         $noti=\ DB::table('contact_details')
                            ->where('email', '=', $email)
                            ->get(); 
            
          
      $key=$email;
            
      $count=count($noti);
      
            if ($count==0)  
        {
             $details=\DB::table('contact_details')
                              ->insert($my_data);    
        }
       else
        {
               $details=\DB::table('contact_details')
                              ->where('email', '=', $email)
                              ->update($my_data);
               
        }
           
          if($details or $count==1)
                    {
                       echo 1;
             Mail::send('emails.contact', array('your_name' => $your_name,'phone' => $phone,'email' => $email,'messages' => $messages, 'user_key' => md5($key)), function ($message) use($email)
                         {
                                $message->to($email, 'To')->subject('contact_details!');
                         });
                    }
            else
          {
             echo 0;
            }
          
          Mail::send('emails.contact', array('your_name' => $your_name,'phone' => $phone,'email' => $email,'messages' => $messages, 'user_key' => md5($key)), function ($message) use($email)
                          {
                                 $message->to($email, 'To')->subject('contactdetails!');
                          });
     }
    public function getUpdateSocialmedia()
        {
       $my_data=Input::all();
     
     $facebook = $my_data['facebook'];
     $twitter = $my_data['twitter'];
     $google_plus = $my_data['google_plus'];
       
            
               $id= \Session::get('id');
           
         
           $v=\DB::table('user_profile')
              ->where('user_id', $id)
              ->update(['facebook' =>$facebook,'twitter' =>$twitter, 'google_plus' =>$google_plus]);
                 
            if($v)
            {
             echo 1;
            }
            else
          {   
             echo 0;
            }
      
        }

}