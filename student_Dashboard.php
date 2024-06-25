<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            background-color: #87CEEB;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .dashboard-container {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 350px;
            width: 100%;
            text-align: center;
        }
        .dashboard-container h1 {
            color: #ff6347;
            margin-bottom: 20px;
            font-size: 1.4em;
        }
        .dashboard-container button {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-bottom: 15px;
            width: 100%;
        }
        .dashboard-container button:hover {
            background-color: #007bb5;
        }
        .dashboard-container .back-button {
            background-color: #4CAF50; /* Green background color */
        }
        .dashboard-container .back-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Student Dashboard</h1>
        <button onclick="location.href='result.php'">View Result </button>
     
        <button class="back-button" onclick="location.href='login.php'">Back</button>
    </div>
</body>
</html>
