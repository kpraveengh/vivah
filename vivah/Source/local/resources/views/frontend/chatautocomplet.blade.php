 
 
<?php 
 	
	
 $a=$_POST['searchword'];

       
	  $gender=\Session::get('gender');

 $sql_res=\ DB::table('user_reg')
            ->join('user_profile', 'user_profile.user_id', '=', 'user_reg.id')
            ->where('deactivate_status','=','0')
			->where('gender','!=',$gender);
			  
			
			if( $a) {
            $sql_res=$sql_res
			->where('gender','!=',$gender)
			
 			->where('name','LIKE', $a.'%' )->get(); 
			}
			else {
			$sql_res=$sql_res->get(); 	
			}

foreach($sql_res as $auto)
{
	
  
  ?>

   	
 

<a title="" data-placement="left" data-toggle="tooltip" data-original-title="Tooltip on left" href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $auto->username;?>')">
       <?php if($auto->status =='online') {?>
                <img class="" src="{{asset('assets/images/chat/online.png')}}"><?php }
				elseif($auto->status =='busy') {?>
                <img class="" src="{{asset('assets/images/chat/busy.png')}}"> <?php }
				else {?><img class="" src="{{asset('assets/images/chat/offline.png')}}">
				<?php }?>&nbsp;&nbsp;<img class="imagechat" src="{{asset($auto->path)}}">&nbsp;&nbsp; <?php echo $auto->name;?></a>



  

<?php
}


?>

 
