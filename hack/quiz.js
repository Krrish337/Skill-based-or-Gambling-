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

    // Provide feedback based on score
    if (score === 3) {
        resultsDiv.innerHTML += "<p>Excellent! You have a good understanding of skill-based games and gambling in India.</p>";
    } else if (score === 2) {
        resultsDiv.innerHTML += "<p>Good job! You're getting there. Review some concepts to improve your knowledge.</p>";
    } else {
        resultsDiv.innerHTML += "<p>It seems you need to brush up on your knowledge. Take another look at the information and try again.</p>";
    }

    resultsDiv.style.display = 'block';
}

// Add an event listener to the quiz form to call the function on submit
var quizForm = document.getElementById("quiz-form");
if (quizForm) {
    quizForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        checkQuizAnswers();
    });
}