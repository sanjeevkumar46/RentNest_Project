<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include "config/db.php";

$user_id = $_SESSION['user_id'];

if(!isset($_GET['id']))
{
    header("Location: my_bookings.php");
    exit();
}

$booking_id = $_GET['id'];

/* Get room ID */
$get_booking = "SELECT room_id
                FROM bookings
                WHERE id='$booking_id'
                AND user_id='$user_id'
                AND status='Pending'";

$result = mysqli_query($conn, $get_booking);

if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);

    $room_id = $row['room_id'];

    /* Cancel booking */
    $sql = "UPDATE bookings
            SET status='Cancelled'
            WHERE id='$booking_id'
            AND user_id='$user_id'
            AND status='Pending'";

    if(mysqli_query($conn, $sql))
    {
        /* Make room available again */
        $update_room = "UPDATE rooms
                        SET status='available'
                        WHERE id='$room_id'";

        mysqli_query($conn, $update_room);

        echo "<script>
                alert('Booking cancelled successfully!');
                window.location='my_bookings.php';
              </script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
else
{
    echo "<script>
            alert('Booking cannot be cancelled.');
            window.location='my_bookings.php';
          </script>";
}
?>