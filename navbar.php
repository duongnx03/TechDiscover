 <?php
 include "header.php";
 ?>
<header>
        <div class="logo">
            <img src="image/logocr.png" alt="" width="80px" height="65 px">
        </div>

        <div class="menu">
            <li><a href="index.php"> Home</a></li>

            <li><a href="category.php">Shop</a>
                <ul class="sub-menu">
                    <li><a href="category.php"> iPhone</a></li>
                    <li><a href=""> SamSung</a></li>
                    <li><a href=""> Xiaomi</a></li>
                    <li><a href=""> OPPO</a></li>
                    <li><a href=""> Realmei</a></li>
                </ul>
            </li>

            <li><a href="">Sale</a></li> 

            <li><a href=""> Survey</a></li>

            <li><a href="blog.php">Blog</a></li>

            <li><a href="">About Shop</a>
                <ul class="sub-menu">
                    
                    <li><a href="contact.php">Contac US</a></li>
                    <li><a href="about.php">About US</a></li>
                </ul>
            </li> 
            
        </div>

        <div class="other">
            <li class="search-container"><input type="text" placeholder="search"><a href=""><i class="fa fa-search"></i></a></li>
            <li><a href="contact.php" class="fa fa-paw"></a></li>
            <li><a href="login.php" class="fa fa-user"></a></li>
            <li><a href="cart.php" class="fa fa-shopping-bag"></a></li>
        </div>
    </header>
    <!-----------------------------------------end-navbar--------------------------------------------------->