<?php
    require_once __DIR__ .'/../templates/header.inc.php';
    require_once __DIR__ .'/../templates/nav.inc.php';

    $newsLetter = new Itb\NewsLetter();

    if(isset($_POST['newsLetter']))
    {
        $NewsName = trim($_POST['NewsName']);
        $NewsEmail = trim($_POST['NewsEmail']);

        if($NewsName =="")
        {
            $error[] = "Please enter a name!";
        }else if($NewsEmail=="")
        {
            $error[] = "Please enter an email address";
        }else if (!filter_var($NewsEmail, FILTER_VALIDATE_EMAIL)){
            $error[] = "Please enter an valid email address";

        }else
        {
            if($newsLetter->newsLetter($NewsName,$NewsEmail))
            {
                $message = 'Thank You For Subscribing To Our NewsLetter!';
            }
        }
    }

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
?>
<div class="column_container">
    <section class="aside">
        <?php
        if(isset($loginMessage))
        {
            ?>
            <p><?php print $loginMessage; ?></p>
            <?php
        }
        ?>
        <h1>Welcome</h1>
        <p>Welcome to the home page of <strong>News & Yarn.</strong></p>
        <h2>About</h2>
        <p>We are a small news agents based in the heart of Blanchardstown village in Dublin 15.</p>
        <p>The news agents has been open about 20 years.</p>
        <p>We are a family run business. </p>
        <p>We sell newspapers, stationary and our most popular item is yarn.</p>
        <p>The shop provides a number of varieties of knitting equipment as well as yarn that is stocked daily.</p>
    </section>
    <section class="middle">
        <h1>Subscribe</h1>
        <?php
        if(isset($message))
        {
            ?>
            <p><?php print $message; ?></p>
            <?php
        }else if(isset($error))
        {
            foreach($error as $error)
            {
                ?>
                <p><?php print $error; ?></p>
                <?php
            }
        }else{
            print '<p>Subscribe to our news letter <br>to get the latest on our products.</p>';
        }

        ?>
        <form action="index.php" method="post" class="subscribe-form">
            <input type="text" name="NewsName" placeholder="Enter Name" value="<?php if(isset($error)){echo $NewsName;}?>">
            <br>
            <input type="text" name="NewsEmail" placeholder="Enter Email" value="<?php if(isset($error)){echo $NewsEmail;}?>">
            <br>
            <br>
            <button type="submit" name="newsLetter" class="subscribe-submit">Subscribe</button>
        </form>
    </section>
</div>
<?php
    require_once __DIR__ .'/../templates/footer.inc.php';
?>