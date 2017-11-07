<link rel="stylesheet" href="css/common.css">
<?php
session_start();
session_unset();
session_destroy();
?>
<html>
<!-- ==================Start Header============================ -->
<title>Home</title>
<header>
<h1>Play Page</h1>
</header>
<!-- ====================Start Body========================== -->
<center>
    <form action="login.php">
        <button style="width:35%">Play</button>
    </form>
    <form action="listofusers.php">
        <button style="width:35%">List Of Users</button>
    </form>
</center>
<footer> Mortalwombat Team</footer>
</html>
