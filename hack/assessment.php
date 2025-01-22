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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $gameName = $_POST["gameName"];
    $gameDescription = $_POST["gameDescription"];
    $gameRules = $_POST["gameRules"];
    $chanceSkill = $_POST["chanceSkill"];
    $wagering = $_POST["wagering"];

    // --- Assessment Logic ---
    $skillScore = 0;

    // 1. Evaluate Game Description
    if (
        stripos($gameDescription, "strategy") !== false ||
        stripos($gameDescription, "skill") !== false ||
        stripos($gameDescription, "decision-making") !== false ||
        stripos($gameDescription, "tactics") !== false ||
        stripos($gameDescription, "planning") !== false ||
        stripos($gameDescription, "foresight") !== false ||
        stripos($gameDescription, "knowledge") !== false ||
        stripos($gameDescription, "expertise") !== false ||
        stripos($gameDescription, "critical thinking") !== false ||
        stripos($gameDescription, "analysis") !== false ||
        stripos($gameDescription, "judgment") !== false ||
        stripos($gameDescription, "intellect") !== false ||
        stripos($gameDescription, "reasoning") !== false ||
        stripos($gameDescription, "calculated moves") !== false ||
        stripos($gameDescription, "player agency") !== false ||
        stripos($gameDescription, "cognitive abilities") !== false 
    ) {
        $skillScore++;
    } 

    // 2. Evaluate Game Rules
    if (
        stripos($gameRules, "player choices") !== false ||
        stripos($gameRules, "tactics") !== false ||
        stripos($gameRules, "knowledge") !== false ||
        stripos($gameRules, "strategy") !== false ||
        stripos($gameRules, "decisions") !== false ||
        stripos($gameRules, "actions") !== false ||
        stripos($gameRules, "planning") !== false ||
        stripos($gameRules, "critical thinking") !== false ||
        stripos($gameRules, "problem-solving") !== false ||
        stripos($gameRules, "resource management") !== false ||
        stripos($gameRules, "optimization") !== false ||
        stripos($gameRules, "skillful execution") !== false ||
        stripos($gameRules, "techniques") !== false ||
        stripos($gameRules, "maneuvers") !== false ||
        stripos($gameRules, "complex rules") !== false || 
        stripos($gameRules, "depth of gameplay") !== false ||
        stripos($gameRules, "meaningful choices") !== false 
    ) {
        $skillScore++;
    }

    // 3. Evaluate Chance vs. Skill
    $chanceSkillRatio = 0;

    if (
        stripos($chanceSkill, "mostly skill") !== false ||
        stripos($chanceSkill, "predominantly skill") !== false ||
        stripos($chanceSkill, "skill-based") !== false ||
        stripos($chanceSkill, "skill dominant") !== false ||
        stripos($chanceSkill, "high skill") !== false ||
        stripos($chanceSkill, "greater skill") !== false ||
        stripos($chanceSkill, "skill outweighs chance") !== false 
    ) {
        $chanceSkillRatio = 0.75;
    } elseif (
        stripos($chanceSkill, "balanced") !== false ||
        stripos($chanceSkill, "equal chance and skill") !== false ||
        stripos($chanceSkill, "50/50") !== false ||
        stripos($chanceSkill, "evenly matched") !== false ||
        stripos($chanceSkill, "mix of skill and chance") !== false 
    ) {
        $chanceSkillRatio = 0.5;
    } elseif (
        stripos($chanceSkill, "mostly chance") !== false ||
        stripos($chanceSkill, "predominantly chance") !== false ||
        stripos($chanceSkill, "chance-based") !== false ||
        stripos($chanceSkill, "chance dominant") !== false ||
        stripos($chanceSkill, "high chance") !== false ||
        stripos($chanceSkill, "greater chance") !== false ||
        stripos($chanceSkill, "chance outweighs skill") !== false ||
        stripos($chanceSkill, "luck-based") !== false 
    ) {
        $chanceSkillRatio = 0.25;
    }

    $skillScore += $chanceSkillRatio;

    // 4. Evaluate Wagering/Prizes
    if (
        stripos($wagering, "no wagering") !== false ||
        stripos($wagering, "no prizes") !== false ||
        stripos($wagering, "no betting") !== false ||
        stripos($wagering, "no gambling") !== false ||
        stripos($wagering, "no monetary rewards") !== false ||
        stripos($wagering, "no real-money prizes") !== false ||
        stripos($wagering, "no cash prizes") !== false ||
        stripos($wagering, "no stakes") !== false ||
        stripos($wagering, "no entry fee") !== false ||
        stripos($wagering, "free to play") !== false ||
        stripos($wagering, "no cost to participate") !== false ||
        stripos($wagering, "only virtual rewards") !== false ||
        stripos($wagering, "in-game currency only") !== false ||
        stripos($wagering, "cosmetic rewards only") !== false 
    ) {
        $skillScore++;
    }

    // Determine the Result
    $result = ($skillScore >= 2.5) ? "Skill-based" : "Gambling";

    // Store results in the database
    $gameName = mysqli_real_escape_string($conn, $gameName);
    $gameDescription = mysqli_real_escape_string($conn, $gameDescription);
    $gameRules = mysqli_real_escape_string($conn, $gameRules);
    $chanceSkill = mysqli_real_escape_string($conn, $chanceSkill);
    $wagering = mysqli_real_escape_string($conn, $wagering);
    $result = mysqli_real_escape_string($conn, $result);

    $sql = "INSERT INTO assessment_results (game_name, game_description, game_rules, chance_skill, wagering, result) 
            VALUES ('$gameName', '$gameDescription', '$gameRules', '$chanceSkill', '$wagering', '$result')";

    $dbSuccess = $conn->query($sql) === TRUE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Results - <?php echo htmlspecialchars($gameName); ?></title>
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out forwards;
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

        /* Results Card */
        .results-card {
            background-color: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #374151;
            animation: fadeIn 0.6s ease-out forwards;
        }

        .result-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #374151;
        }

        .result-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f3f4f6;
        }

        .result-section {
            background-color: rgba(17, 24, 39, 0.5);
            border: 1px solid #374151;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            animation: slideIn 0.5s ease-out forwards;
        }

        .result-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        .badge-skill {
            background: linear-gradient(to right, #4c1d95, #7c3aed);
            border: 1px solid #6d28d9;
        }

        .badge-gambling {
            background: linear-gradient(to right, #9f1239, #e11d48);
            border: 1px solid #be123c;
        }

        .info-grid {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            background-color: rgba(31, 41, 55, 0.5);
            border: 1px solid #374151;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .info-label {
            font-size: 0.875rem;
            color: #9ca3af;
            margin-bottom: 0.25rem;
        }

        .info-value {
            color: #f3f4f6;
        }

        .legal-info {
            font-size: 0.875rem;
            color: #9ca3af;
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: rgba(31, 41, 55, 0.3);
            margin-top: 2rem;
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

        /* Back button */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            margin-top: 1.5rem;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
            transform: translateY(-1px);
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
            <i data-lucide="target" class="icon-large"></i>
            <h1 class="header-title">Assessment Results</h1>
        </div>
    </header>

    <div class="container">
        <div class="results-card">
            <div class="result-header">
                <i data-lucide="clipboard-check" class="icon-large"></i>
                <h2 class="result-title"><?php echo htmlspecialchars($gameName); ?></h2>
            </div>

            <div class="result-section">
                <div class="result-badge <?php echo $result === 'Skill-based' ? 'badge-skill' : 'badge-gambling'; ?>">
                    <i data-lucide="<?php echo $result === 'Skill-based' ? 'trophy' : 'dice-1'; ?>" class="icon"></i>
                    <span><?php echo $result; ?></span>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Game Description</div>
                        <div class="info-value"><?php echo htmlspecialchars($gameDescription); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Game Rules</div>
                        <div class="info-value"><?php echo htmlspecialchars($gameRules); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Chance vs. Skill</div>
                        <div class="info-value"><?php echo htmlspecialchars($chanceSkill); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Wagering/Prizes</div>
                        <div class="info-value"><?php echo htmlspecialchars($wagering); ?></div>
                    </div>
                </div>

                <div class="result-section">
                    <h3 style="color: #a78bfa; margin-bottom: 1rem;">Analysis</h3>
                    <?php if ($result == "Skill-based"): ?>
                    <p>Based on the information provided, this game appears to involve a significant degree of skill, strategy, or player knowledge. Factors such as the game's rules, the balance between chance and skill, and the absence of wagering or prizes contribute to this assessment.</p>
                    <?php else: ?>
                    <p>Based on the information provided, this game appears to have a strong element of chance, and may involve wagering or prizes. These factors suggest that it could be classified as gambling under Indian law.</p>
                    <?php endif; ?>
                </div>

                <div class="legal-info">
                    <h4 style="color: #a78bfa; margin-bottom: 0.5rem;">Legal Considerations</h4>
                    <p>In India, the Public Gambling Act of 1867 is the central legislation governing gambling. The distinction between games of skill and games of chance is often a matter of debate and legal interpretation. It's crucial to be aware of specific state laws and regulations, as some states have their own legislation on gaming and gambling.</p>
                    <p style="margin-top: 0.5rem;">For detailed legal advice, please consult with legal experts specializing in gaming and gambling law in India.</p>
                </div>
            </div>

            <a href="index.php" class="back-button">
                <i data-lucide="arrow-left" class="icon"></i>
                Back to Assessment
            </a>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>

<?php
} else {
    // Redirect to the assessment form if accessed directly
    header("Location: index.php");
    exit();
}

$conn->close();
?>