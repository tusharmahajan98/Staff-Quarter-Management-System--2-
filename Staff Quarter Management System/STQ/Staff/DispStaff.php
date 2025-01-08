<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="https://siom.sinhgad.edu/wp-content/uploads/2022/05/cropped-cropped-cropped-cropped-main-logo-1.png">
    <title>Staff Request Received</title>
    <style>
        body {
            background-image: url('../images/g1.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            margin-top: 50px;
        }
        h2 {
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .approve-btn, .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .approve-btn {
            background-color: green;
            color: white;
        }
        .cancel-btn {
            background-color: red;
            color: white;
        }
        /* Darker color for approved and canceled */
        .approved {
            background-color: darkgreen !important;
        }
        .canceled {
            background-color: darkred !important;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            margin-top: 60px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Staff Request Received</h2>

        <?php
        include 'connection.php';


        // Assuming data processing here
        // Insert data if posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $staffId = $_POST['staff_id'] ?? null;
            $name = $_POST['name'] ?? null;
            $address = $_POST['address'] ?? null;
            $email = $_POST['email'] ?? null;
            $department = $_POST['department'] ?? null;
            $post = $_POST['post'] ?? null;
            $roomNumber = $_POST['room_number'] ?? null;
            $floorNumber = $_POST['floor_number'] ?? null;

            if ($staffId) {
                $sql = "INSERT INTO Staff_Requests (S_ID, Name, Address, Email, Department, Post, Room_Number, Floor_Number)
                        VALUES ('$staffId', '$name', '$address', '$email', '$department', '$post', '$roomNumber', '$floorNumber')";
                if (mysqli_query($conn, $sql)) {
                    echo "<p>Data inserted successfully!</p>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p>Error: Staff ID is required.</p>";
            }
        }

        // Display data from database
        $result = mysqli_query($conn, "SELECT * FROM Staff_Requests");

        // Send data to LogRequest.php
        include 'sending_request.php';


        // Prepare cURL request to LogRequest.php
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "sending_request.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST); // Send the same POST data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        ?>
        <table>
            <tr>
                <th>Staff ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Department</th>
                <th>Post</th>
                <th>Room Number</th>
                <th>Floor Number</th>
                <th>Request</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['status'];
                    echo "<tr>";
                    echo "<td>{$row['S_ID']}</td>";
                    echo "<td>{$row['Name']}</td>";
                    echo "<td>{$row['Address']}</td>";
                    echo "<td>{$row['Email']}</td>";
                    echo "<td>{$row['Department']}</td>";
                    echo "<td>{$row['Post']}</td>";
                    echo "<td>{$row['Room_Number']}</td>";
                    echo "<td>{$row['Floor_Number']}</td>";
                    echo "<td>";

                    if ($status === 'Approved') {
                        echo "<button class='approve-btn approved' disabled>Approved</button>";
                        echo "<button class='cancel-btn' disabled>Cancel</button>";
                    } elseif ($status === 'Canceled') {
                        echo "<button class='approve-btn' disabled>Approve</button>";
                        echo "<button class='cancel-btn canceled' disabled>Canceled</button>";
                    } else {
                        echo "<button class='approve-btn' onclick='approveAction(this, {$row['S_ID']})'>Approve</button>";
                        echo "<button class='cancel-btn' onclick='cancelAction(this, {$row['S_ID']})'>Cancel</button>";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No data available</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </table>


        <center>
            <button class="button"><a href="index.html" style="text-decoration: none; color: white;">Search</a></button>
            <button class="button"><a href="../dashboard/home.php" style="text-decoration: none; color: white;">Home Page</a></button>
        </center>
    </div>

    <script>
        function approveAction(button, staffId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "approved_request.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("s_id=" + staffId + "&status=Approved");

            // Change button style and text upon approval
            button.classList.add("approved");
            button.textContent = "Approved";
            button.disabled = true;

            // Disable cancel button for the same row
            button.nextElementSibling.disabled = true;
            alert("Request approved for Staff ID: " + staffId);
        }

        function cancelAction(button, staffId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "canceled_request.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("s_id=" + staffId + "&status=Canceled");

            // Change button style and text upon cancellation
            button.classList.add("canceled");
            button.textContent = "Canceled";
            button.disabled = true;

            // Disable approve button for the same row
            button.previousElementSibling.disabled = true;
            alert("Request canceled for Staff ID: " + staffId);
        }
    </script>
</body>
</html>
