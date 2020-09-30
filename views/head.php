<!DOCTYPE html>
<html lang="en">
<head>
    <title>RHPS FACHE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--====================Isti za sve do ove linije===========================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--====================Samo za index===========================-->
    <?php if(isset($_GET['page'])&&$_GET['page']=='index'):?>
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
    <?php endif;?>
    <!--===============================================================================================-->
    <?php
    if(isset($_GET['page'])&&(($_GET['page']!="index")||($_GET['page']!="products"))):?>
        <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <?php endif;?>
    <?php
    if(isset($_GET['page'])&&(($_GET['page']!="products"))):?>
        <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
    <?php endif;?>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <?php
    if(isset($_GET['page'])&&(($_GET['page']=="registracija")||($_GET['page']=="unos")||($_GET['page']=="izmena"))):?>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <?php endif;?>
</head>
<body class="animsition">