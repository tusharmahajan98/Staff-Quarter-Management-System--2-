<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $staffId = $_POST['staff_id'];
            
            // Update the request status in the database to 'Sent'
            $sql = "UPDATE Staff SET request_status = 'Sent' WHERE S_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $staffId);

            if ($stmt->execute()) {
                echo "Request status updated successfully.";
            } else {
                echo "Error updating request status.";
            }
            $stmt->close();
            $conn->close();
        }

        ?>