<?php
session_start();

include "config/db.php";

// Check if form is submitted
if(isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Find user
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);

        // Plain text password check
        if($password == $row['password'])
        {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['role'] = $row['role'];

            if($row['role'] == "admin")
            {
                header("Location: admin/dashboard.php");
            }
            elseif($row['role'] == "owner")
            {
                header("Location: owner/dashboard.php");
            }
            else
            {
                header("Location: user/dashboard.php");
            }

            exit();
        }
        else
        {
            echo "Incorrect Password!";
        }
    }
    else
    {
        echo "User not found!";
    }
}
else
{
    echo "Please login from the login page.";
}
?>