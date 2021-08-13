<?php

session_start();
if($_SESSION['isLoggedIn'] == 0 ){
    header("Location: logIn.php");
}
else
    {
$email = $_COOKIE['email'];
$conn = mysqli_connect("localhost","admin","123456","sprinkles");
if (mysqli_connect_error())
{
    echo "Can't connect to database" ;
    die();
}
else
{

    $strQry ="SELECT * FROM `customer` WHERE `email`= '$email'";
    $res= $conn->query($strQry);
    $row = mysqli_fetch_assoc($res);
}
if(isset($_POST['action']))
{
    $namef=$_POST['fname'];
    $namel=$_POST['lname'];
    $pass=$_POST['Pass'];
    $addr=$_POST['addr'];
    $str ="UPDATE customer SET Fname = '$namef', Lname= '$namel',password='$pass' , address= '$addr' WHERE email = '$email' ";
    $res= $conn->query($str);
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Sprinkles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles sheets/disc.css">
    <link rel="stylesheet"  href="index.css">
    <link rel="shortcut icon" href="images/cupcakeIcon.png">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">

    <!-- owl carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="styles%20sheets/style.default.css" id="theme-stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="js/front.js"></script>

    <!-- Needed -->
    <script src="js/main.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <style>
        header {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 2;
        }

        .flex-container {
            display: flex;
            -ms-flex-order: inherit;
            text-align: center;
            height: 750px;
            background-color: #FDFCF7;;
            margin-top: 87px
            /*padding-left: 50px;*/
        }

        table {
            display: flex;
            -ms-flex-order: inherit;
            padding-left: 100px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            /*padding-left: 50px;*/
        }

        p.slogans{
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size:  large;
            text-align: center;
            color: #838c93;
            padding-bottom: 75px;
            margin-top: -20px;
        }

    </style>
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

<div style="padding-bottom: 50px ;padding-top: 50px;   margin: auto;" >
    <div class="flex-container" >
        <img src="images/account.jpeg" style="height: 750px; width: 600px; margin-left: 100px; object-fit: cover">
        <div>
            <pre class="menuTit" id="aboutUs" style="margin-top: 100px;">   About   Me   </pre>
            <p class="slogans"> Your face was probably made for our sweets! </p>

            <table >
                <tr>
                    <td>
                        <pre class="names"  style="text-align: left; font-size: large">Name: </pre>
                        <br>
                    </td>
                    <td>
                        <pre class="names" style="text-align: left; color: #838c93; font-size: large"><?php echo $row['Fname'].' '.$row['Lname']?></pre>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <pre class="names" style="text-align: left; font-size: large">Address:     </pre>
                        <br>
                    </td>
                    <td>
                        <pre class="names" style="text-align: left;  color: #838c93; font-size: large"><?php echo $row['address']?></pre>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <pre class="names" style="text-align: left; font-size: large">Email: </pre>
                        <br>
                    </td>
                    <td>
                        <pre class="names" style="text-align: left;  color: #838c93; font-size: large"><?php echo $row['email']?></pre>
                        <br>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 400px">
                <tr>
                    <td>
                       <button type="button" class="btn btn-primary" style="padding-left: 5px" id="add_button" data-toggle="modal" data-target="#userModal">
                        <i class="fas fa-info-circle" style="padding-right: 5px"></i>Edit Info

                        </button>
                    </td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-primary">
                            <a href="log_out.php" style="color: white">Log out</a>
                        </button>
                    </td>
                </tr>
            </table>


            <br><br>

            <div class="col-lg-3" style="padding-left: 100px;">
                <div id="order-summary" class="box" style="width: 450px;">
                    <div class="box-header">
                        <h3 class="mb-0" style="color: #4fbfa8;"> Sprinkles <i class="fa fa-candy-cane" style="color: #4fbfa8;"></i></h3>
                    </div>
                    <p class="text-muted" style="font-size: 16px">So Sweet. So Good. Sure to bring smiles</p>
                    <div class="table-responsive">

                    </div>
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



</body>
</html>


<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="course_form" action="Acc.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                </div>
                <div style="alignment: left" class="modal-body">
                    <table >
                        <tr>
                            <td width="50%"><label>First Name</label></td>
                            <td width="50%">
                                <label>Last Name</label>
                            </td>

                        </tr>
                        <tr>
                            <td width="50%">
                                <input type="text" name="fname" id="fname" class="form-control"/><br>
                            </td>
                            <td width="50%">
                                <input type="text" name="lname" id="lname" class="form-control"/><br>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <label>New Password</label>
                            </td>
                            <td width="50%">
                                <label>New address</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%"> <input type="pass" name="Pass" id="Pass" class="form-control"/><br></td>

                            <td width="50%">
                                <input type="text" name="addr" id="addr" class="form-control"/><br>
                            </td >
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">

                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Done"  />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$conn->close();?>
