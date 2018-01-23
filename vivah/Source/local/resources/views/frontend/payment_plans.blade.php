 <?php
 $data1 = $results['login'];
?>
@include('include.profile_header')
<meta name="_token" content="{!! csrf_token() !!}"/>

         <div class="section2">
            <div class="container">
              <div class="row">
                   <div class="part-main1">
                        <div class="col-lg-12">
							<div class="upgradepart">

<div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
   <ul role="tablist" class="nav nav-tabs upgradetab" id="myTabs">
      <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Classic Packages</a></li>
     <!--  <li role="presentation" class=""><a aria-controls="profile" data-toggle="tab" id="profile-tab" role="tab" href="#profile" aria-expanded="false">Personalised Packages</a></li> -->
   </ul>
   <div class="tab-content" id="myTabContent">
      <div aria-labelledby="home-tab" id="home" class="tab-pane active" role="tabpanel">



		 <div class="upgradedetaildpart">


             <?php

				foreach($packages as $upgrade)
				{
					?>

			<div class="col-md-3 marginbtn">
				<div class="upgradeactive">
          <form id="<?php echo  $upgrade->id; ?>classic" action="{{URL::to('user/makepayment')}}" method="post" accept-charset="UTF-8">
               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="up1">

                        <input type="hidden" name="package_id" value="<?php echo  $upgrade->id; ?>">
				<input type="radio"  name="package_name"  id="r1"  >
                        <label class="radiobtnlabel" for="r1">&nbsp;&nbsp;<b><?php echo $upgrade->package_name; ?></b></label>

					</div>

					<div class="up22 classic" active1 <?php echo $upgrade->package_name;?>>
						<img class="arrowbtmimg" src="{{asset('assets/images/arrowb3.png')}}">
						<select  name="period" data-name="<?php echo $upgrade->package_name;?>" id="period<?php echo $upgrade->id;?>" class="selectboxmnths prd " name="period"   >
                         <?php
                         $getcurrency=\ DB::table('settings')->get();
                         foreach($getcurrency as $currency)
                         {
                           $symbol=$currency->currency;
                         }
						 $pkgid=$upgrade->id;
						 $pkg_dtls=\ DB::table('package_details')
						       ->where('package_id','=',$pkgid)->get();

						foreach($pkg_dtls as $period)
				           {
					        ?>

 <option data-rate="<?php echo $period->rate; ?>" value="<?php echo $period->period;?> "><?php echo $period->period;?> Days</option>
								        <?php }?>
						</select>
						<p class="para6"><span class="rspan"><?php echo $symbol;?></span>&nbsp;<span id="<?php echo $upgrade->package_name;?>" class="mspan"></span></p>

					 <input type="hidden" name="rate" class="shows1_price prate" />
						 <input type="submit" value="Pay now" class="btn upgrade-selectbtn pay_now"  f-id="<?php echo $upgrade->id;?>">
					</div>
				</div>
				<img class="bottomshadowimg" src="{{asset('assets/images/upgadedwnimg.png')}}">
			</div>
</form>
				 <?php } ?>




		 </div>


		 <div class="conetntupgd"></div>

      </div>

   </div>
</div>




							</div>
						</div>

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
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="{{asset('assets/js/bootstrap.js')}}"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{asset('assets/js/ie10-viewport-bug-workaround.js')}}"></script>
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



 <script type="text/javascript">
$(document).ready(function(){
$('.marginbtn').click(function(){
	 $('input[name="package_name"]').prop('checked', false);

        $('.classic').removeClass('active1');
    	 $(this).find('.classic').addClass('active1');
        $(this).find('input[name="package_name"]').prop('checked',true);
    });


 $(".prd").each(function() {

  var n=$(this).find('option:selected').data('rate')
  var m= $(this).data('name');
	$('#'+m).html(n);

	$('.classic').removeClass("active1");

$('.prate').val(n);

});

$('.prd').on('change', function() {

var a= $(this).find('option:selected').data('rate');

var b= $(this).data('name');
$('#'+b).html(a);
$('.prate').val(a);



});
});
</script>
   </body>
</html>
