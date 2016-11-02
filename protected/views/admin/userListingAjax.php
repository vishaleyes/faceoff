<div id="userListDiv">  
          <table class="table table-bordered table-hover" id="">
            <thead>
              <tr>
              	<th style="text-align:center !important"> No. </th>
                <th>  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/UserName' >
                    Username 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'UserName'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'UserName'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Gender' >
                    Gender 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Gender'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Gender'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/BirthDate' >
                    Birthday 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'BirthDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'BirthDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th>  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/EmailId' >
                    Email 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'EmailId'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'EmailId'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/LoginType' >
                    Login Type 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'LoginType'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'LoginType'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Status' >
                    Status Type 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Status'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Status'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/userListing/sortType/<?php echo $ext['sortType'];?>/sortBy/CreationDate' >
                    Created On 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'CreationDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
               <th style="text-align:center !important"> Action </th>
             </tr>
            </thead>
            <tbody>
            <?php $i=1;
			  	// echo "<pre>";			  print_r($data);		  die;
				 $cnt = $data['pagination']->itemCount;
			   if($cnt > 0){
			   foreach( $data['users'] as $row) {
				
				if($row['Status'] == 3)
				{
					$rowClass = "danger";	
				}else if($row['Status'] == 2)
				{
					$rowClass = "warning";
				}else{
					$rowClass = "";
				}
			
			 ?>
              <tr class="<?php echo $rowClass ;?>" id="row_<?php echo $row['UserId'] ; ?>" style="cursor:pointer;">
              <td align="center"> 
			  	<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
               </td>
              <td><a href="<?php echo Yii::app()->params->base_path;?>admin/showUserProfile/id/<?php echo $row['UserId'];?>"><?php if(isset($row['UserName']) && $row['UserName'] != '') { echo $row['UserName']; } else { echo "<center>-----</center>"; } ?></a></td>
                <td align="center"><?php if($row['Gender'] == 1) { echo '<i class="fa fa-male fa-2x" title="Male"></i>'; }else if ($row['Gender'] == 2) { echo '<i class="fa fa-female fa-2x" title="Female"></i>'; } ?></td>
                <td align="center"><?php echo $row['BirthDate'] ;?></td>
                <td ><?php echo $row['EmailId'] ;?></td>
                <td align="center"><?php if($row['LoginType'] == 1) { echo '<i class="fa fa-envelope fa-2x" title="Email"></i>'; } elseif($row['LoginType'] == 2) { echo '<i class="fa fa-facebook-square fa-2x" title="Facebook"></i>';} elseif($row['LoginType'] == 3) { echo '<i class="fa fa-twitter-square  fa-2x" title="Twitter"></i>';} ?></td>
                <td id="coloumn_<?php echo $row['UserId'] ; ?>" align="center" >
					<?php 
						if($row['Status'] == 3)
						{
							echo "Suspend";	
						}else if($row['Status'] == 2)
						{
							echo "Warning";	
						}else{
							echo "Normal";
						}
					?>
                    <input type="hidden" name="userCurrentStatus_<?php echo $row['UserId'] ; ?>" id="userCurrentStatus_<?php echo $row['UserId'] ; ?>" value="<?php echo $row['Status'] ; ?>" />
                    <img src="<?php echo Yii::app()->params->base_url; ?>images/input-spinner.gif" id="loader_<?php echo $row['UserId'] ; ?>" style="display:none;float:right;" /><i id="faIcon_<?php echo $row['UserId'] ; ?>" class="fa fa-pencil" style="float:right;" onclick="addStatusMenu(<?php echo $row['UserId'] ; ?>)"></i>
                </td>
                <td align="center"><?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?></td>
                <td align="center">
                 <a href="#" onclick="userDetailPopup('<?php echo $row['UserId'];?>');" class="tip" title="View Details"><i class="fa fa-search"></i></a> 
                        &nbsp;
                        <a href="#" onclick="changePasswordPopup('<?php echo $row['UserId'];?>');" class="tip" title="Change User Password"><i class="fa fa-cogs"></i></a> 
                          &nbsp;
                <!--<a href="<?php // echo Yii::app()->params->base_path;?>admin/editUsers/id/<?php //echo $row['UserId'];?>"  class="tip" title="View Details"><i class="fa fa-edit"></i></a>                 &nbsp;
                   <a href="#" onclick="deleteLogRecord('<?php //echo $row['UserId'];?>');" class="tip" title="View Details"><i class="fa fa-remove"></i></a>-->
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
					$('#userListDiv').html(html);
					$("#paginationLoader").css('display','none');
				});
				
				
			});
		});
		
		$('.sort').click(function() {
			var url	=	$(this).attr('lang');
			loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','userListDiv');
		});
	});
</script>
          <div id="detailDiv1"></div>
        </div>
        
       </div>