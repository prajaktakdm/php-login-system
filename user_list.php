<?php include("inc/session.php"); ?>
<?php

  // connect database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "sample";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $db);

  $sql = "SELECT * from users order by id desc";
  $result = mysqli_query($conn, $sql);
 ?>


<?php include("inc/header.php"); ?>
<?php include("inc/navbar.php"); ?>
  
<div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 pt-3 text-center">
          <h5>Users List</h5>
        </div>


        <div class="col-8 shadow py-2">
          <div class="table-responsive">

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                </tr>

                <?php
                while($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['mobile'];?></td>

                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>

</body>
</html>
