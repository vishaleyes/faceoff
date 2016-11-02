<div id="gameList">
          <table class="table table-bordered table-hover" >
            <thead>
              <tr>
              	<th style="text-align:center !important"> No.</th>
                <th style="text-align:left !important" width="25%"> 
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gameListing/sortType/<?php echo $ext['sortType'];?>/sortBy/GameText' >
                    GameName
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'GameText'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'GameText'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important" > 
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gameListing/sortType/<?php echo $ext['sortType'];?>/sortBy/activeGame' >
                    Active Game &nbsp; 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'activeGame'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'activeGame'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important" > 
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gameListing/sortType/<?php echo $ext['sortType'];?>/sortBy/totalGame' >
                    Total Game  &nbsp;
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'totalGame'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'totalGame'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th width="20%" style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gameListing/sortType/<?php echo $ext['sortType'];?>/sortBy/GameTypeDescription' >
                    GameType 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'GameTypeDescription'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'GameTypeDescription'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gameListing/sortType/<?php echo $ext['sortType'];?>/sortBy/CreationDate' >
                    Created On 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'CreationDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gameListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Active' >
                    Active 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Active'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Active'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                   </a>
                </th>
                <th style="text-align:center !important" width="10%">  Action </th>
              </tr>
            </thead>
            <tbody>
             <?php $i=1;
			  	// echo "<pre>";			  print_r($data);		  die;
				 $cnt = $data['pagination']->itemCount;
				 if($cnt > 0){
			   foreach( $data['games'] as $row) {
				   
				   if($row['Active'] == 2)
					{
						$rowClass = "danger";	
					}else{
						$rowClass = "";
					}
			
			//echo "<pre>";			  print_r($row);		  die;
			 ?>
              <tr class="<?php echo $rowClass ;?>" id="row_<?php echo $row['GameUniqueId'] ; ?>" style="cursor:pointer;">
              	<td align="center"> 
			  	<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
               </td>
                <td>
				<a href="<?php echo Yii::app()->params->base_path;?>admin/gameDetailsContentsView/id/<?php echo $row['GameUniqueId'];?>"><?php echo $row['GameText'] ;?></a>
                </td>
                <td align="center"><?php echo $row['activeGame'] ;?></td>
                <td align="center" ><?php echo $row['totalGame'] ;?></td>
                
                <td  id="coloumn_<?php echo $row['GameUniqueId'] ; ?>" ><?php echo $row['GameTypeDescription'] ;?><img src="<?php echo Yii::app()->params->base_url; ?>images/input-spinner.gif" id="loader_<?php echo $row['GameUniqueId'] ; ?>" style="display:none;float:right;" /><i id="faIcon_<?php echo $row['GameUniqueId'] ; ?>" class="fa fa-pencil" style="float:right;" onclick="addTypeField(<?php echo $row['GameUniqueId'];?>)"></i></td>
                
                <td style="text-align:center !important" ><?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?></td>
	           
                <td align="center"><?php if($row['Active'] == 1) { ?><a href="<?php echo Yii::app()->params->base_path;?>admin/changeGameStatus/GameUniqueId/<?php echo $row['GameUniqueId'];?>/status/<?php echo $row['Active'];?>" title="Active" > <i class="fa fa-check"></i></a> <?php } else if($row['Active'] == 2) {  ?><a href="<?php echo Yii::app()->params->base_path;?>admin/changeGameStatus/GameUniqueId/<?php echo $row['GameUniqueId'];?>/status/<?php echo $row['Active'];?>" title="InActive" > <i class="fa fa-close"></i> </a> <?php } ?></td>
                
                <td align="center" ><a href="#" onclick="GamesDetailPopup('<?php echo $row['GameUniqueId'];?>');" class="tip" title="View Details"><i class="fa fa-search"></i></a>
                 &nbsp;
                  <a href="<?php echo Yii::app()->params->base_path;?>admin/addGameDetails/GameUniqueId/<?php echo $row['GameUniqueId'];?>"  class="tip" title="Edit"><i class="fa fa-edit"></i></a>                 &nbsp;
                   <a href="#" onclick="deleteGameRecord('<?php echo $row['GameUniqueId'];?>');" class="tip" title="Delete"><i class="fa fa-remove"></i></a>
                
                </td>
              </tr>
              <?php
			  	$i++; } 
				}else{
			  ?>
              <tr>
                <td colspan="8" align="center"> No Data Found.</td>
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
         
         <script type="text/javascript">
	$(document).ready(function(){
		
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#gameList').html(html);
					$("#paginationLoader").css('display','none');
				});
				
				
			});
		});
		
		$('.sort').click(function() {
                var url	=	$(this).attr('lang');
                loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','gameList');
	  	});
	});
</script>
         </div>
          <input type="hidden" id="activeId" value="" />
          <!-- END EXAMPLE TABLE PORTLET--> 
          <br/>
          <div id="detailDiv1"></div>
        </div>