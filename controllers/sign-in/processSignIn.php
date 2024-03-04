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

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    //Form validation
    // Get user input
    $email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $_SESSION['emailValue'] = $email;

    $password = isset($_POST['Password']) ? $_POST['Password'] : '';

    // Validate user input (you may want to add more validation)
    $formIsValid = true;
    if (empty($email)) {
        // Redirect back to sign-in with an error message
        $_SESSION['emailError'] = "Email field is required";
    }

    if (empty($password)) {
        // Redirect back to sign-in with an error message
        $_SESSION['passwordError'] = "PInvalid credentials";
    }

    if(!$formIsValid){
        $_SESSION['formError'] = "Missing required field.";
        header("Location: {$config['BASE_URL']}/sign-in");
        exit();
    }

    // Sanitize user input to prevent SQL injection
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    // Query to retrieve user with the given email and password
    $query = "SELECT * FROM users WHERE email = :email AND status = 1";

    // Prepare the statement
    $stmt = $pdo->prepare($query);

    // Bind parameters
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
            $passwordHash = $user['password'];

            if (password_verify($password, $passwordHash)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['status'] = $user['status'];

                // Sign-in successful, redirect to account/dashboard
                header("Location: {$config['BASE_URL']}/account/dashboard");
                exit();
            } else {
                // Sign-in failed, redirect back to sign-in with an error message
                $_SESSION['formError'] = "Invalid credentials";
                header("Location: {$config['BASE_URL']}/sign-in");
                exit();
            }
    } else {

        // Sign-in failed, redirect back to sign-in with an error message
        $_SESSION['formError'] = "Invalid credentials";
        header("Location: {$config['BASE_URL']}/sign-in");
        exit();
    }
}
else{
    // Redirect to sign-up if accessed with an invalid method
    $_SESSION['formError'] = "There was an error with your request";
    header("Location: {$config['BASE_URL']}/sign-in");
    exit();
}