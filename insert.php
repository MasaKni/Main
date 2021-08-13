<?php
$conn = mysqli_connect("localhost","admin","123456","sprinkles");
if (mysqli_connect_error())
{
    echo "Can't connect to database" ;
    die();
}
else {
    if (isset($_POST["insertdata"])) {
        $name = $_POST["product"];
        $price = $_POST["price"];
        $category = $_POST['gridRadios'];
        $des = $_POST['description'];
        $qty = $_POST['Quantity'];
        $img=$_POST['image'];
        $qry = "INSERT INTO product (`name`, price,description,category,quantity,img) VALUES ('$name','$price','$des','$category' ,'$qty','$img')";

        $res= $conn->query($qry);
        if ($res) {
            echo '<script> alert("Data saved");</script>';
            header('location:admin0.php');
        } else
            echo '<script> alert("Data not saved");</script>';
    }

}
?>
/*if($_POST["operation"] == "Add")
{
$statement = $connection->prepare(");

}
if($_POST["operation"] == "Edit")
{
$statement = $connection->prepare("UPDATE product SET name = :course, price = :students WHERE id = :id");

}*/
