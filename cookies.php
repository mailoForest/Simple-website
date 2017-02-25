<?php

setcookie("Logged-in", 'no', strtotime('+2 hours'), '/', "localhost");

header('Location: index.php');