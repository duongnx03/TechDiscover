<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/99cf1e4b98.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../image/logocr.png" type="image/png">
    <title>Category</title>
    <script>
        function confirmDelete(brand_id) {
            if (confirm('Are you sure you want to remove this brand?')) {
                window.location.href = 'branddelete.php?brand_id=' + brand_id;
            }
        }
        
        function confirmDelete(cartegory_id) {
            if (confirm('Are you sure you want to delete this category?')) {
                window.location.href = 'cartegorydelete.php?cartegory_id=' + cartegory_id;
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>ADMIN</h1>
    </header>