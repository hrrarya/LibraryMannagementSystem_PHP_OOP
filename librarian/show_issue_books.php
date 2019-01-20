<?php include 'lib/header.php'; ?>

                            <div class="x_title">
                                <h2>Show Books Issued By User</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter student id here...." name="user_id">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="form-control btn btn-primary" value="Search" name="userSearch">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<?php 
    if (isset($_POST['userSearch']) && !empty($_POST['userSearch'])) {
        $user_id = $user->checkInput($_POST['user_id']);
        ?>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Book Name</th>
                <th>Book Image</th>
                <th>Author</th>
                <th>Publication</th>
                <th>category</th>
                <th>Action</th>
            </tr>
        
        <?php
        if (!empty($user_id)) {
            if (!is_numeric($user_id)) {
                $err = "User id should be number.";
            }else{
                if ($books = $user->userAllData("issue_book","u_id",$user_id)) {

                    foreach ($books as $book) {
                        $allbook = $user->userData("books",$book->b_id);
                        if ($book->b_id == $allbook->id) {
                            $_SESSION['user_id'] = $user_id;
                            ?>
                            <tr>
                                
                                <td><?php echo $allbook->b_name; ?></td>
                                <td><img src="<?php echo $allbook->b_img; ?>" alt="" style="height:35px;width: 50px;"></td>  
                                <td><?php echo $allbook->b_author; ?></td>  
                                <td><?php echo $allbook->b_publication; ?></td>  
                                <td>
                                    <?php 
                                    if ($cats = $user->userData("cat",$allbook->cat)) {
                                        echo $cats->c_name;
                                    }
                                    ?>
                                </td>
                                <td><a href="?returnid=<?php echo $allbook->id; ?>" class="btn btn-primary">Return</a></td>
                            </tr>
                            

                            <?php
                        }
                    }
                }else{
                    $err = "No books are borrowed by this user";
                }
            }
        }else{
            $err = "Please enter user id";
        }
    }
 ?>
 </table>
 <?php 
    if (isset($_GET['returnid']) && !empty($_GET['returnid'])) {
        $id = $_GET['returnid'];
        $book = $user->userData("books",$id);
        $c = 0;
        if ($user->checkData("books","id",$id)===true) {
            $user_id = $_SESSION['user_id'];
            if ($issued = $user->select("issue_book")) {//THERE IS A BUG FOUND.....
                foreach($issued as $issue){
                    if ($issue->b_id == $id && $issue->u_id == $user_id) {
                        $c++;
                    }
                }
                if ($c==1) {
                    if ($user->delete("DELETE FROM issue_book WHERE b_id='$id' AND u_id='$user_id'")) {
                        $user->update("books",$id,array("stock"=>$book->stock+1));
                        $suc = "Book succesfully returned";
                    }
                }
            }
        }else{
            $err = "Invalid book id.Book not found";
        }
    }
 ?>
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