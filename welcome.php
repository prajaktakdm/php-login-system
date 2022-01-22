<?php include("inc/session.php"); ?>

<?php

if(!isset($_SESSION['name'])){
    echo "you are logged out";
    header("location:login.php");
}

?>


<?php include("inc/header.php"); ?>
<?php include("inc/navbar.php"); ?>

<div class="container">
    <span class="d-flex justify-content-end">
            <a href="logout">Logout</a>
    </span>

    
    <div class="row py-3">
        <h3>Welcome <?php echo $_SESSION['name'] ?></h3>
    </div>
</div>
