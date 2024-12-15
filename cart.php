<?php
include('include/header.php');
if (isset($_SESSION["user"])) {
  if (($_SESSION["user"]) == "") {
    header("location: login.php");
  }
} else {
  header("location: login.php");
}

$query = "SELECT * FROM users WHERE email = '" . $_SESSION['user'] . "'";
$select = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($select);
if ($user) {
  $name = $user['name'];
  $user_id = $user['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="stylesheet" href="./assets/css/index.css">
  <script src="assets/javascript/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body style="background-color: rgb(243, 243, 243);">
  <div class="main">
    <div id="label" class="text-center"></div>
    <div class="shopping-cart" id="shopping-cart"></div>
  </div>
</body>
<script src="./assets/javascript/data.js"></script>
<script src="./assets/javascript/carts.js"></script>
<script src="assets/javascript/order.js"></script>

</html>