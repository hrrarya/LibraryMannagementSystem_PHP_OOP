<?php include 'lib/header.php'; ?>

                            <div class="x_title">
                                <h2>Show Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content table-responsive">
                                <table class="table table-bordered table-striped">
                                	<tr>
                                		<th>Username</th>
                                		<th>Message</th>
                                	</tr>
                                	<?php 
										 $userData = $user->select("message");
										 foreach($userData as $users) {
										 	if ($users->toAdmin == 'yes') {
										 		?>
										 		<tr>
										 			<td><a href="all_message.php?all_msg=<?php echo $users->u_id; ?>">
										 				<?php 
										 					if ($usr = $user->userData("users",$users->u_id)) {
										 						echo $usr->u_name;
										 					}
										 				 ?>
										 			</a></td>
										 			<td><?php echo $users->mes; ?></td>
										 		</tr>
										 		<?php
										 	}
										 }

									 ?>
                                	
                                </table>
                            </div>
<?php include 'lib/footer.php'; ?>