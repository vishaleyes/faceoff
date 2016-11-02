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
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" height="15%" width="15%"/>
	</a>
		<!-- BEGIN REGISTRATION FORM -->
	<form class="reset-form" action="<?php echo Yii::app()->params->base_path;?>admin/resetPassword" method="post" style="display:block;">
		<h3>Forgot Password Verification</h3>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Full Name</label>
			<div class="input-icon">
				<i class="fa fa-font"></i>
				<input class="form-control placeholder-no-fix" name="token"  type="text" placeholder="Enter your verification code" <?php if( isset($token) ) {?>value="<?php echo $token;?>"<?php }?> />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="reset_password" placeholder="Enter your new Password" name="new_password"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<div class="controls">
				<div class="input-icon">
					<i class="fa fa-check"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="new_password_confirm"/>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" class="btn" onClick="window.location.href='<?php echo Yii::app()->params->base_path;?>site'">
			<i class="m-icon-swapleft"></i> Back to Home </button>
			<button type="submit" id="register-submit-btn" name="submit_reset_password_btn" class="btn green pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->

</body>
<!-- END BODY -->
</html>