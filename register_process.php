<?php

// Include Database Connection
include "config/db.php";

// Check if form is submitted
if(isset($_POST['fullname']))
{

    // Get Form Data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Check Password
    if($password != $confirm_password)
    {
        die("Passwords do not match!");
    }

    // Check Existing Email
    $check = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn,$check);

    if(mysqli_num_rows($result) > 0)
    {
        die("Email already registered!");
    }

    // Insert User
    $sql = "INSERT INTO users(fullname,email,phone,password,role,status)

            VALUES('$fullname','$email','$phone','$password','$role','active')";

    if(mysqli_query($conn,$sql))
    {
        echo "<h2>Registration Successful ✅</h2>";

        echo "<a href='login.php'>Click Here To Login</a>";
    }
    else
    {
        echo "Registration Failed!";
    }

}

?>