<?php

// routes/routes.php

// Define your routes
$routes = [
    //Home
    'home' => 'views/home/index.php',
    'about' => 'views/about/index.php',

    //Sign-In
    'sign-in' => 'views/sign-in/index.php',

    //Sign-Up
    'sign-up' => 'views/sign-up/index.php',
];

// Get the requested URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';

// Check if the route exists
if (array_key_exists($url, $routes)) {
    include $routes[$url];
} else {
    // Handle 404 - Not Found
    include 'views/error/404.php';
}
