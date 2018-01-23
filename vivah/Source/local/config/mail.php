<?php
return [
'driver' => env('MAIL_DRIVER','smtp'),
'host'=> env('MAIL_HOST','smtp.gmail.com'),
'port' => env('MAIL_PORT','465'),
"from"=>array(
"address" =>"praveenkmr841@gmail.com",
"name" =>"Soulmate"
 ),
'encryption' => env('MAIL_ENCRYPTION','tls'),
"username"=>"praveenkmr841@gmail.com",
"password"=>"9494lavang",
'sendmail' => '/usr/sbin/sendmail -bs',
'pretend' => false,
];