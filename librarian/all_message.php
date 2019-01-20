<?php 
include 'lib/header.php'; ?>
<?php

	if (isset($_GET['all_msg']) && !empty($_GET['all_msg'])) {
		$all_msg = $_GET['all_msg'];
		$userData = $user->userData("users",$all_msg);
	}else{
		?>
			<script type="text/javascript">
				alert("Invalid action!");
				window.location = "show_message.php";
			</script>
		<?php
	}
	$user->update("message",$all_msg,array("status"=>'yes'));
	if (isset($_POST['msg']) && !empty($_POST['msg'])) {
		$msg = $user->checkInput($_POST['mes']);
		if (!empty($msg)) {
			if ($user->create("message",array("u_id"=>$all_msg,"mes"=>$msg,"toAdmin"=>"no","status"=>"no"))) {
				$suc = "Message sent";
			}else{
				$err = "Message not sent";
			}
		}else{
			$err = "You could not send blank message.";
		}
	}
 ?>
                            <div class="x_title">
                                <h2><?php echo $userData->f_name." ".$userData->l_name; ?></h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                	<div class="col-md-6">
                                		<table class="table">
                                	<tr>
                                		<th>Message</th>
                                	</tr>
                                	<?php 
                                		if ($userAll = $user->select("message")) {
                                			foreach($userAll as $msg) {
                                				if ($msg->u_id==$all_msg) {
                                						if ($msg->toAdmin=='yes') {
                                							?>
                                					<tr>
                                						<td><p class="user"><?php echo $msg->mes; ?></p></td>
                                					</tr>	
                                					<?php
                                						}else{
                                							?>
                                					<tr>
                                						<td><p class="admin"><?php echo $msg->mes; ?></p></td>
                                					</tr>	
                                					<?php			
                                						}
                                					
                                				}
                                			}
                                		}
                                	 ?>
                                	
                                </table>
                                	</div>
                                </div>
                                
                            </div>
                            <div class="x_content">
                            	<div class="row">
                                	<div class="col-md-6">
                                		<form action="" method="post">
                                			<div class="form-group">
                                				<textarea name="mes" id="message" cols="30" rows="10" class="form-control" placeholder="Write message here..."></textarea>
                                			</div>
                                			<div class="form-group">
                                				<input type="submit" name="msg" value="Send Message" class="btn btn-primary">
                                			</div>
                                		</form>
                                	</div>	
                                </div>
                            </div>
 <?php 
	if (isset($err)) {
		?>
	<div class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
        <?php echo $err; ?>
    </div>
		<?php
	}
	if (isset($suc)) {
		?>
	<div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $suc; ?>
    </div>
		<?php
	}
 ?>
<?php include 'lib/footer.php'; ?>