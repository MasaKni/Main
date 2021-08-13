<?php

$found = 0;

if(isset($_REQUEST['search'])) {

    $product = $_REQUEST['productToFind'];

    $db = mysqli_connect("localhost", "admin", "123456", "sprinkles");

    if (mysqli_connect_error()) {
        echo "Error: Unable to connect to database";
        die();
    }
    else {
        $stringQ = "SELECT `name` FROM `product` WHERE `name` = " . $product;
        echo "query " . $stringQ;
        $result = $db->query($stringQ);

        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();
            if ($product == $row['name']) {
                $found = 1;
                echo "This product is available" . $result;
                header("Location: account.html");
            }
        }

        if ($found == 0) {
            echo "<p>Not found</p>" . $result;
            header("Location: logIn.php");
        }
    }

    $db->close();

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Sprinkles</title>
    <link rel="stylesheet" type="text/css" href="index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
    <link rel="stylesheet" type="text/css" href="css/slideShow.css">

    <style>
        header {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 2;
        }
    </style>

    <link rel="stylesheet" href="styles%20sheets/slideShow.css">
    <script type="text/javascript">
    let counter = 1;
        setInterval(function() {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
    </script>


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

                <a href="cart.php" class="btn btn-outline-secondary navbar-toggler">
                    <i class="fa fa-shopping-cart"></i>
                </a>
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
                        <a href="#aboutUs" data-delay="200" class="nav-link">About Us<b class="caret"></b></a>
                    </li>
                    <li class="nav-item dropdown menu-large">
                        <a href="#contact" data-delay="200" class="nav-link">Contact Us<b class="caret"></b></a>
                    </li>
                </ul>


                <div class="navbar-buttons d-flex justify-content-end">

                    <!-- /.nav-collapse-->

                    <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                        <a href="cart.php" class="btn btn-primary navbar-btn">
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


    <div id="d" style="padding-top: 150px">
        <!--image slider start-->
        <div class="slider">
            <div class="slides">
                <!--radio buttons start-->
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
                <!--radio buttons end-->
                <!--slide images start-->
                <div class="slide first">
                    <img src="images/bg4.jpg" alt=" ">
                </div>
                <div class="slide">
                    <img src="images/bg3.jpg" alt=" ">
                </div>
                <div class="slide">
                    <img src="images/bg1.jpg" alt=" ">
                </div>
                <div class="slide">
                    <img src="images/christmasC.jpg" alt=" ">
                </div>

                <!--slide images end-->
                <!--automatic navigation start-->
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
                <!--automatic navigation end-->
            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
        </div>
        <!--image slider end-->


        <div class="total-frame">


            <br><br>
            <br><br>
            <br><br>


            <!-- Menu -->
            <pre class="menuTit">      Services   </pre>
            <div class="flex-container-img-menu">
                <div>
                    <a href="cakes.html">
                        <img src="images/cakeL.jpg" class="menuImg">
                    </a>

                </div>
                <div>
                    <a href="cookies.html">
                        <img src="images/cookiesL.jpg" class="menuImg">
                    </a>
                </div>
                <div>
                    <a href="Macarons.html">
                        <img src="images/macaronL.jpg" class="menuImg">
                    </a>
                </div>
                <div>
                    <a href="Donuts.html">
                        <img src="images/donutL.jpg" class="menuImg">
                    </a>
                </div>
                <div>
                    <a href="Pies&Tarts.html">
                        <img src="images/pieL.jpg" class="menuImg">
                    </a>
                </div>
            </div>
            <div class="flex-container-p-menu">
                <div>
                    <p class="names">Cakes & Cupcakes</p>
                </div>
                <div>
                    <p class="names" style="margin-left: 10px">Cookies & Brownies</p>
                </div>
                <div>
                    <p class="names" style="margin-left: 50px">Macaroons</p>
                </div>
                <div>
                    <p class="names" style="margin-left: 90px">Donuts</p>
                </div>
                <div>
                    <p class="names" style="margin-left: 90px">Tarts & Pies</p>
                </div>
            </div>


            <br><br>

            <div class="ui vertically divided grid">
                <div class="two column row">
                    <div class="column">
                        <p></p>
                    </div>
                    <div class="column">
                        <p></p>
                    </div>
                </div>
                <div class="three column row">
                    <div class="column">
                        <p></p>
                    </div>
                    <div class="column">
                        <p></p>
                    </div>
                    <div class="column">
                        <p></p>
                    </div>
                </div>
            </div>



            <div>
                <br><br>
                <br><br>
                <pre class="menuTit" id="aboutUs">   About   Us   </pre>

            </div>

            <br><br>
            <br><br>


            <div>
                <table class="dv">
                    <tr>
                        <td class="c1">
                            <p id="sc1" style="color: #1b1b1b;">Desserts open doors, hearts, and conversations. We Sprinkles, situated at, is the leading innovator in the dessert industry. Though our reach is global, our passion for artful food and dedication to quality remains the motivation
                                behind every one of our gourmet desserts. We challenge ourselves to aggressively source the best ingredients</p>
                            <br>
                            <p id="sc2"><b>Live the sweet life</b></p>
                        </td>
                        <td class="c2">
                            <img src="images/1.jpg" style="height: 500px; object-fit: cover;" />
                        </td>
                    </tr>
                </table>
            </div>

            <br><br>
            <br><br>
            <br><br>


            <!-- Best Sellers -->
            <pre class="menuTit">   Best   Sellers   </pre>
            <div class="flex-container-img-best">
                <div>
                    <img src="images/oreoDonut.jpg" class="bestImg" />
                </div>
                <div>
                    <img src="pictures/pies and tarts/french-strawberry-tart.jpg" class="bestImg" />
                </div>
                <div>
                    <img src="pictures/macaroons/Chocolate-Macarons-14.jpg" class="bestImg" />
                </div>
                <div>
                    <img src="pictures/cakes%20and%20cheesecakes/walnut%20ckae.jpg" class="bestImg" />
                </div>
            </div>
            <div class="flex-container-p-best">
                <div>
                    <p class="bestNames">Oreo donuts</p>
                    <p class="bestNames">Price: 20.00$</p>
                    <button class="addToCart" type="button" style="position: relative; width:170px" onclick="document.cookie = 'cat'+'='+'Donuts';document.cookie = 'name'+'='+'Oreo Donut';window.location.href='description.php'">
                        Product Detail
                    </button>
                </div>

                <div style="margin-left: 60px">
                    <p class="bestNames">Brown sugar strawberry tart</p>
                    <p class="bestNames">Price: 50.78$</p>
                    <button class="addToCart" type="button" style="position: relative; width:170px" onclick="document.cookie = 'cat'+'='+'pies&tarts';document.cookie = 'name'+'='+'French strawberry tart';window.location.href='description.php'">
                        Product Detail
                    </button>
                </div>


                <div style="margin-left: 60px">
                    <p class="bestNames">Chocolate Macarons</p>
                    <p class="bestNames">Price: 7.00$</p>
                    <button class="addToCart" type="button" style="position: relative; width:170px" onclick="document.cookie = 'cat'+'='+'Macaroons';document.cookie = 'name'+'='+'Chocolate Macaroons';window.location.href='description.php'">
                        Product Detail
                    </button>
                </div>


                <div style="margin-left: 60px">
                    <p class="bestNames">Walnut Cake</p>
                    <p class="bestNames">Price: 90.00$</p>
                    <button class="addToCart" type="button" style="position: relative; width:170px" onclick="document.cookie = 'cat'+'='+'Cakes';document.cookie = 'name'+'='+'Walnut cake';window.location.href='description.php'">
                        Product Detail
                    </button>
                </div>
            </div>


            <br><br>
            <br><br>

            <div class="mapouter" style="position: relative">
                <div class="gmap_canvas">
                    <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=palestine-nablus&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>

                <br><br>

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
    <script src="s/vendor/jquery/jquery.min.js"></script>
    <script src="s/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="s/vendor/jquery.cookie/jquery.cookie.js">
    </script>
    <script src="s/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="s/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="s/js/front.js"></script>


    <!-- Needed -->
    <script src="js/main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>


</body>

</html>
