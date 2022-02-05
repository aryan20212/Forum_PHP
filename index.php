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
  <script src="https://kit.fontawesome.com/d3882cfae1.js" crossorigin="anonymous"></script>

  <title>Welcome - to iDiscuss</title>
  
</head>

<body>
  
  <?php include "utilities/header.php" ?>
  <!-- <h1>hi</h1>      -->
  

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="img/photo-1526498460520-4c246339dccb.jpeg" class="d-block w-100" alt="Image">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="img/1.jpeg" class="d-block w-100" alt="Image">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="img/2.jpeg" class="d-block w-100" alt="Image">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- Main body -->
<div class="container">
  <h2 class="text-center mt-3">Browse - Forums</h2>
  <div class="row">
    <!-- Cards Here -->
    <?php
    $sql = "SELECT * FROM `catagory`";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $substr = substr($row['cat_description'], 0, 80);
      echo '<div class="col-md-4">

      <div class="card my-3" style="width: 18rem;">
        <img src="https://source.unsplash.com/400x200/?coding,' . $row['cat_name'] . '" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">' . $row['cat_name']   . '</h5>
          <p class="card-text">' . $substr . ' ...</p>
          <a href="thread_list.php?catid='. $row['cat_id'] .'" class="btn btn-primary">View thread</a>
        </div>
      </div>
    </div>';
    }

    ?>

    <!-- <div class="col-md-4">

      <div class="card my-3" style="width: 18rem;">
        <img src="https://source.unsplash.com/400x200/?computer,coding,python" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div> -->

    <!-- Cards end -->
  </div>
</div>
  <!-- <a href="#" class="btn btn-danger position-fixed bottom-0 end-0 m-3" style="z-index: 4;"><i class="fas fa-arrow-up"></i></a> -->

<?php require "utilities/footer.php" ?>



  
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>