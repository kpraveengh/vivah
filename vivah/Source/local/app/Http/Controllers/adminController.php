<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\models\permission;
use Session;
use Carbon\Carbon;
use View;
use Input;
use Response;
use Excel;
use File;
use App\models\dailyrecommendation;
use Swift_Mailer;
use Flash;
use Notify;
use Redirect;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function getDashboard()
	{
       
      
       $get_reg_users_list=\DB::table('user_reg')
                            ->join('user_profile','user_profile.user_id','=','user_reg.id')
                            ->where('email_key','=',null)
                             ->orderBy('user_reg.id', 'asc')
                            ->limit(7)
                            ->get();
      // var_dump($get_reg_users_list);exit;
       
       $get_payment_list=\DB::table('user_payment_details')
                           ->join('user_profile','user_profile.user_id','=','user_payment_details.uid')
                           ->orderBy('user_payment_details.uid', 'asc')
                            ->limit(4)
                            ->get();
       
       $count_reg=\DB::table('user_reg')
                    ->where('email_key','=',null)
                    ->count();
       
        $count_agent=\DB::table('agent_reg')
                     ->count();
       
       
       $paid_count=\DB::table('user_payment_details')
                    ->where('user_payment_status','=','1')
                    ->count();
       
       
       
       $package_count=\DB::table('packages')
                        ->count();
       
       
       $total_payment=\DB::table('user_payment_details')
                      ->where('user_payment_status','=','1')
                      ->sum('rate');
       
       
       $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString(); 
       
       $start=date("Y-m-d", strtotime($startOfMonth));
        $end= date("Y-m-d", strtotime($endOfMonth));
       
        $monthly_payment=\DB::table('user_payment_details')
                      ->where('user_payment_status','=','1')
                      ->whereBetween('paid_date',[$start, $end] )
                       ->sum('rate');
       
      
        $from = Carbon::now()->startOfWeek()->toDateString(); 
        $till = Carbon::now()->toDateString();
	
      $fromDate=date("Y-m-d", strtotime($from));
     $tillDate= date("Y-m-d", strtotime($till));
       
       $weekly_payment=\DB::table('user_payment_details')
                      ->where('user_payment_status','=','1')
                       ->whereBetween('paid_date',[$fromDate, $tillDate] )
                       ->sum('rate');
       
       $today=date("Y-m-d");
       $today_payment=\DB::table('user_payment_details')
                      ->where('user_payment_status','=','1')
                      ->where('paid_date',$today)
                      ->sum('rate');
       
       
	  return View::make('backend.dashboard',array('reg_list'=>$get_reg_users_list,'paid_list'=>$get_payment_list,'reg_count'=>$count_reg,'agent_count'=>$count_agent,'count_paid'=>$paid_count,'count_package'=>$package_count,'total_revenue'=>$total_payment,'monthly_revenue'=>$weekly_payment,'today_revenue'=>$today_payment,'monthly_revenue'=>$monthly_payment));
	 
	}
    public function postAdminLogin()
   {
	  
	  $value=Input::all();
	  $username = $value['username'];
	  $pass = $value['password'];
	  
	  $password=base64_encode($pass);

        $login=\ DB::table('admin')
			  ->where('username',$username)
			  ->where('password',$password)
              ->get();
	  foreach($login as $sess)
	  {
		  $id=$sess->id;
          $role=$sess->role_id;
		  \Session::put(['adminid'=>$id,'login_role_id'=>$role]); 
	  
	  }	
        
		$roleid_log=\Session::get('login_role_id');
        
       
            
        
         $query=\ DB::table('role_permission')
                  ->join('role','role.r_id','=','role_permission.role_id')
                  ->where('role_id',$roleid_log)
                 ->get();
        foreach($query as $value)
        {
            $page_id=$value->page_id;
            \Session::put(['permission'=>$page_id]);
        }
        
        $user=\Session::get('permission');
        
	   if($login)
		{
		   echo $user;
		 }
	   else
		{
		   echo 1;
		 }
		  
	}
     public function getNewleyRegisteredMemList()
	{
         
         
	   $fromDate = Carbon::now()->startOfWeek()->toDateString();
	   $tillDate = Carbon::now()->toDateString();
	  
	  if(isset($_GET['n_gend_filt']))
		{
			$user=\DB::table('user_profile')
					->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
				    ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
					->leftJoin('caste','caste.caste_id','=','user_profile.caste')
					->leftJoin('education','education.education_id','=','user_profile.education')
					->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
			        ->whereBetween('date',[$fromDate, $tillDate] )
			        ->where('gender',$_GET['n_gend_filt'])
                    ->get();
	  
		}
		else
		{
			$user=\DB::table('user_profile')
					->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
				    ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
					->leftJoin('caste','caste.caste_id','=','user_profile.caste')
					->leftJoin('education','education.education_id','=','user_profile.education')
					->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
			        ->whereBetween('date',[$fromDate, $tillDate] )
                    ->get();
           
	  
		}
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
		  return View::make('backend.newley_registered_memberslist',array('data'=>$user));
		   
		     }
             else
             {
			return redirect('admin/not-admin');
		     }
		}
         else
         {
	    return redirect('admin/');
         }
         
       
	
	}

 public function postProfilePicApprove()
	{
	   $pic=Input::all();
	   $id=$pic['id'];
	 
	  $pic_stat_update=\DB::table('user_profile')
				        ->where('user_id',$id)
				        ->update(['img_status'=>'1']);
	   if($pic_stat_update)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
	  
	
	}  
	public function postNewUsersProfilepicCancel()
	{
       
	   $pic=Input::all();
	   $id=$pic['id'];
	
	  $img_stat_update=\DB::table('user_profile')
				->where('user_id','=',$id)
				->update(['img_status'=>'0']);
         
	   if($img_stat_update)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
     } 
     public function getAllUsersList()
	 { 
	  if(isset($_GET['gend_filt']))
		{
		$query=\DB::table('user_profile')
					->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
				    ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
					->leftJoin('caste','caste.caste_id','=','user_profile.caste')
					->leftJoin('education','education.education_id','=','user_profile.education')
					->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
                    ->leftJoin('district', 'district.district_id', '=', 'user_profile.district')
				    ->where('gender',$_GET['gend_filt'])
                    ->get();
		}
		else
		{
			$query=\DB::table('user_profile')
					->leftJoin('user_reg', 'user_reg.id', '=', 'user_profile.user_id')
				    ->leftJoin('religion','religion.religion_id','=','user_profile.religion')
					->leftJoin('caste','caste.caste_id','=','user_profile.caste')
					->leftJoin('education','education.education_id','=','user_profile.education')
					->leftJoin('occupation','occupation.occupation_id','=','user_profile.occupation')
                    ->leftJoin('district', 'district.district_id', '=', 'user_profile.district')
                    ->get();
				
		}
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
		return View::make('backend.all_users_list',array('data'=>$query));
             }
              else
             {
			return redirect('admin/not-admin');
		     }
		}
         else
         {
	    return  redirect('admin/');
         }
         
	 }
    
     public function postAllUsersProfilepicApprove()
	{
       
	   $pic=Input::all();
	   $id=$pic['id'];
	
	  $img_stat_update=\DB::table('user_profile')
				->where('user_id','=',$id)
				->update(['img_status'=>'1']);
         
	   if($img_stat_update)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
     }
      public function postAllUsersProfilepicCancel()
	{
       
	   $pic=Input::all();
	   $id=$pic['id'];
	
	  $img_stat_update=\DB::table('user_profile')
				->where('user_id','=',$id)
				->update(['img_status'=>'0']);
         
	   if($img_stat_update)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
     }
	  
    public function getAddAgent()
    {
        
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
            //var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
	  return View::make('backend.agentform');
                 
             }
            else
             {
                
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return  redirect('admin/');
         }
         
     }
    public function postAgentRegistration()
   {
	  $insert=Input::all();
	  $username= $insert['username'];
	  $password= $insert['password'];
	  $email= $insert['email'];
	  $address= $insert['address'];
      $company= $insert['company'];
	  $contact_num= $insert['contact_num'];
	  $added_user= $insert['added_user'];
	  $date= date("Y-m-d "); 

	  $email_check=\DB::table('agent_reg')->get();

	  foreach ($email_check as $uname) {
	    $u_name=$uname->username;
	    $a_email=$uname->email;
	  }
	  
     
	  
    
if($u_name!=$username)
   {
        
         
       if($a_email!=$email)
       {
            
           $agent_reg=\DB::table('agent_reg')->insert(['username'=> $username,'password'=>$password,'email'=>$email,'address'=>$address,'company'=>$company,'contact_num'=>$contact_num,'added_user'=>$added_user,'date'=>$date]);
           if($agent_reg)
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
             echo 3;
       }  
           

        
   } else
     {
         echo 2;

     }
   }
public function getAgentList()
    {
	  $agent_list=\ DB::table('agent_reg')
                    ->get();
	 
     foreach($agent_list as $agent )
	  {
		  $ag_id=$agent->id;
		  \Session::put('agent_id', $ag_id); 
	  
	  }
    
    $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
    
	  return View::make('backend.agent_list',array('data'=>$agent_list));
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }     
   }	
	
     public function postAgentApproval()
	{
	   $agnt=Input::all();
	   $id=$agnt['id'];
	 
	  $agnt_apprvl=\DB::table('agent_reg')
				->where('id',$id)
				->update(['agent_status'=>'1']);
	   if($agnt_apprvl)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
	  
	
	}
    public function getAgentListEdit($id)
	{
	  
	             $a=$id;
								
              $agent_edit=\ DB::table('agent_reg')
				          ->where(['id' => $a])
                          ->get();
					//var_dump($agent_edit);exit;	
        $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
					 
	  return View::make('backend.agent_edit_list',array('dtls'=>$agent_edit));
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return redirect('admin/');
         }          
                 
	 }
    public function postAgentUpdate()
	{
	   
	   $update_ag=Input::all();
	   $x=$update_ag['id'];
	  
	   $agent_updatet=\ DB::table('agent_reg')
					   ->where('id',$x) 
					   ->update($update_ag);
	  
	  if($agent_updatet)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
	}
	
    public function getAgentDelete()
	{
	  
	   $del=Input::all();
	   $id=$del['id'];
	  
	  $ag_del=\DB::table('agent_reg')
				->where('id',$id)
                ->delete();
	 if($ag_del)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	}
    public function getPackage()
	{
        $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
					
        
	  return View::make('backend.packageform');
                 
         }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }                
                 
	}
    public function postPackageAdd()
	{
	  $pckg=Input::all();
	    
        
        $package_name=$pckg['package_name'];
        $period=$pckg['period'];
        $rate=$pckg['rate'];
        
        $pkg_reg=\DB::table('packages')
                 ->insert(['package_name'=>$package_name]);
        
        $lastinsert_id=\DB::getPdo('packages')
                        ->lastInsertId();
       
	   if($pkg_reg)
	  {
           
           $pkg_reg=\DB::table('package_details')
               ->insert(['period'=>$period,'rate'=>$rate,'package_id'=>$lastinsert_id]);
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
	  
}
    public function getPackageList()
	{
		$pkg_list=\ DB::table('packages')
                    ->join('package_details','package_details.package_id','=','packages.id')
                    ->get();
	  foreach($pkg_list as $pkg )
	  {
		  $pkg_id=$pkg->id;
		  \Session::put('pckg_id', $pkg_id); 
	  
	  }
        
        
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
        
	  return View::make('backend.packagelist',array('data'=>$pkg_list));
                 
                 
         }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return  redirect('admin/');
         }                
                 
   }
     public function getPackageListEdit($id)
	{
	  
      $getid=$id;
	  $agent_edit=\DB::table('package_details')
                  ->join('packages','packages.id','=','package_details.package_id')
                  ->where('package_details.id', $getid)
                  ->get();
        
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
					 
	  return View::make('backend.package_list_edit',array('pckgdtls'=>$agent_edit,'getid'=>$getid));
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }               
                 
	 }
	  public function postPackageUpdate()
	{
	   
	   $update_pkg=Input::all();
          
        $package_name=$update_pkg['package_name'];
        $period=$update_pkg['period'];
        $rate=$update_pkg['rate'];
	    $pkgid=$update_pkg['pkgid'];
	    $formid=$update_pkg['id'];
          
         
          
          $package_updatet=\ DB::table('package_details')
					       ->where('package_details.id',$pkgid) 
					       ->update(['period'=>$period,'rate'=>$rate]);
          
        
	   
	  if($package_updatet)
	  {
         $package_updatet=\ DB::table('packages')
					       ->where('id',$formid) 
					       ->update(['package_name'=>$package_name]);
           
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  }
	}
     public function getPackageDelete()
	{
	  
	   $delete=Input::all();
	   $id=$delete['id'];
	  
	  $packgedel=\DB::table('packages')
				->where('id',$id)
                ->delete();
        
        
	 if($packgedel)
	  {
          $packgedel=\DB::table('package_details')
				        ->where('package_id',$id)
                        ->delete();
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	} 
     public function getAddCountry()
	{
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
					
	 		 
	  return View::make('backend.addcountry');
                 
             }
            else
             {
		return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return  redirect('admin/');
         }               
                      
                 
                 
	 }
    public function postInsertCountryNames()
    {
        $country=Input::all();
       
        $cntry=$country['country']; 
        $state=$country['state'];
        $district=$country['district'];
       // $statearray= explode(',', $state );
        $districtarray= explode(',', $district); 
        
        
        $add_country=\DB::table('country')
                     ->insert(['country'=>$cntry]);
       
        $getcountryid=\DB::getPdo('country')
                        ->lastInsertId();
            
         
       
        $add_country=\DB::table('state')
                      ->insert(['country_id'=>$getcountryid,'state'=>$state]);
        
       
        $getstateid=\DB::getPdo('state')
                        ->lastInsertId();
        foreach($districtarray as $district)
         {
         
         $add_country=\DB::table('district')
                      ->insert(['state_id'=>$getstateid,'district'=>$district]);
        
        }
    if($add_country)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 	
    }
     public function getPlaceList()
    {
        
        
        $place_list=\DB::table('state')
					   ->leftJoin('country', 'country.country_id', '=', 'state.country_id')
                      ->leftJoin('district', 'district.state_id', '=', 'state.state_id')
                       ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
        
         return View::make('backend.placelist',array('placelist'=>$place_list));
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }             
                 
    }
    
     public function getPlaceListEdit($id)
	{
	  
	             $district_id=$id;
								
              $place_edit=\DB::table('state')
					     ->leftJoin('country', 'country.country_id', '=', 'state.country_id')
                         ->leftJoin('district', 'district.state_id', '=', 'state.state_id')
				         ->where(['district.district_id' => $district_id])
                         ->get();
						
        
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {
					 
	  return View::make('backend.place_edit_form',array('place'=>$place_edit));
                 
                  }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }       
	 }
    
    public function postPlaceUpdate()
    {
      $placepost=Input::all();
        
     $country=$placepost['country']; 
     $state=$placepost['state']; 
     $district=$placepost['district']; 
     $countryid=$placepost['countryid']; 
     $stateid=$placepost['stateid']; 
     $districtid=$placepost['districtid']; 
        
        
    $place_update=\DB::table('country')
                   ->where('country_id',$countryid)
                   ->update(['country'=>$country]);
    
    $place_update=\DB::table('state')
                   ->where('state_id',$stateid)
                   ->update(['state'=>$state]);
        
    $place_update=\DB::table('district')
                   ->where('district_id',$districtid)
                   ->update(['district'=>$district]);    
        
    if($place_update)
    {
        
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
    
 public function getPlaceDelete()
	{
	  
	   $delete=Input::all();
    // var_dump($delete);exit;
	   $getid=$delete['id'];
	  
	 /* $placedel=\DB::table('state')
					     ->leftJoin('country', 'country.country_id', '=', 'state.country_id')
                         ->leftJoin('district', 'district.state_id', '=', 'state.state_id')
				         ->where(['district.district_id' => $districtid])
                         ->delete();*/
     
         $placedel=\DB::table('state')
                    ->where(['state_id' => $getid])
                     ->delete();
      
     $placedel=\DB::table('district')
                    ->where(['district.state_id' => $getid])
                     ->delete();
        
	 if($placedel)
	  {
         
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	}  
    
    
    public function getUserReport()
    {
        
        
     $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             {    
        
        
     return View::make('backend.user_report');  
                 
              }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }            
                 
    }
     
    
   
    
    public function postUserReportDetails()
	{
		$user_report=Input::all();
       
		$from=$user_report['date_from'];
		$to=$user_report['date_to'];
        
         $date_from = date("Y-m-d", strtotime($from));
		 $date_to=date("Y-m-d", strtotime($to));
	 	
        
     //dailyrecommendation
      // $data= dailyrecommendation::whereBetween('date',[$date_from,$date_to])->get()->toArray();
       // var_dump($x);
          /*$user_rep_dtls = \DB::table('user_reg')
				         ->whereBetween('date',[$date_from,$date_to])
                         ->get();
           var_dump($unvar_dump_result);exit;*/
         
  
         
        // $unvar_dump_result=$this->unvar_dump($user_rep_dtls);
         
         
         
         
         
          //var_dump($user_rep_dtls);exit;
        
           
       /* $data = array();
     
          foreach($user_rep_dtls as $result)
        {
            $a=$result->username ; $b=$result->email;
               $result->username = 'some modification';
               $result->email = 'some modification2';
               $data[] = (array)$result;  
         
            
        }
       
       // var_dump($data);exit;*/
        
         $data = array(
    array('data1', 'data2'),
    array('data3', 'data4')
);
       
         
         Excel::create('Filename', function($excel) use($data) {

         $excel->sheet('Sheetname', function($sheet) use($data) {

         $sheet->fromArray($data);

         });
             
      })->download('xls');
					
     
   /*      
	if($user_rep_dtls) 
    { 
        echo 1; 
    } 
     else
         { 
             echo 0; 
         }
    */
    }
     public function getUserPaymentList()
    {
    $paid_user_list=\DB::table('user_payment_details')
					->leftJoin('user_reg', 'user_reg.id', '=', 'user_payment_details.uid')
                    ->leftJoin('packages', 'packages.id', '=', 'user_payment_details.package_id')
                    ->where('user_payment_status','=','1')
                    ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
     return View::make('backend.user_payment_list',array('paidlist'=>$paid_user_list)); 
                 
              }
            else
             {
		return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return redirect('admin/');
         }            
                 
    }
    
    
    public function getAddReligion()
    {
          
      $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
     return View::make('backend.addreligion');  
                 
                  }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }        
    }
    
     public function postInsertReligion()
    {
         
         $religion_data=Input::all();
       
        $religion=$religion_data['religion'];
       
        $add_religion=\DB::table('religion')
                       ->insert(['religion'=>$religion]);
        
         
         
         if($add_religion)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 	
     }
    
   
     public function getReligionList()
    {
        
        
        $religion_list=\DB::table('religion')
                         ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
        
         return View::make('backend.religionlist',array('list'=>$religion_list));  
                 
             
                  }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }             
                 
        
    }
     public function getReligionListEdit($religionid)
    {
        
        $religion_id=$religionid;
         
        $religionedit_list=\DB::table('religion')
                      ->where('religion_id',$religion_id)
                      ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
        
        
         return View::make('backend.religionedit_form',array('rel_list'=>$religionedit_list));  
            
               }
            else
             {
		return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }             
                      
                 
    }
    
    
    public function postReligionUpdate()
    {
      $religionpost=Input::all();
      
     $religion=$religionpost['religion']; 
      $religionid=$religionpost['religionid']; 
        
        
    $religion_update=\DB::table('religion')
                   ->where('religion_id',$religionid)
                   ->update(['religion'=>$religion]);
    
   
   
      
    if($religion_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
    
     public function getReligionDelete()
	{
	  
	   $delete=Input::all();
   
       $religionid=$delete['id'];
	
         
       
         $religiondel=\DB::table('religion')
                      ->where('religion_id',$religionid)
                      ->delete();
         
       
        
	 if($religiondel)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	}  
      public function getAddCaste()
    {
          
      $religion=\DB::table('religion')
                      ->get();
          
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
          
          
     return View::make('backend.addcaste',array('religion'=>$religion)); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }               
                 
    }
    
    public function postInsertCaste()
    {
         
        $caste_data=Input::all();
    
        $religion_id=$caste_data['religion_id'];
        $caste=$caste_data['caste'];
        $castearray= explode(',',$caste);
       
        
         foreach($castearray as $caste)
         {
       
        $add_caste=\DB::table('caste')
                       ->insert(['religion_id'=>$religion_id,'caste'=>$caste]);
        
         }
         
    if($add_caste)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 	
     }
    public function getCasteList()
    {
        
        
        $caste_list=\DB::table('caste')
					  ->leftJoin('religion', 'religion.religion_id', '=', 'caste.religion_id')
                      ->get();
        
        
        
        $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
          
        
     return View::make('backend.castelist',array('castelist'=>$caste_list)); 
                 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }               
                 
                 
        
    }
     public function getCasteListEdit($casteid)
    {
        
        $caste_id=$casteid;
         
        $casteedit_list=\DB::table('caste')
                      ->where('caste_id',$caste_id)
                      ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
          
        
         return View::make('backend.casteeditform',array('caste_list'=>$casteedit_list)); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }            
                 
    }
    
    public function postCasteUpdate()
    {
      $castepost=Input::all();
      
     $caste=$castepost['caste']; 
      $casteid=$castepost['casteid']; 
        
        
    $caste_update=\DB::table('caste')
                   ->where('caste_id',$casteid)
                   ->update(['caste'=>$caste]);
    
   
   
      
    if($caste_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
     public function getCasteDelete()
	{
	  
	   $delete=Input::all();
   
       $casteid=$delete['casteid'];
	
         
       
         $religiondel=\DB::table('caste')
                      ->where('caste_id',$casteid)
                      ->delete();
         
       
        
	 if($religiondel)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	} 
      public function getAddStar()
    {
      
           $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
     
     return View::make('backend.addstar'); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }            
                 
                 
    }
      public function postInsertStar()
    {
         
         $star_data=Input::all();
       
        $star=$star_data['star'];
       
        $add_star=\DB::table('star')
                       ->insert(['star'=>$star]);
        
         
         
         if($add_star)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 	
     }
 public function getStarList()
    {
        
        
        $star_list=\DB::table('star')
                      ->get();
     
     
      $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
     
        
         return View::make('backend.star_list',array('starlist'=>$star_list));   
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }          
                 
    }
   
     public function getStarListEdit($star_id)
    {
        
        $starid=$star_id;
         
        $staredit_list=\DB::table('star')
                      ->where('star_id',$starid)
                      ->get();
         
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
     
        
         return View::make('backend.star_edit_form',array('starlist'=>$staredit_list));
                 
             }
            else
             {
			redirect('admin/not-admin');
		     }
		  }
         else
         {
	     redirect('admin/');
         }               
                 
    } 
     public function postStarUpdate()
    {
      $starvaluet=Input::all();
      
     $star=$starvaluet['star']; 
     $starid=$starvaluet['starid']; 
     
        
    $star_update=\DB::table('star')
                   ->where('star_id',$starid)
                   ->update(['star'=>$star]);
    
   
   
   
         
    if($star_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
     public function getStarDelete()
	{
	  
	   $delete=Input::all();
   
	   $getid=$delete['id'];
	  
	  $stardel=\DB::table('star')
                      ->where('star_id',$getid)
                      ->delete();
         
       
        
        
	 if($stardel)
	  {
           $religiondel=\DB::table('rassi_moonsign')
                      ->where('rassi_moonsign.star_id',$getid)
                      ->delete();
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	} 
    public function getAddRasi()
    {
          
      $star=\DB::table('star')
                      ->get();
        
     $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
        
     return View::make('backend.addrasi',array('star'=>$star)); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }             
                 
    }
    
     public function postInsertRasi()
    {
         
        $rasi_data=Input::all();
    
        $star_id=$rasi_data['star_id'];
        $rasi=$rasi_data['rasi'];
        $rasiarray= explode(',',$rasi);
       
        
         foreach($rasiarray as $rasi)
         {
       
        $add_rasi=\DB::table('rassi_moonsign')
                       ->insert(['star_id'=>$star_id,'rassi_moonsign'=>$rasi]);
        
         }
         
    if($add_rasi)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 	
     }
    public function getRasiList()
    {
        
        
        $rasi_list=\DB::table('rassi_moonsign')
					  ->leftJoin('star', 'star.star_id', '=', 'rassi_moonsign.star_id')
                      ->get();
        
        
        $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
        
        
     return View::make('backend.rasilist',array('rasilist'=>$rasi_list)); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return  redirect('admin/');
         }           
                 
        
    }
    
     public function getRasiListEdit($rasiid)
    {
        
        $rasi_id=$rasiid;
         
        $rasi_edit_list=\DB::table('rassi_moonsign')
                      ->where('rassimoonsign_id',$rasi_id)
                      ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
        
        
         return View::make('backend.rasieditform',array('rasi_list'=>$rasi_edit_list)); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }             
                 
    }
    
    public function postRasiUpdate()
    {
      $rasipost=Input::all();
      
     $rasi=$rasipost['rasi']; 
      $rasi_id=$rasipost['rasi_id']; 
        
        
    $rasi_update=\DB::table('rassi_moonsign')
                   ->where('rassimoonsign_id',$rasi_id)
                   ->update(['rassi_moonsign'=>$rasi]);
    
   
   
      
    if($rasi_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
     public function getRasiDelete()
	{
	  
	   $rasi=Input::all();
   
       $rasi_id=$rasi['rasi_id'];
	
         
       
         $rasi_del=\DB::table('rassi_moonsign')
                      ->where('rassimoonsign_id',$rasi_id)
                      ->delete();
         
       
        
	 if($rasi_del)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	} 
    
      public function getAddZodiac()
    {
          
     
    $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
               
          
     return View::make('backend.addzodiac'); 
            }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }             
                 
    }
    public function postInsertZodiac()
    {
         
         $zodiac_data=Input::all();
       
        $zodiac=$zodiac_data['zodiac'];
       
        $add_zodiac=\DB::table('zodiac_starsign')
                       ->insert(['zodiac_starsign'=>$zodiac]);
        
         
         
     if($add_zodiac)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 	
     }
    
     public function getZodiacList()
    {
        
        
        $zodiac_list=\DB::table('zodiac_starsign')
                         ->get();
        
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
                
         
         return View::make('backend.zodiaclist',array('zodiac_list'=>$zodiac_list)); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }            
                 
        
    }
     public function getZodiacListEdit($zodiac_id)
    {
        
        $zodiacid=$zodiac_id;
         
        $zodiac_list=\DB::table('zodiac_starsign')
                       ->where('zodiac_starsign_id',$zodiacid)
                       ->get();
         
         
          $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
                
        
         return View::make('backend.zodiac_edit_form',array('zodiaclist'=>$zodiac_list));
                 
             }
            else
             {
		return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return redirect('admin/');
         }            
                      
                 
    } 
    
     public function postZodiacUpdate()
    {
      $zodiacvalue=Input::all();
      
     $zodiac=$zodiacvalue['zodiac']; 
     $zodiac_id=$zodiacvalue['zodiac_id']; 
      
    $zodiac_update=\DB::table('zodiac_starsign')
                    ->where('zodiac_starsign_id',$zodiac_id)
                   ->update(['zodiac_starsign'=>$zodiac]);
    
   
   
    
         
    if($zodiac_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
    
     public function getZodiacDelete()
	{
	  
	   $zodiac=Input::all();
   
	   $getid=$zodiac['id'];
	  
	  $zodiac_del=\DB::table('zodiac_starsign')
                    ->where('zodiac_starsign_id',$getid)
                      ->delete();
         
       
        
        
	 if($zodiac_del)
	  {
           
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	} 
    
     public function getAddEducation()
    {
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
         
         return View::make('backend.addeducation'); 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }            
                        
                 
    }
     public function postInsertEducation()
    {
         
        $edu_data=Input::all();
       
        $education=$edu_data['education'];
        $occupation=$edu_data['occupation'];
       
         $occupationarray= explode(',', $occupation );
        
        $add_education=\DB::table('education')
                       ->insert(['education'=>$education]);
        
         $geteducationid=\DB::getPdo('education')
                        ->lastInsertId();
          
         foreach($occupationarray as $occupation)
         {
         $add_education=\DB::table('occupation')
                        ->insert(['education_id'=>$geteducationid,'occupation'=>$occupation]);
          }
         
    if($add_education)
	  {
          
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 
     }
     public function getEducationList()
    {
        
           
        $education_list=\DB::table('occupation')
					   ->join('education', 'education.education_id', '=', 'occupation.education_id')
                       ->get();
        
         
         $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
         
       
         return View::make('backend.educationlist',array('edulist'=>$education_list));  
                 
          }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	     return redirect('admin/');
         }                     
                 
    }
      
    
    
     
 
    
    public function getEducationListEdit($edu_id)
    {
        
        $eduid=$edu_id;
         
        $education_list=\DB::table('occupation')
					   ->join('education', 'education.education_id', '=', 'occupation.education_id')
                       ->where('occupation_id',$eduid)
                       ->get();
        
        
        $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
         
       
        
         return View::make('backend.education_edit_form',array('edulist'=>$education_list));
                 
                 
             }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return redirect('admin/');
         }            
                     
                 
                 
    } 
    
     public function postEducationUpdate()
    {
      $eduvalue=Input::all();
      
     $education=$eduvalue['education']; 
     $occupation=$eduvalue['occupation'];
     
     $eduid=$eduvalue['eduid']; 
       $occuid=$eduvalue['occuid']; 
         
    $education_update=\DB::table('education')
                   ->where('education.education_id',$eduid)
                   ->update(['education'=>$education]);
    
   
   
    $education_update=\DB::table('occupation')
                   ->where('occupation_id',$occuid)
                   ->update(['occupation'=>$occupation]);   
         
    if($education_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
    
     public function getEducationDelete()
	{
	  
	   $delete=Input::all();
   
	   $getid=$delete['id'];
	  
	  $edudel=\DB::table('education')
                      ->where('education_id',$getid)
                      ->delete();
         
       
        
        
	 if($edudel)
	  {
           $edudel=\DB::table('occupation')
                      ->where('occupation.education_id',$getid)
                      ->delete();
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	} 
    
    
    
    public function getRoleManagementPage($isRole=0)
    {
        
       
        
        $get_role=\DB::table('role')
                   ->get();
        
        
        
        $role_sess=\Session::get('login_role_id');
         
         if($role_sess)
         {
        
            
             $permission= with(new permission)->permission(); 
              // var_dump($permission);exit;
        
             if(($role_sess == '5') || ($permission == "access"))
             { 
         
         
       
     
        if($isRole)
        {
        
          return View::make('backend.rolemanagement',array('getrole'=>$get_role,'get_role_value'=>$isRole));
            
        }
        else
        {
            
         return View::make('backend.rolemanagement',array('getrole'=>$get_role));
            
        }
                   }
            else
             {
			return redirect('admin/not-admin');
		     }
		  }
         else
         {
	    return  redirect('admin/');
         }            
                   
        
      
       
    }
   
     public function postAddRole()
    {
         $rolepost=Input::all();
         $rolename=$rolepost['rolename'];
         $today=date("Y-m-d");
              $today_date = date("Y-m-d", strtotime($today));
          $add_role=\DB::table('role')
                      ->insert(['rolename'=>$rolename,'created_date'=>$today_date]);
         
         if($add_role)
         {
           echo "Rolename Added Successfully";
         }
         else
         {
           echo "error"; 
         }
       
    }
    
     public function postRoleDelete()
    {
         $role=Input::all();
         $rolename=$role['rolename'];
         
             
          $delete_role=\DB::table('role')
                       ->where('rolename',$rolename)
                       ->where('r_id','!=','5')
                       ->delete();
         
         if($delete_role)
         {
           echo "Rolename Removed Successfully";
         }
         else
         {
           echo "error";
         }
       
    }
    
    public function postUpdateRole(){
	    
        $data=Input::all();
        
		$role =$data['role_id'];
	    $role_permission = $data['page_id'];
        
        $selects=\DB::table('role_permission')
                  ->where('role_id',$role)
                  ->get();
       // var_dump($selects);exit;
        
    foreach($selects as $row)
    {
    
     $r_id= $row->id;
    }
	
	
   if(count($selects))
    {
		 
    

     $update=\DB::table('role_permission')
                  ->where('id',$r_id) 
                  ->update($data);
        
	
	   if($update)
       {
	
		echo 3;
	    }
        else
        {
		echo 4;
	    }
      }
       else
      {
		
        $insert=\DB::table('role_permission')
                 ->insert(['role_permission'=>$data]);
		
        if($insert)
        {
			echo 1;
		}
        else
        {
			echo 2;
		}
	} 
	

   }
    public function getAddBackendUser()
    {
        return View::make('backend.backend_add_user');
    }
    public function postInsertBackendUser()
    {
       
        
        
      $data=Input::all();
      
      $username = $data['username'];
	  $email = $data['email'];
	  $password=$data['password'];
     // $rolename=$data['role'];
      $roleid=$data['role_id'];
       
        
        $query=\DB::table('admin')
                ->where('username', $username)
                ->get();
        
	 if(count($query))
       {
	  echo 3;
       }
        
     else
        
      {
			
       $query1 =\DB::table('admin')
                 ->where('email',  $email)
                 ->get();
         
         if(count($query1))
         {
           echo 4;  
         }
        else
        {
			
	   $date =date('Y-m-d');
	
            $insert=\DB::table('admin')
                    ->insert($data);
          if($insert)
           {
	
              
           $query3 =\DB::table('role')
                    ->where('rolename',$rolename)
                    ->get();  
              if(count($query3))
              {
                echo 0;  
              }
	 
		    else
              {
                 $insert=\DB::table('role')
                          ->insert(['rolename'=>$rolename]);
	      
                echo 1;
		      }
            }
        }
		
		
     
    }
}
    public function getBackendUserList()
    {
        $backend_list=\DB::table('admin')
                       ->get();
        
        return View::make('backend.backend_userlist',array('users'=>$backend_list));
    }
    public function getBackendListEdit($id)
    {
        
        $getid=$id;
         
        $list=\DB::table('admin')
                       ->where('id',$getid)
                       ->get();
        
         return View::make('backend.backend_user_edit_form',array('user_list'=>$list));   
    }
    public function postBackendUserUpdate()
    {
      $value=Input::all();
      
     $username=$value['username']; 
     $email=$value['email'];
     $role=$value['role']; 
     $mobile=$value['mobile']; 
     
        $id=$value['id'];
    $user_update=\DB::table('admin')
                   ->where('id',$id)
                   ->update(['username'=>$username,'email'=>$email,'role'=>$role,'mobile'=>$mobile]);
    
   
   
      
         
    if($user_update)
    {
           
        
      echo 1;  
    }
    else
    {
        echo 0;
    }
    }
    public function getBackendUserDelete()
    {
        $post_value=Input::all();
        $id=$post_value['id'];
       
        $delete=\DB::table('admin')
                       ->where('id',$id) 
                       ->delete();
   if($delete)
   {
      echo 1; 
   }
  else
    {
     echo 0;
    }
    }
    
 public function getRegisterMemberList()
 {
    
      $today_date= Carbon::today()->format('Y-m-d');
     
     $reg_notifi_list=\DB::table('user_reg')
                       ->join('user_profile','user_profile.user_id','=','user_reg.id')
                        ->where('date',$today_date)
                        ->get(); 
   
     
     return View::make('backend.register_member_list',array('reg_list'=>$reg_notifi_list));
 }
    public function getDeactivatedMemberList()
 {
    
      $today_date= Carbon::today()->format('Y-m-d');
     
     $deactivate_list=\DB::table('user_reg')
                         ->join('user_profile','user_profile.user_id','=','user_reg.id')
                         ->where('deactivate_status','=',1)
                         ->where('deactivation_date',$today_date)
                         ->get();
  
     
     return View::make('backend.deactivate_user_list',array('deact_user_list'=>$deactivate_list));
 }
    
    public function getDeletedMemberList()
 {
    
      $today_date= Carbon::today()->format('Y-m-d');
     
     $deleted_profile_list=\DB::table('delete_user_profile')
                        ->join('user_profile','user_profile.user_id','=','delete_user_profile.userid')
                        ->where('deleted_date',$today_date)
                         ->get();
  
     
     return View::make('backend.deleted_profile_list',array('deleted_user_list'=>$deleted_profile_list));
 }
     public function getPaidMemberList()
 {
    
      $today_date= Carbon::today()->format('Y-m-d');
     
      $paid_users=\DB::table('user_payment_details')
                                        ->join('user_profile','user_profile.user_id','=','user_payment_details.uid')
                                        ->where('user_payment_status','=',1)
                                        ->where('paid_date',$today_date)
                                        ->get();
  
     
     return View::make('backend.paid_users_list',array('paid_user_list'=>$paid_users));
  }
    public function getFeedbackMemberList()
 {
    
      $today_date= Carbon::today()->format('Y-m-d');
     
      $feedback_users=\DB::table('feedback_details')
                                        ->join('user_profile','user_profile.user_id','=','feedback_details.userid')
                                         ->where('send_date',$today_date)
                                         ->get();
     
     return View::make('backend.feedback_user_list',array('feedback_user_list'=>$feedback_users));
 }
    
    public function getChangePassword()
    {
         return View::make('backend.change_password');
    }
      public function postPasswordChange()
      {
          
      
   $rolename=\Session::get('role_admin');
		$data=Input::all();
		
            $pas=$data['current_password'];
		    $pass=base64_encode($pas);
		
		$query_changepwd = \ DB::table('admin')
					  ->where('role_id','5')
					 ->where('password',$pass)
					  ->get();
					 // var_dump($query_changepwd);exit;
		
          $count=	count($query_changepwd);
		
        if($count == 1)		
		{
			if($data['new_password']==$data['confirm_password'])
			{
				 $a=$data['new_password'];
                 $b =base64_encode($a);

				$value = array('password'=>$b);
				
				 $chng_pwd=\DB::table('admin')
					    ->where('role_id','5')
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
				//echo"newpassword and confirm password are  not correct";
				echo 2;
			}
		}
		else
		{
			//echo"currentpassword not correct";
			echo 3;
		}
      }
    public function getLogout()
    {
        Session::flush();

      return redirect('admin/');
    }
 public function getNotAdmin()
    {
     return View::make('backend.error_404');
     }
     public function getAddSettings()
    {
         $settings_detail=\DB::table('settings')
                          ->get();
         
         return View::make('backend.settings',array('settings'=>$settings_detail));
    }
  
    public function postSettingsUpdate()
    {
        
        
        if(isset($_POST['dataAndImageForm']))  
       {

       $my_data=Input::all();
        $title=$my_data['title'];
        if(isset($_POST['religion']))
        {
           $religion=$_POST['religion'];
       }
       else
       {
       	 $religion=0;
       }
        if(isset($_POST['education']))
        {
          $education=$_POST['education'];
      }
       else
       {
       	 $education=0;
       }
      if(isset($_POST['occupation']))
        {
           $occupation=$_POST['occupation'];
       }
        else
       {
       	 $occupation=0;
       }
        if(isset($_POST['place']))
        {
            $place=$_POST['place'];
        }
         else
       {
       	 $place=0;
       }
         if(isset($_POST['age']))
        {
             $age=$_POST['age'];
         }
          else
       {
       	 $age=0;
       }
       $search_without_login=$my_data['search_without_login'];
        $currency=$my_data['currency'];
        $smtp_username=$my_data['smtp_username'];
         $smtp_host= $my_data['smtp_host'] ;
         $smtp_password=$my_data['smtp_password'];
         $payment_gateway_username=$my_data['payment_gateway_username'];
         $payment_gateway_password=$my_data['payment_gateway_password'];
         $payment_gateway_signature=$my_data['payment_gateway_signature'];
         $payment_gateway_testmode=$my_data['payment_gateway_testmode'];
         // $fav_icon=$my_data['fav_icon'];

       //var_dump($my_data);exit;
       // var_dump($filter_options);exit;
         $destinationPath = 'assets/settingsimages'; // upload path

	
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
	                    $sTempFileName = 'assets/settingsimages/'.$fileName;
	 
	                    // move uploaded file into cache folder
	                    move_uploaded_file($_FILES['image']['tmp_name'], $sTempFileName);
	 
	                    // change file permission to 644
	                    @chmod($sTempFileName, 0644);
	 
	                   }
	               }
                   else
                   {
                  
                   	    $error=true;
                   }

	               }
	                   //}
	  
            $image_names= $image_name;

          



		 if ($_FILES['fav_icon']['name']) {
         
   
	   $fileName = rand(11111,99999).'-'.$_FILES['fav_icon']['name']; // renaming image

       // var_dump($fileName);exit;
     // Input::file('images')->move($destinationPath, $fileName); // uploading file to given path
	  $fav_icon=$destinationPath.'/'.$fileName ;

	        $error=false;

	            // if no errors and size less than 250kb
	            if (! $_FILES['fav_icon']['error'] && $_FILES['fav_icon']['size']< 130 * 117) {
	                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
						
					
	 
	                    // new unique filename
	                    $sTempFileName = 'assets/settingsimages/'.$fileName;
	 
	                    // move uploaded file into cache folder
	                    move_uploaded_file($_FILES['fav_icon']['tmp_name'], $sTempFileName);
	 
	                    // change file permission to 644
	                    @chmod($sTempFileName, 0644);
	 
	                   }}
	                    else
                   {
                   	    $error=true;
                   }
	               }
	                   //}
	           
	             // var_dump($error);exit;
            $fav_icons= $fav_icon;

               if($error==true)
               {

               	echo "error";
               	 return Redirect::back();
               }
               else
               {
            $settings_update=\DB::table('settings')->
update(['title'=>$title,
'religion'=>$religion,'place'=>$place,'education'=>$education,'occupation'=>$occupation,'age'=>$age,'search_without_login'=>$search_without_login,'currency'=>$currency,'smtp_username'=>$smtp_username,'smtp_host'=>$smtp_host,'smtp_password'=>$smtp_password,'fav_icon'=>$fav_icons,'image'=>$image_names,'payment_gateway_username'=>$payment_gateway_username,'payment_gateway_password'=>$payment_gateway_password,'payment_gateway_signature'=>$payment_gateway_signature,'payment_gateway_testmode'=>$payment_gateway_testmode]);
    
          
       
 //return Redirect::back();
         $mail=\DB::table('settings')->first();


$myfile = fopen("local/config/mail.php", "w") or die("Unable to open file!");
 $active_record='';
$txt = '<?php'."\r\n";

$txt .= 'return ['."\r\n";

$txt .="'driver' => env('MAIL_DRIVER','smtp'),"."\r\n";
$txt .="'host'=> env('MAIL_HOST','". $mail->smtp_host."'),"."\r\n";
$txt .="'port' => env('MAIL_PORT','587'),"."\r\n";
$txt .='"from"=>array('."\r\n";
$txt .='"address" =>"'.$mail->smtp_username.'",'."\r\n";
$txt .='"name" =>"'.$mail->title.'"'."\r\n";
$txt .=' ),'."\r\n";
$txt .="'encryption' => env('MAIL_ENCRYPTION','tls'),"."\r\n";
$txt .='"username"=>"'.$mail->smtp_username.'",'."\r\n";

$txt .='"password"=>"'.$mail->smtp_password.'",'."\r\n";
$txt .="'sendmail' => '/usr/sbin/sendmail -bs'," ."\r\n"; 
$txt .="'pretend' => false,"."\r\n"; 
$txt .="];";


fwrite($myfile, $txt);
fclose($myfile);


  return redirect('admin/add-settings');

		
	  }
    



    }
}
public function getAddAd()
    {
         return View::make('backend.add_ad');
    }
     public function postUploadAd()
    {
       // echo "hai";exit;
		
    if(isset($_POST['dataImageForm']))  
       {  
    $value=Input::all();
      //var_dump($value);
        $ad_name=$value['ad_name'];
        $ad_posted=$value['ad_posted_date'];
        $uploaded_by=$value['uploaded_by'];
        $ad_posted_date=date("Y-m-d",strtotime($ad_posted));
        

    
        $destinationPath = 'assets/advertisement_images'; // upload path
		
		
		
     $image_name = '';
    
          //var_dump($_FILES);exit;
    if ($_FILES['ad_image']['name']) {
         
   
     $fileName = rand(11111,99999).'-'.$_FILES['ad_image']['name']; // renaming image

      
    $image_name=$destinationPath.'/'.$fileName ;

              $error=false;

              // if no errors and size less than 250kb
              if (! $_FILES['ad_image']['error'] && $_FILES['ad_image']['size']< 130 * 117) {
                  if (is_uploaded_file($_FILES['ad_image']['tmp_name'])) {
            
          
   
                      // new unique filename
                      $sTempFileName = 'assets/advertisement_images/'.$fileName;
   
                      // move uploaded file into cache folder
                      move_uploaded_file($_FILES['ad_image']['tmp_name'], $sTempFileName);
   
                      // change file permission to 644
                      @chmod($sTempFileName, 0644);
   
                     }}
               

                 }
                    
    
            $image_names= $image_name;             
        
		
		
					 
		
         
         $insertion=\DB::table('advertisement')->insert(
                   ['ad_name'=>$ad_name,'ad_image'=>$image_names,'ad_posted_date'=>$ad_posted_date,'uploaded_by'=>$uploaded_by]                                                         
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
  
     }
     public function getAdView()
    {
       
       $ad_dtls=\DB::table('advertisement')
                 ->get();

         return View::make('backend.ad_view',array('ad_details'=>$ad_dtls));
    }
    public function getAdvEdit($id)
	{
	  
	             $adid=$id;
								
              $ad_edit=\ DB::table('advertisement')
				          ->where(['id' => $adid])
                          ->get();
					//var_dump($agent_edit);exit;	
       
					 
	  return View::make('backend.ad_edit_list',array('dtls_ad'=>$ad_edit));
                 
           
                 
	 }
	  public function postEditUploadAd()
    {
       // echo "hai";exit;
		
    if(isset($_POST['dataAdImageForm']))  
       {  
    $value=Input::all();
      $up_id=$value['id'];
      //var_dump($value);
        $ad_name=$value['ad_name'];
        $ad_posted=$value['ad_posted_date'];
        $uploaded_by=$value['uploaded_by'];
        $ad_posted_date=date("Y-m-d",strtotime($ad_posted));
        

    
        $destinationPath = 'assets/advertisement_images'; // upload path
		
		
		
     $image_name = '';
    
          //var_dump($_FILES);exit;
    if ($_FILES['ad_image']['name']) {
         
   
     $fileName = rand(11111,99999).'-'.$_FILES['ad_image']['name']; // renaming image

      
    $image_name=$destinationPath.'/'.$fileName ;

              $error=false;

              // if no errors and size less than 250kb
              if (! $_FILES['ad_image']['error'] && $_FILES['ad_image']['size']< 130 * 117) {
                  if (is_uploaded_file($_FILES['ad_image']['tmp_name'])) {
            
          
   
                      // new unique filename
                      $sTempFileName = 'assets/advertisement_images/'.$fileName;
   
                      // move uploaded file into cache folder
                      move_uploaded_file($_FILES['ad_image']['tmp_name'], $sTempFileName);
   
                      // change file permission to 644
                      @chmod($sTempFileName, 0644);
   
                     }}
               

                 }
                    
    
            $image_names= $image_name;             
        
		
		
					 
		
         
         $updation=\DB::table('advertisement')
                     ->where('id',$up_id)
                      ->update(
                   ['ad_name'=>$ad_name,'ad_image'=>$image_names,'ad_posted_date'=>$ad_posted_date,'uploaded_by'=>$uploaded_by]                                                         
                                        );
										//var_dump($insertion);
										 
        if($updation)
        {
          echo "success";
          return redirect('admin/ad-view');
			//echo 1;
         }
        else
        {
          echo "error";
           //echo  0;
        } 
     
        
               }
  
     }
      public function getAdDelete()
	{
	  
	   $del=Input::all();
	   $id=$del['id'];
	  
	  $ad_del=\DB::table('advertisement')
				->where('id',$id)
                ->delete();
	 if($ad_del)
	  {
		  echo 1;

	  }
	  else
	  {
		  echo 0;

	  } 				   
	  
	}
   
}