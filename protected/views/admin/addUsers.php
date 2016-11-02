<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" media="all" rel="stylesheet" type="text/css"/>

<style type="text/css">
.fa-star {
	color: #f8be2c !important;
}
</style>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->

<!-- END THEME STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/html2canvas/html2canvas.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=drawing"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/ui-alert-dialog-api.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/form-validation.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-rating/js/star-rating.js" type="text/javascript"></script>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<script type="text/javascript">
    var $ = jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
   ComponentsPickers.init();
   UIAlertDialogApi.init();
   FormValidation.init();
  // ComponentsFormTools.init();
   
});


$(document).ready(function(){
    
   $('#addBusiness').hide();

    // when button is pressed
    $('#add').on('click',function(){  
		$('#Businessdropdown').hide();
		$("#addBusiness").css("display","block");
      	$('#addBusiness').show();
		//$("#shop_name_drop_down").val("0");
		//$("#shop_name_drop_down").prop('selectedIndex', 0);
		$("#shopType").val("1");
		//$('#shop_name_drop_down option:nth(0)').attr("selected", "selected");
	
   });
   
    $('#remove').on('click',function(){  
		$('#addBusiness').hide();
		$("#Businessdropdown").css("display","block");
		$('#Businessdropdown').show();
		$("#shop_name").val("");
		$("#shopType").val("0");
			
   });
   
});

function showDetails(id){
	
		 var activeId = $("#activeId").val();
		 
		 $.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>user/getLogBookDetails',
		  data: 'logbook_id='+id,
		  cache: false,
		  success: function(data)
		  {
		  		 $("#detailDiv").html(data);
				 $("#row_"+activeId).removeClass('active');
				 $("#row_"+id).addClass('active');
				 $("#activeId").val(id);
				 $('html, body').animate({
					scrollTop: $("#detailDiv").offset().top
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
	



function checkInDiveSite(id){
	$.ajax({
			  type: 'POST',
			  url: '<?php echo Yii::app()->params->base_path;?>user/getdiveLocationOnMap',
			  data: 'diveLocationId='+id,
			  cache: false,
			  success: function(data)
			  {
				$("#mapContent").html(data);
		  }
	 });
}
	

</script>


<!-- BEGIN EXAMPLE TABLE PORTLET-->

<!-- END EXAMPLE TABLE PORTLET-->

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Users <small>Users all  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin/userListing">Users Listing</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"><?php echo $title ;?></a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i><?php echo " User Details" ;?> </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body form"> 
    <!-- BEGIN FORM-->
    <form  id="form_sample_7" action="<?php echo Yii::app()->params->base_path ;?>admin/savePollsDetails" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-row-stripped">
      <div class="form-body">
      <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        You have some form validation errors. Please check below. </div>
      <div class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button>
        Your form validation is successful! </div>
     
      <!--<div class="form-group" id="Businessdropdown" style="display:block;">
        <label class="control-label col-md-3">GameType<span class="required">*</span></label>
        <div class="col-md-6">
          <select  class="form-control input-xlarge select2me required" name="game_type_drop_down" id="game_type_drop_down">
            <option value="">Select GameType</option>
     <?php /*?>       <?php 
			
			$objgameType = new TblGame();
			$gameTypeList = $objgameType->getGameType();
			
			foreach ($gameTypeList as $row) {  ?>
            <option <?php if($polls['GameTypeUniqueId'] == $row['GameTypeUniqueId']) {  ?> selected="selected" <?php } ?> value="<?php echo $row['GameTypeUniqueId'] ; ?>"><?php echo $row['GameTypeDescription'] ; ?></option>
            <?php } ?><?php */?>
          </select>
          </div>
      
      </div>-->
     
                
    <!--  <input type="hidden" name="shopType" id="shopType" value="0" />
      -->
      
       <div class="form-group">
        <label class="control-label col-md-3">FirstName<span class="required">*</span></label>
        <div class="col-md-9">
          <input type="text" data-inline="true" id="FirstName" name="FirstName" placeholder="Enter FirstName" class="form-control required input-xlarge required" value="<?php if(isset($polls['FirstName']) && $polls['FirstName'] != "" ) { echo $polls['FirstName'] ; } ?>"/>
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3">LastName<span class="required">*</span></label>
        <div class="col-md-9">
          <input type="text" data-inline="true" id="LastName" name="LastName" placeholder="Enter LastName" class="form-control input-xlarge required" value="<?php if(isset($polls['LastName']) && $polls['LastName'] != "" ) { echo $polls['LastName'] ; } ?>"/>
        </div>
      </div>
      
      
       <div class="form-group">
        <label class="control-label col-md-3">Gender</label>
        <div class="col-md-9">
          Male &nbsp;<input type="radio" name="Gender" id="Gender" class="validate[required] styled" value="1" <?Php if(isset($polls['status']) && $polls['status'] == "1") { ?> checked="checked" <?php }?> />
             Female &nbsp;<input type="radio" name="Gender" id="Gender" class="validate[required] styled" value="0" <?Php if(isset($polls['Gender']) && $polls['Gender'] == "0") { ?> checked="checked" <?php }?>/>
        </div>
      </div>
      
       <div class="form-group">
        <label class="control-label col-md-3">BirthDate</label>
        <div class="col-md-9" id="mapContent">
          <label>
			 <input type="text" name="BirthDate" id="BirthDate" 
             class="form-control form-control-inline input-medium date-picker" size="16"
               value="<?php if(isset($polls['BirthDate']) && $polls['BirthDate'] != "" ) { echo date("d-m-Y",strtotime($polls['BirthDate'])) ; } ?>"/>
	     </label>
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3">ProfileImage</label>
        <div class="col-md-9" id="mapContent">
          <label>
			<!-- <input type="file" name="image1" />
             <span><img src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/<?php echo $polls['ProfileImage']; ?>" width="112" height="112" /></span>-->
             
       <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="<?php  if(isset($polls['ProfileImage']) && $polls['ProfileImage'] != ''){
				echo Yii::app()->params->base_url;?>assets/upload/avatar/<?php echo $polls['ProfileImage']; }
				else
				{
					echo "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				}
				?>" alt=""/>
        </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
    </div>
       <div>
                <span class="btn default btn-file">
                <span class="fileinput-new">
                Select image </span>
                <span class="fileinput-exists">
                Change </span>
                <input type="file" name="avatar">
                </span>
                <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                Remove </a>
           </div>
       </div>
       </label>
        </div>
      </div>
      
      
      <div class="form-group" id="Businessdropdown" style="display:block;">
        <label class="control-label col-md-3">LoginType<span class="required">*</span></label>
        <div class="col-md-6">
          <select  class="form-control input-xlarge select2me required" name="game_type_drop_down" id="game_type_drop_down">
            <option value="">Select LoginType</option>
            <option <?php if($polls['LoginType'] == 1) {  ?> selected="selected" <?php } ?> value="1"><?php echo "Email"; ?></option>
             <option <?php if($polls['LoginType'] == 2) {  ?> selected="selected" <?php } ?> value="2"><?php echo "Facebook"; ?></option>
             <option <?php if($polls['LoginType'] == 3) {  ?> selected="selected" <?php } ?> value="3"><?php echo "Twitter"; ?></option>
          </select>
          </div>
      
      </div>
      
       
       <div class="form-group">
        <label class="control-label col-md-3">SocialLoginId</label>
        <div class="col-md-9" id="mapContent">
          <label>
			<input type="text" name="SocialLoginId" class=" input-xlarge validate[required,custom[email]] form-control" placeholder="Enter SocialLoginId" value="<?php if(isset($polls['SocialLoginId']) && $polls['SocialLoginId'] != "") { echo $polls['SocialLoginId']; 
                } ?>" />
	     </label>
        </div>
      </div>
      
      
      
       <div class="form-group" id="Businessdropdown" style="display:block;">
        <label class="control-label col-md-3">FavouriteGame</label>
        <div class="col-md-6">
          <select  class="form-control input-xlarge select2me" name="game_type_drop_down" id="game_type_drop_down">
            <option value="">Select FavouriteGame</option>
            <?php 
			
			$objgameType = new TblGame();
			$gameTypeList = $objgameType->getGameType();			
			
			foreach ($gameTypeList as $row) {  ?>
            <option <?php if($polls['FavouriteGameplayId'] == $row['GameTypeUniqueId']) {  ?> selected="selected" <?php } ?> value="<?php echo $row['GameTypeUniqueId'] ; ?>"><?php echo $row['GameTypeDescription'] ; ?></option>
            <?php } ?>
          </select>
          </div>
      
      </div>
      
      
       <div class="form-group" id="Businessdropdown" style="display:block;">
        <label class="control-label col-md-3">DeviceType<span class="required">*</span></label>
        <div class="col-md-6">
          <select  class="form-control input-xlarge select2me required" name="game_type_drop_down" id="game_type_drop_down">
            <option value="">Select DeviceType</option>
            <option <?php if($polls['LoginType'] == 1) {  ?> selected="selected" <?php } ?> value="1"><?php echo "Android"; ?></option>
             <option <?php if($polls['LoginType'] == 2) {  ?> selected="selected" <?php } ?> value="2"><?php echo "iPhone"; ?></option>
            
          </select>
          </div>
      
      </div>
      
       
      <div class="form-group">
        <label class="control-label col-md-3">AppVersion</label>
        <div class="col-md-9">
          <input type="text" data-inline="true" id="AppVersion" name="AppVersion" placeholder="Enter AppVersion" class="form-control input-xlarge required" value="<?php if(isset($polls['AppVersion']) && $polls['AppVersion'] != "" ) { echo $polls['AppVersion'] ; } ?>"/>
        </div>
      </div>
      
       <div class="form-group">
        <label class="control-label col-md-3">Email<span class="required">*</span></label>
        <div class="col-md-9" id="mapContent">
          <label>
			<input type="text" name="Email" class="validate[required,custom[email]] form-control required" placeholder="Enter User email" value="<?php if(isset($polls['Email']) && $polls['Email'] != "") { echo $polls['Email']; 
                } ?>" />
	     </label>
        </div>
      </div>
      
     
      <div class="form-group">
        <label class="control-label col-md-3">Password<span class="required">*</span></label>
        <div class="col-md-9">
          <input type="password" data-inline="true" id="Password" name="Password" placeholder="Enter Password" class="form-control required input-xlarge required" value="<?php if(isset($polls['Password']) && $polls['Password'] != "" ) { echo $polls['Password'] ; } ?>"/>
        </div>
      </div>
        
      <div class="form-group">
        <label class="control-label col-md-3">&nbsp;</label>
        <div class="col-md-9" id="mapContent">
          <label>
			<input type="checkbox" name="Active" id="Active" <?php if($polls['Active']){ ?> checked="checked" <?php } ?>/> IsActive
	     </label>
        </div>
      </div>
      
      
      <div class="form-actions fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-offset-3 col-md-9">
           
             <input type="hidden" name="TOTPollUniqueId" id="TOTPollUniqueId" value="<?php if(isset($polls['TOTPollUniqueId'])) {  echo $polls['TOTPollUniqueId']; } ?>" />  
              <input type="hidden" name="submitFormData" id="submitFormData" value="" />
              <button type="submit" id="submitForm" name="submitForm" class="btn green" ><i class="fa fa-check"></i> Submit</button>
              <button type="reset" class="btn default">Reset</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- END FORM--> 
  </div>
</div>
<!-- END EXAMPLE TABLE PORTLET--> 

