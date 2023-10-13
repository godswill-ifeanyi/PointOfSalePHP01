<?php
require_once '../../config/dbcon.php';

if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "DELETE FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'User Deleted Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'SQL Code Error'
        ];
        echo json_encode($res);
        return false;
    }

}

if (isset($_POST['add_user'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($firstname == null || $lastname == null || $email == null || $username == null || $phone == null || $password == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $res = [
                'status' => 403,
                'message' => 'Username already taken'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (firstname,lastname,email,phone,username,usertype,password) VALUES ('$firstname','$lastname','$email','$phone','$username','$role','$hashedPass')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $res = [
                    'status' => 200,
                    'message' => 'User Added Successfully'
                ];
                echo json_encode($res);
                return false;
            }
            else {
                $res = [
                    'status' => 500,
                    'message' => 'SQL Code Error'
                ];
                echo json_encode($res);
                return false;
        }
        }

    }
}

if (isset($_POST['edit_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($firstname == null || $lastname == null || $role == null || $phone == null || $email == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $query = "UPDATE users SET firstname='$firstname',lastname='$lastname',email='$email',phone='$phone',usertype='$role' WHERE id='$user_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'User Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
        }

    }
}

if (isset($_POST['edit_pass'])) {
    $oldpassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    if ($oldpassword == null || $newpassword == null || $confirmpassword == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $sql = "SELECT * FROM users WHERE id='$user_id' ";
        $result = mysqli_query($conn,$sql);
        $info = mysqli_fetch_assoc($result);

        $passCheck = password_verify($oldpassword, $info['password']);

    if ($passCheck) {

        if ($newpassword != $confirmpassword) {
            $res = [
                'status' => 403,
                'message' => 'New Password do not match'
            ];
            echo json_encode($res);
            return false;
        } else {
            $hashedPass = password_hash($newpassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password='$hashedPass' WHERE id='$user_id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $res = [
                    'status' => 200,
                    'message' => 'Password Updated Successfully'
                ];
                echo json_encode($res);
                return false;
            }
            else {
                $res = [
                    'status' => 500,
                    'message' => 'SQL Code Error'
                ];
                echo json_encode($res);
                return false;
            }
        }

    } else {
        $res = [
            'status' => 405,
            'message' => 'Old Password Incorrect'
        ];
        echo json_encode($res);
        return false;
        }
    }
}

if (isset($_POST['add_cate'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['id']);
    $image = $_FILES['photo']['name'];

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);

    $photo = time().'.'.$image_ext;

    $dst = "../../uploads/".$photo;

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    if ($photo == null || $name == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $sql = "SELECT * FROM users WHERE id='$user_id'";
        $result = mysqli_query($conn,$sql);
        $info = mysqli_fetch_assoc($result);
        $username = $info['username'];

        move_uploaded_file($_FILES['photo']['tmp_name'], $dst);
        
        $query = "INSERT INTO categories (photo,name,created_by) VALUES ('$photo','$name','$username')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Category Added Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
            }
        }

}

if (isset($_POST['delete_cate'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['cate_id']);

    $query = "DELETE FROM categories WHERE id='$cate_id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Category Deleted Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'SQL Code Error'
        ];
        echo json_encode($res);
        return false;
    }

}

if (isset($_POST['edit_cate'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['id']);
    $old_image = mysqli_real_escape_string($conn, $_POST['oldphoto']);
    $image = $_FILES['photo']['name'];

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);

    $photo = time().'.'.$image_ext;

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    if ($name == null) {
        $res = [
            'status' => 422,
            'message' => 'Name is mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        if ($image != ""){
            $current_photo = $photo;
            $dst = "../../uploads/".$current_photo;
            move_uploaded_file($_FILES['photo']['tmp_name'], $dst);
            
            if (file_exists("../../uploads/".$old_image)) {
                unlink("../../uploads/".$old_image);
            }
        }
        else {
            $current_photo = $old_image;
        }
        
        $query = "UPDATE categories SET photo='$current_photo',name='$name' WHERE id='$cate_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Category Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
            }
        }
}

if (isset($_POST['delete_supp'])) {
    $supp_id = mysqli_real_escape_string($conn, $_POST['supp_id']);

    $query = "DELETE FROM suppliers WHERE id='$supp_id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Supplier Deleted Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'SQL Code Error'
        ];
        echo json_encode($res);
        return false;
    }

}

if (isset($_POST['add_supp'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if ($name == null || $email == null || $address == null || $phone == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
    
        $query = "INSERT INTO suppliers (name,email,phone,address) VALUES ('$name','$email','$phone','$address')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Supplier Added Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
    }
        

    }
}

if (isset($_POST['edit_supp'])) {
    $supp_id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if ($name == null || $email == null || $address == null || $phone == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
    
        $query = "UPDATE suppliers SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$supp_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Supplier Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
    }
        

    }
}

if (isset($_POST['add_product'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['id']);
    $image = $_FILES['photo']['name'];

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);

    $photo = time().'.'.$image_ext;

    $dst = "../../uploads/".$photo;

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category']);
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier']);

    if ($photo == null || $name == null || $qty == null || $amount == null || $category_id == null || $supplier_id == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $sql = "SELECT * FROM users WHERE id='$user_id'";
        $result = mysqli_query($conn,$sql);
        $info = mysqli_fetch_assoc($result);
        $username = $info['username'];

        move_uploaded_file($_FILES['photo']['tmp_name'], $dst);
        
        $query = "INSERT INTO products (category_id,supplier_id,name,amount,qty,photo,created_by) VALUES ('$category_id','$supplier_id','$name','$amount','$qty','$photo','$username')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Product Added Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
            }
        }

}

if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $query = "DELETE FROM products WHERE id='$product_id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Product Deleted Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'SQL Code Error'
        ];
        echo json_encode($res);
        return false;
    }

}

if (isset($_POST['edit_product'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['id']);
    $old_image = mysqli_real_escape_string($conn, $_POST['oldphoto']);
    $image = $_FILES['photo']['name'];

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);

    $photo = time().'.'.$image_ext;

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category']);
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier']);

    if ($name == null || $amount == null || $qty == null || $supplier_id == null || $category_id == null) {
        $res = [
            'status' => 422,
            'message' => 'Name is mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        if ($image != ""){
            $current_photo = $photo;
            $dst = "../../uploads/".$current_photo;
            move_uploaded_file($_FILES['photo']['tmp_name'], $dst);
            
            if (file_exists("../../uploads/".$old_image)) {
                unlink("../../uploads/".$old_image);
            }
        }
        else {
            $current_photo = $old_image;
        }
        
        $query = "UPDATE products SET photo='$current_photo',name='$name',amount='$amount',qty='$qty',category_id='$category_id',supplier_id='$supplier_id' WHERE id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Product Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
            }
        }
}

if (isset($_POST['change_profile'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    if ($firstname == null || $lastname == null || $phone == null || $email == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $query = "UPDATE users SET firstname='$firstname',lastname='$lastname',email='$email',phone='$phone' WHERE id='$user_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'User Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
        }

    }
}

if (isset($_POST['fetch_price'])) {

    $product_id=$_POST["product_id"];
    $result = mysqli_query($conn,"SELECT * FROM products where id='$product_id'");
    $info = mysqli_fetch_array($result);
    
    if ($info) {
        echo $info['amount'];
    } 
}

if (isset($_POST['change_password'])) {
    $oldpassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    if ($oldpassword == null || $newpassword == null || $confirmpassword == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $sql = "SELECT * FROM users WHERE id='$user_id' ";
        $result = mysqli_query($conn,$sql);
        $info = mysqli_fetch_assoc($result);

        $passCheck = password_verify($oldpassword, $info['password']);

    if ($passCheck) {

        if ($newpassword != $confirmpassword) {
            $res = [
                'status' => 403,
                'message' => 'New Password do not match'
            ];
            echo json_encode($res);
            return false;
        } else {
            $hashedPass = password_hash($newpassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password='$hashedPass' WHERE id='$user_id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $res = [
                    'status' => 200,
                    'message' => 'Password Updated Successfully'
                ];
                echo json_encode($res);
                return false;
            }
            else {
                $res = [
                    'status' => 500,
                    'message' => 'SQL Code Error'
                ];
                echo json_encode($res);
                return false;
            }
        }

    } else {
        $res = [
            'status' => 405,
            'message' => 'Old Password Incorrect'
        ];
        echo json_encode($res);
        return false;
        }
    }
}

if (isset($_POST['delete_order_item'])) {
    $order_item_id = mysqli_real_escape_string($conn, $_POST['order_item_id']);

    $query = "DELETE FROM order_items WHERE id='$order_item_id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Order Item Deleted Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'SQL Code Error'
        ];
        echo json_encode($res);
        return false;
    }

}

if (isset($_POST['delete_transaction'])) {
    $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);

    $query = "DELETE FROM orders WHERE id='$transaction_id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Transaction Deleted Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'SQL Code Error'
        ];
        echo json_encode($res);
        return false;
    }

}

if (isset($_POST['edit_trans'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $balance = mysqli_real_escape_string($conn, $_POST['balance']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    if ($status == null) {
        $res = [
            'status' => 422,
            'message' => 'All input fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    else {
    
        $query = "UPDATE orders SET balance='$balance', status='$status', notes='$notes' WHERE id='$order_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Transaction Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else {
            $res = [
                'status' => 500,
                'message' => 'SQL Code Error'
            ];
            echo json_encode($res);
            return false;
    }
        

    }
}

if (isset($_POST['invoice_search'])) {
    $inpText = mysqli_real_escape_string($conn,$_POST['query']);
    session_start();
    $userid = $_SESSION['sessionid'];

    $sql = "SELECT invoice_no FROM orders WHERE user_id='$userid' AND invoice_no LIKE '$inpText%'";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result) > 0) {
        foreach($result as $row) {
            echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['invoice_no'] . '</a>';
        }
    } else {
        echo '<p class="list-group-item border-1">No Record</p>';
      }
}

if (isset($_POST['contact_search'])) {
    $inpText = mysqli_real_escape_string($conn,$_POST['query']);

    $sql = "SELECT customer_name FROM orders WHERE customer_name LIKE '$inpText%'";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result) > 0) {
        foreach($result as $row) {
            echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['customer_name'] . '</a>';
        }
    } else {
        echo '<p class="list-group-item border-1">No Record</p>';
      }
}

if (isset($_POST['product_search'])) {
    $inpText = mysqli_real_escape_string($conn,$_POST['query']);

    $sql = "SELECT name FROM products WHERE name LIKE '$inpText%'";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result) > 0) {
        foreach($result as $row) {
            echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['name'] . '</a>';
        }
    } else {
        echo '<p class="list-group-item border-1">No Record</p>';
      }
}