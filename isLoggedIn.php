<?php

if (!isset($_COOKIE['Logged-in'])){
    header("Location: cookies.php");
}

if ($_COOKIE['Logged-in'] === 'no'){
    header('Location: log-in.php');
}
?>