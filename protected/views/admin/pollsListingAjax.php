<div id="PollList">
          <table class="table table-bordered table-hover" id="">
            <thead>
              <tr>
                <th> <center>No.</center> </th>
                <th> <center>Type</center> </th>
                <th>
                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/pollsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/GameText' >
                   GameText 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'GameText'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'GameText'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                
                  </th>
                <th style="text-align:center !important;"> 
                 <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/pollsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Choice1' >
                    Choice1 Text 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Choice1'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Choice1'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important;"> 
                 <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/pollsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Choice2' >
                    Choice2 Text
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Choice2'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Choice2'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th> <center>Active</center> </th>
                <th width="8%"> <center>Action</center> </th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;
			  	// echo "<pre>";			  print_r($data);		  die;
				 $cnt = $data['pagination']->itemCount;
				 if($cnt > 0){
			   foreach( $data['polls'] as $row) {
				
				if($row['Active'] == 2)
				{
					$rowClass = "danger";	
				}else{
					$rowClass = "";
				}
			
			 ?>
              <tr class="<?php echo $rowClass ;?>" id="row_<?php echo $row['TOTPollUniqueId'] ; ?>" style="cursor:pointer;">
                <td align="center"> 
				<?php 
                                    echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
                                    ?>
                </td>
                <td align="center"> <?php if($row['GameTypeUniqueId'] == 4) { echo '<i class="fa fa-file-text-o" title="Text"></i>';}
			   		 if($row['GameTypeUniqueId'] == 5) { echo '<i class="fa fa-file-image-o" title="Image"></i>'; }  ?> </td>
                <td><?php echo $row['GameText'] ;?></td>
                
                <td style="text-align:center !important;"><?php
				 if($row['GameTypeUniqueId'] == 5) {
					 	$path = "assets/upload/polls/".$row['ChoiceImage1'] ;
						
						if(isset($row['ChoiceImage1']) && $row['ChoiceImage1'] != "" && file_exists($path) ) { ?>
                        
                        <a data-rel="fancybox-button" title="" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo $row['ChoiceImage1'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo $row['ChoiceImage1'] ; ?>&w=50&h=50&q=100&zc=3" ></a>	
                                        
				<?php } else { ?>
                                        
                 <a data-rel="fancybox-button" title="" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo "noimage.jpg"; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo "noimage.jpg"; ?>&w=50&h=50&q=100&zc=3" ></a>  
                                        <?php } ?>
				 <?php }
				 else if($row['GameTypeUniqueId'] == 4)
				 {
					 echo $row['Choice1'];
				 }
				 
				  ?>		</td>
                <td style="text-align:center !important;"><?php
				 if($row['GameTypeUniqueId'] == 5) {
					 	$path = "assets/upload/polls/".$row['ChoiceImage2'] ;
						
						if(isset($row['ChoiceImage2']) && $row['ChoiceImage2'] != "" && file_exists($path) ) { ?>
                        
                        <a data-rel="fancybox-button" title="" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo $row['ChoiceImage2'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo $row['ChoiceImage2'] ; ?>&w=50&h=50&q=100&zc=3" ></a>	
                                        
				<?php } else { ?>
                                        
                 <a data-rel="fancybox-button" title="" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo "noimage.jpg"; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/polls/<?php echo "noimage.jpg"; ?>&w=50&h=50&q=100&zc=3" ></a>  
                                        <?php } ?>
				 <?php }
				 else if($row['GameTypeUniqueId'] == 4)
				 {
					 echo $row['Choice2'];
				 }
				 
				  ?>		</td>
                <td align="center"><?php if($row['Active'] == 1) { ?><a href="<?php echo Yii::app()->params->base_path;?>admin/changePollsStatus/TOTPollUniqueId/<?php echo $row['TOTPollUniqueId'];?>/status/<?php echo $row['Active'];?>" title="Active" > <i class="fa fa-check"></i></a> <?php } else if($row['Active'] == 2) {  ?>
 <a  href="<?php echo Yii::app()->params->base_path;?>admin/changePollsStatus/TOTPollUniqueId/<?php echo $row['TOTPollUniqueId'];?>/status/<?php echo $row['Active'];?>" title="InActive"> <i class="fa fa-close"></i> </a> <?php } ?></td>
                <td align="center">
                 <a href="#" onclick="pollsDetailPopup('<?php echo $row['TOTPollUniqueId'];?>');" class="tip" title="View Details"><i class="fa fa-search"></i></a>
                 &nbsp;
                  <a href="<?php echo Yii::app()->params->base_path;?>admin/editPolls/id/<?php echo $row['TOTPollUniqueId'];?>"  class="tip" title="Edit"><i class="fa fa-edit"></i></a>                 &nbsp;
                   <a href="#" onclick="deleteLogRecord('<?php echo $row['TOTPollUniqueId'];?>');" class="tip" title="Delete"><i class="fa fa-remove"></i></a>
                  </td>
               
              </tr>
              <?php 
			  
			  	$i++; } 
				 } else {
				?>
                <tr>
                    <td colspan="7" align="center"> No Data Found.</td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
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
          <input type="hidden" id="activeId" value="" />
          <!-- END EXAMPLE TABLE PORTLET--> 
          <br/>
          
           
          <script type="text/javascript">
	$(document).ready(function(){
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#PollList').html(html);
					$("#paginationLoader").css('display','none');
				});
				
				
			});
		});
		
		 $('.sort').click(function() {
                var url	=	$(this).attr('lang');
                loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','PollList');
	  });
	});
</script>
          <div id="detailDiv1"></div>
        </div>
        
        </div>