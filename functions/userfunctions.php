<?php


function getAllActive($table) {
    global $conn;
    $query = "SELECT * FROM $table WHERE status='1' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);

}


function getAll($table) {
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);

}

function getAllDescending($table) {
    global $conn;
    $query = "SELECT * FROM $table ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);

}


function getAllUsers($table) {
    global $conn;
    $query = "SELECT * FROM $table WHERE usertype != 'admin' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);

}

function getAllPending($table) {
    global $conn;
    $query = "SELECT * FROM $table WHERE status = 0";
    return $query_run = mysqli_query($conn, $query);

}

function getAllConfirmed($table) {
    global $conn;
    $query = "SELECT * FROM $table WHERE status = 1";
    return $query_run = mysqli_query($conn, $query);

}

function getActivePlan($id) {
    global $conn;
    $query = "SELECT * FROM investment WHERE user_id ='$id' AND status=1";
    return $query_run = mysqli_query($conn, $query);

}

function getReferrals($id) {
    global $conn;
    $query = "SELECT * FROM referrals WHERE user_id ='$id' LIMIT 1";
    return $query_run = mysqli_query($conn, $query);

}

function getTotalProduct() {
    global $conn;
    $query = "SELECT * FROM products ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getSearchProduct($name) {
    global $conn;
    $query = "SELECT * FROM products WHERE name='$name' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getTotalCategories() {
    global $conn;
    $query = "SELECT * FROM categories ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getTotalSuppliers() {
    global $conn;
    $query = "SELECT * FROM suppliers ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getTotalOrderItems($userid) {
    global $conn;
    $query = "SELECT * FROM order_items WHERE user_id='$userid' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getTotalOrders() {
    global $conn;
    $query = "SELECT * FROM orders WHERE status=0"; 
    return $query_run = mysqli_query($conn, $query);
}

function getOrders($order_id) {
    global $conn;
    $query = "SELECT * FROM orders WHERE id='$order_id'"; 
    return $query_run = mysqli_query($conn, $query);
}

function getAllTransactions() {
    global $conn;
    $query = "SELECT * FROM orders ORDER BY id DESC"; 
    return $query_run = mysqli_query($conn, $query);
}

function getAllPendingTransactions() {
    global $conn;
    $query = "SELECT * FROM orders WHERE status=0 ORDER BY id DESC"; 
    return $query_run = mysqli_query($conn, $query);
}

function getTotalTransactions($userid) {
    global $conn;
    $query = "SELECT * FROM orders WHERE user_id='$userid' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getSearchTransaction($invoice_no) {
    global $conn;
    $query = "SELECT * FROM orders WHERE invoice_no='$invoice_no'"; 
    return $query_run = mysqli_query($conn, $query);
}

function getMySearchTransaction($invoice_no,$userid) {
    global $conn;
    $query = "SELECT * FROM orders WHERE user_id='$userid' AND invoice_no='$invoice_no'"; 
    return $query_run = mysqli_query($conn, $query);
}

function getSearchContact($customer_name) {
    global $conn;
    $query = "SELECT * FROM orders WHERE customer_name='$customer_name' ORDER BY id DESC"; 
    return $query_run = mysqli_query($conn, $query);
}

function getProduct($id) {
    global $conn;
    $query = "SELECT * FROM products WHERE id = '$id'";
    return $query_run = mysqli_query($conn, $query);
}

function getUsers($id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id = '$id'";
    return $query_run = mysqli_query($conn, $query);
}


?>  