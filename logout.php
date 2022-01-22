<?php include("inc/session.php"); ?>

<?php

    session_destroy();

    header("location:login.php");

?>

<?php include("inc/header.php"); ?>
<?php include("inc/navbar.php"); ?>