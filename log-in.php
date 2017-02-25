<?php
    function post($index){
        return $_POST[$index];
    }
    $name = 'Pepi';
    $password = 'pepi123';
    $wrong = '';

if (isset($_POST['submit'])){
        if (post('name') === $name && post('pass') === $password){
            setcookie("Logged-in", 'yes');
            header('Location: index.php');
        } else {
            $wrong = 'Wrong password or username!';
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
    <h3>Само Пепи има достъп! Хаха!</h3>
    <p><em>name = Pepi <br> pass = pepi123</em></p>
    <form action="" method="post">
        <div><label for="name">Name:</label></div>
        <div><input type="text" name="name" id="name"></div>
        <div><label for="pass">Password:</label></div>
        <div><input type="password" name="pass" id="pass"></div>
        <input type="submit" name="submit" value="Log in">
    </form>
    <p><strong><?=$wrong?></strong></p>
</section>
</body>
</html>
