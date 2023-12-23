<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>onlineshop</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/pe.css">
        <!-- online css -->
    <link rel="stylesheet" href="./assets/boostrap.min.css">
    <link rel="stylesheet" href="./assets/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/scss/_animated.scss">
    <link rel="stylesheet" href="./assets/fontawesome/scss/_icons.scss">

</head>
<body>
    
    <?php
        include './inc/function.php'; 
        include './inc/header.php'; 
        include './inc/navbar.php'; 
        search();
        include './inc/bodyleft.php'; 
        include './inc/footer.php';

        if (isset($_SESSION['user_id'])) {
            echo add_cart($_SESSION['user_id']);
        }
    ?>


</body>
</html>