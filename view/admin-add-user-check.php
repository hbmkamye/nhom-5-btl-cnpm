<?php
session_start();
require '../config/config.php';

if(isset($_POST['delete_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);


    $query1 = "DELETE FROM groups WHERE user_id='$user_id' ";
    $query2 = "DELETE FROM spending WHERE user_id='$user_id' ";
    $query3 = "DELETE FROM users WHERE user_id='$user_id' ";
    $query_run1 = mysqli_query($con, $query1);
    $query_run2 = mysqli_query($con, $query2);
    $query_run3 = mysqli_query($con, $query3);

    if($query_run1 && $query_run2 && $query_run3)
    {
        $_SESSION['message'] = "User Deleted Successfully";
        header("Location: home-admin.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Deleted";
        header("Location: home-admin.php");
        exit(0);
    }
}

if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "UPDATE  users SET user_name='$user_name', email='$email', password='$password' WHERE user_id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User Updated Successfully";
        header("Location: admin-edit-user.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Updated";
        header("Location: admin-edit-user.php");
        exit(0);
    }

}


if(isset($_POST['save_user']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "INSERT INTO users (user_name,email,password) VALUES ('$name','$email','$password')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "User Created Successfully";
        header("Location: admin-add-user.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Created";
        header("Location: admin-add-user.php");
        exit(0);
    }
}

?>