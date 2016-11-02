<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Game Details
        </div>
    </div>
    <div class="portlet-body">
    <?php if(!empty($gameData)) { ?>
    <table border="0" width="100%">
    <tr>
   		 <td>
       <table border="0" width="100%" cellspacing="5" cellpadding="5">
          <tr>
              <td width="30%">
                <b>Game Name :</b>
              </td>
              <td>
                <?php echo $gameData['GameText'] ; ?>
              </td>
         </tr>
         <tr> <td colspan="2" > <br /> </td></tr>
         <tr>
         	  <td width="30%">
                <b>Game Type :</b>
              </td>
              <td>
                <?php echo $gameData['GameTypeDescription'] ; ?>
              </td>
         </tr>
         <tr> <td colspan="2"  > <br /> </td></tr>
         <tr>
         	  <td width="30%">
                <b>Active Game :</b>
              </td>
              <td>
                <?php if($gameData['Active'] == 1) { echo "Yes"; }else if ($gameData['Active'] == 2) { echo "No"; } ?>
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
			
			if(isset($gameData['ImageName']) && $gameData['ImageName'] != '')
			{
				$path = "assets/upload/Games/".$gameData['ImageName']; 
				if (file_exists ($path))
				{
					//echo "get image";
					$url =  Yii::app()->params->base_url ."assets/upload/Games/".$gameData['ImageName']; 
				}
				else
				{
					$url =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
				}
			}
			else
			{
				$url =  Yii::app()->params->base_url."assets/upload/avatar/noimage.jpg";
			}
			
			 
		 ?>
            <img class="img-responsive" style="width:200px;height:150px;" src="<?php echo $url ; ?>" alt=""/></td>
             </tr>
         
         </table>
      <!--  End Table For Image-->
        </td>
    </tr>
     
    </table>
    <?php }else{ ?>
    	<h2 align="center">No Data Found.</h2>
    <?php } ?>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->