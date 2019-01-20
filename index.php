<?php 
    include 'core/init.php';
    if($user->loggedIn()===true){
        header("Location: librarian/home.php");
    }
 ?>
 <?php 
    if (isset($_POST['submit1']) && !empty($_POST['submit1'])) {
        $username = $user->checkInput($_POST['username']);
        $password = $user->checkInput($_POST['password']);
        $table    = $user->checkInput($_POST['table']);

        if (!empty($username) && !empty($password) && !empty($table)) {
            if ($user->login($table,$username,$password)===false) {
                $err = "Username or password is incorrect.";
            }
        }else{
            $err = "Please fill all fields.";
        }
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Login Form | LMS </title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/custom.min.css" rel="stylesheet">
</head>

<br>

<div class="col-lg-12 text-center ">
    <h1 style="font-family:Lucida Console">Library Management System</h1>
</div>

<br>

<body class="login">


<div class="login_wrapper">

    <section class="login_content">
        <form name="form1" action="" method="post">
            <h1>User Login Form</h1>

            <div class="form-group">
                     <input type="text" name="username" class="form-control" placeholder="Username"/>
                
                
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>
            <div class="form-group">
                <select name="table" id="" class="form-control">
                    <option value="">Login as</option>
                    <option value="users">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">

                <input class="btn btn-default submit" type="submit" name="submit1" value="Login">
                <a class="reset_pass" href="#">Lost your password?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">New to site?
                    <a href="registration.php"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br/>


            </div>
        </form>
    </section>
</div>
    <?php 
        if (isset($err)) {
            ?>
        <div id="err"  class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
                <strong style="color:white"><?php echo $err; ?></strong>
        </div>
            <?php
        }
        if(isset($GLOBALS['user_err'])){
            ?>
        <div id="err" class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
                <strong style="color:white"><?php echo $GLOBALS['user_err']; ?></strong>
        </div>
            <?php
        }
     ?>

        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
           //I HAVE TO HIDE ERROR MESSAGE AFTER 5 SECONDS.OKAY?(NOT DONE YET)
        </script>
</body>
</html>
