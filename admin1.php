<?php
session_start();
if($_SESSION['isLoggedIn'] == 0 ){
    header("Location: logIn.php");
}else {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="robots" content="all,follow">

    <link rel="shortcut icon" href="images/cupcakeIcon.png">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="styles%20sheets/style.default.css" id="theme-stylesheet">

      <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <style>
        .icon-bar {
            width: 100%; /* Full-width */
            background-color: #555; /* Dark-grey background */
            overflow: auto;
        }

        .icon-bar a {
            float: right;
            text-align: center;
            width: 20%;
            padding: 12px 0;
            transition: all 0.3s ease;
            color: white;
            font-size: 36px;
        }

        .icon-bar a:hover {
            background-color: #000; /* Add a hover color */
        }

        .active {
            background-color: #4fbfa8; /* Add an active/current color */
        }
    </style>
</head>
<body>
<div class="icon-bar">
    <a class="active" href="choose.php"><i class="fa fa-home"></i>Home</a>
</div>

<!-- delete  -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you finished the order?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="delete0.php" method="post">
                <div>
                    <input type="hidden"  id="delete_id" name="delete_id" >
                </div>
                <h3 align="center">Are you sure you want to delete?</h3>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" name="deletedata" class="btn btn-primary ">Yes</button>
                </div>
            </form>
        </div>
        </div>
</div>

<!-- add  -->
<div clas="container">
    <div class="jumbotron">
        <div class="card">
            <h2>See Orders</h2>

        </div>
        <div class="card">
            <div calss ="card-body">

                <?php
                $conn = mysqli_connect("localhost","admin","123456","sprinkles");
                $qry = "SELECT C.CartId ,cus.email, Pro.name,Pro.category, Pur.ordered,  cus.address FROM `cart`as C ,`purshased` as Pur,`product`as Pro, `customer`as cus where Pur.Purshased_id = C.Purshased_id and cus.Cid=C.Cid and Pro.id=Pur.P_id";
                $res= $conn->query($qry);
                ?>
                <table class="table" id="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">CartId</th>
                        <th scope="col">Customer's Email</th>
                        <th scope="col">Product</th>
                        <th scope="col">Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Address</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <?php
                    if($res)
                    {
                    foreach ($res as $row)
                    {
                    ?>
                    <tbody>
                    <tr>

                        <td><?php echo $row['CartId'];?> </td>
                        <td><?php echo $row['email'];?> </td>
                        <td><?php echo $row['name'];?> </td>
                        <td><?php echo $row['category'];?></td>
                        <td><?php echo $row['ordered'];?> </td>
                        <td><?php echo $row['address'];?> </td>
                        <td><button type="button" class="btn btn-danger deletbtn">Delete</button> </td>
                    </tr>
                    </tbody>
                        <?php
                    }
                    }
                    else echo "No record";
                    $conn->close();}
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- JavaScript files-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/bootstrap/js/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!-- pop up for edit,add-->
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );

</script>
<!-- pop up for delete-->
<script>
    $(document).ready(function(){
        $('.deletbtn').on('click',function(){

            $('#deletemodal').modal('show');

            $tr=$(this).closest('tr');
            let data = $tr.children('td').map(function ()
            {
                return $(this).text();
            }).get();
            console.log(data);
            $('#delete_id').val(data[0]);

        });
    });
</script>
</body>
</html>