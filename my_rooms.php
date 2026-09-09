<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/navbar.php";

$owner_id = $_SESSION['user_id'];

$sql = "SELECT * FROM rooms WHERE owner_id='$owner_id' ORDER BY id DESC";

$result = mysqli_query($conn, $sql);
?>

<section class="rooms-section">

    <h2>My Rooms</h2>

    <div class="room-container">

<?php

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

        <div class="room-card">

            <img src="../uploads/<?php echo $row['image']; ?>" alt="Room">

            <h3><?php echo $row['title']; ?></h3>

            <p><strong>City:</strong> <?php echo $row['city']; ?></p>

            <p><strong>Area:</strong> <?php echo $row['area']; ?></p>

            <p><strong>Rent:</strong> ₹<?php echo $row['rent']; ?></p>

            <a href="edit_room.php?id=<?php echo $row['id']; ?>">

            <button class="edit-btn">
             Edit
            </button>
            </a>

            

            <a href="delete_room.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this room?');">

    <button class="delete-btn">
        Delete
    </button>

</a>
        </div>

<?php
    }
}
else
{
    echo "<h3>No Rooms Added Yet.</h3>";
}

?>

    </div>

</section>

<?php
include "../includes/footer.php";
?>