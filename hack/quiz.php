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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill or Chance? - Knowledge Quiz</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #111827, #1f2937, #111827);
            color: #f3f4f6;
            line-height: 1.5;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Header */
        header {
            background-color: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #374151;
            padding: 1.5rem 1rem;
            margin-bottom: 2rem;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .header-title {
            font-size: 2.25rem;
            font-weight: bold;
            background: linear-gradient(to right, #a78bfa, #ec4899);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Quiz Card */
        .quiz-card {
            background-color: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #374151;
        }

        .quiz-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .quiz-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f3f4f6;
        }

        /* Questions */
        .question {
            background-color: rgba(17, 24, 39, 0.5);
            border: 1px solid #374151;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            animation: slideIn 0.5s ease-out forwards;
        }

        .question p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: #e5e7eb;
        }

        /* Radio buttons */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
            background-color: rgba(31, 41, 55, 0.5);
            border: 1px solid #374151;
            cursor: pointer;
            transition: all 0.2s;
        }

        .radio-option:hover {
            background-color: rgba(55, 65, 81, 0.5);
            border-color: #6b7280;
        }

        .radio-option input[type="radio"] {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #6b7280;
            border-radius: 50%;
            margin: 0;
            transition: all 0.2s;
        }

        .radio-option input[type="radio"]:checked {
            border-color: #8b5cf6;
            background-color: #8b5cf6;
            box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
        }

        .radio-option label {
            flex: 1;
            cursor: pointer;
            color: #e5e7eb;
        }

        /* Submit button */
        .submit-btn {
            width: 100%;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s;
            margin-top: 2rem;
        }

        .submit-btn:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
            transform: translateY(-1px);
        }

        /* Results section */
        #results {
            margin-top: 2rem;
            padding: 1.5rem;
            border-radius: 0.75rem;
            background-color: rgba(17, 24, 39, 0.5);
            border: 1px solid #374151;
            display: none;
        }

        #results.show {
            display: block;
            animation: fadeIn 0.6s ease-out;
        }

        /* Icons */
        .icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .icon-large {
            width: 2rem;
            height: 2rem;
            color: #8b5cf6;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #111827;
        }

        ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 9999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <i data-lucide="brain" class="icon-large"></i>
            <h1 class="header-title">Knowledge Quiz</h1>
        </div>
    </header>

    <div class="container">
        <div class="quiz-card animate-fade-in">
            <div class="quiz-header">
                <i data-lucide="help-circle" class="icon-large"></i>
                <h2 class="quiz-title">Test Your Understanding</h2>
            </div>

            <form id="quiz-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="question">
                    <p>1. What is the primary factor that distinguishes a skill-based game from gambling?</p>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="q1a" name="q1" value="a" required>
                            <label for="q1a">The amount of money involved</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="q1b" name="q1" value="b">
                            <label for="q1b">The level of skill and strategy required</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="q1c" name="q1" value="c">
                            <label for="q1c">Whether the game is played online or offline</label>
                        </div>
                    </div>
                </div>

                <div class="question">
                    <p>2. Which of the following is an example of a skill-based game in India?</p>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="q2a" name="q2" value="a" required>
                            <label for="q2a">Roulette</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="q2b" name="q2" value="b">
                            <label for="q2b">Fantasy sports</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="q2c" name="q2" value="c">
                            <label for="q2c">Slot machines</label>
                        </div>
                    </div>
                </div>

                <div class="question">
                    <p>3. What is the legal status of online poker in India?</p>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="q3a" name="q3" value="a" required>
                            <label for="q3a">Completely illegal</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="q3b" name="q3" value="b">
                            <label for="q3b">Legal and regulated throughout the country</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="q3c" name="q3" value="c">
                            <label for="q3c">Legal in some states, but the legal framework is complex</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i data-lucide="check-circle" class="icon"></i>
                    Submit Answers
                </button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $q1Answer = $_POST["q1"] ?? '';
                $q2Answer = $_POST["q2"] ?? '';
                $q3Answer = $_POST["q3"] ?? '';

                // Calculate score (correct answers: 1b, 2b, 3c)
                $score = 0;
                if ($q1Answer === 'b') $score++;
                if ($q2Answer === 'b') $score++;
                if ($q3Answer === 'c') $score++;

                // Store result in database
                $sql = "INSERT INTO quiz_results (score, timestamp) VALUES ($score, NOW())";
                $conn->query($sql);

                echo '<div id="results" class="show">
                        <h3 style="color: #a78bfa; margin-bottom: 1rem;">Quiz Results</h3>
                        <p>You scored ' . $score . ' out of 3 questions correctly!</p>
                      </div>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Smooth show/hide for results
        document.addEventListener('DOMContentLoaded', function() {
            const results = document.getElementById('results');
            if (results && results.innerHTML.trim() !== '') {
                results.classList.add('show');
            }
        });
    </script>
</body>
</html>