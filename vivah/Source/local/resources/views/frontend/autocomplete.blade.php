 
   
 
<?php 
 	$sess= \Session::get('id');
	$gender= \Session::get('gender');
    $searchword=$_POST['searchword'];

if($searchword)
{        
	 
 
							 
 $sql_res=\ DB::table('user_reg')
          ->leftJoin('user_profile','user_profile.user_id','=','user_reg.id')
          ->where('gender','!=', $gender ) 
          ->where('deactivate_status','=','0')
         ->where('profile_strength','>','59')
          ->where('name','LIKE', $searchword.'%' )->get(); 
//var_dump($sql_res);
    if(count($sql_res)>0)
    {
foreach($sql_res as $auto)
{
	$id=$auto->user_id;
    $username=$auto->username;
    $path= $auto->path;
    $country=$auto->email;
    $encrypted_id = base64_encode($id);
  
  ?>

  <a href="{{URL::to('user/search-profile-view')}}/{{$encrypted_id}}">
  	
 
  <div class="display_box" align="left">
  <img src="{{asset($auto->path)}} " style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"> <?php echo $auto->username; ?><br/>
<span style="font-size:9px; "><?php echo $auto->email; ?>
 </span></div></a>
  <link href="{{asset('assets/css/searchfb.css')}}" rel="stylesheet" type="text/css" />

  <?php
}
    }
    else
    {
        ?>
        <div class="display_box" align="left">
   <span class="name"> <?php echo "No Match Found"; ?><br/>
       <span style="font-size:9px; color:#999999"> </span></span></div>
      <?php 
    }
}
else
{?>
	 <div class="display_box" align="left">
   <span class="name"> <?php echo "No Match Found"; ?><br/>
       <span style="font-size:9px; color:#999999"> </span></span></div>
<?php
}


?>

 
