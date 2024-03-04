<?php
// Get root directory by removing the last directory from the path
$rootDirectory = dirname(dirname(__DIR__));

$pageTitle = "Home";
ob_start();
?>

<h1>
    HOME PAGE
</h1>

<?php
$content = ob_get_clean();
require_once $rootDirectory . '/views/layouts/default.php';
?>