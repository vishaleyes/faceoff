<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>
themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script type="application/javascript">
	function submitPassword()
	{
		UserId = $("#UserId").val();
		password =$("#password").val();
		
		 $.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>admin/submitUserNewPassword',
		  data: 'UserId='+UserId+'&password='+password,
		  cache: false,
		  success: function(data)
		  {
		  	if( data == 0 ) 
			{
				parent.$.fancybox.close();	
			}
			else
			{
				parent.$.fancybox.close();	
			}
		  }
		 });
   }
</script>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Change User Password
        </div>
        <div class="tools">
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>
    <div class="portlet-body">
    <form  action="<?php echo Yii::app()->params->base_path ;?>admin/submitUserNewPassword" method="post">
    <table width="100%">
    	<tr>
            <td><h4>Enter New Password :</h4></td>
            <td><input type="password" name="password" id="password" />
            	<input type="hidden" name="UserId" id="UserId" value="<?php echo $id ; ?>" /> 
            </td>
        </tr>
        <tr>
           <td></br><button type="button" onclick="submitPassword();" id="submitForm" name="submitForm" class="btn green" ><i class="fa fa-check"></i> Submit</button></td> 
            <td>&nbsp;</td>
        </tr>
        
    </table>
    </form>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->