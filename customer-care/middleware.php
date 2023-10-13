<?php

if (!isset($_SESSION['sessionuser'])) {
    header("location:../index.php");
} elseif ($_SESSION['sessionusertype'] != 'customer-care') {
    header("location:../index.php"); 
}

?>