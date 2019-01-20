<?php 
    include 'core/init.php';
 ?>
 <?php 
 	if (isset($_POST['submit1']) && !empty($_POST['submit1'])) {
 		$f_name = $user->checkInput($_POST['firstname']);
 		$l_name = $user->checkInput($_POST['lastname']);
 		$u_name = $user->checkInput($_POST['username']);
 		$pass = $user->checkInput($_POST['password']);
 		$pass = md5($pass);
 		$email = $user->checkInput($_POST['email']);
 		$contact = $user->checkInput($_POST['contact']);
 		$sem = $user->checkInput($_POST['sem']);
 		$enrollmentno = $user->checkInput($_POST['enrollmentno']);
 		$enrollmentno = strval($enrollmentno);

 		if (!empty($f_name) && !empty($l_name) && !empty($u_name) && !empty($pass) && !empty($email) && !empty($contact) && !empty($sem) && !empty($enrollmentno)) {
 			if ($user->checkData("users","u_name",$u_name)===true) {
 				$err = "Username already exists";
 			}else{
 				if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
 					$err = "Invalid Email Format.";
 				}else if($user->checkData("users","email",$email)===true){
 					$err = "Email already exists.";
 				}else{
 					if ($user->register("users",array("f_name"=>$f_name,"l_name"=>$l_name,"u_name"=>$u_name,"password"=>$pass,"email"=>$email,"contact"=>$contact,"sem"=>$sem,"enrollment"=>$enrollmentno))===false) {
 						$err = "Registration failed";
 					}
 				}
 			}
 		}else{
 			$err = "Please enter all the fields.";
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

    <title>Student Registration Form | LMS </title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/custom.min.css" rel="stylesheet">
</head>

<br>

<div class="col-lg-12 text-center ">
    <h1 style="font-family:Lucida Console">Library Management System</h1>
</div>


<body class="login" style="margin-top: -20px;">



    <div class="login_wrapper">

            <section class="login_content" style="margin-top: -40px;">
                <form name="form1" action="" method="post">
                    <h2>User Registration Form</h2><br>

                    <div>
                        <input type="text" class="form-control" placeholder="FirstName" name="firstname"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="LastName" name="lastname"/>
                    </div>

                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="username"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="email" name="email"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="contact" name="contact"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="SEM" name="sem"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Enrollment No" name="enrollmentno"/>
                    </div>
                    <div class="col-lg-12  col-lg-push-3">
                        <input class="btn btn-default submit " type="submit" name="submit1" value="Register">
                    </div>

                </form>
            </section>



    </div>

    <?php 
    	if (isset($err)) {
    		?>
	<div class="alert alert-danger col-lg-6 col-lg-push-3 text-center">
        <?php echo $err; ?>
    </div>
    		<?php
    	}
    	if (isset($GLOBALS['succes'])) {
    		?>
	<div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $GLOBALS['succes']; ?>
    </div>
    		<?php
    	}
     ?>


</body>
</html>
