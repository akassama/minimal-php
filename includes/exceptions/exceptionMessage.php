<?php

session_start();

// Check if the session variable exists
if (isset($_SESSION['formError'])) {
    // Echo the session variable and then unset it (optional, to clear it after displaying)
    echo '<div style="background-color: #f25555; padding: 10px; border-radius: 8px; color: #ffffff; margin-top: 1.2em; margin-bottom: 1.2em;">' . $_SESSION['formError'] . '</div>';

    // Unset the session variable if you want to clear it after displaying
    unset($_SESSION['formError']);
}
