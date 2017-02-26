<?php
    function post($index){
        return $_POST[$index];
    }
    function getPassword($username){
        $pass = strstr(file_get_contents("users/$username.txt"), 'Password=');
        $pass = str_replace('Password=', '', $pass);
        return $pass;
    }
    $username = '';
    $password = '';
    $wrong = '';

    if (isset($_POST['submit'])){

        $username = post('username');
        $password = post('pass');

        if (file_exists("users/$username.txt") && sha1($password) === getPassword($username)) {
            setcookie("Logged-in", 'yes');
            header('Location: index.php');
        } else if (!file_exists("users/$username.txt")){
            $wrong = 'You have entered wrong username! If you do not have an account <a href="register.php">sign up</a> <strong>NOW!</strong>. :)';
        } else {
            $wrong = 'Wrong password!';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My website: Log in</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<?php include 'header.php'?>
<section>
    <form action="" method="post">
        <div><label for="username">Username:</label></div>
        <div><input type="text" name="username" id="username" value="<?=$username?>"></div>
        <div><label for="pass">Password:</label></div>
        <div><input type="password" name="pass" id="pass"></div>
        <input type="submit" name="submit" value="Log in">
    </form>
    <p><strong><?=$wrong?></strong></p>
</section>
</body>
</html>
