<?php include 'database_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            background-color: #87CEEB;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .success-message {
            color: green;
            margin-bottom: 20px;
        }
        .form-container {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            padding: 10px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 300px;
            width: 100%;
        }
        .form-container h1 {
            color: #ff6347;
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.2em;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="text"] {
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #ffffff;
            color: #333;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-container button {
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .form-container button a {
            color: white;
            text-decoration: none;
        }
        .form-container button a:hover {
            text-decoration: underline;
        }
        .form-container .view-button {
            background-color: #008CBA;
        }
        .form-container .view-button:hover {
            background-color: #007bb5;
        }
        .form-container .update-button {
            background-color: #800000;
        }
        .form-container .update-button:hover {
            background-color: #e01180;
        }
        .form-container .logout-button {
            background-color: #964B00;
        }
        .form-container .logout-button:hover {
            background-color: #7a3c00;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Submit Student Information</h1>
        <form action="" method="post">
            <input type="text" name="id" placeholder="Enter ID" required>
            <input type="text" name="Student_Name" placeholder="Enter name" required>
            <input type="email" name="email" placeholder="Enter email" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="text" name="Course" placeholder="Enter Course name" required>
            <input type="text" name="marks" placeholder="Enter marks" required><br>

            <input type="submit" name="save" value="Save"> <br>
            <button class="view-button"><a href="view.php">View</a></button>
            <button class="update-button"><a href="Update.php">Update</a></button>
            <button class="logout-button"><a href="login.php">LogOut</a></button>
        </form>
    </div>
    <?php
    if (isset($_POST["save"])) {
        $id = $_POST['id'];
        $Student_Name = $_POST['Student_Name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $Course = $_POST['Course'];
        $marks = $_POST['marks'];
        
        // Hash the password before saving it to the database
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user_info (id, Student_Name, Course, marks, email, password) VALUES ('$id', '$Student_Name', '$Course', '$marks', '$email', '$hashed_password')";

        $data = mysqli_query($conn, $query);

        if ($data) {
            echo '<script type="text/javascript">alert("Data Saved Successfully");</script>';
        } else {
            echo '<script type="text/javascript">alert("Please Try Again.");</script>';
        }
    }
    ?>
</body>
</html>
