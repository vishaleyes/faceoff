<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<style>
body
{
	font-family:Open Sans,Verdana,Sans-serif;
		
}
</style>
<script type="text/javascript">
    var $ = jQuery.noConflict();
</script>
<script>

$(document).ready(function()
{
	/*var gametype = $('#GameTypeUniqueId').val();
	//alert(gametype);
	if(gametype == 4)
	{
		$('#tr1').hide();
		$('#tr2').hide();
		$('#img').hide();
		$('#imgtitle').hide();
	}
	if(gametype == 5)
	{
		$('#tr1').show();
		$('#tr2').show();
		$('#img').show();
		$('#imgtitle').show();
	}*/
	
});

</script>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>User Details
        </div>
        <div class="caption" style="float:right;">
        	<a style="color:white !important;" href="<?php echo Yii::app()->params->base_path ; ?>admin/showUserProfile/id/<?php echo $userData['UserId'] ; ?>" target="_parent" />See Faceoff Profile</a>
        </div>
    </div>
    <div class="portlet-body">
    
    
    <?php 
	// echo "<pre>"; print_r($gamePlay); die;
	if(!empty($userData)) {  ?>
    <table border="0" width="100%">
    <tr>
   		 <td>
       <table border="0" width="100%" cellspacing="1" cellpadding="1">
          <tr>
              <td width="40%">
                <b>First Name :</b> 
              </td>
              <td>
                <?php echo $userData['FirstName'] ; ?> 
              </td>
         </tr>
         <tr> <td > <br /> </td></tr>
         <tr>
         		<td width="40%">
                <b>Last Name :</b> 
              </td>
              <td>
                <?php echo $userData['LastName'] ; ?> 
              </td>
         </tr>
          <tr> <td> <br /> </td></tr>
          <tr>
         		<td width="40%">
                <b>Gender :</b> 
              </td>
              <td>
                <?php if($userData['Gender'] == 1) { echo "Male"; }else if (					  													 $userData['Gender'] == 2) { echo "Female"; } ?>
              </td>
         </tr>
       	<tr> <td colspan="2"> <br /> </td></tr>
        <tr>
         		<td width="40%">
                <b>Birth Date :</b> 
              </td>
              <td>
                <?php echo date("Y-m-d",strtotime($userData['BirthDate'])) ; ?>
              </td>
         </tr>
         </table>
         
    	</td>
        
        
         <td>
      <!--  Start Table For Image-->
         <table border="0" width="100%">
             <tr align="center">
                  <td > 
                  
                  <?php
						$path = "assets/upload/avatar/".$userData['ProfileImage'] ;
						
						if(isset($userData['ProfileImage']) && $userData['ProfileImage'] != "" && file_exists($path) ) { ?>
						<img src="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo $userData['ProfileImage'] ;?>"  style="width:200px;height:150px;" />
						<?php } else { ?>
						<img src="<?php echo Yii::app()->params->base_url; ?>assets/upload/avatar/<?php echo "noimage.jpg"; ?>" style="width:200px;height:150px;">
						<?php } ?>
                  
            
             
             </td>
             </tr>
         
         </table>
      <!--  End Table For Image-->
        </td>
    </tr>
    <tr> <td colspan="2"> <br /> </td></tr>
    </table>
    
    <table border="0" width="100%">
        <tr>
           <td style="width:22% !important"><b>Email :</b></td>
           <td colspan="3"><?php echo $userData['EmailId'] ; ?></td>
        </tr>
        <tr> <td colspan="4"> <br /> </td></tr>
        <tr>
        	   <td style="width:22% !important"><b>SocialLoginId : </b></td> 
           	   <td style="width:28% !important"><?php echo $userData['SocialLoginId'] ; ?></td>
               <td style="width:20% !important"><b>Login Type :</b></td>
               <td style="width:30% !important"><?php if($userData['LoginType'] == 1) { echo "Email"; } elseif($userData['LoginType'] == 2) { echo "FaceBook";} elseif($userData['LoginType'] == 3) { echo "Twitter";} ?></td>
               
        </tr>
        <tr> <td colspan="4"> <br/> </td></tr>
        <tr>
               <td style="width:22% !important"><b>AppVersion :</b></td>
               <td style="width:28% !important"><?php echo $userData['AppVersion'] ; ?></td>
               <td style="width:20% !important"><b>Device Type : </b></td> 
               <td style="width:30% !important"><?php if($userData['DeviceType'] == 1) { echo "Android"; } elseif($userData['DeviceType'] == 2) { echo "iPhone";} ?></td>
        </tr>
        <tr> <td colspan="4"> <br/> </td></tr>
        <tr>
        	<td style="width:22% !important"><b>CreationDate : </b></td> 
            <td style="width:28% !important"><?php echo $userData['CreationDate'] ; ?></td>
            <td style="width:20% !important"><b>Active :</b></td>
            <td style="width:30% !important"><?php if($userData['Active'] == 1) { echo "Yes"; }else if ($userData['Active'] == 2) { echo "No"; } ?></td>
            
        </tr>
    </table>
    <?php }else{ ?>
    	<h2 align="center">No Data Found.</h2>
    <?php } ?>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->