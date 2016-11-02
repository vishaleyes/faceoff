<?php error_reporting(0); ?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    var $ = jQuery.noConflict();
</script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript">

	

function getCityList(name){
	var countryName = name ;
	$("#countryLoader").css("display","");
	$.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>admin/getCityListByCountryName',
		  data: 'countryName='+countryName,
		  cache: false,
		  success: function(data)
		  {
			if(data != 0)
			{
				$("#cityDiv").css("display","block");
				$("#city").html(data);
			}else{
				$("#city").html();
				$("#cityDiv").css("display","none");
			}
			$("#countryLoader").css("display","none");
		  }
		 });
}

	$(document).ready(function() {
		
		
		 $("#EditPhoto").click(function() {
			
            if($("#profile_image").val() == "")
			{
					alert("Please select Profile Picture.");	
					return false;
					
			}
			
        });
		
		$("#reset").click(function()
		{
			 $("#firstname").val("");	
			 $("#lastname").val("");	
			 $("#dob").val("");	
			 $("#gender").val("");	
			 $("#email").val("");
			 $("#country").val("");	
			 $("#city").val("");	
			 $("#activitypreference").val("");	
			 $("#licensenumber").val("");	
			 $("#location").val("");	

    
		});       
		
    });

		
		
	
	
	
	




function validatePassword()
{
	$('#passworderror').removeClass();
	$('#passworderror').html('');
	var password=document.getElementById('password').value;
	if(password=='')
	{
		$('#passworderror').addClass('false');
		$('#passworderror').html('Please enter password.');
		return false;
	}
	else if(password.length < 6)
	{
		$('#passworderror').addClass('false');
		$('#passworderror').html('Password must be greater than 6 character.');
		return false;
	}
	else
	{
		$('#passworderror').removeClass();
		$('#passworderror').addClass('true');
		$('#passworderror').html('Ok');
		return true;
	}
}

function validateoPassword()
{
	$('#opassworderror').removeClass();
	$('#opassworderror').html('');
	var password=document.getElementById('opassword').value;
	if(password=='')
	{
		$('#opassworderror').addClass('false');
		$('#opassworderror').html('Please enter password.');
		return false;
	}
	else if(password.length < 6)
	{
		$('#opassworderror').addClass('false');
		$('#opassworderror').html('Password must be greater than 6 character.');
		return false;
	}
	else
	{
		$('#opassworderror').removeClass();
		$('#opassworderror').addClass('true');
		$('#opassworderror').html('Ok');
		return true;
	}
}

function validateCPassword()
{
	$('#cpassworderror').removeClass();
	$('#cpassworderror').html('');
	var cpassword=document.getElementById('cpassword').value;
	var password=document.getElementById('password').value;

	if(password=='')
	{
		$('#cpassworderror').addClass('false');
		$('#cpassworderror').html('Please enter confirm paswword.');
		return false;
	}
	else if(password!=cpassword)
	{
		$('#cpassworderror').addClass('false');
		$('#cpassworderror').html('Password and confirm paswword not match.');
		return false;
	}
	else
	{
		$('#cpassworderror').removeClass();
		$('#cpassworderror').addClass('true');
		$('#cpassworderror').html('Ok');
		return true;
	}
}
function validateAll()
{
	var flag=0;
	
	if(!validateoPassword())
	{
		return false;
	}
	if(!validatePassword())
	{
		return false;
	}
	if(!validateCPassword())
	{
		return false;
	}
	return true;
}
</script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<!-- END PAGE LEVEL STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/frontend/pages/css/portfolio.css" rel="stylesheet">

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
 ComponentsPickers.init();
});



function showDetails(date){
	
		 window.location.href='<?php echo Yii::app()->params->base_path;?>admin/getDiveNewsViewList/date/'+date;
	}
	
</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> User Profile <small>see all user details</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo Yii::app()->params->base_path ;?>user">Home</a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#">User Profile</a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row profile">
  <div class="col-md-12"> 
    <!--BEGIN TABS-->
    <div class="tabbable tabbable-custom tabbable-full-width">
      <ul class="nav nav-tabs">
        <li class="active"> <a href="#tab_1_1" data-toggle="tab"> Overview </a> </li>
        <li> <a href="#tab_1_3" data-toggle="tab"> Account </a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">
          <div class="row">
            <div class="col-md-3">
              <ul class="list-unstyled profile-nav">
                <li>
                  <?php 
					if(isset(Yii::app()->session['avatar']) && Yii::app()->session['avatar'] != "") {
						$url = Yii::app()->params->base_url."assets/upload/avatar/".Yii::app()->session['avatar'];
					}else {
						$url = Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
					}
				?>
                  <img src="<?php echo $url ; ?>" class="img-responsive" alt="" /> 
                </li>
              </ul>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-8 profile-info">
                  <h1> <?php echo $data['first_name']. "  " . $data['last_name'];?></h1>
                  <p><?php echo $data['email'] ?></p>
                </div>
                <!--end col-md-8--> 
                
              </div>
              <!--end row--> 
              
            </div>
          </div>
        </div>
        <!--tab_1_2-->
        <div class="tab-pane" id="tab_1_3">
          <div class="row profile-account">
            <div class="col-md-3">
              <ul class="ver-inline-menu tabbable margin-bottom-10">
                <li class="active"> <a data-toggle="tab" href="#tab_1-1"> <i class="fa fa-cog"></i> Personal info </a> <span class="after"> </span> </li>
                <li> <a data-toggle="tab" href="#tab_2-2"> <i class="fa fa-picture-o"></i> Change Avatar </a> </li>
                <li> <a data-toggle="tab" href="#tab_3-3"> <i class="fa fa-lock"></i> Change Password </a> </li>
                <!--<li> <a data-toggle="tab" href="#tab_3-4"> <i class="fa fa-meh-o"></i> Profile Setting </a> </li>-->
                
              </ul>
            </div>
            <div class="col-md-9">
              <div class="tab-content">
                <div id="tab_1-1" class="tab-pane active">
                  <form  id="form_sample_7" action="<?php echo Yii::app()->params->base_path ;?>admin/editAdminProfile" method="post" enctype="multipart/form-data"
                                                		class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-group">
                      <label class="control-label">First Name</label>
                      <input type="text" name="first_name" id="first_name" class="validate[required] span12 input-xlarge form-control"
                                                     placeholder="Enter first name"  value="<?php if(isset($data['first_name']) && $data['first_name'] != "") { echo $data['first_name']; } ?>" />
                    </div>
                    <div class="form-group">
                      <label class="control-label">Last Name</label>
                      <input type="text" id="last_name"  name="last_name" class="validate[required] span12 input-xlarge form-control" placeholder="Enter last name" value="<?php if(isset($data['last_name']) && $data['last_name'] != "") { echo $data['last_name']; } ?>" />
                    </div>
                    <br/>
                    <div class="margiv-top-10">
                      <input type="hidden" id="id" name="id" value="<?php if(isset($data['id']) && $data['id'] != "" ) { echo $data['id'] ; } ?>">
                      <button type="submit" name="SaveChanges" class="btn green">Save Changes</button>
                      <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/myprofile'" class="btn green">Cancel</button>
                      <button type="button" id="reset" name="reset" class="btn-large btn">Reset</button>
                    </div>
                  </form>
                </div>
                <div id="tab_2-2" class="tab-pane">
                  <p> Edit Profile Picture </p>
                  <form id="form_sample_8" action="<?php echo Yii::app()->params->base_path ;?>admin/editAdminProfile" method="post" enctype="multipart/form-data"
                                                		class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-group">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $url ;?>" class="img-responsive" alt=""/> </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                        <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
                          <input type="file"  name="profile_image" id ="profile_image"  />
                          </span> <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                      </div>
                      
                    </div>
                    <div class="margin-top-10">
                      <input type="hidden" id="id" name="id" value="<?php if(isset($data['id']) && $data['id'] != "" ) { echo $data['id'] ; } ?>">
                      <button type="submit" name="EditPhoto" id="EditPhoto" class="btn green" >Save Changes</button>
                      <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/myprofile'" class="btn default">Cancel</button>
                    </div>
                  </form>
                </div>
                <div id="tab_3-3" class="tab-pane">
                  <form id="form_sample_10" action="<?php echo Yii::app()->params->base_path ;?>admin/editAdminProfile" method="post" enctype="multipart/form-data"
    class="form-horizontal form-bordered form-row-stripped">
                    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                    <div class="form-group">
                      <label class="control-label">Current Password</label>
                      <input type="password" name="opassword" id="opassword" 
	                value="" class="form-control" onkeyup= "validateoPassword()" />
                      <span id="opassworderror"></span> </div>
                    <div class="form-group">
                      <label class="control-label">New Password</label>
                      <input type="password" name="password" id="password" 
	                value="" class="form-control"  onkeyup="validatePassword()" />
                      <span id="passworderror"></span> </div>
                    <div class="form-group">
                      <label class="control-label">Re-type New Password</label>
                      <input type="password"  name="cpassword"   id="cpassword" 
	                value="" class="form-control" onkeyup="validateCPassword()" />
                      <span id="cpassworderror"></span> </div>
                    <div class="margin-top-10">
                    <input type="hidden" id="id" name="id" value="<?php if(isset($data['id']) && $data['id'] != "" ) { echo $data['id'] ; } ?>">
                    <button type="submit" name="ChangePassword" class="btn green">Change Password</button>
                    <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/myprofile'" class="btn default">Cancel</button>
                  </form>
                </div>
              </div>
              <div id="tab_3-4" class="tab-pane">
                <form id="form_sample_10" action="<?php echo Yii::app()->params->base_path ;?>admin/editAdminProfile" method="post" enctype="multipart/form-data"
    class="form-horizontal form-bordered form-row-stripped">
                  <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                  <div class="form-group">
                    <label class="control-label">Current Password</label>
                    <input type="password" name="opassword" id="opassword" 
	                value="" class="form-control" onkeyup= "validateoPassword()" />
                    <span id="opassworderror"></span> </div>
                  <div class="margin-top-10">
                  <input type="hidden" id="id" name="id" value="<?php if(isset($data['id']) && $data['id'] != "" ) { echo $data['id'] ; } ?>">
                  <button type="submit" name="ChangePassword" class="btn green">Change Password</button>
                  <button type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/myprofile'" class="btn default">Cancel</button>
                </form>
              </div>
            </div>
          </div>
          <!--end col-md-9--> 
        </div>
      </div>
      <!--end tab-pane--> 
      
      <!--end tab-pane--> 
      
      <!--end tab-pane--> 
    </div>
  </div>
  <!--END TABS--> 
</div>
</div>
<!-- END PAGE CONTENT-->