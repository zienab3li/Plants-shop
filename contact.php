<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);
    $want_to_sell = isset($_POST["sell"]) ? "Yes" : "No";

    // Save data into the database
    require_once "./app/dbconfig.php";
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message, want_to_sell) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $message, $want_to_sell);

    if ($stmt->execute()) {
        $successMessage = "Your message has been sent successfully!";
    } else {
        $errorMessage = "There was an error submitting your message. Please try again.";
    }
    $stmt->close();
    $conn->close();
}
?>


    <div class="container my-5">
        <h2 class="text-center mb-4">Contact Us</h2>

        <?php if (isset($successMessage)) echo "<div class='alert alert-success'>$successMessage</div>"; ?>
        <?php if (isset($errorMessage)) echo "<div class='alert alert-danger'>$errorMessage</div>"; ?>

        <form method="POST" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control" pattern="[0-9]{10,15}" placeholder="Enter your phone number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="sell" class="form-check-input" id="sellCheck">
                <label class="form-check-label" for="sellCheck">I want to sell on your website</label>
            </div>
            <button type="submit" class="btn btn-success w-100">Send Message</button>
        </form>
    </div>

    <?php require_once "./shared/footer.php"; ?>

