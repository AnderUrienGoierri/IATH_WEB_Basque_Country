<?php
require_once '../php_helpers/language.php';

// Include database connection
require_once '../php_helpers/conexionDB.php';

// Fetch options for filters
$genres = $conn->query("SELECT * FROM genres ORDER BY name ASC");
$platforms = $conn->query("SELECT * FROM platforms ORDER BY name ASC");
$origins = $conn->query("SELECT DISTINCT originated FROM videoGames WHERE originated IS NOT NULL AND originated != '' ORDER BY originated ASC");

// Fetch games
$sql = "SELECT v.*, g.name AS genre_name, p.name AS platform_name 
         FROM videoGames v 
         LEFT JOIN genres g ON v.genre_id = g.id 
         LEFT JOIN platforms p ON v.platform_id = p.id 
         ORDER BY v.release_year DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt['title']; ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/videogames.js"></script>
    
    <!-- CSS -->
    <!-- Note: Vanilla CSS is used to enforce modular styling as requested. -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/videogames.css">
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

    <!-- Main Content -->
    <main class="container catalog-layout">
        
        <!-- Sidebar Filters -->
        <aside class="filters-sidebar">
            <div class="filters-panel">
                <h3 class="filters-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: var(--violet-500)"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" /></svg>
                    Filters
                </h3>
                
                <div class="filters-content">
                <!-- Search -->
                <div class="filter-group">
                    <label class="filter-label">Search</label>
                    <input type="text" id="search-input" placeholder="Minecraft, GTA..." class="filter-input">
                </div>

                <!-- Genre Filter -->
                <div class="filter-group">
                    <label class="filter-label">Genre</label>
                    <select id="genre-select" class="filter-select">
                        <option value="">All Genres</option>
                        <?php while($g = $genres->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($g['name']); ?>"><?php echo htmlspecialchars($g['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Platform Filter (Device) -->
                <div class="filter-group">
                    <label class="filter-label">Device</label>
                    <select id="device-select" class="filter-select">
                        <option value="">All Devices</option>
                        <?php while($p = $platforms->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($p['name']); ?>"><?php echo htmlspecialchars($p['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Origin Filter -->
                <div class="filter-group">
                    <label class="filter-label">Origin</label>
                    <select id="origin-select" class="filter-select">
                        <option value="">All Origins</option>
                        <?php while($o = $origins->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($o['originated']); ?>"><?php echo htmlspecialchars($o['originated']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Sort -->
                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <select id="sort-select" class="filter-select">
                        <option value="year-desc">Newest First</option>
                        <option value="year-asc">Oldest First</option>
                        <option value="name-asc">Name (A-Z)</option>
                        <option value="name-desc">Name (Z-A)</option>
                        <option value="price-asc">Price (Low-High)</option>
                        <option value="id-asc">ID (Low-High)</option>
                        <option value="id-desc">ID (High-Low)</option>
                        <option value="ratio-desc">Male-Female Audience %</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="filter-group">
                    <label class="filter-label">Max Price: $<span id="price-range-val">60</span></label>
                    <input type="range" id="price-range" min="0" max="100" value="70" class="range-slider">
                </div>

                <!-- Year Range -->
                <div class="filter-group">
                    <label class="filter-label">Min Year: <span id="year-range-val">2000</span></label>
                    <input type="range" id="year-range" min="1980" max="2026" value="2000" class="range-slider">
                </div>
                
                <!-- Gender Ratio -->
                 <div class="filter-group">
                    <label class="filter-label">Max M/F Ratio: <span id="gender-range-val">12</span></label>
                    <input type="range" id="gender-range" min="0" max="12" step="0.1" value="12" class="range-slider">
                    <div style="display: flex; justify-content: space-between; font-size: 10px; color: var(--slate-500); margin-top: 4px;">
                        <span>More Female</span>
                        <span>More Male</span>
                    </div>
                </div>

                <!-- Checkboxes -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <label class="checkbox-label">
                        <input type="checkbox" id="free-check" class="custom-checkbox">
                        <span>Free to Play Only</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" id="purchases-check" class="custom-checkbox">
                        <span>With In-App Purchases</span>
                    </label>
                </div>
                </div>
            </div>
        </aside>

        <!-- Grid Container -->
        <div class="catalog-content">
            <div class="catalog-header">
                <div>
                    <h1 class="page-title"><?php echo $txt['catalog_title']; ?></h1>
                    <p class="page-subtitle"><?php echo $txt['catalog_subtitle']; ?></p>
                </div>
                <div class="results-badge">
                    <span id="results-count" style="font-weight: 700; color: white;"><?php echo $result->num_rows; ?></span> <?php echo $txt['results']; ?>
                </div>
            </div>

            <div id="games-grid" class="games-grid">
                
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Safety check for image
                        $image = !empty($row["image"]) ? $row["image"] : 'https://placehold.co/600x900?text=No+Image';
                        if (!str_starts_with($image, 'http')) {
                            $image = '../' . $image;
                        }
                        $price = $row["actual_price"] == 0 ? $txt['free'] : "$" . number_format($row["actual_price"], 2);
                        
                        // Badge logic moved to CSS classes price-free / price-paid
                        $badgeClass = $row["actual_price"] == 0 ? "price-free" : "price-paid";
                        
                        // Data Attributes for JS
                        $dataName = htmlspecialchars($row["name"]);
                        $dataPrice = $row["actual_price"];
                        $dataYear = $row["release_year"];
                        $dataPurchases = $row["purchases_on_game"];
                        $dataRatio = $row["male_female_ratio"]; 
                ?>
                
                <a href="videogame_details.php?id=<?php echo $row['id']; ?>" class="game-link"
                   data-id="<?php echo $row['id']; ?>"
                   data-name="<?php echo $dataName; ?>"
                   data-price="<?php echo $dataPrice; ?>"
                   data-year="<?php echo $dataYear; ?>"
                   data-purchases="<?php echo $dataPurchases; ?>"
                   data-ratio="<?php echo $dataRatio; ?>"
                   data-genre="<?php echo htmlspecialchars($row['genre_name']); ?>"
                   data-platform="<?php echo htmlspecialchars($row['platform_name']); ?>"
                   data-origin="<?php echo htmlspecialchars($row['originated']); ?>"> 
                    <article class="game-card">
                         
                    <!-- Image Container -->
                    <div class="card-image-container">
                        <img src="<?php echo htmlspecialchars($image); ?>" 
                             alt="<?php echo htmlspecialchars($row["name"]); ?>" 
                             class="game-image"
                             loading="lazy">
                        <div class="image-overlay"></div>
                        <div class="price-badge <?php echo $badgeClass; ?>">
                            <?php echo $price; ?>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="card-body">
                        <div class="card-meta">
                            <span><?php echo htmlspecialchars($row["release_year"]); ?></span>
                            <?php if(!empty($row["originated"])): ?>
                                <span style="color: var(--slate-700)">•</span>
                                <span class="truncate" style="max-width: 100px;"><?php echo htmlspecialchars($row["originated"]); ?></span>
                            <?php endif; ?>
                        </div>

                        <h2 class="card-title">
                            <?php echo htmlspecialchars($row["name"]); ?>
                        </h2>
                        
                        <!-- Ratio Bar -->
                        <?php 
                            $ratio = floatval($dataRatio);
                            $pctFemale = ($ratio + 1) > 0 ? (1 / ($ratio + 1)) * 100 : 50;
                            $pctMale = 100 - $pctFemale;
                        ?>
                         <div class="ratio-bar" title="Ratio: <?php echo $dataRatio; ?> (<?php echo round($pctMale); ?>% Male / <?php echo round($pctFemale); ?>% Female)">
                            <div class="ratio-fill-male" style="width: <?php echo $pctMale; ?>%"></div>
                            <div class="ratio-fill-female" style="width: <?php echo $pctFemale; ?>%"></div>
                        </div>

                        <p class="card-desc">
                            <?php 
                                $description = !empty($row["game_description"]) ? $row["game_description"] : (!empty($row["more_data"]) ? $row["more_data"] : $txt['no_desc']);
                                echo htmlspecialchars($description); 
                            ?>
                        </p>

                        <div class="card-footer">
                             <span class="details-link">
                                 <?php echo $txt['view_details']; ?> 
                                 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                             </span>
                        </div>
                    </div>
                </article>
                </a>

                <?php
                    }
                } else {
                    echo '<div class="no-games-msg">' . $txt['no_games'] . '</div>';
                }
                $conn->close();
                ?>

            </div>
        </div>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

</body>
</html>


