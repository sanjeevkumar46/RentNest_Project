<?php
session_start();

include "../config/db.php";

if(!isset($_GET['id']) || !isset($_GET['status']))
{
    header("Location: owner_bookings.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];


/* Get room ID */
$get_booking = "SELECT room_id
                FROM bookings
                WHERE id='$id'";

$result = mysqli_query($conn, $get_booking);

if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);

    $room_id = $row['room_id'];


    /* Update booking status */
    $sql = "UPDATE bookings
            SET status='$status'
            WHERE id='$id'";

    mysqli_query($conn, $sql);


    /* If rejected, make room available again */
    if($status == "Rejected")
    {
        $update_room = "UPDATE rooms
                        SET status='available'
                        WHERE id='$room_id'";

        mysqli_query($conn, $update_room);
    }
}

header("Location: owner_bookings.php");
exit();
?>