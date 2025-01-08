<?php
include_once 'connection.php';

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Delete from the staff table
    $staffSql = "DELETE FROM staff WHERE S_ID = '" . $_GET["S_ID"] . "'";
    if (!mysqli_query($conn, $staffSql)) {
        throw new Exception("Error deleting from staff table: " . mysqli_error($conn));
    }

    // Delete from the staff_requests table
    $requestSql = "DELETE FROM staff_requests WHERE S_ID = '" . $_GET["S_ID"] . "'";
    if (!mysqli_query($conn, $requestSql)) {
        throw new Exception("Error deleting from staff_requests table: " . mysqli_error($conn));
    }

    // Commit the transaction if both deletes are successful
    mysqli_commit($conn);

    // Redirect to the display page
    header("Location: ../index.php");
    exit(); // Ensure no further code is executed after the redirect
} catch (Exception $e) {
    // Rollback the transaction if there was an error
    mysqli_rollback($conn);
    echo $e->getMessage();
}

// Close the connection
mysqli_close($conn);
?>
