-- Create database
CREATE DATABASE IF NOT EXISTS meeting_booking;
USE meeting_booking;

-- Create rooms table
CREATE TABLE rooms (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(50) NOT NULL,
    capacity INT(3) NOT NULL
);

-- Create bookings table
CREATE TABLE bookings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    room_id INT(6) UNSIGNED NOT NULL,
    employee_name VARCHAR(100) NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    purpose VARCHAR(255) NOT NULL,
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

-- Insert sample rooms
INSERT INTO rooms (room_name, capacity) VALUES 
('Conference Room A', 12),
('Conference Room B', 8),
('Meeting Room C', 6),
('Training Room', 20);

-- Insert sample bookings
INSERT INTO bookings (room_id, employee_name, booking_date, start_time, end_time, purpose) VALUES
(1, 'John Doe', '2025-09-20', '09:00:00', '10:30:00', 'Team Meeting'),
(2, 'Jane Smith', '2025-09-20', '11:00:00', '12:00:00', 'Client Presentation'),
(3, 'Mike Johnson', '2025-09-21', '14:00:00', '15:00:00', 'Project Discussion');