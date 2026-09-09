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

$id = $_GET['id'];

$sql = "SELECT * FROM rooms
        WHERE id='$id'
        AND owner_id='".$_SESSION['user_id']."'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

?>

<section class="search-section">

<h2>Edit Room</h2>

<form action="update_room.php" method="POST" enctype="multipart/form-data">

<input type="hidden"
       name="id"
       value="<?php echo $row['id']; ?>">

<input
type="text"
name="title"
value="<?php echo $row['title']; ?>"
required>

<input
type="text"
name="city"
value="<?php echo $row['city']; ?>"
required>

<input
type="text"
name="area"
value="<?php echo $row['area']; ?>"
required>

<input
type="text"
name="pincode"
value="<?php echo $row['pincode']; ?>"
required>

<input
type="number"
name="rent"
value="<?php echo $row['rent']; ?>"
required>

<textarea
name="description"
rows="5"><?php echo $row['description']; ?></textarea>

<p>Current Image</p>

<img
src="../uploads/<?php echo $row['image']; ?>"
width="250">

<br><br>

<input
type="file"
name="image">

<br><br>

<button type="submit">

Update Room

</button>

</form>

</section>

<?php
include "../includes/footer.php";
?>