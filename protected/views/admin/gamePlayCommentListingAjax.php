<div id="gamePlayCommentDiv"> 
  <!--end add-portfolio-->
  
  <div class="row">
    <div class="col-md-12">
      <div class="add-portfolio"> <span>
        <?php 
									//	echo "<pre>";print_r($CommentCount);
								     $cnt = $UserCommentData['pagination']->itemCount;
                                        echo $cnt ;?>
        Total Comments </span> </div>
    </div>
  </div>
  <?php 
						// print_r($UserCommentData); 
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
      <center>
        <a href="#" onclick="userDetailPopup('<?php echo $user['UsersId'];?>');" class="tip" title="View Details"><?php echo $user['UserName'];?> </a>
      </center>
    </div>
    <div class="col-md-8" align="left" style="vertical-align:middle !important;"> <span style="line-height: 40px;"> <?php echo $user['Comment'] ;?></span> </div>
    <div class="col-md-2" align="right"> <a href="#" onclick="gamePlayDetailPopup('<?php echo $user['CommentUniqueId'];?>');" class="tip" title="View Details"> <i class="fa fa-thumbs-o-up"></i> <b>
      <?php $str = explode(",",$user['LikeUserList']);
									 		echo $cnt = count($str); ?>
      Likes</b> </a> </div>
  </div>
  <!--end row-->
  <?php 
						} } else {
                            ?>
  <div class="row portfolio-block">
    <div class="col-md-12" align="center"> <span style="line-height: 40px;"><b> No Data Found.</b></span> </div>
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
