<?php include("inc/session.php"); ?>



<?php

$error = 0;
$email_err = "";
$pass_err = "";
$err = "";

if($_POST) { 

    $email = $_POST['email'];  
    $password1 = $_POST['password1']; 

    

    //validation

    if(!$email){
        $email_err = "Email is empty.";
        $error = 1;
    }

    if(!$password1){
        $pass_err = "Password is empty.";
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

        
        $sql = "select *from users where email = '$email' and password = '$password1'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

       
        if($count == 1){ 
            
            $_SESSION['email'] = $email;
            header("Location: welcome.php"); 

        }  
        else{  
           $err = "Login failed. Invalid username or password.";  
        }     
    }
}


?>

<?php include("inc/header.php"); ?>
<?php include("inc/navbar.php"); ?>



<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-5 text-center pt-3">
            <h5>Login</h5>
        </div>
    </div>
</div>

<div class="row justify-content-center py-3">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <form action="login.php" method="POST">

                    <span class="text-danger"><?php echo $err; ?></span>

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="" name="email">
                        <span class="text-danger"><?php echo $email_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="" name="password1">
                        <span class="text-danger"><?php echo $pass_err; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
