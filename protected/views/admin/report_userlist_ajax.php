<div id="userReportListDiv">  
          <table class="table table-striped table-bordered table-hover" id="">
            <thead>
              <tr>
              	<th style="text-align:center !important">No.</th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/UserName' >
                    UserName 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'UserName'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'UserName'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	User Image 
                </th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/ReportType' >
                    Report Type
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ReportType'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'ReportType'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Reason' >
                    Reason
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Reason'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Reason'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th  width="11%" style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userReportListing/sortType/<?php echo $ext['sortType'];?>/sortBy/CreationDate' >
                    Created On
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'CreationDate'){?>
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
					 
			     foreach( $data['reportedUser'] as $row) {
			  ?>
              <tr id="row_<?php echo $row['ReportUserUniqueId'] ; ?>" style="cursor:pointer;">
                <td align="center"> 
				<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
                </td>
                <td>
					 <a class="tooltips" href="#" onclick="gamePlayDetailPopup('<?php echo $row['ReportedUserId'];?>');" class="tip" title="View Game Details">
                		<?php echo $row['UserName'] ;?>
                     </a>
                </td>
                <td align="center"><a data-rel="fancybox-button" title="" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $row['ProfileImage'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $row['ProfileImage'] ; ?>&h=40&w=50&q=100&zc=1" ></a></td>
                <td>
					<?php 
						if($row['ReportType'] == 1)
						{
							echo "Profanity" ;
						}else if($row['ReportType'] == 2)
						{
							echo "Irrelevant";	
						}else if($row['ReportType'] == 3){
							echo "Inappropriate Comments";
						}else{
							echo "Other";
						}
					?>
                 </td>
                 <td><?php echo $row['Reason'] ;?></td>
                <td style="text-align:center !important"><?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?></td>
                <td style="text-align:center !important; vertical-align:middle !important;">
                 <a class="tooltips" href="#" onclick="submitAction('<?php echo $row['ReportUserUniqueId'] ; ?>','<?php echo $row['ReportedUserId'] ; ?>','1');" title="Deny + Verify Image"><i class="fa fa-check-circle fa-2x"></i></a>
                 <a class="tooltips" href="#" onclick="submitAction('<?php echo $row['ReportUserUniqueId'] ; ?>','<?php echo $row['ReportedUserId'] ; ?>','2');" title="Accept + Warning"><i class="fa fa-exclamation-triangle fa-2x"></i></a>
                 <a class="tooltips" href="#" onclick="submitAction('<?php echo $row['ReportUserUniqueId'] ; ?>','<?php echo $row['ReportedUserId'] ; ?>','3');" title="Accept + Suspension"><i class="fa fa-ban fa-2x"></i></a>
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
					$('#userReportListDiv').html(html);
					$("#paginationLoader").css('display','none');
				});
			});
		});
		
		$('.sort').click(function() {
				var url	=	$(this).attr('lang');
				loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','userReportListDiv');
	   });
	});
</script>
       </div>