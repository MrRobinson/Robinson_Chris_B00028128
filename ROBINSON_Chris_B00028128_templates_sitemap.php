<?php
    require_once __DIR__ . '/../templates/header.inc.php';
    require_once __DIR__ . '/../templates/nav.inc.php';
?>
    <h1>
        Site Map
    </h1>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?action=product">Products</a></li>
        <li><a href="index.php?action=shop">Shop</a></li>
        <li><a href="index.php?action=forum">Forum</a></li>
        <li><a href="index.php?action=login">Login</a></li>
    </ul>
<?php
    require_once __DIR__ . '/../templates/footer.inc.php';
?>