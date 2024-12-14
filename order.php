<?php
session_start();
include 'config.php';

$query = "SELECT * FROM users WHERE email = '" . $_SESSION['user'] . "'";
$select = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($select);
$user_id = $user ? $user['user_id'] : null;

$data = json_decode(file_get_contents("php://input"), true);
$response = ["success" => false, "error" => ""];

if ($user_id && $data && isset($data['totalAmount']) && isset($data['items'])) {
    $totalAmount = $data['totalAmount'];

    // Insert main order
    $sql_order = "INSERT INTO orders (user_id, totalAmount) VALUES ('$user_id', '$totalAmount')";
    if ($conn->query($sql_order)) {
        $order_id = $conn->insert_id;

        // Prepare to insert each item
        $insert_items_success = true;
        foreach ($data['items'] as $item) {
            $imgSrc = $conn->real_escape_string($item['imgSrc']);
            $name = $conn->real_escape_string($item['name']);
            $unitPrice = (float) $item['unitPrice'];
            $quantity = (int) $item['quantity'];
            $itemTotalPrice = (float) $item['itemTotalPrice'];

            $sql_item = "INSERT INTO order_items (order_id, product_image, product_name, unit_price, quantity, total_price)
                         VALUES ('$order_id', '$imgSrc', '$name', '$unitPrice', '$quantity', '$itemTotalPrice')";

            if (!$conn->query($sql_item)) {
                $insert_items_success = false;
                $response["error"] = $conn->error;
                break;
            }
        }

        if ($insert_items_success) {
            $response["success"] = true;
        } else {
            // Rollback order if item insertion fails
            $conn->query("DELETE FROM orders WHERE id = '$order_id'");
        }
    } else {
        $response["error"] = $conn->error;
    }
} else {
    $response["error"] = "Invalid data received or user not logged in.";
}

header('Content-Type: application/json');
echo json_encode($response);