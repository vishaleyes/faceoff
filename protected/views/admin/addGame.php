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
  
  
  
  function chkvalidate()
  {
	 
	 var gametype =  $('#game_type_drop_down').val();
	 
	 var imgname = $('#imgname').val();
	 var gameid = $('#GameUniqueId').val();
	// alert(imgname);alert(gameid);
	 
	  if(gametype == 6)
	  {
		  if(imgname == '' && (gameid == '' || gameid != ''))
		  {
		    $('#ImageName').addClass('required');
		  }
		  if(image != '' && gameid != '')
		  {
			  $('#ImageName').removeClass('required');
		  }
	  }
	  else
	  {
		   $('#ImageName').removeClass('required');
	  }
	  	 
  }
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
   ComponentsPickers.init();
   UIAlertDialogApi.init();
   FormValidation.init();
  // ComponentsFormTools.init();

  $( "select" )
	.change(function () {
			var str = "";
			$( "select option:selected" ).each(function() {
			gametype = $( this ).val() + " ";
			//alert(gametype);
			
	 var imgname = $('#imgname').val();
	 
	     
			  if(gametype == 6)
			  {
				  if(imgname == '')
			 	{
				   $('#ImageName').addClass('required');
				   $('#isimage').css("display","block");
				 }
				 else
				 {
				   $('#ImageName').removeClass('required');
				   $('#isimage').css("display","none");
				 }
			  }
			  else
			  {
				   $('#ImageName').removeClass('required');
				   $('#isimage').css("display","none");
				  
				   
			  }
			});
			//$( "div" ).text( str );
	})
	.change();
  
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
	

</script>


<!-- BEGIN EXAMPLE TABLE PORTLET-->

<!-- END EXAMPLE TABLE PORTLET-->

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Game <small>Game all  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin/gameListing">Game Listing</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"><?php echo $title ;?></a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i><?php echo " Game Details" ;?> </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body form"> 
 
    <!-- BEGIN FORM-->
    <form  id="form_sample_7" action="<?php echo Yii::app()->params->base_path ;?>admin/saveGameDetails" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-row-stripped">
      
     <?php  // echo "<pre>"; print_r($data);die;  ?>
      <div class="form-body">
              <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                You have some form validation errors. Please check below. </div>
              <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Your form validation is successful! </div>
              <div class="form-group">
              
        <label class="control-label col-md-3">Game Type</label>
        <div class="col-md-6">
          <select  class="form-control input-xlarge select2me" name="game_type_drop_down" id="game_type_drop_down">
            <?php 
			
			$objgameType = new TblGame();
			$gameTypeList = $objgameType->geAlltGameType();			
			
			foreach ($gameTypeList as $row) {  ?>
            <option <?php if($data['GameTypeUniqueId'] == $row['GameTypeUniqueId']) {  ?> selected="selected" <?php } ?> value="<?php echo $row['GameTypeUniqueId'] ; ?>"><?php echo $row['GameTypeDescription'] ; ?></option>
            <?php } ?>
          </select>
          </div>
      
      
                    
                </div>
             <div class="form-group">
                <label class="control-label col-md-3">Game Text<span class="required">*</span></label>
                <div class="col-md-9">
                  <input type="text" data-inline="true" id="GameText" name="GameText" placeholder="Enter GameText" class="form-control required" value="<?php if(isset($data['GameText']) && $data['GameText'] != "" ) { echo $data['GameText'] ; } ?>"/>
                </div>
              </div>
              
              
              <div class="form-group" id="img1">
                <label class="control-label col-md-3">Game Image<span class="required" id="isimage">*</span></label>
                <div class="col-md-9" id="mapContent">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="
					<?php  
					if(isset($data['ImageName']) && $data['ImageName'] != '')
					{
                     echo Yii::app()->params->base_url;?>assets/upload/Games/<?php echo $data['ImageName'];
					}
                    else
                    {
                         echo "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
                    }?>" alt=""/>
                </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
            </div>
               <div>
                        <span class="btn default btn-file">
                        <span class="fileinput-new">
                        Select image </span>
                        <span class="fileinput-exists">
                        Change </span>
                        <input type="file" name="ImageName" id="ImageName" >
                        </span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                   </div>
               </div>
            
                </div>
              </div>
                
              <div class="form-group">
                <label class="control-label col-md-3">&nbsp;</label>
                <div class="col-md-9" id="mapContent">
                  <label>
                    <input type="checkbox" name="Active" id="Active" <?php if($data['Active'] == 1 || !isset($data['Active'])){ ?> checked="checked" <?php } ?>/> IsActive
                 </label>
                </div>
              </div>
              <div class="form-actions fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-offset-3 col-md-9">
                   
                     <input type="hidden" name="GameUniqueId"  id="GameUniqueId" value="<?php if(isset($data['GameUniqueId'])) {  echo $data['GameUniqueId']; } ?>" />  
                       <input type="hidden" name="imgname"  id="imgname" value="<?php if(isset($data['ImageName'])) {  echo $data['ImageName']; } ?>" />  
                      <input type="hidden" name="submitFormData" id="submitFormData" value="" />
                      <button type="submit" id="submitForm" name="submitForm" onclick="return chkvalidate()" class="btn green" ><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn default">Reset</button>
                    </div>
                  </div>
                </div>
              </div>
      </div>
     
    </form>
    <!-- END FORM--> 
  </div>
  </div>

<!-- END EXAMPLE TABLE PORTLET--> 

