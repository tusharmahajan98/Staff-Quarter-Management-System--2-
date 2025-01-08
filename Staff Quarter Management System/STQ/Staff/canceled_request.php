<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffId = $_POST['s_id'];
    $status = $_POST['status'];

    // Start a transaction to ensure both updates happen together
    mysqli_begin_transaction($conn);

    try {
        // Update the status in the staff_requests table
        $updateRequestSql = "UPDATE staff_requests SET status = ? WHERE S_ID = ?";
        $stmt1 = $conn->prepare($updateRequestSql);
        $stmt1->bind_param("si", $status, $staffId);
        if (!$stmt1->execute()) {
            throw new Exception("Error updating request status: " . $conn->error);
        }

        // Update the notification column in the staff table
        $notificationMessage = "Your request has been canceled.";
        $updateStaffSql = "UPDATE staff SET notification = ? WHERE S_ID = ?";
        $stmt2 = $conn->prepare($updateStaffSql);
        $stmt2->bind_param("si", $notificationMessage, $staffId);
        if (!$stmt2->execute()) {
            throw new Exception("Error updating staff notification: " . $conn->error);
        }

        // Commit the transaction if both updates are successful
        mysqli_commit($conn);
        echo "Request approved and notification sent successfully!";
    } catch (Exception $e) {
        // Rollback the transaction if there was an error
        mysqli_rollback($conn);
        echo $e->getMessage();
    } finally {
        // Close statement and connection
        $stmt1->close();
        $stmt2->close();
        mysqli_close($conn);
    }
}
?>
