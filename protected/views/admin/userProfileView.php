<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<style>
.wrapper {
    position: relative;
    padding: 0;
    width:100px;
    display:block;
}
.text {
    position: absolute;
    top: 0;
    color:#f00;
    background-color:rgba(255,255,255,0.8);
    width: 100px;
    height: 100px;
    line-height:100px;
    text-align: center;
    z-index: 10;
    opacity: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.text:hover {
    opacity:1;
}
}

img {
    z-index:1;
}
</style>
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
	
function getMoreContests()
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

function gamePlayLikesPopup(id)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/gamePlayLikesView&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					autoHeight : false,
					scrolling : 'no',
					autoSize : false,
					width    : "50%",
    				height   : "50%"  
				});
}
	
</script>

<!-- BEGIN CONTENT -->
    <!-- BEGIN PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title" style="display:inline-block;">
            User Faceoff Profile : <b><span style="font-size:25px;"> <?php echo $userData['FirstName'].'&nbsp;'.$userData['LastName'] ;?></span></b>
            </h3>
            <ul class="page-breadcrumb breadcrumb">
                <li class="btn-group">
                    <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="javascript:;" onclick="suspendUser(<?php echo $userData['UserId'] ;?>);">Suspend</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <i class="fa fa-home"></i>
                    <a href="javascript:;" onclick="window.history.go(-1);">Back</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">User Faceoff Profile</a>
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
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab">
                        Overview </a>
                    </li>
                    <li>
                        <a href="#tab_1_4" data-toggle="tab">
                        Contests </a>
                    </li>
                    <li>
                        <a href="#tab_1_6" data-toggle="tab">
                        Comments </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <div class="row">
                            <div class="col-md-2" align="center">
                                <ul class="list-unstyled profile-nav">
                                    <li>
                                    	<?php
										$path = "assets/upload/avatar/".$userData['ProfileImage'] ;
									//	echo "<pre>"; print_r($userData);die;
										if(isset($userData['ProfileImage']) && $userData['ProfileImage'] != "" && file_exists($path) ) { ?>
                                        <img src="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $userData['ProfileImage'] ;?>" class="img-responsive" />
                                    	<?php } else { ?>
                                        <img src="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo "noimage.jpg"; ?>" class="img-responsive" />
                                        <?php } ?>
                                    </li>
                                </ul>
                                
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-8 profile-info">
                                        <h1><?php echo $userData['FirstName'].'&nbsp;'.$userData['LastName'] ;?></h1>
                                        <p>
                                            <a href="#">
                                            <?php echo $userData['EmailId'] ;?> </a>
                                        </p>
                                        <ul class="list-inline">
                                            <li>
                                            	<?php 
												if($userData['Gender'] == 1) 
												{ 
													echo '<i class="fa fa-male"></i> Male';
												}
												else if ($userData['Gender'] == 2) 
												{ 
													echo '<i class="fa fa-female"></i> Female'; 
												} 
												?>
                                            </li>
                                            <li>
                                                <i class="fa fa-calendar"></i> 
                                                <?php 
													if(isset($userData['BirthDate']) && $userData['BirthDate'] != "" )
													{
														echo date("d M Y",strtotime($userData['BirthDate']));	
													}else{
														echo "-" ;
													}
												?>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end col-md-8-->
                                    <div class="col-md-4">
                                        <div class="portlet sale-summary">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                     User Summary
                                                </div>
                                                <!--<div class="tools">
                                                    <a class="reload" href="javascript:;">
                                                    </a>
                                                </div>-->
                                            </div>
                                            <div class="portlet-body">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="sale-info">
                                                        TOTAL FRIENDS <i class="fa fa-img-up"></i>
                                                        </span>
                                                        <span class="sale-num">
                                                        <?php
															$friends = array();
															$friends = explode(",",$userData['FriendsList']);
															if(!empty($friends) && isset($friends[0]) && $friends[0] != "" )
															{
																echo count($friends);	
															}else{
																echo 0 ;
															}
														?> 
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="sale-info">
                                                        TOTAL POINTS <i class="fa fa-img-down"></i>
                                                        </span>
                                                        <span class="sale-num">
                                                        <?php
															if(isset($userData['TotalPoints']) && $userData['TotalPoints'] != "" )
															{
																echo $userData['TotalPoints'];	
															}else{
																echo 0 ;
															}
														?> 
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="sale-info">
                                                        Active CONTESTS </span>
                                                        <span class="sale-num">
                                                        <?php
															if(isset($userData['activeGame']) && $userData['activeGame'] != "" )
															{
																echo $userData['activeGame'];	
															}else{
																echo 0 ;
															}
														?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="sale-info">
                                                        TOTAL CONTESTS </span>
                                                        <span class="sale-num">
                                                        <?php
															if(isset($userData['totalGame']) && $userData['totalGame'] != "" )
															{
																echo $userData['totalGame'];	
															}else{
																echo 0 ;
															}
														?>
                                                        </span>
                                                    </li>
                                                    
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-md-4-->
                                </div>
                                <!--end row-->
                                
                            </div>
                        </div>
                    </div>
                    <!--tab_1_2-->
                    <!--end tab-pane-->
                    <div class="tab-pane" id="tab_1_4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="add-portfolio">
                                    <span>
                                    <?php echo $userData['totalGame'] ;?> Faceoff Challenge User have taken part in </span>
                                </div>
                            </div>
                        </div>
                        <!--end add-portfolio-->
                        <div id="nextDiv">
                        <?php 
						foreach($gameData as $games) {
						?>
                        <div class="row portfolio-block">
                            <div class="col-md-2" align="left">
                            	
                                <?php
										$path = "assets/upload/GamePlay/". $games['UserImageName'] ;
									//	echo "<pre>"; print_r($userData);die;
										if(isset($games['OpponentImageName']) && $games['UserImageName'] != "" && file_exists($path) ) { ?>
                                       <a data-rel="fancybox-button" title="<?php echo $games['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['UserImageName'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['UserImageName']; ?>&w=150&h=90&q=100&zc=1" ></a>
                                    	<?php } else { ?>
                                         <a data-rel="fancybox-button" title="<?php echo $games['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo "noimage.jpg"; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php  echo "noimage.jpg"; ?>&w=150&h=90&q=100&zc=13" ></a> <?php } ?> 
 <center> <a href="#" onclick="userDetailPopup('<?php echo $games['UserId'];?>');" class="tip" title="View Details"><?php echo $games['Users'];?> </a></center>
                                
                            </div>
                            <a href="#" onclick="gamePlayDetailPopup('<?php echo $games['GamePlayUniqueId'];?>');" class="tip" title="View Details">
                            <div class="col-md-8 portfolio-stat" align="center">
                            	
                                <div class="portfolio-text">
                                    <div class="portfolio-text-info">
                                    	</br>
                                        <h4><?php echo $games['GameName'] ; ?></h4>
                                    </div>
                                </div>
                               
                            </div>
                             </a>
                            <div class="col-md-2" align="right">
                              <?php
										$path = "assets/upload/GamePlay/". $games['OpponentImageName'] ;
									//	echo "<pre>"; print_r($userData);die;
										if(isset($games['OpponentImageName']) && $games['OpponentImageName'] != "" && file_exists($path) ) { ?>
                                       <a data-rel="fancybox-button" title="<?php echo $games['OppoName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['OpponentImageName'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['OpponentImageName']; ?>&w=150&h=90&q=100&zc=1" ></a>
                                    	<?php } else { ?>
                                         <a data-rel="fancybox-button" title="<?php echo $games['OppoName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo "noimage.jpg"; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php  echo "noimage.jpg"; ?>&w=150&h=90&q=100&zc=13" ></a> <?php } ?>
 <center><a href="#" onclick="userDetailPopup('<?php echo $games['OpponentId'];?>');" class="tip" title="View Details"><?php echo $games['Opponent'];?> </a></center>
                            </div>
                        </div>
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
                    <!--end tab-pane-->
                    <div class="tab-pane" id="tab_1_6">
                       <div id="userCommentDiv">
                            <div class="row">
                               
                                <div class="col-md-12">
                                    <div class="add-portfolio">
                                        <span>
                                        <?php 
										$cnt = $commentData['pagination']->itemCount;
                                        echo $cnt ;?> Total Comments </span>
                                    </div>
                                </div>
                                
                            </div>
                            <?php 
                           // echo "<pre>"; print_r($commentData); die;
                            if($cnt > 0) {
								$i = 1;
                            foreach($commentData['comments'] as $comment) {
								//echo "$i" . $i;
                            ?>
                            <div class="row portfolio-block">
                                <div class="col-md-1" align="left" style="line-height: 40px;">
                                
                                
                                <?php
										$path = "assets/upload/avatar/".$comment['ProfileImage'] ;
										//echo "<pre>"; print_r($comment); //die;
										if(isset($comment['ProfileImage']) && $comment['ProfileImage'] != "" && file_exists($path) ) { ?>
                                       <a data-rel="fancybox-button" title="<?php echo $comment['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $comment['ProfileImage'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $comment['ProfileImage'] ; ?>&w=40&h=40&q=100&zc=3" ></a>
                                    	<?php } else { ?>
                                         <a data-rel="fancybox-button" title="<?php echo $comment['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo "noimage.jpg"; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php  echo "noimage.jpg"; ?>&w=40&h=40&q=100&zc=3" ></a> <?php } ?>
      </div>
              <div class="col-md-3" align="left" style="vertical-align:middle !important;padding-top: 10px;padding-bottom: 10px;">
                                 <a href="#" onclick="gamePlayDetailPopup('<?php echo $comment['GamePlayUniqueId'];?>');" class="tip" title="View Game Details" >
                                      <span style="vertical-align:middle !important;"> <?php echo $comment['GameText'] ;?></span>
                                 </a>  
                                 </div>
                                 <div class="col-md-6" align="left" style="vertical-align:middle !important;line-height: 40px;">
                                        <span style="line-height: 40px;"> <?php echo $comment['Comment'] ;?></span>
                                 </div>
                                 <div class="col-md-2" align="right" style="line-height: 40px;">
                                
                             <a href="#" onclick="gamePlayLikesPopup('<?php echo $comment['CommentUniqueId'];?>');" class="tip" title="View Details">
                                  <i class="fa fa-thumbs-o-up"></i> <b>  <?php $str = explode(",",$comment['LikeUserList']);
                                                echo $cnt = count($str); ?> Likes &nbsp;&nbsp;</b>
                                         
                                        </a>
                                 </div>
                            </div>
                            <!--end row-->
                            <?php 
                           $i++; } } else {
                            ?>
                            <div class="row portfolio-block">
                                <div class="col-md-12" align="center">
                                    <span style="line-height: 40px;"><b> No Data Found.</b></span>
                                </div>
                            </div>
                            <?php } ?>
                             <?php
								 if($cnt > 0 && $commentData['pagination']->getItemCount()  > $commentData['pagination']->getLimit()){?>
								  <div class="" style="float:right;">
									 <?php 
									 $extraPaginationPara='&keyword=';
									 $this->widget('application.extensions.WebPager',
													 array( 'cssFile'=>Yii::app()->params->base_url."css/pagination.css",
															'extraPara'=>$extraPaginationPara,
															'pages' => $commentData['pagination'],
															'id'=>'link_pager',
									));
								 ?>	
								   </div>
							 <?php  } ?>
                                     <script type="text/javascript">
										$(document).ready(function(){
											$('#link_pager a').each(function(){
												$(this).click(function(ev){
													
													$("#paginationLoader").css('display','inline-block');
													
													ev.preventDefault();
													$.get(this.href,{ajax:true},function(html){
														$('#userCommentDiv').html(html);
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