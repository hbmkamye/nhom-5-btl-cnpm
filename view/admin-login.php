<?php 
session_start(); 
include "../config/config.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['email'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
    $email = validate($_POST['email']);
	if (empty($uname)) {
		header("Location: admin.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: admin.php?error=Password is required");
	    exit();
	}else if(empty($email)){
        header("Location: admin.php?error=Email is required");
	    exit();
	}else{
		// hashing the password
        $pass = md5($pass);

        
		$sql = "SELECT * FROM admin WHERE user_admin='$uname' AND password_admin='$pass'";

		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_admin'] === $uname && $row['password_admin'] === $pass) {
            	$_SESSION['user_admin'] = $row['user_admin'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id_admin'] = $row['id_admin'];
            	header("Location: home-admin.php");
		        exit();
            }else{
				header("Location: admin.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: admin.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}