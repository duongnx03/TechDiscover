<?php
include "header.php";
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