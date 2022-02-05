<?php
$insertsucc = false;
require "utilities/conn.php";


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .cc {
      min-height: 300px;
    }
    body{
      overflow-x: wrap;
    }
  </style>
  <title>Welcome - to iDiscuss</title>
</head>

<body>
  <?php require "utilities/header.php";


  if (isset($_GET['catid'])) {
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `catagory` WHERE cat_id=$id";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $name = $row['cat_name'];
      $description = $row['cat_description'];
    }
  } else {
    header("location: /forum/index.php");
  }
  ?>


  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $thread_title = $_POST['title'];
    $thread_title = str_replace("<" , "&lt;", $thread_title);
    $thread_title = str_replace(">" , "&gt;", $thread_title);
    $thread_desc = $_POST['desc'];
    $thread_desc = str_replace("<" , "&lt;", $thread_desc);
    $thread_desc = str_replace(">" , "&gt;", $thread_desc);
    if (isset($_SESSION['verified']) && $_SESSION['verified'] == true ) {
      $nametd = $_SESSION['name'];
      $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ('$thread_title', '$thread_desc', '$id', '$nametd', current_timestamp())";
      $result = mysqli_query($con, $sql);
      $insertsucc = true;
    }
    // echo $thread_desc ;
    // echo $thread_title;
    // echo $id;
  }
  if ($insertsucc) {
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your thread has been added! Wait for the community to respond!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

  <!-- Main body -->
  <div class="container">
    <div class="p-5 mb-4 mt-4 rounded-3" style="background-color: #e9ebf0;">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Welcome to <?php echo $name ?> forums</h1>
        <p class="col-md-8 fs-4"><?php echo $description; ?></p>
        <hr class="my-4">
        <p>This is peer to peer forum for sharing knowledge with other.<br>
          No Spam / Advertising / Self-promote in the forums is not allowed.
          Do not post copyright-infringing material.
          Do not post “offensive” posts, links or images.
          Do not cross post questions.
        </p>
        <button class="btn btn-primary btn-lg" type="button">Learn more</button>
      </div>
    </div>
  </div>
  <div class="container my-3">


    <!-- Modal -->
    <div class="modal fade" id="question" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ask question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <form action="<?php echo $_SERVER['REQUEST_URI']; ?> " method="POST">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Question title</label>
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Make your title as short as possible</div>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Elaborate your concern</label>
                  <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>




                <button type="submit" class="btn btn-primary mb-3">Post Question</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

    <button class="btn btn-primary <?php if (isset($_SESSION['verified']) && $_SESSION['verified']== true ) {
      echo "";

    }
    else {
      echo "disabled";
    } ?>" data-bs-toggle="modal" data-bs-target="#question"><?php if (isset($_SESSION['verified']) && $_SESSION['verified']== true ) {
      echo "Ask Question";
    }
    else {
      echo "Login to Ask Questions";
    } ?></button>
  </div>



  <div class="container cc">
    <h2 class="text-center">Browse questions</h2>
    <?php
    $sqlt = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
    $resultt = mysqli_query($con, $sqlt);
    $nores = true;
    while ($row = mysqli_fetch_assoc($resultt)) {
      $nores = false;
      $cr = date_create($row['time']);
      // "Y/m/d H:i:s"
      // " g  D, j M Y "
      $time = date_format($cr, " j M Y ");
      // $time = date_format($cr, " g:i A  D, j M Y ");
      echo '<div class="d-flex  my-4">
  <div class="flex-shrink-0">
    <img src="img/images.jpeg" width="60px" alt="Profile picture">
  </div>
  <div class="flex-grow-1 ms-3 mb-3">
    <h5><a class="text-dark" style="text-decoration: none;" href="/forum/thread.php?threadid=' . $row['thread_id'] . '" >' . $row['thread_title'] . '</a><span class=" ms-2 rounded-pill badge bg-secondary">Posted by ' . $row['thread_user_id']  .  '  On ' . $time  . '</span></h5>
    ' . $row['thread_desc'] . '
  </div>
</div>';
    }
    if ($nores) {
      echo '<div class="h-100 mb-4 p-5 bg-light border rounded-3">
  <h2>No question posted yet !!</h2>
  <p>Be the first to ask a question</p>
  <button class="btn btn-outline-secondary" type="button">Ask question</button>
</div>
</div>';
    }
    ?>
    <!-- <div class="d-flex  my-4">
      <div class="flex-shrink-0">
        <img src="utilities/images.jpeg" width="60px" alt="Profile picture">
      </div>
      <div class="flex-grow-1 ms-3 mb-3">
        <h5 title="Posted by' . ' Anonymous user ' . 'on ' . $time . '" ><a class="text-dark" style="text-decoration: none;" href="/forum/thread.php?threadid=' . $row['thread_id'] . '" >Hello this is aryan</a><span class=" ms-2 rounded-pill badge bg-secondary">Posted On july 7 2021</span></h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad beatae, voluptates suscipit molestias molestiae earum laudantium amet? Libero officiis commodi, iure, illo dicta tenetur deleniti explicabo praesentium voluptas voluptate doloribus.
      </div>
    </div> -->
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



  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="/utilities/logic.js"></script>
</html>