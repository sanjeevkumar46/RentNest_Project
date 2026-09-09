<?php

include "config/db.php";

$message_sent = false;

if(isset($_POST['fullname']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages
            (fullname, email, subject, message)
            VALUES
            ('$fullname', '$email', '$subject', '$message')";

    if(mysqli_query($conn, $sql))
    {
        $message_sent = true;
    }
}

include "includes/header.php";
include "includes/navbar.php";

?>

<section class="contact-section">

<?php if($message_sent) { ?>

    <div style="
        max-width:800px;
        margin:0 auto 25px;
        padding:15px;
        background:#dcfce7;
        color:#166534;
        border-radius:8px;
        text-align:center;
        font-weight:bold;
    ">
        ✅ Your message has been sent successfully!
    </div>

<?php } ?>

    <div class="contact-container">

        <h1>Contact Us</h1>

        <p class="contact-intro">
            Have a question, suggestion or need help with RentNest?
            We'd love to hear from you.
        </p>


        <div class="contact-grid">


            <!-- CONTACT INFORMATION -->

            <div class="contact-card">

                <h2>📞 Get in Touch</h2>

                <div class="contact-item">

                    <div class="contact-icon">📧</div>

                    <div>
                        <h3>Email</h3>
                        <p>support@rentnest.com</p>
                    </div>

                </div>


                <div class="contact-item">

                    <div class="contact-icon">📱</div>

                    <div>
                        <h3>Phone</h3>
                        <p>+91 98765 43210</p>
                    </div>

                </div>


                <div class="contact-item">

                    <div class="contact-icon">📍</div>

                    <div>
                        <h3>Address</h3>
                        <p>Rajkot, Gujarat, India</p>
                    </div>

                </div>


                <div class="contact-item">

                    <div class="contact-icon">🕐</div>

                    <div>
                        <h3>Working Hours</h3>
                        <p>Monday – Saturday</p>
                        <p>9:00 AM – 6:00 PM</p>
                    </div>

                </div>

            </div>


            <!-- CONTACT FORM -->

            <div class="contact-card">

                <h2>✉️ Send Us a Message</h2>

                <form action="contact.php" method="post">
                    <label>Full Name</label>

                    <input
                        type="text"
                        name="fullname"
                        placeholder="Enter your name"
                        required
                    >


                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >


                    <label>Subject</label>

                    <input
                        type="text"
                        name="subject"
                        placeholder="Enter subject"
                        required
                    >


                    <label>Message</label>

                    <textarea
                        name="message"
                        rows="6"
                        placeholder="Write your message..."
                        required
                    ></textarea>


                    <button type="submit">
                        Send Message
                    </button>

                </form>

            </div>

        </div>


        <!-- FAQ / HELP -->

        <div class="contact-help">

            <h2>Need Help?</h2>

            <p>
                For room-related questions, booking requests or
                account-related issues, please contact us using
                the information above.
            </p>

            <a href="rooms.php">
                <button>Browse Rooms</button>
            </a>

        </div>

    </div>

</section>

<?php
include "includes/footer.php";
?>