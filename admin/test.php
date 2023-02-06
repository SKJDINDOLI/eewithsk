<?php
$success=false;
$failed=false;
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true){
    header("location:login.php");
}
include 'partials/connection.php';
$sql="CREATE TABLE `eesk`.`question` (`sno` INT(10) NOT NULL AUTO_INCREMENT, `que` TEXT(1000) NOT NULL, `option1` VARCHAR(250) NOT NULL, `option2` VARCHAR(250) NOT NULL, `option3` VARCHAR(250)  NOT NULL ,`option4` VARCHAR(250) NOT NULL, `option5` VARCHAR(250) NOT NULL,`queExp` TEXT(1000) NOT NULL, `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  , PRIMARY KEY(`sno`))";
$result=mysqli_query($conn,$sql);

if($_SERVER['REQUEST_METHOD']=='POST'){
 $que=$_POST['que'];
 $option1=$_POST['option1'];
 $option2=$_POST['option2'];
 $option3=$_POST['option3'];
 $option4=$_POST['option4'];
 $option5=$_POST['option5'];
 $queExp=$_POST['queExp'];   
 

 if( $que !=NULL  || $option1  !=NULL  || $option2 !=NULL  || $option3 !=NULL || $option4 !=NULL ||  $queExp !=NULL){
 $sql="INSERT INTO `eesk`.`question` (`sno`, `que`,`option1`,`option2`,`option3`,`option4`,`option5`,`queExp`,`date`) VALUES (NULL,'$que','$option1','$option2','$option3','$option4','$option5','$queExp',current_timestamp())";
$result=mysqli_query($conn,$sql);

if($result){
 $success="your question has been submitted";
$que=NULL;
$option1=NULL;
$option2=NULL;
$option3=NULL;
$option4=NULL;
$option5=NULL;
$queExp=NULL;
}else{
 $failed="your question has not been submitted";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php
    include 'partials/header.php';
    if($success){
        echo "<div class='onSubmit' id='onSubmit'>
        <img src='icon/cross.png' id='crossContact' alt='cross icon'>
        <p><span class='success'>Success</span>".$success."</p>
    </div>";
    }
    if($failed){
        echo "<div class='onSubmit' id='onSubmit'>
        <img src='icon/cross.png' id='crossContact' alt='cross icon'>
        <p><span class='failed'>Failed</span>".$failed."</p>
    </div>";}
    ?>
    <main>
        <div class="form">
            <h1>Question</h1>
            <form action="test.php" method="post">
                <textarea name="que" id="question" class="question" cols="30" rows="1"
                    placeholder="Question"></textarea>
                <input type="text" name="option1" placeholder="option 1"><br>
                <input type="text" name="option2" placeholder="option 2"><br>
                <input type="text" name="option3" placeholder="option 3"><br>
                <input type="text" name="option4" placeholder="option 4"><br>
                <input type="text" name="option5" placeholder="option 5"><br>
                <textarea name="queExp" id="queExp" cols="30" rows="1" placeholder="ANS and Explanation"></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>
       <?php
        include 'partials/connection.php';
       
       
 
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
<script src="script.js"></script>
</html>