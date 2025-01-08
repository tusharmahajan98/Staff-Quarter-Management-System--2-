<?php
// Retrieve form data
$S_id = $_POST['S_id'];
$Name = $_POST['Name'];
$Address = $_POST['Address'];
$Email = $_POST['Email'];
$Password = $_POST['Password']; // New Password field
$Department = $_POST['Department'];
$Post = $_POST['Post'];
$Room_Number = $_POST['Room_Number'];
$Floor_Number = $_POST['Floor_Number'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'STQ');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Use prepared statements for security
    $stmt = $conn->prepare("INSERT INTO staff (S_id, Name, Address, Email, Password, Department, Post, Room_Number, Floor_Number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters to prevent SQL injection
    $stmt->bind_param("issssssis", $S_id, $Name, $Address, $Email, $Password, $Department, $Post, $Room_Number, $Floor_Number);
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                alert('Record Inserted Successfully.');
                window.location.href = '../user_login.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close connections
    $stmt->close();
    $conn->close();
}
?>
