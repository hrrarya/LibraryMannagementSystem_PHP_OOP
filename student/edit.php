<?php include 'lib/header.php'; ?>

		<div class="x_title">
		    <h2>Show Books</h2>

		    <div class="clearfix"></div>
		</div>
<?php 
	if (isset($_GET['editid']) && !empty($_GET['editid'])) {
		$id = $_GET['editid'];
		$book = $user->userData("books",$id);

            //IF BOOKS ID FOUND IN THE DB THEN......
            if ($user->checkData("books","id",$id)===true) {
                if (isset($_POST['editBook']) && !empty($_POST['editBook'])) {
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
                              //IT WILL PREVENT TO SAVE EMPTY IMG PATH IN DB.
                              if (!empty($fileroot)) {
                                    if ($user->update("books",$id, array("b_name"=>$b_name,"b_img"=>$fileroot,"b_author"=>$b_author,"b_publication"=>$b_publication,"cat"=>$cat,"stock"=>$stock,"postTime"=>date("Y-m-d H:i:s")))===true) {
                                    $suc = "Book updated succesfully.";
                                    }else{
                                          $err = "Book not updated.";
                                    }
                              }
                        }
                  }else{
                        $err = "Please enter all the field";
                  }
            }


            ?>
      <div class="x_content">
            <div class="row">
                  <div class="col-md-6">
                        <form action="" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                    <input type="text" name="b_name" class="form-control input" value="<?php echo $book->b_name; ?>">
                              </div>
                              <div class="form-group">
                                    <input type="file" name="b_img" class="form-control input">
                              </div>
                              <div class="form-group">
                                    <input type="text" name="b_author" class="form-control input" value="<?php echo $book->b_author; ?>">
                              </div>
                              <div class="form-group">
                                    <input type="text" name="b_publication" class="form-control input" value="<?php echo $book->b_publication; ?>">
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
                                    <input type="text" name="stock" class="form-control input" value="<?php echo $book->stock; ?>">
                              </div>
                              <div class="form-group">
                                    <input onclick="confirmation()" id="editBook" type="submit" name="editBook" class="form-control btn btn-primary" value="Edit Book">
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
      <div  class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
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
            <?php
      }else{
            //IF BOOK ID NOT FOUND IN DB THEN IT WILL SHOW THIS ERROR MESSAGE.....
            ?>
            <center><h2>Something went wrong..</h2><a href="show_books.php">Go back</a></center>
            <?php
      }

            }
?>
<script type="text/javascript">
  function confirmation(){
    var conf = confirm("are you sure?");
    if(!conf) {
      document.getElementById("editBook").removeAttribute('name');
      return false;
    }
  }
</script>
			
<?php include 'lib/footer.php'; ?>
