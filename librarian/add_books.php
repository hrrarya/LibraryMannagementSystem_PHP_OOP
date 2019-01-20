<?php include 'lib/header.php'; ?>
<?php 
	if (isset($_POST['addBook']) && !empty($_POST['addBook'])) {
		$b_name   = $user->checkInput($_POST['b_name']);

		

		$b_author = $user->checkInput($_POST['b_author']);
		$b_publication = $user->checkInput($_POST['b_publication']);
		$cat = $user->checkInput($_POST['cat']);
		$stock = $user->checkInput($_POST['stock']);

		if (!empty($b_name) && !empty($b_author) && !empty($b_publication) && !empty($cat) && !empty($stock)) {
			
			$fileroot   = $user->uploadImage($_FILES['b_img']);
			
			if (!is_numeric($stock)) {
				$err = "Stock must be a numeric";
			}else{
				if ($user->create("books", array("b_name"=>$b_name,"b_img"=>$fileroot,"b_author"=>$b_author,"b_publication"=>$b_publication,"cat"=>$cat,"stock"=>$stock,"postTime"=>date("Y-m-d H:i:s")))===true) {
					$suc = "Book added succesfully.";
				}else{
					$err = "Book not added.";
				}
			}
		}else{
			$err = "Please enter all the field";
		}
	}
 ?>
                            <div class="x_title">
                                <h2>Add Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                	<div class="col-md-6">
                                		<form action="" method="post" enctype="multipart/form-data">
                                			<div class="form-group">
                                				<input type="text" name="b_name" class="form-control input" placeholder="Book Name">
                                			</div>
                                			<div class="form-group">
                                				<input type="file" name="b_img" class="form-control input">
                                			</div>
                                			<div class="form-group">
                                				<input type="text" name="b_author" class="form-control input" placeholder="Author Name">
                                			</div>
                                			<div class="form-group">
                                				<input type="text" name="b_publication" class="form-control input" placeholder="Publication">
                                			</div>
                                			<div class="form-group">
                                				<select name="cat" id="" class="form-control input">
                                					<option value="">Select a category</option>
                                					<?php 
                                						if ($cats = $user->select("cat")) {
                                							foreach($cats as $cat){
                                								?>
													<option value="<?php echo $cat->id; ?>"><?php echo $cat->c_name; ?></option>
                                								<?php
                                							}
                                						}
                                					 ?>
                                					
                                					
                                				</select>
                                			</div>
                                			<div class="form-group">
                                				<input type="text" name="stock" class="form-control input" placeholder="Stock">
                                			</div>
                                			<div class="form-group">
                                				<input type="submit" name="addBook" class="form-control btn btn-primary">
                                			</div>
                                		</form>
                                	</div>
                                </div>
                            </div>
             <?php 
             	if (isset($GLOBALS['error'])) {
    		?>
	<div class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
        <?php echo $GLOBALS['error']; ?>
    </div>
    		<?php
    	}elseif(isset($err)) {
    		?>
	<div class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
        <?php echo $err; ?>
    </div>
    		<?php
    	}elseif(isset($suc)) {
    		?>
	<div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $suc; ?>
    </div>
    		<?php
    	}
              ?>
<?php include 'lib/footer.php'; ?>