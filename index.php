<?php
include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room Booking System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Meeting Room Booking System</h1>
        
        <div class="nav-links">
            <a href="index.php">View All Bookings</a>
            <a href="create.php">Book a Room</a>
        </div>

        <h2>All Room Bookings</h2>

        <?php
        $sql = "SELECT bookings.id, rooms.room_name, bookings.employee_name, 
                       bookings.booking_date, bookings.start_time, bookings.end_time, 
                       bookings.purpose 
                FROM bookings 
                JOIN rooms ON bookings.room_id = rooms.id 
                ORDER BY bookings.booking_date, bookings.start_time";
                
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Room</th>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Purpose</th>
                    <th>Actions</th>
                  </tr>";
                  
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["room_name"] . "</td>";
                echo "<td>" . $row["employee_name"] . "</td>";
                echo "<td>" . $row["booking_date"] . "</td>";
                echo "<td>" . $row["start_time"] . "</td>";
                echo "<td>" . $row["end_time"] . "</td>";
                echo "<td>" . $row["purpose"] . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                        <a href='delete.php?id=" . $row["id"] . "' class='btn-delete' 
                           onclick='return confirm(\"Are you sure you want to delete this booking?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No bookings found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>