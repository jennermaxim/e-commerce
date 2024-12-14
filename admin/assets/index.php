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
                                            <th class="table-headin">User Name</th> <!-- New Column -->
                                            <th class="table-headin">Address</th> <!-- New Column -->
                                            <th class="table-headin">Events</th>
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
                                                    <td><img src="<?php echo $row['product_image']; ?>" width="50"
                                                            alt="Product Image"></td>
                                                    <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
                                                    <td>UGX <?php echo number_format($row["unit_price"], 2); ?></td>
                                                    <td><?php echo (int) $row["quantity"]; ?></td>
                                                    <td>UGX <?php echo number_format($row["total_price"], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($row["user_name"]); ?></td>
                                                    <!-- Display User Name -->
                                                    <td><?php echo htmlspecialchars($row["user_address"]); ?></td>
                                                    <!-- Display Address -->
                                                    <td>
                                                        <div style="display:flex;justify-content: center;">
                                                            <a href="?action=edit&id=<?php echo $row['order_id']; ?>"
                                                                class="non-style-link">
                                                                <button
                                                                    class="btn-primary-soft btn button-icon btn-edit">Edit</button>
                                                            </a>
                                                            <a href="?action=view&id=<?php echo $row['order_id']; ?>"
                                                                class="non-style-link">
                                                                <button
                                                                    class="btn-primary-soft btn button-icon btn-view">View</button>
                                                            </a>
                                                            <a href="?action=drop&id=<?php echo $row['order_id']; ?>&name=<?php echo htmlspecialchars($row['product_name']); ?>"
                                                                class="non-style-link">
                                                                <button
                                                                    class="btn-primary-soft btn button-icon btn-delete">Remove</button>
                                                            </a>
                                                        </div>
                                                    </td>
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
    <?php
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="index.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(<?php echo substr($nameget, 0, 40) ?>).
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <a href="delete-patient.php?id=<?php echo $id; ?>" class="non-style-link">
                                <button class="btn-primary btn"
                                    style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"
                                    <font class="tn-in-text">&nbsp;Yes&nbsp;</font>
                                </button>
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="index.php" class="non-style-link">
                                <button class="btn-primary btn"
                                    style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                    <font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font>
                                </button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>
            <?php
        } elseif ($action == 'view') {
            $sqlmain = "select * from patient where p_id='$id'";
            $result = $link->query($sqlmain);
            $row = $result->fetch_assoc();
            $p_id = $row["p_id"];
            $name = $row["name"];
            $tel = $row["contact"];
            $email = $row["email"];
            $dob = $row["dob"];
            $address = $row["address"];
            ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="index.php">&times;</a>
                        <div class="content">
                            <h2>Hospital Management System</h2><br>
                        </div>
                        <div style="display: flex;justify-content: center; margin-bottom: 50px">
                            <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">
                                                View
                                                Details.</p><br>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $name; ?><br><br>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $tel; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Email" class="form-label">Email: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $email; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="dateOfBirth" class="form-label">Date of Birh: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $dob; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="address" class="form-label">Address: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $address; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href="index.php">
                                                <input type="button" value="OK" class="login-btn btn-primary-soft btn">
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
            <?php
        } elseif ($action == 'add') {
            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );
            if ($error_1 != '4') {
                ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <a class="close" href="index.php">&times;</a>
                            <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                        <tr>
                                            <td class="label-td" colspan="2"><?php echo $errorlist[$error_1]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">
                                                    Add New Patient.</p><br><br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <form action="add-patient.php" method="POST" class="add-new-form">
                                                <td class="label-td" colspan="2">
                                                    <label for="name" class="form-label">Name: </label>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="text" name="name" class="input-text" placeholder="Patient Name"
                                                    required><br>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="Tele" class="form-label">Telephone: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number"
                                                    required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="Email" class="form-label">Email: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="email" name="email" class="input-text" placeholder="Email Address"
                                                    required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="dataOfBirth" class="form-label">Date of Birth</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="date" name="date_of_birth" class="input-text" required>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="address" class="form-label">Address: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="text" name="address" class="input-text" placeholder="Address" required>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="reset" value="Reset"
                                                    class="login-btn btn-primary-soft btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" value="Add" class="login-btn btn-primary btn">
                                            </td>

                                        </tr>
                                        </form>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </center>
                        <br><br>
                    </div>
                </div>
                <?php

            } else {
                ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <br><br><br><br>
                            <h2>New Record Added Successfully!</h2>
                            <a class="close" href="index.php">&times;</a>
                            <div class="content">
                            </div>
                            <div style="display: flex;justify-content: center;">

                                <a href="index.php" class="non-style-link"><button class="btn-primary btn"
                                        style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                        <font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font>
                                    </button></a>

                            </div>
                            <br><br>
                        </center>
                    </div>
                </div>
                <?php
            }
        } elseif ($action == 'edit') {
            $sqlmain = "select * from patient where p_id='$id'";
            $result = $link->query($sqlmain);
            $row = $result->fetch_assoc();
            $p_id = $row["p_id"];
            $name = $row["name"];
            $tel = $row["contact"];
            $email = $row["email"];
            $dob = $row["dob"];
            $address = $row["address"];

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );
            if ($error_1 != '4') {
                ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <a class="close" href="index.php">&times;</a>
                            <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                        <tr>
                                            <td class="label-td" colspan="2"><?php echo $errorlist[$error_1]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">
                                                    Edit Patient Details.</p>
                                                Patient ID : <?php echo $id; ?> (Auto Generated)<br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <form action="edit-patient.php" method="POST" class="add-new-form">
                                                    <label for="Email" class="form-label">Email: </label>
                                                    <input type="hidden" value="<?php echo $id; ?>" name="id00">
                                                    <input type="hidden" name="oldemail" value="<?php echo $email; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="email" name="email" class="input-text" placeholder="Email Address"
                                                    value="<?php echo $email; ?>" required><br>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td class="label-td" colspan="2">
                                                <label for="name" class="form-label">Name: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="text" name="name" class="input-text" placeholder="Doctor Name"
                                                    value="<?php echo $name; ?>" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="Tele" class="form-label">Telephone: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number"
                                                    value="<?php echo $tel; ?>" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="dateOfBirth" class="form-label">Date of Birth: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="date" name="date_of_birh" class="input-text"
                                                    value="<?php echo $dob; ?>" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="address" class="form-label">Address: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="tel" name="address" class="input-text" value="<?php echo $address; ?>"
                                                    required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="reset" value="Reset"
                                                    class="login-btn btn-primary-soft btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input type="submit" value="Save" class="login-btn btn-primary btn">
                                            </td>

                                        </tr>

                                        </form>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </center>
                        <br><br>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="index.php">&times;</a>
                            <div class="content">
                            </div>
                            <div style="display: flex;justify-content: center;">

                                <a href="index.php" class="non-style-link">
                                    <button class="btn-primary btn"
                                        style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                        <font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font>
                                    </button>
                                </a>
                            </div>
                            <br><br>
                        </center>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
    </div>
</body>

</html>