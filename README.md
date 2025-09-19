Meeting Room Booking System

A simple database-driven web application for managing meeting room bookings in an organization. Built with PHP (OOP-MySQLi) and MySQL.

 Features
View All Bookings: Display all room reservations in a clean table format
Book a Room: Create new room reservations with employee details
Edit Bookings: Modify existing reservation details
Cancel Bookings: Delete unwanted reservations
Room Management: Pre-configured meeting rooms with capacity information

 Technologies Used
Backend: PHP with Object-Oriented MySQLi
Database: MySQL
Frontend: HTML5, CSS3
Server: XAMPP (Apache + MySQL)

📁 Project Structure

```
meeting-room-booking/
├── index.php              # Main page - view all bookings
├── create.php            # Form to book a room  
├── edit.php              # Edit existing bookings
├── delete.php            # Delete bookings
├── config/
│   └── database.php      # Database connection
├── css/
│   └── style.css         # Styling
├── sql/
│   └── database.sql      # Database setup script
└── README.md             # Project documentation
```

Installation & Setup

Prerequisites
- XAMPP installed and running
- Web browser

Steps
1. Clone the repository
   ```bash
   git clone https://github.com/YOUR_USERNAME/meeting-room-booking-system.git
   ```

2. Move to XAMPP directory
    Copy project folder to `C:\xampp\htdocs\` (Windows)
     Or `/Applications/XAMPP/htdocs/` (Mac)

3. Start XAMPP Services
    Start Apache and MySQL in XAMPP Control Panel

4. Import Database
    Open phpMyAdmin: `http://localhost/phpmyadmin`
    Click "Import" tab
    Select `sql/database.sql` file
    Click "Import"

5. Run Application
    Open browser and go to: `http://localhost/meeting-room-booking-system`

 Database Schema
Tables
rooms: Stores meeting room information (id, room_name, capacity)
bookings: Stores reservation details (id, room_id, employee_name, booking_date, start_time, end_time, purpose)

Sample Data
 4 pre-configured meeting rooms
 3 sample bookings for demonstration

 CRUD Operations
CREATE: Book new meeting rooms (`create.php`)
READ: View all bookings (`index.php`)
UPDATE: Edit existing bookings (`edit.php`)
DELETE: Cancel bookings (`delete.php`)

Security Features
Prepared statements to prevent SQL injection
Input validation and error handling
Proper database connection management

System Purpose
This system helps organizations transition from manual paper-based room booking to digital management, providing:
Elimination of double bookings
Easy tracking of room usage
Quick access to booking information
Professional booking management

 Author
Developed as part of a PHP CRUD operations practical assessment.

License
This project is for educational purposes.
