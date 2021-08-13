<?php

session_start();
$count=1;
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


$cat='';
$nm='';
$conn = mysqli_connect("localhost","admin","123456","sprinkles");
if (mysqli_connect_error()) {
    echo "Can't connect to database" ;
    die();
}
else {

    $_SESSION["q"] = 1;

    //Load up session
    if ( !isset($_SESSION["total"]) ) {
        $_SESSION["total"] = 0;
        for ($i=0; $i< count($products); $i++) {
            $_SESSION["qty"][$i] = 0;
            $_SESSION["amounts"][$i] = 0;
        }
    }

    //Add
    if ( isset($_GET["add"]) ) {
        $doc = new DOMDocument();
        $val = $doc->getElementById('amount')->textContent;
        $i = $_GET["add"];
        $qty = $_SESSION["qty"][$i] + $val;
        $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
        $_SESSION["cart"][$i] = $i;
        $_SESSION["qty"][$i] = $qty;
    }


    $cat = $_COOKIE['cat'];
    $nm = $_COOKIE['name'];
    $strQry ="SELECT * FROM `product` WHERE `category`= '$cat' and `name` ='$nm' ";
    $res= $conn->query($strQry);
    $row = mysqli_fetch_assoc($res);

 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['category']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles sheets/disc.css">
    <link rel="stylesheet"  href="index.css">
    <link rel="shortcut icon" href="images/cupcakeIcon.png">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="styles%20sheets/style.default.css" id="theme-stylesheet">

    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">

    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
 <!--   <style>
        header{
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 2;
        }
    </style>-->
    <script type="text/javascript">
        let count = 1;
        var tot =0;
        var pric = 0;
        function plus() {
            <?php $count+=$count;?>
            pric =document.getElementById("price").innerText;
            count++;
            document.getElementById("amount").value = Number(count);
            tot=count*pric ;
            document.getElementById("change").innerText=tot;

        }
        function minus()
        {
            if (count > 1) {
                count--;
                <?php $count-=$count;?>
                pric =document.getElementById("price").innerText;
                document.getElementById("amount").value = Number(count);
                tot=count*pric ;
                document.getElementById("change").innerText=tot;

            }
        }
        function set()
        {

            pric =document.getElementById("price").innerText;
            tot=document.getElementById("amount").value *pric ;
            document.getElementById("change").innerText=tot;
            count=document.getElementById("amount").value;

        }
    </script>

</head>
<body style="background-color: #FDFCF7;">

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
<div style="padding-bottom: 400px">
    <div style="margin-top: 200px ; margin-left: 100px; margin-right: 100px ; ">
        <?php if ($row['img']){ ?>
            <img src="<?php echo $row['img']; ?>"
                 alt="<?php echo $row['name']?>" width="510" height="550"
             style=" float: left;
             border-radius: 10px;
             border-color: black;
             box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19); object-fit: cover;" >

    <?php }else{ ?>
    <p class="status error">Image(s) not found...</p>
    <?php } ?>

        <div class="paragrappph">
            <div style="font-size:40px;font-weight:bold;">
                <p><?php echo $row['name']?></p>
            </div>
            <div  style="color: dimgray">
                Rating: <?php
                if ($row['rating']>=4.5 && $row['rating']<=5) {   ?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <?php
                }
                elseif ($row['rating']>=3.5 && $row['rating']<=4.4) {?>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <?php
                }
                elseif ($row['rating']>=2.5 && $row['rating']<=3.4) {?>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <?php
                }
                elseif ($row['rating']>=1.5 && $row['rating']<=2.4) {?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star "></span>
                <?php
                }
                elseif ($row['rating']>=0.5 && $row['rating']<=1.4) {?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star "></span>
                <?php
                }
                else{?>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <?php
                }?>

            </div>
            <br>
            <div style="font-size:20px; font-family: 'Helvetica', 'Arial', sans-serif; text-align: justify;">
                <p> <?php echo $row['description']?></p>
                <br>
            </div>
            <p style="font-size:20px"><strong>
                    <?php
                    if ($row['category']=="Donuts" )
                             {echo "Price per piece: ";}
                    elseif ($row['category']=="Cookies")
                        if ($row['name']=="Xmas truffles" || $row['name']=="Deluxe Signature Cookie Basket" || $row['name']=="birthday cookies")
                            echo "Price for 1 box - 10 pieces -: ";
                            else
                                echo "Price per piece: ";
                    elseif ($row['category']=="Macaroons")
                       { if ($row['name']=="Rainbow Macaroons" || $row['name']=="Mint, Strawberry and Raspberry Macaroon Box")
                         echo "Price (24 pieces): ";
                        else
                           echo"Price (10 pieces): ";}
                    else {echo "Price: ";}?><span id="price" content="8"><?php echo $row['price']?></span> $</strong></p>

            <button class="incDic" onclick="minus()">-</button>
            <input type="text" id="amount" class="price" value="1" onchange="set()">
            <button class="incDic" onclick="plus()">+</button>
            <br><br>


            <div style="font-size:20px;"> <strong style="color: brown">Total:    <span id="change" ><?php echo $row['price']?></span>$</strong> </div>
            <br>

                <div class="ui vertical animated button" tabindex="0"
                     style="text-align: center; display: grid;margin: auto;  background: #4fbfa8; width:240px;">
                    <div class="hidden content" >
                         <a style="background: #4fbfa8;"
                            onclick="<?php
                            for ($i=0; $i< count($products); $i++) {
                                if ($products[$i] == $row['name']) {
                                    $_SESSION["pro"] = $i;
                                }
                            }
                            ?>
                                    window.location.href='cart.php'";>
                             Add to cart
                         </a>




                    </div>
                    <div class="visible content" >
                        <i class="shop icon" style="font-size:18px"></i>
                    </div>
                </div>

        </div>
    </div>
</div>


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
                    <p>Al-Makhfia<br>Nablus<br>West Bank<br>Palestine<br><br><br><strong><i class="ps flag"></i>Nablus</strong></p>
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

</div>

<!-- JavaScript files-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>




