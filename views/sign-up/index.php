<?php
// Get root directory by removing the last directory from the path
$rootDirectory = dirname(dirname(__DIR__));

// Include the config.php file
require_once $rootDirectory . '/includes/config/config.php';

$pageTitle = "Sign-In - PHP Starter App";
ob_start();
?>

<h2 class="text-center">Sign-Up</h2>
<div class="row justify-content-center">
    <div class="col-md-6 col-sm-12 bg-light rounded p-4">
        <form action="<?=$config['BASE_URL'] . '/controllers/sign-up/addRegistration.php' ?>" method="post" class="row g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="FullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="FullName" name="FullName" placeholder="full name" required>
                <div class="invalid-feedback">
                    Please provide your name
                </div>
            </div>
            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="text" class="form-control" id="Username" name="Username" placeholder="username" required>
                <div class="invalid-feedback">
                    Please provide your username
                </div>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com" required>
                <div class="invalid-feedback">
                    Please provide an email
                </div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="enter password" required>
                <div class="invalid-feedback">
                    Please provide a password
                </div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="RepeatPassword" name="RepeatPassword" placeholder="re-enter password" required>
                <div class="invalid-feedback">
                    Please re-type password
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="my-2">
                <p>
                    Already have an account? Login <a href="<?=$config['BASE_URL'] . '/sign-in' ?>">here</a>
                </p>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once $rootDirectory . '/views/layouts/default.php';
?>

