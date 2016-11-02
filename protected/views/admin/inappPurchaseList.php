<!-- BEGIN PAGE LEVEL STYLES -->
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


function userDetailPopup(id)
{
	$.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path ;?>admin/showUserDetail',
		  data: 'id='+id,
		  cache: false,
		  success: function(data)
		  {
			if(data == 0 )
			{
				bootbox.alert("Data not found.");
			}else{
				var str = data ;
				bootbox.modal(str, 'User Details');
			}	
		  }
		 });
}

function showDetails(id){
	
		 var activeId = $("#activeId").val();
		 
		 $.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>user/getLogBookDetails',
		  data: 'logbook_id='+id,
		  cache: false,
		  success: function(data)
		  {
		  		 $("#detailDiv1").html(data);
				 $("#row_"+activeId).removeClass('active');
				 $("#row_"+id).addClass('active');
				 $("#activeId").val(id);
				 $('html, body').animate({
					scrollTop: $("#detailDiv1").offset().top
				 }, 1000);
		  }
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
</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> InAppPurchase <small>InAppPurchase List  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">InAppPurchase List</a> </li>
      <li class="pull-right">
        <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path ;?>user/addGameDetails'" class="btn btn-primary" style="margin-top:-7px; margin-right:-30px;visibility:hidden;">Add New InAppPurchase</button>
      </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>InAppPurchase List </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body">
    <div class="tabbable-custom nav-justified">
     
        <div class="tab-pane active" id="tab_1_1_1">
        
          <table class="table table-striped table-bordered table-hover" id="sample_5">
            <thead>
              <tr>
                <th> InApp Name </th>
                <th style="text-align:center !important"> Coins Qty </th>
              	<!--  <th> Price </th>-->
                <th style="text-align:center !important"> Purchase Date </th>
               <th> Created By </th>
                <th style="text-align:center !important"> Created On </th>
                <th style="text-align:center !important"> IsActive </th>
               <th>  Action </th>
              </tr>
            </thead>
            <tbody>
              <?php 
			// echo "<pre>";		print_r($data);die;
			  $i=1; foreach($data['inappData'] as $row) {
			
			
			 ?>
              <tr id="row_<?php echo $row['CoinsInAppTransUniqueId'] ; ?>" style="cursor:pointer;">
                <td><?php echo $row['InAppName'] ;?></td>
                <td style="text-align:center !important"><?php echo $row['CoinsQty'] ;?></td>
              	<!--  <td><?php echo $row['Price'] ;?></td>-->
                <td style="text-align:center !important"><?php echo $row['CreationDate'] ;?></td>
               	<td><?php echo $row['Users'] ;?></td>
                <td style="text-align:center !important"><?php echo $row['CreationDate'] ;?></td>
                <td align="center"><?php if($row['Active'] == 1) { ?><a href="<?php echo Yii::app()->params->base_path;?>admin/changePollsStatus/TOTPollUniqueId/<?php echo $row['CoinsInAppTransUniqueId'];?>/status/<?php echo $row['Active'];?>" title="Active" > <i class="fa fa-check"></i></a> <?php } else if($row['Active'] == 2) {  ?>
 <a  href="<?php echo Yii::app()->params->base_path;?>admin/changePollsStatus/TOTPollUniqueId/<?php echo $row['CoinsInAppTransUniqueId'];?>/status/<?php echo $row['Active'];?>" title="InActive"> <i class="fa fa-close"></i> </a> <?php } ?></td>
                <td align="center">
                 <a href="#" onclick="pollsDetailPopup('<?php echo $row['CoinsInAppTransUniqueId'];?>');" class="tip" title="View Details"><i class="fa fa-search"></i></a> </td>
               
              </tr>
              <?php $i++; } ?>
            </tbody>
          </table>
          <input type="hidden" id="activeId" value="" />
          <!-- END EXAMPLE TABLE PORTLET--> 
          <br/>
          <div id="detailDiv1"></div>
        </div>
        
        
    </div>
  </div>
</div>
