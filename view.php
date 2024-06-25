<?php include 'database_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #333;
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            color: #0056b3;
        }

        .container {
            width: 90%; /* Smaller container size */
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px; /* Smaller padding for rows */
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px; /* Larger padding for headers */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-record {
            text-align: center;
            font-size: 1.2em;
            color: red;
            padding: 10px;
        }

        .action-button {
            display: inline-block;
            padding: 6px 10px; /* Smaller button padding */
            margin-right: 5px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #0056b3;
        }

        .action-button.delete {
            background-color: #DC3545;
        }

        .action-button.delete:hover {
            background-color: #a4262c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Page</h2>
        <a href="index.php">Home</a><br>

        <?php if (isset($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>

        <a class="action-button" href="generate_pdf.php">Generate PDF</a>

        <table> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Marks</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM user_info";
                $data = mysqli_query($conn, $query);
                $result = mysqli_num_rows($data);
                if ($result > 0) {
                    while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["Student_Name"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["Course"]; ?></td>
                            <td><?php echo $row["marks"]; ?></td>
                            <td><a class="action-button" href="update.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
                            <td><a class="action-button delete" href="delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="no-record">No records found.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
