<?php
include 'config/database.php';

$message = "";

if ($_POST) {
    $room_id = $_POST['room_id'];
    $employee_name = $_POST['employee_name'];
    $booking_date = $_POST['booking_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $purpose = $_POST['purpose'];
    
    
    $stmt = $conn->prepare("INSERT INTO bookings (room_id, employee_name, booking_date, start_time, end_time, purpose) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $room_id, $employee_name, $booking_date, $start_time, $end_time, $purpose);
    
    if ($stmt->execute()) {
        $message = "<div class='success-message'>New booking created successfully!</div>";
    } else {
        $message = "<div class='error-message'>Error: " . $conn->error . "</div>";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room - Meeting Room Booking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Book a Meeting Room</h1>
        
        <div class="nav-links">
            <a href="index.php">View All Bookings</a>
            <a href="create.php">Book a Room</a>
        </div>

        <?php echo $message; ?>

        <form method="POST" action="create.php">
            <div class="form-group">
                <label for="room_id">Select Room:</label>
                <select name="room_id" id="room_id" required>
                    <option value="">Choose a room...</option>
                    <?php
                    $sql = "SELECT id, room_name, capacity FROM rooms";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["room_name"] . " (Capacity: " . $row["capacity"] . ")</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="employee_name">Employee Name:</label>
                <input type="text" name="employee_name" id="employee_name" required>
            </div>

            <div class="form-group">
                <label for="booking_date">Booking Date:</label>
                <input type="date" name="booking_date" id="booking_date" required>
            </div>

            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" name="start_time" id="start_time" required>
            </div>

            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" name="end_time" id="end_time" required>
            </div>

            <div class="form-group">
                <label for="purpose">Purpose:</label>
                <textarea name="purpose" id="purpose" rows="3" required></textarea>
            </div>

            <button type="submit">Book Room</button>
        </form>
    </div>

<?php $conn->close(); ?>
</body>
</html>