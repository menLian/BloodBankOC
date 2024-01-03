<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve records from your database table (replace 'your_table' with your actual table name)
$sql = "SELECT * FROM donate";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1em;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        .back-btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .back-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>BLOOD BANK STORAGE</h1>
    </header>

    <div class="container">
        <?php
        // Check if records are found
        if ($result->num_rows > 0) {
            // Output the table headers
            echo "<h2>All Blood Types Available</h2>";
            echo "<table border='1'>";
            echo "<tr><th>BloodType</th><th>Time of Donation</th><th>Date of donation</th></tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["bloodgroup"] . "</td><td>" . $row["timedonate"] . "</td><td>" . $row["datedonate"] . "</td></tr>";
                // Add more columns as needed
            }

            echo "</table>";

            // Add a cool-looking button to redirect back to the dashboard
            echo "<div class='back-btn-container'>";
            echo "<a href='dashboard.html' class='back-btn'>Back to Dashboard</a>";
            echo "</div>";
        } else {
            echo "<p>No records found</p>";
        }
        ?>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>
