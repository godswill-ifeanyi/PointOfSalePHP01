<?php

error_reporting(0);

if (isset($_POST['submit'])) {
    require_once '../config/dbcon.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo '<script>
                alert("Empty Fields");
                window.location="../index.php";
                </script>';
        exist();
    } else {
        $sql = "SELECT * FROM users WHERE  username = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo '<script>
                alert("SQL Error");
                window.location="../index.php";
                </script>';
            exist();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($password, $row['password']);
                if ($passCheck == false) {
                    echo '<script>
                alert("Wrong Password");
                window.location="../index.php"; 
                </script>';
                    exist();
                } elseif ($passCheck == true) {
                    session_start();
                    $_SESSION['sessionid'] = $row['id'];
                    $_SESSION['sessionuser'] = $row['username'];
                    $_SESSION['sessionusertype'] = $row['usertype'];
                    $_SESSION['session_adminid'] = $row['admin_id'];

                    if ($row['usertype'] == 'admin') {
                        echo '<script>
                        alert("Login Successful");
                        window.location="../admin/index.php"; 
                        </script>';
                        exist();
                    } else if ($row['usertype'] == 'customer-care') {
                        echo '<script>
                        alert("Login Successful");
                        window.location="../customer-care/pages/index.php"; 
                        </script>';
                        exist();
                    } else if ($row['usertype'] == 'manager') {
                        echo '<script>
                        alert("Login Successful");
                        window.location="../manager/index.php"; 
                        </script>';
                        exist();
                    } else {
                        header("location: ../index.php");
                    }
                } else {
                    echo '<script>
                    alert("Wrong Password");
                    window.location="../index.php";
                    </script>';
                    exist();
                }

            } else {
                echo '<script>
                alert("No user found");
                window.location="../index.php";
                </script>';
                exist();
            }
        }
    }

} else {
    echo '<script>
                alert("Forbidden access");
                window.location="../index.php";
                </script>';
    exist();
}

?>
