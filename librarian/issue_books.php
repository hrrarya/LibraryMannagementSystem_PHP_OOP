<?php include 'lib/header.php'; ?>

    <div class="x_title">
        <h2>Show Books</h2>

        <div class="clearfix"></div>
    </div>
<?php 
  if (isset($_GET['issueid']) && !empty($_GET['issueid'])) {
    $id = $_GET['issueid'];
    $book = $user->userData("books",$id);

            //IF BOOKS ID FOUND IN THE DB THEN......
            if ($user->checkData("books","id",$id)===true) {
                if (isset($_POST['issueBook']) && !empty($_POST['issueBook'])) {
                  $b_id     = $user->checkInput($_POST['b_id']);
                  $b_name   = $user->checkInput($_POST['b_name']);
                  $b_author = $user->checkInput($_POST['b_author']);
                  $b_publication = $user->checkInput($_POST['b_publication']);
                  $user_id = $user->checkInput($_POST['u_id']);
                  $count = 0;

                  if (!empty($b_name) && !empty($b_author) && !empty($b_publication) && !empty($user_id)) {
                    //IF USER GIVE A UNKNOWN BOOK ID AND IF ITS NOT FOUND IN DB THEN IT WILL SHOW THIS ERROR.
                        if($user->checkData("users","id",$user_id)===false){
                          $err = "User not found";
                        }else if ($user->checkData("books","id",$b_id)===false) {
                           $err = "Invalid book id.book not found.";
                        }else{
                            if ($issue_books = $user->select("issue_book")) {
                              foreach ($issue_books as $issue_book) {
                                if ($id == $issue_book->b_id && $user_id == $issue_book->u_id) {
                                  $count++;
                                }
                              }
                               
                            }
                            if ($count>0) {
                                 $err = "Already borrowed by this user.please return this book.";
                               }else{
                                  if ($user->create("issue_book",array("b_id"=>$b_id,"u_id"=>$user_id,"issue_date"=>date("Y-m-d H-i-s")))) {
                                    $user->update("books",$id,array("stock"=>$book->stock-1));
                                    $suc = "Book issued succesfully.";
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
                                    <input type="text" name="b_id" class="form-control input" value="<?php echo $book->id; ?>" readonly>
                              </div>
                              <div class="form-group">
                                    <input type="text" name="b_name" class="form-control input" value="<?php echo $book->b_name; ?>">
                              </div>
                              <div class="form-group">
                                    <input type="text" name="b_author" class="form-control input" value="<?php echo $book->b_author; ?>">
                              </div>
                              <div class="form-group">
                                    <input type="text" name="b_publication" class="form-control input" value="<?php echo $book->b_publication; ?>">
                              </div>
                              <div class="form-group">
                                    <input type="text" name="u_id" class="form-control input" placeholder="Enter student id here...">
                              </div>
                              <div class="form-group">
                                    <input type="submit" name="issueBook" class="form-control btn btn-primary" value="Issue Book">
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
      }elseif(isset($suc)) {
            ?>
      <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $suc; ?>
    </div>
            <?php
      }
            
      }else{
            //IF BOOK ID NOT FOUND IN DB THEN IT WILL SHOW THIS ERROR MESSAGE.....
            ?>
            <center><h2>Something went wrong..</h2><a href="show_books.php">Go back</a></center>
            <?php
      }

            }
?>

      
      
      
<?php include 'lib/footer.php'; ?>
