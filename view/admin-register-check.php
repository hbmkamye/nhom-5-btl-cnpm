<?php 
session_start(); 
include "../config/config.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['email_admin']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	$emai = validate($_POST['email_admin']);



	if (empty($uname)) {
		header("Location: admin-register.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: admin-register.php?error=Password is required");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: admin-register.php?error=Re Password is required");
	    exit();
	}

	else if(empty($emai)){
        header("Location: admin-register.php?error=Email is required");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: admin-register.php?error=The confirmation password  does not match");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM admin WHERE user_admin='$uname' ";
		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: admin-register.php?error=The username is taken try another");
	        exit();
		}else {
           $sql2 = "INSERT INTO admin(user_admin, password_admin,email_admin) VALUES('$uname', '$pass', '$emai')";
           $result2 = mysqli_query($con, $sql2);
           if ($result2) {
           	 header("Location: admin-register.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: admin-register.php?error=unknown error occurred");
		        exit();
           }
		}
	}
	
}else{
	header("Location: admin-register.php");
	exit();
}