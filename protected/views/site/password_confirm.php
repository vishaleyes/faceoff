<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/login.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
		jQuery(document).ready(function() {   
		
		  Metronic.init(); // init metronic core components
		  Layout.init(); // init current layout
		   Login.init();
		  
		  
		});
	</script>
    
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
<a href="<?php echo Yii::app()->params->base_path ; ?>site">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png"  width="90%"/>
	</a>
    
    <h3 class="form-title">New password requested</h3>
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" method="post" action="<?php echo Yii::app()->params->base_path; ?>site/login">
		
	<div class="forget-password">
			<p><strong>We sent a mail to&nbsp;<span style="color:#D96C15;"><?php echo $loginId;?></span>&nbsp;with instructions on how to reset your password.</strong></p>
											  <p><label style="text-align:justify;">If after a few minutes you still cannot see the email in your inbox please check your spam folder, although uncommon sometimes confirmation emails can be falsely marked as spam and automatically moved out of your inbox.</label></p>
		</div>
		<div class="create-account">
			<p>
				 <a href="<?php echo Yii::app()->params->base_path;?>site">
				Go to Home Page </a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->

</div>
<!-- END LOGIN -->

</body>
<!-- END BODY -->
</html>