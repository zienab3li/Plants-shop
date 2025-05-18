<?php
require_once "./app/dbconfig.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $verificationToken = bin2hex(random_bytes(32)); // Now 64 characters


    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $errorMessage = "Email already exists! Try logging in.";
    } else {
        $sql = $conn->prepare("INSERT INTO users (name, email, password, verification_token) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $name, $email, $password, $verificationToken);

        if($sql->execute()){
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'zynaba785.com@gmail.com'; // Replace with your Gmail
                $mail->Password = 'xkku xerl ycrs guhh'; // Replace with App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('zynaba785.com@gmail.com', 'Plant Shop'); 
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Verify Your Email';
                $mail->Body = "Click the link below to verify your email:<br>
                               <a href='http://192.168.1.14/Plants-shop/verify.php?token=$verificationToken'>Verify Email</a>";

                $mail->send();
                $successMessage = "Registration successful! Check your email for verification.";
            } catch (Exception $e) {
                $errorMessage = "Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="width: 400px;">
            <h3 class="text-center">Register</h3>

            <?php if(isset($successMessage)) echo "<div class='alert alert-success'>$successMessage</div>"; ?>
            <?php if(isset($errorMessage)) echo "<div class='alert alert-danger'>$errorMessage</div>"; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="register" class="btn btn-success w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
