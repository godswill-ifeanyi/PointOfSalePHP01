<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Excellent Digital Express Limited</title>
    <link href="img/favicon.png" rel="icon">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/mobile-styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    

    <!--Navigation-->
    <nav class="hide">
    <div onclick="window.location.href='../index.php'">
            <img src="img/favicon.png" alt="">
            <label><h4>Excellent Digital Express Limited</h4></label>
        </div>

        <div class="navigation">
            <ul>
                <img src="icons/close.svg" id="menu-close" alt="">
                <li><a href="#" class="active">Logistics</a></li>
            </ul>
            <img src="images/menu.png" id="menu-btn" alt="">
        </div>
    </nav>

    <section id="course-inner" class="hide">
    <div class="form hide">
        <form action="includes/loginscript.php" method="post">
            <h3>Point of Sale</h3>
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">
            <div class="btn">
                <input class="brown" type="submit" name="submit" value="Login"><br>
            </div>
        </form>
    </div>
    <hr>
    
    </section>

    <!--Footer-->
    <?php
    include 'footer.php';
    ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/main.js"></script>

</body>
</html>