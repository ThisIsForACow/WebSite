<?php
session_start();
$valid = array("macklin","admin", "guest","lampcougars","ligers","cyberlinux", "cybercrypts","mortalwombat","team6","team7", "test"); //array of valid user names
$userId = strtolower($_POST['userId']); //ensures that username is not case sensitive
$password = $_POST['pswrd'];
if (strlen($password) > 9 || strlen($userId) > 25) //validates length of input fields
{
        $_SESSION['errormessage'] = "incorrect password or username";
        header("location: login.php");
}
$key = array_search($userId,$valid); //returns a key referencing location of valid input in array
$found = $valid[$key]; // stores the valid username
$mysqli = new PDO("mysql:dbname=team05;host=localhost", "team05", "passwordTEAM05mysql!") or die('Could not connect to the server!' . mysqli_error());

//neccessary setup for PDO parameterized statements
$mysqli -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $mysqli->prepare("SELECT password, secretmessage FROM accounts WHERE user= :name");
$stmt->bindParam(':name', $found, PDO::PARAM_STR); //binds statement
$stmt->execute(); //executes prepared statement

if($stmt -> rowCount() == 0 || $stmt -> rowCount() > 1)
{
    header("location: login.php");
}
else
{
    foreach($stmt as $row) {
        if($row["password"] != $password)
        {
          $counter = $_SESSION['loginAttempt'];
          $counter++;
          $_SESSION['loginAttempt'] = $counter;
           $state  = $mysqli->prepare("UPDATE accounts SET unsuccessfulLogin = (unsuccessfulLogin + 1)  WHERE user = :name"); //incrememts unsuccessful login
           $state -> bindParam(':name', $found, PDO::PARAM_STR);
           $state -> execute();
           $_SESSION['errormessage'] = "PASSWORD OR USERNAME IS INCORRECT";
           header("location: login.php");
        }
        else
        {
           $state = $mysqli->prepare("UPDATE accounts SET successfulLogin = (successfulLogin + 1) WHERE user = :name"); //incrememts successful login
           $state -> bindParam(':name', $found, PDO::PARAM_STR);
           $state -> execute();
           $_SESSION['loginAttempt'] = 0; //resets loginAttempts
           $_SESSION['authenticated'] = 1; // set authentication flag to 1
           $_SESSION['secretMessage'] = $row['secretmessage'];
        }
    }
}
if ($_SESSION['authenticated'] != 1) //prevent someone from skipping over loginpage
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
           foreach( $data as $row){
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
