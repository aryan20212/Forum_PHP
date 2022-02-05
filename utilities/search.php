<?php
require "conn.php";
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
<style>
    .container{
        min-height: 497px;
    }
</style>

<body>

  <?php if(isset($_GET['search_query'])){

  }
  else {
      header("location: /forum/index.php");
  } ?>
  <?php include "header.php" ?>

<div class="container">
<h1 class="my-3" >
  Search Results
  <small class="text-muted">For "<em><?php echo $_GET['search_query'] ?></em>"</small>
</h1>
<hr style="border-top: 1px solid #e59393;" >

<?php 
// $queryi = $_GET['search_query'];
$query = mysqli_real_escape_string( $con, $_GET['search_query']);
$keys = explode(" ",$query);
$sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`,`thread_desc`) against ('$query')";
foreach ($keys as $part_ser) {
    $sql .= " AND MATCH (`thread_title`,`thread_desc`) against ('$part_ser')";
}
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) <>0) {

    while($row = mysqli_fetch_assoc($result)){
        $description = $row['thread_desc'];
        $desc = substr($description,0,50 );
        echo '<h2> <a class="text-dark text-capitalize " href="/forum/thread.php?threadid=' . $row['thread_id']  . '"> ' . $row['thread_title'] . ' </a></h2>
        <p>' . $desc . '</p>
        <a href="/forum/thread.php?threadid=' . $row['thread_id']  . '" ><button class="btn btn-outline-danger" >Read more</button></a>
        <hr style="border-top: 1px solid #e59393;" >';
    }
}
else{
    echo '<h2>Sorry we have 0 search results for "<em>' . $_GET['search_query'] . '</em>" .
    Try again with another specific search term.</h2><hr style="border-top: 1px solid #e59393;" >';
}

?>

<!-- <h2> <a class="text-dark" href=""> Python </a></h2>
<p>Python is the object oriented programming language basically designed for Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequatur eveniet sunt maiores reiciendis similique molestiae saepe ea quam aut mollitia. Earum laudantium facere iusto, consectetur blanditiis fugiat ipsa. Dolor, explicabo?</p>
<button class="btn btn-outline-danger" >Read more</button>
<hr style="border-top: 1px solid #e59393;" > -->



</div>


  <?php require "footer.php" ?>

  
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>