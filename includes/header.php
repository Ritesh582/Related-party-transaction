<?php ob_start(); ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo DOMAIN; ?></title>

    <link href="<?php echo DOMAIN; ?>/css/bootstrap.min.css" rel="stylesheet">
    
     <!-- Commented on 28-MAY-2017, Pratik. Now Loading from Server-->
     <link href="<?php echo DOMAIN; ?>/css/font-awesome.min.css" rel="stylesheet">
	 
  <!-- <link href="<?php echo DOMAIN; ?>/css/jquery/bootstrapcdn/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">-->
    
    <!--<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
    <!-- Morris -->
    <link href="<?php echo DOMAIN; ?>/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo DOMAIN; ?>/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    
    <!-- Commented on 28-MAY-2017, Pratik. Now Loading from Server-->
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>/css/jquery-ui_1.css" />
    <!--<link rel="stylesheet" href="<?php echo DOMAIN; ?>/css/jquery/ui/1.11.4/themes/smoothness/jquery-ui.css" />-->
    <!-- <link rel="stylesheet" href="css/jquery-ui.css" /> -->


     <!-- Data Tables -->
	 <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN; ?>/css/jquery.dataTables.css">
    <link href="<?php echo DOMAIN; ?>/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/css/plugins/dataTables/dataTables.bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN; ?>/css/bootstrap-clockpicker.min.css">
    <link href="<?php echo DOMAIN; ?>/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/css/plugins/dataTables/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<link href="<?php echo DOMAIN; ?>/css/plugins/dataTables/buttons.dataTables.min.css" rel="stylesheet">

    <link href="<?php echo DOMAIN; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/css/login.css" rel="stylesheet">
	<link href="<?php echo DOMAIN; ?>/css/app_1.min.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/css/bootstrap-multiselect.css" rel="stylesheet"/>
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
       button.btn.btn-default.btn-sm.edit {
        /* border: 1px solid red; */
        position: relative;
        left: 100px;
    }
</style>
<script>
function onClickNext_reg_user(page){x = document.members;x.pageno.value = page;x.submit();}
function back_fn(filename){window.location = filename;}
function deleterecord(id,file){var url = file+".php?mode=delete&id="+id;if(confirm("Are you sure you want to Delete ?")) {window.location= url;}}
function closeAccount(status,file){var url = file+".php?mode=close&status="+status;if(confirm("Are you sure you want to Close the Day?")) {window.location= url;}}
</script>

 <!-- Mainly scripts -->
    <script src="<?php echo DOMAIN; ?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/js/bootstrap-clockpicker.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo DOMAIN; ?>/js/inspinia.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/pace/pace.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/bootstrap-multiselect.js"></script>
	
    <!-- Data Tables -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/dataTables.responsive.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
	<script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/dataTables.buttons.min.js"></script>
	 <!--<script src="<?php echo DOMAIN; ?>/js/plugins/dataTables/buttons.html5.min.js"></script>-->
    <!-- iCheck -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/jquery.validate.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/effects.js" type="text/javascript"></script>

    <!-- Flot -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/demo/peity-demo.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo DOMAIN; ?>/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo DOMAIN; ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo DOMAIN; ?>/js/demo/sparkline-demo.js"></script>
	
	
	
</head>
<body>
    <div id="wrapper">