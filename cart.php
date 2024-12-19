<?php
session_start();
if (isset($_SESSION["user"])) {
  if (($_SESSION["user"]) == "") {
    header("location: login.php");
  }
} else {
  echo "<script>window.location.href ='login.php'</script>";
}
include('include/header.php');
?>

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