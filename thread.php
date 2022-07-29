<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss</title>
<style>
#ques{
    min-height:250px;
} 
</style> 
</head>

<body>
<?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php';?>
    
    
    <?php
     $id=$_GET['threadid'];
     $sql="SELECT * FROM `threads` where thread_id=$id";
     $result = mysqli_query($conn,$sql);
     while($row=mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];  
        $sql2= "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];
     }
    ?>
      <?php
     $showAlert= false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
  $comment = $_POST['comment'];
  $comment = str_replace("<", "&lt;", $comment);
  $comment = str_replace(">", "&gt;", $comment); 
        $sno = $_POST['sno'];
        
        
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp())";
        
        $result = mysqli_query($conn, $sql);
        
     $showAlert=true;
     if($showAlert){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success!</strong> Your comment has been successufully submitted.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
     }
        
    }
    ?>

    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title ;?> forum</h1>
            <p class="lead">
             <?php echo $desc ;?>
            </p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="fw-bold">Posted by-<?php echo $posted_by; ?> </p>
        </div>
    </div>
    <?php
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
   echo ' <div class="container">
    <h1 >Post a commnet</h1>
    <form action="'. $_SERVER["REQUEST_URI"].'" method="POST">

    
  <div class="form-floating my-3">
  
  <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment"></textarea>
  <label for="exampleTextarea">write your comment</label>
  <input type="hidden"  name="sno" value="'. $_SESSION["sno"] .'">
</div>
 
  
  <button type="submit" class="btn btn-success">Post comment</button>
</form>
    </div>';
     }
     else{
        echo '
        <div class="container">
        <h1 class="py-2">Post a comment </h1> 
           <p class="lead"><b>You are not logged in. Please login to be able to post a comment</b></p>
        </div>
        ';
     }

    ?>
    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noResult=true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult=false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        
        $comment_time = $row['comment_time']; 
        $comment_by=$row['comment_by'];
        $sql2= "SELECT user_email FROM `users` WHERE sno='$comment_by'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        echo '<div class="media my-3">
            <img src="img/user.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
               <p class="font-weight-bold my-0"><b>'. $row2['user_email'] .'</b> '. $comment_time. '</p>  '. $content . '
            </div>
        </div>';

        
        
        


        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Records Found</h1>
              <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            </div>
          </div>';
        }
        ?>
  
    </div>
    




   

    <?php require 'partials/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>