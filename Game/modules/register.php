<?php


if($is_loged_in == FALSE)
{
// ********************************************************************************
// Add the User
// ********************************************************************************

if($action == "register")
{
  if(!$regusername){ header("location: $PHP_SELF?id=modules/register&no_user=1"); exit; }
  if(!$regpassword){ header("location: $PHP_SELF?id=modules/register&no_pass=1"); exit; }
  if($regpassword != $regpassword2){ header("location: $PHP_SELF?id=modules/register&no_mach_pass=1"); exit; }
  if(!$regemail){ header("location: $PHP_SELF?id=modules/register&no_email=1"); exit; }
  if(!$reglocation){ header("location: $PHP_SELF?id=modules/register&no_location=1"); exit; }
  if(!eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$', $regemail)) { header("location: $PHP_SELF?id=modules/register&email_invalid=1"); exit; }

  $all_users = file("data/users.php");
  foreach($all_users as $user_line)
    {
      $user_arr = explode("|", $user_line);
      if($user_arr[2] == $regusername){ header("location: $PHP_SELF?id=modules/register&mach_user=1"); exit; }
    }

  $add_time = time()+($config_date_adjust*60);
  $regpassword = md5($regpassword);

  // Check if there are no users <first gets admin status>
  $all_users_db = file("data/users.php");
  $check_users = $all_users_db;
  $check_users[0] = trim($check_users[0]);
  if(!$check_users[0]) { $reglevel = 3; }
  else { $reglevel = 1; }

  $lastvisit = $add_time;

  $old_users_file = file("data/users.php");
  $new_users_file = fopen("data/users.php", "a");

  //set the level of game to 1. Age corresponds to level of game
  $regage = 1;
  $score = 0;
  $dummy = '0';

  fwrite($new_users_file, "$add_time|$reglevel|$regusername|$regpassword|$regemail|$regurl|$regage|$reglocation|$lastvisit|$score|$dummy|\n");

  fclose($new_users_file);

  $_SESSION['joined']       = "$add_time";
  $_SESSION['permission']   = "$reglevel";
  $_SESSION['user']         = "$regusername";
  $_SESSION['md5_password'] = "$regpassword";
  $_SESSION['email']        = "$regemail";
  $_SESSION['url']          = "$regurl";
  $_SESSION['age']          = "$regage";
  $_SESSION['location']     = "$reglocation";
  $_SESSION['lastvisit']    = "$lastvisit";
  $_SESSION['score']        = "$score";

  $is_loged_in = TRUE;
  header("location: $PHP_SELF?id=modules/online&action=add&add_ip=$_SESSION[user]");
}
// ********************************************************************************
// Show Add User Form
// ********************************************************************************
echo'

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-center">Register</h3>
		</div>
		<div class="panel-body">
			<form method="post" action="'.$PHP_SELF.'?id=modules/register">
				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Username*</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" id="username" name="regusername" tabindex="6">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Password*</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="password" class="form-control" id="password" name="regpassword">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Confirm Password*</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="password" class="form-control" id="password2" name="regpassword2">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Email*</h4>
					</div>
					<div class="col-lg-7 col-md-7">						
						<input type="text" class="form-control" id="email" name="regemail">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Http</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" id="url" name="regurl">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>College/School*</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" id="location" name="reglocation">
					</div>
				</div>

				<input class="btn btn-primary pull-right" type="submit" name="Save" value="Register">
				<input type="hidden" name="action" value="register">
			</form>
		</div>
	</div>'; 
}
else { header("location: $PHP_SELF?allready_reg=1"); }
?>
