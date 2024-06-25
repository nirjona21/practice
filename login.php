<?php include 'database_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            background-color: #ffffff; /* Changed background color to white */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container input[type="number"],
        .login-container select {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-container input[type="submit"] {
            display: none; /* Hide the original submit button */
        }
        .login-container a {
            display: block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: calc(100% - 22px);
            text-decoration: none;
            margin-top: 20px;
            box-sizing: border-box;
        }
        .login-container a:hover {
            background-color: #45a049;
        }
        .selectNew {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #title div {
            font-size: 24px;
            font-weight: bold;
            color: blue; /* Change color to blue */
        }
        .footer {
            background-color: #2E8B57; /* Change background color to match the theme */
            color: white;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
        .footer h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: white; /* Keep the text color white for contrast */
        }
    </style>
</head>
<body>
<?php
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['id']) && isset($_POST['userType'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $id = $_POST["id"];
    $userType = $_POST["userType"];

    if (!empty($username) && !empty($id) && !empty($password) && !empty($userType)) {
        $sql = "SELECT id FROM login_info WHERE id = '$id' AND username = '$username' AND password = '$password'";
        $sql_query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($sql_query);

        if ($num_rows > 0) {
            if ($userType == 'student') {
                header("Location: student_Dashboard.php");
            } else if ($userType == 'admin') {
                header("Location: index.php");
            }
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "Invalid ID, username, or password";
        }
    } else {
        echo "Fill up all fields";
    }
}
?>
   
    <div class="login-container">
        <h2>Login</h2>
        <div id="title" style="text-align: center; margin-bottom: 20px;">
            <div>SPMS</div>
        </div>

        <form id="loginForm" action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="number" name="id" placeholder="ID" required>
            <input type="password" name="password" placeholder="Password" required>
            <div>
                <select name="userType" class="selectNew" required>
                    <option disabled selected>User Type</option>
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                    <option value="faculty">Faculty</option>
                    <option value="department head">Department Head</option>
                    <option value="dean">Dean</option>
                </select>
            </div>
            <input type="submit" value="Login">
            <a href="#" onclick="document.getElementById('loginForm').submit(); return false;">Login</a>
        </form>
    </div>

<footer class="footer">
    <div>
        <h3>Student Performance Monitoring System</h3>
    </div>
</footer>

</body>
</html>
