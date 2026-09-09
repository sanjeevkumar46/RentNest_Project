<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/navbar.php";

$sql = "SELECT * FROM rooms WHERE status='available' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<section class="rooms-section">

    <h2>Available Rooms</h2>

    <div class="room-container">

    <?php while($row=mysqli_fetch_assoc($result)){ ?>

        <div class="room-card">

            <img src="../uploads/<?php echo $row['image']; ?>">

            <h3><?php echo $row['title']; ?></h3>

            <p><strong>City:</strong> <?php echo $row['city']; ?></p>

            <p><strong>Area:</strong> <?php echo $row['area']; ?></p>

            <p><strong>Rent:</strong> ₹<?php echo $row['rent']; ?></p>

            <a href="room_details.php?id=<?php echo $row['id']; ?>">
                <button>View Details</button>
            </a>

        </div>

    <?php } ?>

    </div>

</section>

<?php include "../includes/footer.php"; ?>