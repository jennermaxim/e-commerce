<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/headerr.css">
</head>

<body>
    <?php
    session_start();
    include("config.php");

    if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
        // Sanitize user input to prevent SQL injection
        $userEmail = mysqli_real_escape_string($conn, $_SESSION["user"]);
        $query = "SELECT * FROM users WHERE email = '$userEmail'";

        $select = mysqli_query($conn, $query);

        if ($select) {
            $user = mysqli_fetch_assoc($select);
            if ($user) {
                $name = $user['name'];
            } else {
                // Handle case where no user is found
                $name = "User";
            }
        } else {
            // Query execution failed, log or display error message
            die("Query failed: " . mysqli_error($conn));
        }
    }
    ?>
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
            if (isset($_SESSION["user"])) {
                if (($_SESSION["user"]) == "") {
                    ?>
                    <a href="./login.php" class="a-header"><i class="fa fa-fw fa-user"></i> Login</a>
                    <a href="./register.php" class="a-header"><i class="fa fa-fw fa-user"></i> SignUp</a>
                    <?php
                } else {
                    ?>
                    <a href="#" class="a-header"><i class="fa fa-fw fa-user"></i> Hi,
                        <b><?php echo htmlspecialchars($name); ?></b>
                    </a>
                    <a href="./logout.php" onclick="confirmations();" class="a-header">
                        <i class="fa fa-fw fa-user"></i>Logout
                    </a>
                    <?php
                }
            } else {
                ?>
                <a href="./login.php" class="a-header"><i class="fa fa-fw fa-user"></i> Login</a>
                <a href="./register.php" class="a-header"><i class="fa fa-fw fa-user"></i> SignUp</a>
                <?php
            }
            ?>

            <!-- <a href="./cart.php"><i class="fa fa-fw fa-shopping-cart"></i> Cart</a> -->
            <a href="cart.php">
                <div class="cart">
                    <!-- <i class="bi bi-cart2"></i> -->
                    <i class="fa fa-fw fa-shopping-cart"></i>
                    <div id="cartAmount" class="cartAmount">0</div>
                </div>
            </a>
            <a href="javascript:void(0);" style="font-size:38px;" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!--About Us section-->
    <section class="about-container" id="about">
        <div class="about-box">
            <div class="about-header">
                About Our Company
                <a href="#" class="btn-close">&times;</a>
            </div>
            <p class="about-text">
                We as that company are an online based company that aims at providing satisfaction to our customers for
                a better shopping experience. We have been operating since 2010 and we have been developing since then.
                Over a decade ago, we started an online shopping platform I sell over thousands of commodities of
                various brands around the world. Today we have become the leading e-commerce platform because of how we
                deliver our services to our customers. We as a company believe that everyone deserves to have a
                convenient, fast and easy shopping experience with variety of choice to make. Given the number of years
                we have been operating, our shopping platform has become successful and we hope to attain more success.
                We are excited to help you in your shopping journey with us.
            </p>
        </div>
    </section>


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
</body>

</html>