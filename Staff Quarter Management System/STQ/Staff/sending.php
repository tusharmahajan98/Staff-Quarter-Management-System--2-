<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['staff_id'])) {
    $staff_id = $_POST['staff_id'];
    // Perform actions, such as logging or saving the request

    // Respond with "success" if the request is handled correctly
    echo "success";
} else {
    echo "error";
}
?>
