<?php

// ********************************************************************************
// List All Available Users
// ********************************************************************************
if($action == "view_leader")
{
// ------------------------ Start List Users
  echo '
    <div class="row">
	<div class="col-lg-12 col-md-12">
	<h4>Click on a column to get it sorted.</h4>
        <table class="table table-bordered table-striped sortable">
            <thead>
                <tr>
                    <th class="col-lg-3 col-md-3">Username</th>
                    <th class="col-lg-4 col-md-4">College/School</th>
                    <th class="col-lg-3 col-md-3">Score</th>
                    <th class="col-lg-2 col-md-2 data-defaultsort="asc"">Level</th>
                </tr>
            </thead>
            <tbody>';

  if($users_per_page == ""){ $users_per_page = 250; }
  if($start_from == "0"){ $start_from = ""; }

  $all_userss = file("data/users.php");
  $all_count_users = count($all_userss);
  $flag = 1;
  $i = $start_from;
  $entries_showed = 0;

  if(!empty($all_userss))
    {
      foreach ($all_userss as $users_line)
        {
          if($j < $start_from){ $j++; continue; }
          $i++;
          $users_arr = explode("|",$users_line);
          $here = 0 + $start_from;
        
          switch($users_arr[1])
            {
              case 1: $users_level = "User"; break;
              case 2: $users_level = "Moderator"; break;
              case 3: $users_level = "Administrator"; break;
            }
	  if($users_level == "Moderator" || $users_level == "Administrator") {
		$all_count_users--;
		continue;
	  }
          if ($i/2 == round($i/2)) { echo '<tr class="con1">'; } 
          else { echo '<tr class="con2">'; }

          echo '

              <td>'. $users_arr[2]. '</td>
              <td>'. $users_arr[7]. '</td>
              <td>'. $users_arr[9]. '</td>
              <td>'. $users_arr[6]. '</td>
          </tr>';

          $entries_showed ++;

          if($i >= $users_per_page + $start_from){ break; }
        }
    }

if($entries_showed == 0) echo '<tr><td class="con1" colspan="4">No users registered yet</td></tr>';

  echo '</tbody></table></div></div>';
//////////////////////////////////////////////////////////////

  if($start_from > 0)
    {
      $previous = $start_from - $users_per_page;
      $npp_nav .= '<td class="col-lg-6 col-md-6" class="con1" align="left"><a href="'.$PHP_SELF.'?id=modules/users&leader=view_leader&start_from='.$previous.'&users_per_page='.$users_per_page.'"><< Previous</a></td>';
      $tmp = 1;
    }

  if(count($all_userss) > $users_per_page)
    {
      $nr_nav .= " [ ";
      $enpages_count = @ceil($all_count_users/$users_per_page);
      $enpages_start_from = 0;
      $enpages = "";
      for($j=1;$j<=$enpages_count;$j++)
        {
          if($enpages_start_from != $start_from) { $enpages .= '<a href="'.$PHP_SELF.'?id=modules/leader&action=view_leader&start_from='.$enpages_start_from.'&users_per_page='.$users_per_page.'"> '.$j.' </a>'; }
          else { $enpages .= " <strong><u>$j</u></strong> "; }
          $enpages_start_from += $users_per_page;
        }
      $nr_nav .= $enpages;
      $nr_nav .= " ] ";
    }

  if(count($all_userss) > $i)
    {
      $how_next = count($all_userss) - $i;
      if($how_next > $users_per_page){ $how_next = $users_per_page; }
      $npp_nav .= '<td class="col-lg-6 col-md-6" class="con1" align="right"><a href="'.$PHP_SELF.'?id=modules/leader&action=view_leader&start_from='.$i.'&users_per_page='.$users_per_page.'">Next '.$how_next.' >></a></td>';
    }

  if($entries_showed != 0)
    {
      echo '<table class="main" cellspacing="1" cellpadding="4" class="col-lg-12 col-md-12">';

      if($npp_nav == "") { echo''; } 
      else
        { 
          echo'
          <tr>
            <td colspan="2" class="head">
              <table cellspacing="-1" cellpadding="-2" class="col-lg-12 col-md-12">
                <tr>
                  <td class="col-lg-6 col-md-6" align="left">Showing <b>'.$entries_showed.'</b> users from a total of <b>'.$all_count_users.'</b></td>
                  <td class="col-lg-6 col-md-6" align="right">'.$nr_nav.'</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>';
        }

      if($npp_nav == "") { echo'<td class="con3">Showing <b>'.$entries_showed.'</b> users from a total of <b>'.$all_count_users.'</b></td>'; }
      else { echo $npp_nav; }

      echo '</tr></table>';
    }
  else
    {
      echo '<table class="main" cellspacing="1" cellpadding="4" class="col-lg-12 col-md-12">';

      if($npp_nav == "") { echo''; } 
      else
        { 
          echo'
            <tr>
            <td colspan="2" class="head">
                <table cellspacing="-1" cellpadding="-2" class="col-lg-12 col-md-12">
                  <tr>
                    <td class="col-lg-6 col-md-6" align="left">Showing <b>'.$entries_showed.'</b> users from a total of <b>'.$all_count_users.'</b></td>
                    <td class="col-lg-6 col-md-6" align="right">'.$nr_nav.'</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>';
        }

      if($npp_nav == "")
        { echo'<td class="con3">Showing <b>'.$entries_showed.'</b> users from a total of <b>'.$all_count_users.'</b></td>'; }
      else { echo $npp_nav; }

      echo '</tr></table>';
    }

// ------------------------ End List Users
}
else { header("location: $PHP_SELF?id=modules/users&action=view_users"); }
?>
