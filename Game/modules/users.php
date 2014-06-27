<?php

// ********************************************************************************
// List All Available Users
// ********************************************************************************
if($action == "view_users")
{
// ------------------------ Start List Users
  echo '
    <div class="row">
	<div class="col-lg-12 col-md-12">
        <table class="table table-bordered table-striped sortable">
            <thead>
                <tr>
                    <th class="col-lg-3 col-md-3" data-defaultsort="asc">Name</th>
                    <th class="col-lg-4 col-md-4">Email</th>
                    <th class="col-lg-3 col-md-3">Access</th>
                    <th class="col-lg-2 col-md-2">Del</th>
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

          if ($i/2 == round($i/2)) { echo '<tr class="con1">'; } 
          else { echo '<tr class="con2">'; }

          if($_GET['edit'] == TRUE and $_GET['userid'] == $users_arr[0]) echo '<td><a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$here.'&userid='.$users_arr[0].'">';
          else echo '<td><a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$here.'&userid='.$users_arr[0].'&edit=TRUE#edit">';

          echo ''.$users_arr[2].'</a></td>

              <td><a href="mailto:'. $users_arr[4]. '">'. $users_arr[4]. '</a></td>
              <td>'.$users_level.'</td>';

                if($is_administrator == TRUE)
                  {
                    echo'<td align="center">';

                    if($users_arr[1] == 3){ echo'<img src="images/nodelete.gif" border="0" alt="Cannot delete">'; }
                    else
                      {
                        $entries_next = count($all_userss) - $i;

                        if(!$entries_showed == 1)
                          {
                            if($entries_next == 0)
                              {
                                if($here == 0) $here = $users_per_page;
                                else $here = $here;

                                $start_from2 = $here - $users_per_page;
                                echo '<a href="'.$PHP_SELF.'?id=modules/users&action=delete_user&userid='.$users_arr[0].'&start_from='.$start_from2.'">';
                              }
                            if(!$entries_next != 1) { echo '<a href="'.$PHP_SELF.'?id=modules/users&action=delete_user&userid='.$users_arr[0].'&start_from='.$start_from.'">'; }
                          }
                        else { echo '<a href="'.$PHP_SELF.'?id=modules/users&action=delete_user&userid='.$users_arr[0].'&start_from='.$start_from.'">'; }

                        echo '<span class="glyphicon glyphicon-remove"></span></a>';
                      }
                    echo'</td>';
                  }
          echo'</tr>';

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
      $npp_nav .= '<td class="col-lg-6 col-md-6" class="con1" align="left"><a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$previous.'&users_per_page='.$users_per_page.'"><< Previous</a></td>';
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
          if($enpages_start_from != $start_from) { $enpages .= '<a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$enpages_start_from.'&users_per_page='.$users_per_page.'"> '.$j.' </a>'; }
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
      $npp_nav .= '<td class="col-lg-6 col-md-6" class="con1" align="right"><a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$i.'&users_per_page='.$users_per_page.'">Next '.$how_next.' >></a></td>';
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

  $users_file = file("data/users.php");
  foreach($users_file as $user_line)
    {
      $user_arr = explode("|", $user_line);
      if($userid == $user_arr[0]){ break; }
    }

  $user_arr[8] = date($time_display,$user_arr[8]);

  if($entries_showed != 0)
  {
    echo '
    <table><tr><td></td></tr></table>
    <table class="main" cellspacing="1" cellpadding="4" width="100%">
        <tr>
         <td class=head>';

          if($all_count_users == 1) { $here2 = 0; }
          else { $here2 = $here; }

          if($_GET['edit'] == TRUE) echo '<a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$here2.'&userid=0">User info</a>';
          else echo '<a href="'.$PHP_SELF.'?id=modules/users&action=view_users&start_from='.$here2.'&userid=0&edit=TRUE#edit">User info</a>';

         echo '</td>
        </tr>
    </table>';

    if($_GET['edit'] == TRUE) echo '<span id="editusers" style="display:show;">';
    else echo '<span id="editusers" style="display:none;">';

    if($userid == 0)
      {
        echo '
          <table><tr><td></td></tr></table>
          <A NAME="edit">
          <table class="main" cellspacing="1" cellpadding="4">
            <tr><td class="con1">No user was selected<br></td></tr>
          </table>
        </span>';
      }
    else
      {
        switch($user_arr[1])
          {
            case 1: $users_level = "User"; break;
            case 2: $users_level = "Moderator"; break;
            case 3: $users_level = "Administrator"; break;
          }

        echo'
          <table><tr><td></td></tr></table>
          <A NAME="edit">
          <table class="main table-bordered table-striped" cellspacing="1" cellpadding="4" width="100%">
          <tr>
            <td class="con1" class="col-lg-5 col-md-5">Username:</td>
            <td class="con1" class="col-lg-7 col-md-7">'.$user_arr[2].'</td>
          </tr>
          <tr>
            <td class="con1">Email</td>
            <td class="con1"><a href="mailto:'.$user_arr[4].'">'.$user_arr[4].'</a></td>
          </tr>
          <tr>
            <td class="con1">Http://</td>
            <td class="con1"><a href="http://'.$user_arr[5].'">'.$user_arr[5].'</a></td>
          </tr>
          <tr>
            <td class="con1">Level:</td>
            <td class="con1">'.$user_arr[6].'</td>
          </tr>
          <tr>
            <td class="con1">College/School:</td>
            <td class="con1">'.$user_arr[7].'</td>
          </tr>
          <tr>
            <td class="con1" valign="top">Acces:</td>
            <td class="con1">'.$users_level.'</td>
          </tr>
        </table>';

        if($is_administrator == TRUE)
          {
            if($user_arr[1] != 3)
              {
                echo'
                  <br>
		  <h4>Edit User</h4>
                  <table class="main table-bordered table-striped" cellspacing="1" cellpadding="4" width="100%">
                  <form action="'.$PHP_SELF.'?id=modules/users" method="post" name="editusers">
                  <tr>
                    <td class="con1" class="col-lg-5 col-md-5">Acces:</td>
                    <td class="con1" class="col-lg-7 col-md-7"><select class="form-control" name="editlevel">';
    
                  if($user_arr[1] == 1){echo" <option value=1 selected>1 (User)</option>";} else {echo" <option value=1>1 (User)</option>";}
                  if($user_arr[1] == 2){echo" <option value=2 selected>2 (Moderator)</option>";} else {echo" <option value=2>2 (Moderator)</option>";}

                echo'
                    </select></td>
                  </tr>
                  <tr>
                    <td class="con1">New Password</td>
                    <td class="con1"><input class="form-control" name="editpassword"></td>
                  </tr>
                  <tr>
                    <td class="con1">Action</td>
                    <td class="con1">
                      <input class="btn btn-primary" type="submit" style="width:170" class="box" value="Submit">
                      <input type="hidden" name="userid" value="'.$userid.'">
                      <input type="hidden" name="action" value="'.edit_user.'">
                      <input type="hidden" name="start_from" value="'.$start_from.'">
                    </td>
                  </tr>
                  </form>
                  </table>';
              }
          }
        echo'</span>';
      }
  }
}
// ********************************************************************************
// View Stand Alone Information about User
// ********************************************************************************
elseif($action == "stand_alone")
{
  $users_file = file("data/users.php");
  foreach($users_file as $user_line)
    {
      $user_arr = explode("|", $user_line);
      if($userid == $user_arr[0]){ break; }
    }

  $user_arr[8] = date($time_display,$user_arr[8]);

  switch($user_arr[1])
    {
      case 1: $users_level = "User"; break;
      case 2: $users_level = "Moderator"; break;
      case 3: $users_level = "Administrator"; break;
    }

  if(!$userid)
    {
      echo'
        <table class="main table-bordered table-striped" cellspacing="1" cellpadding="4" width="100%">
        <tr class="head">
          <td class="head">User\'s Information:</td>
        </tr>
        <tr>
          <td class="con1" width="30%">No users registered yet</td>
        </tr>
        </table>';
    }
  else
    {
      echo'
        <table class="main table-bordered table-striped" cellspacing="1" cellpadding="4" width="100%">
        <form action="'.$PHP_SELF.'?id=modules/users" method="post" name="editusers">
        <tr class="head">
          <td colspan="2" class="head">User\'s Information:</td>
        </tr>
        <tr>
          <td class="con1" width="30%">Username:</td>
          <td class="con1" width="70%">'.$user_arr[2].'</td>
        </tr>
        <tr>
          <td class="con1">Email:</td>
          <td class="con1"><a href="mailto:'.$user_arr[4].'">'.$user_arr[4].'</a></td>
        </tr>
        <tr>
          <td class="con1">Http://</td>
          <td class="con1"><a href="http://'.$user_arr[5].'">'.$user_arr[5].'</a></td>
        </tr>
        <tr>
          <td class="con1">Level:</td>
          <td class="con1">'.$user_arr[6].'</td>
        </tr>
        <tr>
          <td class="con1">College/School:</td>
      <td class="con1">'.$user_arr[7].'</td>
        </tr>
        <tr>
          <td class="con1">Access:</td>
          <td class="con1">'.$users_level.'</td>
        </tr>
        </form>
        </table>';
    }

}
// ********************************************************************************
// Edit User
// ********************************************************************************
elseif($action == "edit_user")
{
  if(!$userid){ ?> <script> location = "<?php echo $PHP_SELF ?>?val=1"; </script><?php exit; }
  if($users_per_page == ""){ $users_per_page = $users_in_page; }

  $here = 0 + $start_from;
  $old_db = file("data/users.php");
  $new_db = fopen("data/users.php", "w");
  foreach($old_db as $old_db_line)
    {
      $old_db_arr = explode("|", $old_db_line);
      if($userid != $old_db_arr[0]) { fwrite($new_db,"$old_db_line"); }
      else
        {
          if($editpassword != "") { $old_db_arr[3] = md5($editpassword); }
          fwrite($new_db,"$old_db_arr[0]|$editlevel|$old_db_arr[2]|$old_db_arr[3]|$old_db_arr[4]|$old_db_arr[5]|$old_db_arr[6]|$old_db_arr[7]|$old_db_arr[8]|$old_db_arr[9]|$old_db_arr[10]|\n");
        }
    }

  fclose($new_db);

  header("location: $PHP_SELF?id=modules/users&action=view_users&start_from=$here&users_per_page=$users_per_page&user_modified=1");
}
// ********************************************************************************
// Delete User
// ********************************************************************************
elseif($action == "delete_user")
{
  if(!$userid){ header("location: $PHP_SELF?unknown_error=1"); exit; }
  if($users_per_page == ""){ $users_per_page = $users_in_page; }

  $here = 0 + $start_from;
  $old_users_file = file("data/users.php");
  $new_users_file = fopen("data/users.php", "w");
  foreach($old_users_file as $old_user_line)
    {
      $old_user_line_arr = explode("|", $old_user_line);
      if($userid != $old_user_line_arr[0]) { fwrite($new_users_file, $old_user_line); }
    }
  fclose($new_users_file);

  header("location: $PHP_SELF?id=modules/users&action=view_users&start_from=$here&users_per_page=$users_per_page&user_deleted=1");
}

else { header("location: $PHP_SELF?id=modules/users&action=view_users"); }
?>
