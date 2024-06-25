<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculator-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        form {
            display: grid;
            gap: 10px;
        }
        form label {
            font-weight: bold;
        }
        form input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-group {
            display: grid;
            gap: 10px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .placeholder-input {
            position: relative;
        }
        .placeholder-input input[type="number"] {
            padding-left: 20px;
        }
        .placeholder-input::before {
            content: attr(placeholder);
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="calculator-container">
        <h1>CGPA Calculator</h1>
        <form id="cgpaForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <div class="placeholder-input">
                    <input type="number" id="totalPoint" name="totalPoint" placeholder="Enter total grade points" required>
                </div>
            </div>
            <div class="form-group">
                <div class="placeholder-input">
                    <input type="number" id="totalCredit" name="totalCredit" placeholder="Enter total credit hours" required>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" name="calculate">Calculate CGPA</button>
                <button type="reset">Reset</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calculate'])) {
            // Retrieve values from POST data
            $totalPoint = isset($_POST['totalPoint']) ? $_POST['totalPoint'] : 0;
            $totalCredit = isset($_POST['totalCredit']) ? $_POST['totalCredit'] : 0;

            // Calculate CGPA
            if ($totalCredit != 0) {
                $cgpa = $totalPoint / $totalCredit;
                echo '<h2 style="text-align: center;">Calculated CGPA: ' . number_format($cgpa, 2) . '</h2>';
            } else {
                echo '<h2 style="text-align: center; color: red;">Error: Total credit hours cannot be zero!</h2>';
            }
        }
        ?>
    </div>
</body>
</html>
