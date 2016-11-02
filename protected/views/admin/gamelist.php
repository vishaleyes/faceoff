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

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
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


function GamesDetailPopup(id)
{
		 $.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/showGameDetail&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					//autoHeight : true,
					scrolling : 'no',
					autoSize : false	,
					width    : "55%",
    				height   : "42%"  
				});
}

function GamesContentDetailPopup(id)
{
		 $.fancybox.open({
			 
					href : '<?php echo Yii::app()->params->base_path ;?>admin/gameDetailsContentsView&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					//autoHeight : true,
					scrolling : 'no',
					autoSize : false	,
					width    : "55%",
    				height   : "42%"  
				});
}

	
function deleteGameRecord(id){
		bootbox.confirm("Are you sure want to delete this record?", function(result) {
				if(result == true)
				{
			   		window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/deleteGame/id/"+id ;
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
		url: '<?php echo Yii::app()->params->base_path;?>admin/gameListing',
		data: 'keyword='+keyword,
		cache: false,
		success: function(data)
		{
			$("#gameList").html(data);
			$("#keyword").val(keyword);
		}
	});
}

function getAllSearch()
{
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/gameListing',
		data: '',
		cache: false,
		success: function(data)
		{
			$("#gameList").html(data);
			$("#keyword").val("");
		}
	});
}

function addTypeField(id)
{
	$("#faIcon_"+id).css("display","none");
	$("#loader_"+id).css("display","inline-block");
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/addGameTypeField',
		data:'id='+id,
		cache: false,
		success: function(data)
		{
			$("#coloumn_"+id).html(data);
		}
	});
}

function submitNewType(id)
{
	$("#iconSuccess_"+id).css("display","none");
	$("#iconFail_"+id).css("display","none");
	$("#loader_"+id).css("display","inline-block");
	
	var newvalue = $("#game_type_"+id+" option:selected").val();
	var newText = $("#game_type_"+id+" option:selected").text();
	
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/editGameTypeField',
		data:'id='+id+'&newvalue='+newvalue,
		cache: false,
		success: function(data)
		{
			var html = newText+'<img src="<?php echo Yii::app()->params->base_url; ?>images/input-spinner.gif" id="loader_'+id+'" style="display:none;float:right;" /><i id="faIcon_'+id+'" class="fa fa-pencil" style="float:right;" onclick="addTypeField('+id+')"></i>';
			$("#coloumn_"+id).html(html);
		}
	});
}

function cancelType(id)
{
	var oldvalue = $("#oldType_"+id).val();
	//alert(oldvalue);
	var html = oldvalue+'<img src="<?php echo Yii::app()->params->base_url; ?>images/input-spinner.gif" id="loader_'+id+'" style="display:none;float:right;" /><i id="faIcon_'+id+'" class="fa fa-pencil" style="float:right;" onclick="addTypeField('+id+')"></i>';
	$("#coloumn_"+id).html(html);
	return true;
	
}
</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Games <small>Game List  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">GameList</a> </li>
      <li class="pull-right">
        <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path ;?>admin/addGameDetails'" class="btn btn-primary" style="margin-top:-7px; margin-right:-30px;">Add New Game</button>
      </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>Game List </div>
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
      </div>
    </div>
  </div>
</div>
</div>
