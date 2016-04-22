<?php
    session_start();

    use Itb\MainController;

    require_once __DIR__ . '/../vendor/autoload.php';

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '1234');
    define('DB_NAME', 'itb');

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    $mainController = new MainController();

    $user = new Itb\User();

    if ('addToCart' == $action) {
        $mainController->addToCart();
    } elseif ('forum' == $action) {
        $mainController->forumAction();
    } elseif ('login' == $action) {
        $mainController->loginAction();
    } elseif ('logout' == $action) {
        $user->doLogout();
    } elseif ('logoutsuccess' == $action) {
        $mainController->logoutsuccessAction();
    } elseif ('product' == $action) {
        $mainController->productAction();
    } elseif ('signup' == $action) {
        $mainController->signupAction();
    } elseif ('sitemap' == $action) {
        $mainController->sitemapAction();
    } elseif ('shop' == $action) {
        $mainController->shopAction();
    } elseif ('removeFromCart' == $action) {
        $mainController->removeFromCart();
    } elseif ('userDashboard' == $action) {
        $mainController->userdashboardAction();
    } else {
        // default is home page ('index' action)
        $mainController->indexAction();
    }
