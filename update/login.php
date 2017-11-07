<link rel="stylesheet" href="css/common.css">
<?php
$thisTime = time();
session_start();
$_SESSION['loginAttempt'] = 0;
$_SESSION['authenticated'];
$_SESSION['username'];
if ($_SESSION['authenticated'] == 1)
{
        header("location: index.php");
}
if($_SESSION['loginAttempt'] == 5)
{
        $timeNow = time();
        if (timeNow >= ($thisTime + 30))
        {
          $_SESSION['loginAttempt'] = 0;
        }
        else
        {
          die("you are frozen");
        }
}
?>
<html>
<!-- ==================Start Header============================ -->
<meta charset="UTF-8">
<title>Login</title>

<header>
<h1>Mortalwombat</h1>
</header>
<!-- ====================Start Body========================== -->
<center>

        <form action="index.php">
            <button style="width:35%">Home</button><br>
        </form>
    <br>
        <form action="login_results.php" method="post">
        <div class="login">
                <input type="text" placeholder="userName" name="userId" id="userId"><br>
                <input type="password" placeholder="password" name="pswrd" id="pswrd"><br>
                <input type="submit"/>
        </div>
        <?php
              echo $_SESSION['errormessage'];
        ?>
        </form>
</center>
<footer> Mortalwombat Team</footer>
</body>
</html>
