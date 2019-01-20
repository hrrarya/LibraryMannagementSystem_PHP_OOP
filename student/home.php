<?php include 'lib/header.php'; ?>

                            <div class="x_title">
                                <h2>Show Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                	<tr>
                                        <th>Sl.</th>
                                		<th>Name</th>
                                		<th>Image</th>
                                		<th>Author</th>
                                		<th>Publication</th>
                                		<th>Category</th>
                                		<th>Stock</th>
                                		<th>Upload Time</th>
                                		<th>Action</th>
                                	</tr>
                                	<?php
                                        $i=0;
                                		if ($books = $user->select("books")) {
                                			foreach ($books as $book) {
                                                $i++;
                                				?>
										<tr>
                                            <td><?php echo $i; ?></td>
	                                		<td><?php echo $book->b_name; ?></td>
	                                		<td><img src="<?php echo $book->b_img; ?>" alt="" style="height:35px;width:50px;"></td>
	                                		<td><?php echo $book->b_author; ?></td>
	                                		<td><?php echo $book->b_publication; ?></td>
	                                		<?php 
	                                			if ($cat = $user->userData("cat",$book->cat)) {
	                                				?>
											<td><?php echo $cat->c_name; ?></td>
	                                				<?php
	                                			}
	                                		 ?>
	                                		
	                                		<td><?php echo $book->stock; ?></td>
	                                		<td><?php echo $book->postTime; ?></td>
	                                		<td><a href="#" class="btn-sm btn-info">Borrow</a></td>
                                		</tr>
                                				<?php
                                			}
                                		}
                                	 ?>
                                	
                                </table>
                                <!-- THIS PAGINATION SECTION IS NOT DYNAMIC. -->
                                <div class="normal-pagination">
                                    <nav aria-label="Page navigation">
                                      <ul class="pagination">
                                        <li>
                                          <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                          </a>
                                        </li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li>
                                          <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </nav>
                                </div>
                            </div>
<?php include 'lib/footer.php'; ?>