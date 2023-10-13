<?php
require_once '../../functions/userfunctions.php';
require_once '../../config/dbcon.php'; 

if (isset($_POST['place_order'])) {
    $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $notes = mysqli_real_escape_string($conn,$_POST['notes']);
    $payment_mode = mysqli_real_escape_string($conn,$_POST['payment_mode']);
    $balance = mysqli_real_escape_string($conn,$_POST['balance']);
    isset($balance) ? $balance : 0;
    $status = isset($_POST['status']) ? 1 : 0;
    $all_total = mysqli_real_escape_string($conn,$_POST['all_total']);

    $rand = rand(1000,9999);
    $invoice_no = "#12".$rand;
    
    if ($all_total <= 0) {
        echo '
                <script>
                alert("Order Items Empty");
                window.location.href="index.php";
                </script>';

    } 
    else if ($name == null) {
        echo '
                <script>
                alert("Customer\'s Name Required");
                window.location.href="index.php";
                </script>';
    }
    else if ($phone == null) {
        echo '
                <script>
                alert("Customer\'s Phone no. Required");
                window.location.href="index.php";
                </script>';
    }
    else {

        $insert_query = "INSERT INTO orders (invoice_no,user_id,customer_name,phone,notes,total_price,balance,payment_mode,status) 
        VALUES ('$invoice_no','$user_id','$name','$phone','$notes','$all_total','$balance','$payment_mode','$status')";
        $insert_query_run = mysqli_query($conn,$insert_query);


        if ($insert_query_run) {

            $order_id = mysqli_insert_id($conn);

            $order_items = getTotalOrderItems($user_id);
                if (mysqli_num_rows($order_items) > 0) {
                foreach($order_items as $item) {

                    $prod_id = $item['prod_id'];
                    $prod_qty = $item['prod_qty'];
                    $discount = $item['discount'];
                    $sql = "SELECT * FROM products WHERE id='$prod_id'"; 
                    $result = mysqli_query($conn,$sql);
                    $info = mysqli_fetch_assoc($result);

                    $prod_name = $info['name'];
                    $prod_amount = $info['amount'];


                    $total = ($info['amount'] * $item['prod_qty']) - $item['discount'];

                    $insert_query2 = "INSERT INTO store_order_items (order_id,prod_id,prod_name,price,qty,discount,total) 
                    VALUES ('$order_id','$prod_id','$prod_name','$prod_amount','$prod_qty','$discount','$total')";
                    $insert_query_run2 = mysqli_query($conn,$insert_query2);

                    $select_query = "SELECT * FROM products WHERE id='$prod_id'";
                    $select_query_run = mysqli_query($conn,$select_query);
                    $product = mysqli_fetch_array($select_query_run);

                    $reduced_qty = $product['qty'] - $prod_qty;

                    $update_query = "UPDATE products SET qty='$reduced_qty' WHERE id='$prod_id'";
                    $update_query_run = mysqli_query($conn,$update_query);
                        }
                    }

            if ($insert_query_run2) {

                $delete_query = "DELETE FROM order_items WHERE user_id='$user_id'";
                $delete_query_run = mysqli_query($conn,$delete_query);
            
                echo '
                <script>
                alert("Order Created Successfully");
                window.location.href="print-data.php?id='.$order_id.'";
                </script>';
            } else {
                echo '
                <script>
                alert("Order Items Empty");
                window.location.href="index.php";
                </script>';
            }
        }
    }
}

?>