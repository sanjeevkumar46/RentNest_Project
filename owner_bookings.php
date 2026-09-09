<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "owner")
{
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/navbar.php";

$owner_id = $_SESSION['user_id'];

$sql = "SELECT
            bookings.id,
            bookings.status,
            bookings.booking_date,
            users.fullname,
            users.phone,
            rooms.title
        FROM bookings
        JOIN rooms ON bookings.room_id = rooms.id
        JOIN users ON bookings.user_id = users.id
        WHERE rooms.owner_id='$owner_id'
        ORDER BY bookings.id DESC";

$result = mysqli_query($conn, $sql);
?>

<section class="dashboard-section">

<h2>Booking Requests</h2>

<table border="1" width="100%" cellpadding="10">

<tr>

<th>ID</th>
<th>User</th>
<th>Phone</th>
<th>Room</th>
<th>Date</th>
<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['booking_date']; ?></td>

<td>

<?php

if($row['status'] == "Pending")
{
    echo "<b style='color:#f59e0b;'>Pending</b>";

    echo "<br><br>";

    ?>

    <a href="update_booking.php?id=<?php echo $row['id']; ?>&status=Approved">
        <button style="background:green;color:white;">
            Approve
        </button>
    </a>

    <a href="update_booking.php?id=<?php echo $row['id']; ?>&status=Rejected">
        <button style="background:red;color:white;">
            Reject
        </button>
    </a>

    <?php
}
elseif($row['status'] == "Approved")
{
    echo "<b style='color:#16a34a;'>Approved</b>";
}
elseif($row['status'] == "Rejected")
{
    echo "<b style='color:#dc2626;'>Rejected</b>";
}
elseif($row['status'] == "Cancelled")
{
    echo "<b style='color:#6b7280;'>Cancelled</b>";
}

?>

</td>

</tr>

<?php } ?>

</table>

</section>

<?php include "../includes/footer.php"; ?>