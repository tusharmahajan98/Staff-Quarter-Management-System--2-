<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript">
        window.history.forward();
    </script>
    <title>Login page</title>
    <link rel="shortcut icon" href="https://siom.sinhgad.edu/wp-content/uploads/2022/05/cropped-cropped-cropped-cropped-main-logo-1.png">
    <style>
        body {
            background: lightblue;
            margin-left: 30px;
        }

        .loginbtn {
            width: 50%;
            height: 300px;
            background-image: url(images/table1.jpg);
            position: relative;
        }

        .div2 {
            margin-top: 100px;
        }

        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        /* Hover effect for Login and other buttons */
        button:hover {
            background-color: #90EE90; /* Light green on hover */
        }

        /* Back Button Style */
        .backbtn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #f44336; /* Red */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        /* Hover effect for Back button */
        .backbtn:hover {
            background-color: #90EE90; /* Light green on hover */
        }

    </style>
</head>

<body>

    <center>
        <div class="loginbtn">
            <div class="div2">
                <h1 style="color: white;">ADMIN LOGIN</h1>
                <form action="login process.php" method="POST">
                    <input type="text" style="width: 50%; height:30px" id="user" name="username" placeholder="username" /><br><br>
                    <input type="password" style="width: 50%; height:30px" id="pass" name="password" placeholder="password" /><br><br>
                    <button type="submit" style="width: 15%; height:30px" id="btn" name="login">Login</button>
                </form>
            </div>
            <!-- Back button -->
            <a href="index.php"><button type="button" class="backbtn">Back</button></a>
        </div>
        <h1 style="color: blue;">As An Admin</h1>
    </center>

</body>

</html>
