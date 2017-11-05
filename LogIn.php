<?php 
   require ("newIndex.php");
   ob_start();
   session_start();
?>


<!DOCTYPE html>
<html>
<body>
<style>
header{
   text-align: center;
   background: black;color:white;
    
}
footer{
	position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: red;
    color: white;
    text-align: center
}
div.format1 {
    margin-left: auto;
	margin-right:auto;
    width: 700px;
    height: 100px;
}
</style>
<body>
<!-- ==================Start Header============================ -->
<meta charset="UTF-8">
<title>Login</title>

<header>
<h1>Mortalwombat</h1>
</header>
<!-- ====================Start Body========================== -->
<center>

	<form action= "index.php">	
	    <button style="width:35%">Home</button><br>
	</form>
    <br>

    <?php 
    	  $msg = ' ';
	  if (isset($_POST['login']) && !empty($_POST['userId'])
	     && !empty($_POST['pswrd'])) 
	     {
		if (checkUser($_POST['userId']) && checkPass($_POST['pswrd']))
		{
			$_SESSION['valid'] = true;
			$_SESSION['timeout'] = time();
			$_SESSION['userId'] = $_POST['userId'];
		} 	
	     }
	  ?>
	<form name="login">
	<div class="login">
		<input type="text" placeholder="userName" name="userId"><br>
		<input type="password" placeholder="password" name="pswrd"><br>
		<input type="button" onclick="check(this.form)" value="Login"/>
	</div>
	</form>
	
	<script language="javascript">
	function check(form)
	{
		if(form.userId.value=="admin"&& form.pswrd.value=="password")
		   {
			  window.location="Login_Success.html"
		   }
		else if (form.userId.value!="admin"&& form.pswrd.value=="passowrd")
		   {
			   alert("UserName is incorrect")
		   }
		else if (form.userId.value=="admin"&& form.pswrd.value!="password")
		   {
			   alert("Password is incorrect")
		   }
	    else if (form.userId.value!="admin"&& form.pswrd.value!="password")
		    {
				alert("Both UserName and Password are incorrect")
			}
	}
	</script>
</center>
<footer> Mortalwombat Team</footer>
</body>
</html>
