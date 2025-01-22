<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gameName = $_POST['gameName'] ?? '';
    $gameDescription = $_POST['gameDescription'] ?? '';
    $gameRules = $_POST['gameRules'] ?? '';
    $chanceSkill = $_POST['chanceSkill'] ?? '';
    $wagering = $_POST['wagering'] ?? '';
    
    // Add your form processing logic here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill or Chance?</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Base styles */
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

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .animate-fade-in-delayed {
            animation: fadeIn 0.6s ease-out 0.3s forwards;
            opacity: 0;
        }

        /* Layout */
        header {
            background-color: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #374151;
            padding: 1.5rem 1rem;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
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

        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            padding: 3rem 1rem;
        }

        @media (min-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Cards */
        .card {
            background-color: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(8px);
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #374151;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            color: #d1d5db;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        textarea {
            width: 100%;
            background-color: rgba(17, 24, 39, 0.5);
            border: 1px solid #374151;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            color: #f3f4f6;
            transition: all 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            width: 100%;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        button:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
        }

        /* Info cards */
        .info-card {
            background-color: rgba(17, 24, 39, 0.5);
            border-radius: 0.5rem;
            padding: 1.5rem;
            border: 1px solid #374151;
            margin-bottom: 1.5rem;
        }

        .info-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .skill-title {
            color: #a78bfa;
        }

        .chance-title {
            color: #ec4899;
        }

        .info-list {
            list-style-position: inside;
            color: #d1d5db;
        }

        .info-list li {
            margin-bottom: 0.5rem;
        }

        /* Icons */
        .icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .icon-large {
            width: 2.5rem;
            height: 2.5rem;
        }

        .icon-purple {
            color: #8b5cf6;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
        <div class="container">
            <div class="header-content">
                <i data-lucide="dice-1" class="icon-large icon-purple"></i>
                <h1 class="header-title">Skill or Chance?</h1>
            </div>
        </div>
    </header>

    <div class="container grid-container">
        <!-- Form Section -->
        <section class="animate-fade-in">
            <div class="card">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <i data-lucide="swords" class="icon icon-purple"></i>
                    <h2 style="font-size: 1.5rem; font-weight: bold;">Assess Your Game</h2>
                </div>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="gameName">Game Name</label>
                        <input type="text" id="gameName" name="gameName" required>
                    </div>

                    <div class="form-group">
                        <label for="gameDescription">Game Description</label>
                        <textarea id="gameDescription" name="gameDescription" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gameRules">Rules</label>
                        <textarea id="gameRules" name="gameRules" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="chanceSkill">Elements of Chance vs. Skill</label>
                        <textarea id="chanceSkill" name="chanceSkill" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="wagering">Presence of Wagering or Prizes</label>
                        <input type="text" id="wagering" name="wagering" required>
                    </div>

                    <button type="submit">
                        <i data-lucide="send" class="icon"></i>
                        Assess Game
                    </button>
                </form>
            </div>
        </section>

        <!-- Info Section -->
        <section class="animate-fade-in-delayed">
            <div class="card">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <i data-lucide="trophy" class="icon icon-purple"></i>
                    <h2 style="font-size: 1.5rem; font-weight: bold;">Understanding Game Classification</h2>
                </div>

                <div class="info-card">
                    <h3 class="info-title skill-title">Skill-Based Games</h3>
                    <ul class="info-list">
                        <li>Outcome primarily determined by player skill</li>
                        <li>Practice improves performance</li>
                        <li>Strategic decision-making</li>
                        <li>Consistent results for skilled players</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h3 class="info-title chance-title">Games of Chance</h3>
                    <ul class="info-list">
                        <li>Random outcomes</li>
                        <li>Luck-based results</li>
                        <li>No skill influence</li>
                        <li>Unpredictable patterns</li>
                    </ul>
                </div>

                <div style="display: flex; justify-content: center; margin-top: 2rem;">
                    <i data-lucide="book-open" class="icon-large animate-pulse" style="color: #4b5563;"></i>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>