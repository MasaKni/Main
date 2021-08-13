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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <title>Admin</title>

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
<header>
<div class="icon-bar">
    <a class="active" href="choose.php"><i class="fa fa-home"></i>Home</a>
</div>
</header>
<!-- add  -->
<div class="modal fade" id="ProductAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="insert.php" method="post">
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="product" class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="product" placeholder="Product name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="description" placeholder="description">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="Quantity" placeholder="Quantity">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" placeholder="Price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Image URL</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="image" name="image" placeholder="pictures/folder/img.png">
                        </div>
                    </div>


                    <fieldset class="form-group">
                        <div class="row">
                            <label for="cat" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10" id="cat">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Donuts" id="Donuts" checked>
                                    <label class="form-check-label" for="Donuts">
                                        Donuts
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Cookies" id="Cookies">
                                    <label class="form-check-label" for="Cookies">
                                        Cookies
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Macaroons"  id="Macaroons">
                                    <label class="form-check-label" for="Macaroons">
                                        Macaroons
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios" value=" Pies&Tarts" id=" Pies&Tarts">
                                    <label class="form-check-label" for=" Pies&Tarts">
                                        Pies&Tarts
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Cakes" id="Cakes">
                                    <label class="form-check-label" for="Cakes">
                                        Cakes
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="insertdata" class="btn btn-primary">Save data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /add  -->
<!-- edit-->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ٍEdit Stock Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update.php" method="post">
                <div class="modal-body">
                    <div>
                        <input type="hidden"  id="id" name="id" >
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="product" placeholder="Product name" id="product">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="description" placeholder="description" id="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="Quantity" placeholder="Quantity" id="Quantity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" placeholder="Price" id="Price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Image URL</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="image" name="image" placeholder="pictures/folder/img.png">
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <label for="cat" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10" id="cat">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Donuts" id="Donuts" checked>
                                    <label class="form-check-label" for="Donuts">
                                        Donuts
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Cookies" id="Cookies">
                                    <label class="form-check-label" for="Cookies">
                                        Cookies
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Macaroons"  id="Macaroons">
                                    <label class="form-check-label" for="Macaroons">
                                        Macaroons
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios" value=" Pies&Tarts" id=" Pies&Tarts">
                                    <label class="form-check-label" for=" Pies&Tarts">
                                        Pies&Tarts
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios"  value="Cakes" id="Cakes">
                                    <label class="form-check-label" for="Cakes">
                                        Cakes
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updatedata" class="btn btn-primary ">Save data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /edit-->

<!-- delete  -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="delete.php" method="post">
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
            <h2>Add Product Pop Up</h2>
            <div class="card">
                <div calss ="card-body">
                    <button type="buttone" class="btn btn-primary" data-toggle="modal" data-target="#ProductAddModal">Add Product
                    </button>
                </div>
            </div>
        </div>
        <div class="card">
            <div calss ="card-body">

                <?php
                $conn = mysqli_connect("localhost","admin","123456","sprinkles");
                $qry = "select * from product";
                $res= $conn->query($qry);
                ?>
                <table class="table" id="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Image</th>
                        <th scope="col">Edit</th>
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
                                <td><?php echo $row['id'];?> </td>
                                <td><?php echo $row['name'];?> </td>
                                <td><?php echo $row['description'];?></td>
                                <td><?php echo $row['category'];?> </td>
                                <td><?php echo $row['rating'];?> </td>
                                <td><?php echo $row['quantity'];?> </td>
                                <td><?php echo $row['price'];?> </td>
                                <td><?php echo $row['sold'];?> </td>
                                <td><?php echo $row['img'];?> </td>
                                <td><button type="button" class="btn btn-success editbtn">Edit</button> </td>
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
    $(document).ready(function(){
        $('.editbtn').on('click',function(){

            $('#editmodal').modal('show');
            $tr=$(this).closest('tr');
            let data = $tr.children('td').map(function ()
            {
                return $(this).text();
            }).get();
            console.log(data);
            $('#id').val(data[0]);
            $('#product').val(data[1]);
            $('#description').val(data[2]);
            $('#Quantity').val(data[5]);
            $('#image').val(data[9]);
            $('#category').val(data[3]);
            $('#Price').val(data[6]);


        });
    });
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