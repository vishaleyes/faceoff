<!-- BEGIN PAGE LEVEL STYLES -->
<div id="secondcont">
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>

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

function getSearch()
{
	var keyword = $("#keyword").val();
	
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/pollsListing',
		data: 'keyword='+keyword,
		cache: false,
		success: function(data)
		{
			$("#PollList").html(data);
			$("#keyword").val(keyword);
		}
	});
}
function getAllSearch()
{
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/pollsListing',
		data: '',
		cache: false,
		success: function(data)
		{
			$("#PollList").html(data);
			$("#keyword").val("");
		}
	});
}


function pollsDetailPopup(id)
{
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/GetDetailsByPollId&id='+id,
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
			   		window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/deletepollData/id/"+id ;
				}else{
					return true;
				}
			}); 
	}

</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Polls <small>Polls all details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">PollsList</a> </li>
      <li class="pull-right">
        <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path ;?>admin/addPolls'" class="btn btn-primary" style="margin-top:-7px; margin-right:-30px;">Add New Poll</button>
      </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>Polls List </div>
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
				 
				  ?>
                  </td>
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
      </div>
    
  </div>
</div>
</div>
