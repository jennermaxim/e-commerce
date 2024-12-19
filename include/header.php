<?php
include("config.php");

if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    $userEmail = mysqli_real_escape_string($conn, $_SESSION["user"]);
    $query = "SELECT * FROM users WHERE email = '$userEmail'";

    $select = mysqli_query($conn, $query);

    if ($select) {
        $user = mysqli_fetch_assoc($select);
        if ($user) {
            $name = $user['name'];
        } else {
            $name = "User";
        }
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="assets/javascript/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Distributed Food System</title>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <a href="index.php" class="logo">
            <h2>DFS</h2>
        </a>
        <div class="navbar-centered">
            <input class="search-bar" type="text" placeholder="🔍 Search..">
            <button class="search-button">Search</button>
        </div>
        <div class="navbar-right">
            <?php
            if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
                ?>
                <a href="#" class="a-header"><i class="fa fa-fw fa-user"></i> Hi,
                    <b><?php echo htmlspecialchars($name); ?></b>
                </a>
                <a href="./logout.php" onclick="confirmations();" class="a-header">
                    <i class="fa fa-fw fa-user"></i>Logout
                </a>
                <?php
            } else {
                ?>
                <a href="./login.php" class="a-header"><i class="fa fa-fw fa-user"></i> Login</a>
                <a href="./register.php" class="a-header"><i class="fa fa-fw fa-user"></i> SignUp</a>
                <?php
            }
            ?>
            <a href="cart.php">
                <div class="cart">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                    <div id="cartAmount" class="cartAmount">0</div>
                </div>
            </a>
            <a href="javascript:void(0);" style="font-size:38px;" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>