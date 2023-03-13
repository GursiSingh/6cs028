<!DOCTYPE html>
<html>
    <head>
        <!--Meta
            - charset
            - viewport
            - keywords
        -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="sport, football, soccer, formula 1, f1, soccer">
        
        <!--Bootstrap CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaPNhMdEHw8BklQYjECBPYW6kqT2eQFU8"></script>   

        <!-- SET GLOBAL BASE URL -->
        <script>var base_url = '<?php echo base_url() ?>';</script>

        <!-- Bootrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        
        <!-- CSS -->
        <link rel="stylesheet" href="<?= base_url('/css/mystyles.css');?>" />      

        <!--GOOGLE FONTS-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <!--Page Title-->
        <title><?= esc($title) ?></title>
    </head>
    <body class="d-flex flex-column vh-100 bg-dark">
        <?php if($user != null){
            echo view("templates/navbar", $user);
        }
        else{
            echo view("templates/navbar1");
        }?>
        <div class="bg-dark bg-gradient">

        
        
