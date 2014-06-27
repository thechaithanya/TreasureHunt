<?php

// If User is Not Logged In, Display The Login Page
if($is_loged_in == TRUE)
{
  // Check the user out
  $result = FALSE;
  $full_member_db = file("data/users.php");
  foreach($full_member_db as $member_db_line)
    {
      if(!eregi("<\?",$member_db_line))
        {
          $member_db = explode("|",$member_db_line);
          if(strtolower($member_db[0]) == $_SESSION['joined'] && $member_db[2] == $_SESSION['user']) { $result = TRUE; break; }
        }
    }

  if($result == TRUE)
    {
      echo '
	<h2>User Information</h2>
	<div class="col-lg-3 col-md-3">
		<h3>Username:</h3>
	</div>
	<div class="col-lg-9 col-md-9">
		<h3>'.$member_db[2].'</h3>
	</div>
	<div class="col-lg-3 col-md-3">
		<h4>Access:</h4>
	</div>
	<div class="col-lg-9 col-md-9">
		<h4 class =" hilight">';

		  if($is_user == TRUE) echo "Common User";
		  if($is_moderator == TRUE) echo "Moderator";
		  if($is_administrator == TRUE) echo "Administrator";

	      echo'</h4>
	</div>
	<div class="col-lg-3 col-md-3">
		<h4>Last Visit: </h4>
	</div>
	<div class="col-lg-9 col-md-9">
		<h4>'.date("l, d F Y - h:i:s A", $member_db[8]).'</h4>
	</div>';
	
  
    }
}
else { header("location: $PHP_SELF?no_acces=1"); }
?>
