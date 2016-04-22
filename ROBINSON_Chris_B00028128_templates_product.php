<?php
    require_once __DIR__ .'/../templates/header.inc.php';
    require_once __DIR__ .'/../templates/nav.inc.php';

    $login = new Itb\User();
    $auth_user = new Itb\User();

    if($login->is_loggedin())
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $auth_user->runQuery("SELECT * FROM UserDatabase WHERE UserId=:UserId");
        $stmt->execute(array(":UserId"=>$user_id));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        $loginMessage = "Logged In As: " .$userRow['UserName'];
    }

    if(!$login->is_loggedin()!="")
    {
        $notLoggedInMessage = "<a href=\"index.php?action=signup\">Sign Up</a> and receive 10% off your order in our <a href=\"index.php?action=shop\">Shop</a>";
    }
    ?>
<div class="column_container">
    <section class="aside">
        <?php
        if(isset($loginMessage))
        {
            ?>
            <p>
                <?php print $loginMessage; ?>
            </p>
            <?php
        }
        ?>
        <h1>Products</h1>
        <p>Here you can keep up to date on all our yarn and if they are currently in stock.</p>
        <?php
        if(isset($notLoggedInMessage))
        {
            ?>
            <p>
                <?php print $notLoggedInMessage; ?>
            </p>
            <?php
            }
            ?>
        <table>
            <tr>
                <th>Picture: </th>
                <th>Name: </th>
                <th>Type: </th>
                <th>Color: </th>
                <th>Price Per 100g: </th>
                <th>Description: </th>
                <th>Stock: </th>
            </tr>
            <?php
            foreach($yarnProducts as $yarnProduct): ?>
                <tr>
                    <td><?= $yarnProduct->getYarnPicture() ?></td>
                    <td><?= $yarnProduct->getYarnName()?></td>
                    <td><?= $yarnProduct->getYarnType()?></td>
                    <td><?= $yarnProduct->getYarnColor()?></td>
                    <td><?= $yarnProduct->getYarnPrice()?></td>
                    <td><?= $yarnProduct->getYarnDescription()?></td>
                    <?php
                    if ($yarnProduct->getYarnStock() > 0) {
                        print '<td> '.$yarnProduct->getYarnStock(). '</td>';
                    } else {
                        print '<td>Out Of Stock</td>';
                    }
                    ?>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </section>
</div>
<?php
    require_once __DIR__ .'/../templates/footer.inc.php';
?>