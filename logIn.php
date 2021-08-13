
<?php

if(isset($_POST['login'])) {

    session_start();
    $_SESSION['isLoggedIn'] = 0;

    $valid = 0;

    if (isset($_POST['email']) && isset($_POST['pass'])) {

        $db = mysqli_connect("localhost", "admin", "123456", "sprinkles");

        if (mysqli_connect_error()) {
            echo "Error: Unable to connect to database";
            die();
        }
        else {
            $stringQ = "select * from `customer`";
            $result = $db->query($stringQ);

            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                if (($_POST['email'] == $row['email']) && sha1($_POST['pass']) == $row['password']) {
                    if ($_POST['email'] =="masakoni13@outlook.com"  && sha1($_POST['pass']) == $row['password'])
                    {   $valid = 1;
                        $_SESSION['isLoggedIn'] = 1;
                        header("Location: choose.php");
                    }
                    else
                    {$valid = 1;
                    $_SESSION['isLoggedIn'] = 1;
                    setcookie('email',$_POST["email"]);
                    echo "<p>Logged in Successfully</p>";
                    header("Location: index.php");
                }}
            }

            if ($valid == 0 ) {
                echo "<p>Wrong Email or Password</p>";
                header("Location: logIn.php");
            }
        }

        $db->close();

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Sprinkles</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="images/cupcakeIcon.png">
    <!--===============================================================================================-->

</head>

<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="images/cupcake512.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="logIn.php" method="post">
                    <span class="login100-form-title">
						Member Login
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" value="Login" name="login">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="SignUp.php">
                        Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>

</html>