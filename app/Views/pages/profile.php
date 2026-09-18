<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
   Profile
<?= $this->endSection('title')?>
<?= $this->section('content')?>
    <div class="ck-profile-page container">
        <!-- =========================
            PROFILE COVER / IDENTITY
        ========================== -->
        <section class="ck-profile-card">
            <div class="ck-profile-cover"></div>
            <div class="ck-profile-main">
                <div class="ck-avatar-wrapper">
                    <img
                        src="<?= base_url('src/images/img2.jpg')?>"
                        alt="Profile Avatar"
                        class="ck-profile-avatar">
                </div>
                <div class="ck-profile-identity">
                    <div class="ck-profile-name-row">
                        <h1 class="text-dark">Mohammed Jodi</h1>
                        <span class="ck-verified">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <p class="ck-username">@mohammedjodi</p>
                    <div class="ck-profile-meta">
                        <span>
                            <i class="fa fa-graduation-cap"></i>
                            University of Lagos
                        </span>
                        <span>
                            <i class="fa fa-map-marker"></i>
                            Lagos, Nigeria
                        </span>
                        <span>
                            <i class="fa fa-calendar"></i>
                            Joined September 2026
                        </span>
                    </div>
                </div>
                <a href="<?= base_url('settings') ?>" class="ck-edit-profile">
                    <i class="fa fa-pencil"></i>
                    Edit Profile
                </a>
            </div>
            <!-- =========================
                PROFILE STATS
            ========================== -->
            <div class="ck-profile-stats">
                <div class="ck-stat">
                    <strong>12</strong>
                    <span>Listings</span>
                </div>
                <div class="ck-stat">
                    <strong>8</strong>
                    <span>Sold</span>
                </div>
                <div class="ck-stat">
                    <strong>15</strong>
                    <span>Purchases</span>
                </div>
                <div class="ck-stat">
                    <strong>4.8</strong>
                    <span>Rating</span>
                </div>
            </div>
        </section>
        <!-- =========================
            PROFILE TABS
        ========================== -->
        <div class="ck-profile-tabs">
            <button
                type="button"
                class="ck-profile-tab active"
                data-tab="ck-profile-information">
                <i class="fa fa-user"></i>
                Profile
            </button>
            <button
                type="button"
                class="ck-profile-tab"
                data-tab="ck-profile-listings">
                <i class="fa fa-shopping-bag"></i>
                Listings
            </button>
        </div>
        <!-- =====================================================
            TAB 1 — PROFILE INFORMATION
        ====================================================== -->
        <section
            id="ck-profile-information"
            class="ck-tab-content active">
            <div class="ck-profile-grid">
                
                <!-- PERSONAL INFORMATION -->
                <div class="ck-info-card">
                    <div class="ck-card-title">
                        <h2>Profile Information</h2>
                    </div>
                    <div class="ck-info-list">
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div>
                                <small>Name</small>
                                <p>Mohammed Jodi</p>
                            </div>
                        </div>
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div>
                                <small>University</small>
                                <p>University of Lagos</p>
                            </div>
                        </div>
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div>
                                <small>Location</small>
                                <p>Lagos, Nigeria</p>
                            </div>
                        </div>
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div>
                                <small>Member since</small>
                                <p>September 2026</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- ABOUT -->
                <div class="ck-info-card">
                    <div class="ck-card-title">
                        <h2>About</h2>
                    </div>
                    <p class="ck-about-text">
                        Student at the University of Lagos.
                        Buy, sell and discover useful items around campus.
                    </p>
                </div>
                <!-- SELLER INFORMATION -->
                <div class="ck-info-card">
                    <div class="ck-card-title">
                        <h2>Seller Information</h2>
                    </div>
                    <div class="ck-seller-stats">
                        <div>
                            <strong>4.8</strong>
                            <span>
                                <i class="fa fa-star"></i>
                                Rating
                            </span>
                        </div>
                        <div>
                            <strong>8</strong>
                            <span>
                                <i class="fa fa-shopping-bag"></i>
                                Items Sold
                            </span>
                        </div>
                        <div>
                            <strong>1h</strong>
                            <span>
                                <i class="fa fa-clock-o"></i>
                                Response Time
                            </span>
                        </div>
                    </div>
                </div>

                <!-- RECENT ACTIVITY -->
                <div class="ck-info-card">
                    <div class="ck-card-title">
                        <h2>Recent Activity</h2>
                    </div>
                    <div class="ck-activity-list">
                        <div class="ck-activity">
                            <div class="ck-activity-icon">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div>
                                <p>Listed <strong>HP EliteBook 840 G5</strong></p>
                                <small>2 hours ago</small>
                            </div>
                        </div>
                        <div class="ck-activity">
                            <div class="ck-activity-icon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div>
                                <p>Saved <strong>iPhone 13</strong></p>
                                <small>Yesterday</small>
                            </div>
                        </div>
                        <div class="ck-activity">
                            <div class="ck-activity-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div>
                                <p>Purchased <strong>AirPods Pro</strong></p>
                                <small>3 days ago</small>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </section>
        <!-- =====================================================
            TAB 2 — LISTINGS
        ====================================================== -->
        <section
            id="ck-profile-listings"
            class="ck-tab-content ck-listings-content">
            <div class="ck-listings-header">
                <div>
                    <h2>My Listings</h2>
                    <p>Items currently listed for sale.</p>
                </div>
                <a href="<?= base_url('products/create') ?>"
                class="ck-add-listing">
                    <i class="fa fa-plus"></i>
                    Add Listing
                </a>
            </div>
            <!-- PRODUCT GRID -->
            <div class="ck-listing-grid">
                <!-- PRODUCT 1 -->
                <article class="ck-product-card">
                    <div class="ck-product-image">
                        <img
                            src="<?= base_url('assets/images/product-placeholder.jpg') ?>"
                            alt="HP EliteBook">
                        <span class="ck-product-status">
                            Active
                        </span>
                    </div>
                    <div class="ck-product-body">
                        <h3>HP EliteBook 840 G5</h3>
                        <strong class="ck-product-price">
                            ₦280,000
                        </strong>
                        <div class="ck-product-meta">
                            <span>
                                <i class="fa fa-map-marker"></i>
                                Lagos
                            </span>
                            <span>
                                2 days ago
                            </span>
                        </div>
                    </div>
                </article>
                <!-- PRODUCT 2 -->
                <article class="ck-product-card">
                    <div class="ck-product-image">
                        <img
                            src="<?= base_url('assets/images/product-placeholder.jpg') ?>"
                            alt="iPhone 12 Pro">
                        <span class="ck-product-status">
                            Active
                        </span>
                    </div>
                    <div class="ck-product-body">
                        <h3>iPhone 12 Pro</h3>
                        <strong class="ck-product-price">
                            ₦450,000
                        </strong>
                        <div class="ck-product-meta">
                            <span>
                                <i class="fa fa-map-marker"></i>
                                Lagos
                            </span>
                            <span>
                                5 days ago
                            </span>
                        </div>
                    </div>
                </article>
                <!-- PRODUCT 3 -->
                <article class="ck-product-card">
                    <div class="ck-product-image">
                        <img
                            src="<?= base_url('assets/images/product-placeholder.jpg') ?>"
                            alt="AirPods Pro">
                        <span class="ck-product-status">
                            Active
                        </span>
                    </div>
                    <div class="ck-product-body">
                        <h3>AirPods Pro</h3>
                        <strong class="ck-product-price">
                            ₦180,000
                        </strong>
                        <div class="ck-product-meta">
                            <span>
                                <i class="fa fa-map-marker"></i>
                                Lagos
                            </span>
                            <span>
                                1 week ago
                            </span>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
    <!-- Defualt js -->
    <script src="<?= base_url('js/profile.js')?>"></script>
<?= $this->endSection('content')?>