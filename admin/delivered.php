<?php
include "../config.php";
if ($_GET) {
    $id = $_GET['id'];
    $query = "UPDATE order_items SET status = 1 WHERE item_id = $id";
    $update = mysqli_query($conn, $query);
    header("Location: index.php");
}
