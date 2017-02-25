<?php
if (!isset($_COOKIE['Logged-in'])){
    setcookie("Logged-in", 'no', strtotime('+2 hours'), '/', "localhost");
    header("Location: register.php");
}
require_once 'post.php';
$message = '';

if (isset($_POST['submit'])){
    $name = post('name');
    $name = trim(htmlentities($name));

    $surname = post('surname');
    $surname = trim(htmlentities($surname));

    $age = post('age');
    $age = trim(htmlentities($age));

    $city = post('city');
    $city = trim(htmlentities($city));

    $username = post('username');
    $username = trim(htmlentities($username));

    $email = post('email');
    $email = trim(htmlentities($email));

    $password = post('pass');
    $repeatPass = post('repeatPass');

    $userExists = false;

    $handle = fopen('users/users.txt', 'a+');
        while (!feof($handle)){
            $user = trim(fgets($handle));
            $user = explode(' ', $user);
            $user = ['name' => $user[0], 'password' => $user[1]];
            if ($user['name'] === $username){
                $message = 'Username is already in use!';
                $userExists = true;
                break;
            }
        }

        if (!$userExists && $username !== ''){
            if ($password === $repeatPass){
                $password = sha1($password);
                fwrite($handle, "$username $password\r\n");

                header('Location: log-in.php');
            } else {
                echo 'Passwords does not match';
            }
        } else if ($username === ''){
            echo $message;
        } else {
            echo 'Invalid username!';
        }
    fclose($handle);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My website: Register</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<?php include 'header.php'?>
<section>
    <h3>Fill in the register form:</h3>
    <form action="" method="post">
        <table>
            <tr><td><label for="name">Name:</label></td><td><input type="text" name="name" id="name"></td></tr>
            <tr><td><label for="surname">Surname:</label></td><td><input type="text" name="surname" id="surname"></td></tr>
            <tr><td><label for="age">Age:</label></td><td><input type="number" name="age" id="age"></td></tr>
            <tr><td><label for="city">City:</label></td><td><input type="text" name="city" id="city"></td></tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr><td><label for="username">Username:</label></td><td><input type="text" name="username" id="username" required><output><?=$message?></output></td></tr>
            <tr><td><label for="email">Email:</label></td><td><input type="email" name="email" id="email" required></td></tr>
            <tr><td><label for="pass">Password:</label></td><td><input type="password" name="pass" id="pass" required></td></tr>
            <tr><td><label for="repeatPass">Repeat password:</label></td><td><input type="password" name="repeatPass" id="repeatPass" required></td></tr>
        </table>

        <br>
        <input type="submit" name="submit" value="Register">
    </form>
</section>
</body>
</html>
