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

    <title><?= $this->renderSection('title')?></title>
</head>
<body>

<header class="ck-header">
    <div class="ck-header-inner">

        <!-- Logo -->
        <a href="<?=base_url('/')?>" class="ck-logo"><img src="<?= base_url('images/Logo.png')?>" alt="Logo"> </a>

        <div class="slogan">
            <h2 class="text-center ">Sell Faster, Buy cheaper </h2>
        </div>

        <!-- Actions -->
        <div class="ck-header-actions">
                <div class="links">
                    <a href="login" class="text-center"> <i class="fa-solid fa-right-to-bracket"></i> </a>
                    <span>|</span>
                    <a href="register" class="text-center"><i class="fa-solid fa-user-plus"></i></a>
                </div>
        
            <a href="<?= base_url('products/create') ?>" class="ck-sell-btn">
                Sell
            </a>

            <!-- Mobile menu -->
            <button class="ck-menu-btn" id="ckMenuBtn" type="button"
                    aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>
    </div>

    <!-- Mobile menu -->
    <div class="ck-mobile-menu" id="ckMobileMenu">

        <a href="<?= base_url('/') ?>">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-right-to-bracket"></i>
            <span>Signin</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-user-plus"></i>
            <span>Register</span>
        </a>
        
        <a href="<?= base_url('products/create') ?>" class="mobile-sell">
            <i class="fa-solid fa-plus"></i>
            <span>Sell an item</span>
        </a>

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
    <script>
    const ckMenuBtn = document.getElementById('ckMenuBtn');
    const ckMobileMenu = document.getElementById('ckMobileMenu');

    ckMenuBtn.addEventListener('click', () => {
        ckMobileMenu.classList.toggle('active');
    });
</script>
</body>
</html>