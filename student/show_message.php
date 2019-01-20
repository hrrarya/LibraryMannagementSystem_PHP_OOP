<?php include 'lib/header.php'; ?>
<?php 
	$id = $_SESSION['user_id'];
	$message = $pdo->prepare("update message set status='yes' where u_id='$id'");
	$message ->execute();
 ?>

                            <div class="x_title">
                                <h2>Show Message</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content table-responsive">
                               <table class="table table-bordered table-striped">
                               	<tr>
                               		<th>Message</th>
                               	</tr>
                               	<?php 
                               		if($msgs = $user->userAllData("message",'u_id',$id)) {
                               			foreach($msgs as $msg) {
                               				?>
                               				<tr>
                               					<td><?php echo $msg->mes; ?></td>
                               				</tr>	
                               				<?php
                               			}
                               		}
                                ?>
                               </table>
                            </div>
<?php include 'lib/footer.php'; ?>