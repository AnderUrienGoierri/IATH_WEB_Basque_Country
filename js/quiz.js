// quiz.js — Multi-step quiz logic
document.addEventListener('DOMContentLoaded', function() {

    const steps = document.querySelectorAll('.quiz-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const btnNext = document.getElementById('btn-next');
    const btnBack = document.getElementById('btn-back');
    const errorEl = document.getElementById('quiz-error');
    const quizForm = document.getElementById('quiz-form');
    const loadingEl = document.getElementById('quiz-loading');

    let current = 0;
    const selections = {
        device: null,
        time: null,
        mood: null
    };

    // Initialize option cards click handlers
    document.querySelectorAll('.option-card').forEach(function(card) {
        card.addEventListener('click', function() {
            const step = card.closest('.quiz-step');
            const field = step.dataset.field;

            // Deselect siblings
            step.querySelectorAll('.option-card').forEach(function(c) {
                c.classList.remove('selected');
            });

            // Select this one
            card.classList.add('selected');
            selections[field] = card.dataset.value;

            // Hide error
            errorEl.style.display = 'none';

            // Enable next button
            btnNext.disabled = false;
        });
    });

    // Show a specific step
    function showStep(index) {
        steps.forEach(function(s, i) {
            s.classList.toggle('active', i === index);
        });

        // Update progress bar
        progressSteps.forEach(function(p, i) {
            p.classList.remove('active', 'done');
            if (i < index) {
                p.classList.add('done');
            } else if (i === index) {
                p.classList.add('active');
            }
        });

        // Show/hide back button
        btnBack.style.display = index === 0 ? 'none' : 'block';

        // Update next button text
        if (index === steps.length - 1) {
            btnNext.textContent = btnNext.dataset.submitText;
        } else {
            btnNext.textContent = btnNext.dataset.nextText;
        }

        // Check if this step already has a selection
        var field = steps[index].dataset.field;
        var hasSelection = selections[field] !== null;
        btnNext.disabled = !hasSelection;
    }

    // Next button
    btnNext.addEventListener('click', function() {
        var field = steps[current].dataset.field;

        if (!selections[field]) {
            errorEl.textContent = errorEl.dataset.selectMsg;
            errorEl.style.display = 'block';
            return;
        }

        if (current < steps.length - 1) {
            current++;
            showStep(current);
        } else {
            // Submit the quiz
            submitQuiz();
        }
    });

    // Back button
    btnBack.addEventListener('click', function() {
        if (current > 0) {
            current--;
            showStep(current);
        }
    });

    function submitQuiz() {
        // Show loading
        document.querySelector('.quiz-container').style.display = 'none';
        loadingEl.classList.add('active');

        // Set hidden inputs
        document.getElementById('input-device').value = selections.device;
        document.getElementById('input-time').value = selections.time;
        document.getElementById('input-mood').value = selections.mood;

        // Submit the form
        quizForm.submit();
    }

    // Initialize
    showStep(0);
});
