<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        echo "<div class='alert alert-danger'>All fields are required!</div>";
    } else {
        try {
            $mail = new PHPMailer(true);
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server (use your email provider's SMTP)
            $mail->SMTPAuth = true;
            $mail->Username = 'rohanrohan1401@gmail.com'; // Your email
            $mail->Password = 'ymso rykg xstz napi'; // Your email password

            // Correctly quote 'ssl' as a string
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465; // Port for SSL

            // Sender and recipient settings
            $mail->setFrom('rohanrohan1401@gmail.com', 'Student Stack Admin');
            $mail->addAddress('rohanrohan1401@gmail.com'); // Admin email
            $mail->addReplyTo($email, $name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message";

            $mail->send();
            echo "<div class='alert alert-success'>Message sent successfully!</div>";
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .contact-form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
        }
        .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="contact-form-container">
                <h1 class="text-center mb-4">Contact Admin</h1>
                <?php if (!empty($message_status)) echo $message_status; ?>
                <form action="contact.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Type your message here" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

