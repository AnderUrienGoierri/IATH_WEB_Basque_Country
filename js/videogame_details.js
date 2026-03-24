// videogame_details.js - Rating and detail view interactions
$(document).ready(function() {

    // ========== Star Rating System ==========
    document.querySelectorAll('.rating-stars').forEach(function(container) {
        const gameId = container.dataset.gameId;
        const stars = container.querySelectorAll('.star');
        const msgEl = container.parentElement.querySelector('.rating-message');

        // Hover effects
        stars.forEach(function(star, index) {
            star.addEventListener('mouseenter', function() {
                highlightStars(stars, index + 1);
            });

            star.addEventListener('mouseleave', function() {
                // Restore to current rating
                const current = parseInt(container.dataset.currentRating) || 0;
                highlightStars(stars, current);
            });

            star.addEventListener('click', function() {
                const rating = index + 1;
                submitRating(gameId, rating, stars, container, msgEl);
            });
        });

        // Initialize with current rating
        const initial = parseInt(container.dataset.currentRating) || 0;
        highlightStars(stars, initial);
    });

    function highlightStars(stars, count) {
        stars.forEach(function(s, i) {
            if (i < count) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
    }

    function submitRating(gameId, rating, stars, container, msgEl) {
        // Disable clicks during request
        container.style.pointerEvents = 'none';

        fetch('/IATH_WEB_Basque_Country/php_helpers/api/rate_game.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ game_id: parseInt(gameId), rating: rating })
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            container.style.pointerEvents = 'auto';
            if (data.success) {
                container.dataset.currentRating = rating;
                highlightStars(stars, rating);
                showMessage(msgEl, '★ ' + rating + '/5 — Saved!', 'success');
            } else {
                showMessage(msgEl, data.error || 'Error saving rating', 'error');
            }
        })
        .catch(function(err) {
            container.style.pointerEvents = 'auto';
            showMessage(msgEl, 'Network error, try again.', 'error');
        });
    }

    function showMessage(el, text, type) {
        if (!el) return;
        el.textContent = text;
        el.className = 'rating-message ' + type;
        el.style.display = 'block';
        setTimeout(function() {
            el.style.display = 'none';
        }, 3000);
    }

});
