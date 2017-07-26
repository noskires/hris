<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Statistics - President and CEO</title>

  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php 
if(!$this->session->userdata('name'))
{
	//echo "<script>window.location='logout';</script>";
}
?>
<body class="nav-md"> 
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"></i> <span>Personnel Statistics</span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu prile quick info -->
        
          <!-- /menu prile quick info -->

         <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Navigation</h3>
              <ul class="nav side-menu">
                <li><a href="../../../../../../"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i>Data Presentation  <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="../../../../../../distribution_by_group_chart">FTEs Distribution By Group </a> </li>
                    <li><a href="../../../../../../distribution_by_classification_chart">FTEs Distribution By Classification </a> </li>
                    <li><a href="../../../../../../distribution_by_gender_chart">FTEs Distribution By Gender </a> </li>
                    <li><a href="../../../../../../distribution_by_location_chart">FTEs Distribution by Location </a> </li>
                    <!--<li><a href="#">FTEs Distribution By Age </a> </li>
                    <li><a href="#">FTEs Distribution By Tenure </a> </li>-->
                    <li><a href="../../../../../../distribution_by_separation_chart">Distribution By Termination Reason </a> </li> 
                   <!-- <li><a href="#">Hired vs Separated </a> </li>-->
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="../../../../../../distribution_by_group">FTEs Distribution By Group </a> </li>
                    <li><a href="../../../../../../distribution_by_classification">FTEs Distribution By Classification </a> </li>
                    <li><a href="../../../../../../distribution_by_gender">FTEs Distribution By Gender </a> </li>
                    <li><a href="../../../../../../distribution_by_location">FTEs Distribution by Location </a> </li>
                   <!-- <li><a href="#">FTEs Distribution By Age </a> </li>
                    <li><a href="#">FTEs Distribution By Tenure </a> </li> 
                    <li><a href="../../../../../../distribution_by_separation_reason">Distribution by Separation </a> </li>-->
                    <li><a href="../../../../../../distribution_by_separation_reason">Distribution By Termination Reason </a> </li> 
                    <!--<li><a href="#">Hired vs Separated </a> </li>-->
                  </ul>
                </li>
                <!--<li><a href="http://survey.hriswizards.info/index.html"><i class="fa fa-edit"></i>Feedback</a>-->
              </ul>
            </div>
          </div>
		  </div>
		  </div>
		  <!-- sidebar menu -->
      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars" style="width:500%;" > <!--<span style="font-size:20px;">Data as of April 18, 2016 4:03 PM</span> --> </i>  </a> 
            </div> 
            <ul class="nav pull-right" style="padding:10px;">
              <li class="#"  > 
				<div class="user-profile" >
                <a href="#">
                  Hi <?php echo $this->session->userdata('name');?>
                </a> | 
				<a href="../change_password">  Change Password</a> | <a href="../logout"> Log Out</a> 
				</div>
                 
              </li>
            </ul>
          </nav>
        </div>
      </div>			