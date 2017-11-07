<?php
session_start();
$valid = array("macklin","admin", "guest","LAMPCougars","Ligers","CyberLinux", "CyberCrypts","MortalWombat","team6","team7", "test"); //array of valid user names
$userId = $_POST['userId'];
$password = $_POST['pswrd'];
if (strlen($password) > 8 || strlen($userId) > 25)
{
        $_SESSION['errormessage'] = "incorrect password or username";
        header("location: login.php");
}
$key = array_search($userId,$valid); //returns a key referencing location of valid input in array
$found = $valid[$key]; // stores the valid username
$mysqli = new mysqli("localhost", "team05", "passwordTEAM05mysql!", "team05") or die('Could not connect to the server!' . mysqli_error());
$result = $mysqli->query("SELECT password, secretmessage FROM accounts WHERE user='$found'") or die ('A error occurred:' . mysqli_error());


if($result->num_rows == 0 || $result->num_rows > 1)
{
    header("location: login.php");
}
else
{
    while($row = $result->fetch_assoc()) {
        if($row["password"] != $password)
        {
          $counter = $_SESSION['loginAttempt'];
          $counter++;
          $_SESSION['loginAttempt'] = $counter;
            $mysqli->query("UPDATE accounts SET unsuccessfulLogin = (unsuccessfulLogin + 1)  WHERE user = '$userId'");
            $_SESSION['errormessage'] = "PASSWORD IS INCORRECT";
            header("location: login.php");
        }
        else
        {
           $mysqli->query("UPDATE accounts SET successfulLogin = (successfulLogin + 1) WHERE user = '$userId'");
           $_SESSION['loginAttempt'] = 0; //resets loginAttempts
           $_SESSION['authenticated'] = 1; // set authentication flag to 1
           $_SESSION['secretMessage'] = $row['secretmessage'];
        }
    }
}
if ($_SESSION['authenticated'] != 1)
{
        header("location: login.php");
}
?>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/listofusers.css">
<html>
<head>
    <title>list Of User</title>
</head>
<meta charset="UTF-8">
<title>List of Users</title>
<header>
    <h1>List of Users</h1>
</header>

<!--================================================================= -->
<body>
<center>
    <div class="btn-group" style="width:100%">
        <form action="index.php">
            <button style="width:35%">Home</button>
        </form>
    </div>
    <!--================================================================= -->
    <div class="format1">
       <h1>  </h1>
       <?php
             echo "Here is your message: {$_SESSION['secretMessage']}";
       ?>
       <table>
           <tr>
               <th>UsersName</th>
               <th>Successful Login</th>
               <th>Unsuccessful Login</th>
               <?php
               if($GLOBALS['userId'] == "admin") {
                   echo "<th>Password</th>";
               }
               ?>
           </tr>
           <?php
           $data = $GLOBALS['mysqli']->query("SELECT * FROM accounts") or die ('A error occurred: ' . mysqli_error());
           while($row = $data->fetch_assoc()){
             echo "<tr>";
             echo "<td>";
             echo $row["user"];
             echo "</td>";
             echo "<td>";
             echo $row['successfulLogin'];//Enter number of successful login
             echo "</td>";
             echo "<td>";
             echo $row["unsuccessfulLogin"];//Enter number of successful login
             echo "</td>";
             if($GLOBALS['userId'] == "admin") {
                 echo "<td>";
                 echo $row["password"];
                 echo "</td>";
             }
             echo "</tr>";
           }
           ?>
       </table>
   </div>

    <!--================================================================= -->
    </div>
</center>
</body>
<footer> Mortalwombat Team</footer>
</html>
