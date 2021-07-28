<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>iDiscuss-threadlist</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>


    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE category_id=$id ";
    $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)){
                    $catname=$row['category_name'];
                    $catdesc=$row['category_description'];
    }
    
    ?>


    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // Insert into thread on the db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        // $comment = $_POST['comment']; 

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 
        $sno = $_POST['sno']; 
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `dt`) VALUES 
        ( '$th_title ', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        } 
        }
    ?>




    <!--catagery satrterts form here -->
    <div class="container my-2">
        <div class="jumbotron m-1">
            <h1 class="display-4">welcome to <?php echo $catname  ?> Forum</h1>
            <p class="lead"><?php echo $catdesc  ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-success " href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <?php
    
// to find weather the user is singin or not 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==true){
  echo  '
  <div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="'. $_SERVER['REQUEST_URI'].'" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Problem Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
            possible</small>
        <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">

    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>';
}
else{
    echo'
        <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <h2>  <strong>Please!</strong>Singin to create a post/comment.</h2>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        </div>  
    ';
}
    ?>








    <div class="container">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        // $id = $_GET['catid'];
        // $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        // $result = mysqli_query($conn,$sql);
        // $noResult= true;
        // while ($row = mysqli_fetch_assoc($result)){
        //             $noResult= false;
        //             $id=$row['thread_id'];
        //             $title = $row['thread_title'];
        //             $desc=$row['thread_desc'];
          
 
     
     


    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc']; 
        $thread_time = $row['dt']; 
        $thread_user_id = $row['thread_user_id']; 
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        


        echo '
        <hr>       
        <div class="media my-3">
            <img src="user.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">'.
             '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid=' . $id. '">'. $title . ' </a></h5>
                '. $desc . ' </div>'.'<div class="font-weight-bold my-0"> Asked by: '. $row2['user_email'] . ' at '. $thread_time. '</div>'.
        '</div>
        <hr>';

        }
        // to show the no result
         // echo var_dump($noResult);
         if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Threads Found</p>
                        <p class="lead"> Be the first person to ask a question</p>
                    </div>
                 </div> ';
        }
    ?>





    </div>








    <?php include 'partials/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>