<?php
// Check that we are logged in
if($is_loged_in == TRUE)
{
// ********************************************************************************
// Edit User
// ********************************************************************************
if($action == "edit")
{
  if($editpassword != $editpassword2){ header("location: $PHP_SELF?id=modules/panel&no_mach_pass=1"); exit; }

  $old_db = file("data/users.php");
  $new_db = fopen("data/users.php", "w");
  foreach($old_db as $old_db_line)
    {
      $old_db_arr = explode("|", $old_db_line);
      if($userid != $old_db_arr[0]) { fwrite($new_db,"$old_db_line"); }
      else
        {
          if($editpassword != ""){ $old_db_arr[3] = md5($editpassword); }
          if($editemail != ""){ $old_db_arr[4] = $editemail; }
          if($edithttp != ""){ $old_db_arr[5] = $edithttp; }
          if($editage != ""){ $old_db_arr[6] = $editage; }
          if($editlocation != ""){ $old_db_arr[7] = $editlocation; }

          fwrite($new_db,"$old_db_arr[0]|$old_db_arr[1]|$old_db_arr[2]|$old_db_arr[3]|$old_db_arr[4]|$old_db_arr[5]|$old_db_arr[6]|$old_db_arr[7]|$old_db_arr[8]|$old_db_arr[9]|$old_db_arr[10]|\n");
        }
    }
  fclose($new_db);

  { ?> <script> location = "<?php echo $PHP_SELF ?>?id=modules/panel&profile_saved=1"; </script> <?php }
}
// ********************************************************************************
// View Profile
// ********************************************************************************

  $userid = $_SESSION['joined'];
  $avatarid = $_SESSION['user'];

  $users_file = file("data/users.php");
  foreach($users_file as $user_line)
    {
      $user_arr = explode("|", $user_line);
      if($userid == $user_arr[0]) { break; }
    }

  $user_arr[8] = date($time_display,$user_arr[8]);

echo'
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-center">Your Profile</h3>
		</div>
		<div class="panel-body">
			<form method="post" action="'.$PHP_SELF.'?id=modules/panel" method="post">
				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Username:</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<h4>'.$user_arr[2].'</h4>
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Level:</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<h4>'.$user_arr[6].'</h4>
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Email:</h4>
					</div>
					<div class="col-lg-7 col-md-7">						
						<input type="text" class="form-control" value="'.$user_arr[4].'" name="editemail">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Http:</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" value="'.$user_arr[5].'" name="edithttp">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>College/School</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" value="'.$user_arr[7].'" name="editlocation">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>New Password</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="password" class="form-control" name="editpassword">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Confirm New Password</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="password" class="form-control" name="editpassword2">
					</div>
				</div>

				<input class="btn btn-primary pull-right" type="submit" name="Save" value="Save">
				<input type="hidden" name="userid" value="'.$userid.'">
				<input type="hidden" name="action" value="edit">
			</form>
		</div>
	</div>';
}
else { header("location: $PHP_SELF?no_acces=1"); }
?>
