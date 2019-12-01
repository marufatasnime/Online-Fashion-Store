<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- BOOTSTRAP CSS includes -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,400,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet"> 
  <!-- Defined Stylesheet -->
  <link rel="stylesheet" href="<?php url_for('css/style.css'); ?>">
  <title>Flamingo</title>
</head>
<body>
  <?php include 'includes/_navbar.php'; ?>
  <?php include 'includes/_messages.php'; ?>
  
  <?php block_body($context) ?>

  <!-- BOOTSTRAP JS includes -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Defined Scripts -->
  <script src="<?php url_for('js/script.js'); ?>"></script>
</body>
</html>