<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="https://siom.sinhgad.edu/wp-content/uploads/2022/05/cropped-cropped-cropped-cropped-main-logo-1.png">
    <title>Login page</title>
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
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for buttons */
        button:hover {
            background-color: #90EE90; /* Light green */
        }

        .back-btn {
            position: absolute;
            background-color: red;
            bottom: 10px;
            right: 10px;
            width: 15%;
            height: 30px;
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <center>
        <div class="loginbtn">
            <div class="div2">
                <h1 style="color: white;">USER LOGIN</h1>
                <form action="user_login process.php" method="POST">
                    <input type="text" style="width: 50%; height:30px" id="user" name="username" placeholder="username" /><br><br>
                    <input type="Password" style="width: 50%; height:30px" id="pass" name="password" placeholder="password" /><br><br>
                    <button type="submit" style="width: 15%; height:30px" id="btn" name="login">Login</button>
                </form>
            </div>
            <button type="button" class="back-btn" onclick="window.location.href='index.php'">Back</button>
        </div>
        <h1 style="color: blue;">As A User</h1>
        <button type="submit" style="width: 15%; height:30px" id="btn" name="login">
            <a href="../STQ/Staff/signup.html">Signup</a>
        </button>
    </center>
</body>

</html>
