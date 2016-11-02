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
	var gametype = $('#GameTypeUniqueId').val();
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
	}
	
});


</script>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Polls Details
        </div>
        <div class="tools">
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>
    <div class="portlet-body">
    <?php if(!empty($polls)) { ?>
    <input type="hidden" id="GameTypeUniqueId" value=" <?php if(isset($polls['GameTypeUniqueId'])) { echo $polls['GameTypeUniqueId'] ;} ?>"  />
    <table width="100%">
    	<tr>
            <td><b>Type :</b>&nbsp;&nbsp; <?php if($polls['GameTypeUniqueId'] == 4) { echo "Text";} else if(
			   $polls['GameTypeUniqueId'] == 5){ echo "Image"; }  ; ?> </td>
           
             <td><b>GameText :</b> &nbsp;&nbsp;<?php echo $polls['GameText']  ; ?></td>
            
            
        </tr>
        <tr> <td colspan="2"> <br /> </td></tr>
      <tr>
            <td width="50%"><b>Choice1 :</b> &nbsp;&nbsp;<?php echo $polls['Choice1'] ; ?> </td>
            <td width="50%"><b>Choice2 :</b>&nbsp;&nbsp; <?php echo $polls['Choice2'] ; ?>  </td>
        </tr>
        
        <tr id="tr2"> <td colspan="2"> <br /> </td></tr>
         <tr id="imgtitle" >
            <td width="50%"><b>ChoiceImage1 :</b></td>
            <td width="50%"><b>ChoiceImage2 :</b></td>
        </tr>
          <tr id="tr1"> <td colspan="2"> <br /> </td></tr>
       
        <tr id="img" >
            <td> 
            <img class="img-responsive" style="width:200px;height:150px;" src="<?php 
			
			 if(isset($polls['ChoiceImage1']) && $polls['ChoiceImage1'] != '')
			 {
				
				$path = "assets/upload/polls/".$polls['ChoiceImage1']; 
				
				if (file_exists ($path))
				{
					//echo "get image";
					echo Yii::app()->params->base_url;?>assets/upload/polls/<?php echo $polls['ChoiceImage1']; 
				}
				else
				{
					echo Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				}
			 }
			 else
				  {
					  echo Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				  }
			 
			 ?>" alt=""/></td>
            <td> <img class="img-responsive" style="width:200px;height:150px;" src="
			<?php  if(isset($polls['ChoiceImage2']) && $polls['ChoiceImage2'] != '')
			       {
						$path1 = "assets/upload/polls/".$polls['ChoiceImage2']; 
						$exist1 =  file_exists ($path1);
						if (file_exists ($path1))
						{
							echo Yii::app()->params->base_url;?>assets/upload/polls/<?php echo $polls['ChoiceImage2']; 
						}
						else
						{
							echo Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
						}
				  }
				  else
				  {
					  echo Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				  }
			?>" alt=""/></td>
        </tr>
          <tr> <td colspan="2"> <br /> </td></tr>
       
          <tr>
            <td width="50%"><b>VoteCountForChoice1 :</b>&nbsp;&nbsp;
            <?php if($polls['Choice1VoteCount'] != '') { echo $polls['Choice1VoteCount'] ;} else { echo "0";}?>
            </td>
            <td width="50%"><b>VoteCountForChoice2 :</b>&nbsp;&nbsp;
            <?php if($polls['Choice2VoteCount'] != '') { echo $polls['Choice2VoteCount'] ;} else { echo "0";}?>
            </td>
        </tr>
         <tr> <td colspan="2"> <br /> </td></tr>
       
        <tr>
            <td width="50%"><b>Fontcolor :</b>&nbsp;&nbsp;
            <span style="background-color:<?php  echo $polls['FontColor']; ?>;width:150px;height:150px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td width="50%"><b>Backgroundcolor :</b>&nbsp;&nbsp;
            <span style="background-color:<?php  echo $polls['BackgroundColor'];?>;width:150px;height:150px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            
        </tr>
        <tr> <td colspan="2"> <br /> </td></tr>        
        <tr>
            <td width="50%" ><b>Active :</b> &nbsp;
            <?php if($polls['Active'] == 1){ echo "Yes"; } else { echo "No"; }  ?></td>
           
            <td width="50%" ><b>EndDate :</b>&nbsp;
            <?php echo date("Y-m-d",strtotime($polls['EndDate'])) ; ?></td>
            
        </tr>
        <tr>
            
        </tr>
    </table>
    <?php }else{ ?>
    	<h2 align="center">No Data Found.</h2>
    <?php } ?>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->