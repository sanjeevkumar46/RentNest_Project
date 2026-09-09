<?php
include "includes/header.php";
include "includes/navbar.php";
?>

<main>

    <!-- Hero Section -->
    <section class="hero">

        <h2>Find Your Perfect Rental Room</h2>

        <p>Search rooms by City, Area and PIN Code.</p>

        <a href="login.php">
            <button>Search Rooms</button>
        </a>

    </section>

    <!-- Search Section -->
    <section class="search-section">

        <h2>Search Rooms</h2>

        <form action="user/rooms.php" method="GET">

            <input type="text"
                   name="city"
                   placeholder="Enter City">

            <input type="text"
                   name="area"
                   placeholder="Enter Area">

            <input type="text"
                   name="pincode"
                   placeholder="Enter PIN Code">

            <button type="submit">
                Search
            </button>

        </form>

    </section>

    <!-- Recently Added Rooms -->
    <section class="rooms-section">

        <h2>Recently Added Rooms</h2>
        <div class="room-container">

<?php

include "config/db.php";

$sql = "SELECT * FROM rooms ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

    <div class="room-card">

        <img src="uploads/<?php echo $row['image']; ?>">

        <h3><?php echo $row['title']; ?></h3>

        <p><strong>City:</strong> <?php echo $row['city']; ?></p>

        <p><strong>Area:</strong> <?php echo $row['area']; ?></p>

        <p><strong>Rent:</strong> ₹<?php echo $row['rent']; ?> / Month</p>

        <a href="room_details.php?id=<?php echo $row['id']; ?>">
            <button>View Details</button>
        </a>

    </div>

<?php
    }
}
else
{
    echo "<h3>No Rooms Available</h3>";
}

?>

</div>

        

        

    </section>

</main>

<?php
include "includes/footer.php";
?>