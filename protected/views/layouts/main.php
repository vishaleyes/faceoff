<!DOCTYPE html>
<?php error_reporting(0); ?>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Faceoff</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->

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

<link rel="icon" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" type="image/x-icon"/>

<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script>
jQuery(document).ready(function() {       
	
});

function loadBoxContent(urlData,boxid)
{
		$.ajax({			
		type: 'POST',
		url: urlData,
		data: '',
		cache: true,
		success: function(data)
		{
			if(data=="logout")
			{
				window.location.href = '<?php echo Yii::app()->params->base_path;?>admin';
				return false;	
			}
			$("#"+boxid).html(data);
		}
		});	
}

</script>
</head>

<body>

 
	<?php 
	
	//Yii::app()->session['faceoff_adminUser'] = 1;
	if(isset(Yii::app()->session['faceoff_adminUser']) && Yii::app()->session['faceoff_adminUser'] != "") { 
		
		
	
	?>
    <body class="page-header-fixed page-sidebar-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo" align="center" style="padding-left:0px !important;">
                    <a href="<?php echo Yii::app()->params->base_path ; ?>admin">
                    <img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" alt="logo" class="logo-default" style="width:100px; height:100px; "/>
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <div class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </div>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php 
					if(isset(Yii::app()->session['avatar']) && Yii::app()->session['avatar'] != "") {
						$url = Yii::app()->params->base_url."assets/upload/avatar/".Yii::app()->session['avatar'];
					}else {
						$url = Yii::app()->params->base_url."assets/upload/avatar/avatar.png";
					}
					
				?>
               <img alt="" class="img-circle" height="28px" width="28px" src="<?php echo $url ; ?>"/>
                            
<!--                            echo Yii::app()->session['picture'];-->
                            <span class="username">
                            <?php echo Yii::app()->session['fullname'] ; ?> </span>
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>admin/myprofile">
                                    <i class="fa fa-user"></i> My Profile </a>
                                </li>
                                <li>
                       <?php 
							if(isset(Yii::app()->session['logoutUrl']) && Yii::app()->session['logoutUrl'] != "")
							{
								$logoutUrl = Yii::app()->session['logoutUrl'];	
							}else{
								$logoutUrl = Yii::app()->params->base_path."admin/logout";
							}
						?>
                                    <a href="<?php echo $logoutUrl; ?>">
                                    <i class="fa fa-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                           
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper hidden-xs">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <form class="sidebar-search" action="extra_search.html" method="POST">
                                <a href="javascript:;" class="remove">
                                </a>
                                <div class="input-group">
                                    &nbsp;
                                    </span>
                                </div>
                                 <div class="input-group">
                                    &nbsp;
                                    </span>
                                </div>
                            </form>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
                        <?php if(Yii::app()->session['userType'] == 0) { ?>
                       <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "users") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/userListing">
                            <i class="fa fa-user"></i>
                            <span class="title">Users</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "users") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "games") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/gameListing">
                            <i class="fa fa-gamepad"></i>
                            <span class="title">Games</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "games") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <?php } ?>
                          <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "gameplay") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/gamePlayListing">
                            <i class="fa fa-gamepad"></i>
                            <span class="title">Game Playlist</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "gameplay") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                     
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "inapppurchase") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/inappPurchaseList">
                            <i class="fa fa-list"></i>
                            <span class="title">InApp Purchase</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "inapppurchase") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                         <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "polls") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/pollsListing">
                            <i class="fa fa-building"></i>
                            <span class="title">Polls</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "polls") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "imagereport") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/imageReportListing">
                            <i class="fa fa-exclamation-circle"></i>
                            <span class="title">Reported - FaceOff</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "imagereport") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                         
                        
                        <!-- BEGIN FRONTEND THEME LINKS -->
                        <!-- END FRONTEND THEME LINKS -->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
	<!-- END SIDEBAR -->
    <div class="page-content-wrapper">
    <div class="page-content">
    	
    <?php }  ?>

		<div> 
      		<?php //echo Yii::app()->user->setFlash('error', "adsfasdfasfsadf");?>
            <?php if(Yii::app()->user->hasFlash('success')): ?>	
          	<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
                <span>
               <?php echo Yii::app()->user->getFlash('success'); ?> </span>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
                <span>
               <?php echo Yii::app()->user->getFlash('error'); ?> </span>
            </div>
            <?php endif; ?>
         </div>

 <?php echo $content; ?>
 
 <div class="clearfix"></div>
 <?php if(isset(Yii::app()->session['faceoff_adminUser']) && Yii::app()->session['faceoff_adminUser'] != "") { ?>
 </div>
    </div>
 	<!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
             <?php echo date("Y"); ?> &copy; Faceoff.
            
        </div>
        <div class="page-footer-tools">
            <span class="go-top">
            <i class="fa fa-angle-up"></i>
            </span>
        </div>
        <div style="float:right">  powered by - <a href="http://bypeopletechnologies.com/" target="_blank">byPeople Technologies</a>&nbsp;&nbsp;&nbsp;</div>
    </div>
    <!-- END FOOTER -->
    
 <?php }else{ ?>
 	<!-- BEGIN COPYRIGHT -->
    <div class="copyright" align="center">
         <?php echo date("Y"); ?> &copy; Faceoff.<br>
           powered by - <a href="http://bypeopletechnologies.com/" target="_blank" style="color:#FF6600 !important;">byPeople Technologies</a>&nbsp;&nbsp;&nbsp;
    </div>
 
    
    <!-- END JAVASCRIPTS -->    
 <?php } ?>

</body>
</html>