<?php
$conn = mysqli_connect("localhost","admin","123456","sprinkles");
if (mysqli_connect_error())
{
    echo "Can't connect to database" ;
    die();
}
else {
    if (isset($_POST["deletedata"])) {
         $id=$_POST['delete_id'];
        $qry = "delete from product where id='$id'";

        $res= $conn->query($qry);
        if ($res) {
            echo '<script> alert("Data deleted");</script>';
            header('location:admin0.php');
        } else
            echo '<script> alert("Data not deleted");</script>';
    }

}
?>