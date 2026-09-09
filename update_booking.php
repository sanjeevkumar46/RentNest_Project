<?php
session_start();

include "../config/db.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

if(!isset($_GET['id']) || !isset($_GET['status']))
{
    header("Location: owner_bookings.php");
    exit();
}

$booking_id = $_GET['id'];
$status = $_GET['status'];

// Get room ID from booking
$sql = "SELECT room_id FROM bookings WHERE id='$booking_id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0)
{
    header("Location: owner_bookings.php");
    exit();
}

$booking = mysqli_fetch_assoc($result);

$room_id = $booking['room_id'];


// APPROVE BOOKING
if($status == "Approved")
{
    // Update booking
    $sql = "UPDATE bookings
            SET status='Approved'
            WHERE id='$booking_id'";

    mysqli_query($conn, $sql);

    // Make room unavailable
    $sql = "UPDATE rooms
            SET status='booked'
            WHERE id='$room_id'";

    mysqli_query($conn, $sql);
}


// REJECT BOOKING
elseif($status == "Rejected")
{
    $sql = "UPDATE bookings
            SET status='Rejected'
            WHERE id='$booking_id'";

    mysqli_query($conn, $sql);
}


// CANCELLED BOOKING
elseif($status == "Cancelled")
{
    $sql = "UPDATE bookings
            SET status='Cancelled'
            WHERE id='$booking_id'";

    mysqli_query($conn, $sql);

    // Make room available again
    $sql = "UPDATE rooms
            SET status='available'
            WHERE id='$room_id'";

    mysqli_query($conn, $sql);
}

header("Location: owner_bookings.php");
exit();
?>