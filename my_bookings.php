<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include "config/db.php";
include "includes/header.php";
include "includes/navbar.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT
            bookings.id,
            bookings.booking_date,
            bookings.status,
            rooms.title,
            rooms.city,
            rooms.rent,
            users.fullname AS owner_name,
            users.phone AS owner_phone,
            users.email AS owner_email
    
        FROM bookings
        JOIN rooms ON bookings.room_id = rooms.id
        JOIN users ON rooms.owner_id = users.id
        WHERE bookings.user_id='$user_id'
        ORDER BY bookings.id DESC";

$result = mysqli_query($conn, $sql);
?>

<section class="dashboard-section">

<h2>My Bookings</h2>

<table border="1" width="100%" cellpadding="10">

<tr>

<th>ID</th>
<th>Room</th>
<th>City</th>
<th>Rent</th>
<th>Owner</th>
<th>Phone</th>
<th>Booking Date</th>
<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['city']; ?></td>

<td>₹<?php echo $row['rent']; ?></td>

<td><?php echo $row['owner_name']; ?></td>

<td><?php echo $row['owner_phone']; ?></td>

<td><?php echo $row['booking_date']; ?></td>

<td>

<?php

if($row['status'] == "Pending")
{
    echo "<span style='color:#f59e0b;font-weight:bold;'>Pending</span>";

    echo "<br><small>⏳ Waiting for owner approval...</small>";

    ?>

    <br><br>

    <a href="cancel_booking.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Are you sure you want to cancel this booking?');">

        <button style="background:#dc2626;">
            ❌ Cancel Booking
        </button>

    </a>

    <?php
}

elseif($row['status'] == "Approved")
{
    echo "<span style='color:#16a34a;font-weight:bold;'>Approved</span>";

    echo "<br><br>";

    ?>

    <a href="tel:<?php echo $row['owner_phone']; ?>">
        <button>📞 Call</button>
    </a>

    <a href="mailto:<?php echo $row['owner_email']; ?>">
        <button>📧 Email</button>
    </a>

    <a href="https://wa.me/91<?php echo $row['owner_phone']; ?>"
       target="_blank">

        <button style="background:#25D366;">
            💬 WhatsApp
        </button>

    </a>

    <?php
}

elseif($row['status'] == "Rejected")
{
    echo "<span style='color:#dc2626;font-weight:bold;'>Rejected</span>";

    echo "<br><small>❌ This booking was rejected.</small>";
}

elseif($row['status'] == "Cancelled")
{
    echo "<span style='color:#6b7280;font-weight:bold;'>Cancelled</span>";

    echo "<br><small>🚫 You cancelled this booking.</small>";
}

?>

</td>


</tr>

<?php } ?>

</table>

</section>

<?php include "includes/footer.php"; ?>