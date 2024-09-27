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

    <link rel="stylesheet" href="common/style.css">

</head>

<body>

<?php
include('common/header.php');
?>



  <div class="main2">
    <p class="sign" align="center">sign Up</p>
    <form class="form1">
      <input type="email" class="em" name="email" id="email" align="center" placeholder="Email">
      <input class="un " type="text" align="center" name="name" placeholder="Username">
      <input class="pass" type="password" align="center" name="pass1" placeholder="Password">
      <input class="pass" type="password" align="center" name="pass1" placeholder="Re:Password">

      <a class="submit mt-5" align="center">Log in</a>
      <br>
      
    <p class="forgot" align="center"><a href="#">Forgot Password?</a></p>

    <p class="no-access text-center">Already have an accout? <a href="login.php">Log in</a></p>
                   
    </div>

    
</body>

</html>