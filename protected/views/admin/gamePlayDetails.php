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
            <i class="fa fa-globe"></i>GamePlay Details
        </div>
        <div class="tools">
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>
    <div class="portlet-body">
    
    
    <?php 
	// echo "<pre>"; print_r($gamePlay); die;
	if(!empty($gamePlay)) { ?>
    <input type="hidden" id="GameTypeUniqueId" value=" <?php if(isset($gamePlay['GamePlayUniqueId'])) { echo $gamePlay['GamePlayUniqueId'] ;} ?>"  />
    <table width="100%">
    	<tr>
             <td width="50%"><b>Game :</b> &nbsp;&nbsp;<?php echo $gamePlay['GameName'] ; ?> </td>
             <td width="50%"><b>Opponent :</b> &nbsp;&nbsp;<?php echo $gamePlay['Opponent']  ; ?></td>
            
            
        </tr>
        <tr> <td colspan="2"> <br /> </td></tr>
      <tr>
          <td width="50%"> <b>User :</b>&nbsp;&nbsp; <?php echo $gamePlay['Users']  ; ?> </td>
            <td width="50%"><b>Opponent Type :</b>&nbsp;&nbsp; <?php  echo $gamePlay['OpponentType']; ?>  </td>
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
			
			 if(isset($gamePlay['UserImageName']) && $gamePlay['UserImageName'] != '')
			 {
				
				$path = "assets/upload/GamePlay/".$gamePlay['UserImageName']; 
				
				
				if (file_exists ($path))
				{
					//echo "get image";
					echo Yii::app()->params->base_url;?>assets/upload/GamePlay/<?php echo $gamePlay['UserImageName']; 
				}
				else
				{
					echo  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				}
			 }
			 else
				  {
					  echo  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				  }
			 
			 ?>" alt=""/></td>
            <td> <img class="img-responsive" style="width:200px;height:150px;" src="
			<?php  if(isset($gamePlay['OpponentImageName']) && $gamePlay['OpponentImageName'] != '')
			       {
						$path1 = "assets/upload/GamePlay/".$gamePlay['OpponentImageName']; 
						$exist1 =  file_exists ($path1);
						if (file_exists ($path1))
						{
							echo Yii::app()->params->base_url;?>assets/upload/GamePlay/<?php echo $gamePlay['OpponentImageName']; 
						}
						else
						{
							 echo  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
						}
				  }
				  else
				  {
					  echo  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				  }
			?>" alt=""/></td>
        </tr>
        
         <tr> <td colspan="2"> <br /> </td></tr>
       
          <tr>
            <td width="50%"><b>IsRandomlySelected :</b>&nbsp;&nbsp;
            <?php if($gamePlay['IsRandomlySelected'] == 1) { echo "Yes" ;} else { echo "No";}?>
            </td>
            <td width="50%"><b>IsRandomlyOpponent :</b>&nbsp;&nbsp;
              <?php if($gamePlay['IsRandomlyOpponent'] == 1) { echo "Yes" ;} else { echo "No";}?>
            </td>
        </tr>
          <tr> <td colspan="2"> <br /> </td></tr>
       
          <tr>
            <td width="50%"><b>UserVote Count :</b>&nbsp;&nbsp;
            <?php if($gamePlay['UserVoteCount'] != '') { echo $gamePlay['UserVoteCount'] ;} else { echo "0";}?>
            </td>
            <td width="50%"><b>OpponentVote Count :</b>&nbsp;&nbsp;
            <?php if($gamePlay['OpponentVoteCount'] != '') { echo $gamePlay['OpponentVoteCount'] ;} else { echo "0";}?>
            </td>
        </tr>
        <tr> <td colspan="2"> <br /> </td></tr>
       
        <tr>
            <td width="50%"><b>StartTime :</b>&nbsp;&nbsp;
            <?php if($gamePlay['StartTime'] != '') { echo $gamePlay['StartTime'] ;} else { echo "0";}?>
            </td>
            <td width="50%"><b>EndTime :</b>&nbsp;&nbsp;
            <?php if($gamePlay['EndTime'] != '') { echo $gamePlay['EndTime'] ;} else { echo "0";}?>
            </td>
            
        </tr>
         <tr> <td colspan="2"> <br /> </td></tr>
       
        <tr>
            <td width="50%"><b>GamePlay Status :</b>&nbsp;&nbsp;
            <?php if($gamePlay['GamePlayStatus'] != '') { echo $gamePlay['GamePlayStatus'] ;} else { echo "0";}?>
            </td>
            <td width="50%"><b>OpponentVote Count :</b>&nbsp;&nbsp;
            <?php if($gamePlay['Winner'] != '') { echo $gamePlay['Winner'] ;} else { echo "0";}?>
            </td>
            
        </tr>
        <tr> <td colspan="2"> <br /> </td></tr>        
        <tr>
            <td width="50%" ><b>Active :</b> &nbsp;
            <?php if($gamePlay['Active'] == 1){ echo "Yes"; } else { echo "No"; }  ?></td>
           
            <td width="50%" ><b>CreationDate :</b>&nbsp;
            <?php echo date("Y-m-d",strtotime($gamePlay['CreationDate'])) ; ?></td>
            
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