<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";

$id = $_GET['id'];

// Get image name before deleting
$sql = "SELECT image FROM rooms
        WHERE id='$id'
        AND owner_id='".$_SESSION['user_id']."'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1)
{
    $row = mysqli_fetch_assoc($result);

    // Delete image from uploads folder
    if(file_exists("../uploads/".$row['image']))
    {
        unlink("../uploads/".$row['image']);
    }

    // Delete room from database
    mysqli_query($conn,
    "DELETE FROM rooms
     WHERE id='$id'
     AND owner_id='".$_SESSION['user_id']."'");
}

header("Location: my_rooms.php");
exit();
?>