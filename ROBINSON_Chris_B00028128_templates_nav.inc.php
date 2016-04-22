<?php
    require_once '../src/user.php';

    if (empty($indexLinkStyle)){
        $indexLinkStyle = '';
    }
    if (empty($productLinkStyle)){
        $productLinkStyle = '';
    }
    if (empty($shopLinkStyle)){
        $shopLinkStyle = '';
    }
    if (empty($aboutLinkStyle)){
        $aboutLinkStyle = '';
    }
    if (empty($forumLinkStyle)){
        $forumLinkStyle = '';
    }

    if(empty($loginLinkStyle)){
        $loginLinkStyle = '';
    }

    if(empty($userDashboardLinkStyle)){
        $userDashboardLinkStyle = '';
    }

    $login = new Itb\User();
    $auth_user = new Itb\User();

    if($login->is_loggedin())
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $auth_user->runQuery("SELECT * FROM UserDatabase WHERE UserId=:UserId");
        $stmt->execute(array(":UserId"=>$user_id));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        $loginMessage = "<li><a href=\"index.php?action=logout\">Logout</a></li>";
    }
?>
<nav>
    <ul>
        <?php
        if(isset($loginMessage))
        {
        ?>
            <li><a href="index.php" class="<?= $indexLinkStyle?>">Home</a></li>
            <li><a href="index.php?action=product" class="<?= $productLinkStyle?>">Products</a></li>
            <li><a href="index.php?action=shop" class="<?= $shopLinkStyle?>">Shop</a></li>
            <li><a href="index.php?action=forum" class="<?= $forumLinkStyle?>">Forum</a></li>
            <li><a href="index.php?action=userDashboard" class="<?= $userDashboardLinkStyle?>">User Dashboard</a></li>
            <?php print $loginMessage; ?>
        <?php
        }else
        {
            ?>
        <li><a href="index.php" class="<?= $indexLinkStyle?>">Home</a></li>
        <li><a href="index.php?action=product" class="<?= $productLinkStyle?>">Products</a></li>
        <li><a href="index.php?action=shop" class="<?= $shopLinkStyle?>">Shop</a></li>
        <li><a href="index.php?action=forum" class="<?= $forumLinkStyle?>">Forum</a></li>
        <li><a href="index.php?action=login" class="<?= $loginLinkStyle?>">Login</a></li>
            <?php
        }
        ?>
    </ul>
</nav>
