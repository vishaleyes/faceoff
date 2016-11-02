
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>

<link rel="icon" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" type="image/x-icon"/>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<body class="login">
<div>
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div align="center" class="modal-header" style="background-color:#F7F7F7 !important">
            <img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png" height="90%" width="90%"/>
            </div>
            
            <form method="post" action="<?php echo Yii::app()->params->base_path; ?>site/socialRegiseterFinalStep">
            
            <div class="modal-body">
            	<h4 class="modal-title"><b>Register as:</b></h4></br>
                    <label class="radio-inline">
                    <input type="radio" name="usertype" id="usertype" value="0" checked> <span style="color:#05B0F0;">Diver</span> </label>
                    <label class="radio-inline">
                    <input type="radio" name="usertype" id="usertype" value="1"> <span style="color:#05B0F0;">Business</span> </label>
            </div>
            <div class="modal-footer">
            	<input type="hidden" id="loginFrom" name="loginFrom" value="<?php if(isset($loginFrom) && $loginFrom != "") { echo $loginFrom ; } ?>" />
                <!--<button type="button" class="btn default" data-dismiss="modal">Close</button>-->
                <button type="submit" class="btn green pull-right">Go <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</body>