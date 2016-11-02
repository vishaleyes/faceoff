<script src="<?php echo Yii::app()->params->base_path_language; ?>languages/<?php echo Yii::app()->session['prefferd_language'];?>/global.js" type="text/javascript"></script>	

<!-- End Dialog Popup Js -->
	<script>
		setTimeout(function() 
		{   
			window.location.href = "<?php echo Yii::app()->params->base_path; ?>site/index";
		}, 5000 );	
	</script>

<div class="text" align="center" style="padding-top:50px;">
    <h1><img src="images/comlogo.png" alt="Disctopia"></h1>
    <br/>
    
     <p><img src="<?php echo Yii::app()->params->base_url; ?>images/loaders/loader6.gif" alt="##_LOGO_ALTER_##" border="0" /></p>
    <p>Please Wait..</p>
   
    <p>Welcome to DiveflagApp!</p>
    <p>Your account has been successfully verified.</p>
    <p>Now, You can login to the DiveflagApp.</p>
    <br/>
    <p><a href="<?php echo Yii::app()->params->base_path;?>site/index"><button class="btn btn-primary">Login</button></a></p>
</div> 