<?php
include 'isLoggedIn.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My website: Contact me</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<?php include 'header.php'?>
	<section>
		<form action="mail.php" method="post">
			<label for="email">Enter your email address:</label>
			<div><input type="email" name="email" id="email" placeholder="Enter your email here..."/><br /></div>
			<label for="topic">What is your email about?</label>
			<div><input type="text" size="50" maxlength="50" name="topic" id="topic" placeholder="Topic..."/><br /></div>
			<label for="mailText"></label>
			<div><textarea rows="10" cols="40" name="mailText" id="mailText" placeholder="Enter your message here..." ></textarea></div>
			<button type="submit">Send Mail</button>
		</form>
	</section>
</body>
</html>