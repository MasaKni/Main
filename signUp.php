<?php

$flag = 0;

if(isset($_POST['register'])){
    $Fname = $_POST['firstName'];
    $Lname = $_POST['lastName'];
    $Email = $_POST['email'];
    $Address = $_POST['address'];
    $Password = sha1($_POST['pass']);

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
            if ($Email == $row['email']) {
                echo "Email Address is already exist, enter another Email Address";
                $flag = 1;
                header("Location: signUp.php");
            }
        }

        if($flag == 0) {
            $strQ = "INSERT INTO `customer`(`Fname`, `Lname`, `password`, `email`, `address`) VALUES 
                ('$Fname', '$Lname', '$Password', '$Email', '$Address')";
            //$res = $db->query($strQ);

            if (mysqli_query($db, $strQ)) {
                echo "Your Account has been created Successfully";
                $db->close();
                header("Location: logIn.php");
            } else {
                echo "ERROR: Could not able to execute";
            }

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up - Sprinkles</title>
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

            <form class="login100-form validate-form" action="signUp.php" method="post">
                    <span class="login100-form-title">
						Sign Up
                    </span>

                <div class="wrap-input100 validate-input" aria-required="true">
                    <input class="input100" type="text" name="firstName" placeholder="First Name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                </div>

                <div class="wrap-input100 validate-input" aria-required="true">
                    <input class="input100" type="text" name="lastName" placeholder="Last Name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" aria-required="true">
                    <input class="input100" type="text" name="address" placeholder="Address">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
                        </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required" aria-required="true">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" name="register">
                        Register
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="logIn.php">
                        <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i> Already have an Account
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