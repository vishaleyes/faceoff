<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<style>
body
{
	font-family:Open Sans,Verdana,Sans-serif;
		
}
.img-float
{
 	float:left;	
}
</style>
<script type="text/javascript">
    var $ = jQuery.noConflict();
</script>

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>GamePlay Comments Like View
        </div>
        <div class="tools">
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>
    <div class="portlet-body">
  
    <div class="row">
            <div class="col-md-12">
                 <div class="add-portfolio">
                         <h3>  <?php 
                            //echo "<pre>"; print_r($userData); die;
                            echo $cnt = count($userData); ?>   Total Likes</h3>
                        </div>
                 </div>
                 
              </div>   
           <br />
             <!--end add-portfolio-->
             
             <div id="nextDiv">
                         <?php 
						foreach($userData as $user) {
						?>
                        <div class="row portfolio-block">
                            <div class="col-md-1 img-float"  align="left">
                            	<?php
						//echo "<pre>"; print_r($gameData); echo $gameData['ImageName'];	die;
						$path = "assets/upload/avatar/".$user['ProfileImage'] ;
							
					if(isset($user['ProfileImage']) && $user['ProfileImage'] != "" && file_exists($path) ) { ?>
						   <a data-rel="fancybox-button" title="<?php echo $user['FirstName'] . ' '. $user['LastName'] ;?>" 
                           href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $user['ProfileImage'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $user['ProfileImage'] ; ?>&w=40&h=40&q=100&zc=3" ></a>    
							<?php } else { ?>
							<img src="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo "noimage.jpg" ; ?>" style="height:40px;width:40px;">
							<?php } ?>
                             
                            </div>
                             <div class="col-md-9" align="left">
                            		 <?php echo $user['Comment'] ;?>
                             </div>
                             <div class="col-md-2 img-float" align="right">
                             <?php echo $user['FirstName'] . ' '. $user['LastName'];?>  
                                   
                             </div>
                                      
                        </div>
                        <br />
                        <!--end row-->
                        <?php 
						}
						?>
             </div>
                       		<input type="hidden" name="startFrom" id="startFrom" value="0" />
                            <input type="hidden" name="totalGameCount" id="totalGameCount" value="<?php echo $userData['totalGame'] ; ?>" />
                            <?php 
							if($CommentCount['TotalLike'] > 25) {
								?>
                            <a id="viewMoreLink"  onclick="getMoreContests();" class="col-sm-12 col-md-12 btn blue" href="javascript:;">
                                Next <i id="read_more_icon" class="m-icon-swapdown m-icon-white"></i>
                                <img id="countryLoader" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/img/gif-load.gif"  style="display:none"/>
                            </a>
                           <?php } ?>
                 
  
   
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->