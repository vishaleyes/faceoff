<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/table-advanced.js"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
   TableAdvanced.init();
});
</script>
<div class="page-content-wrapper">
<div class="page-content">
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Log Book
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_3">
        <thead>
        <tr>
            <th>
                 Logbook Name
            </th>
            <th>
                 Log Date
            </th>
            <th>
                 Shop Name
            </th>
            <th>
                 Visibility
            </th>
            <th>
                 Depth
            </th>
            <th>
                 Bottomline
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $row) { ?>
        <tr>
            <td>
                 <?php echo $row['logbook_name'] ;?>
            </td>
            <td>
                 <?php echo $row['log_date'] ;?>
            </td>
            <td>
                 <?php echo $row['shop_name'] ;?>
            </td>
            <td>
                 <?php echo $row['visibility'] ;?>
            </td>
            <td>
                 <?php echo $row['depth'] ;?>
            </td>
            <td>
                 <?php echo $row['bottomline'] ;?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div></div>