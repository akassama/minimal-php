<?php
// Get root directory by removing the last directory from the path
$rootDirectory = dirname(dirname(__DIR__));

// Include the config.php file
require_once $rootDirectory . '/includes/config/config.php';

// Include the exceptionHandler.php file
require_once $rootDirectory . '/includes/exceptions/exceptionHandler.php';

// Include the db.php file
require_once $rootDirectory . '/includes/database/db.php';

// Include the dbHelpers.php file
require_once $rootDirectory . '/includes/functions/dbHelpers.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $full_name = htmlspecialchars($_POST['FullName']);
    $username = htmlspecialchars($_POST['Username']);
    $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars($_POST['Password']);
    $repeatPassword = htmlspecialchars($_POST['RepeatPassword']);
    $status = 0;

    if (!$email || empty($full_name)  || empty($username)  || empty($password) || empty($repeatPassword) || $password !== $repeatPassword) {
        // Invalid data, redirect to sign-up with an error message
        header("Location: {$config['BASE_URL']}/sign-up?error=invalid_data");
        exit();
    }

    // Securely hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Generate a unique user_id (you can use a library like UUID for this)
    $user_id = getGUID();

    // Insert user data into the database
    $stmt = $pdo->prepare("INSERT INTO users (user_id, full_name, username, email, password, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $full_name, $username, $email, $hashedPassword, $status]);

    // Redirect to sign-in if registration is successful
    header("Location: {$config['BASE_URL']}/sign-in");
    exit();
} else {
    // Redirect to sign-up if accessed with an invalid method
    header("Location: {$config['BASE_URL']}/sign-up");
    exit();
}
?>
