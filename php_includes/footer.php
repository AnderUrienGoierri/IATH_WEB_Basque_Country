<?php
$isSubfolder = stripos($_SERVER['PHP_SELF'], '/php_user/') !== false || 
               stripos($_SERVER['PHP_SELF'], '/php_admin/') !== false || 
               stripos($_SERVER['PHP_SELF'], '/php_generic/') !== false;
$prefix = $isSubfolder ? '../' : '';
?>
<!-- Global Footer -->
<footer class="main-footer">
    <div class="container footer-inner">
        <div class="footer-logo">
            <img src="<?php echo $prefix; ?>img/logo.png" alt="GameMatch AI Logo" class="logo-img">
        </div>
        <div class="footer-links">
            <a href="<?php echo $prefix; ?>index.php" class="nav-link"><?php echo $txt['home']; ?></a>
            <a href="<?php echo $prefix; ?>php_generic/videogames.php" class="nav-link"><?php echo $txt['videogames']; ?></a>
        </div>
        <div class="footer-copyright">
            &copy; 2026 GameMatch AI
        </div>
    </div>
</footer>
