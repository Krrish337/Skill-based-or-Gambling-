<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Skill-based or Gambling? - Results</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Add your CSS styles here - you can reuse or adapt from previous files */
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            overflow: hidden;
        }

        #results-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center content */
        }

        h2 {
            color: #333; /* Example color */
        }

        p {
            margin-bottom: 15px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <section id="results-container">
        <h2>Assessment Results</h2>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $gameName = $_POST["gameName"];
            $gameDescription = $_POST["gameDescription"];
            $gameRules = $_POST["gameRules"];
            $chanceSkill = $_POST["chanceSkill"];
            $wagering = $_POST["wagering"];

            // ... (Your assessment logic here - similar to assessment.php) ...

            // Example assessment result (replace with your actual logic)
            // ... (Your assessment logic to determine $result) ...

            echo "<p><strong>Game Name:</strong> $gameName</p>";
            echo "<p><strong>Result:</strong> $result</p>";
            // ... (Display other relevant information) ...


            // ... (Optionally store results in the database) ...
            // Example database insertion (adapt to your database structure)
            
            $gameName = mysqli_real_escape_string($conn, $gameName);
            $gameDescription = mysqli_real_escape_string($conn, $gameDescription);
            $gameRules = mysqli_real_escape_string($conn, $gameRules);
            $chanceSkill = mysqli_real_escape_string($conn, $chanceSkill);
            $wagering = mysqli_real_escape_string($conn, $wagering);
            $result = mysqli_real_escape_string($conn, $result);

            $sql = "INSERT INTO assessment_results (game_name, game_description, game_rules, chance_skill, wagering, result) 
                    VALUES ('$gameName', '$gameDescription', '$gameRules', '$chanceSkill', '$wagering', '$result')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Assessment results saved successfully.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            

        } else {
            echo "<p>No assessment data received.</p>";
        }

        $conn->close(); // Close the database connection
        ?>

    </section>
</div>

</body>
</html>