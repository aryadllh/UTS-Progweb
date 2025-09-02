<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    require("_dbconnect.php");
     $user_email=$_POST['Lemail'];
     $user_pass=$_POST['Lpass'];

     //check if username exists
     $existsql="select * from `users` where user_email='$user_email'";
     $result=mysqli_query($conn,$existsql);
     $numRows=mysqli_num_rows($result);
     if($numRows==1)
     {
        $row=mysqli_fetch_assoc($result);
        if(password_verify($user_pass,$row['user_pass']))
        {
            session_start();
            $_SESSION['Loggedin']=true;
            $_SESSION['useremail']=$user_email;
            // echo "loggedin".$user_email;
            header("Location: /phpprac/FORUM/index.php");
            exit();
        }
     }
     else{
        header("Location: /phpprac/FORUM/index.php");
     }
}
?>