<?php
include "config/db.php";
include "includes/header.php";
include "includes/navbar.php";

$city = "";
$area = "";
$pincode = "";

if(isset($_GET['city']))
{
    $city = trim($_GET['city']);
}

if(isset($_GET['area']))
{
    $area = trim($_GET['area']);
}

if(isset($_GET['pincode']))
{
    $pincode = trim($_GET['pincode']);
}

$sql = "SELECT * FROM rooms
        WHERE status='available'
        AND id NOT IN (
            SELECT room_id
            FROM bookings
            WHERE status='Approved'
        )";

if($city != "")
{
    $sql .= " AND city LIKE '%$city%'";
}

if($area != "")
{
    $sql .= " AND area LIKE '%$area%'";
}

if($pincode != "")
{
    $sql .= " AND pincode LIKE '%$pincode%'";
}

$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn,$sql);
?>

<section class="rooms-section">

<h2>Find Your Perfect Room</h2>

<form method="GET" action="rooms.php" class="room-search">

    <input
        type="text"
        name="city"
        placeholder="Enter City"
        value="<?php echo htmlspecialchars($city); ?>"
    >

    <input
        type="text"
        name="area"
        placeholder="Enter Area"
        value="<?php echo htmlspecialchars($area); ?>"
    >

    <input
        type="text"
        name="pincode"
        placeholder="Enter PIN Code"
        value="<?php echo htmlspecialchars($pincode); ?>"
    >

    <button type="submit">
        🔍 Search
    </button>

    <a href="rooms.php">
        <button type="button" style="background:#6b7280;">
            Reset
        </button>
    </a>

</form>

<div class="room-container">

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<div class="room-card">

<img src="uploads/<?php echo $row['image']; ?>">
<?php if($row['status'] == "available") { ?>

    <span class="available-badge">
        🟢 Available
    </span>

<?php } else { ?>

    <span class="unavailable-badge">
        🔴 Not Available
    </span>

<?php } ?>

<h3><?php echo $row['title']; ?></h3>

<p><b>City:</b> <?php echo $row['city']; ?></p>

<p><b>Area:</b> <?php echo $row['area']; ?></p>

<p><b>PIN:</b> <?php echo $row['pincode']; ?></p>

<p><b>Rent:</b> ₹<?php echo $row['rent']; ?>/Month</p>

<a href="room_details.php?id=<?php echo $row['id']; ?>">
<button>View Details</button>
</a>

</div>

<?php
}
?>

</div>

</section>

<?php
include "includes/footer.php";
?>