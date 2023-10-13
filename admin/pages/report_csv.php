<?php
require_once '../../functions/userfunctions.php';
require_once '../../config/dbcon.php';

$type = $_GET['report'];
$file_name = $type.'xls';

$mapping_filenames = [
    "suppliers" => "Supplier Report",
    "products" => "Product Report",
    "transactions" => "Transaction Report",
    "categories" => "Category Report",
];
$file_name = $mapping_filenames[$type].'.xls';
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");


// Pull Data From Database
if ($type == 'products') {
    $data = getAllDescending('products');
    $products = mysqli_fetch_all($data);
    $is_header = true;
        
    foreach($products as $product) {
        if ($is_header) {
            $row = [
                'id',
                'category_id',
                'supplier_id',
                'product_name',
                'product_amount',
                'product_qty',
                'product_image',
                'created_by'
            ];
        $is_header = false;
        echo implode("\t", $row) . "\n";
    }
        echo implode("\t", $product) . "\n";
    }
}
else if ($type == 'suppliers') {
    $data = getAllDescending('suppliers');
    $suppliers = mysqli_fetch_all($data);
    $is_header = true;
        
    foreach($suppliers as $supplier) {
        if ($is_header) {
            $row = [
                'id',
                'supplier_name',
                'supplier_email',
                'phone_no',
                'address'
            ];
        $is_header = false;
        echo implode("\t", $row) . "\n";
    }
        echo implode("\t", $supplier) . "\n";
    }
}
else if ($type == 'transactions') {
    $data = getAllDescending('orders');
    $transactions = mysqli_fetch_all($data);
    $is_header = true;
        
    foreach($transactions as $transaction) {
        if ($is_header) {
            $row = [
                'id',
                'user_id',
                'invoice_no',
                'customer_name',
                'phone_no',
                'notes',
                'total_price',
                'balance',
                'payment_mode',
                'status',
                'created_at'
            ];
        $is_header = false;
        echo implode("\t", $row) . "\n";
    }
        echo implode("\t", $transaction) . "\n";
    }
}
else if ($type == 'categories') {
    $data = getAllDescending('categories');
    $categories = mysqli_fetch_all($data);
    $is_header = true;
        
    foreach($categories as $transaction) {
        if ($is_header) {
        $row = [
            'id',
            'category_name',
            'category_image',
            'created_by'
        ];
        $is_header = false;
        echo implode("\t", $row) . "\n";
    }
        echo implode("\t", $transaction) . "\n";
    }
}
?>