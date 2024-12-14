<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <title>Distrubuted Food System</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "") {
            header("location: login.php");
        }
    } else {
        header("location: login.php");
    }

    include "../config.php";
    $query = "SELECT * FROM admin WHERE email = '" . $_SESSION['user'] . "'";
    $select = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($select);
    if ($user) {
        $name = $user['name'];
        $admin_id = $user['admin_id'];
    }
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="images/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php if (!empty($name)) {
                                        echo $name;
                                    } else {
                                        echo "User";
                                    } ?></p>
                                    <p class="profile-subtitle"><?php echo $_SESSION['user']; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td>
                        <h2 style="margin-left: 20px">ORDERS</h2>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');

                            $date = date('Y-m-d');
                            echo $date;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label"
                            style="display: flex;justify-content: center;align-items: center;"><img
                                src="images/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All
                            Orders (<?php
                            $list11 = $conn->query("select order_id from orders;");
                            echo $list11->num_rows; ?>)</p>
                    </td>
                </tr>
                <?php
                $sqlmain = "
                SELECT 
                    orders.order_id AS order_id, 
                    orders.user_id,
                    users.name AS user_name,
                    users.contact AS contact,
                    users.address AS user_address,
                    order_items.product_image AS product_image, 
                    order_items.product_name AS product_name, 
                    order_items.unit_price, 
                    order_items.quantity, 
                    order_items.total_price
                FROM 
                    orders
                JOIN 
                    order_items ON orders.order_id = order_items.order_id
                JOIN 
                    users ON orders.user_id = users.user_id";

                $result = $conn->query($sqlmain);
                ?>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Picture</th>
                                            <th class="table-headin">Item</th>
                                            <th class="table-headin">Unit Price</th>
                                            <th class="table-headin">Quantity</th>
                                            <th class="table-headin">Total Price</th>
                                            <th class="table-headin">Client</th>
                                            <th class="table-headin">Contact</th>
                                            <th class="table-headin">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows == 0) {
                                            ?>
                                            <tr>
                                                <td colspan="8">
                                                    <center>
                                                        <p class="heading-main12">There are no orders!</p>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        } else {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><img src="<?php echo $row['product_image']; ?>" width="70"
                                                            alt="Product Image"></td>
                                                    <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
                                                    <td>UGX <?php echo number_format($row["unit_price"], 2); ?></td>
                                                    <td><?php echo (int) $row["quantity"]; ?></td>
                                                    <td>UGX <?php echo number_format($row["total_price"], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($row["user_name"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["contact"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["user_address"]); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </td>
                </tr>

            </table>
        </div>
    </div>
    </div>
</body>

</html>