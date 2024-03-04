<?php
// Include the config.php file

//set environment variable
$env = $config['ENVIRONMENT'];
function customExceptionHandler($exception) {
    // Use the global keyword to access the $env variable
    global $env;

    // Log the exception or perform any other handling
    error_log('Uncaught Exception: ' . $exception->getMessage());

    // Display error message

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                background-color: black;
                color: white;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .error-section {
                background-color: red;
                padding: 20px;
                margin: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .error-header {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .error-body {
                margin-top: 10px;
            }

            .read-more-link {
                display: inline-block;
                padding: 10px 20px;
                background-color: blue;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .read-more-link:hover {
                background-color: darkblue;
            }

            /* Additional styling for the pre tag */
            .error-body pre {
                background-color: #333;
                color: white;
                padding: 10px;
                overflow: auto;
                border-radius: 5px;
                border: 1px solid #555;
                text-align: left;
            }
        </style>
    </head>
    <body>

    <div class="error-section">
        <div class="error-header">An Error Occurred (PHP : <?php echo phpversion();?>)</div>

        <div class="error-body">

            <?php
            if($env === "production"){
                ?>
                <p>
                    <strong>Message:</strong> An unexpected error occurred while processing your request.
                </p>
                <p>
                    If you're a developer and would like to see more details about the error, you can set the environment configuration to "development." This will provide additional information that can be useful for debugging.
                </p>
                <p>
                    For production environments, it's recommended to keep error details hidden to maintain security and user experience.
                </p>
                <?php
            }
            else{
                ?>
                <p>
                    <strong>Message:</strong> <?php echo htmlspecialchars($exception->getMessage());?>
                </p>

                <p>
                    <strong>Code:</strong> <?php echo $exception->getCode();?>
                </p>
                <p>
                    <strong>File:</strong> <?php echo htmlspecialchars($exception->getFile());?>
                </p>
                <p>
                    <strong>Line:</strong> <?php echo $exception->getLine();?>
                </p>
                <p>
                    <strong>Trace</strong>
                </p>
                <?php
                    $trace = htmlspecialchars($exception->getTraceAsString());
                ?>
                <pre><?php echo $trace; ?></pre>
                <hr/>

                <a href="https://google.gprivate.com/search.php?search?q=php+error+code+<?php echo $exception->getCode();?>" class="read-more-link" target="_blank">Read more...</a>

                <?php
            }
            ?>
        </div>
    </div>

    </body>
    </html>

    <?php

    //header("Location: {$config['BASE_URL']}/error");
    exit();
}

// Set the custom exception handler
set_exception_handler('customExceptionHandler');

// Rest of your code shod come after this...
?>

