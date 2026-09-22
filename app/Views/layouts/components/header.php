
<?php if(auth()->loggedIn()) :?>
    <header >
        <div class="container profile-header">

        <div class="logo">
            <a href="<?=base_url('/')?>"><img src="<?= base_url('images/Logo.png')?>" alt="Logo"> </a>
        </div>
        <div class="header-right">
            <div class="header-icon"><i class="icon-copy fa fa-bookmark-o" aria-hidden="true"></i></div>
            <div class="header-icon"><i class="icon-copy dw dw-chat3"></i></div>
            <div class="header-icon"><i class="icon-copy dw dw-bell"></i></div>
            <div class="header-icon"><i class="icon-copy dw-list"></i></div>
            <div class="header-icon"><a href="<?= base_url('profile')?>"><i class="icon-copy dw dw-user text-dark"></i></a></div>
            <a href="<?= base_url('product/create') ?>"><button class="btn btn-success px-4">SELL</button></a>
        </div>
    </header>

<!-- MOBILE OFFCANVAS MENU -->
<!-- <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
  <div class="offcanvas-header  text-white">
    <img src="images/Logo.png" alt="CampusKart Logo" class="logo">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <a href="#" class="d-block py-2 text-dark">Sign in</a>
    <a href="#" class="d-block py-2 text-dark">Registration</a>
    <hr>
    <a href="#" class="d-block py-2 text-dark">Categories</a>
    <a href="#" class="d-block py-2 text-dark   ">My Ads</a>
  </div>
</div> -->

<?php else : ?>

    <header class="w-100 shadow-sm" >
        <nav class="container py-2 px-2">
        
                <div class="logo ">
                    <img src="<?= base_url('images/Logo.png')?>" alt="">
                </div>
                <div class="slogan">
                    <h2 class="text-center ">Sell Faster, Buy cheaper </h2>
                </div>
                <div class="links">
                    <a href="login" class="text-center">Signin </a>
                    <span>|</span>
                    <a href="register" class="text-center">Register</a>
                   <a href="login"> <button class="btn btn-success  ">Sell</button></a>
                </div>
        
        </nav>
    </header>

<?php endif; ?>
