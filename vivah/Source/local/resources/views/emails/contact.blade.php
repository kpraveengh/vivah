 
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mailer</title>
</head>

<body>

 <?php
     $getimage=\DB::table('settings')
                       ->get();
                 foreach($getimage as $image)
                 {
                  $logo=$image->image;
                 
                 }      
            
               
                 
?>

<div style="width:660px; height:350px; margin:0 auto; background:#16a8d6; padding:20px 20px 20px 20px; font-family: Century Gothic,Verdana,Geneva,sans-serif; border:solid #118ab0 1px;">
	
    <div style="width:100%; float:left; padding:0 0 20px 0;">
    <div style="width:205px; height:76px;  margin:0 auto"> <img src="{{asset($logo)}}"/ ></div>
    </div>
    
    
    
    
        <div style="background:#fff;  float:left; width:96.3%;   border-top-right-radius: 8px; border-top-left-radius: 8px; padding:15px 12px 0 12px;  ">
    		<div style="width:100%; padding:10px 0 10px 0; float:left; color:#666261; font-size:14px;"> Welcome to solmate, find your perfect match with us </div>
                 <div style="width:100%; float:left; padding:20px 0 20px 0; border-bottom:solid #cdcdcd 1px; border-top:solid #cdcdcd 1px;"> 
                <p><b>Contact Details <b></p>
				<ul>
				<li>Name: <?php echo $your_name."<br>";?></li> 
				<li>Phone: <?php echo $phone."<br>";?></li> 
				 <li>email: <?php echo $email."<br>";?></li>
				 <li>message: <?php echo $messages."<br>";?></li>
				 </ul>
				 
            </div>
        </div>
   
        </div>

 
</body>
</html>
