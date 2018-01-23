<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class profilestrength extends Model
{
     protected $table = 'user_profile';
     public $timestamps = false;
   
    function profilestrength($id)
    {
       
        $profile_datas=\DB::table('user_profile')
                         ->where('user_id',$id)
                         ->get();
                
        $profile_values=0;
        
        if(!empty($profile_datas)) 
        {
       $profile_strength = $profile_datas[0];
    
    if($profile_strength->img_status == "1")
    {
        $profile_values= $profile_values+10;
        
    }
    if(!empty($profile_strength->body_type))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->complexion))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->height))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->physical_status))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->weight))
    {
       $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->mother_tongue))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->marital_status))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->eating_habits))
    {
        $profile_values=$profile_values+2;
    }
    if(!empty($profile_strength->drinking_habit))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->smoking_habits))
    {
       $profile_values= $profile_values+2;
    }
    
    ////////////////////////////
    if(!empty($profile_strength->religion))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_religion))            
    {
       $profile_values=$profile_values+2;               
   }

    if(!empty($profile_strength->caste))
    {
       $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_caste))            
    {
       $profile_values= $profile_values+2;               
   }
    
    if(!empty($profile_strength->star))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_star))            
    {
       $profile_values=$profile_values+2;               
   }
    
    if(!empty($profile_strength->rassi_moonsign))
    {
       $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_moonsign))            
    {
       $profile_values= $profile_values+2;               
   }
    
    if(!empty($profile_strength->zodiac_starsign))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_Zodiac))            
    {
       $profile_values= $profile_values+2;               
   }
    
    if(!empty($profile_strength->sudhhajadhagam))            
    {
       $profile_values= $profile_values+2;               
   }
    /////////////////////////////
    if(!empty($profile_strength->country_livingin))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_country_livingin))
    {
        $profile_values= $profile_values+2;
    }
    
    
    if(!empty($profile_strength->citizenship))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_citizenship))
    {
        $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->state))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_residing_state))
    {
       $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->district))
    {
       $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_residing_city))
    {
        $profile_values= $profile_values+2;
    }

    /////////////////////////////
    if(!empty($profile_strength->education))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_education))
    {
        $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->occupation))
    {
        $profile_values= $profile_values+2;
    }
    else
    if(!empty($profile_strength->other_occupation))
    {
        $profile_values= $profile_values+2;
    }
        
   if(!empty($profile_strength->college))
    {
        $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->education_in_detail))
    {
        $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->occupation_in_detail))
    {
        $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->employedin))
    {
        $profile_values= $profile_values+2;
    }
    
    if(!empty($profile_strength->annual_income))
    {
       $profile_values= $profile_values+2;
    }
    
    
    //////////////////////////////////
    if(!empty($profile_strength->fathers_status))
    {
       $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->mothers_status))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->family_values))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->family_type))
    {
       $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->familystatus))
    {
       $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->no_of_brothers))
    {
       $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->brothers_married))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->no_of_sisters))
    {
        $profile_values= $profile_values+2;
    }
    if(!empty($profile_strength->sisters_married))
    {
        $profile_values= $profile_values+2;
    }
    ////////////////////////////////
    if(!empty($profile_strength->about_my_family))
    {
        $profile_values= $profile_values+10;
    }
    
        }
        $prfl_update=\DB::table('user_profile')
                      ->where('user_id',$id)
                      ->update(['profile_strength'=>$profile_values]);
        return $profile_values;
        
    }	 
}
