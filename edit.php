<?php
include 'config/database.php';

$message = "";
$booking_data = null;

// Get booking ID from URL
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    
    // Fetch existing booking data
    $sql = "SELECT * FROM bookings WHERE id = $booking_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $booking_data = $result->fetch_assoc();
    } else {
        $message = "<div class='error-message'>Booking not found!</div>";
    }
}

// Handle form submission
if ($_POST) {
    $booking_id = $_POST['booking_id'];
    $room_id = $_POST['room_id'];
    $employee_name = $_POST['employee_name'];
    $booking_date = $_POST['booking_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $purpose = $_POST['purpose'];
    
    $sql = "UPDATE bookings 
            SET room_id='$room_id', employee_name='$employee_name', 
                booking_date='$booking_date', start_time='$start_time', 
                end_time='$end_time', purpose='$purpose' 
            WHERE id=$booking_id";
            
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success-message'>Booking updated successfully!</div>";
        
        // Refresh booking data
        $sql = "SELECT * FROM bookings WHERE id = $booking_id";
        $result = $conn->query($sql);
        $booking_data = $result->fetch_assoc();
    } else {
        $message = "<div class='error-message'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking - Meeting Room Booking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Room Booking</h1>
        
        <div class="nav-links">
            <a href="index.php">View All Bookings</a>
            <a href="create.php">Book a Room</a>
        </div>

        <?php echo $message; ?>

        <?php if ($booking_data): ?>
        <form method="POST" action="edit.php">
            <input type="hidden" name="booking_id" value="<?php echo $booking_data['id']; ?>">
            
            <div class="form-group">
                <label for="room_id">Select Room:</label>
                <select name="room_id" id="room_id" required>
                    <?php
                    $sql = "SELECT id, room_name, capacity FROM rooms";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $selected = ($row["id"] == $booking_data['room_id']) ? "selected" : "";
                            echo "<option value='" . $row["id"] . "' $selected>" . $row["room_name"] . " (Capacity: " . $row["capacity"] . ")</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="employee_name">Employee Name:</label>
                <input type="text" name="employee_name" id="employee_name" 
                       value="<?php echo $booking_data['employee_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="booking_date">Booking Date:</label>
                <input type="date" name="booking_date" id="booking_date" 
                       value="<?php echo $booking_data['booking_date']; ?>" required>
            </div>

            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" name="start_time" id="start_time" 
                       value="<?php echo $booking_data['start_time']; ?>" required>
            </div>

            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" name="end_time" id="end_time" 
                       value="<?php echo $booking_data['end_time']; ?>" required>
            </div>

            <div class="form-group">
                <label for="purpose">Purpose:</label>
                <textarea name="purpose" id="purpose" rows="3" required><?php echo $booking_data['purpose']; ?></textarea>
            </div>

            <button type="submit">Update Booking</button>
        </form>
        <?php else: ?>
            <p>No booking data found. <a href="index.php">Go back to bookings</a></p>
        <?php endif; ?>
    </div>

<?php $conn->close(); ?>
</body>
</html>