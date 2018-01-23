<?php
$id = \Session::get('id');
?>
<div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-8">
                      <?php
                  if($id)
                  {
                  ?>
                     <div class="footer_link"> 
                             <a href="{{ URL::to('user/search') }}">Home</a>   |   
                             <a href="{{ URL::to('user/success-stories') }}">Success Stories</a>  |  
                             <a href="{{ URL::to('user/messages') }}">Messages</a>   |  
                             <a href="{{ URL::to('user/contact/contact_view') }}">Contact us</a>  
                     </div>
                      <?php
                  }
					else
					{
						?>
                      <div class="footer_link"> 
                             <a href="{{ URL::to('user/login-failed') }}">Home</a>   |   
                             <a href="{{ URL::to('user/login-failed') }}">Success Stories</a>  |  
                             <a href="{{ URL::to('user/login-failed') }}">Messages</a>   |  
                             <a href="{{ URL::to('user/login-failed') }}">Contact us</a>  
                     </div>
                       <?php
					}
					?>
                     <div class="copyright">© 2015 Soulmate Pvt. Ltd | Powered By Techware Solution.</div>
                  </div>
                  <div class="col-md-4">
                  		<ul class="footer-link2">
                            <a href="http://fb.com"><li class="facebookicon"><img src="{{asset('assets/images/facebook.png')}}"/></li></a>
                            <a href="http://mobile.twitter.com"><li class="twittericon"><img src="{{asset('assets/images/twitter.png')}}"/></li></a>
                            <a href="http://plus.google.com"><li class="googleplusicon"><img src="{{asset('assets/images/google-plus.png')}}"/></li></a>
                        </ul>
                  </div>
               </div>
            </div>
         </div>