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
 <form action="login.php">
	<button style="width:35%">Play</button>
 </form>
 <form action="index.php">
  <button style="width:35%">Home</button>
  </form>
 </div>
<!--================================================================= -->

<div class="format1">
<h1></h1>
<table>
  <tr>
    <th>UsersName</th>
    <th>Successful Login</th>
    <th>Unsuccessful Login</th>
  </tr>
    <?php
    $mysqli = new mysqli("localhost", "team05", "passwordTEAM05mysql!", "team05") or die('Could not connect to the server!' . mysqli_error());
    $data = $mysqli->query("SELECT * FROM accounts") or die ('A error occurred: ' . mysqli_error());
    while($row = $data->fetch_assoc()){
        echo "<tr>";
        echo "<td>";
        echo $row["user"];
        echo "</td>";
        echo "<td>";
        echo "0";//Enter number of successful login
        echo "</td>";
        echo "<td>";
        echo "0";//Enter number of successful login
        echo "</td>";
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
