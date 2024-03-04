<?php
// Include the config.php file
require_once 'includes/config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP - Starter App</title>
        <?php
            // Include the header assets
            require_once 'includes/front-end/layout/header_assets.php';
        ?>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <?php
            // Include the nav
            require_once 'includes/front-end/layout/nav.php';
        ?>
        <div class="container mt-2">
            <!--content-->
            <p>
                BASE URL: <?=$config['BASE_URL']; ?>
            </p>
        </div>
			

        <?php
            // Include the footer
            require_once 'includes/front-end/layout/footer.php';
        ?>	

        <?php
            // Include the footer_assets
            require_once 'includes/front-end/layout/footer_assets.php';
        ?>
    </body>
</html>
