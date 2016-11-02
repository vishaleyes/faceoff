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
 function  Check()
  {
	 var gametype = $('input[name=GameTypeUniqueId]:checked').val();
		//alert(v);
		 if(gametype == 4){
			 $('#imgdiv1').hide();
			  $('#imgdiv2').hide();
		 }
		 if(gametype == 5)
		 {
			 $('#imgdiv1').show();
			  $('#imgdiv2').show();
		 }
		
  }
  
  function chkvalidate()
  {
	 
	  var gametype = $('input[name=GameTypeUniqueId]:checked').val();
	
	  var img1 =  $('#img1').val(); 
	   var img2 =  $('#img2').val(); 
	   var pollid = $('#TOTPollUniqueId').val();
	// alert("image1  " + img1);	   alert("image2  " + img2);
	   
	   //  var v1 = 	$('#image2 input[type=file]').val()
				//console.log(v1);
				//alert(v1);
		
		 if(gametype == 5)
		 {
			   // For Image1
			   if(img1 == '' && ( pollid == '' || pollid != ''))
			  {
			     $('#image1').addClass('required');
		  	  }
			    if(img1 != '' && pollid != '')
			  {
				  $('#image1').removeClass('required');
			  }
			  // For Image2
			    if(img2 == '' && ( pollid == '' || pollid != ''))
			  {
			     $('#image2').addClass('required');
		  	  }
			    if(img2 != '' && pollid != '')
			  {
				  $('#image2').removeClass('required');
			  }
			  
			  
		 }
		 if(gametype == 4)
		 {
			 $('#image1').removeClass('required');
			 $('#image2').removeClass('required');		  
		 }
  }
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
   ComponentsPickers.init();
   UIAlertDialogApi.init();
   FormValidation.init();
  // ComponentsFormTools.init();

  // Check in Edit Mode
  var id = $('#TOTPollUniqueId').val();
  if(id != '')
  {
	var gametype = $('input[name=GameTypeUniqueId]:checked').val();
	 // alert(gametype);
	    if(gametype == 5)
		{
		     $('#imgdiv1').show();
			 $('#imgdiv2').show();
		}
		if (gametype == 4)
		{
		      $('#imgdiv1').hide();
			  $('#imgdiv2').hide();
		}
  }
  /// End 
  
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
    <h3 class="page-title"> Polls <small>Polls all  details and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>admin/pollsListing">Polls Listing</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"><?php echo $title ;?></a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
  
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i><?php echo " Polls Details" ;?> </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body form"> 
   
    <!-- BEGIN FORM-->
    <form  id="form_sample_7" action="<?php echo Yii::app()->params->base_path ;?>admin/savePollsDetails" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-row-stripped">
      
  <?php // echo "<pre>";print_r($polls);  ?>
      <div class="form-body">
              <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                You have some form validation errors. Please check below. </div>
              <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Your form validation is successful! </div>
              <div class="form-group">
                <label class="control-label col-md-3">Game Type</label>
                <div class="col-md-9">
                 
                  <?php
				  
				 
				  	if(isset($polls["GameTypeUniqueId"]) && $polls["GameTypeUniqueId"] == 5 ) 
					{ 
						$str = 'checked="checked"'; 
					} 
					else 
					{ 
						$str = 'checked="checked"'; 
					} 
					?> 
				  
                  
                  <input type="radio"  name="GameTypeUniqueId" onclick="Check()"  id="GameTypeUniqueId" <?php echo $str; ?>  value = "5" class="form-control "/>
                  
                                    
                           <font style="position:relative; top:5px; left:8px">Image</font> &nbsp;&nbsp;
                  <input type="radio"  name="GameTypeUniqueId" onclick="Check()"  id="GameTypeUniqueId"  value = "4" <?php if(isset($polls["GameTypeUniqueId"]) && $polls["GameTypeUniqueId"] == 4 ) { ?> checked="checked" <?php } ?> class="form-control "/>
                              <font style="position:relative; top:5px; left:10px">Text</font>
                    </div>
                    
                </div>
             <div class="form-group">
                <label class="control-label col-md-3">Game Text<span class="required">*</span></label>
                <div class="col-md-9">
                  <input type="text" data-inline="true" id="GameText" name="GameText" placeholder="Enter GameText" class="form-control required" value="<?php if(isset($polls['GameText']) && $polls['GameText'] != "" ) { echo $polls['GameText'] ; } ?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Choice1</label>
                <div class="col-md-9">
                  <input type="text" data-inline="true" id="Choice1" name="Choice1" placeholder="Enter Choice1" class="form-control" value="<?php if(isset($polls['Choice1']) && $polls['Choice1'] != "" ) { echo $polls['Choice1'] ; } ?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Choice2</label>
                <div class="col-md-9">
                  <input type="text" data-inline="true" id="Choice2" name="Choice2" placeholder="Enter Choice2" class="form-control" value="<?php if(isset($polls['Choice2']) && $polls['Choice2'] != "" ) { echo $polls['Choice2'] ; } ?>"/>
                </div>
              </div>
              <div class="form-group" id="imgdiv1">
                <label class="control-label col-md-3">Choice Image1<span class="required">*</span></label>
                <div class="col-md-9" id="mapContent">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="
					<?php 
					  // print_r($polls); echo $polls['ChoiceImage1']; die;
					if(isset($polls['ChoiceImage1']) && $polls['ChoiceImage1'] != '')
					{
                   		  echo Yii::app()->params->base_url;?>assets/upload/polls/<?php echo $polls['ChoiceImage1'];
					}
                    else
                    {
                         //echo "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
						 echo Yii::app()->params->base_url;?>assets/upload/polls/<?php echo "noimage.jpg";
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
                        <input type="file" name="image1" id="image1" value="<?php if (isset( $polls['ChoiceImage1']) &&  $polls['ChoiceImage1'] != '') {echo $polls['ChoiceImage1']; }?>">
                        </span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                   </div>
               </div>
            <span style="color:red"><b>Image1 Size should be 1178(w) X 907(H).</b></span>
                </div>
              </div>
              <div class="form-group" id="imgdiv2">
                <label class="control-label col-md-3">Choice Image2<span class="required">*</span></label>
                <div class="col-md-9" id="mapContent">
                 
                   
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="<?php 
					
					 if(isset($polls['ChoiceImage2']) && $polls['ChoiceImage2'] != '')
					{
                      echo Yii::app()->params->base_url;?>assets/upload/polls/<?php echo $polls['ChoiceImage2']; 			 					}
					else
                     {
                        //echo "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
						 echo Yii::app()->params->base_url;?>assets/upload/polls/<?php echo "noimage.jpg";
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
                        <input type="file" name="image2" id="image2" value="<?php if (isset( $polls['ChoiceImage2']) &&  $polls['ChoiceImage2'] != '') {echo $polls['ChoiceImage2']; }?>">
                        </span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                   </div>
               </div>
                 <span style="color:red"><b>Image2 Size should be 1178(w) X 907(H).</b></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">End Date</label>
                <div class="col-md-9" id="mapContent">
                  <label>
                     <input type="text" name="EndDate" id="EndDate" 
                     class="form-control form-control-inline input-medium date-picker" size="16"
                       value="<?php if(isset($polls['EndDate']) && $polls['EndDate'] != "" ) { echo date("d-m-Y",strtotime($polls['EndDate'])) ; } ?>"/>
              
              
           
                 </label>
                </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-3">Font Color</label>
                <div class="col-md-9" id="mapContent">
                  <label>
                    
                    <input type="text" class="colorpicker-default form-control"  name="FontColor" id="FontColor" value="<?php if(isset($polls['FontColor']) && $polls['FontColor'] != "" ) { echo $polls['FontColor'] ; } else { echo "#8fff00" ;}  ?>">
                 </label>
                </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-3">Background Color</label>
                <div class="col-md-9" id="mapContent">
                  <label>
                     
                     <input type="text" class="colorpicker-default form-control"  name="BackgroundColor" id="BackgroundColor"  value="<?php if(isset($polls['BackgroundColor']) && $polls['BackgroundColor'] != "" ) { echo $polls['BackgroundColor'] ; } else { echo "#8fff00" ;}  ?>">
                    
                 </label>
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
                       <input type="hidden" name="img1" id="img1" value="<?php if(isset($polls['ChoiceImage1'])) {  echo $polls['ChoiceImage1']; } ?>" />
                        <input type="hidden" name="img2" id="img2" value="<?php if(isset($polls['ChoiceImage2'])) {  echo $polls['ChoiceImage2']; } ?>" />
                      
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

