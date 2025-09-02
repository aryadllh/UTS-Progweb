<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST") 
{
    require("_dbconnect.php");
     $user_email=$_POST['signupEmail'];
     $user_pass=$_POST['spassword'];
     $user_cpass=$_POST['scpassword'];

     //check if username exists
     $existsql="select * from `users` where user_email='$user_email'";
     $result=mysqli_query($conn,$existsql);
     $numRows=mysqli_num_rows($result);
     if($numRows>0)
     {
        $showError="Email already exists";
     }
     else{
        if($user_pass==$user_cpass)
        {
            $hash=password_hash($user_pass,PASSWORD_DEFAULT);//we use Password_default as its is default algorithm for hash function
            $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $showAlert=true;
                header("Location: /phpprac/FORUM/index.php?signupsuccess=true");
                exit();
            }
        }
        else
        {
            $showError="Passwords do not match";
            // header("Location: /phpprac/FORUM/index.php?signupsuccess=false&error=$showError");
        }
     }
     header("Location: /phpprac/FORUM/index.php?signupsuccess=false&error=$showError");
}
?>