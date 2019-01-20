<?php include 'lib/header.php'; ?>
<?php 
    if (isset($_GET['approve'])) {
        $approveId = $_GET['approve'];

        if ($user->update("users",$approveId,array("status"=>"yes"))) {
            $suc = "Approved Succesfully";
        }
    }
    if (isset($_GET['disapprove'])) {
        $disapproveId = $_GET['disapprove'];

        if ($user->update("users",$disapproveId,array("status"=>"no"))) {
            $suc = "Dispproved Succesfully";
        }
    }
    if (isset($_GET['del'])) {
        $del = $_GET['del'];

        if ($user->delete("DELETE FROM users WHERE id='$del'")) {
            $suc = "User deleted Succesfully";
        }
    }
 ?>
                            <div class="x_title">
                                <h2>Registered User</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Semister</th>
                                        <th>Enrollment</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php 
                                        if ($users = $user->select("users")) {
                                            foreach($users as $user){
                                                ?>
                                            <tr>
                                                <td><?php echo ucfirst($user->f_name)." ".ucfirst($user->l_name) ?></td>
                                                <td><?php echo $user->u_name; ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <td><?php echo $user->contact; ?></td>
                                                <td><?php echo $user->sem; ?></td>
                                                <td><?php echo $user->enrollment; ?></td>
                                                <td>
                                                    <?php 
                                                        if ($user->status=="no") {
                                                            ?>
                                                    <a onclick="confirmationDelete(this); return false;" href="?approve=<?php echo $user->id; ?>" class="btn btn-info">Approve</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                    <a onclick="confirmationDelete(this); return false;" href="?disapprove=<?php echo $user->id; ?>" class="btn btn-primary">Disapprove</a>
                                                            <?php
                                                        }
                                                     ?>
                                                <a onclick="confirmationDelete(this); return false;" href="?del=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                                <?php
                                            }
                                        } else {
                                            //echo "<br>";
                                            $err = "User not found";
                                        }
                                        
                                     ?>
                                    
                                </table>
                                <br>
                            </div>
<?php 
    if (isset($suc)) {

        ?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $suc; ?>
    </div>
        <?php
        echo "<br>";
    }
    if (isset($err)) {
        echo "<br>";
        ?>
    <div class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
        <?php echo $err; ?>
    </div>
        <?php
    }
 ?>
 <script type="text/javascript">
     function confirmationDelete(anchor){
        var conf = confirm("Are you sure?");
        if (conf) {
            window.location = anchor.attr('href');
        }
     }
 </script>
<?php include 'lib/footer.php'; ?>