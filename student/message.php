<?php include 'lib/header.php' ?>
<?php 
	$id = $_SESSION['user_id'];
	if (isset($_POST['sendMessage']) && !empty($_POST['sendMessage'])) {
		$message = $user->checkInput($_POST['mes']);
		if (!empty($message)) {
			if ($user->create("message",array("u_id"=>$id,"mes"=>$message,"toAdmin"=>"yes"))) {
					$suc = "Message sent!!!";
				} else {
					$err = "Message not sent";
				}
		} else {
			$err = "Message field is empty.";
		}
	}
	
 ?>
                            <div class="x_title">
                                <h2>Send Message</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                	<div class="col-md-6">
                                		<form action="" method="post">
		                                	<div class="form-group">
		                                		<textarea name="mes" id="message" cols="30" rows="10" class="form-control" placeholder="Write message here..."></textarea>
		                                	</div>
		                                	<div class="form-group">
		                                		<input type="submit" name="sendMessage" value="Send Message" class="btn btn-primary">
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
<?php include 'lib/footer.php' ?>
