<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>FoxPHP Setup</title>
</head>

<body>
	<?php
		$setup = $_POST['setup'];
		if(isset($setup))
		{
			require('foxphp_inc.php');
			
			$query1 = "CREATE TABLE IF NOT EXISTS `foxphp_users` (
						`UserID` int(11) NOT NULL,
						  `username` varchar(9999) COLLATE utf8_unicode_ci NOT NULL,
						  `password` varchar(9999) COLLATE utf8_unicode_ci NOT NULL,
						  `level` int(1) NOT NULL DEFAULT '0'
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		
			$query2 = "ALTER TABLE `foxphp_users`
 						ADD PRIMARY KEY (`UserID`);";
			
			$query3 = "ALTER TABLE `foxphp_users`
						MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;";
			
			if(!mysqli_query($foxsqli, $query1) || !mysqli_query($foxsqli, $query2) || !mysqli_query($foxsqli, $query3))
			{
				echo "<h1 style='color=red'>Setup failed, did you configure a databse in foxphp_inc.php?</h1>";
				exit();
			}
			else
			{
				echo "<h1 style='color=red'>Setup done. You can now use FoxPHP!</h1>";
				exit();
			}
		}
	?>
	
	<h1>FoxPHP Setup</h1>
	<img src='logo.png' height='100vh' draggable='false'><br>
	<p>
		This setup is an automated process. But before you press Start Setup make sure you configured a database in foxphp_inc.php.
	</p>
	<form method="post">
		<input type="submit" name="setup" value="Start Setup">
	</form>
</body>
</html>
