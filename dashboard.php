<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/RentNest/css/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<section class="hero">

    <h2>
        Welcome, <?php echo $_SESSION['fullname']; ?> 👋
    </h2>

    <p>You are logged in as a User.</p>

<?php

$user_id = $_SESSION['user_id'];

/* Total Bookings */
$booking_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM bookings
     WHERE user_id='$user_id'"
);

$booking_count = mysqli_fetch_assoc($booking_query);


/* Pending Bookings */
$pending_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM bookings
     WHERE user_id='$user_id'
     AND status='Pending'"
);

$pending_count = mysqli_fetch_assoc($pending_query);


/* Approved Bookings */
$approved_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM bookings
     WHERE user_id='$user_id'
     AND status='Approved'"
);

$approved_count = mysqli_fetch_assoc($approved_query);

?>

<div class="dashboard-container">

    <div class="dashboard-card">
        <h3 style="color:#333 !important;">My Bookings</h3>

        <h1 style="
            color:#2563eb !important;
            background:transparent !important;
            font-size:48px !important;
            font-weight:bold !important;
            margin:10px 0 !important;
            text-shadow:none !important;
        ">
            <?php echo $booking_count['total']; ?>
        </h1>
    </div>


    <div class="dashboard-card">
        <h3 style="color:#333 !important;">Pending</h3>

        <h1 style="
            color:#f59e0b !important;
            background:transparent !important;
            font-size:48px !important;
            font-weight:bold !important;
            margin:10px 0 !important;
            text-shadow:none !important;
        ">
            <?php echo $pending_count['total']; ?>
        </h1>
    </div>


    <div class="dashboard-card">
        <h3 style="color:#333 !important;">Approved</h3>

        <h1 style="
            color:#16a34a !important;
            background:transparent !important;
            font-size:48px !important;
            font-weight:bold !important;
            margin:10px 0 !important;
            text-shadow:none !important;
        ">
            <?php echo $approved_count['total']; ?>
        </h1>
    </div>

</div>

<br>

<a href="rooms.php">
    <button>Browse Rooms</button>
</a>

<br><br>

<a href="../my_bookings.php">
    <button>My Bookings</button>
</a>

</section>

<?php include "../includes/footer.php"; ?>

</body>
</html>