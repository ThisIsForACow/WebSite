<?php

//connect to the database
$con = mysql_connect('localhost', 'team05', 'passwordTEAM05mysql!')
or die('Could not connect to the server!');


$users = "test";

checkUser($users);

function checkUser($user) 
{
	$sql = "SELECT user FROM accounts WHERE user='$user'";
	mysql_select_db('team05');
	$result = mysql_query($sql)
	or die ('A error occurred: ' . mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		echo "message: {$row['user']}"; 
		if ($user == $row['user'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
}
function checkPass($pass)
{
	$sql = "SELECT password FROM accounts WHERE password='$pass'";
	mysql_select_db('team05');
	$result = mysql_query($sql)
	or die ('error: ' .mysql_error());
	while ($row = mysql_fetch_array ($result, MYSQL_ASSOC))
	{
		echo " message {$row['password']}";
		if ($pass == $row['password'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
