<?php
session_start();

include "config/db.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(!isset($_GET['room_id']))
{
    header("Location: user/rooms.php");
    exit();
}

$room_id = $_GET['room_id'];


// Check if room already has an active booking
$check = "SELECT id, status
          FROM bookings
          WHERE room_id='$room_id'
          AND status IN ('Pending','Approved')
          LIMIT 1";

$result = mysqli_query($conn, $check);

if(mysqli_num_rows($result) > 0)
{
    echo "<script>
            alert('This room already has an active booking request.');
            window.location='user/rooms.php';
          </script>";
    exit();
}


// Create new booking
$sql = "INSERT INTO bookings(room_id,user_id,status)
        VALUES('$room_id','$user_id','Pending')";

if(mysqli_query($conn,$sql))
{
    echo "<script>
            alert('Booking Request Sent Successfully!');
            window.location='user/my_bookings.php';
          </script>";
}
else
{
    echo "Error : ".mysqli_error($conn);
}
?>