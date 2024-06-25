<?php 
// Include the database connection file
include 'database_connect.php'; 

// Check if 'id' is set in the URL and is not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL delete statement
    $query = "DELETE FROM user_info WHERE id = ?";
    
    // Initialize the prepared statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameter to the statement
        $stmt->bind_param("s", $id);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Data Deleted Successfully");
                  </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("Please try again");
                  </script>';
        }

        // Close the statement
        $stmt->close();
    } else {
        echo '<script type="text/javascript">
                alert("Failed to prepare the statement");
              </script>';
    }
} else {
    echo '<script type="text/javascript">
            alert("Invalid ID");
          </script>';
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Data deletion operation completed.</p>
        <button class="back-button" onclick="window.location.href='view.php'">Back</button>
    </div>
</body>
</html>
