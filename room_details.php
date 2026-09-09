<?php
session_start();

include "../config/db.php";
include "../includes/header.php";
include "../includes/navbar.php";

if (!isset($_GET['id'])) {
    header("Location: rooms.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM rooms WHERE id='$id'";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<h2 style='text-align:center;'>Room Not Found</h2>";
    include "../includes/footer.php";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<section class="rooms-section">

    <div class="room-card" style="max-width:700px;margin:auto;">

        <img
            src="../uploads/<?php echo $row['image']; ?>"
            alt="Room"
        >

        <h2>
            <?php echo $row['title']; ?>
        </h2>

        <p>
            <strong>City:</strong>
            <?php echo $row['city']; ?>
        </p>

        <p>
            <strong>Area:</strong>
            <?php echo $row['area']; ?>
        </p>

        <p>
            <strong>PIN Code:</strong>
            <?php echo $row['pincode']; ?>
        </p>

        <p>
            <strong>Monthly Rent:</strong>
            ₹<?php echo $row['rent']; ?>
        </p>

        <p>
            <strong>Description:</strong>
        </p>

        <p>
            <?php echo $row['description']; ?>
        </p>


        <!-- ROOM STATUS -->

        <?php if ($row['status'] == "available") { ?>

            <p style="color:#16a34a;font-weight:bold;">
                ✅ Available
            </p>

            <?php if (isset($_SESSION['user_id'])) { ?>

                <a href="book_room.php?room_id=<?php echo $row['id']; ?>">
                    <button
                        style="
                            background:#2563eb;
                            color:white;
                            width:100%;
                            padding:15px;
                            font-size:18px;
                        "
                    >
                        🏠 Book This Room
                    </button>
                </a>

            <?php } else { ?>

                <a href="../login.php">
                    <button
                        style="
                            background:#2563eb;
                            color:white;
                            width:100%;
                            padding:15px;
                            font-size:18px;
                        "
                    >
                        Login to Book
                    </button>
                </a>

            <?php } ?>

        <?php } else { ?>

            <p style="color:#dc2626;font-weight:bold;">
                ❌ This Room is Currently Unavailable
            </p>

        <?php } ?>


        <hr>


        <!-- OWNER INFORMATION -->

        <h3>
            Owner Contact Information
        </h3>

        <p>
            <strong>Owner Name:</strong>
            <?php echo $row['owner_name']; ?>
        </p>

        <p>
            <strong>Phone:</strong>
            <?php echo $row['owner_phone']; ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?php echo $row['owner_email']; ?>
        </p>


        <br>

        <a href="rooms.php">
            <button>
                ← Back to Rooms
            </button>
        </a>

    </div>

</section>

<?php
include "../includes/footer.php";
?>