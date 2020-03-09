<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/style.css">
    <title><?php echo SITENAME; ?></title>

     
 <!-- 
   /**
     * Not a question just a tip to make the refresh CSS a bit easier.
    *I always add ..../css/style.css?v=<?= time(); ?> behind my .css 
    *to make it refresh every time. Just don't forget to remove it in production.
     */ 

     Realized that Ctrl + F5 will solve the problem as well (it refreshed the page with clearing the cache)
  --> 

 </head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
<div class="container">

