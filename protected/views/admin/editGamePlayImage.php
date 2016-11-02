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



<!-- BEGIN EXAMPLE TABLE PORTLET-->

<!-- END EXAMPLE TABLE PORTLET-->

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Polls <small>GamePlay  Edit Image</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin/gamePlayListing">GamePlay Listing</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"><?php echo "Edit GamePlayImage" ;?></a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
  
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i><?php echo " Edit GamePly Images " ;?> </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body form"> 
   
    <!-- BEGIN FORM-->
    <form  id="form_sample_7" action="<?php echo Yii::app()->params->base_path ;?>admin/saveGamePlay" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-row-stripped">
      
  <?php // echo "<pre>";print_r($data);  ?>
      <div class="form-body">
              <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                You have some form validation errors. Please check below. </div>
              <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Your form validation is successful! </div>
              
           
              <div class="form-group" id="img1">
                <label class="control-label col-md-3">UserImage Name</label>
                <div class="col-md-9" id="mapContent">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="
					<?php 
					  // print_r($data); echo $data['ChoiceImage1']; die;
					if(isset($data['UserImageName']) && $data['UserImageName'] != '')
					{
                   		  echo Yii::app()->params->base_url;?>assets/upload/GamePlay/<?php echo $data['UserImageName'];
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
                        <input type="file" name="UserImageName" id="UserImageName" value="<?php if (isset( $data['UserImageName']) &&  $data['UserImageName'] != '') {echo $data['UserImageName']; }?>">
                        </span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                   </div>
               </div>
            
                </div>
              </div>
              <div class="form-group" id="img2">
                <label class="control-label col-md-3">OpponentImage Name</label>
                <div class="col-md-9" id="mapContent">
                 
                   
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="<?php 
					
					 if(isset($data['OpponentImageName']) && $data['OpponentImageName'] != '')
					{
                      echo Yii::app()->params->base_url;?>assets/upload/GamePlay/<?php echo $data['OpponentImageName']; 			 					}
					else
                     {
                        echo "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
                      } ?>" alt=""/>
                    
                </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
            </div>
               <div>
                        <span class="btn default btn-file">
                        <span class="fileinput-new">
                        Select image </span>
                        <span class="fileinput-exists">
                        Change </span>
                        <input type="file" name="OpponentImageName" id="OpponentImageName" value="<?php if (isset( $data['OpponentImageName']) &&  $data['OpponentImageName'] != '') {echo $data['OpponentImageName']; }?>">
                        </span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                   </div>
               </div>
                 
                </div>
              </div>
              
              <div class="form-actions fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-offset-3 col-md-9">
                   
                     <input type="hidden" name="GamePlayUniqueId" id="GamePlayUniqueId" value="<?php if(isset($data['GamePlayUniqueId'])) {  echo $data['GamePlayUniqueId']; } ?>" />  
                      <input type="hidden" name="submitFormData" id="submitFormData" value="" />
                    <button type="submit" id="submitForm" name="submitForm" onclick="return chkvalidate()" class="btn green" ><i class="fa fa-check"></i> Submit</button>
                     <input type="hidden" name="img1" id="img1" value="<?php if(isset($data['UserImageName'])) {  echo $data['UserImageName']; } ?>" />
                        <input type="hidden" name="img2" id="img2" value="<?php if(isset($data['OpponentImageName'])) {  echo $data['OpponentImageName']; } ?>" />
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

