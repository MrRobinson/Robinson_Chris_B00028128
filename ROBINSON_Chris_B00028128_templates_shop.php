<?php
    require_once __DIR__ .'/../templates/header.inc.php';
    require_once __DIR__ .'/../templates/nav.inc.php';

    $login = new Itb\User();
    $auth_user = new Itb\User();

    if(!$login->is_loggedin()!="")
    {
        $notLoggedInMessage = "To access the shop, please <a href=\"index.php?action=login\" class=\"<?= $loginLinkStyle?>\">Login</a>";
    }
    else if($login->is_loggedin())
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $auth_user->runQuery("SELECT * FROM UserDatabase WHERE UserId=:UserId");
        $stmt->execute(array(":UserId"=>$user_id));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        $loginMessage = "Logged In As: " .$userRow['UserName'];
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
            <h1>Shop</h1>
            <p>Here you can select from our yarn that is currently in stock.</p>
            <p>10% off your total order will be discounted in the shopping cart !</p>
            <table>
                <tr>
                    <th>Picture: </th>
                    <th>Product: </th>
                    <th>Type: </th>
                    <th>Color: </th>
                    <th>Price Per 100g: </th>
                    <th>Stock: </th>
                    <th>(Add To Cart)</th>
                </tr>
                <?php
                foreach($yarnProducts as $yarnProduct):
                    ?>
                    <tr>
                        <td><?= $yarnProduct->getYarnPicture() ?></td>
                        <td><?= $yarnProduct->getYarnName() ?></td>
                        <td><?= $yarnProduct->getYarnType() ?></td>
                        <td><?= $yarnProduct->getYarnColor() ?></td>
                        <td>&euro; <?= $yarnProduct->getYarnPrice() ?></td>
                        <?php
                        if ($yarnProduct->getYarnStock() > 0) {
                            print '<td>'.$yarnProduct->getYarnStock().'</td>';
                            print '<td><a href="/index.php?action=addToCart&id='.$yarnProduct->getYarnId().'">(Add To Cart)</a></td>';
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
        <section class="right">
            <?php
            require_once 'shoppingCart.php';
            ?>
        </section>
        <?php
        }else if(isset($notLoggedInMessage)){?>
        <p>
            <?php
            print $notLoggedInMessage;
            ?>
        <p>
            <?php
            }
            ?>
    </div>
<?php
    require_once __DIR__ .'/../templates/footer.inc.php';
?>