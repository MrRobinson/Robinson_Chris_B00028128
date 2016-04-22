<?php
    require_once __DIR__ .'/../templates/header.inc.php';
    require_once __DIR__ .'/../templates/nav.inc.php';

    $login = new Itb\User();

    /**
     * Redirect to user dashboard if logged in
     */
    if($login->is_loggedin()!="")
    {
        $login->redirect('index.php?action=userDashboard');
    }

    /**
     * If login is pressed, check user or username % password match
     */
    if(isset($_POST['login']))
    {
        $UserName = $_POST['userName'];
        $UserEmail = $_POST['userName'];
        $UserPassword = $_POST['userPassword'];

        if($login->doLogin($UserName,$UserEmail,$UserPassword))
        {
            $login->redirect('index.php?action=userDashboard');
        }
        else
        {
            $error = "Incorrect Details !";
        }
    }
?>
<div class="column_container">
    <section class="middle">
        <form method="post">
            <h2>Login</h2>
            <?php
            if(isset($error))
            {
                ?>
                <p>
                    <?php echo $error; ?>
                </p>
                <?php
            }
            ?>
            <input type="text" name="userName" placeholder="Username or Email" value="<?php if(isset($error)){echo $UserName;}?>" required />
            <br>
            <input type="password" name="userPassword" placeholder="Your Password" required />
            <br>
            <p>
                <button type="submit" name="login">Login</button>
            </p>
            <p>
                Don't have an account yet ? <a href="index.php?action=signup">Sign Up</a>
            </p>
        </form>

        </section>
    </div>
<?php
    require_once __DIR__ .'/../templates/footer.inc.php';
?>
