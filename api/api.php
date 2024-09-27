<?php

header("Content-Type: application/json");

// Include database connection
include_once('../lib/dbconnect.php');

// Instantiate Database object and establish a connection
$database = new Database();
$conn = $database->getConnection();

// Check the connection
if (!$conn) {
    echo json_encode(["message" => "Database Connection Failed"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$response = array();

switch ($method) {
    case 'GET':
        // Fetch a single product if ID is provided, otherwise fetch all products
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM tbl_product WHERE id = $id";
        } else {
            $sql = "SELECT * FROM tbl_product";
        }

        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $response[$i]['id'] = $row['id'];
                    $response[$i]['name'] = $row['name'];
                    $response[$i]['description'] = $row['description'];
                    $response[$i]['price'] = $row['price'];
                    $response[$i]['image'] = $row['image'];
                    $i++;
                }
                echo json_encode($response, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(["message" => "No products found"]);
            }
        } else {
            echo json_encode(["message" => "Query failed"]);
        }
        break;

    case 'POST':
        // Handle POST request - inserting new data
        $inputData = json_decode(file_get_contents("php://input"), true);

        if (!empty($inputData['name']) && !empty($inputData['description']) && !empty($inputData['price'])) {
            $name = $inputData['name'];
            $description = $inputData['description'];
            $price = $inputData['price'];
            $image = isset($inputData['image']) ? $inputData['image'] : '';

            $sql = "INSERT INTO tbl_product (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
            
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["message" => "Product added successfully"]);
            } else {
                echo json_encode(["message" => "Failed to add product"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input data"]);
        }
        break;

    case 'PUT':
        // Handle PUT request - updating data
        $inputData = json_decode(file_get_contents("php://input"), true);
        
        if (!empty($inputData['id']) && !empty($inputData['name']) && !empty($inputData['description']) && !empty($inputData['price'])) {
            $id = intval($inputData['id']);
            $name = $inputData['name'];
            $description = $inputData['description'];
            $price = $inputData['price'];
            $image = isset($inputData['image']) ? $inputData['image'] : '';

            $sql = "UPDATE tbl_product SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
            
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["message" => "Product updated successfully"]);
            } else {
                echo json_encode(["message" => "Failed to update product"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input data"]);
        }
        break;

    case 'DELETE':
        // Handle DELETE request - deleting data
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "DELETE FROM tbl_product WHERE id = $id";
            
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["message" => "Product deleted successfully"]);
            } else {
                echo json_encode(["message" => "Failed to delete product"]);
            }
        } else {
            echo json_encode(["message" => "ID not provided"]);
        }
        break;

    default:
        echo json_encode(["message" => "Unsupported Request Method"]);
        break;
}

// Close the database connection
mysqli_close($conn);

?>
