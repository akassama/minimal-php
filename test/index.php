<?php
// Get the root directory
$rootDirectory = dirname(__DIR__);

// Include the config.php file
require_once $rootDirectory . '/includes/config/config.php';

// Include the exceptionHandler.php file
require_once $rootDirectory . '/includes/exceptions/exceptionHandler.php';

// Include the db.php file
require_once $rootDirectory . '/includes/database/db.php';

// Include the dbHelpers.php file
require_once $rootDirectory . '/includes/functions/dbHelpers.php';

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
    <div class="container-fluid">
        <ul class="list-group mt-2">
            <li class="list-group-item">
                <h3>Record Exists</h3>
                <br>
                <?php
                    // Sample usage of recordExists function
                    $tableName = 'users';
                    $primaryKey = 'user_id';
                    $primaryKeyValue = '7bd18f1b-d828-11ee-8aef-a4f9332f68cb';

                    if (recordExists($tableName, $primaryKey, $primaryKeyValue)) {
                        echo "Record with $primaryKey = $primaryKeyValue exists in $tableName.<br>";
                    } else {
                        echo "Record with $primaryKey = $primaryKeyValue does not exist in $tableName.<br>";
                    }
                ?>
            </li>
            <li class="list-group-item">
                <h3>Get All Records</h3>
                <?php
                    // Sample usage of getAllRecords function
                    $allUsers = getAllRecords($tableName);
                    echo "<pre>";
                    print_r($allUsers);
                    echo "</pre>";
                ?>
            </li>
            <li class="list-group-item">
                <h3>Get All Records WHERE</h3>
                <?php
                    // Sample usage of getAllRecords function
                    $allUsers = getAllRecords($tableName, 'status = 1');
                    echo "<pre>";
                    print_r($allUsers);
                    echo "</pre>";
                ?>
            </li>
            <li class="list-group-item">
                <h3>Get Single Record</h3>
                <?php
                // Sample usage of getSingleRecord function
                $singleUser = getSingleRecord('users', "user_id = '7bd18f1b-d828-11ee-8aef-a4f9332f68cb'");
                echo "<pre>";
                print_r($singleUser);
                echo "</pre>";
                ?>
            </li>
            <li class="list-group-item">
                <h3>Add New Record</h3>
                <?php
                    // Sample usage of addRecord function
                    $newUserData = [
                        'user_id' =>  getGUID(),
                        'full_name' => 'John Doe',
                        'username' => 'john.doe',
                        'email' => 'john.doe@example.com',
                        'password' => password_hash('hashed_password', PASSWORD_DEFAULT),
                        'status' => 1
                    ];

                    if (!recordExists($tableName, 'email', $newUserData["email"])) {
                        if (addRecord('users', $newUserData)) {
                            echo "New user added successfully.<br>";
                        } else {
                            echo "Failed to add a new user.<br>";
                        }
                    } else {
                        echo "Record with email = ". $newUserData["email"] ." does not exist in $tableName.<br>";
                    }
                ?>
            </li>
            <li class="list-group-item">
                <h3>Update Record</h3>
                <?php
                    // Sample usage of updateRecord function
                    $updatedUserData = [
                        'full_name' => 'Updated Name',
                        'email' => 'updated.email@example.com',
                        'status' => 0
                    ];

                    $updateWhereClause = "user_id = '7bd18f1b-d828-11ee-8aef-a4f9332f68cb'";

                    if (updateRecord('users', $updatedUserData, $updateWhereClause)) {
                        echo "User updated successfully.<br>";
                    } else {
                        echo "Failed to update the user.<br>";
                    }
                ?>
            </li>
            <li class="list-group-item">
                <h3>Get All Records From Table</h3>
                <?php
                    // Sample usage of getAllRecordsFromTable function
                    $allUsers = getAllRecordsFromTable('users');
                    echo "<pre>";
                    print_r($allUsers);
                    echo "</pre>";
                ?>
            </li>
            <li class="list-group-item">
                <h3>Count All Records From Table</h3>
                <?php
                // Sample usage of getTotalRecords function
                $totalUsers = getTotalRecords('users');
                echo "Total number of users: $totalUsers<br>";
                ?>
            </li>
            <li class="list-group-item">
                <h3>Count All Records From Table with Where</h3>
                <?php
                // Sample usage of getTotalRecords function with a WHERE clause
                $activeUsersCount = getTotalRecords('users', 'status = 1');
                echo "Total number of active users: $activeUsersCount<br>";
                ?>
            </li>
        </ul>
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
