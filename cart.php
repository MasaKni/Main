<?php

session_start();
$qu = 0;
$total = 0;
/*
$_SESSION[“qty”][i] Stores the quantity for each product
$_SESSION[“amounts”][i] Stores the price from each product
$_SESSION[“cart”][i] Identifies which items have been added to the cart
$_SESSION[“total”] Stores the total cost

The sessions are actually arrays so in the case of:
$_SESSION[“qty”][i]
 */

if($_SESSION['isLoggedIn'] == 0 ) {
    header("Location: logIn.php");
}
else {

    $products = array("Chocolate Glazed Peanut Butter Filled Donut", "Cinnamon Apple Baked Donuts",
        "Oreo Donut", "Chocolate Donut",
        "Red Velvet Donut", "chocolate stuffed macaroons",
        "Mint, Strawberry and Raspberry Macaroon Box", "Chocolate Macaroons",
        "Mint Macaroons", "Rainbow Macaroons",
        "Christmas cookies", "Deluxe Signature Cookie Basket",
        "Gluten-Free Holiday Sugar Cookies", "Gingerbread Cookies",
        "maple donuts", "vanilla glazed donut",
        "burned caramel glazed donut", "Strawberry Macarons",
        "toffee macaroons", "Ultimate Easter macaroon box",
        "Xmas truffles", "Gluten Free Peanut Butter Oatmeal Cookies",
        "birthday cookies", "chocolate chip cookies",
        "French strawberry tart", "Mexican chocolate pecan tart",
        "pumpkin pie", "carrot cheesecake",
        "No bake cheese cake with strawberry topping", "Instant Strawberry Topped Vegan Cheesecake",
        "Vegan lemon blueberry cheesecake", "Chocolate Cake with chocolate icing",
        "Chiffon cake", "Walnut cake",
        "Coconut angel cake", "Apple Pie");
    $amounts = array("8.00", "5.00", "8.00", "4.00",
        "8.00", "10.00", "20.00", "15.00",
        "15.00", "20.66", "3.00", "18.77",
        "5.33", "2.00", "6.89", "5.66",
        "6.99", "12.99", "12.99", "20.00",
        "15.99", "3.99", "17.66", "2.00",
        "45.00", "40.89", "18.00", "15.55",
        "20.99", "30.00", "30.00", "15.99",
        "18.00", "19.87", "12.87", "18.00");


    $i = $_SESSION["pro"];
    echo $i;
    $qua = $_SESSION["q"];
    echo "quantity = ".$qua;


    $price='';
    //$q = $_COOKIE["quantity"];
    $nm='';
    $conn = mysqli_connect("localhost","admin","123456","sprinkles");

    if (mysqli_connect_error()) {
        echo "Can't connect to database" ;
        die();
    }
    else {
        $cat=$_COOKIE['cat'];$nam = $_COOKIE['name'];
        $strQry ="SELECT id FROM `product` WHERE `category`= '$cat' and `name` ='$nam' ";
        $res= $conn->query($strQry);
        $data= mysqli_fetch_assoc($res);
        $id=$data['id'];
        $strQry ="INSERT INTO `purshased` (P_id,ordered) values ('$id',1)";
        $res= $conn->query($strQry);
        $row = mysqli_fetch_assoc($res);

        //Add
        //if ( isset($_GET["add"]) ) {
        //$i = $_GET["add"];
        $qty = $_SESSION["qty"][$i] + $qua;
        $_SESSION["qty"][$i] = $qua;
        $_SESSION["amounts"][$i] = $amounts[$i] * $qua;
        $totalP = $_SESSION["amounts"][$i];
        $_SESSION["cart"][$i] = $i;
        //}

        //Reset
        if ( isset($_GET['reset']) ) {
            if ($_GET["reset"] == 'true') {
                unset($_SESSION["qty"]); //The quantity for each product
                unset($_SESSION["amounts"]); //The amount from each product
                unset($_SESSION["total"]); //The total cost
                unset($_SESSION["cart"]); //Which item has been chosen
            }
        }

        //Delete
        if ( isset($_GET["delete"]) ) {
            $i = $_GET["delete"];
            $qty = $_SESSION["qty"][$i];
            $qty--;
            $_SESSION["qty"][$i] = $qty;
            //remove item if quantity is zero
            if ($qty <= 0) {
                $_SESSION["amounts"][$i] = 0;
                unset($_SESSION["cart"][$i]);
            }
            else {
                $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
            }
        }


        $cat = $_COOKIE['cat'];
        $nm = $_COOKIE['name'];
        $strQry ="SELECT * FROM `product` WHERE `name` ='$nm' ";
        $res= $conn->query($strQry);
        $row = mysqli_fetch_assoc($res);


    }
}

?>

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="index.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">


        <!-- Shortcut Icon -->
        <link rel="shortcut icon" href="images/cupcakeIcon.png">



        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="s/vendor/bootstrap/css/bootstrap.min.css">

        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
        <!-- owl carousel-->
        <link rel="stylesheet" href="s/vendor/owl.carousel/assets/owl.carousel.css">
        <link rel="stylesheet" href="s/vendor/owl.carousel/assets/owl.theme.default.css">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="s/css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="s/css/custom.css">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="s/vendor/font-awesome/css/font-awesome.min.css">

        <!-- Needed -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <style>
            header{
                position: fixed;
                width: 100%;
                top: 0;
                z-index: 2;
            }
        </style>
    </head>


    <body>



    <!-- Navigation Bar -->
    <header class="header mb-5">

        <nav class="navbar navbar-expand-lg">

            <div class="container">

                <a onclick="window.location.href='index.php'" class="navbar-brand home">
                    <img src="images/cupcake-icon-small.png" alt="logo" class="d-none d-md-inline-block" >
                    <img src="images/cupcake-icon-small.png" alt="logo" class="d-inline-block d-md-none">
                    <span class="sr-only">go to homepage</span>
                </a>

                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>


                </div>

                <div id="navigation" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a onclick="window.location.href='index.php'" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item dropdown menu-large">
                            <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Menu<b class="caret"></b></a>


                            <ul class="dropdown-menu megamenu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <h5><a href="cakes.html">Cakes & Cheesecakes</a></h5>
                                            <ul class="list-unstyled mb-3">
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'carrot cheesecake'" >Carrot Cake Cheesecake</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'No bake cheese cake with strawberry topping'">Strawberry Cheesecake(not baked)</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Instant Strawberry Topped Vegan Cheesecake'">Strawberry Vegan Cheesecake</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Vegan lemon blueberry cheesecake'">Vegan Lemon Blueberry Cheesecake</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Chocolate Cake with chocolate icing'">Chocolate Cake</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Chiffon cake'">Chiffon Cake</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Walnut cake'">Coconut Angel Cake</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Coconut angel cake'">Walnut cake</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h5><a href="cookies.html">Cookies</a></h5>
                                            <ul class="list-unstyled mb-3">
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'Christmas cookies'">Festive Christmas Cookies</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'Deluxe Signature Cookie Basket'">Deluxe Signature Cookie Basket</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'Gluten-Free Holiday Sugar Cookies'">Gluten-Free Holiday Sugar Cookies</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'birthday cookies'">Chocolate-Covered Birthday Grahams</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'chocolate chip cookies'">Small Chocolate Chip Cookies</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'Xmas truffles'">Christmas Cookies and Truffles</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'Gluten Free Peanut Butter Oatmeal Cookies'">Oatmeal Cookies, GlutenFree</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Cookies';document.cookie = 'name'+'='+'Gingerbread Cookies'">Gingerbread Cookies</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h5><a href="Macarons.html">Macaroons</a></h5>
                                            <ul class="list-unstyled mb-3">
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Mint, Strawberry and Raspberry Macaroon Box'">Macaroon Box</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Ultimate Easter macaroon box'">Ultimate Easter Macaroon Box</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Strawberry Macarons'">Strawberry Macaroons</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'chocolate stuffed macaroons'">Chocolate Stuffed Macaroons</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Chocolate Macaroons'">Chocolate Macaroons</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'toffee macaroons'">Toffee Macaroons</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Rainbow Macaroons'">Rainbow Macaroons</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Mint Macaroons'">Mint Macaroons</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h5 ><a href="Donuts.html">Donuts</a></h5>
                                            <ul class="list-unstyled mb-3">
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'Cinnamon Apple Baked Donuts'" >Cinnamon Apple Baked Donuts</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'Chocolate Glazed Peanut Butter Filled Donut'">Chocolate Glazed Peanut Butter Filled Donut</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'maple donuts'">Maple Donut</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'Oreo Donut'">Oreo Donuts</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'Chocolate Donut'">Chocolate Donut</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'Red Velvet Donut'">Red Velvet Donuts</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'burned caramel glazed donut'">Burned Caramel Glazed Donuts</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'vanilla glazed donut'">Vanilla Glazed Donuts</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h5><a href="Pies&Tarts.html">Tarts & Pies </a></h5>
                                            <ul class="list-unstyled mb-3">
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'pies&tarts';document.cookie = 'name'+'='+'Apple Pie'">Apple Pie</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'pies&tarts';document.cookie = 'name'+'='+'pumpkin pie'">Pumpkin Pie</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'pies&tarts';document.cookie = 'name'+'='+'Mexican chocolate pecan tart'">Mexican Tart</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="description.php" class="nav-link" onclick="document.cookie = 'cat'+'='+'pies&tarts';document.cookie = 'name'+'='+'French strawberry tart'">Strawberry Tart</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item dropdown menu-large">
                            <a href="index.php#aboutUs" data-delay="200" class="nav-link">About Us<b class="caret"></b></a>
                        </li>
                        <li class="nav-item dropdown menu-large">
                            <a href="#contact" data-delay="200" class="nav-link">Contact Us<b class="caret"></b></a>
                        </li>
                    </ul>


                    <div class="navbar-buttons d-flex justify-content-end">

                        <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                            <a onclick="window.location.href='cart.php'" class="btn btn-primary navbar-btn">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>

                        <div id="profile" class="navbar-collapse collapse d-none d-lg-block">
                            <a onclick="window.location.href ='Acc.php';" class="btn btn-primary navbar-btn">
                                <i class="fa fa-user-circle"></i>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </nav>


    </header>


    <div style="padding-top: 100px">

        <div id="all">
            <div id="content" style="margin-top: 0px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- breadcrumb-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
                                </ol>
                            </nav>
                        </div>
                        <div id="basket" class="col-lg-9">
                            <div class="box">
                                <form method="post" action="">
                                    <h1>Shopping cart</h1>

                                    <div class="table-responsive">

                                        <h3 style="color: #4fbfa8; padding-left: 150px">List of All Products</h3>

                                        <?php
                                        if ( isset($_SESSION["cart"]) ) {
                                            ?>
                                            <br/><br/><br/>
                                            <table width="100%">
                                                <tr>
                                                    <th colspan="1" width="250px">Product</th>
                                                    <th width="30px">&nbsp;</th>
                                                    <th width="30px">Unit Price</th>
                                                    <th width="20px">&nbsp;</th>
                                                    <th width="30px">Qty</th>
                                                    <th width="20px">&nbsp;</th>
                                                    <th width="30px">Total Price</th>
                                                    <th width="20px">&nbsp;</th>
                                                    <th width="10px">Action</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" width="250px"><hr></td>
                                                    <td width="30px"></td>
                                                    <th width="30px"><hr></th>
                                                    <th width="20px">&nbsp;</th>
                                                    <td width="30px"><hr></td>
                                                    <td width="20px"></td>
                                                    <td width="30px"><hr></td>
                                                    <td width="20px"></td>
                                                    <td width="10px"><hr></td>
                                                </tr>
                                                <?php
                                                $total = 0;

                                                foreach ( $_SESSION["cart"] as $i ) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
                                                        <td width="10px">&nbsp;</td>
                                                        <td><?php echo( "$ " . $amounts[$_SESSION["cart"][$i]] ); //$quan += $_SESSION["qty"][$i]; ?></td>
                                                        <td width="10px">&nbsp;</td>
                                                        <td>
                                                            <?php $qu += $_SESSION["qty"][$i]; echo ($_SESSION["qty"][$i]);?>
                                                            <!--<input type="text" onloadstart="getCookie('quantity')">-->
                                                        </td>
                                                        <td width="10px">&nbsp;</td>
                                                        <td><?php $totalP = $amounts[$_SESSION["cart"][$i]] * $_SESSION["qty"][$i];
                                                            echo( "$ " . $totalP ); ?></td>
                                                        <td width="10px">&nbsp;</td>
                                                        <td>
                                                            <a href="?delete=<?php echo($i); ?>">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $total = $total + $_SESSION["amounts"][$i];
                                                }
                                                $_SESSION["total"] = $total;
                                                ?>
                                                <tr>
                                                    <td colspan="1" width="250px"><hr></td>
                                                    <td width="30px"></td>
                                                    <td width="30px"><hr></td>
                                                    <td width="20px"></td>
                                                    <td width="30px"><hr></td>
                                                    <td width="20px"></td>
                                                    <td width="10px"><hr></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="5">Total</th>
                                                    <th colspan="2"><?php echo($total); ?></th>
                                                </tr>
                                            </table>
                                            <?php
                                        }
                                        ?>



                                    </div>
                                    <!-- /.table-responsive-->
                                    <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                                        <div class="left">
                                            <a href="index.php" class="btn btn-outline-secondary">
                                                <i class="fa fa-chevron-left"></i>
                                                Continue shopping
                                            </a>
                                        </div>
                                        <div class="right">
                                            <button type="submit" class="btn btn-primary">
                                                <a href="index.php" style="color: #FFFFFF">
                                                    Checkout
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-->
                            <div class="row same-height-row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="box same-height" style="background-color:#4fbfa8; color: #ffffff; height: 300px;">
                                        <h3>You may also like these products</h3>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="product same-height">
                                        <a href="#">
                                            <img src="pictures/macaroons/5e7928019fe6d.image.jpg" alt="" class="img-fluid" style="height: 250px;  width: 100%; object-fit: cover"
                                                 onclick="document.cookie = 'name'+'='+'Mint, Strawberry and Raspberry Macaroon Box';
                                             window.location.href ='description.php';document.cookie = 'cat'+'='+'Macaroons'">
                                        </a>
                                        <div class="text">
                                            <h3>Macaroon Box</h3>
                                            <p class="price">20.00$</p>
                                        </div>
                                    </div>
                                    <!-- /.product-->
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="product same-height">
                                        <a href="#">
                                            <img src="pictures/cookies/chocolate-chip-cookie-recipe-1-of-1-3.jpg" alt="" class="img-fluid" style="height: 250px; object-fit: cover"
                                                 onclick="document.cookie = 'name'+'='+'chocolate chip cookies';
                                                 document.cookie = 'cat'+'='+'Cookies';
                                             window.location.href ='description.php'">
                                        </a>
                                        <div class="text">
                                            <h3>Chocolate Cookie</h3>
                                            <p class="price">5.00$</p>
                                        </div>
                                    </div>
                                    <!-- /.product-->
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="product same-height">
                                        <a href="#">
                                            <img src="pictures/cakes%20and%20cheesecakes/Triple-Berry-No-Bake-Cheesecake.jpg" alt="" class="img-fluid" style="height: 250px; object-fit: cover"
                                                 onclick="document.cookie = 'name'+'='+'No bake cheese cake with strawberry topping';
                                                  document.cookie = 'cat'+'='+'Cakes';
                                             window.location.href ='description.php'">
                                        </a>
                                    </div>
                                    <!-- /.product-->
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-3-->
                    </div>
                </div>
            </div>
        </div>



        <br><br><br>


        <!-- Contact Us -->

        <div class="social-media-container">


            <div class="col-lg-9" style="padding-left: 400px;">
                <div id="contact" class="box">


                    <pre class="menuTit">Contact Us </pre>

                    <p class="lead">Are you curious about something? Do you have some kind of problem with our products?</p>
                    <p>Please feel free to contact us, our customer service center is working for you 24/7.</p>

                    <br>
                    <hr>
                    <br>


                    <div class="row" style="padding-left: 150px;">
                        <div class="col-md-4">
                            <h3><i class="fa fa-map-marker"></i>Address</h3>
                            <p>Al-Makhfia<br>Nablus<br>West Bank<br>Palestine<br><br><strong><i class="ps flag"></i>Nablus</strong></p>
                        </div>
                        <!-- /.col-sm-4-->
                        <div class="col-md-4">
                            <h3><i class="fa fa-phone"></i> Call center</h3>
                            <p class="text-muted">This number is toll free if calling from Palestine otherwise we advise you to use the electronic form of communication.</p>
                            <p><strong>+110 222 333 444</strong></p>
                        </div>
                        <!-- /.col-sm-4-->

                        <!-- /.col-sm-4-->
                    </div>


                    <!-- /.row-->
                    <hr>

                    <br>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <a  href = "mailto: Sprinkles.info@gmail.com"?subject=Mail from Our Site style="color: #FFFFFF">
                                <i class="fa fa-envelope-o" style="color: #FFFFFF"></i> Send message
                            </a>
                        </button>
                    </div>

                </div>
            </div>




            <!-- Social Media Accounts -->

            <p class="follow-p">Don't forget to follow us on our social media accounts<br><br></p>
            <div class="social-buttons">

                <!-- facebook  Button -->
                <a href="http://www.facebook.com" target="blank" class="social-margin">
                    <div class="social-icon facebook">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </div>
                </a>

                <!-- pinterest Button -->
                <a href="https://pinterest.com/" target="blank" class="social-margin">
                    <div class="social-icon pinterest">
                        <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                    </div>
                </a>

                <!-- LinkedIn Button -->
                <a href="http://linkedin.com/" target="blank" class="social-margin">
                    <div class="social-icon linkedin">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </div>
                </a>

                <!-- Youtube Button -->
                <a href="http://youtube.com/" target="blank" class="social-margin">
                    <div class="social-icon youtube">
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                    </div>
                </a>

                <!-- TwitterButton -->
                <a href="http://twitter.com/" target="blank" class="social-margin">
                    <div class="social-icon twitter">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </div>
                </a>
            </div>

            <br><br><br>
        </div>

    </div>



    <!-- JavaScript files-->
    <script src="s/vendor/jquery/jquery.min.js"></script>
    <script src="s/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="s/vendor/jquery.cookie/jquery.cookie.js">
    </script>
    <script src="s/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="s/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="s/js/front.js"></script>


    <!-- Needed -->
    <script src="js/main.js"></script>

    <script defer src="cart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>


    </body>


    </html>


<?php


$conn = mysqli_connect("localhost","root","","sprinkles");

if (mysqli_connect_error()) {
    echo "Can't connect to database" ;
    die();
}
else {


    $nm = $_COOKIE['name'];
    $strQry ="SELECT * FROM `product` WHERE `name` ='$nm' ";
    $res= $conn->query($strQry);
    $row = mysqli_fetch_assoc($res);
    $sq = $row['Pid'];

    $stQ = "INSERT INTO `purshased`(`P_id`, `quantity`) VALUES 
                ($sq, $qu)";


    $email = $_COOKIE['email'];
    $s ="SELECT * FROM `customer` WHERE `email`= '$email'";
    $result= $conn->query($s);
    $r = mysqli_fetch_assoc($result);
    $id = $r['Cid'];

    $pid = "SELECT * FROM `purshased` WHERE ``= ''";

    $strQ = "INSERT INTO `cart` (`Cid`, `totalPrice`, `Purshased_id`) VALUES 
                    ($id ,$total,[value-4])";


}


?>