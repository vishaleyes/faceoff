<div id="imageReportListDiv">  
          <table class="table table-striped table-bordered table-hover" id="">
            <thead>
              <tr>
              	<th style="text-align:center !important">No.</th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/imageReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/GameName' >
                    GameName 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'GameName'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'GameName'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	Reported Image 
                </th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/imageReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/ImageOwner' >
                    Image Owner 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ImageOwner'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'ImageOwner'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/imageReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/VoteCount' >
                    No Of Reports 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'VoteCount'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'VoteCount'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/imageReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/reportcount' >
                    Vote Count 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'reportcount'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'reportcount'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th  width="11%" style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/imageReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/play.CreationDate' >
                    Created On
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'play.CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'play.CreationDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
               <th width="10%"  style="text-align:center !important">  Action </th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;
			  	 //echo "<pre>";			  print_r($data['reportedImage']);		  die;
				 $cnt = $data['pagination']->itemCount;
				 
				 if($cnt > 0){
					 
			     foreach( $data['reportedImage'] as $row) {
			  ?>
              <tr id="row_<?php echo $row['GamePlayUniqueId'] ; ?>" style="cursor:pointer;">
                <td align="center"> 
				<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
                </td>
                <td>
					 <a class="tooltips" href="#" onclick="gamePlayDetailPopup('<?php echo $row['GamePlayUniqueId'];?>');" class="tip" title="View Game Details">
                		<?php echo $row['GameName'] ;?>
                     </a>
                </td>
                <?php 
			
				if(isset($row['ImageName']) && $row['ImageName'] != '')
				{
					$path = "assets/upload/GamePlay/".$row['ImageName']; 
					if (file_exists ($path))
					{
						//echo "get image";
						$url =  Yii::app()->params->base_url ."assets/upload/GamePlay/".$row['ImageName']; 
					}
					else
					{
						$url =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
					}
				}
				else
				{
					$url =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				}
				
				 
			 ?>
                <td align="center"><a data-rel="fancybox-button" title="" href="<?php echo $url ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $url ; ?>&h=40&w=50&q=100&zc=1" ></a></td>
                <td>
                	<span style="float:left;width:70% !important;">
					
				  <a href="#" onclick="UserDetailPopup('<?php echo $row['ImageOwnerId'];?>');" class="tip" title="View Details"><?php echo $row['ImageOwner'] ;?></a>		
					
                    </span>
					<?php if ($row['warningCount'] >= 1) { ?>
					<span style="float:right;">
                    	<a class="tooltips" href="#" onclick="viewAllImageWarningsOfUser('<?php echo $row['ImageOwnerId'] ; ?>','<?php echo $row['ImageOwner'] ; ?>');" title="View All Warnings">
							<?php echo $row['warningCount'] ;?>&nbsp;
                            <i class="fa fa-warning"></i>
                        </a>
                    </span>
					<?php } ?>
				</td>
                <td style="text-align:center !important"><?php echo $row['reportcount'] ;?>&nbsp;<a class="tooltips" href="#" onclick="viewAllReportListingForImage('<?php echo $row['ReportedGamePlayId'] ; ?>','<?php echo $row['ImageOwnerId'] ; ?>');" title="View All Report List For This Image"><i class="fa fa-search"></i></a></td>
                <td style="text-align:center !important"><?php echo $row['VoteCount'] ;?></td>
                <td style="text-align:center !important"><?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?></td>
                <td style="text-align:center !important; vertical-align:middle !important;">
                 <a class="tooltips" href="#" onclick="submitAction('<?php echo $row['ReportImageUniqueId'] ; ?>','<?php echo $row['ImageOwnerId'] ; ?>','1');" title="Deny + Verify Image"><i class="fa fa-check-circle fa-2x"></i></a>
                 <a class="tooltips" href="#" onclick="submitAction('<?php echo $row['ReportImageUniqueId'] ; ?>','<?php echo $row['ImageOwnerId'] ; ?>','2');" title="Accept + Warning"><i class="fa fa-exclamation-triangle fa-2x"></i></a>
                 <a class="tooltips" href="#" onclick="submitAction('<?php echo $row['ReportImageUniqueId'] ; ?>','<?php echo $row['ImageOwnerId'] ; ?>','3');" title="Accept + Suspension"><i class="fa fa-ban fa-2x"></i></a>
                </td>
               
              </tr>
              <?php $i++; } 
			    
				} else {
			?>
              	 
                 <tr>
                 	<td colspan="9" align="center"> No Data Found.</td>
                 </tr>
            <?php } ?>
            </tbody>
          </table>
          <input type="hidden" id="activeId" value="" />
          <!-- END EXAMPLE TABLE PORTLET--> 
          <br/>
          <?php
		 if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
			  <div class="" style="float:right;">
			 <?php 
			 $extraPaginationPara='&keyword='.$ext['keyword'];
			 $this->widget('application.extensions.WebPager',
							 array( 'cssFile'=>Yii::app()->params->base_url."css/pagination.css",
							 		'extraPara'=>$extraPaginationPara,
									'pages' => $data['pagination'],
									'id'=>'link_pager',
			));
		 ?>	
		 <?php  
		 }?>
          <div id="detailDiv1"></div>
        </div>
        <script type="text/javascript">
	$(document).ready(function(){
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#imageReportListDiv').html(html);
					$("#paginationLoader").css('display','none');
				});
			});
		});
		
		$('.sort').click(function() {
				var url	=	$(this).attr('lang');
				loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','imageReportListDiv');
	   });
	});
</script>
       </div>