// Function to validate the game assessment form
function validateGameForm() {
    var gameName = document.getElementById("gameName").value;
    var gameDescription = document.getElementById("gameDescription").value;
    var gameRules = document.getElementById("gameRules").value;
    var chanceSkill = document.getElementById("chanceSkill").value;
    var wagering = document.getElementById("wagering").value;

    if (gameName == "" || gameDescription == "" || gameRules == "" || chanceSkill == "" || wagering == "") {
        alert("Please fill in all the fields.");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

// Function to handle quiz submission and display results
function checkQuizAnswers() {
    var q1 = document.querySelector('input[name="q1"]:checked');
    var q2 = document.querySelector('input[name="q2"]:checked');
    var q3 = document.querySelector('input[name="q3"]:checked');
    var score = 0;

    if (q1 && q1.value === 'b') {
        score++;
    }
    if (q2 && q2.value === 'b') {
        score++;
    }
    if (q3 && q3.value === 'c') {
        score++;
    }

    var resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = "<h2>Your Score: " + score + " out of 3</h2>";
    resultsDiv.style.display = 'block';

    // Optional: You can add more detailed feedback here based on the score
}

// Add an event listener to the game form to call the validation function on submit
var gameForm = document.getElementById("game-form");
if (gameForm) {
    gameForm.addEventListener("submit", function(event) {
        if (!validateGameForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
}