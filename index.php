<?php
session_start();
include('include/header.php')
    ?>

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