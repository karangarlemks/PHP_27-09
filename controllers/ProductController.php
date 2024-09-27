<?php

include '../lib/dbconnect.php';
include '../lib/Model.php';


// $model = $conn->model();

$database = new Database();
$conn = $database->getConnection();

$model = new Model($conn);

// print_r($model);exit;
// Check if the form is submitted Inserted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] == 'insert') {
    // Debugging echo
    echo "Form is submitted!<br>"; 

    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $image = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $image;

        // Move uploaded file to server directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No image uploaded.";
    }

    echo "Form data received: $name, $description, $price<br>";
        // Prepare the value for the insert function
        $table = "tbl_product";
        $value = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image
        ];
        // $value = "('$name', '$description', '$price')";
        // Call the insert method
        $q = $model->insert($table, $value);
        if ($q > 0) {
            echo "Record inserted successfully";
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error inserting record";
        }
}




// Check if the action is 'delete' and an id is provided
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID to prevent SQL injection

    // Call the model's delete function
    if ($model->deleteProduct($id)) {
        // If deletion is successful, redirect to the listing page with success message
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error deleting record.";
    }
}

// Updated Data 
$controller = new ProductController();

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $controller->edit();  // Call the edit function to fetch product data
}

// // Update Function
// if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_POST['id'])) {
//     $id = intval($_POST['id']); // Sanitize the ID to prevent SQL injection

//     echo "Form is submitted!!!1<br>";
   
//     $model = new Model($conn);

//     // Get form data
//     $name = $_POST['name'];
//     $description = $_POST['description'];
//     $price = $_POST['price'];
//     // $image = $_POST['image'];

//     // Handle the uploaded image
//     if (!empty($_FILES['image']['name'])) {
//         $targetDir = "uploads/";
//         $image = basename($_FILES['image']['name']);
//         $targetFilePath = $targetDir . $image;

//         // Move uploaded file to server directory
//         if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
//             echo "Image uploaded successfully!";
//         } else {
//             echo "Error uploading image.";
//         }
//     } else {
//         echo "No image uploaded.";
//     }

//     $table = "tbl_product";
//     $value = [
//         'name' => $name,
//         'description' => $description,
//         'price' => $price,
//         'image' => $image
//     ];

//     $q = $model->update($table, $value,$id);
//         if ($q > 0) {
//             header("Location: ../index.php");
//             exit();
//         } else {
//             echo "Error inserting record";
//         }
//   // Call the edit function to fetch product data
// }

// Update Function
if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitize the ID to prevent SQL injection

    echo "Form is submitted!!!1<br>";

    $model = new Model($conn);

    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle the uploaded image
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $image = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $image;

        // Move uploaded file to server directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image.";
        }
    } else {
        // No new image uploaded, keep the old image from the hidden input
        $image = $_POST['current_image']; // Ensure the hidden input 'current_image' is present in your form
        echo "Using old image.";
    }

    // Define the table and the updated values
    $table = "tbl_product";
    $value = [
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'image' => $image // Use the new or old image, depending on whether a new file was uploaded
    ];

    // Perform the update operation
    $q = $model->update($table, $value, $id);

    if ($q > 0) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error updating record";
    }
}



class ProductController{

    private $conn ;

    public function __construct(){

        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // $productModel = new Model();
            $model = new Model($this->conn);

            $product = $model->getProductById($id);

            // Return JSON response for the AJAX call
            echo json_encode($product);
        }
    }
}
  
?>
