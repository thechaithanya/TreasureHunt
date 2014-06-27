<?php

// ********************************************************************************
// Add Guest/Member
// ********************************************************************************
if($action == "add")
{
  $all_ip = file("data/online.php");
  $exist = FALSE;
  foreach($all_ip as $ip_line)
    {
      $ip_arr = explode("|", $ip_line);
      if($ip_arr[0] == $add_ip){ $exist = TRUE; }
    }
  if(!$exist)
    {
      $new_ips = fopen("data/online.php", "a");
      $add_ip = stripslashes( preg_replace(array("'\|'",), array("I",), $add_ip) );
        fwrite($new_ips, "$add_ip|0||\n");
        fclose($new_ips);
    }

  header("location: $PHP_SELF?id=modules/main&login_succes=1");
}
// ********************************************************************************
// Remove Guest/Member
// ********************************************************************************
elseif($action == "remove")
{
  $old_ips = file("data/online.php");
  $new_ips = fopen("data/online.php", "w");
  foreach($old_ips as $old_ip_line)
    {
      $ip_arr = explode("|", $old_ip_line);
      if($ip_arr[0] != stripslashes($remove_ip)) { fwrite($new_ips, $old_ip_line); }
    }
  fclose($new_ips);

  header("location: $PHP_SELF?loged_out=1");
}
// ********************************************************************************
// Show Guests
// ********************************************************************************
elseif($action == "guests")
{
echo'
  <table class="main table-bordered table-striped" cellspacing="1" cellpadding="4" width="100%">
    <tr>
      <td class="head" width="25%">Ips Online</td>
      <td class="head" width="70%">Http Referer</td>
      <td class="head" width="5%">Lang</td>
    </tr>';

    // Show number of guests/members online
    $file = file("data/online.php"); 
    $OnlineGuestsCount = "0";
    $OnlineMembersCount = "0";
    for($line = 0; $line < sizeof($file); $line++) { if(@"guest" == substr($file[$line], 0, 5)) $OnlineGuestsCount++; else $OnlineMembersCount++; }

    // Get users online
    $file = file("data/online.php");
    $totalLines = sizeof($file);
    for($line = 0; $line < $totalLines; $line++)
      {
        if("guest" == substr($file[$line], 0, 5))
          {
            $ip_arr = explode("|", $file[$line]);

            if ($line/2 == round($line/2)) { echo '<tr class="con1">'; } 
            else { echo '<tr class="con2">'; }

            echo '
                <td><a href="http://www.ripe.net/perl/whois?searchtext='.$ip_arr[1].'" target="_blank" title="Get more information about this ip">'.$ip_arr[1].'</a></td>
                <td><a href="'.$ip_arr[3].'">';cuttext("$ip_arr[3]",65);echo'</a></td>
                <td>'.$ip_arr[4].'</td>
              </tr>';
          }
      }

    if($OnlineGuestsCount == "0") { echo '<tr><td class="con1" colspan="3">No Guests Online</td></tr>'; }

echo'</table>';
}
// ********************************************************************************
// Show Members
// ********************************************************************************
elseif($action == "members")
{
echo'
  <table class="main table-bordered table-striped" cellspacing="1" cellpadding="4" width="100%">
    <tr class="head">
      <td class="head" width="40%">Members Online</td>
      <td class="head" width="45%">Email</td>
      <td class="head" width="15%">Acces</td>
    </tr>';

    // Show number of guests/members online
    $file = file("data/online.php"); 
    $OnlineGuestsCount = "0";
    $OnlineMembersCount = "0";
    for($line = 0; $line < sizeof($file); $line++) { if(@"guest" == substr($file[$line], 0, 5)) $OnlineGuestsCount++; else $OnlineMembersCount++; }

    // Get users online
    $file = file("data/online.php");
    $totalLines = sizeof($file);
    for($line = 0; $line < $totalLines; $line++)
      {
        if("guest" == substr($file[$line], 0, 5)) {}
        else
          {
            $ip_arr = explode("|", $file[$line]);

            switch($ip_arr[2])
              {
                case 1: $user_level = "User"; break;
                case 2: $user_level = "Moderator"; break;
                case 3: $user_level = "Administrator"; break;
              }

            if ($line/2 == round($line/2)) { echo '<tr class="con1">'; } 
            else { echo '<tr class="con2">'; }

            echo '
                <td><a href="'.$PHP_SELF.'?id=modules/users&action=stand_alone&userid='.$ip_arr[3].'">'.$ip_arr[0].'</a></td>
                <td><a href="mailto:'. $ip_arr[1].'">'.$ip_arr[1].'</a></td>
                <td>'.$user_level.'</td>
              </tr>';
          }
      }

  if($OnlineMembersCount == "0") { echo "<tr><td class='con1' colspan='3'>No Members Online</td></tr>"; }

  echo'</table>';
}
else { header("location: $PHP_SELF?id=modules/online&action=guests"); }
?>
