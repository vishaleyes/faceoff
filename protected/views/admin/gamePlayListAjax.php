<?php 
foreach($gameData as $games) {
			
?>
<div class="row portfolio-block">
	<div class="col-md-3" align="left">
		<a data-rel="fancybox-button" title="<?php echo $games['Users'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['UserImageName'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['UserImageName'] ; ?>&h=90&q=100&zc=1" ></a>
	
     <br />
               <a href="<?php echo Yii::app()->params->base_path;?>admin/showUserDetail/id/<?php echo $row['UserId'];?>"  class="tip" title="Edit"><?php echo $row['Users'] ;?></a> 	
	</div>
	<div class="col-md-6 portfolio-stat" align="center">
		<div class="portfolio-text">
			<div class="portfolio-text-info">
				</br>
				<h4><?php echo $games['GameName'] ; ?></h4>
			</div>
		</div>
	</div>
	<div class="col-md-3" align="right">
		<a data-rel="fancybox-button" title="<?php echo $games['Opponent'] ;?>" href="<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['OpponentImageName'] ; ?>" class="fancybox-button"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>assets/upload/GamePlay/<?php echo $games['OpponentImageName'] ; ?>&h=90&q=100&zc=1" ></a>
          <br />
                  <a href="<?php echo Yii::app()->params->base_path;?>admin/showUserDetail/id/<?php echo $row['OpponentId'];?>"  class="tip" title="Edit"><?php echo $row['Opponent'] ;?></a> 
	</div>
</div>
<!--end row-->
<?php 
}
?>
