<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - RentNest</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header>

    <h1>RentNest</h1>

    <nav>

        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>

    </nav>

</header>

<div class="container">

    <h2>Create Account</h2>

    <form action="register_process.php" method="POST">

        <!-- Full Name -->
        <label>Full Name</label>

        <input
            type="text"
            name="fullname"
            required>

        <br><br>

        <!-- Email -->
        <label>Email</label>

        <input
            type="email"
            name="email"
            required>

        <br><br>

        <!-- Phone -->
        <label>Phone</label>

        <input
            type="text"
            name="phone"
            required>

        <br><br>

        <!-- Password -->
        <label>Password</label>

        <input
            type="password"
            name="password"
            required>

        <br><br>

        <!-- Confirm Password -->
        <label>Confirm Password</label>

        <input
            type="password"
            name="confirm_password"
            required>

        <br><br>

        <!-- Role -->
        <label>Register As</label>

        <select name="role">

            <option value="user">User</option>

            <option value="owner">Room Owner</option>

        </select>

        <br><br>

        <button type="submit">

            Register

        </button>

    </form>

</div>

</body>

</html>