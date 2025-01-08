<!DOCTYPE html>
<html>
<head>
    <!-- (Your existing head content here) -->

    <link rel="shortcut icon" href="https://siom.sinhgad.edu/wp-content/uploads/2022/05/cropped-cropped-cropped-cropped-main-logo-1.png">
    <title>Fetch Data From Database</title>
    <style>
        body {
            background-image: url(../images/g1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .tdr { text-align: center; }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            margin-top: 60px;
            border-radius: 5px;
            font-size: 16px;
        }
        .send-btn {
            background-color: green;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .sent-btn {
            background-color: orange;
            color: black;
        }
        #delete, #update {
            padding: 5px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }
        #delete { background-color: #f44336; }
        #update { background-color: blue; }
    </style>

<script>
   
   function sendRequest(button, staffId) {
    const row = button.closest('tr');
    const name = row.cells[1].innerText;
    const address = row.cells[2].innerText;
    const email = row.cells[3].innerText;
    const department = row.cells[4].innerText;
    const post = row.cells[5].innerText;
    const roomNumber = row.cells[6].innerText;
    const floorNumber = row.cells[7].innerText;

    // Data to send
    const data = `staff_id=${staffId}&name=${encodeURIComponent(name)}&address=${encodeURIComponent(address)}&email=${encodeURIComponent(email)}&department=${encodeURIComponent(department)}&post=${encodeURIComponent(post)}&room_number=${encodeURIComponent(roomNumber)}&floor_number=${encodeURIComponent(floorNumber)}`;

    // First XMLHttpRequest to DispStaff.php
    const xhr1 = new XMLHttpRequest();
    xhr1.open("POST", "DispStaff.php", true);
    xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr1.send(data);

    // Second XMLHttpRequest to another PHP file (e.g., LogRequest.php)
    const xhr2 = new XMLHttpRequest();
    xhr2.open("POST", "sending_request.php", true);
    xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr2.send(data);

    // Update button style after the request
    xhr1.onload = xhr2.onload = function () {
        if (xhr1.status === 200 && xhr2.status === 200) {
            button.classList.add("sent-btn");
            button.classList.remove("send-btn");
            button.innerText = "Sent";
            button.disabled = true;
        }
    };
}




</script>
</head>
<body>
    <table align="center" border="1" style="width:1000px; line-height:40px; margin-top:80px">
        <tr><th colspan="11"><h2>Staff Record</h2></th></tr>
        <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Department</th>
            <th>Post</th>
            <th>Room Number</th>
            <th>Floor Number</th>
            <th>Operations</th>
            <th>Request</th>
            <th>Notification</th>
        </tr>
        <?php 
        session_start();
        include 'connection.php';
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM Staff WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['S_ID']}</td>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Address']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['Department']}</td>";
                echo "<td>{$row['Post']}</td>";
                echo "<td>{$row['Room_Number']}</td>";
                echo "<td>{$row['Floor_Number']}</td>";
                echo "<td style='text-align: center;'>";
                echo "<button id='delete'><a href='Delete.php?S_ID={$row["S_ID"]}' style='color: white; text-decoration: none;'>Delete</a></button> ";
                echo "<button id='update'><a href='update.php?S_ID={$row["S_ID"]}' style='color: white; text-decoration: none;'>Update</a></button>";
                echo "</td>";

                // Check if the request has been sent and update button appearance
                $buttonClass = $row['request_status'] == 'Sent' ? 'sent-btn' : 'send-btn';
                $buttonText = $row['request_status'] == 'Sent' ? 'Sent' : 'Send';
                $buttonDisabled = $row['request_status'] == 'Sent' ? 'disabled' : '';
                
                echo "<td><button class='{$buttonClass}' onclick='sendRequest(this, {$row['S_ID']})' {$buttonDisabled}>{$buttonText}</button></td>";
                echo "<td>{$row['notification']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Please log in to view your data.</td></tr>";
        }

        // DispStaff.php


        ?>
    </table>
    <center><button class="button"><a href="../dashboard/user_home.php" style="text-decoration: none; color: white;">Home Page</a></button></center>
</body>
</html>
