<?php
session_start ();
require_once("DBCon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changer</title>
    <link rel="stylesheet" type="text/css" href="SignUpCSS.php">
	<link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
</head>
<body>
    
<div class="navbar">
		<div>
			<h2>THE HIRUZEN</h2>
		</div>
		<ul class="container">
			<li ><a href="usersLandingPage.php" class="cool-link">Home</a></li>
			<li ><a href="PassChange.php" class="cool-link">Change Password</a></li>
			<li ><a href="Login.php" class="cool-link">Login</a></li>
			<li ><a href="SignUpPage.php" class="cool-link">Register</a></li>
			<li ><a href="logout.php" class="cool-link">Logout</a></li>
		</ul>
</div>
	<br>
	<br>
	<div class="howl">
	<br>
	<br>
		<form action="PassCR.php" method="post">
        <label for="pass">New Password:</label>
        <input type="Password" name="pass" required>
        <label for="Conpass">Confirm Password:</label>
        <input type="Password" name="Conpass" required>
        <input type="hidden" name="id" value="<?php echo $_SESSION['ID']; ?>">
        <button type="submit" name="submit">Confirm</button>
        </form>
        
	</div>
</body>
</html>