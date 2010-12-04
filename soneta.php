<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>untitled</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Eran Chetzroni">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<!-- Date: 2010-09-12 -->
	<style type="text/css" media="screen">
		h1 { font-family: 'Lobster', arial, serif; }
	</style>>
</style>
</head>

<body>
	<?php
	// Define your username and password
	$username = "someuser";
	$password = "somepassword";
	//Now lets check to see if the form has been filled out.
	if(isset($_POST['user']) && isset($_POST['password']))
	{
	//ok they are set lets see if they match.
	if($username == $_POST['user'] && $password == $_POST['password'])
	{
	//Ok the login worked
	?>
	Your Protected Page Here.
	<?php
	}
	else
	{
	//Login Failed, display error
	die("Your Login Information was Incorrect");
	}
	}
	else
	{
	//Login Field was blank, display the login form
	?>
	<h1>Login</h1>

	<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


	<label for="txtUsername">Username:</label>

	<input type="text" title="Enter your Username" name="txtUsername" /></p>



	<label for="txtpassword">Password:</label>

	<input type="password" title="Enter your password" name="txtPassword" /></p>



	<input type="submit" name="Submit" value="Login" /></p>

	</form>
	<?php
	}
	?>

</body>
</html>
