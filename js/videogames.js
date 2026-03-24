$(document).ready(function() {
    
    // Cache the grid container
    const $grid = $('#games-grid');
    const GAMES_PER_PAGE = 20;
    let currentPage = 1;
    
    function getVisibleGames() {
        // Returns only the games that match the current filters (not hidden by filterGames)
        return $('.game-link').filter(function() {
            return $(this).data('filtered') !== false;
        });
    }

    function renderPagination(totalVisible) {
        const $pagination = $('#pagination');
        $pagination.empty();

        const totalPages = Math.ceil(totalVisible / GAMES_PER_PAGE);
        if (totalPages <= 1) return;

        // Previous button
        const $prev = $('<button class="page-btn page-prev" aria-label="Previous">&laquo;</button>');
        if (currentPage === 1) $prev.addClass('disabled').prop('disabled', true);
        $prev.on('click', function() { if (currentPage > 1) { currentPage--; applyPagination(); scrollToGrid(); } });
        $pagination.append($prev);

        // Page numbers with smart ellipsis
        const pages = buildPageNumbers(currentPage, totalPages);
        pages.forEach(function(p) {
            if (p === '...') {
                $pagination.append('<span class="page-ellipsis">&hellip;</span>');
            } else {
                const $btn = $('<button class="page-btn"></button>').text(p);
                if (p === currentPage) $btn.addClass('active');
                $btn.on('click', function() { currentPage = p; applyPagination(); scrollToGrid(); });
                $pagination.append($btn);
            }
        });

        // Next button
        const $next = $('<button class="page-btn page-next" aria-label="Next">&raquo;</button>');
        if (currentPage === totalPages) $next.addClass('disabled').prop('disabled', true);
        $next.on('click', function() { if (currentPage < totalPages) { currentPage++; applyPagination(); scrollToGrid(); } });
        $pagination.append($next);
    }

    function buildPageNumbers(current, total) {
        const pages = [];
        if (total <= 7) {
            for (let i = 1; i <= total; i++) pages.push(i);
        } else {
            pages.push(1);
            if (current > 3) pages.push('...');
            const start = Math.max(2, current - 1);
            const end = Math.min(total - 1, current + 1);
            for (let i = start; i <= end; i++) pages.push(i);
            if (current < total - 2) pages.push('...');
            pages.push(total);
        }
        return pages;
    }

    function applyPagination() {
        const $visible = getVisibleGames();
        const totalVisible = $visible.length;
        const totalPages = Math.max(1, Math.ceil(totalVisible / GAMES_PER_PAGE));

        // Clamp current page
        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        const startIdx = (currentPage - 1) * GAMES_PER_PAGE;
        const endIdx = startIdx + GAMES_PER_PAGE;

        $visible.each(function(index) {
            if (index >= startIdx && index < endIdx) {
                $(this).removeClass('page-hidden');
            } else {
                $(this).addClass('page-hidden');
            }
        });

        // Make sure filter-hidden games stay hidden
        $('.game-link').filter(function() {
            return $(this).data('filtered') === false;
        }).addClass('page-hidden');

        renderPagination(totalVisible);
    }

    function scrollToGrid() {
        $('html, body').animate({
            scrollTop: $('.catalog-header').offset().top - 100
        }, 300);
    }

    function filterGames() {
        const searchText = $('#search-input').val().toLowerCase();
        const genre = $('#genre-select').val();
        const platform = $('#device-select').val();
        const origin = $('#origin-select').val();
        const maxPrice = parseFloat($('#price-range').val()) || 1000;
        const minYear = parseInt($('#year-range').val()) || 1980;
        const showFreeOnly = $('#free-check').is(':checked');
        const showPurchases = $('#purchases-check').is(':checked');
        const maxRatio = parseFloat($('#gender-range').val()) || 12; 
        
        let visibleCount = 0;

        $('.game-link').each(function() {
            const $link = $(this);
            const name = $link.data('name').toLowerCase();
            const cardGenre = $link.data('genre');
            const cardPlatform = $link.data('platform');
            const cardOrigin = $link.data('origin');
            const price = parseFloat($link.data('price'));
            const year = parseInt($link.data('year'));
            const hasPurchases = $link.data('purchases') == 1;
            const ratio = parseFloat($link.data('ratio')) || 1;
            
            // Logic
            let matches = true;
            
            // Search
            if (searchText && !name.includes(searchText)) matches = false;
            
            // New Filters
            if (genre && cardGenre !== genre) matches = false;
            if (platform && cardPlatform !== platform) matches = false;
            if (origin && cardOrigin !== origin) matches = false;

            // Price
            if (price > maxPrice) matches = false;
            if (showFreeOnly && price > 0) matches = false;
            
            // Year
            if (year < minYear) matches = false;
            
            // Purchases
            if (showPurchases && !hasPurchases) matches = false;
            
            // Gender Ratio
            if (ratio > maxRatio) matches = false;

            // Mark filtered state on the element
            $link.data('filtered', matches);
            if (!matches) {
                $link.addClass('page-hidden');
            }

            if (matches) visibleCount++;
        });
        
        $('#results-count').text(visibleCount);

        // Reset to page 1 whenever filters change
        currentPage = 1;
        applyPagination();
    }
    
    function sortGames() {
        const sortType = $('#sort-select').val();
        const $links = $('.game-link');
        
        $links.sort(function(a, b) {
            const aData = $(a).data();
            const bData = $(b).data();
            
            if (sortType === 'name-asc') return aData.name.localeCompare(bData.name);
            if (sortType === 'name-desc') return bData.name.localeCompare(aData.name);
            
            if (sortType === 'year-desc') return bData.year - aData.year;
            if (sortType === 'year-asc') return aData.year - bData.year;
            
            if (sortType === 'price-asc') return aData.price - bData.price;
            if (sortType === 'price-desc') return bData.price - aData.price;
            
            if (sortType === 'ratio-asc') return aData.ratio - bData.ratio; // Female -> Male
            if (sortType === 'ratio-desc') return bData.ratio - aData.ratio; // Male -> Female
            
            if (sortType === 'id-asc') return aData.id - bData.id;
            if (sortType === 'id-desc') return bData.id - aData.id;
            
            return 0;
        });
        
        $links.detach().appendTo($grid);

        // Re-apply pagination after sort
        applyPagination();
    }
    

    // Event Listeners
    $('#search-input').on('input', filterGames);
    $('#genre-select, #device-select, #origin-select').on('change', filterGames);
    $('#price-range').on('input change', function() { $('#price-range-val').text($(this).val()); filterGames(); });
    $('#year-range').on('input change', function() { $('#year-range-val').text($(this).val()); filterGames(); });
    $('#gender-range').on('input change', function() { $('#gender-range-val').text($(this).val()); filterGames(); });
    
    $('#free-check, #purchases-check').on('change', filterGames);
    $('#sort-select').on('change', sortGames);
    
    // Sidebar Toggle (Mobile)
    $('.filters-title').on('click', function() {
        // Only toggle on mobile (check if the ::after element is visible or just use window width)
        if (window.innerWidth < 1024) {
            $('.filters-panel').toggleClass('active');
        }
    });

    // Initial pagination on page load
    $('.game-link').data('filtered', true);
    applyPagination();
    
});
