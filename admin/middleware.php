<?php

if (!isset($_SESSION['sessionuser'])) {
    header("location:../index.php");
} elseif ($_SESSION['sessionusertype'] != 'admin') {
    header("location:../index.php"); 
}

?>