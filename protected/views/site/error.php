<script>
setTimeout(function() 
	{
		window.location.href = "<?php echo Yii::app()->params->base_path; ?>admin/userListing";
	}, 5000 );	
</script>


<!-- End Dialog Popup Js -->
	

<div class="text" align="center" style="padding-top:100px;">
    <p><a href="<?php echo Yii::app()->params->base_path; ?>"><img src="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/global/img/loading-spinner-blue.gif" alt="Loading..." border="0" /></a></p>
    <p>Please Wait..</p>
    <p><b>Sorry, the requested page does not exist.</b></p>
    <p>Try going to the <a href="<?php echo Yii::app()->params->base_path; ?>" >Faceoff</a> home page and navigating to your page from there.</p>
    <p>You can <a href="#" title="contact us">contact us</a> if you need help.</p>
</div> 

	
