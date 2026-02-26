$(document).ready(function() {
    
    // Cache the grid container
    const $grid = $('#games-grid');
    
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

            if (matches) {
                $link.stop(true, true).fadeIn(200);
                visibleCount++;
            } else {
                $link.stop(true, true).fadeOut(200);
            }
        });
        
        $('#results-count').text(visibleCount);
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
    }
    


    // Event Listeners
    $('#search-input').on('input', filterGames);
    $('#genre-select, #device-select, #origin-select').on('change', filterGames);
    $('#price-range').on('input change', function() { $('#price-range-val').text($(this).val()); filterGames(); });
    $('#year-range').on('input change', function() { $('#year-range-val').text($(this).val()); filterGames(); });
    $('#gender-range').on('input change', function() { $('#gender-range-val').text($(this).val()); filterGames(); });
    
    $('#free-check, #purchases-check').on('change', filterGames);
    $('#sort-select').on('change', sortGames);
    
});
