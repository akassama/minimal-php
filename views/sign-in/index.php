<?php
// Get root directory by removing the last directory from the path
$rootDirectory = dirname(dirname(__DIR__));

// Include the config.php file
require_once $rootDirectory . '/includes/config/config.php';

$pageTitle = "Sign-In - PHP Starter App";
ob_start();
?>

<h2 class="text-center">Sign-In</h2>
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-12 bg-light rounded p-4">
        <?php
        // Include exception messages
        require_once $rootDirectory . '/includes/exceptions/exceptionMessage.php';
        ?>

        <form action="<?=$config['BASE_URL'] . '/controllers/sign-in/processSignIn.php' ?>" method="post" class="row g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label><!--<input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com" required>-->
                <input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com" required
                    <?php if (isset($_SESSION['emailValue'])) : ?>
                        value="<?= isset($_SESSION['emailValue']) ? $_SESSION['emailValue'] : $_POST['Email'] ?>"
                        <?php unset($_SESSION['emailValue']); endif; ?>
                >
                <div class="text-danger">
                    <?php if (isset($_SESSION['emailError'])) : ?>
                        <?= isset($_SESSION['emailError']) ? $_SESSION['emailError'] : "Invalid email" ?>
                        <?php unset($_SESSION['emailError']); endif; ?>
                </div>
                <div class="invalid-feedback">
                    Please provide an email
                </div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="password" required>
                <div class="invalid-feedback">
                    Please provide a password
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="my-2">
                <p>
                    Don't have an account? Register <a href="<?=$config['BASE_URL'] . '/sign-up' ?>">here</a>
                </p>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once $rootDirectory . '/views/layouts/default.php';
?>

