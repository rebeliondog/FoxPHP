<?php
function fox_login()
{	
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$opdracht1 = "SELECT * FROM foxphp_users WHERE username = '$user'";
	$resultaat1 = mysqli_query($GLOBALS['foxsqli'], $opdracht1);
	if(mysqli_num_rows($resultaat1) > 0)
	{
		$opdracht2 = "SELECT * FROM foxphp_users WHERE username='$user'";
		$resultaat2 = mysqli_query($GLOBALS['foxsqli'], $opdracht2);
		if(mysqli_num_rows($resultaat2) > 0)
		{
			$rij = mysqli_fetch_array($resultaat2);
			$hash = $rij['password'];
			if(password_verify($pass, $hash))
			{
				$_SESSION["username"] = $rij['username'];
				$_SESSION['level'] = $rij['level'];
				//Log In
				return(true);
			}
			else
			{
				return(false);
			}
		}
	}
	else
	{
		return(false);
	}
}


function fox_register()
{
	$user = $_POST['username'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$level = 0;
	$stringy = $user + $pass + $pass2;
	if ($pass == "" || $pass2 == "" || $user == "")
	{
		return("The username or password can't be empty");
	}
	if ($pass == " " || $pass2 == " " || $user == " ")
	{
		return("The username or password can not contain space");
	}
	if (strpos($stringy, "'") !== false) {
		return("The username or password can not contain ', ;, -, or $");
	}
	if (strpos($stringy, ";") !== false) {
		return("The username or password can not contain ', ;, -, or $");
	}
	if (strpos($stringy, "-") !== false) {
		return("The username or password can not contain ', ;, -, or $");
	}
	if (strpos($stringy, "$") !== false) {
		return("The username or password can not contain ', ;, -, or $");
	}
	if (strpos($stringy, '"') !== false) {
		return("The username or password can not contain ', ;, -, or $");
	}
	if ($pass == $pass2)
	{
		$passv = password_hash("$pass", PASSWORD_DEFAULT);
		$query = "SELECT * FROM foxphp_users WHERE username = '$user'";
		$result1 = mysqli_query($GLOBALS['foxsqli'], $query);
		if(mysqli_num_rows($result1) > 0)
		{
			return("Username has already been taken");
		}
		else
		{
			if($_POST['level'] != "")
			{
				$level = $_POST['level'];	
			}
			else
			{
				$level = 0;	
			}
			$query1 = "INSERT INTO foxphp_users VALUES (NULL, '$user', '$passv', '$level');";
			if(mysqli_query($GLOBALS['foxsqli'], $query1))
			{
				echo mysqli_num_rows($query); 
				return(true);
			}
			else
			{
				return(false);
			}
		}
	}
	else
	{
		return("The passwords don't match");
	}
}


function fox_logout()
{
	$_SESSION['fox_user'] = null;
	$_SESSION['fox_user_perm'] = null;
	return(true);
}

// (C) Dimitri The Fox
