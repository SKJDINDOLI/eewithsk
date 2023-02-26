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
      $total_entery=mysqli_num_rows($result);
      if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
        $entery=3;
        $show_entery=$page*$entery;
        $no_pages=$total_entery/$entery;
        if(is_float($no_pages)){
            $no_pages=(int)$no_pages+1;
    }
        $entery_start=$show_entery-$entery;
      $sql="SELECT * FROM `eesk`.`notes` ORDER BY `sno` DESC LIMIT $entery_start,$entery";
      $result=mysqli_query($conn,$sql);
      echo'<input type="hidden" name="page" class="page" id="page'.$page.'">';
      while($row=mysqli_fetch_assoc($result))  
             {
             
             echo "<div class='container'>
                  <div class='category'>".$row['category']."</div>
                  <div class='heading'>".$row['heading']."</div>
                  <div class=''></div>
                  <div class='subHeading'><img class='topic_img' src='admin/topic_img/".$row['sno'].$row['subHeading']."' alt='".$row['heading']." image'></div>
                  <div class='content'>“".$row['content']."”</div>
              </div>";
          }
      
      ?>
      <div class="pagination" id="pagination">
      <div class='edbtn'>
                <button class='prev btn' id='prev'>prev</button><?php
            for($k=1;$k<=$no_pages;$k++){
                    echo "
                <button class='p".$k." btn' id='p".$k."'>".$k."</button>
                ";
            }
            ?><button class='next btn'id='next'>next</button>
            </div>
            </div>
       <script>
        
       </script>
    </main>
</body>
<script src="admin/script.js"></script>
</html>
