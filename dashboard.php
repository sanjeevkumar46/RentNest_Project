<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

include "../includes/header.php";
include "../includes/navbar.php";
?>

<section class="hero">

    <h2>Owner Dashboard</h2>

<p>Welcome <?php echo $_SESSION['fullname']; ?></p>

<br>

<a href="add_room.php">
    <button>Add New Room</button>
</a>

&nbsp;&nbsp;

<a href="my_rooms.php">
    <button>My Rooms</button>
</a>

<a href="owner_bookings.php">
    <button>Booking Requests</button>
</a>

</section>

<?php
include "../includes/footer.php";
?>