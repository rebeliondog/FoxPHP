<?php
session_start();
/* Stuff you may touch */

//MySQL database login
$foxdb_hostname = 'localhost';
$foxdb_username = '';
$foxdb_password = '';
$foxdb_database = '';


/* Never touch this! */

//Used for version checks;
$foxver = "0.0.1";

//Used for database connections
$GLOBALS['foxsqli'] = mysqli_connect($foxdb_hostname, $foxdb_username, $foxdb_password, $foxdb_database);

//Loading all functions (hardcoded for version compaxctibility)
require('foxphp_functions/usersystem.php');


//Loading all plugins (softcoded to make it easy)
foreach (glob("foxphp_plugins/*.php") as $foxfilename)
{
    include $foxfilename;
}

//Blocked this page from being loaded in the browser
if(strpos($_SERVER['PHP_SELF'], 'foxphp_inc.php') !== false)
{
	echo "<body oncontextmenu='return false;'>";
	echo "<center>";
	echo "<h1>What are you doing here?</h1>";
	echo "<img src='logo.png' height='100vh' draggable='false'><br>";
	echo "<a href='index'>Back to homepage</a>";
	echo "</center>";
	echo "</body>";
	exit();
}
?>
<!-- (C) Dimitri The Fox -->
