<?php
include('include/header.php')
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributed Food System</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
    <br>
    <div style="text-align:center">
        <span class="dot" id="dot1" onclick="currentSlide(1)"></span>
        <span class="dot" id="dot2" onclick="currentSlide(2)"></span>
        <span class="dot" id="dot3" onclick="currentSlide(3)"></span>
    </div>
    <div class="about-texts">
        <h1 class="title">Distributed Food System</h1>
    </div>

    <div class="shop" id="shop"></div>

</body>
<script src="./assets/javascript/data.js"></script>
<script src="./assets/javascript/index.js"></script>

</html>

<?php
include('include/footer.php')
    ?>