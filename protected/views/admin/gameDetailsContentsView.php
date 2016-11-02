<!-- BEGIN PAGE LEVEL STYLES -->
<div id="secondcont">
<?php
$extraPaginationPara='&keyword='.$ext['keyword'].'&sortType='.$ext['sortType'].'&sortBy='.$ext['sortBy'];
?>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/table-advanced.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/ui-alert-dialog-api.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
    TableAdvanced.init();
    UIAlertDialogApi.init();
	
	$('.sort').click(function() {
		var url	=	$(this).attr('lang');
		loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','secondcont');
	});
});

function gamePlayDetailPopup(id)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/gamePlayDetails&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					autoHeight : true,
					scrolling : 'no',
					autoSize : false	,
					width    : "55%"
    				//height   : "67%"  
				});
}
	function userDetailPopup(id)
{
		
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/showUserDetail&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					//autoHeight : true,
					scrolling : 'no',
					autoSize : false	,
					width    : "55%",
    				height   : "67%"  
				});
}


</script>


<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> GameContent <small>GameContent  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin">Home</a></li>
      <li> <i class="fa fa-angle-right"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin/gameListing">GameList</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">GameContentList</a> </li>
      
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>


<!-- BEGIN EXAMPLE TABLE PORTLET-->
  <div class="row profile">
        <div class="col-md-12">
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>GameContents Details
        </div>
        <div class="tools">
            <!--<a href="javascript:;" class="remove">
            </a>-->
        </div>
    </div>
    <div class="portlet-body">
    <div class="tab-pane" id="tab_1_4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="add-portfolio">
                                    <span>
                                    <?php echo $gameCountData['totalUsers'] ;?> Faceoff Challenge User have taken part in </span>
                                </div>
                            </div>
                        </div>
                        <!--end add-portfolio-->
                        <div id="nextDiv">
                        <?php 
						//echo "<pre>"; print_r($gameData); die;
						foreach($gameData as $games) {
							
						?>
                        <div class="portfolio-block">
                            <div class="col-md-2" align="center">
           <?php 
			
			
			
			
			if(isset($games['UserImage']) && $games['UserImage'] != '')
			{
				$path = "assets/upload/avatar/".$games['UserImage']; 
				if (file_exists ($path))
				{
					//echo "get image";
					$userurl =  Yii::app()->params->base_url ."assets/upload/avatar/".$games['UserImage']; 
				}
				else
				{
					$userurl =  Yii::app()->params->base_url ."assets/upload/avatar/noimage.jpg";
				}
			}
			else
			{
				$userurl =  Yii::app()->params->base_url ."assets/upload/avatar/noimage.jpg";
			} 
			
					//echo $userurl;
			?>
             
           	<a data-rel="fancybox-button" title="<?php echo $games['Users'] ;?>" href="<?php echo $userurl ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $userurl ; ?>&w=150&h=90&q=100&zc=3" ></a>
              <center> <a href="#" onclick="userDetailPopup('<?php echo $games['UserId'];?>');" class="tip" title="View Details" style="text-align:center"><?php echo $games['Users'];?> </a>   </center>            
                </div>
                            <a href="#" onclick="gamePlayDetailPopup('<?php echo $games['GamePlayUniqueId'];?>');" class="tip" title="View Details">
                            <div class="col-md-8 portfolio-stat" align="center">
                                <div class="portfolio-text">
                                    <div class="portfolio-text-info">
                                    	</br>
                                        <h4>
										  
										<?php echo $games['GameName'] ; ?></h4>
                                    </div>
                                </div>
                            </div>
                            </a>
                            <div class="col-md-2" align="center">
                          
       <?php  
							
			if(isset($games['OpponentImage']) && $games['OpponentImage'] != '')
			{
				$path = "assets/upload/avatar/".$games['OpponentImage']; 
				if (file_exists ($path))
				{
					//echo "get image";
					$oppourl =  Yii::app()->params->base_url ."assets/upload/avatar/".$games['OpponentImage']; 
				}
				else
				{
					$oppourl =  Yii::app()->params->base_url ."assets/upload/avatar/noimage.jpg";					
				}
			}
			else
			{
				$oppourl =  Yii::app()->params->base_url ."assets/upload/avatar/noimage.jpg";
			}
			?>				
						
              <a data-rel="fancybox-button" title="<?php echo $games['Opponent'] ;?>" href="<?php echo $oppourl; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $oppourl; ; ?>&w=150&h=90&q=100&zc=3" ></a>
              <br />
               <a href="#" onclick="userDetailPopup('<?php echo $games['OpponentId'];?>');" class="tip" title="View Details"><?php echo $games['Opponent'];?> </a>    
                            </div>
                        </div>
                        <div class="row"> <br /></div>
                        <!--end row-->
                        <?php 
						}
						?>
                        </div>
                       		<input type="hidden" name="startFrom" id="startFrom" value="0" />
                            <input type="hidden" name="totalGameCount" id="totalGameCount" value="<?php echo $userData['totalGame'] ; ?>" />
                            <?php 
							if($userData['totalGame'] > 25) {
								?>
                            <a id="viewMoreLink"  onclick="getMoreContests();" class="col-sm-12 col-md-12 btn blue" href="javascript:;">
                                Next <i id="read_more_icon" class="m-icon-swapdown m-icon-white"></i>
                                <img id="countryLoader" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/img/gif-load.gif"  style="display:none"/>
                            </a>
                           <?php } ?>
                    </div>

    </div>
</div>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->