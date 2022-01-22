<?php include("inc/session.php"); ?>


<?php

$error = 0;
$email_err = "";
$pass_err = "";
$pass1_err = "";
$pass2_err = "";
$err = "";


if($_POST){

    $email = $_POST['email'];  
    $cpassword = $_POST['cpassword'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    //validation

    if(!$email){
        $email_err = "Email is empty.";
        $error = 1;
    }

    if(!$cpassword){
        $pass_err = "Current password is empty.";
        $error = 1;
    }

    if(!$password1){
        $pass1_err = "New password is empty.";
        $error = 1;
    }
  
      if(!$password2){
        $pass2_err = "Confirmed Password is empty.";
        $error = 1;
    }
  
      if($password1 != $password2){
        $password2_err = "Password not match.";
        $error = 1;
    }

    if(!$error) {

        // connect database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "sample";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "select *from users where email = '$email' and password = '$cpassword'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

       
        if($count == 1){ 
            $id=$row['id'];
            $sql = "UPDATE users SET password ='$password1' WHERE id=$id";

            
            if(mysqli_query($conn, $sql)) {
                echo '<script>alert("Password update succesfully.")</script>';
            } else {
                echo "Error updating password.";
            }
        }  
        else{  
           $err = "Failed to reset password. Invalid username or password.";  
        }     
    }

}


?>




<?php include("inc/header.php"); ?>
<?php include("inc/navbar.php"); ?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-5 text-center pt-3">
            <h5>Reset Password</h5>
        </div>
    </div>
</div>

<div class="row justify-content-center py-3">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <form action="reset_password.php" method="POST">

                    <span class="text-primary"><?php echo $err; ?></span>

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="" name="email">
                        <span class="text-danger"><?php echo $email_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="cpwd" class="form-label">Current Password:</label>
                        <input type="password" class="form-control" id="cpwd" placeholder="" name="cpassword">
                        <span class="text-danger"><?php echo $pass_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="pwd1" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="pwd1" placeholder="" name="password1">
                        <span class="text-danger"><?php echo $pass1_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="pwd2" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="pwd2" placeholder="" name="password2">
                        <span class="text-danger"><?php echo $pass2_err; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>