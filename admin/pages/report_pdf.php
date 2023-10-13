
<?php
session_start();

require_once '../middleware.php';

require_once '../../functions/userfunctions.php';
require_once '../../config/dbcon.php';

$userid = $_SESSION['sessionid'];

$type = $_GET['report'];



if ($type == 'products') {
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../logo.png">
  <title>
    Products - Excellent Digital Express LTD
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
  
</head>
<body onload="return window.print()">
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>All Products</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="myTable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Qty</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Supplier</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created_by</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $products = getTotalProduct();
                      if (mysqli_num_rows($products) > 0) {
                        foreach($products as $item) {
                        ?>
                    <tr>
                    <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold "><img src="../../uploads/<?=$item['photo']?>" alt="Product Image" width="100vmin"></span>
                      </td> 
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$item['name']?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold ">N<?=$item['amount']?></span>
                      </td> 
                      <?php 
                        $qty = $item['qty'];
                        if ($qty > 0) {
                      ?>
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold "><?=$item['qty']?></span>
                      </td> 
                      <?php
                      } ?>
                      <?php 
                        $qty = $item['qty'];
                        if ($qty <= 0) {
                      ?>
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold ">0</span>
                      </td> 
                      <?php
                      } ?>
                      <td class="align-middle text-left">
                      <?php
                        $category_id = $item['category_id'];
                          $sql = "SELECT * FROM categories WHERE id='$category_id'"; 
                          $result = mysqli_query($conn,$sql);
                          $info = mysqli_fetch_assoc($result);
                          ?>
                        <span class="text-secondary text-xs font-weight-bold "><?=$info['name']?></span>
                      </td> 
                      <td class="align-middle text-left">
                        <?php
                        $supplier_id = $item['supplier_id'];
                          $sql = "SELECT * FROM suppliers WHERE id='$supplier_id'"; 
                          $result = mysqli_query($conn,$sql);
                          $info = mysqli_fetch_assoc($result);
                          ?>
                        <span class="text-secondary text-xs font-weight-bold "><?= $info['name'];?></span>
                      </td> 
                      
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold"><?=$item['created_by']?></span>
                      </td>
                    </tr>
                  <?php
                    }
                  } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
          
    </div>

    <!--   Core JS Files   -->
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
</body>
</html>

<?php
} else if ($type == 'categories') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../logo.png">
  <title>
    Categories - Excellent Digital Express LTD
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
</head>
<body onload="return window.print()">
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>All Categories</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="myTable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created_by</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $categories = getTotalCategories('categories');
                      if (mysqli_num_rows($categories) > 0) {
                        foreach($categories as $item) {
                        ?>
                    <tr>
                    <td class="align-middle text-left">
                      <h6 class="mb-0 text-sm mx-3"><?=$item['name']?></h6>
                      </td>
                      </td>
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold "><img src="../../uploads/<?=$item['photo']?>" width="100vmin" alt="Category Image"></span>
                      </td>
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold"><?=$item['created_by']?></span>
                      </td>
                    </tr>
                  <?php
                    }
                  } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
        
    </div>

    <!--   Core JS Files   -->
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
</body>
</html>

<?php
} else if ($type == 'suppliers') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../logo.png">
    <title>
    Suppliers - Excellent Digital Express LTD
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
</head>
<body onload="window.print()">
<div class="container-fluid py-4">
        <div class="row">
        <div class="col-12">
            <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>All Suppliers</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                <table id="myTable" class="table align-items-center mb-0">
                    <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $suppliers = getTotalSuppliers('suppliers');
                        if (mysqli_num_rows($suppliers) > 0) {
                        foreach($suppliers as $item) {
                        ?>
                    <tr>
                        <td>
                        <div class="d-flex py-1">
                            <div>
                            
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$item['name']?></h6>
                            </div>
                        </div>
                        </td>
                        <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold " ><?= $item['email'];?></span>
                        </td>
                        <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold " ><?= $item['phone'];?></span>
                        </td>
                        <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold " ><?= $item['address'];?></span>
                        </td>
                    </tr>
                    <?php
                    }
                    } ?>
                    
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
        
        
    </div>
    
<!--   Core JS Files   -->
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
</body>
</html>
<?php
} else if ($type = 'transactions') {
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
</head>
<body onload="return window.print()">
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>All Transactions</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="myTable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Invoice No.</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created By</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balance</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $orders = getAllTransactions($userid);
                      if (mysqli_num_rows($orders) > 0) {
                        foreach($orders as $item) {
                        ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$item['invoice_no']?></h6>
                          </div>
                        </div>
                      </td>
                      <?php
                        $user_id = $item['user_id'];
                        $sql = "SELECT * FROM users WHERE id='$user_id'";
                        $result = mysqli_query($conn,$sql);
                        $info = mysqli_fetch_array($result);
                      ?>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?=$info['username']?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?=$item['created_at']?></p>
                      </td>
                      <td class="align-middle text-left">
                        <span class="text-secondary text-xs font-weight-bold "><?=$item['total_price']?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?=$item['balance']?></span>
                      </td>
                      <?php
                        $status = $item['status'];
                        if ($status == 1) {
                        ?>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">Completed</span>
                      </td>
                      <?php } ?>
                      <?php if ($status == 0) {
                        ?>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">Pending</span>
                      </td>
                      <?php } ?>
                    </tr>
                  <?php
                    }
                  } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
    </div>
    
<!--   Core JS Files   -->
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
</body>
</html>

<?php
} 
?>