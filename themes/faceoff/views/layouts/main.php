<!DOCTYPE html>

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

</head>

<body>


	<?php if(isset(Yii::app()->session['userId']) && Yii::app()->session['userId'] != "") { ?>
		
		
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo" align="center" style="padding-left:0px !important;">
                    <a href="<?php echo Yii::app()->params->base_path ; ?>user">
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
					if(isset(Yii::app()->session['gplus_profile_image']) && Yii::app()->session['gplus_profile_image'] != "") {
						$url = Yii::app()->session['gplus_profile_image'] ;
					}elseif(isset(Yii::app()->session['fb_profile_image_small']) && Yii::app()->session['fb_profile_image_small'] != ""){
						$url = Yii::app()->session['fb_profile_image_small'] ;
					}elseif(isset(Yii::app()->session['twitter_profile_image_small']) && Yii::app()->session['twitter_profile_image_small'] != ""){
						$url = Yii::app()->session['twitter_profile_image_small'] ;
					}else {
						//$url = "http://diveflagapp.com/api/diveflag_profile/".Yii::app()->session['profile_image'];
						$url = "../api/diveflag_profile/".Yii::app()->session['profile_image'];
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
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>user/profile">
                                    <i class="fa fa-user"></i> My Profile </a>
                                </li>
                                <li>
                       <?php 
							if(isset(Yii::app()->session['logoutUrl']) && Yii::app()->session['logoutUrl'] != "")
							{
								$logoutUrl = Yii::app()->session['logoutUrl'];	
							}else{
								$logoutUrl = Yii::app()->params->base_path."user/logout";
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
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "search_locations") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/searchDiveLocations">
                            <i class="fa fa-map-marker"></i>
                            <span class="title">Search Dive Locations</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "search_locations") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "logbook") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/logBookList">
                            <i class="fa fa-book"></i>
                            <span class="title">Logbook</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "logbook") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "divemaps") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/diveMaps">
                            <i class="fa fa-globe"></i>
                            <span class="title">Dive Maps</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "divemaps") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <?php } ?>
                         <?php if(Yii::app()->session['userType'] == 1) { ?>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "business") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/businessListing">
                            <i class="fa fa-list-alt"></i>
                            <span class="title">Business Listing</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "business") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <?php } ?>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "dive_buddies") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/diveBuddiesList">
                            <i class="fa fa-users"></i>
                            <span class="title">Dive Buddies</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "dive_buddies") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "fbimages") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/getUserAlbumList">
                            <i class="fa fa-facebook-square"></i>
                            <span class="title">Facebook Images</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "fbimages") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "manuals") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/diveManualsList">
                            <i class="fa fa-book"></i>
                            <span class="title">Manuals</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "manuals") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "divenewsdaily") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/getDiveNews">
                            <i class="fa fa-outdent"></i>
                            <span class="title">Dive News Daily</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "divenewsdaily") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "photography") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/getScubaShootersViewList">
                            <i class="fa fa-camera"></i>
                            <span class="title">Photography</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "photography") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "partners") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/partnersCategoriesList">
                            <i class="fa fa-chain"></i>
                            <span class="title">Partners</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "partners") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "broadcast") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/broadcast">
                            <i class="fa fa-rss"></i>
                            <span class="title">Broadcast</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "broadcast") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "inbox") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/inbox">
                            <i class="fa fa-envelope"></i>
                            <span class="title">Inbox</span><?php if($msgCount > 0 ) { ?> <span class="badge badge-danger" id="newMsgCount" ><?php echo $msgCount ; ?></span><?php } else {?><span class="badge badge-danger" id="newMsgCount" style="display:none" >&nbsp;</span> <?php } ?>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "inbox") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "youtube") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/youTubeChannel">
                            <i class="fa fa-youtube"></i>
                            <span class="title">YouTube Channel</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "youtube") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "scubapodcasts") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/scubaPodcasts">
                            <i class="fa fa-soundcloud"></i>
                            <span class="badge badge-roundless badge-danger">new</span>
                            <span class="title">Scuba Podcasts</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "scubapodcasts") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <?php /*?><li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "soundcloud") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/soundCloudChannel">
                            <i class="fa fa-soundcloud"></i>
                            <span class="badge badge-roundless badge-danger">new</span>
                            <span class="title">Soundcloud Channel</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "soundcloud") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li><?php */?>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "blog") { ?> class="start active" <?php } ?> >
                            <a target="_blank" href="http://diveflagapp.com/">
                            <i class="fa fa-bold"></i>
                            <span class="title">Diving Blogs</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "blog") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "shop") { ?> class="start active" <?php } ?> >
                            <a target="_blank" href="http://www.diveflagapp.com/diveflagshop/">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="title">Online Shop</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "shop") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "facebook_page") { ?> class="start active" <?php } ?> >
                            <a target="_blank" href="https://www.facebook.com/DiveFlagApp">
                            <i class="fa fa-facebook"></i>
                            <span class="title">DFA Facebook Page</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "facebook_page") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "aboutus") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>user/aboutUs">
                            <i class="fa  fa-info-circle"></i>
                            <span class="title">About Us</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "aboutus") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        
                        <!-- BEGIN FRONTEND THEME LINKS -->
                        <!-- END FRONTEND THEME LINKS -->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>

	<!-- END SIDEBAR -->
        </div>
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
 <?php if(isset(Yii::app()->session['userId']) && Yii::app()->session['userId'] != "") { ?>
 </div>
    </div>
 	<!-- BEGIN FOOTER -->
    <div class="page-footer"  align="center">
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