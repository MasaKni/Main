<?php
$conn = mysqli_connect("localhost","admin","123456","sprinkles");
if (mysqli_connect_error())
{
    echo "Can't connect to database" ;
    die();
}
else
    {
        if(isset($_POST['updatedata'])) {
            $id=$_POST["id"];
            $name = $_POST["product"];
            $price = $_POST["price"];
            $category = $_POST['gridRadios'];
            $des = $_POST['description'];
            $qty = $_POST['Quantity'];
            $img=$_POST['image'];
            $qry = "Update product set `img`='$img',`name`='$name', `price` ='$price' ,`description` = '$des',`category`= '$category',`quantity`='$qty' where `id`='$id' ";

            $res = $conn->query($qry);
            if ($res) {
                echo '<script> alert("Data saved");</script>';
                header('location:admin0.php');
            } else
                echo '<script> alert("Data not saved");</script>';
        }

    }
?>