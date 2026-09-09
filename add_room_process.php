 <?php
session_start();

include "../config/db.php";

// Check if form is submitted
if(isset($_POST['title']))
{
    // Get form data
    $owner_id = $_SESSION['user_id'];

    $title = $_POST['title'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $pincode = $_POST['pincode'];
    $rent = $_POST['rent'];
    $owner_name = $_POST['owner_name'];
    $owner_phone = $_POST['owner_phone'];
    $owner_email = $_POST['owner_email'];
    $description = $_POST['description'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    // Save image in uploads folder
    move_uploaded_file($temp, "../uploads/" . $image);

    // Insert into database
    $sql = "INSERT INTO rooms
(
owner_id,
title,
city,
area,
pincode,
rent,
owner_name,
owner_phone,
owner_email,
description,
image
)
VALUES
(
'$owner_id',
'$title',
'$city',
'$area',
'$pincode',
'$rent',
'$owner_name',
'$owner_phone',
'$owner_email',
'$description',
'$image'
)";
    if(mysqli_query($conn, $sql))
    {
        echo "<h2>Room Added Successfully ✅</h2>";
        echo "<a href='dashboard.php'>Go to Dashboard</a>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
?>