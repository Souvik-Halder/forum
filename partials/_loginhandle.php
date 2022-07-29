


<?php
$showError = false;
$login=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` where user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $login=true;
            $_SESSION['loggedin'] = true;
           $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
        
            $showError=true;
            
        } 
        
         header("Location: /Forum/forum.php");  
    }
    header("Location: /Forum/forum.php?loginsuccess=true");  
 }

?>