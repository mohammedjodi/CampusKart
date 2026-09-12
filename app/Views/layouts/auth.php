<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="<?= base_url('images/campuskart_logo.png')?>"
    />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
        <!-- Font awesome  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- CSS DESKAPP  -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendors/styles/core.css')?> "/>
    <link
        rel="stylesheet"
        type="text/css"
        href="<?= base_url('vendors/styles/icon-font.min.css')?>"
    />
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendors/styles/style.css')?>"/> 
    <link rel="stylesheet" type="text/css" href="<?= base_url('src/styles/style.css ')?>"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css')?>">
    <!-- Default CSS -->
    <link rel="stylesheet" href="<?= base_url('css/MultiStepForm.css')?>">

    <link rel="stylesheet" href="<?= base_url('css/styles.css')?>">

    <title>Multistep Form</title>
</head>
<body>

     <header class="site-header">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between py-2 px-2">
      
      <!-- Left: Hamburger + Logo IMG -->
      <div class="d-flex align-items-center gap-2">
        <!-- Logo Image -->
        <a href="/">
          <img src="<?= base_url('images/Logo.png')?>" alt="CampusKart Logo" class="header-logo">
        </a>
      </div>

       
        <div class=" d-flex gap-2 text-white  slogan">
          <a href="/login" class="text-white text-decoration-none auth-links">Signin</a>
          <span class="auth-links">|</span>
          <a href="/register" class="text-white text-decoration-none auth-links">Register</a>
        </div>

      </div>

    </div>
  </div>
</header>





	<?= $this->renderSection("content")?>
       
    <!--  DeskApp js -->
    <script src="<?=base_url('vendors/scripts/core.js')?>"></script>
    <script src="<?=base_url('vendors/scripts/script.min.js')?>"></script>
    <script src="<?=base_url('vendors/scripts/process.js')?>"></script>
    <script src="<?=base_url('vendors/scripts/layout-settings.js')?>"></script>
    <!-- Bootstrap js -->
     <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
     <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Defualt js -->

    <script src="<?= base_url('js/MultiStepForm.js')?>"></script>
</body>
</html>