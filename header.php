<header>
    <nav>
        <ul>
            <li><a href="./">Home</a></li>
            <li><a href="aboutMe.php">About Me</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="skills.php">My Programming Skills</a></li>
            <li><a href="mail.php">Contact Me</a></li>
            <?php
                $logged = $_COOKIE['Logged-in'];

                if ($logged === 'yes'){
                    echo '<li><a href="log-out.php">Log out</a></li>';
                } else if ($logged === 'no'){
                    echo '<li><a href="log-in.php">Log in</a></li><li><a href="register.php">Register</a></li>';
                }
            ?>
        </ul>
    </nav>
</header>