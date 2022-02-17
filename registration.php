<?php include("inc/session.php"); ?>


<?php

  $error = 0;
  $name_err = "";
  $email_err = "";
  $mobile_err = "";
  $pass_err = "";
  $pass2_err = "";
  $password2_err = "";



  if($_POST) {

    // get data
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $mobile = $_POST['mobile'] ?? null;
    $password1 = $_POST['password1'] ?? null;
    $password2 = $_POST['password2'] ?? null;
    
    if(strlen($name) <= 3){
      $error = 1;
      $name_err="Name should be greater than 3 characters.";
    }

    // validation
    if(!$name){
      $name_err = "Name is empty.";
      $error = 1;
    }

    // if (preg_match("/\d/", $name)) {
    //   $name_err = "Name should not conatain any digit.";
    //   $error = 1;
    // }
      
    if(!$email){
      $email_err = "Email is empty.";
      $error = 1;
    }

    if(strlen($mobile) != 10){
      $error = 1;
      $mobile_err="Mobile number should be 10 digit.";
    }

    if(!$mobile){
        $mobile_err = "Mobile number is empty.";
        $error = 1;
      }

    // if(strlen($password1) != 8){
    //   $error = 1;
    //   $pass_err = "Password should be 8 digit.";
    // }

    if(!$password1){
      $pass_err = "Password is empty.";
      $error = 1;
    }

    if($password1){
      if (strlen($password1) < 8 || strlen($password1) > 16) {
        $pass_err = "Password should be min 8 characters and max 16 characters";
        $error = 1;
      }
      if (!preg_match("/\d/", $password1)) {
        $pass_err = "Password should contain at least one digit";
        $error = 1;
      }
      if (!preg_match("/[A-Z]/", $password1)) {
        $pass_err = "Password should contain at least one Capital Letter";
        $error = 1;
      }
      if (!preg_match("/[a-z]/", $password1)) {
        $pass_err = "Password should contain at least one small Letter";
        $error = 1;
      }
      if (!preg_match("/\W/", $password1)) {
        $pass_err = "Password should contain at least one special character";
        $error = 1;
      }
      if (preg_match("/\s/", $password1)) {
        $pass_err = "Password should not contain any white space";
        $error = 1;
      }
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

    
    // connect Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "sample";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    // echo "Connected successfully";


    // check if email is already registered

    // store data in the database
    $sql = "INSERT INTO users (name, email, mobile, password)
      VALUES ('$name', '$email', '$mobile', '$password1')";

        $r = mysqli_query($conn, $sql);

        if($r) {
          $_SESSION['name'] = $name;
          $_SESSION['email'] = $email;
          $_SESSION['password'] = $password1;
          header("Location: user_list.php");
        }
        else
          echo "failed: ".mysqli_error($conn);

    }
  }
?>



<?php include("inc/header.php"); ?>
<?php include("inc/navbar.php"); ?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header d-flex justify-content-center">
          <h4>Register</h4>
        </div>
        <div class="card-body">        
          

          <form action="registration.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Name:</label>
              <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
              <span class="text-danger"><?php echo $name_err; ?></span>
            </div>

            <div class="mb-3 mt-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
              <span class="text-danger"><?php echo $email_err; ?></span>
            </div>

            <div class="mb-3 mt-3">
              <label for="mobile" class="form-label">Mobile No.:</label>
              <input type="number" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile">
              <span class="text-danger"><?php echo $mobile_err; ?></span>
            </div>

            <div class="mb-3">
              <label for="pwd1" class="form-label">Password:</label>
              <input type="password" class="form-control" id="pwd1" placeholder="Enter password" name="password1">
              <span class="text-danger"><?php echo $pass_err; ?></span>
              
            </div>
            
            <div class="mb-3">
              <label for="pwd2" class="form-label">Confirm Password:</label>
              <input type="password" class="form-control" id="pwd2" placeholder="Confirm password" name="password2">
              <span class="text-danger"><?php echo $pass2_err; ?></span>
              <span class="text-danger"><?php echo $password2_err; ?></span>
            </div>
            

            <button type="submit" class="btn btn-primary">Register</button>
          </form>


        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>