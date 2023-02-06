<?php
       $success=false;
       $failed=false;
       include 'partials/connection.php';
       

       $sql="CREATE TABLE `eesk`.`users` (`sno` INT(10) NOT NULL AUTO_INCREMENT, `username` VARCHAR(50) NOT NULL, `password` VARCHAR(250) NOT NULL, `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  , PRIMARY KEY(`sno`), UNIQUE(`username`))";
       $result=mysqli_query($conn,$sql);
       
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $password=$_POST['password'];
        

         $sql="SELECT*FROM `eesk`.`users` WHERE `username`='$username'";
         $result=mysqli_query($conn,$sql);
         $num = mysqli_num_rows($result);
         
       if($num>0){
        $success=true;
    session_start();
    $_SESSION["loggedin"]=true;
    $_SESSION["username"]=$username;
    header("location:index.php");
    }
    else{
      $failed=true;   
    }
}


        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body>
    <?php
    include 'partials/header.php';
    if($success){
        echo "<div class='onSubmit' id='onSubmit'>
        <img src='icon/cross.png' id='crossContact' alt='cross icon'>
        <p><span class='success'>Success</span> you are logged in</p>
    </div>";
    }
    if($failed){
        echo "<div class='onSubmit' id='onSubmit'>
        <img src='icon/cross.png' id='crossContact' alt='cross icon'>
        <p><span class='failed'>Failed</span> you are not logged in</p>
    </div>";}
    ?>
    <main>
        <div class="form">
        <h1>Login</h1>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username"><br>
                <input type="password" name="password" placeholder="Password"><br>

                <input type="submit" value="Submit">
            </form>
        </div>
       
        
    </main>
</body>
<script src="script.js"></script>

</html>