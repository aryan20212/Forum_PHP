<?php
session_start();
include "loginmodal.php";
include "signmodal.php";
require "conn.php";

//  
?>




<!-- Very important divs please dont remove it -->
</div>
</div>
</div>



<?php
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true') {
  echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  $snid = $_SESSION['snid'];
  $sql = "SELECT * FROM `users` WHERE `sno` = '$snid'";
  $result = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['verified'] = true;
    $_SESSION['name'] = $row['name'];
  }
}
if (isset($_GET['passntmatch']) && $_GET['passntmatch'] == 'true') {
  echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Password not matched ! 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['noaccount']) && $_GET['noaccount'] == 'true') {
  echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> There is no account of that username !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>




<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php if (isset($_SESSION['verified']) && $_SESSION['verified']==true ) {
        echo "Welcome ". $_SESSION['name'];
      } 
      else{
        echo 'iDiscuss';
      }
      ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/index.php">About</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Catagories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
          $sql = "SELECT * FROM `catagory` LIMIT 5";
          $result = mysqli_query($con,$sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '   <li><a class="dropdown-item" href="/forum/thread_list.php?catid='. $row['cat_id'] .'">'. $row['cat_name'] . '</a></li>';
          

          }
          ?>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/index.php">Contact</a>
        </li>
      </ul>
      <?php
        if(isset($_GET['search_query'])){
          $query = $_GET['search_query'];
        }
        else{
          $query = "";
        }
      if (isset($_SESSION['verified']) && $_SESSION['verified']==true ) {
        
        echo '<form class="d-flex" action="/forum/utilities/search.php" >
        <input autocomplete="off" maxlength="30" value="'  . $query .  '" class="form-control me-2" name="search_query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mr-1" type="submit">Search</button>
        </form>
        <a href="utilities/logout.php" ><button class="btn ms-1 btn-danger mr-1">Logout</button></a>
        ';
      }
      else{
        echo '<form class="d-flex" action="/forum/utilities/search.php" >
        <input autocomplete="off" maxlength="30" value="'  . $query .  '" class="form-control me-2" name="search_query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mr-1" type="submit">Search</button>
      </form><div class="log">
      <button class="ms-1 btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
    </div>
    <div class="sign">
      <button class=" mx-1 btn btn-danger" data-bs-toggle="modal" data-bs-target="#signmodal">Signup</button>
    </div>';
      }
      ?>
      
      
      
    </div>
  </div>
</nav>

<script src="logic.js"></script>