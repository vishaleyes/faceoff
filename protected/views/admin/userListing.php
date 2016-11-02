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

function userDetailPopup(id)
{
		
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/showUserDetail&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					//autoHeight : true,
					scrolling : 'no',
					autoSize : false	,
					width    : "55%",
    				height   : "67%"  
				});
}

function changePasswordPopup(id)
{
	$.fancybox.open({
					href : '<?php echo Yii::app()->params->base_path ;?>admin/changeUserPassword&id='+id,
					type : 'iframe',
					padding : 10,
					margin : 10,
					width    : 500, 
					height   : '33%', 
					autoSize    : false, 
					closeClick  : false, 
					fitToView   : false,
					scrolling : 'no' 
				});
				
}


function getSearch()
{
	var keyword = $("#keyword").val();
	
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/userListing',
		data: 'keyword='+keyword,
		cache: false,
		success: function(data)
		{
			$("#userListDiv").html(data);
			$("#keyword").val(keyword);
		}
	});
}

function getAllSearch()
{
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/userListing',
		data: '',
		cache: false,
		success: function(data)
		{
			$("#userListDiv").html(data);
			$("#keyword").val("");
		}
	});
}

function suspendUser(id){
		bootbox.confirm("Are you sure want to suspend this user?", function(result) {
				if(result == true)
				{
			   		window.location.href="<?php echo Yii::app()->params->base_path ;?>admin/suspendUser/id/"+id ;
				}else{
					return true;
				}
			}); 
	}
	
function addStatusMenu(id)
{
	$("#faIcon_"+id).css("display","none");
	$("#loader_"+id).css("display","inline-block");
	var currentStatus = $("#userCurrentStatus_"+id).val();
	var currentStatusText = $("#coloumn_"+id).text();
	
	var html = '<select class="form-control" style="width:70%;float:left" name="userStatus_'+id+'" id="userStatus_'+id+'"> <option value="1" >Normal</option><option value="2" >Warning</option><option value="3" >Suspend</option></select>';
	
	html += '<i id="iconFail_'+id+'" class="fa fa-times" style="float:right;margin-top:10px;margin-left:10px;" onclick="cancelStatus('+id+')"></i><i id="iconSuccess_'+id+'" class="fa fa-check" style="float:right;margin-top:10px;margin-left:10px;" onclick="submitNewStatus('+id+')"></i><img src="<?php echo Yii::app()->params->base_url ; ?>images/input-spinner.gif" id="loader_'+id+'" style="display:none;float:right;margin-top:10px;" /><input type="hidden" id="userCurrentStatus_'+id+'" value="'+currentStatus+'" /><input type="hidden" id="userCurrentStatusText_'+id+'" value="'+currentStatusText+'" />';
	
	$("#coloumn_"+id).html(html);
	$('select[name^="userStatus_'+id+'"] option[value="'+currentStatus+'"]').attr("selected","selected");
	return true;
	
}

function cancelStatus(id)
{
	var currentStatusText = $("#userCurrentStatusText_"+id).val();
	var currentStatus = $("#userCurrentStatus_"+id).val();
	//alert(oldvalue);
	var html = currentStatusText+'<input type="hidden" name="userCurrentStatus_'+id+'" id="userCurrentStatus_'+id+'" value="'+currentStatus+'" /><img src="<?php echo Yii::app()->params->base_url; ?>images/input-spinner.gif" id="loader_'+id+'" style="display:none;float:right;" /><i id="faIcon_'+id+'" class="fa fa-pencil" style="float:right;" onclick="addStatusMenu('+id+')"></i>';
	$("#coloumn_"+id).html(html);
	return true;
	
}

function submitNewStatus(id)
{
	$("#iconSuccess_"+id).css("display","none");
	$("#iconFail_"+id).css("display","none");
	$("#loader_"+id).css("display","inline-block");
	
	var newvalue = $("#userStatus_"+id+" option:selected").val();
	var newText = $("#userStatus_"+id+" option:selected").text();
	
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/editUserStatus',
		data:'id='+id+'&newvalue='+newvalue,
		cache: false,
		success: function(data)
		{
			var html = newText+'<input type="hidden" name="userCurrentStatus_'+id+'" id="userCurrentStatus_'+id+'" value="'+newvalue+'" /><img src="<?php echo Yii::app()->params->base_url; ?>images/input-spinner.gif" id="loader_'+id+'" style="display:none;float:right;" /><i id="faIcon_'+id+'" class="fa fa-pencil" style="float:right;" onclick="addStatusMenu('+id+')"></i>';
			
			$("#coloumn_"+id).html(html);
			
			if(newvalue == 3)
			{
				var newRowClass = "danger";
			}else if(newvalue == 2)
			{
				var newRowClass = "warning";	
			}else{
				var newRowClass = "";
			}
			
			$("#row_"+id).attr("class",newRowClass);
			
			return true;
		}
	});
}

</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Users <small>Users all details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">UserList</a> </li>
      <!--<li class="pull-right">
        <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path ;?>admin/addUsers'" class="btn btn-primary" style="margin-top:-7px; margin-right:-30px;">Add New User</button>
      </li>-->
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>User List </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body">
    <div class="tabbable-custom nav-justified">
     
        <div class="tab-pane active" id="tab_1_1_1">
        	<div class="col-md-4" style="margin-bottom:10px !important">
            	<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Search Users" value="<?php if(isset($ext['keyword']) && $ext['keyword'] != "") { echo $ext['keyword'] ; } ?>" />
            </div>
            <div class="col-md-4">
                <button type="button" id="submitForm" name="submitForm" onclick="getSearch();" class="btn blue" ><i class="fa fa-search"></i> Search</button>
                <button type="button" id="submitForm" name="submitForm" onclick="getAllSearch();" class="btn blue" ><i class="fa fa-search"></i> Show All</button>
            </div>
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
               <td>
               <a href="<?php echo Yii::app()->params->base_path;?>admin/showUserProfile/id/<?php echo $row['UserId'];?>"><?php if(isset($row['UserName']) && $row['UserName'] != '') { echo $row['UserName']; } else { ?>
               </a><?php echo "<center>   -----</center>"; } ?>
               
               </td>
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
      </div>
   
  </div>
</div>
</div>
