<!-- BEGIN PAGE LEVEL STYLES -->
<div id="imageReportListDiv">
<?php
$extraPaginationPara='/keyword/'.$ext['keyword']."/ImageOwnerId/".$ext['ImageOwnerId']."/ImageOwnerName/".$ext['ImageOwnerName'] ;
?>

<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script>

function loadBoxContent(urlData,boxid)
{
		$.ajax({			
		type: 'POST',
		url: urlData,
		data: '',
		cache: true,
		success: function(data)
		{
			if(data=="logout")
			{
				window.location.href = '<?php echo Yii::app()->params->base_path;?>admin';
				return false;	
			}
			$("#"+boxid).html(data);
		}
		});	
}
	
function getSearch()
{
	var keyword = $("#keyword").val();
	
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/viewAllImageWarningsOfUser',
		data: 'keyword='+keyword,
		cache: false,
		success: function(data)
		{
			$("#imageReportListDiv").html(data);
			$("#keyword").val(keyword);
		}
	});
}

function getAllSearch()
{
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>admin/viewAllImageWarningsOfUser',
		data: '',
		cache: false,
		success: function(data)
		{
			$("#imageReportListDiv").html(data);
			$("#keyword").val("");
		}
	});
}


</script>

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-globe"></i>Reported Image List Of <strong style="color:Yellow"><?php echo $ext['ImageOwnerName'] ; ?></strong> </div>
    <div class="tools"> <a href="javascript:;" class="collapse"> </a> </div>
  </div>
  <div class="portlet-body">
    <div class="tabbable-custom nav-justified">
     
        <div class="tab-pane active" id="tab_1_1_1">
          <table class="table table-striped table-bordered table-hover" id="">
            <thead>
              <tr>
              	<th style="text-align:center !important">No.</th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllImageWarningsOfUser/sortType/<?php echo $ext['sortType'];?>/sortBy/GameName' >
                    GameName 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'GameName'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'GameName'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	Reported Image 
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllImageWarningsOfUser/sortType/<?php echo $ext['sortType'];?>/sortBy/VoteCount' >
                    No Of Reports 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'VoteCount'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'VoteCount'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllImageWarningsOfUser/sortType/<?php echo $ext['sortType'];?>/sortBy/reportcount' >
                    Vote Count 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'reportcount'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'reportcount'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th  width="11%" style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllImageWarningsOfUser/sortType/<?php echo $ext['sortType'];?>/sortBy/play.CreationDate' >
                    Created On
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'play.CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'play.CreationDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;
			  	 //echo "<pre>";			  print_r($data['reportedImage']);		  die;
				 $cnt = $data['pagination']->itemCount;
				 
				 if($cnt > 0){
					 
			     foreach( $data['reportedImage'] as $row) {
			  ?>
              <tr>
                <td align="center"> 
				<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
                </td>
                <td>
					 	<?php echo $row['GameName'] ;?>
                </td>
                <?php 
			
					if(isset($row['ImageName']) && $row['ImageName'] != '')
					{
						$path = "assets/upload/GamePlay/".$row['ImageName']; 
						if (file_exists ($path))
						{
							//echo "get image";
							$url =  Yii::app()->params->base_url ."assets/upload/GamePlay/".$row['ImageName']; 
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
					
                <td align="center">
                	<img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $url ; ?>&h=40&w=50&q=100&zc=1" >              </td>
                <td style="text-align:center !important"><?php echo $row['reportcount'] ;?></td>
                <td style="text-align:center !important"><?php echo $row['VoteCount'] ;?></td>
                <td style="text-align:center !important"><?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?></td>
               
              </tr>
              <?php $i++; } 
			    
				} else {
			?>
              	 
                 <tr>
                 	<td colspan="9" align="center"> No Data Found.</td>
                 </tr>
            <?php } ?>
            </tbody>
          </table>

          <!-- END EXAMPLE TABLE PORTLET--> 
          <br/>
          <?php
		 if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
			  <div class="" style="float:right;">
			 <?php 
			 //$extraPaginationPara='&keyword='.$ext['keyword'];
			 $this->widget('application.extensions.WebPager',
							 array( 'cssFile'=>Yii::app()->params->base_url."css/pagination.css",
							 		'extraPara'=>$extraPaginationPara,
									'pages' => $data['pagination'],
									'id'=>'link_pager',
			));
		 ?>	
		 <?php  
		 }?>
          <div id="detailDiv1"></div>
        </div>
        <script type="text/javascript">
	$(document).ready(function(){
		$('#link_pager a').each(function(){
			$(this).click(function(ev){
				
				$("#paginationLoader").css('display','inline-block');
				
				ev.preventDefault();
				$.get(this.href,{ajax:true},function(html){
					$('#imageReportListDiv').html(html);
					$("#paginationLoader").css('display','none');
				});
			});
		});
		
		$('.sort').click(function() {
				var url	=	$(this).attr('lang');
				loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','imageReportListDiv');
	   });
	});
</script>
       </div> 
      </div>
    </div>
  </div>
</div>
</div>
