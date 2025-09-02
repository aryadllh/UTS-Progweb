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
$id=$_GET['threadid'];
$sql="SELECT * FROM `threads` WHERE thread_id=$id";
$result = mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result))
{
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];

}
?>
<?php
$showAlert = false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=="POST")
{
    //INSERT INTO comments DB 
    $th_content = $_POST['comment'];
    $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_time`) VALUES ( '$th_content', '$id', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
    if($showAlert)
    {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS....!!!!!!!</strong> Your comment has been added successfully..!!!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}
?>
    <div class="conatiner my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title ?> </h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>This is peer to peer forum.No Spam/Advertising/ Self promotion in the foruns is not allowed. Do not post copyright infringing material.Don not post "offensive" posts, links or images. Do not cross post questions. Remain respectful to other members</p>
           <p>Posted by:<b> Vaibhav</b></p>
        </div>
    </div>


    <div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Type your comment</label>
              <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
          </form>
    </div>
    <div class="container" style="min-height:433px">
        <h1 class="py-2">Discussions</h1>
        <?php
$id=$_GET['threadid'];
$sql="SELECT * FROM `comments` WHERE thread_id=$id";
$result = mysqli_query($conn, $sql);
        $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
        $content = $row['comment_content'];
        $cid = $row['comment_id'];
        $comment_time=$row['comment_time'];
        echo ' <div class="media my-3">
        <img class="mr-3" src="img/user.png" width="84px" alt="Generic placeholder image">
        <div class="media-body">
        <p class="font-weight-bold my-0">Anonymous User at '.$comment_time.'</p>
          ' . $content . '
        </div>
      </div>';

    }
    if($noResult)
    {
            echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Previous Discussion Available.</p>
          <p class="lead">Be the first person to start the discussion.</p>
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