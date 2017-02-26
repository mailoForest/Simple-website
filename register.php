<?php
if (!isset($_COOKIE['Logged-in'])){
    setcookie("Logged-in", 'no', strtotime('+2 hours'), '/', "localhost");
    header("Location: register.php");
}
function post($index){
    return $_POST[$index];
}

require_once 'messages.php';

$name = '';
$surname = '';
$age = '';
$city = '';
$username = '';
$email = '';

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

    if (preg_match("/^[\w.-]{4,}$/", $username) < 1){
        $invalidUsername[0] = true;
    }

    $handle = fopen('users/users.txt', 'r');
        while (!feof($handle)){
            $user = trim(fgets($handle));
            if ($user === $username){
                $usernameExists[0] = true;
                break;
            }
        }
    fclose($handle);

    if (!(preg_match("/\S{6,}/", $password) && preg_match("/[A-Z]+/", $password) && preg_match("/\d+/", $password) && preg_match("/\W+/", $password))){
        $invalidPassword[0] = true;
    }
    if ($password !== $repeatPass){
        $passwordsMatch[0] = false;
    }

    if (preg_match('/^[A-Za-z]+[\w.-]{4,}@[a-z.-]+[.]{1}[a-z]{2,3}$/', $email) < 1){
        $invalidEmail[0] = true;
    }
    if (!is_numeric($age) || $age > 80 || $age < 5){
        $invalidAge[0] = true;
    }
    if ($name === '' || $surname === '' || $city === ''){
        $inputEmpty[0] = true;
    }

    if (!$usernameExists[0] && !$invalidUsername[0] && !$invalidPassword[0] && $passwordsMatch[0] && !$invalidEmail[0] && !$invalidAge[0] && !$inputEmpty[0]){
        $handle = fopen('users/users.txt', 'a+');
            fwrite($handle, "$username\r\n");
        fclose($handle);

        $password = sha1($password);

        $handle = fopen("users/$username.txt", 'a+');
            fwrite($handle, "Name=$name\r\n");
            fwrite($handle, "Surname=$surname\r\n");
            fwrite($handle, "Age=$age\r\n");
            fwrite($handle, "City=$city\r\n");
            fwrite($handle, "Email=$email\r\n");
            fwrite($handle, "Password=$password");
        fclose($handle);

        header("Location: log-in.php");
    }
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
    <output><?= $inputEmpty[0] ? $inputEmpty[1] : '' ?></output>
    <form action="" method="post">
        <table>
            <tr><td><label for="name">Name:</label></td>
                <td><input type="text" name="name" id="name" value="<?= $name ?>"></td>
            </tr>
            <tr>
                <td><label for="surname">Surname:</label></td>
                <td><input type="text" name="surname" id="surname" value="<?= $surname ?>"></td>
            </tr>
            <tr>
                <td><label for="age">Age:</label></td>
                <td><input type="number" name="age" id="age" value="<?= $age ?>"><output><?= $invalidAge[0] ? $invalidAge[1] : '' ?></output></td>
            </tr>
            <tr>
                <td><label for="city">City:</label></td>
                <td><input type="text" name="city" id="city" value="<?= $city ?>"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" name="username" id="username" value="<?= $username ?>" required>
                    <output><?= $usernameExists[0] ? $usernameExists[1] : ($invalidUsername[0] ? $invalidUsername[1] : '') ?></output></td>
            </tr>

            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" value="<?= $email ?>" required><output><?= $invalidEmail[0] ? $invalidEmail[1] : '' ?></output></td>
            </tr>
            <tr>
                <td><label for="pass">Password:</label></td>
                <td><input type="password" name="pass" id="pass" required><output><?= $invalidPassword[0] ? $invalidPassword[1] : '' ?></output></td>
            </tr>
            <tr>
                <td><label for="repeatPass">Repeat password:</label></td>
                <td><input type="password" name="repeatPass" id="repeatPass" required><?= !$passwordsMatch[0] ? $passwordsMatch[1] : '' ?></td>
            </tr>
        </table>

        <br>
        <input type="submit" name="submit" value="Register">
    </form>
</section>
</body>
</html>
