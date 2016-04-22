<?php
    require_once __DIR__ .'/../templates/header.inc.php';
    require_once __DIR__ .'/../templates/nav.inc.php';

    $auth_user = new Itb\User();
    $user_id = $_SESSION['user_session'];
    $stmt = $auth_user->runQuery("SELECT * FROM UserDatabase WHERE UserId=:UserId");
    $stmt->execute(array(":UserId"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="column_container">
        <section class="aside">
            <h1>
                User Dashboard
            </h1>
            <p>
                Welcome Back: <?php print($userRow['UserName']); ?>
            </p>
            <p>
                Email: <?php print($userRow['UserEmail']); ?>
            </p>
            <p>
                <a href="index.php?action=logout">Logout</a>
            </p>
        </section>
    </div>
<?php
    require_once __DIR__ .'/../templates/footer.inc.php';
?>