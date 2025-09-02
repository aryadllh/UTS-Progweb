<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <title>WELCOME TO iDiscuss</title>
</head>

<body>
    <?php
    require("partial/_header.php");?>
    <?php require("partial/_dbconnect.php");
?>
    <?php
$id=$_GET['catid'];
$sql="SELECT * FROM `category` WHERE category_id=$id";
$result = mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result))
{
    $catname=$row['category_name'];
    $catdesc=$row['category_description'];

}
?>
<?php
$showAlert = false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=="POST")
{
    //INSERT INTO DB
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];
    $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '0', '$id', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
    if($showAlert)
    {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS....!</strong> Your thread has been added successfully..!!!! Please wait for the community to respond
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}
?>

    <div class="conatiner my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> Forums </h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    
    <?php
    if(isset($_SESSION['Loggedin'])&& $_SESSION['Loggedin']==true)
    {
    echo '<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="'. $_SERVER["REQUEST_URI"] .'" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Problem Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted" >Keep your title as crisp as possible</small>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
              <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
    </div>';
    }
    else{
     echo '
     <div class="container">
     <p class="lead">
     You are not logged in. Please login to be able to start a Discussion.
     </p>
     </div>
     ';
    }
    ?>



    <div class="container" style="min-height:433px">
        <h1 class="py-2">Browse Questions</h1>
        <?php
$id=$_GET['catid'];
$sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
$result = mysqli_query($conn, $sql);
$noResult=true;
    while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $tid = $row['thread_id'];
        $thread_time=$row['timestamp'];

        echo ' <div class="media my-3">
        <img class="mr-3" src="img/user.png" width="84px" alt="Generic placeholder image">
        <div class="media-body">
        <p class="font-weight-bold my-0">Anonymous User at '.$thread_time.'</p>
          <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$tid.'">' . $title . '</a></h5>
          ' . $desc . '
        </div>
      </div>';

    }
    if($noResult)
    {
            echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Threads Found</p>
          <p class="lead">Be the first person to ask the question.</p>
        </div>
      </div>';
    }
?>






    </div>
    <?php
    require("partial/_footer.php");
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>