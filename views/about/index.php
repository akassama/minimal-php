<?php
// Get root directory by removing the last directory from the path
$rootDirectory = dirname(dirname(__DIR__));

// Include the config.php file
require_once $rootDirectory . '/includes/config/config.php';

// Include the exceptionHandler.php file
require_once $rootDirectory . '/includes/exceptions/exceptionHandler.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP - Starter App</title>
        <?php
            // Include the header assets
            require_once $rootDirectory . '/includes/front-end/layout/header_assets.php';
        ?>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <?php
            // Include the nav
            require_once $rootDirectory . '/includes/front-end/layout/nav.php';
        ?>
        <div class="container mt-2">
            <h1>
                ABOUT PAGE
            </h1>
        </div>
			

        <?php
            // Include the footer
            require_once $rootDirectory . '/includes/front-end/layout/footer.php';
        ?>	

        <?php
            // Include the footer_assets
            require_once $rootDirectory . '/includes/front-end/layout/footer_assets.php';
        ?>
    </body>
</html>
