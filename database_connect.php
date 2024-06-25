<?php
$hostname = "localhost";
$username = "root";
$password = '';
$dbname = "a_office";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    echo '<p>Connected successfully</p>';
    ?>
</body>
</html>
<?php

?>
