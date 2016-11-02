 <div id="imageReportListDiv">  
<?php 
$extraPaginationPara='/keyword/'.$ext['keyword'].'/ReportedGamePlayId/'.$ext['ReportedGamePlayId'].'/ImageOwnerId/'.$ext['ImageOwnerId'];
?>
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
.img-float
{
 	float:left;	
}
</style>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	
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
</script>

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>All Report List For Image
        </div>
    </div>
    <div class="portlet-body">
          
          <table class="table table-striped table-bordered table-hover" id="">
            <thead>
              <tr>
              	<th style="text-align:center !important">No.</th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllReportListingForImage/sortType/<?php echo $ext['sortType'];?>/sortBy/Username' >
                    User Name 
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Username'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Username'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:center !important">  
                	User Image 
                </th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllReportListingForImage/sortType/<?php echo $ext['sortType'];?>/sortBy/ReportTypeName' >
                    Report Type
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ReportTypeName'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'ReportTypeName'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th style="text-align:left !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllReportListingForImage/sortType/<?php echo $ext['sortType'];?>/sortBy/Reason' >
                    Reason
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'Reason'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'Reason'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
                <th  width="11%" style="text-align:center !important">  
                	<a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/viewAllReportListingForImage/sortType/<?php echo $ext['sortType'];?>/sortBy/tri.CreationDate' >
                    Report Date
                    <?php 
					if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'tri.CreationDate'){ ?>
						<i class="fa fa-chevron-down" style="float:right !important"></i>
					<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'tri.CreationDate'){?>
                    	<i class="fa fa-chevron-up" style="float:right !important"></i>
                    <?php } ?>
                    </a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;

			  	// echo "<pre>";	print_r($data['users']);		  die;
				 $cnt = $data['pagination']->itemCount;
				 
				 if($cnt > 0){
					 
			     foreach( $data['users'] as $row) {
			  ?>
              <tr>
                <td align="center"> 
				<?php 
					echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
				?>
                </td>
                <td>
                	<a href="<?php echo Yii::app()->params->base_path;?>admin/showUserDetail/id/<?php echo $row['UserId'];?>"><?php echo $row['Username'] ;?></a>
					
                </td>
                <?php 
			
					if(isset($row['ProfileImage']) && $row['ProfileImage'] != '')
					{
						$path = "assets/upload/avatar/".$row['ProfileImage']; 
						if (file_exists ($path))
						{
							//echo "get image";
							$url =  Yii::app()->params->base_url ."assets/upload/avatar/".$row['ProfileImage']; 
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
                <td align="center"><img alt="" src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo $url ; ?>&h=40&w=50&q=100&zc=1" ></td>
                <td>
						<?php echo $row['ReportTypeName'] ;?>
                </td>
                <td>
						<?php echo $row['Reason'] ;?>
                </td>
                <td style="text-align:center !important">
					<?php echo date("Y-m-d",strtotime($row['CreationDate'])) ;?>
                </td>
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
          <input type="hidden" id="activeId" value="" />
          <!-- END EXAMPLE TABLE PORTLET--> 
          <br/>
          <?php
		 if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
			  <div class="" style="float:right;">
			 <?php 
			 $extraPaginationPara='&keyword='.$ext['keyword'].'&ReportedGamePlayId='.$ext['ReportedGamePlayId'].'&ImageOwnerId='.$ext['ImageOwnerId'];
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
<!-- END EXAMPLE TABLE PORTLET-->

