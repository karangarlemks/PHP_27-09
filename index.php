<?php

include 'lib/dbconnect.php';

$database = new Database();
$conn = $database->getConnection();

// SQL query to fetch data from the `tbl_product` table
$sql = "SELECT id, name, description, price, image, is_active FROM tbl_product where is_active = '1' ";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include jQuery and DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <!-- Parsley CSS (Optional but provides basic styling) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">

    <!-- Parsley.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>


    <style>
        /* Style for error message in red */
        .parsley-errors-list {
            color: red;
            list-style-type: none;
            margin: 5px 0 0 0;
            padding: 0;
            font-size: 0.9em;
        }

        /* Highlight invalid input fields */
        input.parsley-error {
            border-color: red;
        }

        /* Style for valid input fields */
        input.parsley-success {
            border-color: green;
        }

        /* Optional: Customize the field feedback icons */
        input.parsley-success + .parsley-errors-list {
            display: none;
        }

        td{
            border : 1px solid black;
        }
        tr{
            border : 1px solid black;

        }
        th{
            border : 1px solid black;

        }

    .dataTables_wrapper .dataTables_length{
    color: #333;
    margin-bottom: 15px;
}



    </style>

</head>

<body>


<!-- Header -->
<header class="p-3 bg-dark text-white">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <!-- <button type="button" >Login</button> -->
          <a href="login.php" class="btn btn-outline-light me-2">Login</a>
          <a href="sign.php" class="btn btn-warning">Sign-up</a>
          
        </div>
      </div>
    </div>
  </header>




    <div class="container-fluid mt-2">
    <h1 class="text-center">CRUD</h1>
    <div class="row">
        <div class="col">
        <!-- Button trigger modal -->

        <!-- Insert Model -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Product Modal</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
            
            <div class="container">
                <!-- <h2>Add Product</h2> -->
                <form action="controllers/ProductController.php?action=insert" method="POST" enctype="multipart/form-data" id="add-form" data-parsley-validate>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required data-parsley-required-message="Name is required">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" required data-parsley-required-message="Description is required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" class="form-control" required data-parsley-required-message="Price is required" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required data-parsley-required-message="Image is required">
                    </div>
    
            </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary ">Add Product</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
        </div>
        </div>

                </div>
            </div>


    <!-- Update Product Modal -->
    <div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateProductForm" action="controllers/ProductController.php?action=update" method="POST" enctype="multipart/form-data" id="update-form" data-parsley-validate>
                        <!-- Hidden field to store product ID -->
                        <input type="hidden" name="id" id="update-id">
                        
                        <div class="form-group">
                            <label for="update-name">Name:</label>
                            <input type="text" name="name" id="update-name" class="form-control" required data-parsley-required-message="Name is required">
                        </div>
                        
                        <div class="form-group">
                            <label for="update-description">Description:</label>
                            <textarea name="description" id="update-description" class="form-control" required data-parsley-required-message="Description is required"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="update-price">Price:</label>
                            <input type="number" name="price" id="update-price" class="form-control" required data-parsley-required-message="Price is required" step="0.01">
                        </div>
                        
                        <div class="form-group">
                            <label for="update-image">Image:</label>
                            <input type="file" name="image" id="update-image" class="form-control" accept="image/*" data-parsley-required-message="Image is required">
                            
                            <!-- Placeholder to show current product image -->
                            <img class="current-image mt-2" src="" alt="Product Image" width="100">
                            
                            <!-- Hidden input to store current image filename -->
                            <input type="hidden" id="current-image-name" name="current_image">
                        </div>

                        
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Product</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>

        </div>
    </div>

        <div class="row m-4">
            <div class="col">
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Product
                </button>
                <a href="api/api.php" class="btn btn-dark mb-4">API</a>

                
                <table id="DataShowTable" >
                    <thead >
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <!-- <th>is_active</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td><img src='controllers/uploads/" . $row['image'] . "' width='60' height='50'></td>";
                            // echo "<td>" . ($row['is_active'] ? 'Active' : 'Inactive') . "</td>";
                            // echo "<a href='#' class='btn btn-danger m-2' onclick='updateStatus(" . $row['id'] . "); return false;'>Delete</a>";

                            echo "<td>";
                             // Edit button inside your loop
                            echo "<a href='#' class='btn btn-warning m-2' data-bs-toggle='modal' data-bs-target='#updateProductModal' onclick='editProduct(" . $row['id'] . ")'>Edit</a>";
                            echo "<a href='#' class='btn btn-danger m-2' onclick='confirmDelete(" . $row['id'] . "); return false;'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No data found</td></tr>";
                    }
                    ?>
                            
                    </tbody>
                   
                    
                </table>
            </div>

        </div>
    </div>
    
</body>
<script>
    $(document).ready(function() {
      $('#DataShowTable').DataTable({
              
        });
    });

    $(document).ready(function() {
        $('#add-form').parsley();
    });

    $(document).ready(function() {
        $('#update-form').parsley();
    });

      function editProduct(id){

        $.ajax({
            url : 'controllers/ProductController.php?action=edit&id=' + id,
            type: "GET",
            success : function(response){
                const product = JSON.parse(response);

                // console.log(product);

                $('#update-id').val(product.id);
                $('#update-name').val(product.name);
                $('#update-description').val(product.description);
                $('#update-price').val(product.price);
                // $('.current-image').attr('src', 'controllers/uploads/' + product.image);  // Update image preview
                // Show current image preview
                $('.current-image').attr('src', 'controllers/uploads/' + product.image);
            
                // Set the current image filename in the hidden input
                $('#current-image-name').val(product.image);
                
                $('#update-is_active').val(product.is_active);
                
            },
            error : function(xhr, status, error){
                console.error('Error fetching product data: ', error);
            }
        })

      }

    function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'controllers/ProductController.php?action=delete&id=' + id;
        }
    });
}

// function updateStatus(id){
//     $.ajax({
//         url : 'controllers/ProductController.php?action=status&id=' + id',
//         type: "GET",
//         success : function(){
//         },
            // error : function(xhr, status, error){
            //     console.error('Error fetching product data: ', error);
            // }

//     })
// }

</script>
</html>