<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include '_dbconnect.php';
    
    
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signuppassword'];
    $cpass = $_POST['signupcpassword'];


    
    $existSql = "SELECT * FROM `users` WHERE username = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        
        $showError = "Username Already Exists";
    }
    else{
        
        if(($pass == $cpass)){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            
            
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
           
            
            if($result){
                $showAlert = true;
                header("Location: /Forum/forum.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
    
    header("Location: /Forum/forum.php?signupsuccess=false&error");
}
    
?>