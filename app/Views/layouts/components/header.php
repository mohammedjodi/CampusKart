
<?php if(auth()->loggedIn()) :?>
    <header class="ck-header">
    <div class="ck-header-inner">

        <!-- Logo -->
        <a href="<?=base_url('/')?>" class="ck-logo"><img src="<?= base_url('images/Logo.png')?>" alt="Logo"> </a>

        <div class="slogan">
            <h2 class="text-center ">Sell Faster, Buy cheaper </h2>
        </div>

        <!-- Actions -->
        <div class="ck-header-actions">

            <a href="#" class="ck-icon-btn" aria-label="Saved">
                <i class="fa-regular fa-bookmark"></i>
            </a>

            <a href="#" class="ck-icon-btn" aria-label="Messages">
                <i class="fa-regular fa-comment"></i>
            </a>

            <a href="#" class="ck-icon-btn" aria-label="Notifications">
                <i class="fa-regular fa-bell"></i>
            </a>
             <a href="<?= base_url('logout')?>" class="ck-icon-btn" aria-label="Profile">
                 </i>
            </a>

            <a href="<?= base_url('profile')?>" class="ck-icon-btn" aria-label="Profile">
                <i class="fa-regular fa-user"></i>
            </a>
           
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
            <i class="fa-regular fa-bookmark"></i>
            <span>Saved</span>
        </a>

        <a href="#">
            <i class="fa-regular fa-comment"></i>
            <span>Messages</span>
        </a>

        <a href="#">
            <i class="fa-regular fa-bell"></i>
            <span>Notifications</span>
        </a>

        <a href="<?= base_url('profile')?>">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
        <a href="<?= base_url('logout')?>">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>


        <a href="<?= base_url('products/create') ?>" class="mobile-sell">
            <i class="fa-solid fa-plus"></i>
            <span>Sell an item</span>
        </a>

    </div>
</header>
<script>
    const ckMenuBtn = document.getElementById('ckMenuBtn');
    const ckMobileMenu = document.getElementById('ckMobileMenu');

    ckMenuBtn.addEventListener('click', () => {
        ckMobileMenu.classList.toggle('active');
    });
</script>

<?php else : ?>

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
<script>
    const ckMenuBtn = document.getElementById('ckMenuBtn');
    const ckMobileMenu = document.getElementById('ckMobileMenu');

    ckMenuBtn.addEventListener('click', () => {
        ckMobileMenu.classList.toggle('active');
    });
</script>
<?php endif; ?>
