<?php
$success=false;
$failed=false;
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true){
    header("location:login.php");
}
       include 'partials/connection.php';
       $sql="CREATE TABLE `eesk`.`notes` (`sno` INT(10) NOT NULL AUTO_INCREMENT, `category` VARCHAR(50) NOT NULL, `heading` VARCHAR(50) NOT NULL, `subHeading` VARCHAR(50) NOT NULL, `content` TEXT NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  , PRIMARY KEY(`sno`))";
       $result=mysqli_query($conn,$sql);
        if(isset($_GET['delete'])){
            $sno=$_GET['delete'];
            // $sql="SELECT `sno` FROM `eesk`.`notes` WHERE `sno`='$sno'";
            $sql="SELECT * FROM `eesk`.`notes` WHERE `sno`='$sno'";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
                if(file_exists("topic_img/".$sno.$row['subHeading'])){
                unlink("topic_img/".$sno.$row['subHeading']);
                }
            }
            
             
       $sql="DELETE FROM `eesk`.`notes` WHERE `notes`.`sno` =  '$sno' ";
        $result=mysqli_query($conn,$sql);
        
        if($result){
           $sql="DELETE FROM `eesk`.`comments` WHERE `comments`.`comid` = '$sno'";
           $result=mysqli_query($conn,$sql);
           if($result){
            $success="your notes with comments has been Deleted";
           }
            }else{     
            $failed="your notes has not been Deleted";
            }
        }
        if(isset($_GET['deletec'])){
            $sno=$_GET['deletec'];
            $sql="DELETE FROM `eesk`.`comments` WHERE `comments`.`sno` = '$sno'";
           $result=mysqli_query($conn,$sql);
           if($result){
            $success="your comment has been Deleted";
           }
            else{
            $failed="your comment has not been Deleted";
            }
        }
       if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['edsno'])){
        $sno=$_POST['edsno'];
        $category=$_POST['edcategory'];
        $heading=$_POST['edheading'];
        if(isset($_FILES['edsubheading'])){
        $topic_img_name=$_FILES['edsubheading']['name'];
        $topic_img_type=$_FILES['edsubheading']['type'];
        $topic_img_size=$_FILES['edsubheading']['size'];
        $topic_img_tmp_name=$_FILES['edsubheading']['tmp_name'];
        if($topic_img_type=="image/jpeg"|| $topic_img_type=="image/jpg" || $topic_img_type=="image/png"){
            move_uploaded_file("$topic_img_tmp_name","topic_img/".$sno.$topic_img_name);
            }else{
                $failed="please upload a image file in 'jpeg' or 'jpg' or 'png'";
            }
        }
        $content=$_POST['edcontent'];

        $content=str_replace("'","\'",  $content);
        $category=str_replace("'","\'",  $category);
        $heading=str_replace("'","\'",  $heading);
        if( $category !=NULL  || $heading !=NULL || $content !=NULL){
            $sql="UPDATE `eesk`.`notes` SET `category` = '$category', `heading` = '$heading', `subHeading` = '$topic_img_name', `content` = '$content' WHERE `notes`.`sno` = $sno ";
           $result=mysqli_query($conn,$sql);
           if($result){
           $success="your notes has been Updated";
            }else{
            $failed="your notes has not been Updated";
            }
        }
        }else{
        $category=$_POST['category'];
        $heading=$_POST['heading'];
        if(isset($_FILES['subheading'])){
            $topic_img_name=$_FILES['subheading']['name'];
            $topic_img_type=$_FILES['subheading']['type'];
            $topic_img_size=$_FILES['subheading']['size'];
            $topic_img_tmp_name=$_FILES['subheading']['tmp_name'];
            }
        $content=$_POST['content'];
        
        $content=str_replace("'","\'",  $content);
        $category=str_replace("'","\'",  $category);
        $heading=str_replace("'","\'",  $heading);
        if( ($category !=NULL  || $heading !=NULL || $content !=NULL) && ($topic_img_type==NULL||$topic_img_type=="image/jpeg" || $topic_img_type=="image/jpg" || $topic_img_type=="image/png")){
        $sql="INSERT INTO `eesk`.`notes` (`sno`, `category`, `heading`, `subHeading`, `content`, `date`) VALUES (NULL, '$category', '$heading', '$topic_img_name', '$content', current_timestamp())";
       $result=mysqli_query($conn,$sql);
       if($result){
       $success="your notes has been submitted";
       $sql="SELECT `sno` FROM `eesk`.`notes`";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
            $sno=$row['sno'];
            }
            if($topic_img_type=="image/jpeg"|| $topic_img_type=="image/jpg" || $topic_img_type=="image/png"){
            move_uploaded_file("$topic_img_tmp_name","topic_img/".$sno.$topic_img_name);
            }
        }else{
       $failed="your notes has not been submitted";
        }
    }
            
    }
} 
  if($_SERVER['REQUEST_METHOD']=='GET'){
    
      if(isset($_GET['comid'])){
         $comid=$_GET['comid'];
        $comment=$_GET['comment'];
        
         if( $comid !=NULL  || $comment !=NULL ){
            $sql="INSERT INTO `eesk`.`comments` (`comid`, `comment`) VALUES ('$comid', '$comment')";
           $result=mysqli_query($conn,$sql);
           if($result){
           $success="your comment has been submitted";
          
        }else{
            
           $failed="your comment has not been submitted";
        }
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
        <div id="blur">
        <div class="form" id="editNotes">
            <span id="cross">&times;</span>
            <div>
                <h1> Update Notes</h1>
            </div>
            <div class='container'>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="edsno" id="edsno"><br>
                <input type="text" name="edcategory" id="edcategory"class="category" placeholder="Category"><br>
                <input type="text" name="edheading" id="edheading" class="heading" placeholder="Heading" required><br>
                <input type="file" name="edsubheading" id="edsubheading" class="subHeading" placeholder="Sub Heading"><br>
                <textarea name="edcontent" id="edcontent" class="content" cols="30" rows="10" placeholder="Content"></textarea>
                <input type="submit" value="Update">
            </form>
            </div>
        </div>
        </div>
        <div class="form" id="submitNotes">
            <h1>Add Notes</h1>
            <div class='container'>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="text" name="category" id="category"class="category" placeholder="Category"><br>
                <input type="text" name="heading" id="heading" class="heading" placeholder="Heading" required><br>
                <input type="file" name="subheading" id="subheading" class="subHeading" placeholder="Sub Heading"><br>
                <textarea name="content" id="content" class="content" cols="30" rows="10" placeholder="Content"></textarea>
                <!-- <input type="button" name="addbtn" class="addbtn" id="addbtn" title="add sub heading and textarea" value="&#43;"> -->
                <input type="submit" value="Submit">
            </form>
            </div>
        </div> 
        <?php
      $sql="CREATE TABLE `eesk`.`comments` (`sno` INT(10) NOT NULL AUTO_INCREMENT, `comment` VARCHAR(50) NOT NULL, `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  , PRIMARY KEY(`sno`))";
      $result=mysqli_query($conn,$sql);
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
      $counte=0;
      echo'<input type="hidden" name="page" class="page" id="page'.$page.'">';
      while($row=mysqli_fetch_assoc($result))  
             {
                
             echo "<div class='container'>
                  <div class='category'>".$row['category']."</div>
                  <div class='heading'>".$row['heading']."</div>
                  <div class=''></div>
                  <div class='subHeading'><img class='topic_img' src='topic_img/".$row['sno'].$row['subHeading']."' alt='".$row['heading']." image'></div>
                  <div class='content'>".$row['content']."</div>
                  <div  class='comment'>
                    <h3>Comments</h3>
                    <form class='fcomment' id=cForm".$row['sno']." action='index.php#cForm".$row['sno']."' method='GET'>
                        <input type='hidden' name='comid' value='".$row['sno']."'>
                        <input type='text' name='comment'  maxlength='50' placeholder='Comment'><br>
                        <input type='submit' value='Submit'>
                    </form>
                    ";
                    $ucount=0;
                    $sql='SELECT*FROM `eesk`.`comments`WHERE `comid`='.$row['sno'];
                    $resultc=mysqli_query($conn,$sql);
                    while($rowc=mysqli_fetch_assoc($resultc)){
                        $ucount+=1;
                        echo "<div class='comshow'>
                        <div class='usern' id=".$ucount.">".$ucount."</div>
                        <div class='ucomshow'>".$rowc['comment']."</div>
                        <div class='edbtn'>
                  <button class='deletec btn'id=d".$rowc['sno'].">Delete</button>
                  </div>
                  </div>";
                    }
                   echo "
                   <hr>
                  </div>
                  <div class='edbtn'>
                  <button class='edit btn' id=e".$row['sno'].">Edit</button><button class='delete btn'id=d".$row['sno'].">Delete</button>
                  </div>
              </div>";
              
              $counte+=1;
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
<script src="script.js"></script>

</html>