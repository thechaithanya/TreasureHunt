<?php


$is_guest = TRUE;
$is_user = FALSE;
$is_moderator = FALSE;
$is_administrator = FALSE;

if($_SESSION['permission'] == 1) { $is_user = TRUE; $is_guest = FALSE; }
if($_SESSION['permission'] == 2) { $is_moderator = TRUE; $is_guest = FALSE; }
if($_SESSION['permission'] == 3) { $is_administrator = TRUE; $is_guest = FALSE; }

if ($HTTP_SESSION_VARS) {extract($HTTP_SESSION_VARS, EXTR_SKIP); }
if ($_SESSION) {extract($_SESSION, EXTR_SKIP); }
if ($HTTP_COOKIE_VARS) {extract($HTTP_COOKIE_VARS, EXTR_SKIP); }
if ($_COOKIE) {extract($_COOKIE, EXTR_SKIP); }
if ($HTTP_POST_VARS) {extract($HTTP_POST_VARS, EXTR_SKIP); }
if ($_POST) {extract($_POST, EXTR_SKIP); }
if ($HTTP_GET_VARS) {extract($HTTP_GET_VARS, EXTR_SKIP); }
if ($_GET) {extract($_GET, EXTR_SKIP); }
if ($HTTP_ENV_VARS) {extract($HTTP_ENV_VARS, EXTR_SKIP); }
if ($_ENV) {extract($_ENV, EXTR_SKIP); }

if($PHP_SELF == ""){ $PHP_SELF = $HTTP_SERVER_VARS["PHP_SELF"]; }

////////////////////////////////////////////////////////
// Function:         message
// Description: Displays the message

function message()
{
if	(@$_GET["login_failed"])	echo "<span class = 'alert'>Wrong Username or Password</span>";
elseif	(@$_GET["no_acces"]) 		echo "<span class = 'alert'>Acces denied</span>";
elseif	(@$_GET["login_succes"]) 	echo "<span class = 'ok'>Welcome ".$_SESSION["user"]."</span>";
elseif	(@$_GET["loged_out"]) 		echo "<span class = 'ok'>You have logged-out successfuly</span>";

elseif	(@$_GET["no_user"]) 		echo "<span class = 'alert'>Username can not be blank</span>";
elseif	(@$_GET["no_pass"]) 		echo "<span class = 'alert'>Password can not be blank</span>";
elseif	(@$_GET["profile_saved"]) 	echo "<span class = 'alert'>Profile changed</span>";
elseif	(@$_GET["no_mach_pass"]) 	echo "<span class = 'alert'>Passwords dosen't match to confirm</span>";
elseif	(@$_GET["no_match_ans"]) 	echo "<span class = 'alert'>It's a wrong answer. Try again.</span>";
elseif	(@$_GET["correct_ans"]) 	echo "<span class = 'alert'>Congratulations!!!</span>";
elseif	(@$_GET["no_email"]) 		echo "<span class = 'alert'>Email can not be blank</span>";
elseif	(@$_GET["no_location"]) 	echo "<span class = 'alert'>School/College can not be blank</span>";
elseif	(@$_GET["email_invalid"]) 	echo "<span class = 'alert'>The Email is invalid</span>";
elseif	(@$_GET["mach_user"]) 		echo "<span class = 'alert'>Sorry that username already exist</span>";
elseif	(@$_GET["allready_reg"]) 	echo "<span class = 'normal'>You are allready registered</span>";

elseif	(@$_GET["user_modified"]) 	echo "<span class = 'ok'>You have modified the user successfuly</span>";
elseif	(@$_GET["user_deleted"]) 	echo "<span class = 'ok'>You have deleted the user successfuly</span>";

elseif	(@$_GET["unknown_error"]) 	echo "<span class = 'alert'>Error Occured</span>";
else 					echo "<span class = 'normal text-center'>Welcome to the game</span>";
}

////////////////////////////////////////////////////////
// Function:         ipCheck 
// Description: Check the ip to the roots

function ipCheck()
{ 
  if (getenv('HTTP_CLIENT_IP')) { $ip = getenv('HTTP_CLIENT_IP'); } 
  elseif (getenv('HTTP_X_FORWARDED_FOR')) { $ip = getenv('HTTP_X_FORWARDED_FOR'); } 
  elseif (getenv('HTTP_X_FORWARDED')) { $ip = getenv('HTTP_X_FORWARDED'); } 
  elseif (getenv('HTTP_FORWARDED_FOR')) { $ip = getenv('HTTP_FORWARDED_FOR'); } 
  elseif (getenv('HTTP_FORWARDED')) { $ip = getenv('HTTP_FORWARDED'); } 
  else { $ip = $_SERVER['REMOTE_ADDR']; } 
  return $ip; 
}

////////////////////////////////////////////////////////
// Function:         cuttext
// Description: Cuts a string and adds ..

function cuttext($tring,$cuton)
{
  $space=" ";
  if (!strstr($tring,$space)) { $tring=substr($tring,0,$cuton); }
  if (substr($tring,$cuton,1)==$space) { $tring=substr($tring,0,$cuton); }
  else
    {
      while ($teller <= $cuton)
        {
          if (substr($tring,$cuton-$teller,1)==$space) { $tring=substr($tring,0,$cuton-$teller); break; }
          $teller++;
        }
    }

  $nr_tring = strlen($tring);
  if($nr_tring >= $cuton) { echo $tring; echo".."; }
  else echo $tring;
}

?>
