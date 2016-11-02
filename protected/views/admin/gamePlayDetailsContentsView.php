<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
});

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


function showDetails(date){
	
		 window.location.href='<?php echo Yii::app()->params->base_path;?>admin/getDiveNewsViewList/date/'+date;
	}
	
function getMoreLikeContests()
{
	$("#viewMoreLink").attr("onclick","");
	$("#countryLoader").css("display","");
	$("#read_more_icon").css("display","none");
	//return false;
	var id = '<?php echo $userData['UserId'] ; ?>';
	var startFrom = $("#startFrom").val();
	var totalGameCount = $("#totalGameCount").val();
	
	var newStartFrom = Number(startFrom) + 25 ;
	//alert(date);
	$.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>admin/showUserGamePlayListByAjax',
		  data: 'id='+id+'&startFrom='+newStartFrom,
		  cache: false,
		  success: function(data)
		  {
			  if(data != 0)
			  {
		  		$("#nextDiv").append(data);
				$("#countryLoader").css("display","none");
				$("#read_more_icon").css("display","");
				$("#viewMoreLink").attr("onclick","getMoreContests();");
				$("#startFrom").val(newStartFrom);
				
				if(Number(newStartFrom) > Number(totalGameCount))
				{
					$("#viewMoreLink").css("display","none");	
				}
				
			  }else{
			  	$("#countryLoader").css("display","none");
				$("#read_more_icon").css("display","");
				$("#viewMoreLink").attr("onclick","getMoreContests();");
				alert("Error: Cant Loading New Records.");
				return false;
			  }
		  }
		 });

	
}

function suspendUser(id){
		bootbox.confirm("Are you sure want to suspend this user?", function(result) {
				if(result == true)
				{
			   		window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/suspendUser/id/"+id ;
				}else{
					return true;
				}
			}); 
	}
	
function gamePlayDetailPopup(id)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/gamePlayLikesView&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					autoHeight : false,
					scrolling : 'no',
					autoSize : false	,
					width    : "50%",
    				height   : "60%"  
				});
}
	
</script>

<!-- BEGIN CONTENT -->
    
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> GamePlayList Content <small>GamePlay Content  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin">Home</a> 
      </li>
      
      <li> <i class="fa fa-angle-right"></i>
       <a href="<?php echo Yii::app()->params->base_path ;?>admin/gamePlayListing">GamePlayList</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">GamePlayListContent</a> </li>
      <li class="pull-right">
       
      </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row profile">
        <div class="col-md-12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom tabbable-full-width">
                <ul class="nav nav-tabs">
                    
                    <?php 
						$likeTab = '';
						$commentTab = '';
						$firstTab = '';
						if($_REQUEST['likeTab'] == 1)
						{
							$likeTab = 'active';
						}
						else if($_REQUEST['commentTab'] == 1)
						{
							$commentTab = 'active';
						}
						else
						{
							$firstTab = 'active';
						}
					?>
                    
                    
                    <li class="<?php echo $firstTab; ?>">
                        <a href="#tab_1_1" data-toggle="tab">
                        About Game </a>
                    </li>
                    <li class="<?php echo $likeTab; ?>" id="tab_like" style="visibility:hidden;">
                        <a href="#tab_1_4" id="tab_like_a" data-toggle="tab">
                        Likes </a>
                    </li>
                    <li class="<?php echo $commentTab; ?>">
                        <!--<a href="#tab_1_6" data-toggle="tab">-->
                        <a href="#tab_1_5" data-toggle="tab">
                        Comments </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?php echo $firstTab; ?>" id="tab_1_1">
                        <div class="row">
                            <div class="col-md-2" align="center">
                                <ul class="list-unstyled profile-nav">
                                    <li>
                                    	<?php
	//echo "<pre>"; print_r($gameData); echo $gameData['ImageName'];	die;
														
										$path = "assets/upload/Games/".$gameData['ImageName'] ;
										
										if(isset($gameData['ImageName']) && $gameData['ImageName'] != "" && file_exists($path) ) { ?>
                                        <img src="<?php echo Yii::app()->params->base_url; ?>assets/upload/Games/<?php echo $gameData['ImageName'] ;?>" class="img-responsive" />
                                    	<?php } else { ?>
                                        <img src="assets/upload/avatar/noimage.jpg" class="img-responsive">
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-8 profile-info">
                                        <h1><?php echo $gameData['GameText'];?></h1>
                                        <p>
                                        
                                          <i class="fa fa-gamepad"></i> 
                                            <a href="#" title="GameType">
                                            <?php echo $gameData['GameTypeDescription']  ;?> </a>
                                            
                                        <br />    <br />  
                                          
                                <!-- <a href="#">   <i class="fa fa-thumbs-o-up"></i> Total Likes <b> <?php echo $LikeCount[0]['TotalLike'] ;?></b> </a>
                                   <br />    <br />   -->
                                    
                                    <a href="#">  <i class="fa fa-comment-o"></i> Total Comments <b><?php echo $CommentCount[0]['TotalCommemts'] ;?> </b></a>
                                        </p>
                                        
                                    </div>
                                   
                                </div>
                                <!--end row-->
                                
                            </div>
                        </div>
                         
                    </div>
                    <!--tab_1_2-->
                    
                    <!--end tab-pane-->
                    <div class="tab-pane <?php echo $likeTab; ?>" id="tab_1_4" >
                        <div class="row">
                        
                            <div class="col-md-12">
                                <div class="add-portfolio">
                                    <span>
                                    <?php 
									
									echo $LikeCount[0]['TotalLike'] ;?> Total Likes </span>
                                </div>
                            </div>
                       
                        </div>
                       
                        <div id="nextDiv">
                        <?php 
						 $cnt = $UserLikeData['pagination']->itemCount;
						foreach($UserLikeData['Comments'] as $user) {
						?>
                        <div class="row portfolio-block">
                            <div class="col-md-2" align="left">
                          <?php
	//echo "<pre>"; print_r($gameData); echo $gameData['ImageName'];	die;
								$path = "assets/upload/avatar/".$user['ProfileImage'] ;
				if(isset($user['ProfileImage']) && $user['ProfileImage'] != "" && file_exists($path) ) { ?>
						   <a data-rel="fancybox-button" title="<?php echo $user['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $user['ProfileImage'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $user['ProfileImage'] ; ?>&w=40&h=40&q=100&zc=3" ></a>    
							<?php } else { ?>
							<img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" class="img-responsive" style="height:60px;width:60px;">
							<?php } ?>
                            </div>
                            <div class="col-md-9" align="left" style="vertical-align:middle !important;">
                            	 <span style="line-height: 55px;"> <?php echo  $user['UserName'] ;?></span>
                             </div>
                            <div class="col-md-2" align="right">
                            </div>
                           
                           
                        </div>
                        <!--end row-->
                        <?php 
						}
						?>
                        
         <?php
		 if($cnt > 0 && $UserLikeData['pagination']->getItemCount()  > $UserLikeData['pagination']->getLimit()){?>
			  <div class="" style="float:right;">
			 <?php 
			 $extraPaginationPara='&keyword='.$ext['keyword'].'&likeTab=1';
			 $this->widget('application.extensions.WebPager',
							 array( 'cssFile'=>Yii::app()->params->base_url."css/pagination.css",
							 		'extraPara'=>$extraPaginationPara,
									'pages' => $UserLikeData['pagination'],
									'id'=>'link_pager',
			));
		 ?>	
         </div>
		 <?php
		   
		 }?>
         <script type="text/javascript">
	$(document).ready(function(){
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#secondcont').html(html);
					$("#paginationLoader").css('display','none');
				
				});
				
				
			});
		});
	});
</script>
                        
                        
                       		<input type="hidden" name="startFrom" id="startFrom" value="0" />
                            <input type="hidden" name="totalGameCount" id="totalGameCount" value="<?php echo $LikeCount[0]['TotalLike'] ; ?>" />
                    </div>
                    </div>
                    <!--end tab-pane-->
                    
                    <div class="tab-pane <?php echo $commentTab; ?>" id="tab_1_5">
                        <div id="gamePlayCommentDiv" > 
                        <!--end add-portfolio-->
                       
                        
                        <div class="row">
                           
                            <div class="col-md-12">
                                <div class="add-portfolio">
                                    <span>
                                    <?php 
									//	echo "<pre>";print_r($CommentCount);
									echo $CommentCount[0]['TotalCommemts'] ;?> Total Comments </span>
                                </div>
                            </div>
                            
                        </div>
                        <?php 
						// print_r($UserCommentData); 
						 $cnt = $UserCommentData['pagination']->itemCount;
						if($cnt > 0) {
						foreach($UserCommentData['CommentsLike'] as $user) {
							//echo "<pre>";print_r($user);
						?>
                        <div class="row portfolio-block">
                            <div class="col-md-2" align="center">
                            	<?php
	//echo "<pre>"; print_r($UserCommentData); echo $gameData['ImageName'];	
														
										$path = "assets/upload/avatar/".$user['ProfileImage'] ;
										
										if(isset($user['ProfileImage']) && $user['ProfileImage'] != "" && file_exists($path) ) { ?>
                                       
                                        <a data-rel="fancybox-button" title="<?php echo $user['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $user['ProfileImage'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $user['ProfileImage'] ; ?>&w=50&h=50&q=100&zc=3" ></a>	
                                        
				<?php } else { ?>
                                        
                   <a data-rel="fancybox-button" title="<?php echo $user['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo "noimage.jpg"; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo "noimage.jpg"; ?>&w=50&h=50&q=100&zc=3" ></a>
                                        <?php } ?>
                                
                  <center><a href="#" onclick="userDetailPopup('<?php echo $user['UsersId'];?>');" class="tip" title="View Details"><?php echo $user['UserName'];?> </a></center>    
                             
                            </div>
                             <div class="col-md-8" align="left" style="vertical-align:middle !important;">
                            		<span style="line-height: 40px;"> <?php echo $user['Comment'] ;?></span>
                             </div>
                             <div class="col-md-2" align="right">
                            
	                  	 <a href="#" onclick="gamePlayDetailPopup('<?php echo $user['CommentUniqueId'];?>');" class="tip" title="View Details">
                              <i class="fa fa-thumbs-o-up"></i> <b>  <?php $str = explode(",",$user['LikeUserList']);
									 		echo $cnt = count($str); ?> Likes</b>
									 
                                    </a>
                             </div>
                        </div>
                        <!--end row-->
                        <?php 
						} } else {
                            ?>
                            <div class="row portfolio-block">
                                <div class="col-md-12" align="center">
                                    <span style="line-height: 40px;"><b> No Data Found.</b></span>
                                </div>
                            </div>
                            <?php } 
						?>
                        
                         <?php
						
		 if($cnt > 0 && $UserCommentData['pagination']->getItemCount()  > $UserCommentData['pagination']->getLimit()){?>
			  <div class="" style="float:right;">
			 <?php 
			 $extraPaginationPara='&keyword='.$ext['keyword'].'&commentTab=1';
			// $extraPaginationPara='&keyword=';
			 $this->widget('application.extensions.WebPager',
							 array( 'cssFile'=>Yii::app()->params->base_url."css/pagination.css",
							 		'extraPara'=>$extraPaginationPara,
									'pages' => $UserCommentData['pagination'],
									'id'=>'link_pager',
			));
		 ?>	
           </div>
		 <?php  
		 }?>
         <script type="text/javascript">
	$(document).ready(function(){
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#gamePlayCommentDiv').html(html);
					$("#paginationLoader").css('display','none');
				
				});
				
				
			});
		});
	});
</script>
                      
                        </div>
                       		
                        
                    </div>
                    <!--end tab-pane-->
                </div>
            </div>
            <!--END TABS-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
		
<!-- END CONTENT -->
