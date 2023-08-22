<?php
include "header.php";
include "navbar.php";
include "survey_onclick.php";
?>

<style>
     .khaosat{
        margin-top: 150px;
        margin-bottom: 10px;
     }
     .khaosat h1 {
        text-align: center;
        color: #444444;
            font-family: monospace;
            font-size: 45px;
     }
     .khaosat p{
        font-family: monospace;
            
            font-size: 20px;
            margin-left: 10%; 
            margin-right: 10%;
            text-align: center;
            margin-top: 20px;
     }
     .khaosat h4 {
        font-family: 'Courier New', Courier, monospace;
        text-align: center;
        color: #aaaaaa;
     }


input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px; /* Khoảng cách giữa nút Submit và các radio buttons */
    margin-left: 47%
}


input[type="submit"]:hover {
    background-color: #45a049;
}

</style>
<script>
function validateSurveyForm() {
    var webQuality = document.getElementsByName("web");
    var priceFeelings = document.getElementsByName("gia");
    var oldProductQuality = document.getElementsByName("spcu");

    var webSelected = false;
    var priceSelected = false;
    var oldProductSelected = false;

    for (var i = 0; i < webQuality.length; i++) {
        if (webQuality[i].checked) {
            webSelected = true;
            break;
        }
    }

    for (var i = 0; i < priceFeelings.length; i++) {
        if (priceFeelings[i].checked) {
            priceSelected = true;
            break;
        }
    }

    for (var i = 0; i < oldProductQuality.length; i++) {
        if (oldProductQuality[i].checked) {
            oldProductSelected = true;
            break;
        }
    }

    if (!webSelected || !priceSelected || !oldProductSelected) {
        alert("Please complete all surveys before submitting.");
        return false;
    }
}
</script>
<!-- --------------- survey_onclick ------------------------>
<style>
        /* Lớp mờ */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        #popup {
            display: none;
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 30px 10px 40px;
            border-radius: 7px;
            width: 600px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        #popup h1 {
            text-align: center;
            color: #444444;
            font-family: monospace;
            font-size: 35px;
        }

        #popup p {
            font-family: monospace;
            line-height: 20px;
            font-size: 15px;
        }

        #closeButton {
            background-color: red;
            color: #fff;
            padding: 6px 18px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 80px;
            margin-left: 40%;
        }
    </style>
</head>
<body>
    <!-- Lớp mờ -->
    <div id="overlay">

    <div id="popup">
        <h1>Dear Customers!</h1><br>
        <p>Welcome to DealZone survey site.</p>
        <p>We would like to collect your opinions on our future products.</p>
        <p>Even when you give us your opinion, you will receive a promotion code!</p>
        <p>We hope this little gift makes you happy during your purchasing.</p><br>
        <div id="closeButton">Close</div>
    </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const popup = document.getElementById("popup");
            const overlay = document.getElementById("overlay");
            const closeButton = document.getElementById("closeButton");

            closeButton.addEventListener("click", function() {
                popup.style.display = "none";
                overlay.style.display = "none";
            });

            // Hiển thị popup và lớp mờ khi trang web tải xong
            popup.style.display = "block";
            overlay.style.display = "block";
        });
    </script>
</body>
<!-- ----------------end survey-onclick --------------------- -->

<!------------------------------------------ survey --------------------------------------------->
<div class="khaosat">
            <h1>Send Us Opinion now!</h1>
            <h4>Please complete all surveys</h4><br>
            <form action="survey_xuatcode.php" method="post" onsubmit="return validateSurveyForm();">
            <p>How is the service quality of the website? 
            <input type="radio" name="web" value="good"> Good
            <input type="radio" name="web" value="average"> Average
            <input type="radio" name="web" value="poor"> Poor</p> <br>

            <p>How do you feel about our prices? 
            <input type="radio" name="gia" value="reasonable"> Reasonable
            <input type="radio" name="gia" value="quite expensive"> Quite expensive
            <input type="radio" name="gia" value="very expensive"> Very expensive </p><br>

            <p>How is the quality of the old product? 
            <input type="radio" name="spcu" value="good"> Good
            <input type="radio" name="spcu" value="average"> Average
            <input type="radio" name="spcu" value="poor"> Poor </p>

            <br><br>
            <input type="submit" value="Submit">
    </div>


<!------------------------------------------end-------------------------------------->
<?php
include "footer.php"
?>