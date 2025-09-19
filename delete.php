<?php
include 'config/database.php';

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    
    $sql = "DELETE FROM bookings WHERE id=$booking_id";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Booking deleted successfully!";
    } else {
        $message = "Error deleting booking: " . $conn->error;
    }
} else {
    $message = "No booking ID provided!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking - Meeting Room Booking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Delete Booking</h1>
        
        <div class="nav-links">
            <a href="index.php">View All Bookings</a>
            <a href="create.php">Book a Room</a>
        </div>

        <div class="success-message">
            <p><?php echo $message; ?></p>
        </div>
        
        <p><a href="index.php">← Back to All Bookings</a></p>
    </div>
</body>
</html>