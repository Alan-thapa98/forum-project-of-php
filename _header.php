<?php 
    include 'partials/_dbconnect.php';
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" 
          aria-expanded="false">
            top Categary
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

          $sql = "SELECT 	category_name,	category_id  FROM `category` LIMIT 4"; 
          //limit there will show the only number that you had bben chogen or my can also add the sql of to by the page to W3school
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            
               echo' <li><a class="dropdown-item" href="Threadlist.php?catid='.$row['category_id'] .'">'.$row['category_name'].'</a></li>';
          }
        echo'  </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/forum/contact.php">Contact</a>
        </li>
      </ul>';
  // to find weather the user is singin or not 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==true){
   echo'
    <form class="d-flex" action="search.php" method="get">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success mx-2" type="submit">Search</button>
       </form>
      <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">'.$_SESSION['usereamil'].'</button>
        <a role="button" href="partials/_logout.php" class="btn btn-outline-primary">logout</a>
      </div>
  
'; 
}
else{
 echo' 

 
        <form class="d-flex" action="search.php" method="get">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success ml-2" type="submit">Search</button>
        </form>
      <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#singupModal">SignUp</button>
      </div>';
  }  

   echo'    </div>
          </div>
         </div>
        </div>
      </nav>';



  include 'partials/_loginModal.php';
  include 'partials/_singupModal.php';
if(isset( $_GET['singupsuccess'] ) && $_GET['singupsuccess'] == "true"){
  echo ' 
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Yes!</strong> your are logged now !
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
          </button>
    </div>';
}
// else{
//     echo ' 
//     <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
//       <strong>Error!</strong> Sorry we have some trable to login!
//           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                <span aria-hidden="true">&times;</span>
//           </button>
//     </div>';
// }




?>

<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</html>