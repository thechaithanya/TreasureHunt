<?php
if($is_loged_in == TRUE)
{

	$new_db = fopen("data/questions.php", "a");
 if($action == "edit")
{
		  $bhaimera=1000;
		  echo "Hello World";
                  $mainthing=$qno."|".$ques."|".$ans."|".$imo."|1000|";
                  fwrite($new_db,"$mainthing\n");
		  fclose($new_db);
		  
  { ?> <script> location = "<?php echo $PHP_SELF ?>?id=modules/addq&profile_saved=1"; </script> <?php }
}
		  
echo'
		  
		  <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-center">Add question</h3>
		</div>
		<div class="panel-body">
			<form method="post" action="'.$PHP_SELF.'?id=modules/addq" method="post">
				
				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Question no:</h4>
					</div>
					<div class="col-lg-7 col-md-7">						
						<input type="text" class="form-control" name="qno">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Question:</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control"  name="ques">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Answer:</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" name="ans">
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="col-lg-5 col-md-5">
						<h4>Image name</h4>
					</div>
					<div class="col-lg-7 col-md-7">
						<input type="text" class="form-control" name="imo">
					</div>
				</div>

				<input class="btn btn-primary pull-right" type="submit" name="Save" value="Save">
				<input type="hidden" name="action" value="edit">
			</form>
		</div>
	</div>';
}
else { header("location: $PHP_SELF?no_acces=1"); }
?>		