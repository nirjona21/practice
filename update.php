<?php
include 'database_connect.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$row = [];

if ($id) {
    $select = "SELECT * FROM user_info WHERE id='$id'";
    $data = mysqli_query($conn, $select);

    if ($data) {
        $row = mysqli_fetch_array($data);
    } else {
        // Handle database query error if necessary
        echo '<script type="text/javascript">alert("Error fetching data from database.");</script>';
    }
} else {
    // Handle case where $_GET['id'] is not set
    echo '<script type="text/javascript">alert("ID parameter is missing.");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Information</title>
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
        .form-container {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 350px;
            width: 100%;
            margin-top: 20px;
        }
        .form-container h1 {
            color: #ff6347;
            text-align: center;
            margin-bottom: 15px;
            font-size: 1.4em;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="int"] {
            padding: 7px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #ffffff;
            color: #333;
        }
        .form-container input[type="text"]::placeholder,
        .form-container input[type="email"]::placeholder,
        .form-container input[type="password"]::placeholder,
        .form-container input[type="int"]::placeholder {
            color: #ff6347;
            font-weight: bold;
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
        <h1>Update Student Information</h1>
        <form action="" method="post">
            <input type="text" name="id" placeholder="Enter id" required value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
            <input type="text" name="Student_Name" placeholder="Enter name" required value="<?php echo isset($row['Student_Name']) ? $row['Student_Name'] : ''; ?>">
            <input type="email" name="email" placeholder="Enter email" required value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
            <input type="password" name="password" placeholder="Enter password" required value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>">
            <input type="text" name="Course" placeholder="Enter Course name" required value="<?php echo isset($row['Course']) ? $row['Course'] : ''; ?>">
            <input type="text" name="marks" placeholder="Enter marks" required value="<?php echo isset($row['marks']) ? $row['marks'] : ''; ?>"><br>
            <input type="submit" name="Update" value="Update"> <br>
            <button class="view-button"><a href="view.php">View</a></button>
            <button class="logout-button"><a href="login.php">LogOut</a></button>
        </form>
    </div>
    <?php
    if (isset($_POST["Update"])) {
        $id = $_POST['id'];
        $Student_Name = $_POST['Student_Name'];
        $marks = $_POST['marks'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $Course = $_POST['Course'];

        $update_query = "UPDATE user_info SET Student_Name='$Student_Name', Course='$Course', email='$email', marks='$marks', password='$password' WHERE id='$id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo '<script type="text/javascript">alert("Data Updated Successfully");</script>';
        } else {
            echo '<script type="text/javascript">alert("Update Failed. Please Try Again.");</script>';
        }
    }
    ?>
</body>
</html>
