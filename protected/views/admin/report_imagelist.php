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

function reportImageContentView(id)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/reportImageContentView&id='+id,
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
		url: '<?php echo Yii::app()->params->base_path;?>admin/imageReportListing',
		data: 'keyword='+keyword,
		cache: false,
		success: function(data)
		{
			$("#imageReportListDiv").html(data);
			$("#keyword").val(keyword);
		}
	});
}

function getAllSearch()
{
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/imageReportListing',
		data: '',
		cache: false,
		success: function(data)
		{
			$("#imageReportListDiv").html(data);
			$("#keyword").val("");
		}
	});
}

function submitAction(id,userId,status)
{
	if(status == '3')
	{
		bootbox.confirm("Are you sure want to suspend this user?", function(result) {
				if(result == true)
				{
					window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/submitImageReportAction&id="+id+"&userId="+userId+"&status="+status ;
				}else{
					return true;
				}
			}); 
	}else if(status == '2'){
			bootbox.confirm("Are you sure want to send warning to this user?", function(result) {
				if(result == true)
				{
					window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/submitImageReportAction&id="+id+"&userId="+userId+"&status="+status ;
				}else{
					return true;
				}
			});
	}else{
		bootbox.confirm("Are you sure want to deny this report?", function(result) {
			if(result == true)
			{
				window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/submitImageReportAction&id="+id+"&userId="+userId+"&status="+status ;
			}else{
				return true;
			}
		});
	}
}

function viewAllReportListingForImage(ReportedGamePlayId,ImageOwnerId)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/viewAllReportListingForImage&ReportedGamePlayId='+ReportedGamePlayId+'&ImageOwnerId='+ImageOwnerId,
					type : 'iframe',
					padding : 10,
					margin : 10,
					autoHeight : false,
					scrolling : 'no',
					autoSize : false,
					width    : "80%",
    				height   : "80%"  
				});
}

function viewAllImageWarningsOfUser(ImageOwnerId,ImageOwnerName)
{
	//alert(id);
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/viewAllImageWarningsOfUser&ImageOwnerId='+ImageOwnerId+'&ImageOwnerName='+ImageOwnerName,
					type : 'iframe',
					padding : 10,
					margin : 10,
					autoHeight : false,
					scrolling : 'no',
					autoSize : false,
					width    : "80%",
    				height   : "80%"  
				});
}
</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Reported - Faceoff <small>Reported Image List details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">Reported Image List </a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>Reported Image List </div>
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
      </div>
    </div>
  </div>
</div>
</div>
