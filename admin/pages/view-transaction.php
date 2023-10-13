<?php
session_start(); 
error_reporting(0);

require_once '../middleware.php';

require_once '../../functions/userfunctions.php';
require_once '../../config/dbcon.php';

$userid = $_SESSION['sessionid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../logo.png">
  <title>
    Transactions - Excellent Digital Express LTD
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="print.css" media="print">
</head>
<style>
  div, span, p, a, h3, h4, h6, th, td {
    color: black;
  }
</style>
<body>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h3>Excellent Digital Express LTD</h3>
                    <p>Peace Plaza 155 NTA Road, Mgbuoba, PHC</p>
                    <p>Phone no.: 08033826713</p>
                    <p>Email: <a href="">hassan_centrilift@yahoo.com</a></p>
                    <p>Wesbite: <a href="">www.excellentdigitalexpress.ng</a></p>
                </div>
                <?php
                    $order_id = $_GET['id'];
                    $orders = getOrders($order_id);
                    $info = mysqli_fetch_array($orders);
                ?>
                <div>
                    <h4>INVOICE</h4>
                    <p>Invoice no.: <?=$info['invoice_no'];?></p>
                    <p>Date: <?= date('d-m-y'); ?></p>
                </div>
            </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              <p style="width:100%;border-bottom:3px solid rgb(7, 7, 32);"></p>
                <table id="myTable" class="table table-bordered align-items-center mb-0">
                  <thead>
                    <tr><h6><i>Billed To: <?=$info['customer_name'];?></i></h6></tr>
                    <tr>
                    <th class="text-uppercase  text-xxs font-weight-bolder ps-2">Product</th>
                      <th class="text-uppercase text-xxs font-weight-bolder ps-2">Price</th>
                      <th class="text-uppercase text-xxs font-weight-bolder ps-2">QTY</th>
                      <th class="text-uppercase text-xxs font-weight-bolder ps-2">Discount </th>
                      <th class="text-uppercase text-xxs font-weight-bolder ps-2">Total </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $AllTotal = 0;
                      if (mysqli_num_rows($orders) > 0) {
                        foreach($orders as $item) {
                       
                        $order_id = $item['id'];
                        $sql2 = "SELECT * FROM store_order_items WHERE order_id='$order_id'";
                        $result2 = mysqli_query($conn,$sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            foreach($result2 as $order_item) {
                                $total = ($order_item['price'] * $order_item['qty']) - $order_item['discount'];
                                $AllTotal += $total;
                      ?>
                      <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$order_item['prod_name']?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?=$order_item['price']?></p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold "><?=$order_item['qty']?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold"><?=$order_item['discount']?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold"><?=$total;?></span>
                      </td>
                    </tr>
                  <?php } ?>
                        <tr>
                            <td></td><td></td><td></td>
                            <td class="align-middle text-center"><span class="text-black text-lg font-weight-bold">Grand Total:</span></td>
                            <td class="align-middle text-center"><span class="text-black text-lg font-weight-bold"><span style="color: green;font-weight: bold">&#8358;</span><?=$AllTotal;?></span></td>
                        </tr>
                        <?php
                        }
                    }
                  } ?>
                    
                  </tbody>
                </table>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p><i>Payment Mode:</i> <span><?=$info['payment_mode'];?></span></p>
                    </div>
              </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <p><i>Status:</i> <?php
                        $status = $info['status'];
                        if ($status == 1) {
                        ?>
                        <span>Completed</span>
                      <?php } ?>
                      <?php if ($status == 0) {
                        ?>
                        <span>Pending</span>
                      <?php } ?></p>
                    </div>
              </div>
              <div class="row mt-1">
                    <div class="col-md-12">
                        <p><i>Balance to be paid by Client:</i> <span><span style="color: green;font-weight: bold">&#8358;</span><?=$info['balance'];?></span></p>
                    </div>
              </div>
              <div class="row mt-1">
                    <div class="col-md-12">
                        <p><i>Notes:</i> <span><?=$info['notes'];?></span></p>
                    </div>
              </div>
              <div class="row mt-1">
                    <div class="col-md-12">
                        <p><i>Created At:</i> <span><?=$info['created_at'];?></span></p>
                    </div>
              </div>
            </div>

            <div class="row d-flex justify-content-end">
                <div class="col-md-2">
                <button class="badge badge-sm bg-gradient-primary border-0" onclick="window.location.href='transactions.php'"><i class="ni ni-bold-left"></i>Back</button>
                </div>
                <div class="col-md-2">
                <button class="badge badge-sm bg-gradient-success border-0" onclick="return window.print()">Print<i class="ni ni-cloud-download-95"></i></button>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>

  <script src="ajax.js"></script>
    </div>
</body>
</html>