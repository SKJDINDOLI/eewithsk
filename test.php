<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="admin/style.css">
</head>

<body>
   <?php
    echo '
    <header>
            <div class="logo"><img src="admin/img/ee with sk-logos_transparent.png" alt="logo"></div>
            <div class="nav">
                <nav>
                    <ul>
                        <li><a href="index.php">Notes</a></li>
                        <li><a href="test.php">Test</a></li>
                        <li><a href="admin">Admin Panel</a></li>
                    </ul>
                </nav>
            </div>
    </header>';
    ?>
    <main>
        
       <?php
        include 'admin/partials/connection.php';
        $sql="SELECT*FROM `eesk`.`question`";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))  
        {
        echo '<div class="test">
        <div class="question">'.$row['que'].'</div>
        <div class="option">(a)'.$row['option1'].'</div>
        <div class="option">(b)'.$row['option2'].'</div>
        <div class="option">(c)'.$row['option3'].'</div>
        <div class="option">(d)'.$row['option4'].'</div>
        <div class="option">(e)'.$row['option5'].'</div>
        <hr>
        <div class="answer">ANS:'.$row['queExp'].'</div>
        </div>';
        }
       ?>
        
        <div class="test">
            <div class="question">What is unit of charge?</div>
            <div class="option">(a) ohm</div>
            <div class="option">(b) qulam</div>
            <div class="option">(c) ampere</div>
            <div class="option">(d) watt</div>
            <div class="answer">ANS: (b) qulam</div>
        </div>
        <div class="test">
            <div class="question"> If 1 A current flows in a circuit, the number of electrons flowing through this
                circuit is</div>
            <div class="option">(a) 0.625 × 10 <sup> 19</sup></div>
            <div class="option">(b) 1.6 × 10<sup>19</sup></div>
            <div class="option">(c) 1.6 × 10 <sup>- 19</sup></div>
            <div class="option">(d) 0.625 × 10 <sup>- 19</sup></div>
            <div class="answer">ANS: (a) 0.625 × 10<sup>19</sup></div>
        </div>
        <div class="test">
            <div class="question"> The resistivity of the conductor depends on</div>
            <div class="option">(a) area of the conductor.</div>
            <div class="option">(b) length of the conductor.</div>
            <div class="option">(c) type of material.</div>
            <div class="option">(d) none of these.</div>
            <div class="answer">ANS: (c) type of material.</div>
        </div>
        <div class="test">
            <div class="question"> The resistance of a conductor of diameter d and length l is R Ω. If the diameter of
                the conductor is halved and its length is doubled, the resistance will be</div>
            <div class="option">(a) R Ω</div>
            <div class="option">(b) 2R Ω</div>
            <div class="option">(c) 4R Ω</div>
            <div class="option">(d) 8R Ω</div>
            <div class="answer">ANS: (d) 8R Ω </div>
        </div>
        <div class="test">
            <div class="question">How many coulombs of charge flow through a circuit carrying a current of 10 A in 1
                minute? </div>
            <div class="option">(a) 10</div>
            <div class="option">(b) 60</div>
            <div class="option">(c) 600</div>
            <div class="option">(d) 1200</div>
            <div class="answer">ANS: (c) 600</div>
        </div>
    </main>
</body>
<script src="admin/script.js"></script>
</html>