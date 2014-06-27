<?php

  $userid = $_SESSION['joined'];
  $avatarid = $_SESSION['user'];


  $users_file = file("data/users.php");
  foreach($users_file as $user_line)
    {
      $user_arr = explode("|", $user_line);
      if($userid == $user_arr[0]) { break; }
    }

  $level = $user_arr[6];

  $ques_file = file("data/questions.php");
  foreach($ques_file as $ques_line)
    {
      $game_arr = explode("|", $ques_line);
      if($game_arr[0] == $level) { 
	$question = $game_arr[1];
	$solution = $game_arr[2];
	break;
     }
    }

  $user_arr[8] = date($time_display,$user_arr[8]);

if($question == '') {
	include("wait.php");
}
else {
if($action == "edit")
{
  if(strtolower($answer) != strtolower($solution)){ header("location: $PHP_SELF?id=modules/game&no_match_ans=1"); exit; }
  $inc = 1;
  $dec = 50;
  $old_db = file("data/users.php");
  $new_db = fopen("data/users.php", "w");
  $old_q = file("data/questions.php");
  $new_q = fopen("data/questions.php", "w");
  foreach($old_q as $ques_line)
    {
      $game_arr = explode("|", $ques_line);
      if($game_arr[0] == $level) { 
	$score = $game_arr[4];
	break;
     }
    }

  foreach($old_q as $old_q_line)
    {
      $old_q_arr = explode("|", $old_q_line);
      if($level != $old_q_arr[0]) { fwrite($new_q,"$old_q_line"); }
      else
	{
	  $score = $old_q_arr[4];
          if($score > 200) { $old_q_arr[4] = $old_q_arr[4] - $dec; }
	  fwrite($new_q,"$old_q_arr[0]|$old_q_arr[1]|$old_q_arr[2]|$old_q_arr[3]|$old_q_arr[4]|\n");
        }
    }

  foreach($old_db as $old_db_line)
    {
      $old_db_arr = explode("|", $old_db_line);
      if($userid != $old_db_arr[0]) { fwrite($new_db,"$old_db_line"); }
      else
	{
	  if($old_db_arr[6] == 1) {$old_db_arr[9] = 0;}
          $old_db_arr[6] = $old_db_arr[6] + $inc;
	  $old_db_arr[9] = $old_db_arr[9] + $score;
	  $old_db_arr[10] = $old_db_arr[10] . '+' . + $score;
          fwrite($new_db,"$old_db_arr[0]|$old_db_arr[1]|$old_db_arr[2]|$old_db_arr[3]|$old_db_arr[4]|$old_db_arr[5]|$old_db_arr[6]|$old_db_arr[7]|$old_db_arr[8]|$old_db_arr[9]|$old_db_arr[10]|\n");
        }
    }
  fclose($new_q);
  fclose($new_db);

  { ?> <script> location = "<?php echo $PHP_SELF ?>?id=modules/game&correct_ans=1"; </script> <?php }
}


echo'

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-center">Level: '.$user_arr[6].'</h3>
		</div>
		<div class="panel-body">';
			if($game_arr[3]!=0)
				echo '<img class="img-responsive text-center" src="data/questions/'.$game_arr[0].'.jpg"/><br>';
			echo'
			<form action="'.$PHP_SELF.'?id=modules/game" method="post">
				Question: '.$question.'<br><br>
				<div class="input-group">
					<span class="input-group-addon">Answer</span>
					<input type="text" name="answer" class="form-control" placeholder="Answer">
				</div><br>
				<input class="btn btn-primary pull-right" type="submit" name="Save" value="Save">
				<input type="hidden" name="userid" value="'.$userid.'">
				<input type="hidden" name="action" value="edit">
			</form>
		</div>
	</div>';
}
?>
