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

<section class="search-section">

    <h2>Add New Room</h2>

    <form action="add_room_process.php" method="POST" enctype="multipart/form-data">

        <!-- Room Title -->
        <input
            type="text"
            name="title"
            placeholder="Room Title"
            required>

        <!-- City -->
        <input
            type="text"
            name="city"
            placeholder="City"
            required>

        <!-- Area -->
        <input
            type="text"
            name="area"
            placeholder="Area"
            required>

        <!-- PIN Code -->
        <input
            type="text"
            name="pincode"
            placeholder="PIN Code"
            required>

        <!-- Rent -->
        <input
            type="number"
            name="rent"
            placeholder="Monthly Rent"
            required>

        <!-- Owner Name -->
        <input
            type="text"
            name="owner_name"
            placeholder="Owner Name"
            required>

        <!-- Owner Phone -->
        <input
            type="text"
            name="owner_phone"
            placeholder="Owner Phone"
            required>

        <!-- Owner Email -->
        <input
            type="email"
            name="owner_email"
            placeholder="Owner Email"
            required>

        <!-- Description -->
        <textarea
            name="description"
            placeholder="Room Description"
            rows="5"
            required></textarea>

        <!-- Image -->
        <input
            type="file"
            name="image"
            required>

        <button type="submit">
            Add Room
        </button>

    </form>

</section>

<?php
include "../includes/footer.php";
?>