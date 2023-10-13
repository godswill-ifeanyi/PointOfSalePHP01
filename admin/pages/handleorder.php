<?php
session_start();
require_once '../../config/dbcon.php';

if (isset($_POST['scope'])) {
    $scope = $_POST['scope'];

    switch($scope) {
        case "add":
            $prod_id = $_POST['prod_id'];
            $discount = $_POST['discount'];
            $prod_qty = $_POST['prod_qty'];
            $user_id = $_SESSION['sessionid'];

            $insert_query = "INSERT INTO order_items (user_id,prod_id,discount,prod_qty) VALUES ('$user_id','$prod_id','$discount','$prod_qty')";
            $insert_query_run = mysqli_query($conn,$insert_query);

            if ($insert_query_run) {
                echo 201;
            } else {
                echo 500;
            }

            break;
        default:
            echo 500;

    }

}

?>