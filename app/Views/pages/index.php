<?= $this->extend('layouts/pages_layout')?>

<?= $this->section('title')?>
  CampusKart
<?= $this->endSection('title')?>

<?= $this->section('content')?>

<main class="campus-home">

    <!-- =========================================
         SEARCH HERO
    ========================================== -->

    <section class="search-hero">

        <div class="search-hero-content">

            <span class="hero-label">
                CAMPUSKART MARKETPLACE
            </span>

            <h1>
                What are you looking for?
            </h1>

            <form
                action="<?= base_url('products') ?>"
                method="GET"
                class="market-search"
            >

                <div class="campus-select">

                    <i class="fa-solid fa-location-dot"></i>

                    <select name="campus">

                        <option value="">
                            All Campuses
                        </option>

                        <option value="lasu">
                            LASU
                        </option>

                        <option value="unilag">
                            UNILAG
                        </option>

                        <option value="yabatech">
                            YABATECH
                        </option>

                    </select>

                    <i class="fa-solid fa-chevron-down"></i>

                </div>


                <div class="search-input">

                    <input
                        type="search"
                        name="q"
                        placeholder="Search for laptops, phones, textbooks..."
                    >

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                </div>

            </form>

        </div>

    </section>



    <!-- =========================================
         MARKETPLACE CONTENT
    ========================================== -->

    <section class="market-content">

        <div class="market-layout">


            <!-- =================================
                 CATEGORY SIDEBAR
            ================================== -->

            <aside class="category-sidebar">

                <div class="sidebar-title">
                    <h3>Browse Categories</h3>
                </div>


                <a href="<?= base_url('product/listings?category=electronics') ?>"
                   class="sidebar-category">

                    <span class="category-icon">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </span>

                    <span class="category-info">
                        <strong>Electronics</strong>
                        <small>Phones, laptops & more</small>
                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <a href="<?= base_url('products?category=books') ?>"
                   class="sidebar-category">

                    <span class="category-icon">
                        <i class="fa-solid fa-book"></i>
                    </span>

                    <span class="category-info">
                        <strong>Books & Stationery</strong>
                        <small>Textbooks, notes & supplies</small>
                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <a href="<?= base_url('products?category=fashion') ?>"
                   class="sidebar-category">

                    <span class="category-icon">
                        <i class="fa-solid fa-shirt"></i>
                    </span>

                    <span class="category-info">
                        <strong>Fashion</strong>
                        <small>Clothes, shoes & accessories</small>
                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <a href="<?= base_url('products?category=home') ?>"
                   class="sidebar-category">

                    <span class="category-icon">
                        <i class="fa-solid fa-house"></i>
                    </span>

                    <span class="category-info">
                        <strong>Home & Living</strong>
                        <small>Hostel & apartment essentials</small>
                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <a href="<?= base_url('products?category=sports') ?>"
                   class="sidebar-category">

                    <span class="category-icon">
                        <i class="fa-solid fa-futbol"></i>
                    </span>

                    <span class="category-info">
                        <strong>Sports & Outdoors</strong>
                        <small>Sports gear & equipment</small>
                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <a href="<?= base_url('products?category=services') ?>"
                   class="sidebar-category">

                    <span class="category-icon">
                        <i class="fa-solid fa-briefcase"></i>
                    </span>

                    <span class="category-info">
                        <strong>Services</strong>
                        <small>Student services & skills</small>
                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <a href="<?= base_url('products/listings') ?>"
                   class="view-categories">

                    View all categories
                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </aside>



            <!-- =================================
                 MAIN MARKETPLACE
            ================================== -->

            <div class="market-main">


                <!-- =================================
                     QUICK ACTIONS
                ================================== -->

                <div class="quick-actions">

                    <a href="<?= base_url('jobs') ?>"
                       class="quick-card quick-blue">

                        <span class="quick-icon">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>

                        <span>
                            <strong>Student Jobs</strong>
                            <small>Find opportunities</small>
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>


                    <a href="<?= base_url('products/create') ?>"
                       class="quick-card quick-green">

                        <span class="quick-icon">
                            <i class="fa-solid fa-cart-plus"></i>
                        </span>

                        <span>
                            <strong>Sell an Item</strong>
                            <small>List something today</small>
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>


                    <a href="<?= base_url('products') ?>"
                       class="quick-card quick-orange">

                        <span class="quick-icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </span>

                        <span>
                            <strong>How to Buy</strong>
                            <small>Shop safely on campus</small>
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>



                <!-- =================================
                     TRENDING PRODUCTS
                ================================== -->

                <div class="trending-header">

                    <div>
                        <span class="section-label">
                            CAMPUSKART
                        </span>

                        <h2>
                            Trending Products
                        </h2>

                        <p>
                            Popular items students are checking out.
                        </p>
                    </div>

                    <a href="<?= base_url('products/listings#all-products') ?>"
                       class="view-all">

                        View all

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>



                <div class="trending-products">


                    <!-- PRODUCT 1 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-1.jpg') ?>"
                                alt="iPhone"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                iPhone 13 Pro 128GB
                            </h3>

                            <strong class="home-price">
                                ₦280,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2h ago
                                </span>

                            </div>

                            <span class="home-condition good">
                                Like New
                            </span>

                        </div>

                    </article>



                    <!-- PRODUCT 2 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-2.jpg') ?>"
                                alt="Laptop"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                HP Pavilion Laptop
                            </h3>

                            <strong class="home-price">
                                ₦350,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    UNILAG
                                </span>

                                <span>
                                    4h ago
                                </span>

                            </div>

                            <span class="home-condition new">
                                Good
                            </span>

                        </div>

                    </article>



                    <!-- PRODUCT 3 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-3.jpg') ?>"
                                alt="Headphones"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                Wireless Headphones
                            </h3>

                            <strong class="home-price">
                                ₦18,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    YABATECH
                                </span>

                                <span>
                                    1d ago
                                </span>

                            </div>

                            <span class="home-condition good">
                                Like New
                            </span>

                        </div>

                    </article>



                    <!-- PRODUCT 4 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-4.jpg') ?>"
                                alt="Monitor"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                24" Desktop Monitor
                            </h3>

                            <strong class="home-price">
                                ₦95,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2d ago
                                </span>

                            </div>

                            <span class="home-condition fair">
                                Good
                            </span>

                        </div>

                    </article>

 <!-- PRODUCT 4 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-4.jpg') ?>"
                                alt="Monitor"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                24" Desktop Monitor
                            </h3>

                            <strong class="home-price">
                                ₦95,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2d ago
                                </span>

                            </div>

                            <span class="home-condition fair">
                                Good
                            </span>

                        </div>

                    </article>
 <!-- PRODUCT 4 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-4.jpg') ?>"
                                alt="Monitor"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                24" Desktop Monitor
                            </h3>

                            <strong class="home-price">
                                ₦95,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2d ago
                                </span>

                            </div>

                            <span class="home-condition fair">
                                Good
                            </span>

                        </div>

                    </article>
 <!-- PRODUCT 4 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-4.jpg') ?>"
                                alt="Monitor"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                24" Desktop Monitor
                            </h3>

                            <strong class="home-price">
                                ₦95,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2d ago
                                </span>

                            </div>

                            <span class="home-condition fair">
                                Good
                            </span>

                        </div>

                    </article>
 <!-- PRODUCT 4 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-4.jpg') ?>"
                                alt="Monitor"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                24" Desktop Monitor
                            </h3>

                            <strong class="home-price">
                                ₦95,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2d ago
                                </span>

                            </div>

                            <span class="home-condition fair">
                                Good
                            </span>

                        </div>

                    </article>
 <!-- PRODUCT 4 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-4.jpg') ?>"
                                alt="Monitor"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                24" Desktop Monitor
                            </h3>

                            <strong class="home-price">
                                ₦95,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    LASU
                                </span>

                                <span>
                                    2d ago
                                </span>

                            </div>

                            <span class="home-condition fair">
                                Good
                            </span>

                        </div>

                    </article>


                    <!-- PRODUCT 5 -->

                    <article class="home-product-card">

                        <div class="home-product-image">

                            <img
                                src="<?= base_url('public/assets/images/products/product-5.jpg') ?>"
                                alt="Phone"
                            >

                            <button
                                type="button"
                                class="home-favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>


                        <div class="home-product-body">

                            <span class="home-product-category">
                                Electronics
                            </span>

                            <h3>
                                Samsung Galaxy Phone
                            </h3>

                            <strong class="home-price">
                                ₦210,000
                            </strong>

                            <div class="home-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    UNILAG
                                </span>

                                <span>
                                    3d ago
                                </span>

                            </div>

                            <span class="home-condition good">
                                Good
                            </span>

                        </div>

                    </article>


                </div>

            </div>

        </div>

    </section>

</main>
<?= $this->endSection('content')?>
