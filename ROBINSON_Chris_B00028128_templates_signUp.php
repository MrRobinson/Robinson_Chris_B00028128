<?php
    require_once __DIR__ .'/../templates/header.inc.php';
    require_once __DIR__ .'/../templates/nav.inc.php';

    $user = new Itb\User();

    /**
     * If button is pressed. Take in user name, email and password
     * If username, email or password is blank. Provide message
     * If username, email or password is taken, Provide message
     */
    if(isset($_POST['signUp']))
    {
        $UserName = trim($_POST['userName']);
        $UserEmail = trim($_POST['userEmail']);
        $UserPassword = trim($_POST['userPassword']);

        if($UserName=="") {
            $error[] = "Username cannot be blank.<br> Please provide a username !";
        }
        else if($UserEmail=="") {
            $error[] = "Email cannot be blank.<br> Please enter an email address !";
        }
        else if(!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Please enter a valid email address !';
        }
        else if($UserPassword=="") {
            $error[] = "Password cannot be blank.<br> Please provide a Password !";
        }
        else if(strlen($UserPassword) < 6){
            $error[] = "Password must be at least 6 characters";
        }
        else
        {
            try
            {
                $stmt = $user->runQuery("SELECT UserName,UserEmail FROM UserDatabase WHERE UserName=:UserName OR UserEmail=:UserEmail");
                $stmt->execute(array(':UserName'=>$UserName, ':UserEmail'=>$UserEmail));
                $row=$stmt->fetch(PDO::FETCH_ASSOC);

                if($row['UserName']==$UserName) {
                    $error[] = "This username is already taken !";
                }
                else if($row['UserEmail']==$UserEmail) {
                    $error[] = "This email address is <br> already registered in our system !";
                }
                else
                {
                    if($user->register($UserName,$UserEmail,$UserPassword))
                    {
                        $message = 'Sign up successful ! <br> You can now <a href="index.php?action=login" >Login</a>';
                    }
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>
    <div class="column_container">
        <section class="middle">
        <form method="post" action="">
        <?php
            if(isset($message))
            {
            ?>
            <p>
                <?php echo $message; ?>
            </p>
            <?php
            }else{?>
                <h2>Sign Up</h2>
                <p>Registered Users Will Receive 10% Off !</p>
            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    ?>
                    <p>
                        <?php echo $error; ?>
                    </p>
                    <?php
                }
            }
            ?>
            <input type="text" name="userName" placeholder="Enter Username" value="<?php if(isset($error)){echo $UserName;}?>" />
            <br>
            <input type="text" name="userEmail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $UserEmail;}?>" />
            <br>
            <input type="password" name="userPassword" placeholder="Enter Password" />
            <br>
            <p>
                <button type="submit" name="signUp">Sign up</button>
            </p>
            <p>
                Have an account ? <a href="index.php?action=login">Login</a>
            </p>
        </form>
           <?php
           }
        ?>
        </div>
    </div>
<?php
    require_once __DIR__ .'/../templates/footer.inc.php';
?>