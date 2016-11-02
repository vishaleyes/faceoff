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
                            //echo "<pre>"; print_r($UserCommentData); 
                            if($cnt > 0) {
                            foreach($commentData['comments'] as $comment) {
                            ?>
                            <div class="row portfolio-block">
                                <div class="col-md-1" align="left" style="line-height: 40px;">
                                   &nbsp;&nbsp; <a data-rel="fancybox-button" title="<?php echo $comment['UserName'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $comment['ProfileImage'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $comment['ProfileImage'] ; ?>&w=40&h=40&q=100&zc=3" ></a>
                                </div>
                                 <div class="col-md-3" align="left" style="vertical-align:middle !important;padding-top: 10px;padding-bottom: 10px;">
                                 <a href="#" onclick="gamePlayDetailPopup('<?php echo $comment['CommentUniqueId'];?>');" class="tip" title="View Game Details" >
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
                            } } else {
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