<!-- BEGIN PAGE LEVEL STYLES -->
<div id="secondcont">
<?php
$extraPaginationPara='&keyword='.$ext['keyword'].'&sortType='.$ext['sortType'].'&sortBy='.$ext['sortBy'];
?>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/table-advanced.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/ui-alert-dialog-api.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
   TableAdvanced.init();
   UIAlertDialogApi.init();
   
});


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

function UserDetailPopup(id)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/showUserDetail&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					//autoHeight : true,
					scrolling : 'no',
					autoSize : false	,
					width    : "55%",
    				height   : "70%"  
				});
}


function gamePlayEditImageDetails(id)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/editGamePlayImage&id='+id,
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



function deleteLogRecord(id){
		bootbox.confirm("Are you sure want to delete this record?", function(result) {
				if(result == true)
				{
			   		window.location.href="<?php echo Yii::app()->params->base_path ;?>user/deleteLogData/id/"+id ;
				}else{
					return true;
				}
			}); 
	}
	
function getSearch()
{
	var keyword = $("#keyword").val();
	
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing',
		data: 'keyword='+keyword,
		cache: false,
		success: function(data)
		{
			$("#gamePlayList").html(data);
			$("#keyword").val(keyword);
		}
	});
}

function getAllSearch()
{
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing',
		data: '',
		cache: false,
		success: function(data)
		{
			$("#gamePlayList").html(data);
			$("#keyword").val("");
		}
	});
}
</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Game Play <small>Gameplay List  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">GamePlayList</a> </li>
      <li class="pull-right">
      <!--  <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path ;?>user/addGameDetails'" class="btn btn-primary" style="margin-top:-7px; margin-right:-30px;">Add New Game</button>-->
      </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>Game Play List </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body">
    <div class="tabbable-custom nav-justified">
     
        <div class="tab-pane active" id="tab_1_1_1">
        	<div class="col-md-4" style="margin-bottom:10px !important">
            	<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter keyword for search" value="<?php if(isset($ext['keyword']) && $ext['keyword'] != "") { echo $ext['keyword'] ; } ?>" />
            </div>
            <div class="col-md-4">
                <button type="button" id="submitForm" name="submitForm" onclick="getSearch();" class="btn blue" ><i class="fa fa-search"></i> Search</button>
                <button type="button" id="submitForm" name="submitForm" onclick="getAllSearch();" class="btn blue" ><i class="fa fa-search"></i> Show All</button>
            </div>
          <div id="gamePlayList">  
          <table class="table table-striped table-bordered table-hover" id="">
            <thead>
              <tr>
              	<th style="text-align:center !important">No.</th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/GameName' >
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
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Users' >
                    User1 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Users'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Users'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                     </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Opponent' >
                    User2 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Opponent'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Opponent'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                     </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/UserVoteCount' >
                    User1 Votes 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'UserVoteCount'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'UserVoteCount'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                     </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/OpponentVoteCount' >
                    User2 Votes 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'OpponentVoteCount'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'OpponentVoteCount'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                     </a>
                </th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/Winner' >
                    Winner
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Winner'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Winner'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                     </a>
                </th>
                <th  width="11%" style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/gamePlayListing/sortType/<?php echo $ext['sortType'];?>/sortBy/play.CreationDate' >
                    Created On
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'play.CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'play.CreationDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                     </a>
                </th>
               <th style="text-align:center !important">  Action </th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;
			  	//	echo "<pre>";			  print_r($data);		  die;
				 $cnt = $data['pagination']->itemCount;
				 if($cnt > 0){
			     foreach( $data['gameplay'] as $row) {
			  ?>
              <tr id="row_<?php echo $row['GamePlayUniqueId'] ; ?>" style="cursor:pointer;">
                <td align="center"> 
				<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
                </td>
                <td>
				<a href="<?php echo Yii::app()->params->base_path;?>admin/gamePlayDetailsContentsView/id/<?php echo $row['GamePlayUniqueId'];?>"><?php echo $row['GameName'] ;?></a>
				</td>
                <?php 
			
					if(isset($row['UserImageName']) && $row['UserImageName'] != '')
					{
						$path = "assets/upload/GamePlay/".$row['UserImageName']; 
						if (file_exists ($path))
						{
							//echo "get image";
							$userImageUrl =  Yii::app()->params->base_url ."assets/upload/GamePlay/".$row['UserImageName']; 
						}
						else
						{
							$userImageUrl =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
						}
					}
					else
					{
						$userImageUrl =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
					}
					
					 
				 ?>
                <td align="center">
                
                <a data-rel="fancybox-button" title="<?php echo $row['Users'] ;?>" href="<?php echo $userImageUrl ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $userImageUrl ; ?>&h=40&w=50&q=100&zc=1" ></a>
                <br />
                   <a href="#" onclick="UserDetailPopup('<?php echo $row['UserId'];?>');" class="tip" title="View Details"><?php echo $row['Users'] ;?></a>
             
                </td>
                <?php 
			
					if(isset($row['OpponentImageName']) && $row['OpponentImageName'] != '')
					{
						$path = "assets/upload/GamePlay/".$row['OpponentImageName']; 
						if (file_exists ($path))
						{
							//echo "get image";
							$oppImageUrl =  Yii::app()->params->base_url ."assets/upload/GamePlay/".$row['OpponentImageName']; 
						}
						else
						{
							$oppImageUrl =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
						}
					}
					else
					{
						$oppImageUrl =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
					}
					
					 
				 ?>
                <td align="center"><a data-rel="fancybox-button" title="<?php echo $row['Opponent'] ;?>" href="<?php echo $oppImageUrl ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $oppImageUrl ; ?>&h=40&w=50&q=100&zc=1" ></a>
                <br />
                
                 <a href="#" onclick="UserDetailPopup('<?php echo $row['OpponentId'];?>');" class="tip" title="View Details"><?php echo $row['Opponent'] ;?></a>
                
                </td>
                <td style="text-align:center !important"><?php echo $row['UserVoteCount'] ;?></td>
                <td style="text-align:center !important"><?php echo $row['OpponentVoteCount'] ;?></td>
                <td style="text-align:left !important"><?php echo $row['Winner'] ;?></td>
                <td style="text-align:center !important"><?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?></td>
                <td style="text-align:center !important">
                 <a href="#" onclick="gamePlayDetailPopup('<?php echo $row['GamePlayUniqueId'];?>');" class="tip" title="View Details"><i class="fa fa-search"></i></a>
                  <a href="<?php echo Yii::app()->params->base_path;?>admin/editGamePlayImage/id/<?php echo $row['GamePlayUniqueId'];?>"  class="tip" title="Edit"><i class="fa fa-edit"></i></a>  
                  </td>
               
              </tr>
              <?php 
			  	$i++; } 
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
        
        <script type="text/javascript">
	$(document).ready(function(){
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#gamePlayList').html(html);
					$("#paginationLoader").css('display','none');
				});
				
				
			});
		});
		
		
		$('.sort').click(function() {
					var url	=	$(this).attr('lang');
					loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','gamePlayList');
		  });
	});
</script>
		</div>
       </div> 
      </div>
    </div>
  </div>
</div>
</div>
