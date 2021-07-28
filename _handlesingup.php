<?php 
$showError=FALSE;
if($_SERVER["REQUEST_METHOD"] == "POST"){
     include '_dbconnect.php';
    $email= $_POST['singupEmail'];
    $pass=$_POST['password'];
    $cpass =$_POST['cpassword'];
        // chick whether the email is exsist or not if exist all to continue
        $existSql="SELECT * FROM `users` WHERE user_email='$email'";
        $result=mysqli_query($conn,$existSql);
        $numRows= mysqli_num_rows($result);
        if($numRows >0){
           $showError ="These named email is already uesd .";
        
        }
        else{        
              if($pass==$cpass){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `dt`) VALUES
                 ('$email', '$hash', current_timestamp())";
                $result=mysqli_query($conn,$sql);
                    if($result){
                        $showAlert=true;
                        header("location: /forum/index.php?singupsuccess=true");
                        exit();
                    }
            }
            else{
                $showError ="These named email is already uesd .";
            }

        }
        header("Location: /forum/index.php?singupsuccess=false&error=$showError");
    }

// if($conn == true){
//     echo"connection is success";
// }
?>