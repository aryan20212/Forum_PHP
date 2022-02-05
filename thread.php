<?php

require "utilities/conn.php";

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .cc {
            min-height: 300px;
        }
        body{
            overflow-wrap: break-word;
    }
    </style>
    <title>Welcome - to iDiscuss</title>
</head>

<body>
    <?php require "utilities/header.php";
    if (isset($_GET['threadid'])) {
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['thread_title'];
            $description = $row['thread_desc'];
            $thusid = $row['thread_user_id'];
        }
    }


    ?>



    <!-- Main body -->
    <div class="container">
        <div class="p-5 mb-4 mt-4 rounded-3" style="background-color: #e9ebf0;">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"><?php echo $name ?></h1>
                <p class="col-md-8 fs-4"><?php echo $description; ?></p>
                <hr class="my-4">
                <p>This is peer to peer forum for sharing knowledge with other.<br>
                    No Spam / Advertising / Self-promote in the forums is not allowed.
                    Do not post copyright-infringing material.
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                </p>
                <p>Posted by:<b> <?php echo $thusid;   ?></b></p>
            </div>
        </div>
    </div>

    <div class="container">
<!-- Start hare make login to post a comment and after watch code with harry video to proceed dont make anything by your own will ok warned!! -->

        <h2> <?php if (isset($_SESSION['verified']) && $_SESSION['verified'] == true  ) {
            echo "Comment";
        }
        else {
            echo "Login to comment";
        }
        ?></h2> 
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?> " method="POST">
            <div class="mb-3">
                <!-- <label for="exampleFormControlTextarea1" class="form-label">Comment</label> -->
                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"<?php 
                if (isset($_SESSION['verified']) && $_SESSION['verified'] == true  ) {
                    echo "";
                }
                else {
                    echo " disabled";
                }
                ?> ></textarea>
            </div>
            <button type="submit" class="btn btn-primary" <?php if (isset($_SESSION['verified']) && $_SESSION['verified'] == true  ) {
                    echo "";
                }
                else {
                    echo " disabled";
                } ?>  ><?php 
                if (isset($_SESSION['verified']) && $_SESSION['verified'] == true  ) {
                    echo "Post comment";
                }
                else {
                    echo "Login to post comment";
                }
                ?></button>
        </form>
    </div>

    <div class="container cc">
        <h2 class="text-center">Answers</h2>
        <?php
        $insertsucc = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $comment = $_POST['comment'];
            $comment = str_replace("<" , "&lt;", $comment);
            $comment = str_replace(">" , "&gt;", $comment);
            
            if (isset($_SESSION['verified']) && $_SESSION['verified'] == true ) {
                    $nameoc = $_SESSION['name'];
                $sql = "INSERT INTO `comments` ( `comment_text`, `comment_by`, `thread_id`, `comment_time`) VALUES ('$comment', '$nameoc', '$id', current_timestamp());";
                $result = mysqli_query($con, $sql);
                $insertsucc = true;
            }
            }

        ?>

        <?php
        $sqlt = "SELECT * FROM `comments` WHERE thread_id = $id";
        $resultt = mysqli_query($con, $sqlt);
        $nores = true;
        while ($row = mysqli_fetch_assoc($resultt)) {
            $nores = false;
            $comment_text = $row['comment_text'];
            //    $comment_time = $row['comment_time'];
            $cr = date_create($row['comment_time']);
            // "Y/m/d H:i:s"
            // " g  D, j M Y "
            $time = date_format($cr, " j M Y ");
            echo '<div class="d-flex  my-4">
   <div class="flex-shrink-0">
     <img src="img/images.jpeg" width="60px" alt="Profile picture">
   </div>
   <div class="flex-grow-1 ms-3 mb-3">
   <p class="fw-bold mb-2 "> <span class=" rounded-pill badge bg-secondary"> ' . $row['comment_by']  .    '  On ' . $time . '</span></p>
   
     <p>' . $comment_text  . '</p>
     
   </div>
 </div>';
        }
        if ($nores) {
            echo '<div class="h-100 mb-4 p-5 bg-light border rounded-3">
   <h2>No reply yet!</h2>
   <p>Wait for the community to reply</p>
   <button class="btn btn-outline-secondary" type="button">Ask question</button>
 </div>
 </div>';
        }
        ?>


        <!-- <div class="d-flex my-3 ">
      <div class="flex-shrink-0">
        <img src="utilities/images.jpeg" width="60px" alt="...">
      </div>
      <div class="flex-grow-1 ms-3 mb-3">
        <h5 style="text-decoration: none;" >Media Body</h5>
        This is some content from a media component. You can replace this with any content and adjust it as needed.
      </div>
    </div> -->



    </div>
    <?php require "utilities/footer.php" ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>