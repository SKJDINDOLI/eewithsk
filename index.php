<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="admin/style.css">
    <style>
    
    </style>
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
      $sql="SELECT*FROM `eesk`.`notes`";
      $result=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($result))  
             {
             
             echo "<div class='container'>
                  <div class='category'>".$row['category']."</div>
                  <h1 class='heading'>".$row['heading']."</h1>
                  <h2 class='subHeading'>".$row['subHeading']."</h2>
                  <div class='img'><img src='' alt=''></div>
                  <div class='content'>“".$row['content']."”</div>
              </div>";
          }
      
      ?>
       <script>
        
       </script>
    </main>
</body>
<script src="admin/script.js"></script>
</html>
