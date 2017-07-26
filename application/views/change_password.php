<?php 
if(!$this->session->userdata('user_account'))
{
	echo "<script>window.location='logout';</script>"; 
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="angular-validator-demo">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change Password</title>

	<link href="assets/css/bootstrap.min.css" 	rel="stylesheet">  
	<link href="assets/build/css/custom.css" 	rel="stylesheet">  
	<style type="text/css">
		label.control-label.has-error.validationMessage
		{
			color:green;
			margin-top:-100px;
			margin-bottom:10px;
		}
	</style>

  </head>

  <body class="login" ng-controller="DemoCtrl">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <!--<form method="post" action="authenticate">-->
			<form angular-validator-submit="submitMyForm(form)" name="myForm" class="form-horizontal" novalidate angular-validator method="post" action="change_the_password">
              <h1>Change Password </h1>
              <div>
               <div class="col-sm-12">
				<label class="pull-left"> Current Password: </label> 
				<input  type = "password"
                            name = "currentpassword"
                            class = "form-control" 
							ng-model = "form.currentPassAccnt"
							placeholder="Current Password"
                            required>
							</div> 
				<label class="control-label has-error validationMessage">{{invalid_pass_error_msg}} </label>
				<div class="col-sm-12">
				<label class="pull-left">New Password: </label>
				<input  type = "password"
                            name = "newPassAccnt"
                            class = "form-control"
                            ng-model = "form.newPassAccnt"
                            validator = "passwordValidator(form.newPassAccnt) === true"
                            invalid-message = "passwordValidator(form.newPassAccnt)"
                            validate-on="dirty"
							placeholder="New Password"
                            required>
							</div> 
				
				<div class="col-sm-12">
				<label class="pull-left">Confirm Password: </label>
				<input  type = "password"
                            name = "confirmPasswordAccnt"
                            class = "form-control"
                            ng-model = "form.confirmPasswordAccnt"
                            validator = "form.newPassAccnt === form.confirmPasswordAccnt"
                            validate-on="dirty"
                            invalid-message = "'Passwords do not match!'"
							placeholder="Confirm Password"
                            required>
							</div>
						
				<div class="form-group">
					<div class="col-md-12">
					  <button type="submit" class="btn btn-primary sm">Submit</button>
					  <button type="button" class="btn btn-primary sm" ng-click="cancelChangePass()">Cancel</button>
					</div>
				</div>
              </div>
             
              
			 

              <div class="clearfix"></div>

              <!--<div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>-->
			  <div>
			  <h1><!--<i class="fa fa-paw"></i> Personnel Statistics--></h1> 
			</div>
            </form>
          </section>
        </div>

 
      </div>
    </div>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.21/angular.min.js"></script> 
		<script src="assets/validation/app.js"></script>
		<script src="assets/validation/angular-validator.js"></script>
  </body>
</html>