<?php
if (!isset($_COOKIE['Logged-in'])){
    header("Location: cookies.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My website: Home page</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
	<?php include 'header.php'?>
	<section>
		<h1>Welcome!</h1>
		<p><em>Thank you all for coming to my simple website.</em></p>
		<p>Here you will have the opportunity to get to know me. Here you can find some
		information about me - my home town, the places I've studied and lived, the things
		I have been working, hobbies and my reason to join the course. Also you can see some
		nice pictures of me and my programming skills.</p>
		<p>Thank you again and have a curious time!</p>

        <?php
            if ($logged === 'no'){
                echo '<p><strong style="color: red;">You are not logged into this website! <a href="log-in.php">Log in</a> to proceed.</strong></p>';
            }
        ?>
	</section>
</body>
</html>