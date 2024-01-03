<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Types available</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('blood1.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Adding a semi-transparent white background for better readability */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #fafafa;
        }

        .no-records {
            text-align: center;
            color: #888;
        }

        .return-button {
            text-align: center;
            margin-top: 20px;
        }

        .return-button a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Blood Types Available</h1>

        <?php
        $dbh = new PDO('mysql:host=localhost;dbname=Blood_bank;charset=utf8', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            // Assuming you have a form that submits the blood group as POST data
            $searchedBloodGroup = isset($_POST['bg']) ? $_POST['bg'] : '';

            if (!empty($searchedBloodGroup)) {
                $stmt = $dbh->prepare("SELECT * FROM donate WHERE bloodgroup = :bloodgroup");
                $stmt->bindParam(':bloodgroup', $searchedBloodGroup);
                $stmt->execute();

                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Check if there are any rows
                if (count($results) > 0) {
                    echo '<table>';
                    echo '<tr><th>Blood Group</th><th>Donation Date</th></tr>';
                    foreach ($results as $row) {
                        $bloodgroup = htmlentities($row['bloodgroup']);
                        $datedonate = htmlentities($row['datedonate']);
                        // Output or use the blood group and donation date data as needed
                        echo "<tr><td>$bloodgroup</td><td>$datedonate</td></tr>";
                    }
                    echo '</table>';
                } else {
                    echo '<p class="no-records">No records found for blood group: ' . $searchedBloodGroup . '</p>';
                }
            } else {
                echo '<p class="no-records">Please provide a blood group for searching.</p>';
            }
        } catch (PDOException $e) {
            echo '<p class="no-records">Error: ' . $e->getMessage() . '</p>';
        }
        ?>

        <div class="return-button">
            <a href="dashboard.html">Return to Dashboard</a>
        </div>

    </div>

</body>

</html>
