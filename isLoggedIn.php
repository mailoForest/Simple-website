<?php

if ($_COOKIE['Logged-in'] === 'no'){
    header('Location: log-in.php');
}
?>