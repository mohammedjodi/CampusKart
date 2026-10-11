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
                    <?php if(isset($user->avatar)):?>
                        <img
                            src="<?= base_url($user->avatar ?? 'https://via.placeholder.com/500') ?>"
                            alt="Profile Avatar"
                            class="ck-profile-avatar">
                    <?php  else : ?>
                        <img
                            src="<?= base_url('src/images/img2.jpg')?>"
                            alt="Profile Avatar"
                            class="ck-profile-avatar">
                    <?php endif ?>
                    
                </div>
                <div class="ck-profile-identity">
                    <div class="ck-profile-name-row">
                        <h1 class="text-dark"><?= esc($user->first_name)?> <?= esc($user->last_name)?></h1>
                        <span class="ck-verified">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <p class="ck-username">@<?= esc($user->username)?></p>
                    <div class="ck-profile-meta">
                        <span>
                            <i class="fa fa-graduation-cap"></i>
                            <?= esc($university['name'])?>
                        </span>
                        <span>
                            <i class="fa fa-map-marker"></i>
                            <?= esc($state['name'])?>, Nigeria
                        </span>
                        <span>
                            <i class="fa fa-calendar"></i>
                            <?= date('F j, Y' , strtotime($user->created_at))?>
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
                                <p><?= esc($user->first_name)?> <?= esc($user->last_name)?></p>
                            </div>
                        </div>
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div>
                                <small>University</small>
                                <p><?= esc($university['name'])?></p>
                            </div>
                        </div>
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div>
                                <small>Location</small>
                                <p><?= esc($state['name'])?>, Nigeria</p>
                            </div>
                        </div>
                        <div class="ck-info-item">
                            <div class="ck-info-icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div>
                                <small>Member since</small>
                                <p><?= date('F j, Y' , strtotime($user->created_at))?></p>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- ABOUT -->
                <div class="ck-info-card">
                    <div class="ck-card-title">
                        <h2>About</h2>
                    </div>
                    <?php if(!empty($user->bio)) :?>
                        <p class="ck-about-text">
                             <?= esc($user->bio)?>        
                        </p>
                    <?php else :?>
                        <p class="ck-about-text">
                            User Bio is Empty
                        </p>
                    <?php endif?>
                    
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
            class="ck-tab-content ck-listings-content my-listings-section">

    <div class="listings-header">
        <div>
            <h1>My Listings</h1>
            <p>Items you currently have listed for sale.</p>
        </div>

        <a href="#" class="add-listing-btn">
            <i class="fa-solid fa-plus"></i>
            Add Listing
        </a>
    </div>


    <!-- Listing Filters -->
    <div class="listing-filters">

        <button class="listing-filter active" data-filter="all">
            All
        </button>

        <button class="listing-filter" data-filter="Active">
            Active
        </button>

        <button class="listing-filter" data-filter="Sold">
            Sold
        </button>

    </div>

<?php if(!empty($listings)) : ?>
    <!-- Listings -->
    <div class="listings-container">
        <!-- Listing Card -->
    <?php foreach($listings as $listing) : ?>
        <article class="listing-card" data-status="<?=esc($listing['status_name'])?>">

            <a href="#" class="listing-image">
                <img src="<?= base_url($listing['image_path'] ?? 'https://via.placeholder.com/500') ?>" alt="">
            </a>

            <div class="listing-content">

                <div class="listing-main">

                    <div class="listing-title-row">

                        <a href="#" class="listing-title">
                            <?=esc($listing['title'])?>
                        </a>

                        <span class="listing-status <?= $listing['status_name'] === 'Active' ? 'active-status' : 'sold-status'?>">
                            <?=esc($listing['status_name'])?>
                        </span>

                    </div>

                    <div class="listing-price">
                       ₦<?=number_format($listing['price'])?>
                    </div>

                    <div class="listing-meta">

                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            <?=esc($university['name'])?>
                        </span>

                        <span>
                            <i class="fa-solid fa-clock"></i><?= timeAgo($listing['created_at'])?>
                        </span>

                    </div>

                </div>


                <!-- Action Menu -->
                <div class="listing-actions">

                    <button class="listing-menu-btn" type="button" aria-label="Listing actions">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    <div class="listing-menu">

                        <a href="<?= route_to('listing.view' , $listing['id'])?>">
                            <i class="fa-regular fa-eye"></i>
                            View Listing
                        </a>

                        <a href="#">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit Listing
                        </a>

                        <button type="button">
                            <i class="fa-solid fa-check"></i>
                            Mark as Sold
                        </button>

                        <button type="button" class="delete-action">
                            <i class="fa-regular fa-trash-can"></i>
                            Delete
                        </button>

                    </div>

                </div>

            </div>

        </article>
        <!-- Empty State -->
        <div class="listings-empty" hidden>

            <div class="empty-icon">
                <i class="fa-regular fa-rectangle-list"></i>
            </div>

            <h3>No listings found</h3>

            <p>
                You don't have any listings in this category.
            </p>
        </div>
    <?php endforeach ?>
<?php else :?>
        <!-- Empty State -->
        <div class="listings-empty" >

            <div class="empty-icon">
                <i class="fa-regular fa-rectangle-list"></i>
            </div>

            <h3>No listings found</h3>

            <p>
                You don't have any listings in this category.
            </p>
        </div>

    </div>
<?php endif?>

</section>
    <!-- Defualt js -->
    <script src="<?= base_url('js/profile.js')?>"></script>
<?= $this->endSection('content')?>