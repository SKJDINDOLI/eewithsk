<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
    $login=true;
}else{
    $login=false;
}

echo '
<header>
        <div class="logo"><img src="img/ee with sk-logos_transparent.png" alt="logo"></div>
        <div class="nav">
            <nav>
                <ul>
                    <li><a href="index.php">Notes</a></li>
                    <li><a href="test.php">Test</a></li>';
                    if(!$login){
                    echo '
                    <li><a href="login.php">Login</a></li>';
                }if($login){
                  echo ' <li><a href="logout.php">Logout</a></li>';
                }
                echo '
                <li><a href="/eewithsk">User Panel</a></li>
                </ul>
            </nav>
        </div>
</header>';
?>
