<?php 
	include '../../core/init.php';
	$count = 0;
	if ($issue = $user->select("issue_book")) {
		foreach ($issue as $is) {
			if($is->b_id == 7 && $is->u_id==1){
				$count++;
			}
		}
		if ($count==1) {
			if ($user->delete("DELETE FROM issue_book WHERE b_id=7 AND u_id=1")===true) {
				echo "true";
			}else{
				echo "false";
			}
		}
	}
 ?>