<?php
    require_once __DIR__ . '/../templates/header.inc.php';
    require_once __DIR__ . '/../templates/nav.inc.php';

    $userPosts = new Itb\ForumPost;
    $posts = $userPosts->getAll();

    $login = new Itb\User();
    $auth_user = new Itb\User();

    /**
     * this section retrieves users login name and displays it when logged in and on shop.php
     */
    if(!$login->is_loggedin()!="")
    {
        $notLoggedInMessage = "To post a message, please <a href=\"index.php?action=login\" class=\"<?= $loginLinkStyle?>\">Login</a>";
    }
    else if($login->is_loggedin())
    {
        $user_id = $_SESSION['user_session'];
        $stmt = $auth_user->runQuery("SELECT * FROM UserDatabase WHERE UserId=:UserId");
        $stmt->execute(array(":UserId"=>$user_id));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        $loginMessage = "Logged In As: " .$userRow['UserName'];
    }

    $forumPost = new Itb\ForumPost();

    if(isset($_POST['ForumPost']))
    {
        $ForumName = $userRow['UserName'];
        $ForumEmail = $userRow['UserEmail'];
        $ForumComments = $_POST['ForumComments'];

        if($ForumComments=="")
        {
            $error[] = "Please enter some comments";
        }else
        {
            if($forumPost->forumPost($ForumName,$ForumEmail,$ForumComments))
            {
                $message = 'Your Message Has Been Posted !';
            }
        }
    }
?>
    <div class="column_container">
        <section class="aside">
        <?php
        if(isset($loginMessage))
        {
            ?>
            <p><?php print $loginMessage; ?></p>
            <form method="post">
                <?php
                if(isset($message))
                {
                    ?>
                    <p><?php print $message; ?></p>
                    <?php
                }
                ?>
                <h1>Post A Message</h1>
                <?php
                if(isset($error))
                {
                    foreach($error as $error)
                    {
                        ?>
                        <p><?php print $error; ?></p>
                        <?php
                    }
                }
                ?>
                <p>Use the following form to send us a message</p>
                <textarea rows="10" cols="50" name="ForumComments" placeholder="Enter Comments" value="<?php if(isset($error)){print $ForumComments;}?>"></textarea>
                <p><button type="submit" name="ForumPost">Post</button></p>
            </form>
        </section>
        <?php
        }else if(isset($notLoggedInMessage))

        {
        ?>
        <p><?php print $notLoggedInMessage; ?><p>
            <?php
            }
            ?>
            <section class="forumMiddle">
                <h1>Posted Messages</h1>
                <hr>
                <?php
                foreach($posts as $post): ?>
                <h3>Name: </h3> <p><?= $post->getForumName() ?></p>
    <br>
        <h3>Comments:</h3>
        <p><?= $post->getForumComments() ?></p>
    <br>
        <h3>Date Posted: </h3>
        <p><?= $post->getForumDateTime() ?></p>
    <hr>
    <?php
    endforeach
    ?>
        </section>
    </div>
<?php
    require_once __DIR__ . '/../templates/footer.inc.php';
?>